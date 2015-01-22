lp.repeater = teacss.ui.control.extend({
    init: function (o) {
        this._super($.extend({
            addItemText: _t("Add Item"),
            sortable: true
        },o));
        this.element = this.options.element;
        this.options.name = this.element.data("name");
        this.addCovers();
        
        var me = this;
        this.element.on("click",".lp-config-button",function(){
            var item = $(this).parents(".item_block:not([data-dummy])").eq(0);
            me.config({my:"left top",at:"right top",of:$(this)},item)
        });
    },
    
    // get index inside this.value for item
    itemIndex: function (item) {
        item = $(item);
        var idx = this.items.index(item);
        if (idx==-1) {
            // cloned item
            var idx = item.index();
            var last_idx = this.items.last().index();
            
            if (idx > last_idx)
                return idx - last_idx - 1 - 1 // second -1 for dummy;
            else
                return last_idx - idx + 1;
        } else {
            return idx;
        }
    },
    
    // get all items for index (cloned ones too)
    indexItems: function (idx) {
        var last_idx = this.items.last().index();
        var all = this.element.children(); 
        return this.items.eq(idx)
            .add(all.eq(last_idx+idx+1+1)) // second +1 for dummy
            .filter(".item_block:not([data-dummy])");
    },
    
    config: function (pos,item) {
        var me = this;
        var idx = me.itemIndex(item);
        var sub = me.value[idx];
        
        lp.block.prototype.config.call({
            Class: me.Class,
            options: { configForm: me.options.configForm },
            value: sub,
            trigger: function(type) {
                if (type!="change") return;
                me.value[idx] = this.value;
                if (me.options.itemChange) {
                    var val = this.value;
                    me.indexItems(idx).each(function(){
                        me.options.itemChange.call(me,val,$(this));
                    });
                }
                me.trigger("change");
            },
        },pos);
    },
    
    addAfter: function (item) {
        var block = this.options.block;
        var def = teacss.ui.prop(block.getDefault(),this.options.name);
        var item_value = $.extend(true, {}, def[0]);
        
        var idx = item ? this.itemIndex(item) : -1;
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
        
        this.trigger("change");
        
        this.addCovers();
        this.bindEditors();
    },
    
    remove: function (item) {
        var idx = this.itemIndex(item);
        this.indexItems(idx).remove();
        
        this.value.splice(idx, 1);
        this.trigger("change");
        
        this.bindEditors();
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
                
                if (me.options.configForm) {
                    item.cover.append(
                        $("<div class='fa fa-gear lp-button lp-config-button'>")
                    );
                }
                if (!me.options.inline) {
                    item.cover.append(
                        $("<div class='fa fa-plus lp-button'>")
                        .mouseover(function(){ item.addCover.show() })
                        .mouseout (function(){ item.addCover.hide() })
                        .click(function(){ me.addAfter(item) })
                    );
                } else {
                    item.cover.addClass("cmp-repeater-cover-inline");
                    if (me.options.sortable) item.cover.append(
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
                me.addButtonWrap = $("<div class='lp-button-repeater-add-wrap'>").append(
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
            oldIndex = me.itemIndex(dragging);
        })
        .bind("dragend",function(e){
            var newIndex = me.itemIndex(dragging);
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
            
            if (me.itemIndex(dragging)<me.itemIndex(this)) {
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
                if (name_old.indexOf(me.options.name)!==0) return;
                
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
        this.options.block.bindEditors(true);
    }
});
