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
                        var block = lp.map.current;                   
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

lp.addressText = ui.text.extend({
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
                    $.get('http://geocode-maps.yandex.ru/1.x/',{format:'json',results:1,geocode:address},update);
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
                    var block = lp.map.current;
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
})


lp.map = lp.block.extendOptions({
    init: function(){
        var jq = Component.previewFrame.window.$;
        if(jq){
            var jq = Component.previewFrame.window.$;
            jq(this.element.find(".map")).mapYandex(this.value.map);
        }; 
    },
    change: function(){  
        
        if (this.value.variant == 1) {  
            this.variant.find(".container_text").toggleVis(this.value.show_container_text);  
            this.value.map.map_drag = this.value.map_drag;            
        } 
        var jq = Component.previewFrame.window.$; 
        jq(this.element.find(".map")).mapYandex(this.value.map); 
    },
    configForm: {
        width: 800,
        items: [   
            { 
                name: "show_container_text", label: _t("Show text"), type: "checkbox", width: "auto", margin: "5px 0 0 0",
                showWhen: { variant: [1] }
            },
            {
                type: 'html', html: '<br>'
            },
            { 
                name: "map_drag", label: _t("Map is draggable"), type: "checkbox", width: "auto", margin: "0 0 0 0",
                showWhen: { variant: [1] }
            },
            "<hr>",
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
                                    var block = lp.map.current; 
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
