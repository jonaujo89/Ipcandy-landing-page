<?php

namespace LPCandy\Controllers;

class Base extends \Bingo\Controller {
    function __construct($needUser=false) {
        parent::__construct();
        $this->user = \LPCandy\Models\User::checkLoggedIn();
        $this->data['user'] = $this->user;
        
        theme_base();
        bingo_domain('lpcandy');
        
        if ($needUser) $this->needUser;
    }    
    
    function needUser() {
        if ($needUser && !$this->user) redirect('login');
    }
    
    function getPage() {
        if (isset($_GET['p'])) $page = (int)$_GET['p']; else $page = 1;if ($page<=1) $page = 1;
        return $page;
    }    
}