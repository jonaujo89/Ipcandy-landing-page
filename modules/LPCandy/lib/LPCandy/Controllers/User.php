<?php

namespace LPCandy\Controllers;

class User extends Base {
    function login() {
        $token = @$_POST['token'];
        $redirect = @$_GET['redirect'];

        if ($this->user) { redirect($redirect);return; }
        if ($token) {
            $token_data = \LPCandy\Models\User::token_data($token);
            $user = \LPCandy\Models\User::login_token($token_data,false);
            if ($user) {
                redirect($redirect);
                return;
            } else {
                $data = new \Session\SessionNamespace('login');
                $data->token_data = $token_data;
                redirect('get-invite?redirect='.urlencode($redirect));
            }
        }
        $this->data['title'] = _t("Login");
        $this->view('lpcandy/login');
    }
    
    function get_invite() {
        $data = new \Session\SessionNamespace('login');
        $token_data = $data->token_data;
        if (!$token_data) redirect('login');
        
        $invite = false;
        $form = new \Form;
        $form->fieldset();
        $form->text('code',_t('Please, enter your invite code'),function($code) use (&$invite) {
            $invite = \LPCandy\Models\Invite::findOneByCode(trim($code));
            if (!$invite || $invite->user) throw new \ValidationException(_t('Wrong invite code'));
            return $code;
        });
        $form->fieldset();
        $form->submit(_t('Register'));
        
        if ($form->validate()) {
            $user = \LPCandy\Models\User::login_token($token_data);
            $invite->user = $user;
            $invite->save();
            redirect($redirect = @$_GET['redirect']);
        }
        
        $this->data['title'] = _t('Enter your invite');
        $this->data['form'] = $form->get();
        $this->view('lpcandy/base-edit');
    }    

    function logout() {
        if ($this->user) $this->user->logout();
        redirect('/');
    }    
    
    function profile() { 
        $this->needUser();
        
        $user = \LPCandy\Models\User::find($this->user);

        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('email',_t('Your email'),"required",$user->email);
        $form->fieldset();
        $form->submit(_t('Save'));
                
        if($form->validate()){
            $user->email = $form->values['email'];
            $user->save();
        }       
        
        $this->data['title'] = _t('Profile');
        $this->data['form'] = $form->get();
        
        $this->view('lpcandy/page-edit');
        
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