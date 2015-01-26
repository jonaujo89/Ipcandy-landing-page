lp.benefits = lp.block.extendOptions({
    change: function () {
       
        var me = this;        
        
        if(me.value.background_color){
            me.variant.find(".benefits_"+this.value.variant).css({
                background: me.value.background_color || '',
            });
        }
        
        this.variant.find(".title").toggleVis(this.value.show_title);
        this.variant.find(".title_2").toggleVis(this.value.show_title_2);
        
        if (this.value.variant == 1) { 
            this.variant.find(".name").toggleVis(this.value.show_name_benefit);
            this.variant.find(".desc").toggleVis(this.value.show_desc_benefit);
            this.variant.find(".item_list").toggleClass("hide_ico_border",!this.value.show_icon_border);
        }
        if (this.value.variant == 2) {
            this.variant.find(".name").toggleVis(this.value.show_name_benefit);
            this.variant.find(".desc").toggleVis(this.value.show_desc_benefit);            
        }
        if (this.value.variant == 3) {
            this.variant.find(".name").toggleVis(this.value.show_name_benefit);
            this.variant.find(".item_list").toggleClass("hide_name",!this.value.show_name_benefit);
        }
        if (this.value.variant == 4) {
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_image_border);
        }
        if (this.value.variant == 5) {
            this.variant.find(".name").toggleVis(this.value.show_name_benefit);
            this.variant.find(".desc").toggleVis(this.value.show_desc_benefit);
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_image_border);
        }
        
    },
    configForm: {
        items: [            
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px",
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px",
            },
            { 
                name: "show_icon_border", label: _t("Show icon around"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_name_benefit", label: _t("Show name benefit"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,3,5] }
            },
            { 
                name: "show_desc_benefit", label: _t("Show description benefit"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,5] }
            },
            { 
                name: "show_image_border", label: _t("Show image around"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [4,5] }
            },
            
            
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background_color"  
            }
            
        ]
    }
});