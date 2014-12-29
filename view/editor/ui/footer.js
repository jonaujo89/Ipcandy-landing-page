lp.footer = lp.block.extendOptions({
    change: function(){
		
		this.cmp.element.find(".footer").css({
			background: this.value.background_color || '',
		});        
		
		if (this.value.variant == 1){
			this.variant.find(".policy_wrap").toggle(this.value.show_policy);
			this.variant.find(".copyright").toggle(this.value.show_copyright);  
		}
    },
    configForm: {
        items: [   
            { 
                name: "show_policy", label: _t("Show policy"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_copyright", label: _t("Show copyright"), type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});