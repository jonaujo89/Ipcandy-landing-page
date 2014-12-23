<?php

class Maps extends Block {
    public $name = 'Maps';
    public $description = "Geolocation";
    public $editor = "lp.maps";
    
    function tpl($val) {?>
        <div class="map_block_1">
            <? $this->sub("Map",'map_yandex') ?>
            <? if ($val['show_container_text'] || $this->edit): ?>
               <div class="container_text" <?= !$val['show_container_text'] ? "style='display:none'" : "" ?> >                
                    <div class="map_overlay">
                        <div class="item_block"> 
                            <div class="title">
                                <?=$this->sub('Text','title_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>true))?>
                            </div>
                            <div class="desc">
                                <?=$this->sub('Text','desc_1')?>
                            </div>                  
                        </div>
                    </div>
                </div>
            <? endif ?>            
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_container_text' => true,
            'title_1' => "Москва",
            'desc_1' => "ул. Тверская, дом 6, офис 202<br>200 от м. Театральная<br>Тел: +7 (495) 221 56 98<br>info@vashsite.ru",
            'map_yandex' => array_merge(Map::tpl_default(),
                array(                   
                    'map_type' => 'yandex',			
                    'map_center' => '55.75824,37.622575',
                    'map_zoom' => 15,
                    'map_places' => array(
                        array(
                            'type' => 'placemark',
                            'title' => 'Офис №1',
                            'address' => 'г.Москва, улица Никольская, 17', 
                            'phone' => '+7 (526) 888-615-65',
                            'coords' => '55.75824,37.622575',
                            'color' => 'red' 
                        ),
                        array(
                            'type' => 'placemark',
                            'title' => 'Офис №2',
                            'address' => 'г.Москва, улица Тверская, 6',
                            'phone' => '+7 (526) 777-615-65',
                            'coords' => '55.757789, 37.611652',
                            'color' => 'green' 
                        ), 
                    )
                )  
            ),
        );
    }
}

Maps::register();