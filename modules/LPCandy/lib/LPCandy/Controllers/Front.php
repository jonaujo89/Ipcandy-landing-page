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
        $assets = url('upload/LPCandy/pages/'.$page->id."/publish");
        $body_html = $api->view($page->getTemplate(),false,true);

        $this->data['title'] = $page->title;
        $this->data['assets'] = $assets;
        $this->data['body_html'] = $body_html;
        $this->view('lpcandy/home');
    }

    function page_view($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page) return true;
        
        $api = new \LPCandy\TemplaterApi($page);
        
        $id = $page->parent ? $page->parent->getField('id') : $page->id;
        $assets = url('upload/LPCandy/pages/'.$id."/publish");
        $url_ymaps = url('upload/LPCandy/pages/'.$id."/publish");
        
        $body_html = $api->view($page->getTemplate(),false,true);
        
        ?>
            <!doctype html>
            <html>
            <head>
                <meta charset="utf-8" />
                <meta name="robots" content="<?= htmlspecialchars(str_replace(array("'","\""), "",$page->meta_robots), ENT_QUOTES)?>">
                <meta name="keywords" content="<?= htmlspecialchars(str_replace(array("'","\""), "",$page->meta_keywords), ENT_QUOTES)?>">
                <meta name="description" content="<?= htmlspecialchars(str_replace(array("'","\""), "", $page->meta_description), ENT_QUOTES)?>">
                <title><?= $page->title ?></title>
                <script>
                    var base_url = "<?=INDEX_URL?>";
                    var page_id = <?=$page->id?>; 
                </script>
                <link rel="stylesheet" type="text/css" href="<?=url('view/editor/style/style.min.css')?>">
                <script src="<?=url('view/editor/style/style.min.js')?>"> </script>    
                <script>
                    function SubmitJS(){
                        <?= strip_tags($page->extra_html_submit) ?>
                    }
                </script>
            </head>                
                <body>
                    <?= $body_html ?>
                    <?= $page->extra_html?>
                </body>
            </html>
        <?
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
        
        $user = \LPCandy\Models\User::find($this->user);   
        //$send_mail = Mail::send($user->email); 
        //mail($user->email, "Lpcandy", "У Вас новая заявка", "From: lpcandy.beejee@gmail.com");

        echo "ok";      
    }
}