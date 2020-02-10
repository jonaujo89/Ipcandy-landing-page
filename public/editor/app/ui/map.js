lp.map = lp.block.extendOptions({
    change: function(){  
        if (this.value.variant == 1) {  
            this.variant.find(".container_text").toggleVis(this.value.show_container_text);    
        } 

        if (this.value.variant == 2 || this.value.variant == 3 || this.value.variant == 4 || this.value.variant == 5) {  
            this.variant.find(".title, .sub_title").toggleVis(this.value.show_title);
            this.variant.find(".title_2, .sub_title_2").toggleVis(this.value.show_title_2);  
        }

        if ([2,3,4,5,6].indexOf(this.value.variant)!=-1) {
            if(this.value.background_color){
                this.variant.find(".contacts_"+this.value.variant).css({
                    background: this.value.background_color || '',
                });
            }            
        }

        var jq = Component.previewFrame.window.$; 
        jq(this.element.find(".map")).mapYandexRedraw();
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2,3,4,5] }
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2,3,4,5] }
            },
            { 
                name: "show_container_text", label: _t("Show text"), type: "checkbox", width: "auto", margin: "5px 0 0 0",
                showWhen: { variant: [1] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0", showWhen: { variant: [2,3,4,5,6] }},
            { 
                type: lp.blockColor, name: "background_color",
                showWhen: { variant: [2,3,4,5] }
            },
            { 
                type: lp.darkBlockColor, name: "background_color",  
                showWhen: { variant: 6 }
            }
        ]
    }
});