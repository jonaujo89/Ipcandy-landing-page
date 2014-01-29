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
    
    /** @Column(type="object") */
    public $form;    

    /**
     * @ManyToOne(targetEntity="User", inversedBy="identities")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;    
    
    function __construct() {
        $this->domain = "";
    }
    
    function getPath($sub=false) {
        return INDEX_DIR.'/upload/LPCandy/pages/'.$this->id.($sub ? "/".$sub:"");
    }
    
    function getUrl($sub=false) {
        return INDEX_URL.'/upload/LPCandy/pages/'.$this->id.($sub ? "/".$sub:"");
    }
    
    function getScreenshotUrl() {
        $file = $this->getPath("publish/screenshot.png");
        if (file_exists($file)) {
            return \Bingo\ImageResizer::get_file_url($file,200,150);
        }
        return url('view/assets/images/no-screenshot.png');
    }
    
    function getTemplatePath($sub=false) {
        return $this->getPath('templates'.($sub ? "/".$sub:""));
    }
    
    function getSettingsPath() {
        return $this->getPath('style.json');
    }
            
    function getPublishPath() {
        return $this->getPath('publish');
    }
    
    function copyFromTemplate($other) {
        $yaml = @file_get_contents($other->getTemplatePath('page.yaml'));
        $path = $this->getTemplatePath('page.yaml');
        
        $dir = dirname($path);
        if (!file_exists($dir)) mkdir($dir,0777,true);
        file_put_contents($path,$yaml);
        
        $json = @file_get_contents($other->getSettingsPath());
        $path = $this->getSettingsPath();
        $dir = dirname($path);
        if (!file_exists($dir)) mkdir($dir,0777,true);
        file_put_contents($path,$json);
        
    }
}