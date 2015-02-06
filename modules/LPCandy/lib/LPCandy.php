<?php

class LPCandy extends \Bingo\Module {
    function __construct() {
        $this->addModelPath(dirname(__FILE__).'/LPCandy/Models');
        
        bingo_domain_register('lpcandy',dirname(__FILE__)."/../locale");
        bingo_domain('lpcandy');
        
        \Bingo\Config::loadFile('config',INDEX_DIR.'/config.php');
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\User','id'=>false),
            array('action'=>'(login|logout|profile|get-invite)'));
        $this->connect('files/browse.php',array('controller'=>'\LPCandy\Controllers\User','action'=>'files'));
        $this->connect('files/browse.php/*url',array('controller'=>'\LPCandy\Controllers\User','action'=>'files'));
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\Page','id'=>false),
            array('action'=>'(page-list|page-delete|page-edit|page-create|page-child-create)'));
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\Editor','id'=>false),
            array('action'=>'(page-design|page-ajax|page-first)'));
        
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\Track','id'=>false),
            array('action'=>'(track-list|track-delete|track-update-status|track-file)'));
        
        $this->connect("/",array('controller'=>'\LPCandy\Controllers\Front','action'=>'home'));
        $this->connect(":action/:id",array('controller'=>'\LPCandy\Controllers\Front','id'=>false),
            array('action'=>'(page-view|track)'));
        
        $this->connect("*any",array('function'=>function($route){
            if (substr($route['any'],0,5)=='admin') return true;
            $domain = $_SERVER['SERVER_NAME'];            
            if ($domain==\Bingo\Config::get('config','domain')) return true;            
            $request_url = $_SERVER['REQUEST_URI'];     

            $page = \LPCandy\Models\Page::findOneByDomain($domain);

            if ($page) { 
                $page_id=false;
                $c = new \LPCandy\Controllers\Front;
                if($request_url && $request_url!="/"){
                    if(property_exists($page,'children'))
                        foreach($page->children as $child_obj){                
                            if($request_url==$child_obj->pathname){                            
                                $page_id=$child_obj->id;
                            }
                        }
                    if(!$page_id) return true;
                } else {
                    $page_id=$page->id;
                }
                $c->page_view($page_id);
            } else {
                return true;
            }
        }));
        
        // admin
        $this->connect('admin/developer/:action',array('controller'=>'\LPCandy\Controllers\Admin\Developer'));
        $this->connect('admin/lpcandy/:action/:id',array('controller'=>'\LPCandy\Controllers\Admin\Users','id'=>false),
           array('action'=>'(user-list|user-login)'));
        $this->connect('admin/lpcandy/:action/:id',array('controller'=>'\LPCandy\Controllers\Admin\Invites','id'=>false),
           array('action'=>'(invite-list|invite-add|invite-add-one)'));
        
        \Bingo\Action::add('admin_pre_header',function(){
            \Admin::$menu[_t('LPCandy','lpcandy')][_t('Customers','lpcandy')] = 'admin/lpcandy/user-list';
            \Admin::$menu[_t('LPCandy','lpcandy')][_t('Invites','lpcandy')] = 'admin/lpcandy/invite-list';
        });        
    }
    
    static function log($message, $filename = 'error.log') {
        $timestamp = new \DateTime("Now");
        error_log("\n".$timestamp->format("d.m.Y H:i:s").": " . $message,3,INDEX_DIR."/logs/".$filename);
    }        
}