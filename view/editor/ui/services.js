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
		
        this.variant.find(".services").css({
            background: this.value.background || '',
        }); 
        
        this.variant.find(".title").toggleVis(this.value.show_title);
        this.variant.find(".title_2").toggleVis(this.value.show_title_2);
        
        if (this.value.variant==1) {
            this.variant.find(".img_wrap").toggleVis(this.value.show_image);            
            this.variant.find(".desc").toggleVis(this.value.show_desc);
            this.variant.find(".price").toggleVis(this.value.show_price);   
            this.variant.find(".btn_wrap").toggleVis(this.value.show_order_button);
        }
        
        if (this.value.variant==2) {                      
            this.variant.find(".desc").toggleVis(this.value.show_desc);
            this.variant.find(".price").toggleVis(this.value.show_price);   
            this.variant.find(".btn_wrap").toggleVis(this.value.show_order_button);
            this.variant.find(".item").toggleClass("hide_shadow",!this.value.show_image_shadow);  
            this.variant.find(".item_list").prop("class","item_list "+this.value.image_shape); 
        }
        
        if (this.value.variant==3) {
            this.variant.find(".desc").toggleVis(this.value.show_desc);
            this.variant.find(".price").toggleVis(this.value.show_price);
            this.variant.find(".btn_note").toggleVis(this.value.show_text_above_button);
            this.variant.find(".btn_wrap").toggleVis(this.value.show_order_button);
            this.variant.find(".item").toggleClass("hide_shadow",!this.value.show_image_shadow);  
            this.variant.find(".img_data").prop("class","img_data image_"+this.value.image_size);
        }
        
        if (this.value.variant==4) {
            this.variant.find(".img_wrap").toggleVis(this.value.show_image); 
            this.variant.find(".desc").toggleVis(this.value.show_desc);
            this.variant.find(".price").toggleVis(this.value.show_price);
            this.variant.find(".btn_wrap").toggleVis(this.value.show_order_button);
        }
        
        if (this.value.variant==5) {
            this.variant.find(".img_wrap").toggleVis(this.value.show_image); 
            this.variant.find(".desc").toggleVis(this.value.show_desc);
            this.variant.find(".price").toggleVis(this.value.show_price);
            this.variant.find(".btn_wrap").toggleVis(this.value.show_order_button);
            this.variant.find(".item_list").prop("class","item_list "+this.value.image_shape);
        }

    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px",
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px",
            },
            { 
                name: "show_image", label: _t("Show image"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,4,5] }
            },
            { 
                name: "show_name", label: _t("Show name"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [] }
            },
            { 
                name: "show_desc", label: _t("Show description"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,3,4,5] }
            }, 
            { 
                name: "show_price", label: _t("Show price"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,3,4,5] }
            }, 
            { 
                name: "show_text_above_button", label: _t("Show text above order button"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_order_button", label: _t("Show order button"), type: "checkbox", width: "100%",  
                margin: "5px 80% 0px 0px", showWhen: { variant: [1,2,3,4,5] }
            },
            { 
                name: "show_image_shadow", label: _t("Show image shadow"), type: "checkbox", width: "auto",  
                margin: "5px 0 0 0", showWhen: { variant: [2] }
            },
            { 
                name: "show_image_shadow", label: _t("Show shadow under image"), type: "checkbox", width: "auto",  
                margin: "5px 0 0 0", showWhen: { variant: [3] }
            },          
            { type: "label", value: _t("Image size:"), margin: "5px 49% 0px 0px", showWhen: { variant: [3] }},
            { 
                name: "image_size",
                items: [{ label: _t("middle<br>"), value:"middle"},{ label: _t("large"), value:"large"}],
                type: "radio", width: "auto",
                margin: "0px 49% 10px 0px", showWhen: { variant: [3] }
            },
            { type: "label", value: _t("Image shape:"), margin: "5px 49% 0px 0px", showWhen: { variant: [2,5] }},
            { 
                name: "image_shape",
                items: [{ label: _t("circle<br>"), value:"circle"},{ label: _t("square"), value:"square"}],
                type: "radio", width: "auto",
                margin: "0px 49% 10px 0px", showWhen: { variant: [2,5] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background",  
            }
        ]
    }
});