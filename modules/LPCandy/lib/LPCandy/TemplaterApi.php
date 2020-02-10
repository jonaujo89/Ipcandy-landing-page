<?

namespace LPCandy;

require INDEX_DIR . "/assets/lib/templater/server/api.php";

class TemplaterApi extends \TemplaterApi {
    
    public $user;
    public $user_id;
    public $page;
    
    function __construct($page) {
        parent::__construct();
        $this->page = $page;
        $this->user = $page->user;
        $this->user_id = $page->user->getField('id');
        
        $this->settingsPath =  $this->page->getSettingsPath();
        $this->templatePath = $page->getTemplatePath();
        
        $this->base_dir = \LPCandy\Configuration::$base_dir;
        $this->base_url = \LPCandy\Configuration::$base_url;
        
        $this->uploadDir = $this->base_dir."/upload/LPCandy/files/".$this->user_id;
        $this->uploadUrl = $this->base_url."/upload/LPCandy/files/".$this->user_id;
        
        if (!file_exists($this->templatePath)) @mkdir($this->templatePath,0777,true);
        if (!file_exists($this->uploadDir)) @mkdir($this->uploadDir,0777,true);
        
        $this->modules = [];
        $this->modules[] = INDEX_DIR."/editor/components";
    }
    
    function view($name,$dataSource,$ret) {
        $this->templatePath = $this->page->getPublishPath()."/templates";
        return parent::view($name,$dataSource,$ret);
    }
    
    function makeScreenshot() {
        $path = "/screenshot.png";
        $screen_file = $this->page->getPublishPath().$path;
        $url = 'http://'.$_SERVER['SERVER_NAME'].url('page-view/'.$this->page->id);
        $rasterize = $this->base_dir."/modules/LPCandy/rasterize.js";
        
        $pageWidth = 1200;
        
        $cmd = 'phantomjs '.escapeshellarg($rasterize)." ".escapeshellarg($url)." ".escapeshellarg($screen_file)." ".$pageWidth;
        $cmd .= " > /dev/null 2>/dev/null &";
        exec($cmd);
    }
    
    function publish() {       
        $base = $this->page->getPublishPath();
        if (!file_exists($base)) mkdir($base,0777,true);
        if (!file_exists($base."/templates")) mkdir($base."/templates",0777,true);
        $this->makeScreenshot();
        $tpl = $this->page->getTemplate().".yaml";
        $tpl_path = $this->page->getTemplatePath($tpl);        
        if (file_exists($tpl_path)) {
            copy($tpl_path,$base."/templates/".$tpl);
        }
        
    }
    
    function liquid($template,$dataSource) {
        $data = (array)$this->page->custom_fields;
        $liquid = new \LiquidTemplate();
        $tpl = $liquid->parse($template);
        return $tpl->render($data);        
    }        

    function getComponents() {
        $components = parent::getComponents();
        $components = \Bingo\Action::filter('lp_components',array($components));
        return $components;
    }
    
    function registerComponent($cmp) {
        \Bingo\Action::run('lp_register_component',array($cmp));
    }
}