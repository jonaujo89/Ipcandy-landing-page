lp.maps = lp.block.extendOptions({
    change: function(){  
        
        if (this.value.variant == 1) {  
            this.variant.find(".title").toggle(this.value.show_text);         
        }       
           
    },
    configForm: {
        items: [   
            { 
                name: "show_text", label: "Show text", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            }
        ]
    }
});