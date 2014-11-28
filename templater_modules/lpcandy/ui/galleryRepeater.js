lp.galleryRepeater = lp.repeater.extendOptions({
    inline: true,
    itemChange: function (sub,item) {
        item.find(".image_title").text(sub.title);
        item.find(".image_desc").text(sub.desc);
        item.find("img").attr("src",base_url+"/"+sub.image);
    },
    configForm: {
        title: "Upload image",
        items: [
            {   
                type: "label", value:'Upload image file', margin: "10px 0 5px", 
                 
            },  
            {
                name: 'image', type: 'uploadButton', label: 'Select image file',
            },
            {
                type: 'label',
                value: "Image title:",
                margin: "10px 0 5px",
            },
            {
                name: "title", type: "text",
            },
            {
                type: 'label',
                value: "Image description:",
                margin: "10px 0 5px",
            },
            {
                name: "desc", type: "text"
            }
        ]
        
    }
})