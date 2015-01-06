lp.services = lp.block.extendOptions({
    init: function () {
        var jq = Component.previewFrame.window.$;
        if(jq){
            jq('form .form_field_submit').click( function(event){  
                jq('form').formValidateSubmit(event);
                event.preventDefault();
            });
        }
    },    
    change: function () {
		var jq = Component.previewFrame.window.$;
        if(jq){
            jq('form .form_field_submit').click( function(event){  
                jq('form').formValidateSubmit(event);
                event.preventDefault();
            });
        }  
		
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
                name: "show_title", label: _t("Show first title"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { 
                name: "show_image", label: _t("Show image"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,4,5] }
            },
            { 
                name: "show_name", label: _t("Show name"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [] }
            },
            { 
                name: "show_desc", label: _t("Show description"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5] }
            }, 
            { 
                name: "show_price", label: _t("Show price"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5] }
            }, 
            { 
                name: "show_text_above_button", label: _t("Show text above order button"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_order_button", label: _t("Show order button"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5] }
            },
            { 
                name: "show_shadow_image", label: _t("Show shadow"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [2,3] }
            },
            { type: "label", value: _t("Image size:"), margin: "5px 49% 0px 0px", showWhen: { variant: [3] }},
            { 
                name: "image_size",
                items: [{ label: _t("middle<br>"), value:"image_middle"},{ label: _t("large"), value:"image_large"}],
                type: "radio", width: "auto",
                margin: "0px 49% 10px 0px", showWhen: { variant: [3] }
            },
            { type: "label", value: _t("Image format:"), margin: "5px 49% 0px 0px", showWhen: { variant: [2,5] }},
            { 
                name: "image_format",
                items: [{ label: _t("circle<br>"), value:"circle"},{ label: _t("square"), value:"square"}],
                type: "radio", width: "auto",
                margin: "0px 49% 10px 0px", showWhen: { variant: [2,5] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});