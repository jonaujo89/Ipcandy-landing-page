lp.imageSrc = lp.cover.extendOptions({
    change: function(){
        this.element.find("img").attr({ src: base_url+'/'+this.value }); 
    },
    configForm: {
        title: _t("Image"),
        items: [
            {   
                type: "label", value:_t('Select image file'), margin: "10px 0 5px", 
                 
            },  
            {
                name: '', type: 'uploadButton', label: _t('Upload image file'),
            }
        ]
    }
})