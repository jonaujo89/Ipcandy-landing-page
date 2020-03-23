const {Cover} = require("../Cover/Cover");
const {Dialog} = require("../Dialog/Dialog");
const {Editable} = require("../Editable/Editable");

const Media = Editable((props)=>{
    let video_url = '';
    if (props.value.type === "video") {
        const url = props.value.video_url;
        const pattern_youtube = /youtu/;
        const pattern_vimeo = /vimeo/;

        const pattern_url_vimeo = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
        const pattern_url_youtube = /^.*((youtu.*be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        let match = false;
        if (match = url.match(pattern_url_youtube)) {
            video_url = `//www.youtube.com/embed/${match[7]}?showinfo=0&controls=1&theme=light&rel=0`;
        } else if (match = url.match(pattern_url_vimeo)) {
            video_url = `//player.vimeo.com/video/${match[5]}`;
        }

        if (!match) {
            video_url = `${base_url}/${lp.app.options.assets_url}/404.php`;
        }
    }

    return html`
        <${Cover}
            configForm=${html`
                <${Dialog} title=${_t("Media file")} id=${"dialog_"+(props.switchType ? 'sw':'nosw')}>
                    <radio name="type" label="Image" value="image" />
                    <radio name="type" label="Video" value="video" />
                    <uploadButton name="image_url" label="Upload file" showWhen="${{type: 'video'}}" />
                    <label value="${_t("Video url (youtube or vimeo):")}" showWhen="${{type: 'video'}}" />
                    <text name="video_url" value="${_t("Video url (youtube or vimeo):")}" showWhen="${{type: 'video'}}" />
                    <label value="${_t("example: www.youtube.com/embed/P55qVX3y134")}" showWhen="${{type: 'video'}}" /> 
                <//>

            `}
        >
            <div class="media">
                ${props.value.type == "video" && html`
                    <iframe frameborder="0" src=${video_url} />
                `}
                ${props.value.type == "image" && html`
                    <div class="img" style="background-image: url('${base_url+"/"+props.value.image_url}')" />
                `}
            </div>;
        <//>
    `;
});

Media.tpl_default = () => ({
    type: 'image',
    image_url: `${lp.app.options.assets_url}/background/218.jpg`,
    video_url: 'www.youtube.com/watch?v=EILqvdxdc5c',
});

exports.Media = Media;