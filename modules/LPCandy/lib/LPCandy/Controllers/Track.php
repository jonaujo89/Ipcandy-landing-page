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
            
            $data.= "<div>Идентификатор  ".$val['pageId']."</div>";
            $data.= "<div>IP адресс клиента  ".$val['ipClient']."</div><br>";            
            $data.= "<div><u>Данные заявки</u></div>";            
            if(!$val['values']) return "Данных нет";
            foreach($val['values'] as $field_name => $values){                
                $data.= "<p style='text-indent: 0.5em; margin :0'> <b>".$field_name."</b> (".$values['type'].")</p>";
                    foreach($values['value'] as $value){
                        if(empty($value)) $value = '<i>- пусто -</i>';
                        $data.= "<p style='text-indent: 1.0em; margin :0'><span class='".$values['symbol']."'></span> ".$value."</p>";
                    }                    
                $data.= "</div>";
            }
            
            return $data;
        };
        
        $this->data['list'] = $list;
        $this->data['title'] = _t("Tracking");
        $this->view('lpcandy/base-list');
    }
}