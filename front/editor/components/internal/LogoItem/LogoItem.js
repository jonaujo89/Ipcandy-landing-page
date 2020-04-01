
const {Cover} = require("../Cover/Cover"); 
const {Dialog} = require("../../internal/Dialog/Dialog");
const {Switch} = require("../../internal/Switch/Switch");
const {Editable} = require("../../internal/Editable/Editable");
const {UploadButton} = require("../../internal/UploadButton/UploadButton");

const LogoItem = Editable(class extends preact.Component{

    configForm() {
        return html`
            <${Dialog} title=${_t("Image")}>
                 <label>${_t('Upload image file')}</label>
                 <${UploadButton} label=${_t('Select file')} />
            <//>
        `
    }

    render(props, state){
        return html`
            <${Cover} configForm=${this.configForm()} inline=${true}>
                <img src="${base_url}/${props.value}" alt="" />
            <//>
        `
    }
})
 
exports.LogoItem = LogoItem;