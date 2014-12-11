lp.image = lp.cover.extendOptions({
    init: function () {
        this.cover.appendTo(this.element.find(".img"));
    },
    change: function(){
        this.element.find(".img").css({
            backgroundImage: "url('"+base_url+'/'+this.value+"')",
        }); 
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