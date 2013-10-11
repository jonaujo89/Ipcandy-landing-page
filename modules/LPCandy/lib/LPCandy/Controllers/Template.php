<?php

namespace LPCandy\Controllers;

class Template extends Base {
    function __construct() {
        parent::__construct(true);
    }
    
    function tpl_list() {
        $this->data['list'] = \LPCandy\Models\Template::findByUser($this->user->id);
        $this->data['title'] = _t("Templates");
        
        $this->data['page_actions']['tpl-edit'] = _t('New Template');
        $this->data['item_actions']['tpl-edit'] = _t('edit');
        $this->data['item_actions']['tpl-delete'] = _t('delete');
        
        $this->data['fields'] = array(
            'name'=>_t('Name')
        );
        $this->data['field_filters']['title'] = function ($val,$obj) {
            return anchor('tpl-edit/'.$obj->id,$val);
        };
        
        $this->view('lpcandy/base-list');
    }
    
    function tpl_delete($id) {
        $tpl = \LPCandy\Models\Template::find($id);
        if (!$tpl || $tpl->user!=$this->user) redirect('/');
        $tpl->delete();
        redirect('tpl-list');
    }    
    
    function tpl_edit($id) {
        $tpl = \LPCandy\Models\Template::findOrCreate($id);
        if ($tpl->id && $tpl->user!=$this->user) redirect("/");
        
        $form = new \Form;
        $form->text('name',_t('Name'),'required',$tpl->name);
        $form->add(new \LPCandy\Forms\JSControl(array(
            'config' => array(
                'items' => array( 
                    array('type' => 'formRepeater', 'name' => 'fields','label'=>_t('Data Fields'))
                )
            ),
            'value' => $tpl->form,
            'name' => 'form'
        )));
        $form->submit(_t('Save fields'));
        
        $this->data['title'] = _t('Edit template');
        $this->data['form'] = $form->get();
        
        if ($form->validate()) {
            $form->fill($tpl);
            $tpl->user = $this->user;
            $tpl->save();
            redirect('tpl-list');
        }
        $this->view('lpcandy/tpl-edit');
    }    
}