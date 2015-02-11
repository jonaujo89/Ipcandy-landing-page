<?php

namespace LPCandy\Controllers;

class Track extends Base {
    function __construct() {
        parent::__construct(true);
    }    
    
    function track_list() {
        
        $filter_form = new \CMS\FilterForm;
        $filter_form->text('ip',false);
        
        $status_options_for_filter = array(
            '' => '',
            'новая' => 'new', 
            'в работе' => 'processing', 
            'выполнена' => 'done', 
            'отменена' => 'cancelled'
        );     
        $filter_form->select('status','',$status_options_for_filter,'');
        
        $pages = \LPCandy\Models\Page::findBy(array('user'=>$this->user));
        $all_title_array = array(""=>"");
        for($i=0; $i < count($pages); $i++){
            $val = $pages[$i]->title;
            $all_title_array[$val] = $val;
        }
        $title_options_for_filter = array_unique($all_title_array); 
        $filter_form->select('page_title','',$title_options_for_filter,'');

        $this->data['filter_form'] = $filter_form;
        
        $criteria = array('user'=>$this->user);
        if ($filter_form->validate()) {
            if ($filter_form->values['ip']) $criteria['ip'] = 'LIKE %'.$filter_form->values['ip'].'%';
            if ($filter_form->values['page_title']) $criteria['page_title'] = $filter_form->values['page_title'];
            if ($filter_form->values['status']) $criteria['status'] = $filter_form->values['status'];
        }
        
        $_GET['sort_by'] = @$_GET['sort_by']?:'id';
        $_GET['sort_order'] = @$_GET['sort_order']?:'DESC';
        
        $query = \LPCandy\Models\Track::findByQuery($criteria,$_GET['sort_by'].' '.$_GET['sort_order']);
        
        $pagination = new \Bingo\Pagination(5,$this->getPage(),false,false,$query);
        $this->data['list'] = $pagination->result();
        $this->data['pagination'] = $pagination->get();
        $this->data['title'] = _t("Tracking");

        $this->data['item_actions']['track-delete'] = _t('delete');        
        $this->data['list_actions']['delete'] = array(
            'title' => _t('Delete selected'),
            'function' => $this->action_delete('\LPCandy\Models\Track')
        );  
        
        $this->data['fields'] = array(
            'id' => _t('#'),
            'page_title' => _t('page'),
            'status' => _t('status'),
            'date' => _t('date'),
            'ip' => _t('ip'),
            'data' => _t('data')
        );
        
        $this->data['sort_fields'] = array('id','page_title','status','date','ip');
        
        $this->data['field_filters']['page'] = function ($page,$obj) {
            if (!$page) return $obj->page_title;
            return anchor('page-design/'.$page->getField('id'),$page->title);
        };
        
        $this->data['field_filters']['status'] = function ($val,$obj) {
            $status_options = array(
                'new' => 'новая', 
                'processing' => 'в работе', 
                'done' => 'выполнена', 
                'cancelled' => 'отменена'
            );
            $ret = "<select data-id='{$obj->id}'>";
            foreach ($status_options as $status=>$label) {
                $selected = $status==$val ? 'selected':'';
                $ret .= "<option $selected value='$status'>$label</option>";
            }
            $ret .= "</select>";
            return $ret;
        };
        
        $this->data['field_filters']['data'] = function ($val,$track) {            
            if(!$val['values']) return "Данных нет";
            $data = "";
            foreach($val['values'] as $one) {            
                $sub = $one['value'];
                if (is_bool($sub)) $sub = $sub ? _t('yes') : _t('no');
                if (is_array($sub)) {
                    $files_str = array();
                    foreach ($sub as $f) {
                        if(isset($f['src']) && !empty($f['src']) && isset($f['dest']) && !empty($f['dest']) ){
                            $files_str[] = anchor('track-file/'.$track->id.'?file='.urlencode($f['dest'])."&name=".urlencode($f['src']),$f['src']);
                        }
                    }
                    $sub = implode(", ",$files_str);
                }
                $data.="<b>".$one['label'].": </b>".$sub."<br>";
            }
            return $data;
        }; 
        
        $this->view('lpcandy/base-list');
    }
    
    function track_file($id) {
        $track = \LPCandy\Models\Track::find($id);
        if ($track->user!=$this->user) return;
        
        $uploadDir = realpath(INDEX_DIR."/upload/LPCandy/track/".$track->id);
        if (!$uploadDir) return true;
        
        $file = realpath($uploadDir."/".$_GET['file']);

        if (!$file || !file_exists($file)) return true;
        if (realpath(dirname($file))!=$uploadDir) return true;
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$_GET['name']);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);        
    }
    
    function track_update_status($id) {
        $track = \LPCandy\Models\Track::find($id);
        if ($track->user!=$this->user) return true;
        
        if(isset($_POST['status']) && !empty($_POST['status'])){
            $track->status = $_POST['status'];
            $track->save();
            echo 'ok';
        }
    }
    
    function track_delete($id) {
        $track = \LPCandy\Models\Track::find($id);
        if ($track->user!=$this->user) return true;
        
        $track_id = $track->id;
        $track->delete();
        
        $dir = INDEX_DIR."/upload/LPCandy/track/".$track_id;
        if (is_dir($dir)) {
            $it = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new \RecursiveIteratorIterator($it,\RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($dir);
        }
        
        redirect(@$_SERVER['HTTP_REFERER']?:'track-list');
    }
}