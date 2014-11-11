<?php

namespace LPCandy\Controllers\Admin;

class Developer extends \CMS\Controllers\Admin\BasePrivate {
    function create_bg_thumbs() {
        foreach (glob(INDEX_DIR."/templater_modules/lpcandy/assets/background/*.jpg") as $path) {
            $file = \PhpThumb\Factory::create($path,array('resizeUp'=>false));
            $file->resize(200,1000);
            $file->save(INDEX_DIR."/templater_modules/lpcandy/assets/background/thumbs/".basename($path));
        }
        echo 'ok';
    }
}