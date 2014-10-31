lp.icon = lp.cover.extendOptions({
    init: function () {
        this.cover.appendTo(this.element.find(".ico"));
    },
    change: function () {
        this.element.find(".ico").css({backgroundImage:"url("+base_url+"/"+this.value+")"});
    },
    configForm: {
        title: "Icon",
        width: 550,
        height: 500,
        item: ui.combo.extendOptions({
            panelClass: "only-icons lp-icon-panel",
            inline: true,
            height: "100%",
            margin: 0,
            name: "",
            items: function () {
                var items = [];
                for (var i=1;i<=841;i++) {
                    if (i>=285 && i<=289) continue;
                    if (i>=365 && i<=716) continue;
                    if (i>=743 && i<=766) continue;
                    items.push({value:"templater_modules/lpcandy/assets/ico/"+i+".png"});
                }
                return items;
            },
            itemTpl: function (item) {
                return $("<div class='combo-item'>").css({
                    backgroundImage:"url("+base_url+"/"+item.value+")"
                });
            }
        })
    }
})