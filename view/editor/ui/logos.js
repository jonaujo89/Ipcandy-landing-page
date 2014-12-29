lp.logos = lp.block.extendOptions({
    change: function(){
        this.element.find(".clientsLogos").css({
            background: this.value.background || '',
        }); 
        if (this.value.variant == 1) {
			this.variant.find(".title").toggle(this.value.show_title);
			this.variant.find(".title_2").toggle(this.value.show_title_2);   
			this.variant.find(".item_list").toggleClass("gray",this.value.grayscale_logo);
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
                name: "grayscale_logo", label: _t("Grayscale logo"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});