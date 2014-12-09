lp.video = lp.block.extendOptions({
    change: function(){
		
        this.element.find(".video_block").css({
            background: this.value.background_color || '',
        }); 
        
        if (this.value.variant == 1) {  
            this.variant.find(".title").toggle(this.value.show_title);
            this.variant.find(".title_2").toggle(this.value.show_title_2);  
            this.variant.find(".video").prop("class","video "+this.value.video_size);
        }
        if (this.value.variant == 2) { 
            this.variant.find(".text_title_2").toggle(this.value.show_text_title_2);
        }
        if (this.value.variant == 3) {  
            this.variant.find(".title").toggle(this.value.show_title);
            this.variant.find(".title_2").toggle(this.value.show_title_2);
            this.variant.find(".desc").toggle(this.value.show_desc); 
            this.variant.find(".video").toggleClass("hide_border",!this.value.show_border);
        }
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: "Show first title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,3] }
            },
            { 
                name: "show_title_2", label: "Show second title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,3] }
            },
            { 
                name: "show_text_title_2", label: "Show second text title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [2] }
            },
            { 
                name: "show_desc", label: "Show description", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [3] }
            },
            { 
                name: "show_border", label: "Show border", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [3] }
            },
            { type: "label", value: "Video size:", margin: "5px 49% 0px 0px", showWhen: { variant: [1] }},
            { 
                name: "video_size",
                items: [{ label: "small<br>", value:"small"},{ label: "medium<br>", value:"medium"},{ label: "large", value:"large"}],
                type: "radio", width: "auto", height: 70, 
                margin: "0px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});