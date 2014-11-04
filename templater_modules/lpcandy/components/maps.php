<?php

class Maps extends Block {
    public $name = 'Maps';
    public $description = "Yandex map";
    
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
            <div id="map"></div> <!--Уточнить нужно ли создавать класс под карты-->
            <div class="container">
                <div class="map_overlay">
                    <div class="item_list"> 
                        <div class="item" >
                            <div class="title">
                                <?=$this->sub('Text','title_1')?>
                            </div>
                            <div class="desc">
                                <?=$this->sub('Text','desc_1')?>
                            </div>
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'title_1' => "Москва",
            'desc_1' => "<div>ул. Тверская, дом 6, офис 202</div><div>200 от м. Театральная</div><div>Тел: +7 (495) 221 56 98</div><div>info@vashsite.ru",

        );
    }
        
}


Maps::register();