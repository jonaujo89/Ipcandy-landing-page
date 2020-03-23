require("./FormOrder.tea");

const {Input} = require("../Input/Input");
const {Text} = require("../Text/Text");
const {Dialog} = require("../Dialog/Dialog"); 
const {Editable} = require("../Editable/Editable");
const {Cover} = require("../Cover/Cover");
const {Color} = require("../Color/Color");
const {Switch} = require("../Switch/Switch");
const {ValueContext} = require("../Block/Block");

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

let formControls = {
    text: {
        selectLabel: _t("Text"),
        selectIcon: "font",
        configForm: (props)=>html`
            <label>${_t("Field label")}</label>
            <${Input} name="label" />
            <label>${_t("Field description")}</label>
            <${Input} name="desc" />
            <label>${_t("Field placeholder")}</label>
            <${Input} name="placeholder" />
            <${Switch} name="required" label=${_t("Is required?")} />
        `,
        tpl: (value)=>html`
            <div class="form_field">
                <label>
                    <${FieldLabel} value=${value} />
                    <input class="form_field_text" type="text" placeholder=${value.placeholder || ""} />
                    <div class="error" />
                </label>
            </div>
        `
    },
    textarea: {
        selectLabel: _t("Text area"),
        selectIcon: "bars",
        configForm: (props)=>html`
            <${formControls.text.configForm} />
        `,
        tpl: (value)=>html`
            <div class="form_field">
                <label>
                    <${FieldLabel} value=${value} />
                    <textarea class="form_field_textarea" rows="3" placeholder=${value.placeholder || ""} />
                    <div class="error" />
                </label>
            </div>        
        `
    }
}


const FieldsRepeater = Editable((props)=>{

    [selected,setSelected] = preact.hooks.useState(-1);

    function addField(type) {
        var cls = formControls[type];
        var item_default = {type:type,label:cls.selectLabel};
        var new_value = [...props.value,item_default];
        setSelected(new_value.length-1);
        props.onChange(new_value);            
    }

    function removeField(idx) {
        var new_value = [...props.value];
        new_value.splice(idx,1);
        props.onChange(new_value);
        if (selected==idx) setSelected(-1);
    }

    return html`<div class="lp-form-repeater">
        <div class="lp-form-repeater-items">
            ${props.value.map((sub,sub_idx)=>{
                var type = formControls[sub.type];
                return html`
                    <div class="lp-form-repeater-item ${sub_idx==selected ? "selected":""}">
                        <div class="lp-form-repeater-item-title" onClick=${()=>setSelected(sub_idx==selected ? -1 : sub_idx)}>
                            <i class="fa fa-${type.selectIcon}" />
                            ${sub.label || "["+sub.placeholder+"]"}
                            <span class="lp-form-repeater-button-remove" onClick=${()=>removeField(sub_idx)}>
                                <i class="fa fa-times" />
                            </span>
                        </div>
                        <div class="lp-form-repeater-item-content">
                            <${ValueContext.Provider} value=${{value:sub,name:props.fullName+"."+sub_idx}}>
                                <${type.configForm} />
                            <//>
                        </div>
                    </div>
                `;
            })}
        </div>
        <div class="lp-form-repeater-item">
            <div class="lp-form-repeater-item-title">
                ${_t("Add Field")}
            </div>
            <div class="lp-form-repeater-item-content">
                ${Object.keys(formControls).map((typeId)=>{ 
                    let type = formControls[typeId];
                    return html`
                    <button onClick=${()=>addField(typeId)}>
                        <i class="fa fa-${type.selectIcon}"></i>
                        ${type.selectLabel}
                    </button>`
                })}
            </div>
        </div>
    </div>`
});

const FormOrder = Editable(class extends preact.Component {
    showFormSuccess() {
        this.coverCmp.configDialog.close();        
        window.alertify.genericDialog(this.formSuccess);
    }
    
    render(props) {
        return html`
            <${Cover}
                ref=${(r)=>this.coverCmp=r}
                configForm=${html`
                    <${Dialog} title=${_t("Form")}>
                        <${FieldsRepeater} name="fields" />
                        <div class="lp-row">
                            <div>
                                <label>${_t("Button text:")}</label>
                                <${Input} name="button.label" />
                            </div>
                            <div>
                                <label>${_t("Button color:")}</label>
                                <${Color} name="button.color" iconSize=${15} items=${[
                                    { value: 'blue', color: '#0187BC' },
                                    { value: 'green', color: '#3E9802' },
                                    { value: 'orange', color: '#FD6F00' },
                                    { value: 'purple', color: '#8C33D2' },
                                    { value: 'purple_light', color: '#9581BF' },
                                    { value: 'rose', color: '#F372A4' },
                                    { value: 'red', color: '#CE0707' },
                                    { value: 'yellow', color: '#FFC415' }                   
                                ]} />
                            </div>
                        </div>
                        <button onClick=${()=>this.showFormSuccess()}>${_t("Show success window")}</button>
                    <//>            
                `}
            >
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form_fields">  
                        ${props.value.fields.map((sub)=>formControls[sub.type].tpl(sub))}
                    </div>
                    <div class="form_submit">
                        <button type="submit" class="form_field_submit ${props.value.button.color}">
                            <div>
                                <span>${props.value.button.label}</span>
                            </div>
                        </button>
                    </div>
                    <div style="display:none">
                        <div class="form_done" ref=${(r)=>this.formSuccess=r}>
                            <div class="form_done_title">
                                <${Text} name="form_done_title" options=${Text.default_text} />
                            </div>
                            <div class="form_done_text">
                                <${Text} name="form_done_text" options=${Text.default_text} />
                            </div>
                        </div>
                    </div>                
                </form>
            <//>
        `;
    }
});

FormOrder.tpl_default = () => {
    return window.locale_lang == 'en' ? {
        fields: [
            {
                label: "Name", sub_label: '', required: true,
                name: 'name', type: 'text',
            },
            {
                label: "Phone", sub_label: '', required: true,
                name: 'phone', type: 'text',
            },
        ],
        button: {color: 'blue', label: 'Get an advice'},
        form_done_title: "Thank for application",
        form_done_text: "Application send. Our manager will contact you shortly.",
    } : {
        fields: [
            {
                label: 'Имя', sub_label: '', required: true,
                name: 'name', type: 'text',
            },
            {
                label: 'Телефон', sub_label: '', required: true,
                name: 'phone', type: 'text',
            },
        ],
        button: {color: 'blue', label: 'Получить консультацию'},
        form_done_title: 'Спасибо за заявку',
        form_done_text: 'Заявка отправлена. Наш менеджер свяжется с Вами в ближайшее время.',
    }
}

exports.FormOrder = FormOrder;