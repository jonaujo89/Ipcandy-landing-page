<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_pages")
*/
class Page extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(length=256) */
    public $title;    
    
    /** @Column(length=1024) */
    public $domain; 
    
    /** @Column(length=1024) */
    public $pathname;
    
    /** @Column(type="string") */
    public $meta_robots;
    
    /** @Column(type="string") */
    public $meta_keywords;
    
    /** @Column(type="string") */
    public $meta_description;
    
    /** @Column(type="boolean", options={"default":true}) */
    public $is_responsive;
    
    /** @Column(type="text") */
    public $extra_html;   
    
    /** @Column(type="text") */
    public $extra_html_submit;    
    
    /** @Column(type="object") */
    public $form;    
    
    /**
     * @ManyToOne(targetEntity="Page", inversedBy="children")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     */
    public $parent;    
    
    /**
     * @OneToMany(targetEntity="Page", mappedBy="parent")
     */
    public $children;    

    /**
     * @ManyToOne(targetEntity="User", inversedBy="identities")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;    
    
    function __construct() {
        $this->domain = "";
        $this->pathname = "";
        $this->meta_robots = "";        
        $this->meta_keywords = "";
        $this->meta_description = "";
        $this->is_responsive = true;
        $this->extra_html = "";
        $this->extra_html_submit = "";
    }
    
    function getPath($sub=false) {
        $id = $this->id;
        return \LPCandy\Configuration::$base_dir.'/upload/LPCandy/pages/'.$id.($sub ? "/".$sub:"");
    }

    function getPagePath($published) {
        return $published ? $this->getPath("publish/templates/page.yaml") : $this->getPath("templates/page.yaml");        
    }
    
    function getScreenshotUrl() {
        $file = $this->getPath("publish/screenshot.png");
        if (file_exists($file)) {
            return \Bingo\ImageResizer::get_file_url($file,200,150)."?t=".filemtime($file);
        }
        return url('assets/images/no-screenshot.png');
    }
    
    function copyFromTemplate($other) {
        $yaml = @file_get_contents($other->getPagePath($published = true));
        $path = $this->getPagePath($published = false);
        
        $dir = dirname($path);
        if (!file_exists($dir)) mkdir($dir,0777,true);
        file_put_contents($path,$yaml);
    }

    function loadBlocks($published = false) {
        $blocks = [];
        $pagePath = $this->getPagePath($published);
        if (file_exists($pagePath)) {
            $data = yaml_parse_file($pagePath);
            foreach ($data as $key=>$block_value) {
                list($type,$id) = explode('#',$key,2);
                $blocks[] = ['value' => array_merge(['id'=>$id,'type'=>$type],$block_value)];
            }
        }
        return $blocks;
    }

    function saveBlocks($blocks,$published = false) {
        $data = [];
        foreach ($blocks as $block) {
            $val = $block['value'];
            $id = $val['id'];
            $type = $val['type'];
            unset($val['id'],$val['type']);
            $data[$type."#".$id] = $val;
        }

        $pagePath = $this->getPagePath($published);
        if (!file_exists(dirname($pagePath))) mkdir(dirname($pagePath),0777,true);
        file_put_contents($pagePath,yaml_emit($data,YAML_UTF8_ENCODING));
    }

    function publish($blocks,$html) {
        $this->saveBlocks($blocks,$published = true);
        file_put_contents($this->getPath("publish/page.html"),$html);
        $this->makeScreenshot();
    }

    function getPublishedHtml() {
        $path = $this->getPath("publish/page.html");
        return file_exists($path) ? file_get_contents($path) : "";
    }

    function makeScreenshot() {
        $screen_file = $this->getPath("publish/screenshot.png");
        $url = 'http://'.$_SERVER['SERVER_NAME'].url('page-view/'.$this->id);
        $rasterize = APP_DIR."/modules/LPCandy/rasterize.js";
        
        $pageWidth = 1300;
        
        $cmd = 'QT_QPA_PLATFORM=offscreen phantomjs '.escapeshellarg($rasterize)." ".escapeshellarg($url)." ".escapeshellarg($screen_file)." ".$pageWidth;
        $cmd .= " > /dev/null 2>/dev/null &";
        exec($cmd);
    }

    function upload($name,$iconWidth,$iconHeight) {
        
        $uploadDir = INDEX_DIR."/upload/LPCandy/files/".$this->user->id;
        $uploadUrl = INDEX_URL."/upload/LPCandy/files/".$this->user->id;

        $res = array();
        if ($name && strpos($name,"..")===false) {

            $dir = $uploadDir."/".$name;
            $tdir = $uploadDir."/.thumbs/".$name;
            
            if (!file_exists($dir)) mkdir($dir,0777,true);
            if (!file_exists($tdir)) mkdir($tdir,0777,true);
            
            foreach ($_FILES as $key=>$val) {
                $error = $val['error'];
                if ($error==UPLOAD_ERR_OK) {
                    $name = $val['name'];
                    $tmp_name = $val['tmp_name']; 
                    
                    $info = pathinfo($name); 
                    if (!isset($info['extension'])) {
                        $res[] = array('error'=>_t('File is invalid'));
                        continue;
                    }

                    if (!in_array(strtolower($info['extension']), ["jpg","jpeg","png","gif"])) {
                        $res[] = array('error'=>_t('Wrong image format'));
                        continue;
                    }

                    $ext = ".".$info['extension'];
                    $filename = $info['filename'];
                    $dest = $filename.$ext; 
                    
                    if (file_exists("$dir/$dest")) {
                        $counter = 2;
                        do {
                           $dest = $filename."($counter)".$ext;
                           $counter++;
                        } while (file_exists("$dir/$dest"));
                    }
                    move_uploaded_file($tmp_name,"$dir/$dest");
                    
                    $file = \PhpThumb\Factory::create($dir."/".$dest,array('resizeUp'=>false));
                    $file->resize($iconWidth,$iconHeight);
                    
                    $thumb = basename($dest,$ext).".png";
                    $file->save($tdir."/".$thumb);    
                    
                    $url = str_replace(INDEX_DIR,INDEX_URL,$dir."/".$dest);
                    $turl = str_replace(INDEX_DIR,INDEX_URL,$tdir."/".$thumb);
                    
                    $res[] = array('name'=>$dest,'url'=>$url,'icon'=>$turl);
                } else {
                    if ($error == UPLOAD_ERR_FORM_SIZE || $error == UPLOAD_ERR_INI_SIZE) {
                        $res[] = array('error'=>str_replace('{max_size}',ini_get("upload_max_filesize"),_t('File is too large. Maximum upload size is {max_size}')));
                    } else if ($error == UPLOAD_ERR_NO_FILE) {
                        $res[] = array('error'=>_t("No file was uploaded"));
                    } else {
                        $res[] = array('error'=>_t("Upload error. Try again later"));
                    }
                }
            }
        }        
        return $res;       
    }
}