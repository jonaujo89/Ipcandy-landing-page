<?php

namespace LPCandy\Controllers;

class Admin extends \CMS\Controllers\Admin\BasePrivate {
    function __construct() {
        parent::__construct();
        bingo_domain('lpcandy');
    }
    
    function user_list() {
        $query = \LPCandy\Models\User::findByQuery(array(),'id ASC');
        
        $pagination = new \Bingo\Pagination(20,$this->getPage(),false,false,$query);
        
        $this->data['list'] = $pagination->result();
        $this->data['pagination'] = $pagination->get();
        $this->data['title'] = _t("User list");

        $this->data['item_actions']['admin/lpcandy/user-login'] = _t('login as user');
        
        $this->data['fields'] = array(
            'id' => _t('#'),
            'name' => _t('name'),
            'login' => _t('login')
        );
        $this->view('cms/base-list');
    }
    
    function user_login($id) {
        $user = \LPCandy\Models\User::find($id);
        if ($user) \LPCandy\Models\User::loginUser($user);
        redirect('');
    }

    function entity_list() {
        $query = \LPCandy\Models\EntityType::findByQuery(array(),'id ASC');
        
        $pagination = new \Bingo\Pagination(20,$this->getPage(),false,false,$query);
        
        $this->data['list'] = $pagination->result();
        $this->data['pagination'] = $pagination->get();
        $this->data['title'] = _t("Entity list");

        $this->data['page_actions']['admin/lpcandy/entity-edit'] = _t('Create');
        $this->data['item_actions']['admin/lpcandy/entity-edit'] = _t('edit');
        
        $this->data['fields'] = array(
            'id' => _t('#'),
            'name' => _t('Type'),
            'public_create' => _t('Public create'),
            'public_edit' => _t('Public edit'),
            'public_read' => _t('Public read'),
            'upload' => _t('Upload files'),
        );

        foreach(['public_create','public_read','public_edit','upload'] as $one) {
            $this->data['field_filters'][$one] = function ($val) { return $val ? '☑':'☐'; };
        }

        $this->view('cms/base-list');
    }

    function entity_edit($id) {
        $entityType = \LPCandy\Models\EntityType::findOrCreate($id);

        $form = new \Bingo\Form;
        $form->fieldset()
            ->text('name',_t('Type'),'required',$entityType->name)
            ->checkbox('public_create', _t('Public create'),'',$entityType->public_create)
            ->checkbox('public_edit', _t('Public edit'),'',$entityType->public_edit)
            ->checkbox('public_read', _t('Public read'),'',$entityType->public_read)
            ->checkbox('upload', _t('Upload files'),'',$entityType->upload);

        $form->fieldset()
                ->submit(_t('Save'))->add_class("inline single");
        
        if ($form->validate()) {
            $form->fill($entityType);
            
            $entityType->save();
            return redirect("admin/lpcandy/entity-list");
        }
        $this->data['title'] = _t("Entity edit");
        $this->data['form'] = $form->get();
        $this->view('cms/base-edit',$this->data);
    }

    function component_list() {
        $query = \LPCandy\Models\ShopProduct::findByQuery(array(),'id ASC');
        
        $pagination = new \Bingo\Pagination(20,$this->getPage(),false,false,$query);
        
        $this->data['list'] = $pagination->result();
        $this->data['pagination'] = $pagination->get();
        $this->data['title'] = _t("Component list");

        $this->data['page_actions']['admin/lpcandy/component-edit'] = _t('Create');
        $this->data['item_actions']['admin/lpcandy/component-edit'] = _t('edit');
        
        $this->data['fields'] = array(
            'id' => _t('#'),
            'thumbnail' => _t('Thumbnail'),
            'title' => _t('Title'),
            'excerpt' => _t('Short description'),
            'price' => _t('Price')." $",
            'created' => _t('Created'),
        );

        $this->data['field_filters']['thumbnail'] = function ($val, $obj) { return "<img src='".$obj->getThumbnailUrl(100,100)."' alt='' />"; };

        $this->view('cms/base-list');
    }

    function component_edit($id) {
        $component = \LPCandy\Models\ShopProduct::findOrCreate($id);

        $form = new \Bingo\Form;
        $form->fieldset(_t("Info"))
            ->text('title',_t('Title'),'required',$component->title)
            ->text('excerpt',_t('Short description'),'required',$component->excerpt)
            ->textarea('description',_t('Description'),'',$component->description,array('rows'=>20))->add_class("tinymce")
            ->text('thumbnail',_t('Thumbnail'),'',$component->thumbnail)->add_class('browse_file')
            ->text('price',_t('Price'),['required','numeric','positive'],$component->price)
            ->text('js_path',_t('JS bundle file'),'required',$component->js_path)->add_class('browse_file')
            ->text('css_path',_t('CSS bundle file'),'required',$component->css_path)->add_class('browse_file');

        $form->fieldset()
                ->submit(_t('Save component'))->add_class("inline single");
        
        if ($form->validate()) {
            $form->fill($component);
            
            $component->save();
            return redirect("admin/lpcandy/component-list");
        }
        $this->data['title'] = _t("Component edit");
        $this->data['form'] = $form->get();
        $this->view('cms/base-edit-tinymce',$this->data);
    }
     
    function extra_code() { 
        $extraCode = \CMS\Models\Option::get('extra_code') ?? ''; 
 
        $form = new \Bingo\Form; 
        $form->fieldset(_t("Extra code (Yandex.Metrica,AdWords,etc)")); 
        $form->textarea('extra_code','',false,$extraCode,array('rows'=>20)); 
        $form->submit('save'); 
 
        if ($form->validate()) { 
            \CMS\Models\Option::set('extra_code', $form->values['extra_code']); 
            redirect('admin/lpcandy/extra-code'); 
        } 
 
        $this->data['title'] = _t("Extra code"); 
        $this->data['form'] = $form->get(); 
        $this->view('cms/base-edit',$this->data); 
    } 
}