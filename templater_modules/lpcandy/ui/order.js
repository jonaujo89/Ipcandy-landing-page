lp.order = lp.block.extendOptions({
    change: function () {
        this.cmp.element.find(".container-fluid").css({
            backgroundImage: "url("+base_url+this.value.background+")"
        })
    },
    configForm: {
        items: [
            { type: "label", value: "Background image:", margin: "5px 0"},
            { 
                name: "background", width: 225,
                type: ui.combo.extendOptions({
                    panelClass: "only-icons",
                    comboWidth: 660,
                    comboHeith: 600,
                    closeOnSelect: false,
                    icons: {secondary:'ui-icon-triangle-1-s'},
                    items: function () {
                        var items = [];
                        for (var i=1;i<=218;i++) {
                            items.push({
                                value:"templater_modules/lpcandy/assets/background/"+i+".jpg",
                                thumb:"templater_modules/lpcandy/assets/background/thumbs/"+i+".jpg",
                            });
                        }
                        return items;
                    },
                    itemTpl: function (item) {
                        return $("<div class='combo-item'>").append(
                            $("<div>").css({
                                width: 200,
                                height: 50,
                                backgroundSize: "cover",
                                backgroundPosition: "50% 50%",
                                backgroundImage:"url("+base_url+(item.thumb || item.value)+")"
                            })
                        );
                    }
                })
            }
            
        ]
    }
});