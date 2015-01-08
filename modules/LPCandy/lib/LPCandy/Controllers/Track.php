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
            'id' => _t('№'),
            'date' => _t('date'),
            'data' => _t('data')
        );
        
        $this->data['field_filters']['data'] = function ($val) {
            
            $data;            
            $data.= "<div>Идентификатор  $val[pageId]</div>";
            $data.= "<div>IP адресс клиента  $val[ipClient]</div><br>";            
            $data.= "<div><u>Данные заявки</u></div>";            
            if(!$val['values']) return "Данных нет";
            foreach($val['values'] as $key => $value){
                if(empty($value)) $value = '<i>не заполнено</i>';
                if(is_array($value)){ 
                    $data.= "<div><b>".$key."</b>  ";
                    foreach($value as $v){
                        $data.= "<p style='text-indent: 1.5em; margin :0'>".$v."</p>";
                    }
                    $data.= "</div>";
                } else {
                    $data.= "<div><b>".$key."</b>  ".$value."</div>";
                }
            }
            
            return $data;
        };
        
        $this->data['list'] = $list;
        $this->data['title'] = _t("Tracking");
        $this->view('lpcandy/base-list');
    }
}