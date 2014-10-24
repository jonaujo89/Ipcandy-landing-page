<?

namespace LPCandy;

require BINGO_PATH . "/../templater/lib/server/api.php";

class TemplaterApi extends \TemplaterApi {
    
    public $user;
    public $user_id;
    public $page;
    
    function __construct($page) {
        parent::__construct();
        $this->base_url = "/~boomyjee";
        $this->base_dir = realpath(BINGO_PATH."/..");
        $this->page = $page;
        $this->user = $page->user;
        $this->user_id = $page->user->getField('id');
        
        $this->settingsPath =  $this->page->getSettingsPath();
        $this->templatePath = $page->getTemplatePath();
        
        $this->uploadDir = INDEX_DIR."/upload/LPCandy/files/".$this->user_id;
        $this->uploadUrl = INDEX_URL."/upload/LPCandy/files/".$this->user_id;
        
        if (!file_exists($this->templatePath)) mkdir($this->templatePath,0777,true);
        if (!file_exists($this->uploadDir)) mkdir($this->uploadDir,0777,true);
        
        $this->modules = array();
        $this->modules[] = INDEX_DIR."/templater_modules/lpcandy";
    }
    
    function publish() {
        $files = $_REQUEST['files'];
        $base = $this->page->getPublishPath();
        if (!file_exists($base)) mkdir($base,0777,true);
        
        foreach ($files as $path=>$text) {
            if ($path=='/screenshot.png') {
                if ($this->page->parent) {
                    $path = "/screenshot-child-".$this->page->id.".png";
                }
            }
            
            $path = $base.$path;
            
            $mark = "data:image/png;base64,";
            if (strpos($text,$mark)===0)
                $text = base64_decode(substr($text,strlen($mark)));
            
            $res = file_put_contents($path,$text);
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