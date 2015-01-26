lp.logos = lp.block.extendOptions({
    change: function(){
        this.variant.find(".clientsLogos").css({
            background: this.value.background || '',
        }); 
        if (this.value.variant == 1) {
			this.variant.find(".title").toggleVis(this.value.show_title);
			this.variant.find(".title_2").toggleVis(this.value.show_title_2);   
			this.variant.find(".item_list").toggleClass("gray",this.value.grayscale_logo);
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
                name: "grayscale_logo", label: _t("Grayscale logo"), type: "checkbox", width: "auto", 
                margin: "5px 49% 0px 0px",
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background"
            }
        ]
    }
});