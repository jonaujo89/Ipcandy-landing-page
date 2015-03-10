<?php

class LPExtra extends \Bingo\Module {
    function __construct() {
        $this->addModelPath(dirname(__FILE__).'/LPExtra/Models');
        
        $this->connect(":action/:id",array('controller'=>'\LPExtra\Controllers\Projects','id'=>false),
            array('action'=>'(project-list|project-edit)'));
        
        \Bingo\Action::add('lpcandy_menu',function($menu,$user){
            if ($user && $user->hasAccess('project_editor')) {
                $menu[] = array('url'=>'project-list','label'=>_t('Projects','lpextra'));
            }
            return $menu;
        },10,2);
    }
}