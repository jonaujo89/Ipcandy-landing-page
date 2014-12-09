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
                name: "show_title", label: "Show first title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_title_2", label: "Show second title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});