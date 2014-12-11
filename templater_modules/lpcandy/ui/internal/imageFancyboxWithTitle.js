lp.imageFancyboxWithTitle = lp.imageFancyboxWithoutTitle({
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
        title: "Upload image",
        items: [
            {   
                type: "label", value:'Upload image file', margin: "10px 0 5px", 
                 
            },  
            {
                name: 'url_image_preview', type: 'uploadButton', label: 'Select image file',
            },
        ]
    }
})