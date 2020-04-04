require("YandexMap.tea");
const {Cover} = require("../Cover/Cover");
const {Dialog} = require("../Dialog/Dialog");
const {Editable} = require("../Editable/Editable");
const {Radio} = require("../Radio/Radio");
const {UploadButton} = require("../UploadButton/UploadButton");
const {Input} = require("../Input/Input");
const {Switch} = require("../Switch/Switch");
const {Color} = require("../Color/Color");
const {App} = require("../../App");

App.ready(()=>{
    if (!App.geocoder_api_key && !App.viewOnly) Dialog.alert("Please fill geocoder_api_key in app config");
});

class AddressInput extends preact.Component {
    render(props,state) {
        return html`
            <${Input.Type} ...${state.error ? {class:'invalid'}:{}} value=${props.value.address} onChange=${(address)=>{
                if (address) {
                    clearTimeout(this.geocodeTimeout);
                    this.geocodeTimeout = setTimeout(()=>{
                        fetch(
                            `https://geocode-maps.yandex.ru/1.x/`
                            +`?format=json&results=1&geocode=${encodeURIComponent(address)}&apikey=${encodeURIComponent(App.geocoder_api_key)}`
                        )
                        .then((res)=>res.json().then(update));
                    },500);
                } else {
                    update(false);
                }

                var me = this;
                this.lastRequest = address;
                    
                function update(data) {
                    if (address!=me.lastRequest) return;
                    var members = data ? data.response.GeoObjectCollection.featureMember : false;
                    if (members && members.length) {
                        var coords = members[0].GeoObject.Point.pos;
                        var parts = coords.split(" ");
                        props.onChange({
                            ...props.value,
                            lat:parts[1],
                            lng:parts[0],
                            address
                        })
                        me.setState({error:false});
                    } else {
                        props.onChange({
                            ...props.value,
                            address
                        });
                        me.setState({error:true});
                    }
                }

            }} />
        `;
    }
}

class MapView extends preact.Component {
    update() {
        var mapSettings = this.props.value;
        let init = () => { 
            var yandexPlacemark;
            var myMap = this.ymap;
            if (!myMap) {
                myMap = new ymaps.Map(this.base, {
                    center: mapSettings.map_center,
                    zoom: mapSettings.map_zoom,
                    controls: ['geolocationControl','fullscreenControl','zoomControl']
                });
                this.ymap = myMap;
                myMap.events.add('boundschange',()=>{
                    this.props.onBoundsChange && this.props.onBoundsChange(myMap)
                });
                myMap.behaviors.disable('scrollZoom');
            } else {
                if (!this.prevSettings || this.prevSettings.map_center!=mapSettings.map_center || this.prevSettings.map_zoom!=mapSettings.map_zoom) {
                    myMap.setCenter(mapSettings.map_center, Number(mapSettings.map_zoom));
                }
            }

            if (!this.prevSettings || this.prevSettings.map_drag!=mapSettings.map_drag) {
                if (mapSettings.map_drag) {
                    myMap.behaviors.enable('drag');
                } else {
                    myMap.behaviors.disable('drag');
                }
            }

            if (!this.prevSettings || this.prevSettings.map_places!=mapSettings.map_places) {
                myMap.geoObjects.removeAll();
                mapSettings.map_places.forEach((place,i)=>{
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
                });
            }
            this.prevSettings = mapSettings;
        };

        if (!window.ymaps) {
            if (!window.ymaps_loading) {
                window.ymaps_loading  = [init];
                var map_lang = window.locale_lang=="ru" ? "ru_RU" : "en_US";

                var script = document.createElement("script");
                script.onload = () => {
                    ymaps.ready(()=>{
                        window.ymaps_loading.map((one)=>one());
                    })
                }
                script.src = '//api-maps.yandex.ru/2.1/?lang='+map_lang;
                document.head.appendChild(script);
            } else {
                window.ymaps_loading.push(init);
            }
        } else {
            init();
        }
    }

    render(props) {
        return html`<div class="map" ...${props.height ? {style:{height:props.height+"px"}}:{}} />`;
    }

    componentDidMount() {
        this.update();
    }

    componentDidUpdate() {
        this.update();
    }
}

const YandexMap = Editable((props)=>{
    return html `
        <${Cover} 
            configForm=${html`
                <${Dialog} width=${800} title=${_t('Settings')} class="lp-dialog-yandex-map">
                    <${Switch} name="map.map_drag" label=${_t("Map is draggable")} />
                    <table>
                        <tr>
                            <th>${_t('Name')}</th>
                            <th>${_t('Address')}</th>
                            <th>${_t('Color')}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        ${props.value.map.map_places.map((place,i)=>html`
                            <tr>
                                <td>
                                    <${Input} name=${`map.map_places.${i}.title`} />
                                </td>
                                <td>
                                    <${AddressInput} value=${place} onChange=${(new_place)=>{
                                        var map_places = [...props.value.map.map_places];
                                        map_places[i] = new_place;
                                        props.onChange({map:{
                                            ...props.value.map,
                                            map_center: [new_place.lat,new_place.lng],
                                            map_places
                                        }});

                                    }} />
                                </td>
                                <td>
                                    <${Color} name=${`map.map_places.${i}.color`} iconSize=${20} items=${[
                                        { value: 'blue', color: '#0187BC' },
                                        { value: 'green', color: '#56DB40' },
                                        { value: 'orange', color: '#E6761B' },
                                        { value: 'violet', color: '#B51EFF' },
                                        { value: 'pink', color: '#F371D1' },
                                        { value: 'red', color: '#ED4543' },
                                        { value: 'yellow', color: '#FFD21E' }
                                    ]} />
                                </td>
                                <td>
                                    <button onClick=${()=>{
                                        props.onChange({map:{
                                            ...props.value.map,
                                            map_center: [place.lat,place.lng]
                                        }});
                                    }}>${_t('center')}</button>
                                </td>
                                <td>
                                    <button onClick=${()=>{
                                        var map_places = [...props.value.map.map_places];
                                        map_places.splice(i,1);
                                        props.onChange({map:{
                                            ...props.value.map,
                                            map_places
                                        }});
                                    }}>x</button>
                                </td>
                            </tr>
                        `)}
                    </table>
                    <button onClick=${()=>{
                        props.onChange({map:{
                            ...props.value.map,
                            map_places: [
                                ...props.value.map.map_places,
                                {...props.defaultValue.map.map_places[0]}
                            ]
                        }});                            
                    }}>${_t('Add placemark')}</button>


                    <${MapView} height=${300} value=${props.value.map} onBoundsChange=${(myMap)=>{
                        props.onChange({map:{
                            ...props.value.map,
                            map_center: myMap.getCenter(),
                            map_zoom: myMap.getZoom()
                        }});
                    }} />
                <//>
            `}
        >
            <${MapView} value=${props.value.map} />
        <//>
    `
})

 
YandexMap.tpl_default = () => window.locale_lang == 'en' ? {
    map: {
        map_type: 'yandex',
        map_center: [55.7706, 37.6200],
        map_zoom: 15,
        map_drag: true,
        map_places: [
            {
                type: 'placemark',
                title: 'One and the same are at the circus ring',
                address: 'Moscow, Color Blvd., 13',
                lat: '55.7706',
                lng: '37.6200',
                color: 'red'
            },
        ]
    }

} : {
    map: {
        map_type: 'yandex',
        map_center: [55.7706, 37.6200],
        map_zoom: 15,
        map_drag: true,
        map_places: [
            {
                type: 'placemark',
                title: 'На манеже все те же',
                address: 'г. Москва, Цветной бульвар, 13',
                lat: '55.7706',
                lng: '37.6200',
                color: 'red',
            }
        ],
    }
}
 
    exports.YandexMap = YandexMap;