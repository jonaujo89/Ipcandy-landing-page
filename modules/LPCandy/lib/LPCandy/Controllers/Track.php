<?php

namespace LPCandy\Controllers;

class Track extends Base {
    function __construct() {
        parent::__construct(true);
    }    
    
    function track_list() {
        $top = array();
        $list = \LPCandy\Models\Track::findBy(array('user'=>$this->user));
        
        $this->data['fields'] = array(
            'id' => _t('#'),
            'date' => _t('date'),
            'data' => _t('data')
        );
        
        $this->data['field_filters']['data'] = function ($val) {
            return "<pre>".print_r($val,true)."</pre>";
        };
        
        $this->data['list'] = $list;
        $this->data['title'] = _t("Tracking");
        $this->view('lpcandy/base-list');
    }
}