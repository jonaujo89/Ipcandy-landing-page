<?php

namespace LPCandy\Controllers;

class User extends Base {
    function login() {
        $token = @$_POST['token'];
        $redirect = @$_GET['redirect']?:'';

        if ($this->user) { redirect($redirect);return; }
        if ($token) {
            $user = \LPCandy\Models\User::login_token($token);
            if (!$user) {
                echo _t('Login error'); 
                return;
            }
            ?>
                <script>
                    var w = window.parent;
                    w.$(w.document).trigger("login",[<?=json_encode(array(
                        'id' => $user->id,
                        'login' => $user->login,
                        'name' => $user->name
                    ))?>]);
                </script>
            <?
            return;
        }
        redirect("/");
    }

    function logout() {
        if ($this->user) $this->user->logout();
        redirect('/');
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