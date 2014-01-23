<?php

namespace LPForms\Controllers;

class Profile extends \Bingo\Controller {
    function __construct() {
        theme_base();
        $this->user = \LPCandy\Models\User::checkLoggedIn();
        $this->data['user'] = $this->user;
        if (!$this->user) redirect('/');
    }
    
    function forms() {
        $list = \LPForms\Models\Track::findByUser($this->user->id);
        
        $this->data['list'] = $list;
        $this->data['fields'] = array('id'=>_t('#'),'date'=>_t('date'),'data'=>_t('data'));
        $this->data['field_filters']['data'] = function ($val) {
            $ret = "<table>";
            foreach ($val as $one) {
                $cmp = $one['component'];
                $ret .= "<tr>";
                $ret .= "<td>".($cmp->value->label ?:$cmp->value->name)."</td>";
                $ret .= "<td>".$one['value']."</td>";
                $ret .= "</tr>";
            }
            $ret .= "</table>";
            return $ret;
        };
        $this->data['title'] = _t('Form submissions');
        $this->view('lpcandy/base-list');
    }
}