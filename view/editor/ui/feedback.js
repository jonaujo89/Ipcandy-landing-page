lp.feedback = lp.block.extendOptions({
    change: function(){
        this.variant.find(".feedback").css({
            background: this.value.background_color || '',
        }); 
        
        if (this.value.variant == 1) {  
            this.variant.find(".title").toggleVis(this.value.show_title);
            this.variant.find(".title_2").toggleVis(this.value.show_title_2);
            this.variant.find(".img_wrap").toggleVis(this.value.show_image);            
        }       
           
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_image", label: _t("Show image"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background_color"  
            }
        ]
    }
});