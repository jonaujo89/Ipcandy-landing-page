const {Cover} = require("../Cover/Cover"); 
const {Dialog} = require("../Dialog/Dialog");
const {Editable} = require("../Editable/Editable");
const {Textarea} = require("../Textarea/Textarea");
const {UploadButton} = require("../UploadButton/UploadButton");

const Liquid = Editable(class extends preact.Component{ 

    configForm(){
        return html`
            <${Dialog} title=${_t("Settings")} width="800">
                <label>${_t("Template")}</label>
                <${Textarea} name="tpl" rows="20" label="Template" />
                <${UploadButton.Type} onChange=${(url)=>{
                    this.props.onChange({tpl: `${this.props.value.tpl}<img src="{{base_url}}/${url}" />`});
                }} label=${_t('Upload image')} />
            <//>
        `
    }

    render(props, state){
        return html`
            <${Cover} configForm=${this.configForm()}>
                <div class="template" dangerouslySetInnerHTML=${{__html: props.value.tpl.replace(/{{base_url}}/g, base_url)}} />
            <//>
        `;
    }
})

Liquid.tpl_default = () => {
    return {tpl: window.locale_lang == 'en' ? `<h1>Example HTML</h1><p>Little text</p>` : `<h1>Пример HTML</h1><p>И немного текста</p>`}
} 

exports.Liquid = Liquid;