const {Cover} = require("../Cover/Cover"); 
const {FormOrder} = require("../FormOrder/FormOrder");
const {Text} = require("../Text/Text");
const {Dialog} = require("../Dialog/Dialog");
const {Radio} = require("../Radio/Radio");
const {Input} = require("../Input/Input");
const {ButtonColor} = require("../Color/Color");
const {Editable} = require("../Editable/Editable");

const FormButton = Editable(class extends preact.Component {

    showForm() {
        this.coverCmp.configDialog.close();
        window.alertify.genericDialog(this.form);
    }

    showFormSuccess() {
        this.coverCmp.configDialog.close();        
        window.alertify.genericDialog(this.formOrder.formSuccess);
    }

    render(props) {
        return html`
            <${Cover}
                ref=${(r)=>this.coverCmp=r}
                configForm=${html`
                    <${Dialog} title=${_t("Order button")}>
                        <label>${_t("Button behavior after click:")}</label>
                        <${Radio} name="type" items=${[
                            { label: _t("Show order form"), value: 'form' },
                            { label: _t("Go to the link"), value: 'link' }
                        ]} />
                        <div class="lp-row">
                            <div>
                                <label>${_t("Button text:")}</label>
                                <${Input} name="text" />
                            </div>
                            <div>
                                <label>${ _t("Button color:")}</label>
                                <${ButtonColor} name="color" />
                            </div>
                        </div>
                        ${props.value.type=="form" && html`
                            <label>${_t("Form")}</label>
                            <button onClick=${()=>this.showForm()}>${_t("Show form")}</button>
                            <button onClick=${()=>this.showFormSuccess()}>${_t("Show success window")}</button>
                        `}
                        ${props.value.type=="link" && html`
                            <label>${_t("Link")}</label>
                            <${Input} name="link" />
                        `}
                    <//>
                `}
            >
                <a class="btn_form ${props.value.color}" href=${props.value.type=="link" ? props.value.link : undefined}>
                    ${props.value.text}
                </a>
                ${props.value.type == 'form' && html`
                    <div style='display:none'>
                        <div class="form" ref=${(r)=>this.form=r}>
                            <div class="form_title">
                                <${Text} name="form_title"/>    
                            </div>
                            <div class="form_data">
                                <${FormOrder} ref=${(r)=>this.formOrder=r} name="form"/>
                            </div>
                            <div class="form_bottom" >
                                <${Text} name="form_bottom_text"/>    
                            </div>
                        </div>
                    </div>
                `}

            <//>
        `;
    }
})

FormButton.tpl_default = () => { 
    return window.locale_lang == 'en' ? {
        type: 'form',
        link: '',
        form_title: "Leave application",
        form_bottom_text: "We don't provide Israeli intelligence with your personal information",
        color: 'red',
        text: "Leave an application",
        form: FormOrder.tpl_default()
    } : {
        type: 'form',
        link: '',
        form_title: 'Оставить заявку',
        form_bottom_text: "Мы не передаем Вашу персональную информацию третьим лицам",
        color: 'red',
        text: 'Оставить заявку',
        form: FormOrder.tpl_default()
    }
};

exports.FormButton = FormButton;