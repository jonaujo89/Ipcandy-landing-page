<?php

namespace LPCandy\Components;

class Custom extends Block {
    public $name = 'HTML';
    public $description = "Ваш собственный html+css";
    public $editor = "lp.custom";
    
    function tpl($val) {?>
        <div class="container-fluid custom">
            <div class="container">
                <?= str_replace("{{base_url}}",INDEX_URL,@$val['html']?:"") ?>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'html' => "<h1>Пример HTML</h1><p>И немного текста</p>"
        );
    }
    
}