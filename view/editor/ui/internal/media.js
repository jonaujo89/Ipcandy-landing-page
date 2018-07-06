lp.media = lp.cover.extend({
    init: function (o) {
        o.configForm = {
            title: _t("Media file"),
            items: [
                {
                    name: 'image_url', type: 'uploadButton', label: _t('Upload file'),
                    showWhen: { type: 'image' }
                },
                {
                    type: 'label',
                    value: _t("Video url (youtube or vimeo):"), margin: "5px 0 0",
                    showWhen: { type: 'video' }
                },
                {
                    name: "video_url", type: "text", margin: "5px 0 0",
                    showWhen: { type: 'video' }
                },
                {
                    type: 'label',
                    value: _t("example: www.youtube.com/embed/P55qVX3y134"), margin: "0 0 5px 0",
                    showWhen: { type: 'video' }
                },
            ]
        }
        if (o.switchType!==false) o.configForm.items.unshift({
            name: 'type', type: 'radio', margin: "15px 0 20px", items: [
                { label: _t("Image"), value: 'image' },
                { label: _t("Video"), value: 'video' }
            ]
        });
                
        o.configForm.id = "dialog_"+(o.switchType===false ? 'nosw':'sw');
        o.change = function(){
            var div_media = this.element.find(".media");

            if (this.value.type == "image") {
                div_media.empty(div_media);
                div_media.append($('<div class="img">').css({
                    backgroundImage: "url('"+base_url+"/"+this.value.image_url+"')",
                }));
            } else if (this.value.type == "video") {
                var url = this.value.video_url;
                var pattern_youtube = /youtu/;
                var pattern_vimeo = /vimeo/;
                if (pattern_youtube.test(url)) {                
                    var pattern_url_youtube = /^.*((youtu.*be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                    var match = url.match(pattern_url_youtube);
                    if (match){
                        div_media.empty(div_media);
                        div_media.append($('<iframe frameborder="0"></iframe>').attr({src:'//www.youtube.com/embed/'+match[7]+"?showinfo=0&controls=2&theme=light&rel=0"}));
                    }
                } else if (pattern_vimeo.test(url)){
                    var pattern_url_vimeo = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
                    var match = url.match(pattern_url_vimeo);
                    if (match){
                        div_media.empty(div_media);
                        div_media.append($('<iframe frameborder="0"></iframe>').attr({src:'//player.vimeo.com/video/'+match[5]}));
                    }
                } else {
                    div_media.empty(div_media);
                    div_media.append($('<iframe frameborder="0"></iframe>').attr({src: base_url+"/"+Component.app.options.assets_url+"/404.php"}));
                }   
            }
        };
        this._super(o);
    }
});