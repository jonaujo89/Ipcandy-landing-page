lp.gallery = lp.block.extendOptions({
    change: function(){
        this.cmp.element.find(".reasons").css({
            background: this.value.background || '',
        }); 
        
        this.variant.find(".title").toggle(this.value.show_title);
        this.variant.find(".title_2").toggle(this.value.show_title_2);  
        this.variant.find(".image_title").toggle(this.value.show_image_title);
        this.variant.find(".image_desc").toggle(this.value.show_image_desc);
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: "Show first title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { 
                name: "show_title_2", label: "Show second title", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { 
                name: "show_image_title", label: "Show image name", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { 
                name: "show_image_desc", label: "Show image description", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px",
            },
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }]
            },
        ]
    }
});