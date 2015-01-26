lp.video = lp.block.extendOptions({
    change: function(){
		
        this.variant.find(".video_block").css({
            background: this.value.background_color || '',
        }); 
        
        if (this.value.variant == 1) {  
            this.variant.find(".title").toggleVis(this.value.show_title);
            this.variant.find(".title_2").toggleVis(this.value.show_title_2);  
            this.variant.find(".video").prop("class","video "+this.value.video_size);
        }
        if (this.value.variant == 2) { 
            this.variant.find(".text_title_2").toggleVis(this.value.show_text_title_2);
        }
        if (this.value.variant == 3) {  
            this.variant.find(".title").toggleVis(this.value.show_title);
            this.variant.find(".title_2").toggleVis(this.value.show_title_2);
            this.variant.find(".desc").toggleVis(this.value.show_desc); 
            this.variant.find(".video").toggleClass("hide_border",!this.value.show_border);
        }
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,3] }
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,3] }
            },
            { 
                name: "show_text_title_2", label: _t("Show second text title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [2] }
            },
            { 
                name: "show_desc", label: _t("Show description"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_border", label: _t("Show border"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [3] }
            },
            { type: "label", value: _t("Video size:"), margin: "5px 49% 0px 0px", showWhen: { variant: [1] }},
            { 
                name: "video_size",
                items: [{ label: _t("small<br>"), value:"small"},{ label: _t("medium<br>"), value:"medium"},{ label: _t("large"), value:"large"}],
                type: "radio", width: "auto",
                margin: "0px 49% 10px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background_color",  
            },
        ]
    }
});