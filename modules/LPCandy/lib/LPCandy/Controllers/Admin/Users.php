<?php

namespace LPCandy\Controllers\Admin;

class Users extends \CMS\Controllers\Admin\BasePrivate {
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
}