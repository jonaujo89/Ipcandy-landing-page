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
        $deps = self::loadDependencies($entry_point,$bundle_path);

        ?>function __bundler_load(key,src) { if (!window[key]) eval.call(window,src+"//# sourceURL=file://bundler/"+key+".js") }<? echo PHP_EOL;
        ?>__bundler_load('bundler',<?=json_encode(file_get_contents(__DIR__.'/../assets/bundler.js'))?>)<? echo PHP_EOL;
        ?>__bundler_load('CleanCSS',<?=json_encode(file_get_contents(__DIR__.'/../assets/clean-css.js'))?>)<? echo PHP_EOL;
        ?>__bundler_load('Terser',<?=json_encode(file_get_contents(__DIR__.'/../assets/terser.min.js'))?>)<? echo PHP_EOL;
        ?>__bundler_load('teacss',<?=json_encode(file_get_contents(__DIR__.'/../assets/teacss.js'))?>)<? echo PHP_EOL;
        ?>bundler.run(<?=json_encode($entry_point)?>,<?=json_encode($bundle_path)?>,<?=json_encode($base_url)?>,<?=json_encode($deps)?>)<? echo PHP_EOL;
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

    static function loadDependencies($entry_point,$bundle_path) {
        $cache = [];
        $bundle_abs = INDEX_DIR."/".$bundle_path;
        $bundle_dir = dirname($bundle_abs)."/";
        
        $import2rel = function($import,$import_path) use ($bundle_dir) {
            $import = ltrim(parse_url($import)['path'] ?? '',"\\\/");
            $abs = preg_replace('#/[^/]*$#', '',$import_path)."/".$import;
            $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
            for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}
            $ext = pathinfo($abs,PATHINFO_EXTENSION);
            if (!$ext) $abs .= ".".pathinfo($import_path,PATHINFO_EXTENSION);

            $from = explode('/', $bundle_dir);
            $to = explode('/', $abs);
            foreach($from as $depth => $dir) {
                if(isset($to[$depth])) {
                    if ($dir === $to[$depth]) {
                        unset($to[$depth]);
                        unset($from[$depth]);
                    }
                    else break;
                }
            }
            for($i=0;$i<count($from)-1;$i++) array_unshift($to,'..');
            $result = implode('/', $to);
            return $result;
        };

        $process = function ($rel_path) use (&$cache,$bundle_dir,&$process,&$import2rel) {
            if (isset($cache[$rel_path])) return;

            $path = $bundle_dir.$rel_path;
            if (!file_exists($path) || is_dir($path)) return $cache[$rel_path] = false;

            $path_ext = pathinfo($rel_path,PATHINFO_EXTENSION);
            $text = file_get_contents($path);

            $sub_uris = [];
            if ($path_ext=="tea") {
                $pattern = '/@import\s*(\'|")(.*?)(\'|")/';
                preg_match_all($pattern,$text,$matches);
                foreach ($matches[2] as $import) $sub_uris[] = $import2rel($import,$path);
            }
            if ($path_ext=="js") {
                $pattern = '/require\(\s*(\'|")(.*?)(\'|")\s*\)/';
                $text = preg_replace_callback($pattern,function($matches) use ($path,&$import2rel,&$sub_uris) {
                    $sub_uri = $import2rel($matches[2],$path);
                    $sub_uris[] = $sub_uri;
                    return 'require('.$matches[1].$sub_uri.$matches[3].')';
                },$text);
            }
            if ($path_ext=="css") {
                $pattern = '/url\([\'"]?([^\'"\)]*)[\'"]?\)/i';
                $text = preg_replace_callback($pattern,function ($matches) use ($path,&$import2rel) {
                    if (preg_match('/^(.:\/|data:|http:\/\/|https:\/\/|\/)/',$matches[1])) return $matches[0];
                    return 'url('.$import2rel($matches[1],$path).')';
                },$text);
            }

            $cache[$rel_path] = $text;            
            foreach ($sub_uris as $sub_uri) $process($sub_uri);
        };

        $process($import2rel(basename($entry_point),INDEX_DIR."/".$entry_point));
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