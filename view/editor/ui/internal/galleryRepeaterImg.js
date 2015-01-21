lp.galleryRepeaterImg = lp.repeater
.extendOptions({
    inline: true,
    sortable: false,
    itemChange: function (sub,item) {
        item.find(".img_title").text(sub.title);
        item.find(".img_desc").text(sub.desc);
        item.find(".preview_img img").attr({ src: base_url+'/'+sub.image });			
        item.find(".big_img").attr("href", base_url+'/'+sub.image);
        item.find(".big_img").attr("title", sub.title);	
    },
    configForm: {
        title: _t("Upload image"),
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
.extend({
    init: function (o) {
        this._super(o);
        if (this.addButtonWrap) {
            this.element.parents(".item_list").eq(0).append(this.addButtonWrap.css({marginTop:-90}));
        }
    }
})