<?php

class LPCandy extends \Bingo\Module {
    function __construct() {
        $this->addModelPath(dirname(__FILE__).'/LPCandy/Models');
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\User','id'=>false),
            array('action'=>'(login|logout|profile)'));
        $this->connect('files/browse.php',array('controller'=>'\LPCandy\Controllers\User','action'=>'files'));
        $this->connect('files/browse.php/*url',array('controller'=>'\LPCandy\Controllers\User','action'=>'files'));
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\Page','id'=>false),
            array('action'=>'(page-list|page-delete|page-edit|page-create|page-design|page-ajax|page-child-edit)'));
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\Track','id'=>false),
            array('action'=>'(track-list)'));
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\Front','id'=>false),
            array('action'=>'(page-view|track)'));
        
        $this->connect("*any",array('function'=>function($route){
            if (substr($route['any'],0,5)=='admin') return true;
            
            $domain = $_SERVER['SERVER_NAME'];
            $page = \LPCandy\Models\Page::findOneByDomain($domain);
            if ($page) {
                $c = new \LPCandy\Controllers\Front;
                $c->page_view($page->id);
            } else {
                return true;
            }
        }));
        
        // admin
        $this->connect('admin/developer/:action',array('controller'=>'\LPCandy\Controllers\Admin\Developer'));
    }
}