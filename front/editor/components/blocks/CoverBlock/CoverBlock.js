require("./CoverBlock.tea");

const {
    Block,Repeater,Text,Icon,FormButton,FormOrder,Media,
    Background,Switch,Dialog,UploadButton
} = require("../../internal");

class CoverBlock extends Block {

    static get title() { return _t('Cover') }
    static get description() { return _t('') }

    configForm() {
        return html`
            <${Dialog}> 
                <${Switch} name="show_icon" label="${_t("Show icon")}" showWhen=${{variant:[1,2]}} /> 
                <${Switch} name="show_title" label="${_t("Show first title")}" /> 
                <${Switch} name="show_title_2" label="${_t("Show second title")}" />
                <${Switch} name="show_form" label="${_t("Show form")}" showWhen=${{variant:[1,2]}} />
                <${Switch} name="show_form_as_popup" label="${_t("Show form as popup")}" showWhen=${{variant:[1,2]}} />
                <${Switch} name="show_description" label="${_t("Show description")}" showWhen=${{variant:[1,2]}} />
                <label>${_t("Background image:")}</label>
                <${Background}
                    name="background"
                    items=${()=>{
                         var items = [];
                         for (var i=1;i<=100;i++) {
                             items.push({
                                 value:config.assets_url+"/cover/cover-"+i+".jpg",
                                 thumb:config.assets_url+"/cover/thumbs/cover-"+i+".jpg",
                             });
                         }
                         return items;
                    }}
                    itemWidth=${200}
                    itemHeight=${112}
                    comboWidth=${635}
                    comboHeight=${600}
                    dropdown=${true}
                />
                <${UploadButton} name="background" label=${_t('Upload image file')} />
            <//>
        `;
    }

