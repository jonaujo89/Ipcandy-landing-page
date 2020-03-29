const {Dialog,UploadButton,Input,Repeater,Slider} = require("../../internal");

const withGalleryForm = (Type) => {
    return (props) => html`
        <${Type} 
            inline=${true}
            name=${props.name} 
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
        >
            ${props.children}
        <//>
    `;
}

exports.GalleryRepeater = withGalleryForm(Repeater);
exports.GallerySlider = withGalleryForm(Slider);