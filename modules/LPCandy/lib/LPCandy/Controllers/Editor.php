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

        $this->view('lpcandy/page-design');
    }    
    
    function page_ajax($id) {
        $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');

        $action = @$_POST['_type'];
        switch ($action) {
            case 'save':
                $page->saveBlocks(json_decode($_POST['blocks'],true));
                break;

            case 'publish':
                $page->publish(json_decode($_POST['blocks'],true),$_POST['html']);
                break;
        }
    }     
}


















