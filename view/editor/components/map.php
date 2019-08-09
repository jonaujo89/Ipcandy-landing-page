<?php

namespace LPCandy\Components;

class Map extends Block {
    public $name;
    public $description;
    public $editor = "lp.map";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Map';
            $this->description = "Company location";
        } else {
            $this->name = 'Карта';
            $this->description = "Месторасположение компании";
        }        
    }
    
    function tpl($val) {?>
        <div class="map_block_1">
            <div class="container">
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
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'show_container_text' => true, 
            'map_drag' => true,
            'map' => array(
                'map_type' => 'yandex',			
                'map_center' => array(55.7706,37.6200),
                'map_zoom' => 15,
                'map_drag' => true,
                'map_places' => array(
                    array(
                        'type' => 'placemark',
                        'title' => 'One and the same are at the circus ring',
                        'address' => 'Moscow, Color Blvd., 13',
                        'lat' => '55.7706', 
                        'lng' => '37.6200',
                        'color' => 'red' 
                    ), 
                )
            ),
            'items' => array(
                array(
                    'title_1' => 'One and the same are at the circus ring',
                    'desc_1' => 'Moscow, Color Blvd., 13<br>200 meters from the rotation<br>Тел: +7 (495) 321-46-98<br>smile@zaraza.net'
                )
            )            
        ] : [
            'show_container_text' => true,  
            'map_drag' => true,
            'map' => array(
                'map_type' => 'yandex',			
                'map_center' => array(55.7706,37.6200),
                'map_zoom' => 15,
                'map_drag' => true,
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
        ];
    }
}