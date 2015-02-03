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
                'map_center' => array(55.7706,37.6200),
                'map_zoom' => 15,
                'map_places' => array(
                    array(
                        'type' => 'placemark',
                        'title' => 'На манеже все те же',
                        'address' => 'г.Москва, Цветной бульвар, 13',
                        'lat' => '55.7706', 
                        'lng' => '37.6200',
                        'color' => 'red' 
                    ), 
                )
            ),
            'items' => array(
                array(
                    'title_1' => "На манеже все те же",
                    'desc_1' => "г.Москва, Цветной бульвар, 13<br>200 метров от поворота<br>Тел: +7 (495) 321-46-98<br>smile@zaraza.net"
                )
            )
            
        );
    }
}

Map::register();