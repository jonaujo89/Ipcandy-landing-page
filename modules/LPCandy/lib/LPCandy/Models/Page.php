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
    
    function getUrl($sub=false) {
        $id = $this->id;
        return \LPCandy\Configuration::$base_url.'/upload/LPCandy/pages/'.$id.($sub ? "/".$sub:"");
    }
    
    function getScreenshotUrl() {
        $file = $this->getPath("publish/screenshot.png");
        if (file_exists($file)) {
            return \Bingo\ImageResizer::get_file_url($file,200,150)."?t=".filemtime($file);
        }
        return url('view/assets/images/no-screenshot.png');
    }
    
    function getTemplate() {
        return 'page';
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