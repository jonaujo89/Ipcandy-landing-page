lp.textBlock = lp.block.extendOptions({
    change: function(){
		
        this.cmp.element.find(".text_block").css({
            background: this.value.background_color || '',
        }); 
        
        if (this.value.variant == 1) {  
            this.variant.find(".title").toggle(this.value.show_title);
            this.variant.find(".title_2").toggle(this.value.show_title_2);  
            this.variant.find(".list_wrap").toggle(this.value.show_list);
        }
        if (this.value.variant == 2) { 
            this.variant.find(".title").toggle(this.value.show_title);
            this.variant.find(".title_2").toggle(this.value.show_title_2);
            this.variant.find(".name").toggle(this.value.show_name);
        }
        if (this.value.variant == 3) { 
            this.variant.find(".title").toggle(this.value.show_title);
            this.variant.find(".title_2").toggle(this.value.show_title_2);
        }
        if (this.value.variant == 4) { 
            this.variant.find(".text_title_2").toggle(this.value.show_text_title_2);
        }
        if (this.value.variant == 5) { 
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_border);
        }
        if (this.value.variant == 6) { 
            this.variant.find(".title_2").toggle(this.value.show_title_2);
            this.variant.find(".item_list").toggleClass("hide_border",!this.value.show_border);
        }
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: "Show first title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3] }
            },
            { 
                name: "show_title_2", label: "Show second title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,6] }
            },
            { 
                name: "show_list", label: "Show list", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_name", label: "Show name", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [2] }
            },
            { 
                name: "show_text_title_2", label: "Show description", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [4] }
            },
            { 
                name: "show_border", label: "Show border", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [5,6] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});