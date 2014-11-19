lp.image = lp.cover.extendOptions({
    change: function(){
        var me = this;
        var img;
        if(img = me.element.find(".img")){
            img.css({
                backgroundImage: "url('"+base_url+'/'+this.value.image_url+"')",
            }); 
        }
        if(img = me.element.find("img")){
            img.attr({src:base_url+"/"+me.value.image_url});
        }
    },
    configForm: {
        title: "Upload image",
        items: [
            {   
                type: "label", value:'Upload image file', margin: "10px 0 5px", 
                 
            },  
            {
                name: 'image_url', type: 'uploadButton', label: 'Select image file',
            }
        ]
    }
})