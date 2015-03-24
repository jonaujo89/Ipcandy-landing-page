<?php

namespace LPCandy\Controllers\Admin;

class Developer extends \CMS\Controllers\Admin\BasePrivate {
    function create_bg_thumbs() {
        foreach (glob(INDEX_DIR."/view/editor/assets/background/*.jpg") as $path) {
            $file = \PhpThumb\Factory::create($path,array('resizeUp'=>false));
            $file->resize(200,1000);
            $file->save(INDEX_DIR."/view/editor/assets/background/thumbs/".basename($path));
        }
        echo 'ok';
    }
    
    function build() {
        if (isset($_REQUEST['remote'])) {
            ob_get_clean();
            echo file_get_contents($_REQUEST['remote']); 
            die();
        }        
        if (isset($_POST['js'])) {
            
            $js = $_POST['js'];
            $css = $_POST['css'];
            $path = $_POST['path'];
            
            file_put_contents(INDEX_DIR."/$path.min.js",$js);
            file_put_contents(INDEX_DIR."/$path.min.css",$css);
            echo 'done';
            die();
        }

        ?>
        <!doctype html>
        <html>
        <head>
            <title>build page</title>
            <script src="<?=url('lib/teacss/lib/teacss.js')?>"></script>
            <script src="<?=url('lib/teacss/src/teacss/build/lib/clean-css.js')?>"></script>
            <script src="<?=url('lib/teacss/src/teacss/build/lib/uglify-js.js')?>"></script>
            
            <script src="<?=url('lib/teacss-ui/teacss-ui.js')?>"></script>
            <script src="<?=url('lib/require/require.js')?>"></script>
            <script>
                window.$ = teacss.jQuery;
                function send(css,js,path,$status) {
                    console.debug(path,{css:css,js:js});
                    $status.text('minifying - '+path);
                    
                    setTimeout(function(){
                        css = CleanCSS.process(css);
                        js = uglify(js);
                        
                        $status.text('saving - '+path);

                        $.ajax({
                            url: "",type: "POST",
                            data: {js:js,css:css,path:path},
                            success: function (data) {
                                $status.text(data+' - '+path);
                            }
                        });
                    },1);
                }
                
                require.build(
                    "<?=url('lib/templater/client/app.js')?>", "<?=url('view/editor/editor.js')?>", {
                        stylePath: "<?=url('view/editor')?>",
                        scriptPath: "<?=url('view/editor')?>",
                        callback: function (res) {
                            send(res.css,res.js,'view/editor/editor',$("#editor_status"));
                        }
                    }
                );
                
                teacss.build("<?=url('view/editor/style/style.tea')?>",{
                    stylePath: "<?=url('view/editor/style')?>",
                    styleName: "style.css",
                    callback: function (files) {
                        var css = files["<?=url('view/editor/style/style.css')?>"];
                        var js = files['/default.js'];
                        send(css,js,'view/editor/style/style',$("#style_status"));
                    }
                })
            </script>        
        </head>
        <body>
            <div id="editor_status">loading</div>
            <div id="style_status">loading</div>
        </body>

        
    <?}
    
    function create_translations() {
        $dir = INDEX_DIR."/view/editor";
        
        $Directory = new \RecursiveDirectoryIterator($dir);
        $Iterator = new \RecursiveIteratorIterator($Directory);
        $Regex = new \RegexIterator($Iterator, '/^.+\.js$/i', \RecursiveRegexIterator::GET_MATCH);
        
        $lines = array();
        
        foreach ($Regex as $path) {
            $text = file_get_contents($path[0]);
            preg_match_all('/_t\(("([^"]+)"|\'([^\']+)\')\)/',$text,$matches);
            
            if (!empty($matches[0])) {
                foreach ($matches[2] as $i=>$line) {
                    if (!$line) $line = $matches[3][$i];
                    if ($line) $lines[$line] = $line;
                }
            }
        }
        
        $ru_path = $dir."/editor_ru.js";
        $translated = @file_get_contents($ru_path);
        $translated = $translated ? json_decode(str_replace(array("window._t.load(",");"),"",$translated),true) : array();
        
        $new_translated = array();
        foreach ($lines as $line) {
            $new_translated[$line] = isset($translated[$line]) ? $translated[$line] : '';
        }
        
        $text = json_encode($new_translated);
        $text = str_replace("{","window._t.load({\n    ",$text);
        $text = str_replace("\",","\",\n    ",$text);
        $text = str_replace("}","\n});",$text);
        
        $text = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
            return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
        }, $text);        
        
        file_put_contents($ru_path,$text);
        
        _D($new_translated);
    }
}