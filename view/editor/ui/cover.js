lp.cover = lp.block.extendOptions({
    change: function () {
        if(this.value.background) {
            this.variant.find(".cover_"+this.value.variant).css({
                backgroundImage: "url("+base_url+"/"+(this.value.background)+")",
            });
        }
    },
    configForm: {
        items: [
            { type: "label", value: _t("Background image:"), margin: "5px 0"},
            {
                name: "background", width: 245,
                type: ui.combo.extendOptions({
                    panelClass: "only-icons",
                    comboWidth: 660,
                    comboHeight: 600,
                    closeOnSelect: false,
                    icons: {secondary:'ui-icon-triangle-1-s'},
                    items: function () {
                        var items = [];
                        for (var i=1;i<=100;i++) {
                            items.push({
                                value:Component.app.options.assets_url+"/cover/cover-"+i+".jpg",
                                thumb:Component.app.options.assets_url+"/cover/thumbs/cover-"+i+".jpg",
                            });
                        }
                        return items;
                    },
                    itemTpl: function (item) {
                        return $("<div class='combo-item'>").append(
                            $("<div>").css({
                                width: 200,
                                height: 112,
                                backgroundSize: "cover",
                                backgroundPosition: "50% 50%",
                                backgroundImage:"url("+base_url+"/"+(item.thumb || item.value)+")"
                            })
                        );
                    }
                })
            },
            {
                name: 'background', type: 'uploadButton', label: _t('Upload image file')
            },
        ]
    }
})