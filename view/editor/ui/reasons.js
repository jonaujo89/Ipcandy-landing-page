lp.reasons = lp.block.extendOptions({
    change: function(){
		
        this.cmp.element.find(".reasons").css({
            background: this.value.background || '',
        });
		
		if (this.value.variant == 1){
			this.variant.find(".title").toggle(this.value.show_title);
			this.variant.find(".title_2").toggle(this.value.show_title_2);   
		}
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});