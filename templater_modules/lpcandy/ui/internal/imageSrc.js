lp.imageSrc = lp.cover.extendOptions({
    change: function(){
        this.element.find("img").attr({ src: base_url+'/'+this.value }); 
    },
    configForm: {
        title: "Upload image",
        items: [
            {   
                type: "label", value:'Upload image file', margin: "10px 0 5px", 
                 
            },  
            {
                name: '', type: 'uploadButton', label: 'Select image file',
            }
        ]
    }
})