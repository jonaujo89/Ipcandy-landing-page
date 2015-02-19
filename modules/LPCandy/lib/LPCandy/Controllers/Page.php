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
        redirect('page-list/');
    }
    
    function domain_validator($page) {
        return function ($val) use ($page) {
            if ($val) {
                $pages = \LPCandy\Models\Page::findByDomain($val);
                foreach ($pages as $one) {
                    if ($one->id!=$page->id) throw new \ValidationException(_t("Domain is already in use"));
                }
            }
            return $val;
        };
    }
    
    function page_create() {
        $page = new \LPCandy\Models\Page();
        
        $label = _t('Start from scratch');
        $label .= "<img src='".$page->getScreenshotUrl()."'>";
        $templates = array($label=>0);
        //$tpl_user = \LPCandy\Models\User::findOneByLogin('boomyjee');
        //$tpl_pages = \LPCandy\Models\Page::findBy(array('user'=>$tpl_user,'parent'=>null));
        $tpl_pages = \LPCandy\Models\Page::findByDomain('default');
        $tpl = count($tpl_pages) ? $tpl_pages[0]->id : 0;
        
        foreach ($tpl_pages as $key=>$p) {
            $label = "<img src='".$p->getScreenshotUrl()."'>";
            $label .= $p->title;
            $templates[$label] = $p->id;
        };

        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('title',_t('Title'),'required');
        $form->text('domain',_t('Domain'),$this->domain_validator($page));
        $form->radio('template',_t('Template'),$templates,"",$tpl)->add_class("template-select");
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
                    $page->save();
                }
            }
            redirect('page-list');
        }
        
        $this->data['form'] = $form->get();
        $this->data['title'] = _t('Create page');
        $this->view('lpcandy/page-create');
    }
    
    function page_form($page) {
       
        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('title',_t('Title'),'required',$page->title);
        
        if ($page->parent) {
            $form->text('pathname',_t('Path (Example: /link)'),'required',$page->pathname);            
        } else {
            $form->text('domain',_t('Domain (bind your domain to our server IP:').$_SERVER['REMOTE_ADDR'].')',$this->domain_validator($page),$page->domain);
        }
        
        $form->text('meta_robots',_t('Meta-tag “robots” content'),'',$page->meta_robots);
        $form->text('meta_keywords',_t('Meta-tag “keywords” content'),'',$page->meta_keywords);
        $form->text('meta_description',_t('Meta-tag “description” content'),'',$page->meta_description);
        $form->textarea('extra_html',_t('Extra html <b>JavaScript</b> code (example: online consultant)'),'',$page->extra_html,array('rows'=>15));
        $form->textarea('extra_html_submit',_t('<b>JavaScript</b> call when form submit (example: google analytics or metrika yandex)'),'',$page->extra_html_submit,array('rows'=>15));
        $form->fieldset();
        
        if ($page->parent) {
            $form->submit(_t('Save child page'));
            $this->data['title'] = _t('Edit child page');
        } else {
            $form->submit(_t('Save page'));
            $this->data['title'] = _t('Edit page');
        }
        
        if ($form->validate()) {
            $form->fill($page);
            $page->user = $this->user;
            $page->save();
            redirect('page-list');
        }
        
        $this->data['form'] = $form->get();
        $this->view('lpcandy/page-edit');
    }
    
    function page_child_create($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect("/");
        
        $child = new \LPCandy\Models\Page;
        $child->parent = $page;
        $this->page_form($child);
    }
    
    function page_edit($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect("/");
        $this->page_form($page);
    }
}