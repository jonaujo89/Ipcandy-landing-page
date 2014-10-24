window.lp = {};
lp.block = teacss.ui.control.extend({
    init: function (cmp) {
        this._super({});
        var me = this;
        this.cmp = cmp;
        this.variantValues = {};
        
        this.configButton = $("<div class='fa fa-gear lp-button right'>");
        this.dragButton   = $("<div class='fa fa-arrows lp-button right draggable'>").data("component",cmp);
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
    
    showCurrent: function (val) {
        var me = this;
        var variant = this.variants.hide().eq(this.current-1);
        var def = $.parseJSON(variant.attr("data-default"))
        
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
            var sub_val = me.value[editor.options.name];
            editor.setValue(sub_val);
        });
    },
    
    setValue: function (val) {
        this._super(val);
        this.id = val.id;
        this.type = val.type;
        
        var me = this;
        this.cmp.componentHandle.detach();
        if (this.controls) return;
        
        me.editors = [];
        this.cmp.element.find("[data-editor]").each(function(){
            var editorName = $(this).attr("data-editor");
            var editor = Component.classFromName(editorName)($(this));

            var name = $(this).attr("data-name");
            if (name) {
                editor.options.name = name;
                me.editors.push(editor);
                editor.bind("change",function(){
                    me.editorChange(name,editor.getValue());
                });
            }
        });
        
        me.controls = $("<div class='cmp-controls'>").appendTo(this.cmp.element);
        me.variants = this.cmp.element.children("[data-variant]");
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
        this.value[name] = val;
        this.trigger("change");
    }
});