<?php

namespace LPCandy\Controllers;

class User extends Base {
    function login() {
        $token = @$_POST['token'];
        $redirect = @$_GET['redirect']?:'page-list';

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
    
    function files($url=false) {
        $this->needUser();
        
        $page = new \LPCandy\Models\Page();
        $page->id = 0;
        $page->user = $this->user;
        
        if ($url) $_REQUEST['url'] = "/".$url;

        $api = new \LPCandy\TemplaterApi($page);
        $api->browse();
    }
}