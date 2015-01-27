lp.galleryRepeater = lp.repeater.extendOptions({
    inline: true,
    itemChange: function (sub,item) {
		item.find(".img_title").text(sub.title);
        item.find(".img_desc").text(sub.desc);
		item.find(".preview_img").css({
            backgroundImage: "url('"+base_url+'/'+sub.image+"')",
		});
		item.find(".big_img").attr("href", base_url+'/'+sub.image).attr("title", sub.title);
    },
    configForm: {
        title: _t("Image"),
        items: [
            {   
                type: "label", value:_t('Upload image file'), margin: "10px 0 5px", 
                 
            },  
            {
                name: 'image', type: 'uploadButton', label: _t('Select file'),
            },
            {
                type: 'label',
                value: _t("Image title:"),
                margin: "10px 0 5px",
            },
            {
                name: "title", type: "text",
            },
            {
                type: 'label',
                value: _t("Image description:"),
                margin: "10px 0 5px",
            },
            {
                name: "desc", type: "text"
            }
        ]
        
    }
})