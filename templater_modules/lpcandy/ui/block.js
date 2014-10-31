window.lp = {};

lp.block = teacss.ui.control.extend({
    init: function (o) {
        this._super(o);
        var me = this;
        this.cmp = this.options.cmp;
        this.variantValues = {};
        this.variantDefault = {};
        
        if (this.options.configForm) {
            this.configButton = $("<div class='fa fa-gear lp-button right'>").click(function(){
                me.config({my:"right top",at:"right top+56px",of:me.configButton})
            });
        } else {
            this.configButton = "";
        }
        this.dragButton   = $("<div class='fa fa-arrows lp-button right draggable'>").data("component",me.cmp);
        this.removeButton = $("<div class='fa fa-trash-o lp-button right'>");
        
        this.prevButton = $("<div class='fa fa-chevron-left lp-button'>");
        this.nextButton = $("<div class='fa fa-chevron-right lp-button'>");
        
        this.dragButton.click(function(){});
        this.removeButton.click(function(){me.remove()});
        this.prevButton.click(function(){me.prev()});
        this.nextButton.click(function(){me.next()});
   },
    
    remove: function () {
        if (confirm("Sure to remove component?")) {
            this.cmp.remove();
        }
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
        function setVisible() {
            if (!me.Class.form.innerForm) return;
            var val = me.Class.form.getValue();
            $.each(me.Class.form.innerForm.items,function(i,item){
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
        }
        
        if (!this.Class.dialog) {
            var dialogWidth = 500;
            var dialogHeight = undefined;
            if (me.options.configForm.width) {
                dialogWidth = me.options.configForm.width;
                delete me.options.configForm.width;
            }
            if (me.options.configForm.height) {
                dialogHeight = me.options.configForm.height;
                delete me.options.configForm.height;
            }
            if (me.options.configForm.item) {
                this.Class.form = me.options.configForm.item({});
            } else {
                this.Class.form = teacss.ui.composite(me.options.configForm);
            }
            
            this.Class.dialog = teacss.ui.dialog({
                width: dialogWidth,
                height: dialogHeight,
                modal: true,
                title: me.options.configForm.title || "Settings",
                resizable: false,
                items: [
                    this.Class.form
                ],
                open: function (){
                    me.Class.dialog.detached.appendTo(me.Class.dialog.element);
                }
            });
            this.Class.form.bind("change",function(){
                me.Class.current.value = me.Class.form.getValue();
                setVisible();
                me.Class.current.trigger("change");
            });
            
            if (!lp.overlayClickBinded) {
                lp.overlayClickBinded = true;
                $("body").on("mousedown",'.ui-widget-overlay',function() {
                    $(".ui-dialog-content:visible").dialog("close");
                });            
            }            
        }
        this.Class.form.setValue(this.value);
        this.Class.current = this;
        setVisible();
        
        this.Class.dialog.detached = this.Class.dialog.element.children().detach();
        if (position) this.Class.dialog.element.dialog("option","position",position);
        this.Class.dialog.open();
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
            def,
            this.variantValues[this.current] || { type: me.type, id: me.id }
        );
        variant.show();

        $.each(me.editors,function(e,editor){
            var sub_val = teacss.ui.prop(me.value,editor.options.name);
            editor.setValue(sub_val);
        });
    },
    
    bindEditors: function () {
        var me = this;
        me.editors = [];
        this.cmp.element.find("[data-editor]:not([data-dummy] *)").each(function(){
            var editorName = $(this).attr("data-editor");
            
            var name = $(this).attr("data-name");
            var editor = $(this).data("editor-control");
            
            if (!editor && name) {
                editor = Component.classFromName(editorName)({element:$(this)});
                $(this).data("editor-control",editor);
                
                editor.options.name = name;
                editor.options.block = me;
                
                editor.bind("change",function(){
                    me.editorChange(name,editor.getValue());
                });
            }
            me.editors.push(editor);
        });        
    },
    
    setValue: function (val) {
        this._super(val);
        this.id = val.id;
        this.type = val.type;
        
        var me = this;
        this.cmp.componentHandle.detach();
        if (this.controls) return;
        
        me.bindEditors();
        
        me.controls = $("<div class='cmp-controls'>").appendTo(this.cmp.element);
        me.variants = this.cmp.element.children("[data-variant]").each(function(){
            me.variantDefault[$(this).attr("data-variant")] = $.parseJSON($(this).attr("data-default"));
            $(this).attr("data-default",null);
        });
        if (me.variants.length>1) {
            me.current = this.cmp.element.attr("data-current");
            me.controls.append(
                this.prevButton,
                this.nextButton
            );
        } else {
            me.current = 1;
        }
        me.showCurrent(val);

        me.controls.append(
            this.configButton,
            this.dragButton,
            this.removeButton                
        );
    },
    
    editorChange: function (name,val) {
        this.value = this.value || {};
        teacss.ui.prop(this.value,name,val);
        this.trigger("change");
    }
});