<?php

namespace LPCandy\Controllers;

class Editor extends Base {
    function __construct() {
        parent::__construct($needUser=false);
    }
    
    function page_design($id) {
        if (!$id) {
            if ($this->user) redirect('page-create');
            $page = $this->data['page'] = false;
            $this->data['page_id'] = false;
            $tpl = 'page';
        } 
        else {
            $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
            if (!$page || $page->user!=$this->user) redirect('/');
            $this->data['page_id'] = $page->id;
            $tpl = $page->getTemplate();
        }
        
        $modules = array();
        $modules[] = INDEX_URL."/view/editor/editor.js";

        if ($page && file_exists($page->getPath("module.js")))
            $modules[] = $page->getUrl('module.js');
        
        $this->data['title'] = _t('Design page');
        $this->data['tpl'] = $tpl;
        $this->data['modules'] = $modules;
        $this->view('lpcandy/page-design');
    }    
    
    function page_ajax($id) {
        if ($id) {
            $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
            if (!$page || $page->user!=$this->user) redirect('/');
            
            $api = new \LPCandy\TemplaterApi($page);
            $api->run();
        } else {
            if ($_POST['_type']=='load' || $_POST['_type']=='component') {
                $page = \LPCandy\Models\Page::findOneByDomain('default');
                if ($page) {
                    $api = new \LPCandy\TemplaterApi($page);
                    $api->run();
                }
            }
        }
    }     
}


















