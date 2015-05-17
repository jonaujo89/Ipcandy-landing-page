<?php

namespace LPCandy\Controllers;

class Front extends Base {
    function __construct() {
        parent::__construct(false);
    }    
    
    function home() {
        $home_domain = \Bingo\Config::get('config','domain');
        $page = \LPCandy\Models\Page::findOneByDomain($home_domain);
        if (!$page) return true;
        
        $api = new \LPCandy\TemplaterApi($page);
        $body_html = $api->view($page->getTemplate(),false,true);

        $this->data['title'] = $page->title;
        $this->data['body_html'] = $body_html;
        $this->view('lpcandy/home');
    }

    function page_view($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page) return true;
        
        $api = new \LPCandy\TemplaterApi($page);

        $this->data['page'] = $page;
        $this->data['body_html'] = $api->view($page->getTemplate(),false,true);
        $this->view('lpcandy/page-view');
    }
    
    function track($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page) return;
        
        $track = new \LPCandy\Models\Track;
        $track->user = $page->user;        
        $track->page = $page;
        $track->page_title = $page->title;
        $track->ip = $_SERVER['REMOTE_ADDR'];
        $track->save();
        
        $values = json_decode($_POST['form'],true);
        
        foreach ($values as $one_idx => $one) {
            $value = $one['value'];
            if (is_array($value)) {
                
                $uploadDir = INDEX_DIR."/upload/LPCandy/track/".$track->id;
                if (!file_exists($uploadDir)) mkdir($uploadDir,0777,true);
                
                foreach ($value as $idx=>$name) {
                    $link = false;
                    $file_data = @$_FILES[$name];
                    if ($file_data) {
                        $error = $file_data['error'];
                        if ($error==UPLOAD_ERR_OK) {
                            $file_name = $file_data['name'];
                            $tmp_name = $file_data['tmp_name'];
                            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                            $dest = time()."_".uniqid() . ($ext ? ".".$ext : "");
                            move_uploaded_file($tmp_name, $uploadDir. "/" .$dest);
                            $link = array('src'=>$file_name,'dest'=>$dest);
                        }
                    }
                    $values[$one_idx]['value'][$idx] = $link;
                }
            }
        }
        
        $track->data = array('values'=>$values);
        $track->save();
        
        Email::get()->sendTrackNotification($track);
        echo "ok";      
    }
}