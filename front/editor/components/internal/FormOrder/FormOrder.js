require("./FormOrder.tea");
const {Text} = require("../Text/Text");
const {Dialog} = require("../Dialog/Dialog"); 
const {Editable} = require("../Editable/Editable");
const {Cover} = require("../Cover/Cover");
const {Color} = require("../Color/Color");
const {Input} = require("../Input/Input");
const {FieldsRepeater} = require("./FieldsRepeater");
const {formControls} = require("./FormControl");
require("./Track");

const FormOrder = Editable(class extends preact.Component {
    showFormSuccess() {
        Dialog.closeAll();
        this.successDialog.open();
    }

    onSubmit(e) {
        e.preventDefault();

        let valid = true;
        this.fields.forEach((field)=>{
            if (!field.validate()) valid = false;
        });
        if (!valid) return;

        var file_counter = 0
        var values = [];
        var data = new FormData();

        this.fields.forEach((field)=>{
            var value = field.getValue();
            if (value instanceof FileList) {
                value = Array.from(value).map((file)=>{
                    var name = 'file-'+file_counter++;
                    data.append(name,file);
                    return name;
                });
            }
            values.push({label:field.props.value.label,value:value});
        });
        data.append('form',JSON.stringify(values));
        data.append("status","new");
        data.append('type','track');

        Editor.instance.request('entity-edit',data,(response)=>{
            let result = JSON.parse(response);
            let div = document.createElement('div');
            preact.render(html`
                <p>
                    ${_t('You have a new form track')}<br/>
                    <a href="${config.base_url}/track">${_t('Goto track list')}</a><br/><br/>
                    ${values.map(({label,value})=>{
                        let sub = value;
                        if (typeof value == 'boolean') sub = value ? _t('yes') : _t('no');
                        if (Array.isArray(value)) {
                            sub = value.map((name)=>{
                                let download_url = config.base_url+"/api/entity-file?id="+result.id+"&name="+encodeURIComponent(name);
                                return html`<a href=${download_url}>${data.get(name).name}</a><br/>`;
                            });
                        }
                        return html`<b>${label}:</b> ${sub}<br/>`;
                    })}
                    <br/><br/>
                </p>
            `, div);

            Editor.instance.request('email-send',{
                subject: _t('LPCandy: you have a new form submission {id}').replace('{id}', result.id),
                text: '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"/><body>'+div.innerHTML+"</body>"
            });
            this.fields.forEach((field)=>field.reset());
            this.showFormSuccess();
        });
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
                <form action="" method="post" enctype="multipart/form-data" onSubmit=${(e) => this.onSubmit(e)}>
                    <div class="form_fields">  
                        ${props.value.fields.map((sub, sub_idx) => {
                            const ControlType = formControls[sub.type];
                            if (!ControlType) { console.debug('Field control type is not defined',sub); return; }
                            return html`<${ControlType} value=${sub} ref=${(r)=>{
                                if (!r) return;
                                if (sub_idx==0) this.fields=[]; 
                                this.fields.push(r); 
                            }} />`;
                        })}
                    </div>
                    <div class="form_submit">
                        <button type="submit" class="form_field_submit ${props.value.button.color}">
                            <div>
                                <span>${props.value.button.label}</span>
                            </div>
                        </button>
                    </div>
                    <${Dialog} ref=${(r)=>this.successDialog=r} class="success_dialog" overlayColor="rgba(0,0,0,0.5)">
                        <div class="form_done">
                            <div class="form_done_title">
                                <${Text} name="form_done_title" options=${Text.default_text} />
                            </div>
                            <div class="form_done_text">
                                <${Text} name="form_done_text" options=${Text.default_text} />
                            </div>
                        </div>
                    <//>                
                </form>
            <//>
        `;
    }
});

FormOrder.tpl_default = () => {
    return config.language == 'en' ? {
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

FormOrder.tpl_default_email = () => {
    let tpl_default = FormOrder.tpl_default();
    tpl_default.fields.push(
        window.locale_lang == 'en' ? {
            label: "Email", sub_label: '', required: false,
            name: 'email', type: 'text',
        } : {
            label: 'Электронная почта', sub_label: '', required: false,
            name: 'email', type: 'text',
        }
    );
    return tpl_default;
}

exports.FormOrder = FormOrder;