lp.footer = lp.block.extendOptions({
    change: function(){
		
		this.variant.find(".footer").css({
			background: this.value.background_color || '',
		});        
		
		if (this.value.variant == 1){
			this.variant.find(".policy_wrap").toggleVis(this.value.show_policy);
		}
    },
    configForm: {
        items: [   
            { 
                name: "show_policy", label: _t("Show policy"), type: "checkbox", width: "auto", 
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background_color" 
            },
        ]
    }
});