lp.custom = lp.block.extendOptions({
    change: function(){
        this.variant.find(".container").html(this.value.html.replace("{{base_url}}",base_url));
    },
    configForm: {
        items: [   
            _t("HTML"),
            { 
                name: "html", 
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
                    }
                })
            }
        ]
    }
});