$.fn.mapYandex = function (mapSettings) {
    
    $(this).each(function(){
        mapSettings = mapSettings || JSON.parse($(this).attr('data-map-settings'));

        var center = mapSettings.map_center;
        var placesArray = mapSettings.map_places,        
            type = mapSettings.map_type,
            zoom = mapSettings.map_zoom;
        var $this = $(this);

        var modalWindowMap = mapSettings.modalWindowMap;

        function init(){ 
            var yandexPlacemark;

            var myMap = $this.data("ymap");
            if (!myMap) {
                myMap = new ymaps.Map($this[0], {
                    center: center,
                    zoom: zoom,
                    controls: ['geolocationControl','fullscreenControl','zoomControl']
                });
                $this.data("ymap",myMap);            

                if($this[0].className == 'fixed'){
                    myMap.events.add('boundschange', function ($this) {
                        var map = lp.map.current; 
                        map.value.map_center = myMap.getCenter();
                        map.value.map_zoom = myMap.getZoom();
                        map.trigger('change');
                    });
                }

            } else {
                myMap.setCenter(center, Number(zoom));
            }
            myMap.behaviors.disable('scrollZoom');
            myMap.geoObjects.removeAll();        

            var coords;
            for(i = 0; i < placesArray.length; i++){
                var place = placesArray[i];
                var coords = [place.lat,place.lng];
                yandexPlacemark = new ymaps.Placemark( coords ,
                {
                    hintContent: place.title,
                    balloonContentHeader: place.title,
                    balloonContentBody: place.address
                }, 
                {
                    balloonCloseButton: true,
                    balloonPanelMaxMapArea: 'Infinity',
                    balloonPane: 'outerBalloon',
                    preset: 'islands#'+place.color+'DotIcon',
                });
                myMap.geoObjects.add(yandexPlacemark);
            };        
        };
        ymaps.ready(function () {
            init();
        });
    });
};