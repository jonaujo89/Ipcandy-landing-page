lp.services = lp.block.extendOptions({
    change: function(){
        this.cmp.element.find(".services").css({
            background: this.value.background || '',
        }); 
        
        this.variant.find(".title").toggle(this.value.show_title);
        this.variant.find(".title_2").toggle(this.value.show_title_2);
        
        if (this.value.variant==1) {
            this.variant.find(".img").toggle(this.value.show_image);            
            this.variant.find(".desc").toggle(this.value.show_desc);
            this.variant.find(".price").toggle(this.value.show_price);   
            this.variant.find(".btn_wrap").toggle(this.value.show_order_button);
        }
        
        if (this.value.variant==2) {
        }
        
        if (this.value.variant==3) {
        }
        
        if (this.value.variant==4) {
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
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_name", label: "Show name", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [] }
            },
            { 
                name: "show_desc", label: "Show description", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            }, 
            { 
                name: "show_price", label: "Show price", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            }, 
            { 
                name: "show_order_button", label: "Show order button", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});