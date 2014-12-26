lp.imageFancyboxWithoutTitle = lp.cover.extendOptions({
    init: function () {
        this.cover.addClass("lp-button");
    },
    change: function(){
        if(this.value.url_image_preview){
			this.element.find(".preview_img").css({
				backgroundImage: "url('"+base_url+'/'+this.value.url_image_preview+"')",
			});
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
        ]
    }
})