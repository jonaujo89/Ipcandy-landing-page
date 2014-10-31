lp.repeater = teacss.ui.control.extend({
    init: function (o) {
        this._super(o);
        this.element = this.options.element;
        this.options.name = this.element.data("name");
        this.addCovers();
    },
    
    addAfter: function (item) {
        var block = this.options.block;
        var def = teacss.ui.prop(block.getDefault(),this.options.name);
        var item_value = $.extend(true, {}, def[0]);
        
        var idx = item.index();
        if (idx==this.items.length-1)
            this.value.push(item_value);
        else
            this.value.splice(idx+1,0,item_value);
        
        var dummy = this.element.find("> [data-dummy]");
        dummy.clone().removeAttr("data-dummy").insertAfter(item);
        
        this.addCovers();
        this.bindEditors();
        this.trigger("change");
    },
    
    remove: function (item) {
        var idx = item.index();
        item.remove();
        
        this.value.splice(idx, 1);
        this.bindEditors();
        this.trigger("change");
    },
    
    addCovers: function () {
        var me = this;
        me.items = this.element.children(":not([data-dummy])");
        me.items.each(function(idx){
            var item = $(this);
            if (item.find("> .cmp-repeater-cover").length==0) {
                item.append(
                    $("<div class='cmp-repeater-cover'>").append(
                        $("<div class='fa fa-plus lp-button'>")
                            .mouseover(function(){ item.addCover.show() })
                            .mouseout (function(){ item.addCover.hide() })
                            .click(function(){ me.addAfter(item) })
                        ,
                        $("<div class='fa fa-trash-o lp-button'>")
                            .mouseover(function(){ item.removeCover.show() })
                            .mouseout (function(){ item.removeCover.hide() })
                        .click(function(){ me.remove(item) })
                    ),
                    item.removeCover = $("<div class='cmp-cover fa fa-trash-o'>").css({opacity:1}).hide(),
                    item.addCover = $("<div class='cmp-cover cmp-add-cover'>").css({opacity:1}).hide()
                );
            }
        });
    },
    
    bindEditors: function () {
        var me = this;
        me.items.each(function(idx){
            $(this).find("[data-editor]").each(function(){
                var name_old = $(this).data("name");
                var sub = name_old.substring((me.options.name+".").length);
                var parts = sub.split(".");
                parts[0] = idx;
                var name = me.options.name+"."+parts.join(".");
                
                if (name!=name_old) {
                    $(this).attr("data-name",name);
                    var editor = $(this).data("editor-control");
                    if (editor) editor.options.name = name;
                }
            });
        });
        this.options.block.bindEditors();
    }
});
