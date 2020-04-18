<?php

require __DIR__."/helpers/punycode_to_unicode.php";

class LPCandy extends \Bingo\Module {
    function __construct() {
        $this->addModelPath(dirname(__FILE__).'/LPCandy/Models');
        
        bingo_domain_register('lpcandy',dirname(__FILE__)."/../locale");
        bingo_domain('lpcandy');

        $this->connect('admin/lpcandy/:action/:id',['controller'=>'\LPCandy\Controllers\Admin','id'=>false]);
        \Bingo\Action::add('admin_pre_header',function(){
            \Admin::$menu[_t('LPCandy','lpcandy')][_t('Customers','lpcandy')] = 'admin/lpcandy/user-list';
        });        


        $this->connect("api/:action/:id",['controller'=>'\LPCandy\Controllers\Api','id'=>false]);

        $this->connect("page-view/:id",['function'=>function($route){
            $page = \LPCandy\Models\Page::find($route['id']); 
            $page_html = $page ? $page->getPublishedHtml():"";
            require __DIR__."/../template/site.php";
        }]);
        $this->connect("*any",['function'=>function($route){
            require __DIR__."/../template/site.php";
        }]);

    }
}