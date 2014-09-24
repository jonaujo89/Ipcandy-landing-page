<?php

namespace LPCandy\Controllers;

class Front extends Base {
    function __construct() {
        parent::__construct(false);
    }    

    function page_view($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page) return true;
        
        $api = new \LPCandy\TemplaterApi($page);
        $api->includeModules(array("core"));
        
        $id = $page->parent ? $page->parent->getField('id') : $page->id;
        $assets = url('upload/LPCandy/pages/'.$id."/publish");
        
        $body_html = $api->view($page->getTemplate(),false,true);
        
        ?>
            <!doctype html>
            <html>
            <head>
                <meta charset="utf-8" />
                <title><?= $page->title ?></title>
                <script>var base_url = "<?=url('')?>"</script>
                <link rel="stylesheet" type="text/css" href="<?=$assets.'/default.css'?>">
                <script src="<?=$assets.'/default.js'?>"> </script>
            </head>           
                <?= $body_html ?>
            </html>
        <?
    }
}