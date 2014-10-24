lp.logo = teacss.ui.control.extend({
    init: function (el) {
        var me = this;
        this._super({});
        this.element = el;
        me.cover = $("<div class='cmp-cover fa fa-gear'>")
            .click(function(){me.onClick()})
            .appendTo(el);
        
        me.bind("change",function(){
            me.cover.detach();
            me.element.empty();
            if (me.value.type=="image") {
                me.element.append($("<img>").attr({src:me.value.url,width:me.value.size+"%"}));
            } else {
                me.element.append($("<span>").text(me.value.text).css({
                    fontStyle: me.value.italic ? 'italic' : '',
                    fontWeight: me.value.bold ? 'bold' : '',
                    fontFamily: me.value.font || '',
                    color: me.value.color || '',
                    fontSize: me.value.fontSize ? me.value.fontSize + 'px' : ''
                }));
            }
            me.cover.appendTo(me.element);
        });
    },
    
    setVisible: function () {
        var me = this;
        var val = me.form.getValue();
        
        $.each(me.form.innerForm.items,function(i,item){
            var when = item.options.showWhen;
            if (when) {
                var show = true;
                for (var key in when) {
                    if (when[key]!=val[key]) show = false;
                }
                if (show)
                    item.element.show();
                else
                    item.element.hide();
            }
        });
    },
    
    onClick: function () {
        var me = this;
        if (!this.dialog) {
            this.dialog = teacss.ui.dialog({
                width: 500,
                title: "Logotype",
                resizable: false,
                items: [
                    this.form = teacss.ui.composite({
                        items: [
                            {
                                name: 'type', type: 'radio', margin: "15px 0 20px", items: [
                                    { label: "Image logo ", value: 'image' },
                                    { label: "Text name logo", value: 'text' }
                                ]
                            },
                            {
                                name: 'url', type: 'uploadButton', label: 'Upload image file',
                                showWhen: { type: 'image' }
                            },
                            {
                                type: 'label',
                                value: "Company name:",
                                showWhen: { type: 'text' }
                            },
                            {
                                name: "text", type: "text",
                                showWhen: { type: 'text' }
                            },
                            { 
                                type: 'label',
                                value: "Font settings:",
                                showWhen: { type: 'text' }
                            },
                            {
                                name: "font", type: "fontCombo", width: '50%',
                                showWhen: { type: 'text' }
                            },
                            {
                                name: "bold", label: "<b>B</b>", type: "check", width: 27, height: 27, 
                                margin: "0 0 10px 5px", showCheckbox: false,
                                showWhen: { type: 'text' }
                            },
                            {
                                name: "italic", label: "<i>I</i>", type: "check", width: 27, height: 27, 
                                margin: "0 0 10px 5px", showCheckbox: false,
                                showWhen: { type: 'text' }
                            },
                            {
                                name: "color", type: "colorPicker", width: 27, height: 27, margin: "0 0 10px 5px",
                                showWhen: { type: 'text' }
                            },
                            "Size:",
                            {
                                margin: "5px 0",
                                name: 'size', type: 'slider', min: 0, max: 100,
                                showWhen: { type: 'image' }
                            },
                            {
                                margin: "5px 0",
                                name: 'fontSize', type: 'slider', min: 8, max: 100,
                                showWhen: { type: 'text' }
                            }
                        ]
                    })
                ]
            });
            this.form.bind("change",function(){
                me.value = me.form.getValue();
                me.setVisible();
                me.trigger("change");
            });
            var doc = Component.previewFrame.$f("body")[0].ownerDocument;
            $(doc).mousedown(function(){
                me.dialog.close();
            });
        }
        this.form.setValue(this.value);
        me.setVisible();
        this.dialog.open();
    }
});