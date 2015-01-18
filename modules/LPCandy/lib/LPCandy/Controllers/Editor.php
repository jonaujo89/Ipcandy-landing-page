<?php

namespace LPCandy\Controllers;

class Editor extends Base {
    function __construct() {
        parent::__construct($needUser=true);
    }
    
    function page_first() {
        $pages = \LPCandy\Models\Page::findByUser($this->user);
        if (count($pages)) {
            redirect('page-create');
            return;
        }
        
        $page = new \LPCandy\Models\Page;
        $page->user = $this->user;
        $page->title = _t('My first page');
        $page->save();
        
        $tpl_page = \LPCandy\Models\Page::findOneByDomain('default');
        if ($tpl_page) {
            $page->copyFromTemplate($tpl_page);
            $page->save();
        }
        redirect('page-design/'.$page->id);
    }
    
    function page_design($id) {
        $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');
        $this->data['page_id'] = $page->id;
        $tpl = $page->getTemplate();
        
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
        $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');

        $api = new \LPCandy\TemplaterApi($page);
        $api->run();
    }     
}


















