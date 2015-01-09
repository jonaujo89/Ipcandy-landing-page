<?php

namespace LPCandy\Controllers;

class Track extends Base {
    function __construct() {
        parent::__construct(true);
    }    
    
    function track_list() {
        $top = array();
        
        $filter_form = new \CMS\FilterForm;
        $filter_form->text('ip',false);
        
        $this->data['filter_form'] = $filter_form;
        
        $query = \LPCandy\Models\Track::findByQuery(array('user'=>$this->user),'id DESC');
        
        $this->data['fields'] = array(
            'id' => _t('№'),
            'status' => _t('status'),
            'date' => _t('date'),
            'ip' => _t('ip'),
            'data' => _t('data')
        );
        
        $this->data['field_filters']['data'] = function ($val) {
            if(!$val['values']) return "Данных нет";
            foreach($val['values'] as $one) {            
                $sub = $one['value'];
                if (is_bool($sub)) $sub = $sub ? 'true' : 'false';
                $data.="<b>".$one['label'].":</b> ".$sub."<br>";
            }
            return $data;
        };
        
        $pagination = new \Bingo\Pagination(5,$this->getPage(),false,false,$query);
        
        $this->data['list'] = $pagination->result();
        $this->data['pagination'] = $pagination->get();
        $this->data['title'] = _t("Tracking");
        $this->view('lpcandy/base-list');
    }
}