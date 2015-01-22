lp.cases = lp.block.extendOptions({
    change: function(){
        this.cmp.element.find(".cases").css({
            background: this.value.background_color || '',
        }); 
        
        if (this.value.variant == 1) {  
            this.variant.find(".title").toggle(this.value.show_title);
            this.variant.find(".title_2").toggle(this.value.show_title_2);
            this.variant.find(".name").toggle(this.value.show_name);            
            this.variant.find(".desc").toggle(this.value.show_desc); 
        }
            
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
            { 
                name: "show_name", label: _t("Show name company"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
            { 
                name: "show_desc", label: _t("Show branch company"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            }, 
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});