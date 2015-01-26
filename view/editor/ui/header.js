lp.header = lp.block.extendOptions({   
    change: function () {
        this.variant.find(".header").css({
            background: this.value.background || '',
        });  
        
        if (this.value.variant==2) {
            var flag = this.value.show_order_button;
            this.variant.find(".span_btn").toggleVis(flag);
            this.variant.find(".phone").toggleClass("no_btn",!flag);
        }
        
        if (this.value.variant==3) {
            var flag = this.value.show_desc_and_order_button;
            this.variant.find(".span_btn").toggleVis(flag); 
            this.variant.find(".desc_2").toggleVis(flag);
            this.variant.find(".desc_1").toggleClass('no_btn',!flag);
            this.variant.find(".phone").toggleClass('no_btn',!flag);
        }
        
        if (this.value.variant==4) {
            var flag = this.value.show_order_button;
            this.variant.find(".span_btn").toggleVis(flag);
            this.variant.find(".phone").toggleClass("no_btn",!flag);
            this.variant.find(".desc").toggleClass("hidden",this.value.logo.type=="image");
        }
    },
    configForm: {
        items: [                                   
            { 
                name: "show_desc_and_order_button", label: _t('Show description and order button'), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_order_button", label: _t("Show order button"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2,4] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background"  
            }
        ]
    }
});

