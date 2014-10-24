<?php

namespace LPCandy;

require BINGO_PATH . "/../dayside/server/api.php";

class DaysideApi extends \FileApi {
    
    public $user;
    
    function __construct($user) {
        $this->user = $user;
        $this->{$_REQUEST['_type']}();
        die();                
    }
    
    function _pathFromUrl($url) {
        $token = "http://template-editor";
        if (strpos($url,$token)===0) {
            $path = INDEX_DIR."/upload/LPCandy/templates/".$this->user->id."/theme".substr($url,strlen($token));
            return $path;
        }
        return false;
    }    
}