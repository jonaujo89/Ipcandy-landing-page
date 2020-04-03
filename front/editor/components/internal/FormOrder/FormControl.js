const {Input} = require("../Input/Input");
const {Textarea} = require("../Textarea/Textarea");
const {Switch} = require("../Switch/Switch");

const FieldLabel = (props)=>{
    let {label,required,desc} = props.value;
    label = (label || "").trim();
    desc = (desc || "").trim();
    return html`
        ${label && html`
            <div class="field_title">
                ${ required && html`<i>*</i>` }
                ${label}
            </div>
        `}
        ${desc && html`
            <div class="desc">
                ${desc}
            </div>
        `}
    `
};

const FieldError = (props) => {
    return props.error && html`<div class="error">${props.error}</div>`;
}

class FormControl extends preact.Component {
    static get icon() {}
    static get title() {}
    static get default() { return {} }
    static configForm() {}

    componentDidMount() {
        this.reset();
    }

    validate() {
        if (this.props.value.required && !this.getValue()) {
            this.setState({error:_t('field is required')});
            return false;
        }
        this.setState({error:false});
        return true;
    }
    getValue() {
        return this.input.value;
    }

    reset() {
        this.input.value = "";
        this.setState({error:false});
    }
}

let formControls = {};

formControls.text = class extends FormControl {
    static get title() { return _t("Text") }
    static get icon() { return 'font'; }

    static configForm() {
        return html`
            <label>${_t("Field label")}</label>
            <${Input} name="label" />
            <label>${_t("Field description")}</label>
            <${Input} name="desc" />
            <label>${_t("Field placeholder")}</label>
            <${Input} name="placeholder" />
            <${Switch} name="required" label=${_t("Is required?")} />
        `
    }
    render(props,state) {
        return html`
            <div class="form_field">
                <label>
                    <${FieldLabel} value=${props.value} />
                    <input ref=${(r)=>this.input=r} class="form_field_text" type="text" placeholder=${props.value.placeholder || ""} />
                    <${FieldError} error=${state.error} />
                </label>
            </div>
        `;
    }
}

formControls.textarea = class extends FormControl {
    static get title() { return _t("Text area") }
    static get icon() { return "bars" }

    static configForm() {
        return formControls.text.configForm();
    }

    render(props,state) {
        return html`
            <div class="form_field">
                <label>
                    <${FieldLabel} value=${props.value} />
                    <textarea ref=${(r)=>this.input=r} class="form_field_textarea" rows="3" placeholder=${props.value.placeholder || ""} />
                    <${FieldError} error=${state.error} />
                </label>
            </div>        
        `
    }
}

formControls.file = class extends FormControl {
    static get title() { return _t("File") }
    static get icon() { return "paperclip" }
        
    static configForm() {
        return html`
            <label>${_t("Field label")}</label>
            <${Input} name="label" />
            <label>${_t("Field description")}</label>
            <${Input} name="desc" />
            <${Switch} name="required" label=${_t("Is required?")} />
        `
    }

    getValue() {
        return this.input.files;
    }
    
    render(props,state) {
        return html`
           <div class="form_field">
                <label>
                    <${FieldLabel} value=${props.value} />
                    <input ref=${(r)=>this.input=r} class="form_field_file" type="file" multiple="multiple" />
                    <${FieldError} error=${state.error} />
                </label>
            </div>      
        `
    }
}

formControls.select = class extends FormControl {
    static get title() { return _t("Select") }
    static get icon() { return "toggle-down" }

    static configForm() {
        return html`
            <label>${_t("Field label")}</label>
            <${Input} name="label" />
            <label>${_t("Field description")}</label>
            <${Input} name="desc" />
            <label>${_t("Options")}</label>
            <${Textarea} name="options" />
        `
    }
    
    static get default() {
        return { options: _t("Option 1\nOption 2\nOption 3")}
    }

    reset() {
        this.input.value = this.props.value.options.split("\n")[0] || "";
    }

    render(props,state) {
        return html`
            <div class="form_field">
                <label>
                    <${FieldLabel} value=${props.value} />
                    <div class="form_field_select_wrap">
                        <select ref=${(r)=>this.input=r} class="form_field_select">
                            ${props.value.options.split("\n").map(option => {
                                return html`<option value=${option}>${option}</option>`
                            })}
                        </select>
                    </div>
                    <${FieldError} error=${state.error} />
                </label>
            </div>      
        `
    }
}

formControls.radio = class extends FormControl {
    constructor(props) {
        super(props);
        this.constructor.cnt = (this.constructor.cnt || 0) + 1;
        this.name = "radio_"+this.constructor.cnt;
    }

    static get title() { return  _t("Radio") }
    static get icon() { return "dot-circle-o" }
    
    static get default() {
        return { options: _t("Option 1\nOption 2\nOption 3")}
    }
    
    static configForm(){
        return formControls.select.configForm();
    }

    reset() {
        Array.from(this.base.getElementsByTagName("input")).forEach((el,i)=>{
            el.checked = (i==0)
        });
    }

    getValue() {
        var ret = "";
        Array.from(this.base.getElementsByTagName("input")).forEach((el,i)=>{
            if (el.checked) ret = el.value;
        });
        return ret;
    }
        
    render(props,state) {
        return html`
            <div class="form_field">
                <label>
                    <${FieldLabel} value=${props.value} />
                    <div class="form_field_radio_values">
                        ${props.value.options.split("\n").map((option, i) => {
                            return html`
                                <label>
                                    <input type="radio" value=${option} name="${this.name}" class="form_field_radio" />
                                    ${option||""}
                                </label>
                            `
                        })}
                    </div>
                    <${FieldError} error=${state.error} />
                </label>
            </div>      
        `
    }
}

formControls.checkbox = class extends FormControl {
    static get title() { return _t("Checkbox") }
    static get icon() { return "check-square-o" }

    static configForm() {
        return html`
            <label>${_t("Field label")}</label>
            <${Input} name="label" />
            <${Switch} name="required" label=${_t("Is required?")} />
        `
    }
    reset() {
        this.input.checked = false;
    }
    getValue() {
        return this.input.checked;
    }
    render(props,state) {
        return html`
            <div class='form_field'>
                <label>
                    <input ref=${(r)=>this.input=r} class="form_field_checkbox" type="checkbox" />
                    ${" "+props.value.label}
                </label>
            </div>      
        `
    }
}

exports.FormControl = FormControl;
exports.formControls = formControls;