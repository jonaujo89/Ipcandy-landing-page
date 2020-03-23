const {Cover} = require("../Cover/Cover");
const {Dialog} = require("../Dialog/Dialog");
const {Editable} = require("../Editable/Editable");
const {Radio} = require("../Radio/Radio");
const {UploadButton} = require("../UploadButton/UploadButton");
const {Input} = require("../Input/Input");

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
            video_url = `${base_url}/${lp.app.options.assets_url}/404.htm`;
        }
    }

    return html`
        <${Cover}
            configForm=${html`
                <${Dialog} title=${_t("Media file")} id=${"dialog_"+(props.switchType ? 'sw':'nosw')}>
                    <${Radio} name="type" items=${[
                        { label: _t("Image"), value: "image" },
                        { label: _t("Video"), value: "video" }
                    ]} />
                    <${UploadButton} name="image_url" label=${_t("Upload file")} showWhen=${{type: 'video'}} />
                    ${ props.value.type=="video" && html`
                        <label>${_t("Video url (youtube or vimeo):")}</label>
                        <${Input} name="video_url" />
                    `}
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