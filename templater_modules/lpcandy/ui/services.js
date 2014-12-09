lp.services = lp.block.extendOptions({
    change: function(){
		
        this.cmp.element.find(".services").css({
            background: this.value.background || '',
        }); 
        
        this.variant.find(".title").toggle(this.value.show_title);
        this.variant.find(".title_2").toggle(this.value.show_title_2);
        
        if (this.value.variant==1) {
            this.variant.find(".img_wrap").toggle(this.value.show_image);            
            this.variant.find(".desc").toggle(this.value.show_desc);
            this.variant.find(".price").toggle(this.value.show_price);   
            this.variant.find(".btn_wrap").toggle(this.value.show_order_button);
        }
        
        if (this.value.variant==2) {                      
            this.variant.find(".desc").toggle(this.value.show_desc);
            this.variant.find(".price").toggle(this.value.show_price);   
            this.variant.find(".btn_wrap").toggle(this.value.show_order_button);
            this.variant.find(".item").toggleClass("hide_shadow",!this.value.show_shadow_image);  
            this.variant.find(".item_list").prop("class","item_list "+this.value.image_format); 
        }
        
        if (this.value.variant==3) {
            this.variant.find(".desc").toggle(this.value.show_desc);
            this.variant.find(".price").toggle(this.value.show_price);
            this.variant.find(".btn_note").toggle(this.value.show_text_above_button);
            this.variant.find(".btn_wrap").toggle(this.value.show_order_button);
            this.variant.find(".item").toggleClass("hide_shadow",!this.value.show_shadow_image);  
            this.variant.find(".img_data").prop("class","img_data "+this.value.image_size);
        }
        
        if (this.value.variant==4) {
            this.variant.find(".img_wrap").toggle(this.value.show_image); 
            this.variant.find(".desc").toggle(this.value.show_desc);
            this.variant.find(".price").toggle(this.value.show_price);
            this.variant.find(".btn_wrap").toggle(this.value.show_order_button);
        }
        
        if (this.value.variant==5) {
            this.variant.find(".img_wrap").toggle(this.value.show_image); 
            this.variant.find(".desc").toggle(this.value.show_desc);
            this.variant.find(".price").toggle(this.value.show_price);
            this.variant.find(".btn_wrap").toggle(this.value.show_order_button);
            this.variant.find(".item_list").prop("class","item_list "+this.value.image_format);
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
                name: "show_image", label: "Show image", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,4,5] }
            },
            { 
                name: "show_name", label: "Show name", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [] }
            },
            { 
                name: "show_desc", label: "Show description", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5] }
            }, 
            { 
                name: "show_price", label: "Show price", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5] }
            }, 
            { 
                name: "show_text_above_button", label: "Show text above order button", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_order_button", label: "Show order button", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5] }
            },
            { 
                name: "show_shadow_image", label: "Show shadow", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [2,3] }
            },
            { type: "label", value: "Image size:", margin: "5px 49% 0px 0px", showWhen: { variant: [3] }},
            { 
                name: "image_size",
                items: [{ label: "middle<br>", value:"image_middle"},{ label: "large", value:"image_large"}],
                type: "radio", width: "auto", height: 50, 
                margin: "0px 49% 5px 0px", showWhen: { variant: [3] }
            },
            { type: "label", value: "Image format:", margin: "5px 49% 0px 0px", showWhen: { variant: [2] }},
            { 
                name: "image_format",
                items: [{ label: "circle<br>", value:"circle"},{ label: "square", value:"square"}],
                type: "radio", width: "auto", height: 50, 
                margin: "0px 49% 5px 0px", showWhen: { variant: [2,5] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});