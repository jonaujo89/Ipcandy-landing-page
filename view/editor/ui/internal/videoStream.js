lp.videoStream = lp.cover.extendOptions({
    change: function(){
             
        var div_video = this.element.find("iframe");
        var url = this.value.video_url;
        var pattern_youtube = /youtu/;
        var pattern_vimeo = /vimeo/;
        if (pattern_youtube.test(url)) {
            var pattern_url_youtube = /^.*((youtu.*be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(pattern_url_youtube);
            if (match&&match[7]){                    
                div_video.attr({src:'//www.youtube.com/embed/'+match[7]});
            }
        } else if (pattern_vimeo.test(url)){
            var pattern_url_vimeo = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
            var match = url.match(pattern_url_vimeo);
            if (match&&match[5]){
                div_video.attr({src:'//player.vimeo.com/video/'+match[5]});
            }
        } else {
            div_video.attr({src: base_url+"/view/editor/assets/video_404.html"});
        }   
       
    },
    configForm: {
        title: _t("Video"),
        items: [
            {
                type: 'label',
                value: _t("Video url (youtube or vimeo):"),
                margin: "20px 0 5px"
            },
            {
                name: "video_url",
                type: "text",
                margin: "5px 0 0"
            },
            {
                type: 'label',
                value: _t("example: www.youtube.com/embed/xbK8rl9wH4Q"), height: 5, margin: "0 0 5px 2px",
            },
        ]
    }
})