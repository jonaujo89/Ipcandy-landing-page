const {Cover} = require("../Cover/Cover"); 
const {Dialog} = require("../Dialog/Dialog");
const {Radio} = require("../Radio/Radio");
const {Input} = require("../Input/Input");
const {Color} = require("../Color/Color");
const {Switch} = require("../Switch/Switch");
const {Select} = require("../Select/Select");
const {Editable} = require("../Editable/Editable");
const {UploadButton} = require("../UploadButton/UploadButton");

const Logo = Editable(class extends preact.Component{
    configForm() {
        var val = this.props.value;
        return html`
            <${Dialog} title=${_t("Logotype")}>
                <${Radio} name="type" items=${[
                    { label: _t("Image logo"), value: 'image' },
                    { label: _t("Text name logo"), value: 'text' }
                ]} /> 
                <${UploadButton} name="url" label=${_t('Upload file')} showWhen=${{ type: 'image' }}/>
                ${val.type == 'text' && html` ${console.log(val.type == 'text')}
                    <label>${_t("Company name:")}</label>
                    <${Input} name="text" />
                    <label>${_t("Font settings:")}</label> 
                    <${Select} name="font">
                        ${[
                            'Verdana','Lucida Grande','Arial','Georgia','Impact',
                            'Times New Roman','Trebuchet MS','Palatino Linotype',
                            'Comic Sans MS','Century Gothic','Open Sans'
                        ].map((font)=>html`
                            <option value=${font}>${font}</option>`
                        )}
                    <//>
                    <div class="lp-row-inline">
                        <div>
                            <${Switch} name="bold" label=${_t('bold')} />
                        </div>
                        <div>
                            <${Switch} name="italic" label=${_t('italic')} />
                        </div>
                        <div>
                            <${Input} type="color" name="color" />
                        </div>
                    </div>
                    <label>${_t("Size:")}</label>
                    <${Input} type="range" min="14" max="70" name="fontSize" />
                `}  
                ${val.type == 'image' && html`
                    <label>${_t("Size:")}</label>
                    <${Input} type="range" min="10" max="150" name="size" />
                `}
            <//>
        `
    } 

    render(props, state) {
        const { size, text, type, url, italic, bold, font, color, fontSize } = props.value;
        const isImage = type === "image";

        return html`
            <${Cover} configForm=${this.configForm()}>
                <div class="logo">
                    ${isImage && html`
                        <img src="${config.base_url}/${url}" style="width: ${size}%" />
                    `}
                    ${!isImage && html`
                        <div class='company_name'
                            style=${{
                                fontStyle: italic ? 'italic' : 'normal',
                                fontWeight: bold ? 'bold' : 'normal',
                                fontFamily: font,
                                color: color,
                                fontSize: fontSize && `${(Math.round(fontSize / 16 * 100) / 100).toFixed(2)}em`,
                            }}
                        >${text}</div>
                    `}
                </div>
            <//>
        `
    }
})

Logo.tpl_default = () => {
    return config.language == 'en' ? {
        'type': 'image',
        'url': `${config.assets_url}/default_logo_en.png`,
        'text': "No name",
        'bold': true,
        'italic': false,
        'color': '#C1103A',
        'size': 70,
        'fontSize': 24
    } : {
        'type': 'image',
        'url': `${config.assets_url}/default_logo.png`,
        'text': 'Нет названия',
        'bold': true,
        'italic': false,
        'color': '#C1103A',
        'size': 70,
        'fontSize': 24
    };
}

exports.Logo = Logo;
