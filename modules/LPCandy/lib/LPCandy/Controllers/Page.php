<?php

namespace LPCandy\Controllers;

class Page extends Base {
    function __construct() {
        parent::__construct(true);
    }

    function page_list() {
        
        $top = array();
        $list = \LPCandy\Models\Page::findBy(array('user'=>$this->user));
        foreach ($list as $page) {
            $page->children = array();
            if (!$page->parent) $top[$page->id] = $page;
        }
        foreach ($list as $page) {
            if ($page->parent) {
                $parent = @$top[$page->parent->getField('id')];
                if ($parent)
                    $parent->children[] = $page;
            }
        }
        
        $this->data['list'] = $top;
        $this->data['title'] = _t("Pages");
        $this->data['page_actions']['page-create'] = _t('Create New Landing Page');
        $this->view('lpcandy/page-list');
    }
    
    function page_delete($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');
        foreach ($page->children as $ch) $ch->delete(false);
        $page->delete();
        redirect('page-list');
    }
    
    function page_create() {
        $page = new \LPCandy\Models\Page();
        
        $label = _t('Start from scratch');
        $label .= "<img src='".$page->getScreenshotUrl()."'>";
        $templates = array($label=>0);
        $tpl_user = \LPCandy\Models\User::findOneByLogin('boomyjee');
        $tpl_pages = \LPCandy\Models\Page::findBy(array('user'=>$tpl_user,'parent'=>null));
        
        foreach ($tpl_pages as $key=>$p) {
            $label = "<img src='".$p->getScreenshotUrl()."'>";
            $label .= $p->title;
            $templates[$label] = $p->id;
        };

        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('title',_t('Title'),'required');
        $form->text('domain',_t('Domain'));
        $form->radio('template',_t('Template'),$templates,"")->add_class("template-select");
        $form->fieldset();
        $form->submit(_t('Create page'));
        
        if ($form->validate()) {
            $form->fill($page);
            $page->user = $this->user;
            $page->save();
            
            if ($form->values['template']) {
                $tpl_page = \LPCandy\Models\Page::find($form->values['template']);
                if ($tpl_page) {
                    $page->copyFromTemplate($tpl_page);
                }
            }
            redirect('page-list');
        }
        
        $this->data['form'] = $form->get();
        $this->data['title'] = _t('Create page');
        $this->view('lpcandy/page-create');
    }
    
    function page_child_edit($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect("/");
        
        if ($page->parent) {
            $parent = $page->parent;
        } else {
            $parent = $page;
            $page = new \LPCandy\Models\Page;
        }
        
        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('title',_t('Title'),'required',$page->title);
        $form->fieldset();
        $form->submit(_t('Save child page'));
        
        if ($form->validate()) {
            $form->fill($page);
            $page->user = $this->user;
            $page->parent = $parent;
            $page->save();
            redirect('page-list');
        }
        
        $this->data['form'] = $form->get();
        $this->data['title'] = _t('Edit child page');
        $this->view('lpcandy/page-edit');
    }
    
    function page_edit($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect("/");
        
        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('title',_t('Title'),'required',$page->title);
        $form->text('domain',_t('Domain'),'',$page->domain);
        $form->fieldset();
        $form->submit(_t('Save page'));
        
        if ($form->validate()) {
            $form->fill($page);
            $page->user = $this->user;
            $page->save();
            redirect('page-list');
        }
        
        $this->data['form'] = $form->get();
        $this->data['title'] = _t('Edit page');
        $this->view('lpcandy/page-edit');
    }
    
    function page_design($id) {
        $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');
        
        $modules = array();
        $modules[] = INDEX_URL."/view/editor/editor.js";
        
        if (file_exists($page->getPath("module.js")))
            $modules[] = $page->getUrl('module.js');
        
        $this->data['title'] = _t('Design page');
        $this->data['tpl'] = $page->getTemplate();
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


















