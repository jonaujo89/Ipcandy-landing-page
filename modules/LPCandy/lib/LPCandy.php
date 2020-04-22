<?php

require __DIR__."/helpers/punycode_to_unicode.php";

class LPCandy extends \Bingo\Module {
    function __construct() {
        $this->addModelPath(dirname(__FILE__).'/LPCandy/Models');
        
        bingo_domain_register('lpcandy',dirname(__FILE__)."/../locale");
        bingo_domain('lpcandy');

        $this->connect('admin/lpcandy/:action/:id',['controller'=>'\LPCandy\Controllers\Admin','id'=>false]);
        $this->connect('admin/developer/:action/:id',['controller'=>'\LPCandy\Controllers\Developer','id'=>false]);
        \Bingo\Action::add('admin_pre_header',function(){
            \Admin::$menu[_t('LPCandy','lpcandy')][_t('Customers','lpcandy')] = 'admin/lpcandy/user-list';
        });        

        $this->connect("api/:action/:id",['controller'=>'\LPCandy\Controllers\Api','id'=>false]);

        $this->connect("page-view/:id",['function'=>function($route){
            $page = \LPCandy\Models\Page::find($route['id']); 
            if (!$page) return;
            $this->page_view($page);
        }]);

        $this->connect("*any",['function'=>function($route){
            $uri = isset($route['any']) ? trim($route['any'],"/") : '';
            if (substr($uri,0,5)=='admin') return true;
            $domain = $_SERVER['SERVER_NAME'];            
            if ($domain==\Bingo\Config::get('config','domain')[bingo_get_locale()]) return true;            

            $page = \LPCandy\Models\Page::findOneByDomain($domain);
            if (!$page) {
                $page = \LPCandy\Models\Page::findOneByDomain(punycode_to_unicode($domain));
                if (!$page) return true;
            }
            if (!$uri) {
                $this->page_view($page);
            } else {
                $sub_page = \LPCandy\Models\Page::findOneBy(array('parent'=>$page,'pathname'=>$uri));
                $this->page_view($sub_page ?: $page);
            }
        }]);

        $this->connect("*any",['function'=>function($route){
            require __DIR__."/../template/front.php";
        }]);
    }

    function page_view($page) {
        require __DIR__."/../template/view.php";
    }
}