lp.imageWithSignature = lp.cover.extendOptions({
    init: function () {
        this.cover.addClass("lp-button");
    },
    change: function(){
		this.element.find(".img_title").text(this.value.title);
		this.element.find(".img_desc").text(this.value.desc);
		if(this.value.url_image_preview){
			this.element.find(".big_img").attr('title',this.value.title);
			this.element.find(".preview_img").css({
				backgroundImage: "url('"+base_url+'/'+this.value.url_image_preview+"')",
			});
			//this.element.find(".preview_img").attr({ src: base_url+'/'+this.url_image_preview });
			this.value.url_image = this.value.url_image_preview;
			this.element.find(".big_img").attr("href", base_url+'/'+this.value.url_image);
		}		         
    },
    configForm: {
        title: _t("Image"),
        items: [
            {   
                type: "label", value:_t('Select image file'), margin: "10px 0 5px", 
                 
            },  
            {
                name: 'url_image_preview', type: 'uploadButton', label: _t('Upload image file'),
            },
            {
                type: 'label',
                value: _t("Image title:"), showWhen: { variant: [1,5,6,7,8,9,10] },
                margin: "10px 0 5px"
            },            
            {
                name: "title", type: "text", showWhen: { variant: [1,5,6,7,8,9,10] }
            },
            {
                type: 'label', showWhen: { variant: [1,5,6,7,8,9,10] },
                value: _t("Is displayed when you hover over the photo"), margin: "0 0 5px 2px",
                showWhen: { type: 'video' }
            },
            {
                type: 'label', showWhen: { variant: [1,5,6,7,8,9,10] },
                value: _t("Image description:"),
                margin: "10px 0 5px"
            },
            {
                name: "desc", type: "text", showWhen: { variant: [1,5,6,7,8,9,10] },
            },
            {
                type: 'label', showWhen: { variant: [1,5,6,7,8,9,10] },
                value: _t("Is displayed when you hover over the photo"), margin: "0 0 5px 2px",
                showWhen: { type: 'video' }
            },
        ]
        
    }
})