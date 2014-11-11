lp.repeater = teacss.ui.control.extend({
    init: function (o) {
        this._super($.extend({
            addItemText: "Add Item"
        },o));
        this.element = this.options.element;
        this.options.name = this.element.data("name");
        this.addCovers();
    },
    
    addAfter: function (item) {
        var block = this.options.block;
        var def = teacss.ui.prop(block.getDefault(),this.options.name);
        var item_value = $.extend(true, {}, def[0]);
        
        var idx = item ? item.index() : -1;
        if (idx==this.items.length-1 || idx==-1)
            this.value.push(item_value);
        else
            this.value.splice(idx+1,0,item_value);
        
        var dummy = this.element.find("> [data-dummy]");
        var new_item = dummy.clone().removeAttr("data-dummy");
        
        if (item) 
            new_item.insertAfter(item); 
        else 
            new_item.insertBefore(dummy); 
        
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
        me.items = this.element.children(".item_block:not([data-dummy])");
        me.items.each(function(idx){
            var item = $(this);
            if (item.find("> .cmp-repeater-cover").length==0) {
                item.append(
                    item.cover = $("<div class='cmp-repeater-cover'>"),
                    item.removeCover = $("<div class='cmp-cover fa fa-trash-o'>").css({opacity:1}).hide(),
                    item.dragCover = $("<div class='cmp-cover cmp-drag-cover fa fa-arrows'>").css({opacity:1}).hide(),
                    item.addCover = $("<div class='cmp-cover cmp-add-cover'>").css({opacity:1}).hide()
                );
                if (!me.options.inline) {
                    item.cover.append(
                        $("<div class='fa fa-plus lp-button'>")
                        .mouseover(function(){ item.addCover.show() })
                        .mouseout (function(){ item.addCover.hide() })
                        .click(function(){ me.addAfter(item) })
                    );
                } else {
                    item.cover.addClass("cmp-repeater-cover-inline");
                    item.cover.append(
                        $("<div class='fa fa-arrows lp-button lp-drag-handle'>")
                        .mouseover(function(){ item.dragCover.show() })
                        .mouseout (function(){ item.dragCover.hide() })
                    );
                }
                item.cover.append(
                    $("<div class='fa fa-trash-o lp-button'>")
                    .mouseover(function(){ item.removeCover.show() })
                    .mouseout (function(){ item.removeCover.hide() })
                    .click(function(){ me.remove(item) })
                );
            }
        });
        if (!me.addButton && me.options.inline) {
            me.element.append(
                $("<div class='lp-button-repeater-add-wrap'>").append(
                    me.addButton = $("<div class='fa fa-plus lp-button lp-button-repeater-add'>")
                        .text(me.options.addItemText)
                        .click(function(){ me.addAfter() })
                )
            );
        }
        if (me.options.inline) me.initSorting();
    },
    
    initSorting: function () {
        var me = this;
        var isHandle = false;
        var dragging = null;
        var dragTimeout = false;
        var oldIndex = 0;
        
        me.items.find(".lp-drag-handle").unbind("mousedown mouseup").mousedown(function() {
			isHandle = true;
		}).mouseup(function() {
			isHandle = false;
		});
        me.items.unbind("dragstart dragover dragenter drop dragend").attr("draggable","true")
        .bind("dragstart",function(e){
			if (!isHandle) return false;
			isHandle = false;
			var dt = e.originalEvent.dataTransfer;
			dt.effectAllowed = 'move';
			dt.setData('Text', 'dummy');
            
            dragging = this;
            me.element.addClass("dragging");
            oldIndex = $(dragging).index();
        })
        .bind("dragend",function(e){
            var newIndex = $(dragging).index();
            dragging = null;
            me.element.find(".cmp-drag-cover").hide();
            me.element.removeClass("dragging");
            if (oldIndex!=newIndex) {
                me.value.splice(newIndex,0,me.value.splice(oldIndex,1)[0]);
                me.trigger("change");
            }
        })
        .bind("dragover",function(e){
			e.preventDefault();
			e.originalEvent.dataTransfer.dropEffect = 'none';
            
            if (this==dragging) return;
            if (dragTimeout) return;
            
            if ($(dragging).index()<$(this).index()) {
                $(dragging).insertAfter(this);
            } else {
                $(dragging).insertBefore(this);
            }
            dragTimeout = true;
            setTimeout(function(){ dragTimeout = false },100);
            return false;
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
