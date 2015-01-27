<?php

class Map extends Block {
    public $name = 'Карта';
    public $description = "Местораположение компании";
    public $editor = "lp.map";
    
    function tpl($val) {?>
        <div class="map_block_1">
            <? if ($cls = $this->vis($val['show_container_text'])): ?>
                   <div class="container_text <?=$cls?>" >  
                       <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="map_overlay">
                                <div class="title">
                                    <?= $self->sub('Text','title_1',Text::$plain_heading)?>
                                </div>
                                <div class="desc">
                                    <?= $self->sub('Text','desc_1',Text::$default_text)?>
                                </div> 
                            </div>
                        <? }) ?>
                    </div>                
            <? endif ?>
            <div class="map" data-map-settings='<?=json_encode($val['map'])?>'></div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_container_text' => true,                        
            'map' => array(
                'map_type' => 'yandex',			
                'map_center' => array(55.757789, 37.611652),
                'map_zoom' => 15,
                'map_places' => array(
                    array(
                        'type' => 'placemark',
                        'title' => 'Офис №1',
                        'address' => 'г.Москва, улица Тверская, 6',
                        'lat' => '55.757789', 
                        'lng' => '37.611652',
                        'color' => 'green' 
                    ), 
                )
            ),
            'items' => array(
                array(
                    'title_1' => "Москва",
                    'desc_1' => "ул. Тверская, дом 6, офис 202<br>200 от м. Театральная<br>Тел: +7 (495) 221 56 98<br>info@vashsite.ru"
                )
            )
            
        );
    }
}

Map::register();