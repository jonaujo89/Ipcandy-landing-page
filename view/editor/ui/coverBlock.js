lp.coverBlock = lp.block.extendOptions({
    change: function () {
        this.variant.find(".title, .sub_title").toggleVis(this.value.show_title);
        this.variant.find(".title_2,.sub_title_2").toggleVis(this.value.show_title_2);

        if(this.value.background) {
            this.variant.find(".cover_"+this.value.variant).css({
                backgroundImage: "url("+base_url+"/"+(this.value.background)+")",
            });
        }

        if (this.value.variant==1 || this.value.variant==2) {
            this.variant.find(".icon").toggleVis(this.value.show_icon);
            this.variant.find(".form_inline").toggleVis(this.value.show_form && !this.value.show_form_as_popup);
            this.variant.find(".form_popup").toggleVis(this.value.show_form && this.value.show_form_as_popup);
            this.variant.find(".description").toggleVis(this.value.show_description);
        }
    },
    configForm: {
        items: [
            { name: "show_icon", label: _t("Show icon"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px", showWhen: { variant: [1,2] } },
            { name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px" },
            { name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px" },
            { name: "show_form", label: _t("Show form"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px", showWhen: { variant: [1,2] } },
            { name: "show_form_as_popup", label: _t("Show form as popup"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px", showWhen: { variant: [1,2] } },
            { name: "show_description", label: _t("Show description"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px", showWhen: { variant: [1,2] } },

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