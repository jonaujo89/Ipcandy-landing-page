lp.formComposite = teacss.ui.composite.extend({
    setValue: function (value) {
        if (!this.innerForm) return;
        this.innerForm.setValue(value || {});
    }
});

lp.block = teacss.ui.control.extend({
    init: function (o) {
        this._super(o);
        var me = this;
        this.cmp = this.options.cmp;
        this.element = this.cmp.element;
        this.variantValues = {};
        this.variantDefault = {};
        this.editors = [];
        
        if (this.options.configForm) {
            this.configButton = $("<div class='fa fa-gear lp-button right'>").click(function(){
                me.config({my:"right top",at:"right top",of:me.configButton})
            });
        } else {
            this.configButton = "";
        }
        this.dragButton   = $("<div class='fa fa-arrows lp-button right draggable'>").data("component",me.cmp);
        this.removeButton = $("<div class='fa fa-trash-o lp-button right'>");
        
        this.prevButton = $("<div class='fa fa-chevron-left lp-button'>");
        this.nextButton = $("<div class='fa fa-chevron-right lp-button'>");
        
        this.variantLabel = $("<div class='lp-variant-label'>");
        
        this.dragButton.click(function(){});
        this.removeButton.click(function(){me.remove()});
        this.prevButton.mousedown(function(e){me.prev();e.preventDefault();});
        this.nextButton.mousedown(function(e){me.next();e.preventDefault();});
        
        if (me.options.init) me.options.init.call(me);
    },
    
    setValue: function (val) {
        this._super(val);
        this.id = val.id;
        this.type = val.type;
        
        var me = this;
        this.cmp.componentHandle.detach();
        if (this.controls) return;
        
        me.element = me.cmp.element;
        me.controls = $("<div class='cmp-controls'>").appendTo(this.cmp.element);
        me.variants = this.cmp.element.children("[data-variant]").each(function(){
            var def = $.parseJSON($(this).attr("data-default"));
            var idx = $(this).attr("data-variant");
            me.variantDefault[idx] = $.extend(def||{},{variant:parseInt(idx)});
            $(this).attr("data-default",null);
        });
        if (me.variants.length>1) {
            me.current = this.cmp.element.attr("data-current");
            me.controls.append(
                this.prevButton,
                this.nextButton,
                this.variantLabel
            );
        } else {
            me.current = 1;
        }
        
        me.bindEditors();
        me.showCurrent(val);

        me.controls.append(
            this.configButton,
            this.dragButton,
            this.removeButton                
        );
    },    
    
    reloadHtml: function () {
        var me = this;
        me.controls.detach();
        me.controls = null;
        me.cmp.reloadHtml(me.getValue());
    },
    
    remove: function () {
        var me = this;
        ui.confirm({title:_t("Remove confirmation"),text:_t("Sure to remove component?")},function(res){
            if (res) me.cmp.remove();
        })
    },
    
    prev: function () {
        this.variantValues[this.current] = this.value;
        this.current = (this.current - 2 + this.variants.length) % this.variants.length + 1;
        this.showCurrent();
        this.editorChange("variant",this.current);        
    },
    
    next: function () {
        this.variantValues[this.current] = this.value;
        this.current = (this.current % this.variants.length) + 1;
        this.showCurrent();
        this.editorChange("variant",this.current);        
    },
    
    config: function (position) {
        var me = this;
        
        var dialogId = me.options.configForm.id || "dialog";
        var dialog = me.Class[dialogId];
        
        function setVisible() {
            var form = dialog.form;
            if (!form.innerForm) return;
            var val = form.getValue();
            $.each(form.innerForm.items,function(i,item){
                var when = item.options.showWhen;
                if (when) {
                    var show = true;
                    for (var key in when) {
                        if ($.isArray(when[key])) {
                            if (jQuery.inArray(val[key],when[key])==-1) show = false;
                        } else {
                            if (when[key]!=val[key]) show = false;
                        }
                    }
                    if (show)
                        item.element.show();
                    else
                        item.element.hide();
                }
            });
        }
        
        if (!dialog) {
            var dialogWidth = 500;
            var dialogHeight = undefined;
            var form;
            
            if (me.options.configForm.width) {
                dialogWidth = me.options.configForm.width;
                delete me.options.configForm.width;
            }
            if (me.options.configForm.height) {
                dialogHeight = me.options.configForm.height;
                delete me.options.configForm.height;
            }
            if (me.options.configForm.item) {
                form = me.options.configForm.item({});
            } else {
                form = lp.formComposite(me.options.configForm);
            }
            
            dialog = this.Class[dialogId] = teacss.ui.dialog({
                width: dialogWidth,
                height: dialogHeight,
                modal: false,
                title: me.options.configForm.title || _t("Settings"),
                resizable: false,
                items: [ form ],
                open: function (){
                    dialog.detached.appendTo(dialog.element);
                    if (!lp.configOverlay) {
                        lp.configOverlay = $("<div>").css({
                            position: "absolute", left: 0, right: 0, top: 0, bottom: 0, zIndex: 20000
                        }).click(function(){
                            $(".ui-dialog-content:visible").dialog("close");
                            $(".button-select-panel:visible").hide();
                        });
                        Component.previewFrame.$f("body").append(lp.configOverlay);
                    }
                    lp.configOverlay.show();
                },
                close: function () {
                    lp.configOverlay.hide();
                }
            });
            form.bind("change",function(){
                me.Class.current.value = form.getValue();
                setVisible();
                me.Class.current.trigger("change");
            });
            dialog.form = form;
        }
        dialog.form.setValue(this.value);
        this.Class.current = this;
        setVisible();
        
        dialog.detached = dialog.element.children().detach();
        if (position) {
            position = $.extend({},position);
            
            var off = position.of.offset();
            var scrollY = $(Component.previewFrame.window).scrollTop();
            var frame_off = Component.previewFrame.frame.offset();
            var y = Math.floor(frame_off.top - scrollY);
            
            position.at = position.at.replace("top","top+"+y+"px");
            dialog.element.dialog("option","position",position);
        }
        
        $(".ui-dialog-content:visible").dialog("close");
        dialog.open();
    },
    
    getDefault: function (variant) {
        if (variant===undefined) variant = this.current;
        return this.variantDefault[variant];
    },
    
    showCurrent: function (val) {
        var me = this;
        var variant = this.variants.hide().eq(this.current-1);
        var def = this.getDefault();
        
        if (val) {
            this.variantValues[this.current] = val;
        }
        
        this.value = $.extend(
            true,
            {},
            def,
            this.variantValues[this.current] || { type: me.type, id: me.id }
        );
        variant.show();
        me.variant = variant;

        $.each(me.editors,function(e,editor){
            var sub_val = teacss.ui.prop(me.value,editor.options.name);
            editor.setValue(sub_val);
        });
        
        this.variantLabel.text(this.current + "/" + this.variants.length);
    },

    bindEditor: function (el,editorName,name,variant,setEditorValue) {
        var me = this;
        var editor = $(this).data("editor-control");

        if (!editor && name) {
            var options = $(el).attr("data-options");
            options = options ? JSON.parse(options) : {};
            $(el).removeAttr("data-options");

            var editorClass;
            if (typeof editorName === "string") {
                editorClass = Component.classFromName(editorName)
            } else {
                editorClass = editorName;
            }
            editor = editorClass($.extend(options,{element:$(el)}));
            $(el).data("editor-control",editor);

            editor.options.name = name;
            editor.options.block = me;
            editor.options.variant = variant;

            editor.bind("change",function(){
                me.editorChange(editor.options.name,editor.getValue(),editor);
            });
        }
        if (editor) {
            if (setEditorValue) {
                var sub_val = teacss.ui.prop(me.value,editor.options.name);
                editor.setValue(sub_val);
            }
            me.editors.push(editor);
        }
        return editor;
    },
    
    bindEditors: function (setEditorValue) {
        var me = this;
        me.editors = [];
        
        this.variants.each(function(v,variant_div){
            var variant = $(this).attr("data-variant");
            $(this).find("[data-editor]:not([data-dummy] *)").each(function(){
                me.bindEditor(this,$(this).attr("data-editor"),$(this).attr("data-name"),variant,setEditorValue);
            });        
        });
    },

    editorChange: function (name,val,editor) {
        var me = this;
        this.value = this.value || {};
        teacss.ui.prop(this.value,name,val);
        if (editor) {
            $.each(me.editors,function(idx,ed){
                if (ed!=editor && name==ed.options.name && me.value.variant==ed.options.variant) {
                    ed.setValue(val);
                    if (ed.options.change) ed.options.change.call(ed);
                }
            });
        }
        this.trigger("change");
    }
});