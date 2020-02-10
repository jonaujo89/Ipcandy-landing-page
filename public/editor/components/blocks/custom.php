<?php

namespace LPCandy\Components;

class Custom extends Block {
    public $name;
    public $description;
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'HTML';
            $this->description = "Custom html+css";
        } else {
            $this->name = 'HTML';
            $this->description = "Ваш собственный html+css";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid custom">
            <div class="container">
                <?= $this->sub('Liquid','liquid') ?>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return array(
            'liquid' => Liquid::get()->tpl_default()
        );
    }
    
}