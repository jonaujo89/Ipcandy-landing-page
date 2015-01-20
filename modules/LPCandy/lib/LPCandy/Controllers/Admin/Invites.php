<?php

namespace LPCandy\Controllers\Admin;

class Invites extends \CMS\Controllers\Admin\BasePrivate {
    function __construct() {
        parent::__construct();
        bingo_domain('lpcandy');
    }
    
    function invite_list() {
     
        $_GET['sort_by'] = @$_GET['sort_by']?:'user';
        $_GET['sort_order'] = @$_GET['sort_order']?:'ASC';        
        $query = \LPCandy\Models\Invite::findByQuery(array(),$_GET['sort_by'].' '.$_GET['sort_order']);
        
        $pagination = new \Bingo\Pagination(30,$this->getPage(),false,false,$query);
        
        $this->data['list'] = $pagination->result();
        $this->data['pagination'] = $pagination->get();
        $this->data['title'] = _t("Invites list");

        $this->data['list_actions']['delete'] = array(
            'title' => _t('Delete selected'),
            'function' => $this->action_delete('\LPCandy\Models\Invite')
        );
        $this->data['page_actions']['admin/lpcandy/invite-add'] = _t("Add Invites");
        
        $this->data['fields'] = array(
            'id' => _t('#'),            
            'code' => _t('Invite code'),
            'user' => _t('User')
        );   
        $this->data['field_filters']['user'] = function ($val) {
            if (!$val) return _t('-');
            return "{$val->name} ({$val->id})";
        };

        $this->data['sort_fields'] = array('id','code','user');        
        $this->view('cms/base-list');
    }
        
    function invite_add() {     
        $form = new \Bingo\Form;
        $form->text('count',_t('Invite count'),array('required','numeric'), 5);
        $form->submit(_t('Add invites'));
        
        if ($form->validate()) {
            $count = $form->values['count'];
            for ($i=0;$i<$count;$i++) {
                $invite = \LPCandy\Models\Invite::generate();
                $invite->save();
            }
            redirect('admin/lpcandy/invite-list');
        }
        
        $this->data['page_actions']['admin/lpcandy/invite-list'] = _t("Back to invite list");
        $this->data['form'] = $form->get();
        $this->data['title'] = _t('Add Invites');
        $this->view('cms/base-edit');
    }
}