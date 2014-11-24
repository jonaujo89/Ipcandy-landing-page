lp.imageSrc = lp.cover.extendOptions({
    change: function(){

    },
    configForm: {
        title: "Upload image",
        items: [
            {   
                type: "label", value:'Upload image file', margin: "10px 0 5px", 
                 
            },  
            {
                name: '', type: 'uploadButton', label: 'Select image file',
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