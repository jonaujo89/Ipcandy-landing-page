<?php

class Maps extends Block {
    public $name = 'Maps';
    public $description = "Yandex map";
    public $editor = "lp.maps";
    
    function tpl($val) {?>
        <div class="container-fluid map_yandex">
            <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
            <script type="text/javascript">
                
                //yandexMap 
                ymaps.ready(init);
                var myMap, 
                    myPlacemark;

                function init(){ 
                    myMap = new ymaps.Map("map", {
                        center: [55.75824,37.613575],
                        zoom: 15
                    }); 

                    myPlacemark = new ymaps.Placemark([55.75824,37.613575], {
                        hintContent: 'Название Вашей компании',
                        balloonContent: '200 от м. Театральная,<br> Тел: +7 (495) 221 56 98<br> info@vashsite.ru'
                    });

                    myMap.geoObjects.add(myPlacemark);
                }
                
            </script>
            <div id="map"></div>
            <? if ($val['show_text'] || $this->edit): ?>
               <div class="container" <?= !$val['show_text'] ? "style='display:none'" : "" ?> >                
                    <div class="map_overlay">
                        <div class="item_list"> 
                            <? $this->repeat('items',function($item_val,$self) { ?>
                                <div class="title">
                                    <?=$self->sub('Text','title_1')?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_1')?>
                                </div>
                            <? }) ?>                    
                        </div>
                    </div>
                </div>
            <? endif ?>
            
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_text' => true,
            'items' => array(
                array(
                    'title_1' => "Москва",
                     'desc_1' => "<div>ул. Тверская, дом 6, офис 202</div><div>200 от м. Театральная</div><div>Тел: +7 (495) 221 56 98</div><div>info@vashsite.ru",
                )
            ),
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать','color' =>'blue'))
        );
    }
}

Maps::register();