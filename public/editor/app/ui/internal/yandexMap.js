lp.mapRepeater = lp.repeater.extendOptions({
    inline: true,
});

lp.placemarkRepeater = teacss.ui.repeater.extend({
    init: function (o) { 
        var me = this;
        this._super($.extend({
            addLabel: _t("Add placemark"),
            repeaterClass: "lp-placemark-repeater",
            items: [
                { type: "text", name: "title", width: "32%", margin: "0 1% 0 0"},                               
                { type: lp.addressText, name: "", width: "32%", margin: "0 1% 0 0" },
                { 
                    type: lp.color, name: "color", width: "23%", iconSize: 12, margin: "0",
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
                { type: 'button', label: _t("center"), width: "7%", margin: "0 1% 0 0", 
                    click: function (val) {
                        var block = lp.yandexMap.current;                   
                        block.value.map.map_center = [this.form.value.lat, this.form.value.lng];
                        me.trigger("change");
                    }
                }
            ]
        },o));
    },
    newElement: function () {
        var value = this.getValue();
        if (value.length)
            this.addElement($.extend(true,{},value[value.length-1]));
        else
            this.addElement();
    }
});

lp.app.events.bind("init",function(){
    if (!lp.addressText.geocoder_api_key) alert("Please fill geocoder_api_key in app config");
});

lp.addressText = ui.text.extend({
    geocoder_api_key: ""
},{
    init: function (o) {
        var me = this;
        this._super(o);
        
        this.bind("change",function(){
            if (me.coordsChange) return;
            
            var address = me.input.val();
            if (address == me.lastAddress) return;
            
            if (address) {
                clearTimeout(me.geocodeTimeout);
                me.geocodeTimeout = setTimeout(function(){
                    $.get('https://geocode-maps.yandex.ru/1.x/',{format:'json',results:1,geocode:address,apikey:me.Class.geocoder_api_key},update);
                },500);
            } else {
                update(false);
            }
                
            function update(data) {
                if (address!=me.input.val()) return;
                var members = data ? data.response.GeoObjectCollection.featureMember : false;
                if (members && members.length) {
                    var coords = members[0].GeoObject.Point.pos;
                    var parts = coords.split(" ");
                    me.value.lat = parts[1];
                    me.value.lng = parts[0];
                    me.input.removeClass("error");
                    var block = lp.yandexMap.current;
                    block.value.map.map_center = [me.value.lat,me.value.lng];
                    me.trigger("change");
                } else {
                    me.input.addClass("error");
                    me.value.lat = '';
                    me.value.lng = '';
                }
                me.lastAddress = address;
                me.coordsChange = true;
                me.trigger("change");
                me.coordsChange = false;
            }
        });
    },
    setValue: function (val) {
        val = val || {};
        this.input.val(val.address);
        this.value = val;
    },
    getValue: function () {
        this.value.address = this.input.val();
        return this.value;
    }
});

lp.yandexMap = lp.cover.extendOptions({
    init: function(o){
        var jq = Component.previewFrame.window.$;
        if(jq){
            var jq = Component.previewFrame.window.$;
            jq(this.element.find(".map")).mapYandex(this.value.map);
        }; 
    },
    change: function(){  
        this.value.map.map_drag = this.value.map_drag;            
        var jq = Component.previewFrame.window.$; 
        jq(this.element.find(".map")).mapYandex(this.value.map); 
    },
    configForm: {
        width: 800,
        items: [
            { 
                name: "map_drag", label: _t("Map is draggable"), type: "checkbox", width: "auto", margin: "0 0 0 0",
            },
            {
                type: 'composite', skipForm: true, margin: 0,
                items: [    
                    { type: "label", value: _t("Name"), width: "32%", margin: "0 1% 2px 0"},
                    { type: "label", value: _t("Address"), width: "32%", margin: "0 1% 2px 0"},
                    { type: "label", value: _t("Color"), width: "23%", margin: "0 0 2px 0"},
                    { type: lp.placemarkRepeater, name: "map.map_places" }
                ]
            },
            {
                height: 300, margin: 0, name: "map",
                type: ui.panel.extend({
                    init: function (o) {
                        this._super(o);
                    },
                    setValue: function (val) {
                        var me = this;                    
                        if (val && val.map_type) {
                            me.element.mapYandex($.extend(val,{map_drag:true}),function(myMap){
                                myMap.events.add('boundschange', function ($this) {
                                    var block = lp.yandexMap.current; 
                                    block.value.map.map_center = myMap.getCenter();
                                    block.value.map.map_zoom = myMap.getZoom();
                                    block.trigger('change');
                                });  
                            });
                        }
                    }
                })
            }
        ]
    }
});
