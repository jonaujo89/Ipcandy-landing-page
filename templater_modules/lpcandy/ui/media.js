lp.media = lp.cover.extendOptions({
    change: function(){
             
        var div_media = this.element.find(".media");

        if (this.value.type == "image_background") {
            div_media.empty(div_media);
            div_media.append($('<div class="img">').css({
                backgroundImage: "url('"+base_url+'/'+this.value.image_url+"')",
            }));
        } else if (this.value.type == "video") {              
            div_media.empty(div_media);
            var url = this.value.video_url;
            var pattern_youtube = /youtu/;
            var pattern_vimeo = /vimeo/;
            if (pattern_youtube.test(url)) {
                var pattern_url_youtube = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                var match = url.match(pattern_url_youtube);
                if (match&&match[7]){                    
                    div_media.append($('<iframe frameborder="0"></iframe>').attr({src:'//www.youtube.com/embed/'+match[7]}));
                }
            } else if (pattern_vimeo.test(url)){
                var pattern_url_vimeo = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
                var match = url.match(pattern_url_vimeo);
                if (match&&match[5]){
                    div_media.append($('<iframe frameborder="0"></iframe>').attr({src:'//player.vimeo.com/video/'+match[5]}));
                }
            } else {
                div_media.append($('<div class="img">').css({
                    backgroundImage: "url('"+base_url+"/templater_modules/lpcandy/assets/404.gif')",
                }));
                this.value.video_url = "http://youtu.be/z1SXw6nlTr0";
            }   
        }
    },
    configForm: {
        title: "Media files",
        items: [
            {
                name: 'type', type: 'radio', margin: "15px 0 20px", items: [
                    { label: "Image ", value: 'image_background' },
                    { label: "Video", value: 'video' }
                ]
            },
            {
                name: 'image_url', type: 'uploadButton', label: 'Upload image file',
                showWhen: { type: 'image_background' }
            },
            {
                type: 'label',
                value: "Video url (youtube or vimeo):",
                showWhen: { type: 'video' }
            },
            {
                name: "video_url", type: "text",
                showWhen: { type: 'video' }
            },
        ]
    }
})