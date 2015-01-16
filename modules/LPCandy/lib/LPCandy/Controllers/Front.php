<?php

namespace LPCandy\Controllers;

class Front extends Base {
    function __construct() {
        parent::__construct(false);
    }    
    
    function home() {
        $home_domain = \Bingo\Config::get('config','domain');
        $page = \LPCandy\Models\Page::findOneByDomain($home_domain);
        if (!$page) return true;
        
        $api = new \LPCandy\TemplaterApi($page);
        $assets = url('upload/LPCandy/pages/'.$page->id."/publish");
        $body_html = $api->view($page->getTemplate(),false,true);

        $this->data['title'] = $page->title;
        $this->data['assets'] = $assets;
        $this->data['body_html'] = $body_html;
        $this->view('lpcandy/home');
    }

    function page_view($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page) return true;
        
        $api = new \LPCandy\TemplaterApi($page);
        
        $id = $page->parent ? $page->parent->getField('id') : $page->id;
        $assets = url('upload/LPCandy/pages/'.$id."/publish");
        
        $body_html = $api->view($page->getTemplate(),false,true);
        
        ?>
            <!doctype html>
            <html>
            <head>
                <meta charset="utf-8" />
                <meta name="robots" content="<?= htmlspecialchars($page->meta_robots, ENT_QUOTES)?>">
                <meta name="keywords" content="<?= htmlspecialchars($page->meta_keywords, ENT_QUOTES)?>">
                <meta name="description" content="<?= htmlspecialchars($page->meta_description, ENT_QUOTES)?>">
                <title><?= $page->title ?></title>
                <script>
                    var base_url = "<?=INDEX_URL?>";
                    var page_id = <?=$page->id?>; 
                </script>
                <link rel="stylesheet" type="text/css" href="<?=$assets.'/default.css'?>">
                <script src="<?=$assets.'/default.js'?>"> </script>
            </head>  
                <body>
                    <?= $body_html ?>
                    <?= $page->extra_html?>
                </body>
            </html>
        <?
    }
    
    function track($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page) return;
        
        $track = new \LPCandy\Models\Track;
        $track->user = $page->user;        
        $track->page = $page;
        $track->page_title = $page->title;
        $track->data = array('values'=>json_decode($_POST['form'],true));
        $track->ip = $_SERVER['REMOTE_ADDR'];
        $track->save();    
        echo 'ok';
    }
}