    tpl_1(val) {
        return html`
            <div class="container-fluid cover cover_1 cover_1_2 cover_1_2_center" style="background-image: url('${config.base_url+"/"+val.background}')">
                <div class="container">
                    <div class="row">
                        <div class="col-6 before-3">
                            ${val.show_icon && html`
                                <div class="icon">
                                    <${Icon} name="icon" iconType="white"/>
                                </div>
                           `}
                            ${val.show_title && html`
                                <div class="sub_title">
                                    <${Text} name="title" options=${Text.plain_text}/>
                                </div>
                            `}
                            ${val.show_title_2 && html`
                                <div class="sub_title_2">
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                           `}
                           ${val.show_form && val.show_form_as_popup && html`
                                <div class="form form_popup">
                                    <form>
                                        <div class="form_submit">
                                            <div class="btn_wrap">
                                                <${FormButton} name="form_button"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            `}
                            ${val.show_form && !val.show_form_as_popup && html`
                                <div class="form form_inline">
                                    <${FormOrder} name="form_button.form"/>
                                </div>
                            `}
    
                            ${val.show_description && html`
                                <div class="description">
                                    <${Text} name="description" options=${Text.default_text}/>
                                </div>
                            `}
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_1() {
        const params = config.language == 'en' ? {
            title: 'Our circus works from dusk till down',
            title_2: 'Bring your kids, colleagues, enemies, strangers, aliens and even pets here',
            description: 'Leave your email and we will send you some jokes',
            form_button: {
                type: 'form',
                link: '',
                form_title: 'Subscribe to jokes',
                form_bottom_text: "We do not share anything from your personal info",
                color: 'blue',
                text: 'Gimme some jokes!',
                form: {
                    button: {color: 'blue', label: "Subscribe"},
                    form_done_title: 'Thank you!',
                    form_done_text: 'You have subscribed',
                    fields: [
                        {
                            label: 'Name', sub_label: '', required: true, name: 'name', type: 'text'
                        },
                        {
                            label: 'E-mail', sub_label: '', required: true, name: 'email', type: 'text', placeholder: ''
                        }
                    ]
                }
            },
        } : {
            title: 'Двери нашего цирка открыты всегда',
            title_2: 'Приводите детей, дедушек, бабушек и даже домашних животных',
            description: 'Оставьте свою почту и мы будем присылать вам смешные анекдоты от наших клоунов',

            form_button: {
                type: 'form',
                link: '',
                form_title: 'Подписка на шутки',
                form_bottom_text: "Мы не передаем Вашу персональную информацию третьим лицам",
                color: 'blue',
                text: 'Хочу подписку на шутки!',
                form: {
                    button: {color: 'blue', label: "Подписаться"},
                    form_done_title: 'Спасибо!',
                    form_done_text: 'Вы успешно подписались',
                    fields: [
                        {label: 'Имя', sub_label: '', required: true, name: 'name', type: 'text'},
                        {label: 'E-mail', sub_label: '', required: true, name: 'email', type: 'text', placeholder: ''}
                    ]

                }
            }
        };

        const baseParams = {
            background: `${config.assets_url}/gallery/6.jpg`,
            icon: `${config.assets_url}/ico/383.png`,
            show_icon: false,
            show_title: true,
            show_title_2: true,
            show_form: true,
            show_form_as_popup: false,
            show_description: true
        };

        return {...baseParams, ...params}
    }

    tpl_2(val) {
        return html`
             <div class="container-fluid cover cover_2 cover_1_2 cover_1_2_right" style="background-image: url('${config.base_url+"/"+val.background}')">
                <div class="container">
                    <div class="row">
                        <div class="col-6 before-3">
                            ${val.show_icon && html`
                                <div class="icon">
                                    <${Icon} name="icon" iconType="white'"/>
                                </div>
                           `}
                            ${val.show_title && html`
                                <div class="sub_title">
                                    <${Text} name="title" options=${Text.plain_text}/>
                                </div>
                            `}
                            ${val.show_title_2 && html`
                                <div class="sub_title_2">
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                           `}
                           ${val.show_form && val.show_form_as_popup && html`
                                <div class="form form_popup">
                                    <form>
                                        <div class="form_submit">
                                            <div class="btn_wrap">
                                                <${FormButton} name="form_button"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            `}
                            ${val.show_form && !val.show_form_as_popup && html`
                                <div class="form form_inline">
                                    <${FormOrder} name="form_button.form"/>
                                </div>
                            `}
    
                            ${val.show_description && html`
                                <div class="description">
                                    <${Text} name="description" options=${Text.default_text}/>
                                </div>
                            `}
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_2() {
        return {
            ...CoverBlock.prototype.tpl_default_1(),
            'background': config.assets_url+'/gallery/8.jpg',
            'show_form': true,
            'show_title_2': false,
            'show_form_as_popup': true,
            'show_description': true,
        }
    }

    tpl_3(val) {
        return html`
            <div class="container-fluid cover cover_3"  style="background-image: url('${config.base_url+"/"+val.background}')">
                <div class="container">
                    <div class="cover-content">
                        ${val.show_title && html`
                            <div class="title">
                                <${Text} name="title" options=${Text.plain_text}/>
                            </div>
                        `}
                       ${val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_text}/>
                            </div>
                        `}
    
                        <div class="row">
                            <div class="col-6 before-1 media-col">
                                <${Media} name="media"/>
                            </div>
                            <div class="col-4 form-col">
                                <div class="form">
                                    <${FormOrder} name="form_button.form"/>
                                    <div class="form_bottom">
                                        <${Text} name="form_button.form_bottom_text" options=${Text.plain_text}/> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_3() {
        let def = CoverBlock.prototype.tpl_default_1();
        return {
            'show_title': true,
            'show_title_2': true,
            'title': def['title'],
            'title_2': def['title_2'],
            'background': config.assets_url+'/gallery/3.jpg',
            'media': {...Media.tpl_default(),type:'video'},
            'form_button': def['form_button']
        };        
    }
}

Block.register('Cover',exports = CoverBlock);