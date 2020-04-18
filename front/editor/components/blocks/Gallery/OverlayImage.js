const {Editable,UploadButton,Cover,Dialog,Input} = require("../../internal");
const {ImageLink} = require("./ImageLink");

const OverlayImage = Editable(class extends preact.Component{ 
    render(props) {
        var val = props.value || {};
        var href = config.base_url + "/" + val.image;
        return html`
            <${Cover}
                configForm=${html`
                    <${Dialog} title=${_t('Image')}>
                        <label>${_t('Upload image file')}</label>
                        <${UploadButton} name="image" label=${_t("Select file")} />
                        <label>${_t('Image title:')}</label>
                        <${Input} name="title" />
                        <label>${_t('Image description:')}</label>
                        <${Input} name="desc" />
                    <//>
                `}
                buttonCover=${true}
                ref=${(r)=>this.coverCmp=r}
            >
                <div class="preview_img" style="background-image: url('${href}');">
                    ${ props.block.value.enable_fancybox && html`<${ImageLink} class="fancybox" href=${href} />` }
                    <div class="overlay">
                        <div class="outer">
                            <div class="wrap_title_desc">					
                                ${ props.block.value.show_image_title && html`
                                    <div class="img_title" >
                                        ${val.title}
                                    </div>
                                `}
                                ${ props.block.value.show_image_desc && html`
                                    <div class="img_desc" >
                                        ${val.desc}
                                    </div>
                                `}
                            </div>
                        </div>
                    </div>
                </div>
            <//>
        `
    }
});
OverlayImage.defaultProps = {
    alwaysRender: true
};

exports.OverlayImage = OverlayImage;