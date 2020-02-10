lp.stickyMenu = lp.block.extend({
    init: function (o) {
        var me = this;
        this._super(o);

        Component.previewFrame.bind("change",function(){
            if (me.changing) return;
            me.changing = true;

            var newItems = [];
            var savedItems = me.value.items || [];

            Component.previewFrame.getValue().template.children.forEach(function(block){
                if (block.value.type=="StickyMenu") return;
                
                var found = false;
                savedItems.forEach(function(item,idx){ if (item.id==block.value.id) found = item; });
                newItems.push({
                    id: block.value.id,
                    enabled: found ? found.enabled : true,
                    title: found ? found.title : Component.app.components[block.value.type].name
                });
            });
            if (JSON.stringify(newItems)!=JSON.stringify(savedItems)) {
                me.value.items = newItems;
                me.trigger("change");
            }
            me.changing = false;
        });
    }
}).extendOptions({ 
    init: function() {
        var jq = Component.previewFrame.window.$;
        if (jq) {
            jq(this.element.find('.sticky_menu')).lpStickyMenu();
        }
    },
    change: function () {
        var $ul = this.element.find(".sticky_menu ul").empty();
        (this.value.items || []).forEach(function(item){
            if (!item.enabled) return;
            $ul.append($("<li>").append(
                $("<a>").attr("href","#").attr('data-id', '#'+item.id).text(item.title)
            ));
        });
        
        this.element.find(".empty-placeholder").toggleVis($ul.children().length==0);
        this.element.find(".toggler").toggleVis($ul.children().length!=0);
        this.element.find('.sticky_menu').toggleClass('dark', this.value.isDark);
    },
    configForm: {
        items: [
            {
                name:"items", type: ui.tableRepeater.extend({
                    init: function (o) {
                        this._super($.extend({
                            items: [
                                { type: "checkbox", name: "enabled", margin: 0 },
                                { type: "text", name: "title", margin: 0 },
                            ]
                        },o));
                        // remove item close link and footer
                        this.element.find("th").last().remove();
                        this.footer.detach();
                    },
                    // remove item close link
                    itemTemplate: function (el) {
                        var ret = this._super(el);
                        ret.find("td").last().remove();
                        return ret;
                    },
                    // slight repeater optimization
                    setValue: function (val) {
                        if (JSON.stringify(this.getValue())==JSON.stringify(val)) return;
                        this._super(val);
                    }
                }), margin: 0
            },
            { 
                name: "isDark", label: _t('Dark background'), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
        ]
    },
});

