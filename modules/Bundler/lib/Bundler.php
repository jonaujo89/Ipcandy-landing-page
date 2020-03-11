<?php

class Bundler extends \Bingo\Module {

    static function serveFile($bundle_path,$entry_point) {
        if (!$entry_point) return true;
        $bundle_ext = pathinfo($bundle_path, PATHINFO_EXTENSION);
    
        ob_start('ob_gzhandler');        
        if ($bundle_ext=='css') {
            header("Content-type: text/css");
            echo " ";return;
        }
        
        header("Content-type: text/js");

        $base_url = "//".$_SERVER['HTTP_HOST'].url("");
        $deps = self::loadDependencies($base_url.$entry_point);

        ?>function __bundler_load(key,src) { if (!window[key]) eval.call(window,src+"//# sourceURL=file://bundler/"+key+".js") }<? echo PHP_EOL;
        ?>__bundler_load('bundler',<?=json_encode(file_get_contents(__DIR__.'/../assets/bundler.js'))?>)<? echo PHP_EOL;
        ?>__bundler_load('CleanCSS',<?=json_encode(file_get_contents(__DIR__.'/../assets/clean-css.js'))?>)<? echo PHP_EOL;
        ?>__bundler_load('Terser',<?=json_encode(file_get_contents(__DIR__.'/../assets/terser.min.js'))?>)<? echo PHP_EOL;

        $entry_ext = pathinfo($entry_point, PATHINFO_EXTENSION);
        if ($entry_ext == "tea") {
            ?>__bundler_load('teacss',<?=json_encode(file_get_contents(__DIR__.'/../assets/teacss.js'))?>)<? echo PHP_EOL;
            ?>bundler.loadTea(<?=json_encode($entry_point)?>,<?=json_encode($bundle_path)?>,<?=json_encode($base_url)?>,<?=json_encode($deps)?>)<? echo PHP_EOL;
        }
        else if ($entry_ext == "js") {
            ?>bundler.loadJS(<?=json_encode($entry_point)?>,<?=json_encode($bundle_path)?>,<?=json_encode($base_url)?>,<?=json_encode($deps)?>,{})<? echo PHP_EOL;
        }
    }

    static function getCachePath($bundle_path) {
        $dir = APP_DIR."/cache/bundler";
        if (!file_exists($dir)) mkdir($dir,0777,true);
        return $dir."/".str_replace(array("/","\\"),"_",$bundle_path);
    }

    static function build() {
        $post_entry_point = $_POST['entry_point'] ?? null;
        foreach (\Bundler\Configuration::$bundles as ['name'=>$name,'path'=>$path,'entry_point'=>$entry_point]) {
            if ($post_entry_point == $entry_point) {
                $ext = pathinfo($path,PATHINFO_EXTENSION);
                if ($ext!="js") {
                    echo "path should be js file ".$path;
                    return;
                }

                $js_path = $path;
                $css_path = preg_replace('"\.js$"', '.css', $path);

                foreach (['js' => $js_path,'css' => $css_path] as $ext => $file_path) {
                    $cache_path = self::getCachePath($file_path);
                    echo "saving ".$file_path."\n";
                    file_put_contents($cache_path,$_POST[$ext]);
                    $full_path = INDEX_DIR."/".$file_path;
                    copy($cache_path,$full_path);
                }
                echo "finished\n";                
                return;
            }
        }
        return true;
    }

    static function loadDependencies($url) {
        $cache = [];
        $entry_ext = pathinfo(parse_url($url)['path'],PATHINFO_EXTENSION);

        $rel2abs = function($rel, $base) {
            if (parse_url($rel, PHP_URL_SCHEME) != '' || substr($rel, 0, 2) == '//') return $rel;
            if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;
            extract(parse_url($base));
            $path = preg_replace('#/[^/]*$#', '', $path);
            if ($rel[0] == '/') $path = '';
            $abs = "$host$path/$rel";
            $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
            for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}
            return '//'.$abs;
        };

        $process = function ($url) use (&$process,&$cache,&$rel2abs,$entry_ext) {
            $parsed_url = parse_url($url);
            $url_path = $parsed_url['path'];
            $url_host = $parsed_url['host'] ?? false;
            $url_ext = pathinfo($url_path,PATHINFO_EXTENSION);

            $base_url = url('');
            $base_path = INDEX_DIR."/";

            if ($url_host && $url_host!=$_SERVER['HTTP_HOST']) return;
            if (strpos($url_path,$base_url)!==0) return;

            $path = $base_path.substr($url_path,strlen($base_url));

            if (isset($cache[$url])) return;
            if (!$path || !file_exists($path)) {
                $cache[$url] = false;
                return;
            }

            $text = file_get_contents($path);
            $cache[$url] = $text;

            $sub_uris = [];

            if ($entry_ext=="tea" && $url_ext=="tea") {
                $pattern = '/@import\s*(\'|")(.*?)(\'|")/';
                preg_match_all($pattern,$text,$matches);
                $sub_uris = $matches[2];
            }
            if ($entry_ext=="js" && $url_ext=="js") {
                $pattern = '/import(?:["\'\s]*([\w*${}\n\r\t, ]+)from\s*)?["\'\s]["\'\s](.*[@\w_-]+)["\'\s].*;/m';
                preg_match_all($pattern,$text,$matches);
                $sub_uris = array_merge($sub_uris,$matches[2]);

                $pattern_2 = '/require\(\s*(\'|")(.*?)(\'|")\s*\)/';
                preg_match_all($pattern_2,$text,$matches);
                $sub_uris = array_merge($sub_uris,$matches[2]);
            }
            
            foreach ($sub_uris as $rel) {
                $abs_url = $rel2abs($rel,$url);
                $ext = pathinfo($rel, PATHINFO_EXTENSION);
                if (!$ext) {
                    $abs_url = $abs_url.".".$url_ext;
                }
                $process($abs_url);
            }            
        };
        $process($url);
        return $cache;
    }

    function __construct() {
        parent::__construct();
        
        $this->connect('bundler/build',['function' => ['Bundler','build']]);

        foreach (\Bundler\Configuration::$bundles as ['name'=>$name,'path'=>$path,'entry_point'=>$entry_point]) {
            $js_path = $path;
            $css_path = preg_replace('"\.js$"', '.css', $path);

            foreach (['js' => $js_path,'css' => $css_path] as $ext => $file_path) {
                $full_path = INDEX_DIR."/".$file_path;

                if (!in_array($name,\Bundler\Configuration::$developEnabled)) {
                    $cache_path = self::getCachePath($file_path);
                    if (file_exists($cache_path)) {
                        if (!file_exists($full_path) || filemtime($full_path) < filemtime($cache_path)) {
                            copy($cache_path,$full_path);
                        }
                    }
                } else {
                    if (file_exists($full_path)) unlink($full_path);

                    \Bingo\Routing::connect($file_path,['function' => function() use ($file_path,$entry_point) {
                        return self::serveFile($file_path,$entry_point);
                    }]);
                }
            }
        }
    }
}