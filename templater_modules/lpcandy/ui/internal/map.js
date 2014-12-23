lp.formPlaces = {};

lp.formPlaces.placemark = teacss.ui.composite.extendOptions({
    selectLabel: "Add placemark",
    selectIcon: "fa fa-map-marker",
    defaultColor: "blue",
    defaultAddress: "г.Москва, ул.Тверская, д.6",
    defaultPhone: "+7 (526) 888-615-65",
    defaultCoords: '55.757789, 37.611652',
    
    geocode: function (val, map) {
        var jq = Component.previewFrame.window.$;
       
        function reverse(stringCoords) {
            var array = stringCoords.split(' ');
            var arrayReverse = JSON.parse("["+array[1] +','+array[0]+"]");
            //var arrayReverse = [Number(array[1]) , Number(array[0])];
            return arrayReverse;
        };
        
        if(jq){
            jq.ajax({
                url: 'http://geocode-maps.yandex.ru/1.x/?format=json&results=1&geocode='+val.address,//geocoder ver. 1.x, map ver.2.1 = positionReverse
                success: function(data){                
                    var placemarkCoords = reverse(data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos);
                    jq.fn.mapYandexAddPlacemark(map, placemarkCoords, val.title, val.address, val.phone, val.color);
                }
            });            
        }
    }
},{
    
    items: [
        "Name",
        { type: "text", name: "title" },
        "Address",
        { type: "text", name: "address" },   
        "Phone",
        { type: "text", name: "phone" }, 
        "Color",
        { 
            type: lp.color, name: "color", width: "auto", iconSize: 15, margin: "0 0 8px",
            items: [
                { value: 'blue', color: '#0187BC' },
                { value: 'green', color: '#56DB40' },
                { value: 'orange', color: '#E6761B' },
                { value: 'violet', color: '#B51EFF' },
                { value: 'pink', color: '#F371D1' },
                { value: 'red', color: '#ED4543' },
                { value: 'yellow', color: '#FFD21E' }
            ]
        },
        "Coords",
        { type: "text", name: "coords", showWhen: { type: '' } },
        "Center",
        { type: "button", name: "center" }
    ]
});

lp.map = lp.cover.extendOptions({
},{        
    init: function () {        
        this.cover.addClass("lp-button");        
    },
    change: function(){         
        
        var jq = Component.previewFrame.window.$;
        var mapSettings = this.getValue();
        var myMap = Component.previewFrame.window.ymaps.myMap;

        if(jq){
            jq.each(mapSettings.map_places, function(p,places){ 
                myMap.geoObjects.removeAll();
                var sub = lp.formPlaces[places.type];
                sub.geocode(places, myMap);
            }); 
            
            function coords(stringCoords) {
                var arr = stringCoords.split(',');
                var arrayCoords = [Number(arr[0]), Number(arr[1])];
                return arrayCoords;
            };
            myMap.setCenter(coords(this.value.map_center), Number(this.value.map_zoom));
        }
    },
    configForm: {
        title: "Map",
        items: [
            {
                name: 'map_type', type: 'radio', margin: "10px 0 15px", items: [
                    { label: "Yandex maps", value: 'yandex' },
					{ label: "Google maps", value: 'google' }
                ]
            },            
            {
                name: "map_center", type: "text", margin: "10px 0 15px"
            },
            {
                type: 'label',
                value: "Default map zoom (after loading window):", margin: "10px 0 0"
            },
            {
                margin: "5px 0",
                name: 'map_zoom', type: 'slider', min: 5, max: 18, margin: "10px 0 20px"
            },
            {
                name: "map_places", 
                repeaterClass: "lp-field-repeater",
                type:  teacss.ui.repeater.extend({
                    init: function (o) {
                        this._super(o);
                        
                        var me = this;
                        this.addCombo = teacss.ui.combo({
                            label: "Add place",
                            comboWidth: 100,
                            itemTpl: function (item) {
                                return $("<div>")
                                    .addClass("lp-add-field "+item.sub.selectIcon)
                                    .text(item.sub.selectLabel)
                                    .mousedown(function(){
                                        me.addElement($.extend(
                                            item.sub.default || {},
                                            { type: item.type, title: item.sub.selectLabel, color: item.sub.defaultColor, address: item.sub.defaultAddress, phone: item.sub.defaultPhone, coords: item.sub.defaultCoords }
                                        ));
                                        me.trigger("change");
                                    });
                            },
                            items: function () {
                                var items = [];
                                $.each(lp.formPlaces,function (key,sub){
                                    if (sub && sub.selectLabel) {
                                        items.push({ value: key, sub: sub, type: key });
                                    }
                                });
                                return items;
                            }
                        });
                        this.addButton.replaceWith(this.addCombo.element);
                    },
                    itemTemplate: function (el) {
                        var ret = this._super(el);
                        var content = ret.find(".ui-repeater-item-content").hide();
                        ret.find(".ui-repeater-item-title").css({cursor:"pointer"})
                        .prepend($("<span>"))
                        .click(function(){
                            var visible = content.is(":visible");
                            ret.parent().find(".ui-repeater-item-content").hide();
                            content.toggle(!visible);
                        });
                        return ret;
                    },                    
                    updateLabel: function (el) {
                        var val = el.getValue();
                        var title = el.itemContainer.find(".ui-repeater-item-title").addClass(lp.formPlaces[val.type].selectIcon);
                        title.children("span").eq(0).text(val.title);
                    },
                    addElement: function (val) {
                        val = val || {};
                        var el = lp.formPlaces[val.type]();
                        el.setValue(val);
                        var me = this;
                        el.bind("change",function(){
                            me.updateLabel(el);
                            me.trigger("change");
                        });
                        this.push(el);
                        this.updateLabel(el);
                        return el;
                    }
                })
            },
        ]
    }
})