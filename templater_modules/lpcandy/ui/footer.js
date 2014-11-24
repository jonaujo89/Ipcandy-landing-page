lp.footer = lp.block.extendOptions({
    change: function(){
        this.cmp.element.find(".footer").css({
            background: this.value.background_color || '',
        });        
 
        this.variant.find(".policy_wrap").toggle(this.value.show_policy);
        this.variant.find(".copyright").toggle(this.value.show_copyright);  
    },
    configForm: {
        items: [   
            { 
                name: "show_policy", label: "Show policy", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2] }
            },
            { 
                name: "show_copyright", label: "Show copyright", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1,2] }
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});