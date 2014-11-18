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
            this.variant.find(".item_list").toggleClass("hide_ico_border",!this.value.show_icon_border);
        }
        if (this.value.variant == 2) {

        }
        if (this.value.variant == 3) {

        }
        if (this.value.variant == 4) {

        }
        if (this.value.variant == 5) {

        }
        
    },
    configForm: {
        items: [            
            { 
                name: "show_title", label: "Show first title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { 
                name: "show_title_2", label: "Show second title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { 
                name: "show_icon_border", label: "Show border from icon", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_benefits_name", label: "Show benefits name", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_benefits_desc", label: "Show benefits description", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            
            
            
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            }
            
        ]
    }
});