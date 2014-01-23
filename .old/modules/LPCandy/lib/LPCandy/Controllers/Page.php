<?php

namespace LPCandy\Controllers;

class Page extends Base {
    function __construct() {
        parent::__construct(true);
    }

    function page_list() {
        $this->data['list'] = \LPCandy\Models\Page::findBy(array('user'=>$this->user),'template_id DESC');
        $this->data['title'] = _t("Pages");
        
        $this->data['page_actions']['page-edit'] = _t('New Page');
        $this->data['item_actions']['page-edit'] = _t('edit');
        $this->data['item_actions']['page-design'] = _t('design');
        $this->data['item_actions']['page-delete'] = _t('delete');
        
        $this->data['fields'] = array(
            'title'=>_t('Title'),
            'template' => _t('Template'),
            'domain' => _t('Domain')
        );
        $this->data['field_filters']['title'] = function ($val,$obj) {
            return anchor('page-edit/'.$obj->id,$val);
        };
        $this->data['field_filters']['template'] = function ($val,$obj) {
            return $val ? $val->getField('name') : _t("- none -");
        };
        $this->data['field_filters']['domain'] = function ($val,$obj) {
            return anchor('page-view/'.$obj->id,$val ? : _t('- none -'),'_blank');
        };
        
        $this->view('lpcandy/base-list');
    }
    
    function page_delete($id) {
        die();
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');
        $page->delete();
        redirect('page-list');
    }
    
    function page_edit($id) {
        $page = \LPCandy\Models\Page::findOrCreate($id);
        if ($page->id && $page->user!=$this->user) redirect("/");
        
        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('title',_t('Title'),'required',$page->title);
        $form->text('domain',_t('Domain'),'',$page->domain);
        
        $templates = \LPCandy\Models\Template::findBy(array('user'=>$this->user));
        
        if (count($templates)) {
            $options = array(_t('No template') => 0);
            foreach ($templates as $t) {
                $options[$t->name] = $t;
            }
            $form->select('template',_t('Template'),$options,'',$page->template)
                ->add_filter(new \Bingo\FormFilter_DoctrineObject('LPCandy\Models\Template'));
            
            $fieldsConfig = array();        
            $getItems = function ($fields) use (&$getItems) {
                $items = array();
                foreach ($fields as $field) {
                    if ($field->name) {
                        $type = @$field->type ? : 'text';
                        $fields = @$field->fields ? : false;
                        $item = array(
                            'type'=>$type,
                            'label'=>$field->label,
                            'name'=>$field->name
                        );
                        if ($fields)
                            $item['items'] = $getItems($fields);
                        $items[] = $item;
                    }
                }
                return $items;
            };
            foreach ($templates as $tpl) {
                $items = array();
                if ($tpl && $tpl->form && $tpl->form->fields) {
                    $items = $getItems($tpl->form->fields);
                }
                $fieldsConfig[$tpl->id] = $items;
            }
            
            $this->data['fieldsConfig'] = $fieldsConfig;
            $form->hidden("custom_fields",$page->custom_fields)->add_filter(new \LPCandy\Forms\FormFilter_JSON);
            $form->submit(_t('Save page'));
            
        } else {
            $form->hidden('template','');
        }
        
        if ($form->validate()) {
            $form->fill($page);
            $page->user = $this->user;
            $page->save();
            redirect('profile');
        }
        
        $this->data['form'] = $form->get();
        $this->data['title'] = _t('Edit page');
        $this->view('lpcandy/page-edit');
    }
    
    function page_design($id) {
        $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');
        $this->data['title'] = _t('Design page');
        $this->data['tpl'] = $page->getViewTemplate();
        $this->view('lpcandy/page-design');
    }    
    
    function page_ajax($id) {
        $page = $this->data['page'] = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) redirect('/');
        $api = new \LPCandy\TemplaterApi($page);
        $api->run();
    }    
}