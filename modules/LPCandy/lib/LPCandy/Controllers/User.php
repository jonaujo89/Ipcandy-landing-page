<?php

namespace LPCandy\Controllers;

class User extends Base {
    function login() {
        $token = @$_POST['token'];
        $redirect = @$_GET['redirect'];

        if ($this->user) { redirect($redirect);return; }
        if ($token) {
            $user = \LPCandy\Models\User::login_token($token);
            if ($user) {
                redirect($redirect);
                return;
            }
        }
        $this->data['title'] = _t("Login");
        $this->view('lpcandy/login');
    }

    function logout() {
        if ($this->user) $this->user->logout();
        redirect('login');
    }    
    
    function profile() {
        redirect('page-list');
    }    
    
    function files() {
        $this->needUser();
        
        $config = array();
        $config['_tinyMCEPath'] = url('view/assets/script/tinymce');
        $path = 'upload/LPCandy/files/'.$this->user->id;
        
        if (!file_exists(INDEX_DIR."/".$path)) mkdir(INDEX_DIR."/".$path,0777,true);
        \FileManager::view($path,$config);
    }    
}