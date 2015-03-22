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
    
    function paginationFixOverflow($pagination) {
        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $page_count = $pagination->getPageCount() ?:1;
        if ($page<1 || $page > $page_count) {
            $page = min(max(1,$page),$page_count);
            $pattern = ($page==1) ? $pagination->pattern[0] : $pagination->pattern[1];
            $link = str_replace("{page}",$page,$pattern);
            redirect($link);
        }
    }
}