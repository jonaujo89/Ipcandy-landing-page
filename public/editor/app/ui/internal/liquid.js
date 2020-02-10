lp.liquid = lp.cover.extendOptions({
    change: function(){
        this.element.find('.template').html(this.value.tpl.replace("{{base_url}}",base_url));
    },
    configForm: {
        width: 800,
        items: [   
            _t("Template"),
            { 
                name: "tpl",
                height: 300,
                type: ui.textarea.extend({
                    init: function (o) {
                        this._super(o);
                        var el = this.element;
                        var me = this;
                        
                        var button = new ui.uploadButton({
                            label: _t('Upload image'),
                        });
                        button.bind("change",function (){
                            me.setValue(me.getValue() + '<img src="{{base_url}}/'+this.getValue()+'">');
                            me.trigger("change");
                        });
                        this.element = $("<div>").append(el).append(button.element);
                        this.input.css({overflow:'auto',whiteSpace:'nowrap'});
                    }
                })
            }
        ]
    }
});