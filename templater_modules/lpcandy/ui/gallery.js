lp.gallery = lp.block.extendOptions({
	init: function () {
        var jq = Component.previewFrame.window.$; 
        if (jq) {
            jq(".gallery_2 .item_list .item_block .item").hover(
                function() {
                    jq( this ).addClass('hover');
                },
                function() {
                    jq( this ).removeClass('hover');
                }        
            );
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
		if (this.value.variant == 5 || this.value.variant == 6 || this.value.variant == 7 || this.value.variant == 8 || this.value.variant == 9 || this.value.variant == 10) {
            this.variant.find(".big_img").toggleClass("fancybox",this.value.enable_fancybox);
            if (jq && !this.value.enable_fancybox) {
                jq(".fancybox").lpFancybox();
            } 
		}        
        if (this.value.variant == 5){ 
            var bxslider = this.element.find('.slider [data-name=items]');
            jq(bxslider).lpBxSlider();
        }        
        if (this.value.variant == 6) {
            var masonry = this.element.find(".masonry");
            jq(masonry).lpMasonry();
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
                name: "show_image_title", label: _t("Show image name"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,5,6,7,8,9,10] }
            },
            { 
                name: "show_image_overlay", label: _t("Show image signature"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [2,3,4] }
            },
            { 
                name: "show_image_desc", label: _t("Show image descroption"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2,3,4,5,6,7,8,9,10] }
            },
			{ 
                name: "enable_fancybox", label: _t("Show big image (enable fancybox)"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [3,4,5,6,7,8,9,10] }
            },			
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});