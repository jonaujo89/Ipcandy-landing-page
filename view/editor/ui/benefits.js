lp.benefits = lp.block.extendOptions({
    change: function () {
       
        var me = this;        
        
        if(me.value.background_color){
            me.element.find(".benefits_"+this.value.variant).css({
                background: me.value.background_color || '',
            });
        }
        
        this.variant.find(".title").toggle(this.value.show_title);
        this.variant.find(".title_2").toggle(this.value.show_title_2);
        
        if (this.value.variant == 1) { 
            this.variant.find(".name").toggle(this.value.show_benefits_name);
            this.variant.find(".desc").toggle(this.value.show_benefits_desc);
            this.variant.find(".item_list").toggleClass("hide_ico_border",!this.value.show_icon_border);
        }
        if (this.value.variant == 2) {
            this.variant.find(".name").toggle(this.value.show_benefits_name);
            this.variant.find(".desc").toggle(this.value.show_benefits_desc);            
        }
        if (this.value.variant == 3) {
            this.variant.find(".name").toggle(this.value.show_benefits_name);
            this.variant.find(".item_list").toggleClass("hide_name",!this.value.show_benefits_name);
        }
        if (this.value.variant == 4) {
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_border_image);
        }
        if (this.value.variant == 5) {
            this.variant.find(".name").toggle(this.value.show_benefits_name);
            this.variant.find(".desc").toggle(this.value.show_benefits_desc);
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_border_image);
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
                name: "show_icon_border", label: _t("Show border from icon"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_benefits_name", label: _t("Show name benefit"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,3,5] }
            },
            { 
                name: "show_benefits_desc", label: _t("Show description benefit"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,5] }
            },
            { 
                name: "show_border_image", label: _t("Show border from image"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [4,5] }
            },
            
            
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            }
            
        ]
    }
});