<?php

namespace LPCandy\Controllers;

class Base extends \CMS\Controllers\Admin\Base {
    function __construct($needUser=false) {
        parent::__construct();
        $this->user = \LPCandy\Models\User::checkLoggedIn();
        $this->data['user'] = $this->user;
        
        theme_base();
        bingo_domain('lpcandy');
        
        if ($needUser) $this->needUser();
    }    
    
    function needUser() {
        if (!$this->user) redirect('login');
    }
}