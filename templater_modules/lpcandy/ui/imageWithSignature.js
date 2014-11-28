lp.imageWithSignature = lp.cover.extendOptions({
    change: function(){
        this.element.find("img").attr({src:base_url+"/"+this.value.image_url}); 
        this.element.find(".image_title").text(this.value.image_title);
        this.element.find(".image_desc").text(this.value.image_desc);
    },
    configForm: {
        title: "Upload image",
        items: [
            {   
                type: "label", value:'Upload image file', margin: "10px 0 5px", 
                 
            },  
            {
                name: 'image_url', type: 'uploadButton', label: 'Select image file',
            },
            {
                type: 'label',
                value: "Image title:",
                margin: "10px 0 5px",
            },
            {
                name: "image_title", type: "text",
            },
            {
                type: 'label',
                value: "Image description:",
                margin: "10px 0 5px",
            },
            {
                name: "image_desc", type: "text",
            }
        ]
    }
})