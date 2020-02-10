lp.overlayImage = lp.cover.extendOptions({
    init: function () {
        this.cover.addClass("lp-button");
    },
    change: function(){
		this.element.find(".img_title").text(this.value.title);
		this.element.find(".img_desc").text(this.value.desc);
		if(this.value.image){
			this.element.find(".big_img").attr('title',this.value.title);
			this.element.find(".preview_img").css({
				backgroundImage: "url('"+base_url+"/"+this.value.image+"')",
			});
			this.element.find(".big_img").attr("href", base_url+"/"+this.value.image);
		}		         
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
                margin: "10px 0 5px"
            },            
            {
                name: "title", type: "text"
            },
            {
                type: 'label',
                value: _t("Image description:"),
                margin: "10px 0 5px"
            },
            {
                name: "desc", type: "text",
            },
        ]        
    }
})