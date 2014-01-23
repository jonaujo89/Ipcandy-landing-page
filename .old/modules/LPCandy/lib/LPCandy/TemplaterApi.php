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
        
        $this->dirPath = INDEX_DIR."/upload/LPCandy/templates/".$this->user_id;

        $this->settingsPath = $this->dirPath."/".$page->getViewTemplate().".json";
        $this->templatePath = $this->dirPath."/theme";
        
        $this->modules = array("core");
    }
    
    function publish() {
        $files = $_REQUEST['files'];
        $base = INDEX_DIR."/upload/LPCandy/publish/".$this->page->id;
        if (!file_exists($base)) mkdir($base,0777,true);
        
        foreach ($files as $path=>$text) {
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