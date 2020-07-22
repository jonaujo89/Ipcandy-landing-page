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
     * @JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
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

    public static function getAvailableBlocks($js_path = '') {
        $js_path = $js_path ? INDEX_DIR.'/upload/CMS/shop_products/'.$js_path : INDEX_DIR.'/assets/lpcandy.min.js';
        list($cacheModified,$cacheBlocks) =  \CMS\Models\Option::get('available_blocks_cache_'.$js_path) ?: [false,[]];

        $frontendEntryFile = $js_path;
        if (!file_exists($frontendEntryFile)) {
            trigger_error(str_replace('{file_path}', $frontendEntryFlie, _t("File doesn't exist: {file_path}")));
            return $cacheBlocks;
        }

        $frontendModified = filemtime($frontendEntryFile);
        if ($cacheModified == $frontendModified) return $cacheBlocks;

        $blocks = [];
        preg_match_all("/Block.register\((?:'|\")(.*?)(?:'|\")/", file_get_contents($frontendEntryFile), $matches);
        foreach ($matches[1] as $one) $blocks[] = $one;

        \CMS\Models\Option::set('available_blocks_cache_'.$js_path,[$frontendModified,$blocks]);
        return $blocks;
    }

    function saveBlocks($blocks,$published = false) {
        $freeBlocks = $this::getAvailableBlocks();

        $bought_block_types = [];
        foreach ($this->user->getBoughtProducts() as $product) {
            $bought_block_types = array_merge($bought_block_types, $this::getAvailableBlocks($product->js_path));
        };

        $data = [];
        $unpaid_blocks = [];
        foreach ($blocks as $block) {
            $val = $block['value'];
            $id = $val['id'];
            $type = $val['type'];

            if (!in_array($type, $freeBlocks) && !in_array($type, $bought_block_types)) {
                $unpaid_blocks[] = $type;
                continue;
            }

            unset($val['id'],$val['type']);
            $data[$type."#".$id] = $val;
        }

        $pagePath = $this->getPagePath($published);
        if (!file_exists(dirname($pagePath))) mkdir(dirname($pagePath),0777,true);
        file_put_contents($pagePath,yaml_emit($data,YAML_UTF8_ENCODING));

        $alert = false;
        if (!empty($unpaid_blocks)) {
            $alert = _t("You have unpaid components, so they won't be displayed on page: ") . join(', ', array_unique($unpaid_blocks));
        }
        
        echo json_encode([
            'success' => true,
            'alert' => $alert
        ]);
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
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] =='on' ? "https://" : 'http://';
        $url = $protocol.$_SERVER['SERVER_NAME'].url('page-view/'.$this->id);
        $rasterize = APP_DIR."/modules/LPCandy/rasterize.js";
        
        $pageWidth = 1300;
        
        $cmd = 'QT_QPA_PLATFORM=offscreen phantomjs '.escapeshellarg($rasterize)." ".escapeshellarg($url)." ".escapeshellarg($screen_file)." ".$pageWidth;
        $cmd .= " > /dev/null 2>/dev/null &";
        exec($cmd);
    }
}