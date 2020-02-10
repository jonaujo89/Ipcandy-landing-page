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