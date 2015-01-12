<?php

namespace LPCandy\Controllers;

class Track extends Base {
    function __construct() {
        parent::__construct(true);
        $this->needUser();
    }    
    
    function track_list() {
        $top = array();
        
        $filter_form = new \CMS\FilterForm;
        $filter_form->text('ip',false);
        $this->data['filter_form'] = $filter_form;
        
        $criteria = array('user'=>$this->user);
        if ($filter_form->validate()) {
            if ($filter_form->values['ip']) $criteria['ip'] = 'LIKE %'.$filter_form->values['ip'].'%';
        }
        
        $_GET['sort_by'] = @$_GET['sort_by']?:'id';
        $_GET['sort_order'] = @$_GET['sort_order']?:'DESC';
        
        $query = \LPCandy\Models\Track::findByQuery($criteria,$_GET['sort_by'].' '.$_GET['sort_order']);
        
        $this->data['item_actions']['track-delete'] = _t('delete');
        $this->data['list_actions']['delete'] = array(
            'title' => _t('Delete selected'),
            'function' => $this->action_delete('\LPCandy\Models\Track')
        );
        
        $this->data['fields'] = array(
            'id' => _t('#'),
            'status' => _t('status'),
            'date' => _t('date'),
            'ip' => _t('ip'),
            'data' => _t('data')
        );
        $this->data['sort_fields'] = array('id','status','date','ip');
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
    
    function track_delete($id) {
        $track = \LPCandy\Models\Track::find($id);
        if ($track->user!=$this->user) return;
        
        $track->delete();
        redirect(@$_SERVER['HTTP_REFERER']?:'track-list');
    }
}