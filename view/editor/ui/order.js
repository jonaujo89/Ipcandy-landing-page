lp.order = lp.block.extendOptions({
    change: function () {
        if(this.value.background){
            this.variant.find(".order_"+this.value.variant).css({
                backgroundImage: "url("+base_url+"/"+(this.value.background)+")",
            });
        }
        
        if(this.value.background_color){
            this.variant.find(".order_"+this.value.variant).css({
                background: this.value.background_color || '',
            });
        }

        if (this.value.variant == 1) {
            this.variant.find(".form_title_2").toggleVis(this.value.show_form_title_2);
            this.variant.find(".form_bottom").toggleVis(this.value.show_form_bottom_text);
        }
        
        if (this.value.variant == 2) {
            this.variant.find(".btn_note").toggleVis(this.value.show_text_above_button);
            this.variant.find(".btn_wrap").toggleClass('no_btn_note',!this.value.show_text_above_button);
            this.variant.find(".btn_wrap").toggleClass("no_arrow",!this.value.show_arrow);
            
            if (this.value.show_background_noise) {
                this.variant.find(".background_toggle_noise").addClass("with_noise").removeClass("dark");            
            } else {
                this.variant.find(".background_toggle_noise").removeClass("with_noise").addClass("dark");
            }
        }
        
        if (this.value.variant == 3) {
            this.variant.find(".title_2").toggleVis(this.value.show_title_2);
            this.variant.find(".img_wrap").toggleClass("hide_border",!this.value.show_border);
            this.variant.find(".list").toggleVis(this.value.show_list_box);
        }
        
        if (this.value.variant == 4) {
            this.variant.find(".title_2").toggleVis(this.value.show_title_2);
            this.variant.find(".img_wrap").toggleClass("hide_box_shadow",!this.value.show_box_shadow);
            this.variant.find(".form_bottom").toggleVis(this.value.show_form_bottom_text);
        }
        
        if (this.value.variant == 5) {
            this.variant.find(".title_2").toggleVis(this.value.show_title_2);
            this.variant.find(".form_bottom").toggleVis(this.value.show_form_bottom_text);
        }
        
        if (this.value.variant == 6) {
            this.variant.find(".title_2").toggleVis(this.value.show_title_2);
            this.variant.find(".title_3").toggleVis(this.value.show_title_3);
            this.variant.find(".content_wrap").prop("class","content_wrap align_"+this.value.form_align);
            this.variant.find(".form_bottom").toggleVis(this.value.show_form_bottom_text);
        }      
        
    },
    configForm: {
        items: [            
            { type: "label", value: _t("Background image:"), margin: "5px 0", showWhen: { variant: [1,2,6] }},
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
                        for (var i=1;i<=221;i++) {
                            items.push({
                                value:"view/editor/assets/background/"+i+".jpg",
                                thumb:"view/editor/assets/background/thumbs/"+i+".jpg",
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
                                backgroundImage:"url("+base_url+"/"+(item.thumb || item.value)+")"
                            })
                        );
                    }
                }), 
                showWhen: { variant: [1,2,6] }
            },  
            { 
                name: "show_background_noise", label: _t("Show noise"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2] }
            },
            { 
                name: "show_text_above_button", label: _t("Show text above the button"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2] }
            },
            { 
                name: "show_arrow", label: _t("Show arrow"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2] }
            },
            { 
                name: "show_form_title_2", label: _t("Show text under the form title"), type: "checkbox", width: "auto",  value: 1,
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [3,4,5,6] }
            },
            { 
                name: "show_title_3", label: _t("Show third title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [6] }
            },
            { 
                name: "show_form_bottom_text", label: _t("Show text under the form"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,4,5,6] }
            },
            { 
                name: "show_border", label: _t("Show image around"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_box_shadow", label: _t("Show image around"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [4] }
            },
            { 
                name: "show_list_box", label: _t("Show list box"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [3] }
            },
            { type: "label", value: _t("Form align:"), margin: "10px 0 0 0", showWhen: { variant: [6] }},
            { 
                name: "form_align",
                items: [{ label: _t("left<br>"), value:"left"},{ label: _t("center<br>"), value:"center"},{ label: _t("right"), value:"right"}],
                type: "radio", width: "auto",  
                margin: "0px 0px 5px 0px", showWhen: { variant: [6] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0", showWhen: { variant: [4,5] }},
             { 
                type: lp.color, name: "background_color",  
                items: [
                    { value: "#313138"},
                    { value: "#143A4F"},
                    { value: "#19678B"},
                    { value: "#4E6D8D"},
                    { value: "#607FA4"},
                    { value: "#0E93B3"},
                    { value: "#1E4147"},
                    { value: "#198B82"},
                    { value: "#0C884A"},
                    { value: "#393458"},
                    { value: "#583458"},
                    { value: "#614C8A"},
                    { value: "#8C0C24"},
                    { value: "#593D36"}
                ], 
                showWhen: { variant: [4,5] }
            },
            { type: "label", value: _t("Background texture:"), margin: "5px 0", showWhen: { variant: [3] }},
             { 
                name: "background", width: '95px',
                type: ui.combo.extendOptions({
                    panelClass: "only-icons",
                    comboWidth: 480,
                    comboHeight: 600,
                    closeOnSelect: false,
                    icons: {secondary:'ui-icon-triangle-1-s'},
                    items: function () {
                        var items = [];
                        for (var i=1;i<=24;i++) {
                            items.push({
                                value:"view/editor/assets/texture/"+i+".png",
                            });
                        }
                        return items;
                    },
                    itemTpl: function (item) {
                        return $("<div class='combo-item'>").append(
                            $("<div>").css({
                                width: 50,
                                height: 50,
                                backgroundSize: "cover",
                                backgroundPosition: "auto 100%",
                                backgroundImage:"url("+base_url+"/"+item.value+")"
                            })
                        );
                    }
                }), 
                showWhen: { variant: [3] }
            },
            
        ]
    }
});