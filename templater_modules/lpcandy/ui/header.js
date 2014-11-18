lp.header = lp.block.extendOptions({
    change: function(){
        this.cmp.element.find(".header").css({
            background: this.value.background || '',
        });  
        
        if (this.value.variant==2) {
            var flag = this.value.show_order_button;
            this.variant.find(".span_btn").toggle(flag);
            this.variant.find(".phone").toggleClass("no_btn",!flag);
        }
        
        if (this.value.variant==3) {
            var flag = this.value.show_desc_and_order_button;
            this.variant.find(".span_btn").toggle(flag); 
            this.variant.find(".desc_2").toggle(flag);
            this.variant.find(".desc_1").toggleClass('no_btn',!flag);
            this.variant.find(".phone").toggleClass('no_btn',!flag);
        }
        
        if (this.value.variant==4) {
            var flag = this.value.show_order_button;
            this.variant.find(".span_btn").toggle(flag);
            this.variant.find(".phone").toggleClass("no_btn",!flag);
            this.variant.find(".desc").toggle(this.value.logo.type!="image");
        }
    },
    configForm: {
        items: [                                   
            { 
                name: "show_desc_and_order_button", label: "Show description and order button", type: "check", width: "auto", height: 27, 
                margin: "10px 0 10px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_order_button", label: "Show order button", type: "check", width: "auto", height: 27, 
                margin: "10px 0 10px 0px", showWhen: { variant: [2,4] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});

