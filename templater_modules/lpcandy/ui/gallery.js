lp.gallery = lp.block.extendOptions({
	init: function () {
        var jq = Component.previewFrame.window.$; 
        var slider = this.element.find(".slider > div");        
        if (jq) {
            jq(slider).lpLightSlider();
            console.log("init");
        }
    },
    change: function(){		
        var jq = Component.previewFrame.window.$;      

        this.element.find(".gallery").css({
            background: this.value.background || '',
        }); 
		
		this.element.find(".title").toggle(this.value.show_title);
		this.element.find(".title_2").toggle(this.value.show_title_2);
		
        if (this.value.variant == 1 || this.value.variant == 5 || this.value.variant == 6 || this.value.variant == 7 || this.value.variant == 8 || this.value.variant == 9 || this.value.variant == 10) {  
			this.variant.find(".img_title").toggle(this.value.show_image_title);
			this.variant.find(".img_desc").toggle(this.value.show_image_desc);
		}
		if (this.value.variant == 2) {
			this.variant.find(".img_desc").toggle(this.value.show_image_desc);
			this.variant.find(".item_list").toggleClass("hide_desc",!this.value.show_image_desc);
			this.variant.find(".item_list").toggleClass("hide_overlay",!this.value.show_image_overlay);
		}
		if (this.value.variant == 3 || this.value.variant == 4) {			
			this.variant.find(".img_desc").toggle(this.value.show_image_desc);
			this.variant.find(".overlay").toggle(this.value.show_image_overlay);	
			
		}
		if (this.value.variant == 3 || this.value.variant == 4 || this.value.variant == 5) {
			this.variant.find(".fancybox_whithout_title").toggle(this.value.enable_fancybox);
			if (jq && this.value.enable_fancybox) {
				jq(".fancybox_whithout_title").lpFancyboxWhithoutTitle();				
			}			
		}
		if (this.value.variant == 6 || this.value.variant == 7 || this.value.variant == 8 || this.value.variant == 9 || this.value.variant == 10) {
            var preview_img = this.element.find(".preview_img");
			if (jq && this.value.enable_fancybox) {
                jq(".fancybox").lpFancybox();
            } else {

            }            
   
		}
        if (this.value.variant == 6) {
            var masonry = this.element.find(".masonry"); 
            var img = this.element.find("img");            
            if (jq) {
                var jqMasonry = jq(masonry);
                jqMasonry.lpMasonry(); 
                jq(img).load(function() {
                    jqMasonry.lpMasonry();
                });
                jqMasonry.lpMasonryReloadItems();
            }             
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
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,5,6,7,8,9,10] }
            },
            { 
                name: "show_image_desc", label: "Show image second title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5,6,7,8,9,10] }
            },
			{ 
                name: "enable_fancybox", label: "Show big image (enable fancybox)", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [3,4,5,6,7,8,9,10] }
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