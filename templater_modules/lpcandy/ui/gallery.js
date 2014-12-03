lp.gallery = lp.block.extendOptions({

    change: function(){
        this.cmp.element.find(".gallery").css({
            background: this.value.background || '',
        }); 
		
		this.variant.find(".title").toggle(this.value.show_title);
		this.variant.find(".title_2").toggle(this.value.show_title_2);
		
        if (this.value.variant == 1 || this.value.variant == 6 || this.value.variant == 7 || this.value.variant == 8) {  
			this.variant.find(".img_title").toggle(this.value.show_image_title);
			this.variant.find(".img_desc").toggle(this.value.show_image_desc);
		}
		if (this.value.variant == 2) {
			this.variant.find(".img_desc").toggle(this.value.show_image_desc);
			this.variant.find(".item_list").toggleClass("hide_desc",!this.value.show_image_desc);
			this.variant.find(".item_list").toggleClass("hide_overlay",!this.value.show_image_overlay);
		}
		if (this.value.variant == 3 || this.value.variant == 4) {
			this.variant.find(".fancybox").attr('title',this.value.title);
			this.variant.find(".img_desc").toggle(this.value.show_image_desc);
			this.variant.find(".overlay").toggle(this.value.show_image_overlay);			
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
                name: "show_image_title", label: "Show image name", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,6,7,8] }
            },
            { 
                name: "show_image_desc", label: "Show image second title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,6,7,8] }
            },
			{ 
                name: "show_image_overlay", label: "Show image signature", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [2,3,4] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});