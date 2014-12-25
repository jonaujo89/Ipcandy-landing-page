<?php

class Maps extends Block {
    public $name = 'Maps';
    public $description = "Geolocation";
    public $editor = "lp.maps";
    
    function tpl($val) {?>
        <div class="map_block_1">            
            <? if ($val['show_container_text'] || $this->edit): ?>                
                   <div class="container_text" <?= !$val['show_container_text'] ? "style='display:none'" : "" ?> >  
                       <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="map_overlay">
                                <div class="title">
                                    <?= $self->sub('Text','title_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>true))?>
                                </div>
                                <div class="desc">
                                    <?= $self->sub('Text','desc_1')?>
                                </div> 
                            </div>
                        <? }) ?>
                    </div>                
            <? endif ?>
            <? $this->sub("Map",'map_yandex') ?>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_container_text' => true,                        
            'map_yandex' => Map::tpl_default(),
            'items' => array(
                array(
                    'title_1' => "Москва",
                    'desc_1' => "ул. Тверская, дом 6, офис 202<br>200 от м. Театральная<br>Тел: +7 (495) 221 56 98<br>info@vashsite.ru"
                )
            )
            
        );
    }
}

Maps::register();