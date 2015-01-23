lp.textBlock = lp.block.extendOptions({
    change: function(){
		
        this.cmp.element.find(".text_block").css({
            background: this.value.background_color || '',
        }); 
        
        if (this.value.variant == 1) {  
            this.variant.find(".title").toggleClass('hidden',!this.value.show_title);
            this.variant.find(".title_2").toggleClass('hidden',!this.value.show_title_2);  
            this.variant.find(".list_wrap").toggleClass('hidden',!this.value.show_list);
        }
        if (this.value.variant == 2) { 
            this.variant.find(".title").toggleClass('hidden',!this.value.show_title);
            this.variant.find(".title_2").toggleClass('hidden',!this.value.show_title_2);
            this.variant.find(".name").toggleClass('hidden',!this.value.show_name);
        }
        if (this.value.variant == 3) { 
            this.variant.find(".title").toggleClass('hidden',!this.value.show_title);
            this.variant.find(".title_2").toggleClass('hidden',!this.value.show_title_2);
        }
        if (this.value.variant == 4) { 
            this.variant.find(".text_title_2").toggleClass('hidden',!this.value.show_text_title_2);
        }
        if (this.value.variant == 5) { 
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_border);
        }
        if (this.value.variant == 6) { 
            this.variant.find(".title_2").toggleClass('hidden',!this.value.show_text_title_2);
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_border);
        }
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,3] }
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,3] }
            },
            { 
                name: "show_list", label: _t("Show list"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_name", label: _t("Show name cell"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2] }
            },
            { 
                name: "show_text_title_2", label: _t("Show description cell"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [4,6] }
            },
            { 
                name: "show_border", label: _t("Show border from image"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [5,6] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});