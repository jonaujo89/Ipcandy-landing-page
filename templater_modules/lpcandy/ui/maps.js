lp.maps = lp.block.extendOptions({
    init: function(){
        var jq = Component.previewFrame.window.$;
    },
    change: function(){  
        
        if (this.value.variant == 1) {  
            this.variant.find(".container_text").toggle(this.value.show_container_text);         
        }       
           
    },
    configForm: {
        items: [   
            { 
                name: "show_container_text", label: "Show text", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [1] }
            }
        ]
    }
});
