const {Editable,UploadButton,Cover,Dialog} = require("../../internal");
const {ImageLink} = require("./ImageLink");

const GalleryImage = Editable(class extends preact.Component{ 
    render(props) {
        var val = props.value || {};
        var href = config.base_url + "/" + val.image;
        return html`
            <${Cover}
                configForm=${html`
                    <${Dialog} title=${_t("Image")}>
                        <label>${_t('Upload image file')}</label>
                        <${UploadButton} name="image" label=${_t('Select file')} />
                    <//>
                `}
                buttonCover=${true}
                ref=${(r)=>this.coverCmp=r}
            >
                <div class='preview_img' style='background-image: url("${href}")'>
                    ${ props.block.value.enable_fancybox && html`<${ImageLink} class="fancybox" href=${href} />` }
                </div>
            <//>
        `
    }
});
GalleryImage.defaultProps = {
    alwaysRender: true
};

exports.GalleryImage = GalleryImage;