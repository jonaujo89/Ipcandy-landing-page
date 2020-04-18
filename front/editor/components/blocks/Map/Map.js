require("./Map.tea");

const {Block} = require("../../internal/Block/Block");
const {Repeater} = require("../../internal/Repeater/Repeater");
const {Text} = require("../../internal/Text/Text");
const {Image} = require("../../internal/Image/Image");
const {Icon} = require("../../internal/Icon/Icon");
const {YandexMap} = require("../../internal/YandexMap/YandexMap"); 
const {FormButton} = require("../../internal/FormButton/FormButton");
const {FormOrder} = require("../../internal/FormOrder/FormOrder");
const {DarkBlockColor} = require("../../internal/Color/Color");
const {BlockColor} = require("../../internal/Color/Color");
const {Switch} = require("../../internal/Switch/Switch");
const {Dialog} = require("../../internal/Dialog/Dialog");

class Map extends Block {

    static get title() { return _t('Contacts') }
    static get description() { return _t('Company contacts') }  

    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" showWhen=${{variant:[2,3,4,5]}} />
                <${Switch} name="show_title_2" label="${_t("Show second title")}" showWhen=${{variant:[2,3,4,5]}} />
                <${Switch} name="show_container_text" label="${_t("Show text")}" showWhen=${{variant:[1]}} />
                <label value="${_t("Background color")}" />
                <${BlockColor} name="background_color" showWhen=${{variant:[2,3,4,5]}} />
                <${DarkBlockColor} name="background_color" showWhen=${{ variant: [6] }} />
            <//>
        `;
    }
 
    static tpl_default_info_lines() {
        return config.language == 'en' ? [
            {text: '<b>Address:</b> Moscow, Color Blvd., 13'},
            {text: '<b>Phone:</b> +7 (495) 321-46-98'},
            {text: '<b>E-Mail:</b> smile@zaraza.net'},
        ] : [
            {text: '<b>Адрес:</b> г. Москва, Цветной бульвар, 13'},
            {text: '<b>Телефон:</b> +7 (495) 321-46-98'},
            {text: '<b>E-mail:</b> smile@zaraza.net'},
        ];
    }

    static tpl_default_send_message() {
        return config.language == 'en' ? {
                type: 'form',
                link: '',
                form_title: "Contact us",
                form_bottom_text: "We don't provide Israeli intelligence with your personal information",
                color: 'red',
                text: "Contact us",
                form: {
                    fields: [
                        { label: 'Name', sub_label: '', required: true, name: 'name', type: 'text', },
                        {  label: 'Phone', sub_label: '', required: true, name: 'phone', type: 'text', },
                        { label: 'Message', sub_label: '', required: true, name: 'message', type: 'textarea', },
                    ],
                    button: {color: 'blue', label: 'Send message'},
                    form_done_title: 'Message sent',
                    form_done_text: 'Application is sent. Our manager will contact you shortly.',
                }
            } : {
                type: 'form',
                link: '',
                form_title: "Напишите нам",
                form_bottom_text: "Мы не передаем Вашу персональную информацию третьим лицам",
                color: 'blue',
                text: "Напишите нам",
                form: {
                    fields: [
                        {label: 'Имя', sub_label: '', required: true, name: 'name', type: 'text',},
                        {label: 'Телефон', sub_label: '', required: true, name: 'phone', type: 'text',},
                        {label: 'Сообщение', sub_label: '', required: true, name: 'message', type: 'textarea',},
                    ],
                    button: {color: 'blue', label: 'Отправить сообщение'},
                    form_done_title: 'Сообщение отправлено',
                    form_done_text: 'Наш менеджер свяжется с Вами в ближайшее время.',
                }
            }
    }

    static tpl_default_location(lat, lng, name, address, phone) {
        const phone_label = config.language == 'en' ? "Phone" : "Телефон";
        return {
            name: name,
            desc: `${address}<br><b>"${phone_label}:</b> "${phone}`,
            map: {
                map: {
                    map_type: 'yandex',
                    map_center: [lat, lng],
                    map_zoom: 15,
                    map_places: [{
                        type: 'placemark',
                        title: name,
                        address: address,
                        lat: lat,
                        lng: lng,
                        color: 'red'
                    }]
               }
            }
        };
    }

    tpl_1(val) {
        return html`
        <div class="contacts contacts_1">
            <div class="container">
                ${val.show_container_text && html`
                    <div class="container_text">  
                        <${Repeater} name="items">
                            ${item => html` 
                                ${[1].map( i => {
                                    return html` 
                                        <div class="map_overlay">
                                            <div class="title">
                                                <${Text} name="title_1" options=${Text.plain_heading} />
                                            </div>
                                            <div class="desc">
                                                <${Text} name="desc_1" options=${Text.default_text} />
                                            </div> 
                                        </div>
                                    `
                                })}
                            `}
                        <//> 
                    </div>                
                `}
                <div class="map-block">
                    <${YandexMap} name="map" />
                </div>
            </div>
        </div>
        `
    }

    tpl_default_1() {
        return config.language == 'en' ? {
            show_container_text: true,
            map: YandexMap.tpl_default(),
            items: [
                {
                    title_1: 'One and the same are at the circus ring',
                    desc_1: `Moscow, Color Blvd., 13<br>200 meters from the rotation<br>Тел: +7 (495) 321-46-98<br>smile@zaraza.net`
                }
            ],
        } : {
            show_container_text: true,
            map: YandexMap.tpl_default(),
            items: [
                {
                    title_1: "На манеже все те же",
                    desc_1: `г. Москва, Цветной бульвар, 13<br>200 метров от поворота<br>Тел: +7 (495) 321-46-98<br>smile@zaraza.net`
                }
            ],
        }
    }

    tpl_2(val) {
        return html`
            <div class="contacts contacts_2" style="background: ${val.background_color}">
                <div class="container">
                    ${val.show_title && html`
                        <h2 class="title"> 
                            <${Text} name="title" options=${Text.plain_text}/>
                        </h2>
                    `}
                    ${val.show_title_2 && html`
                        <div class="title_2">
                            <${Text} name="title_2" options=${Text.plain_text}/>
                        </div>
                    `}
                    <div class="row">
                        <div class="col-5">
                            <div class="map-block">
                                <${YandexMap} name="map"/>
                            </div>
                            <div class="info-lines">
                                <${Repeater} name="info_lines">
                                    ${item => html`  
                                        <div class="info-line">
                                            <${Text} name="text" options=${Text.plain_text}/>
                                        </div>
                                    `}
                                <//>
                            </div>
                            <div class="span_btn" >
                                <div class="btn_wrap">
                                    <${FormButton} name="send_message_button"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <${Image} name="image"/>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_2() {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            title: 'How to find us',
            title_2: 'Not as easy as you supposed to think',
            background_color: '#FFFFFF',
            map: YandexMap.tpl_default(),
            info_lines:  Map.tpl_default_info_lines(),
            image: `${config.assets_url}/gallery/4.jpg`,
            send_message_button: Map.tpl_default_send_message()
        } : {
            show_title: true,
            show_title_2: true,
            title: 'Как нас найти',
            title_2: 'Легко потерять и невозможно забыть',
            background_color: '#FFFFFF',
            map: YandexMap.tpl_default(),
            info_lines:  Map.tpl_default_info_lines(),
             
            image: `${config.assets_url}/gallery/4.jpg`,
            send_message_button: Map.tpl_default_send_message()
        }
    }

    tpl_3(val) {
        return html`
            <div class="contacts contacts_3" style="background: ${val.background_color}">
                <div class="container">
                    <div class="row">
                        <div class="col-5">
                            ${val.show_title && html`
                                <h2 class="sub_title">
                                    <${Text} name="title" options=${Text.plain_text}/>
                                </h2>
                            `}
                            ${val.show_title_2 && html`
                                <div class="sub_title_2">
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                            `}
                            <div class="info-lines">
                                <${Repeater} name="info_lines">
                                    ${item => html`  
                                        <div class="info-line">
                                            <${Text} name="text" options=${Text.plain_text}/>
                                        </div> 
                                    `}
                                <//> 
                            </div>
                            <div class="span_btn">
                                <div class="btn_wrap">
                                    <${FormButton} name="send_message_button"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="map-block">
                                <${YandexMap} name="map"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_3(val) {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            title: 'How to find us',
            title_2: 'Not as easy as you supposed to think',
            background_color: '#FFFFFF',
            map: YandexMap.tpl_default(),
            info_lines:  Map.tpl_default_info_lines(),
            send_message_button: Map.tpl_default_send_message()
        } : {
            show_title: true,
            show_title_2: true,
            title: 'Как нас найти',
            title_2: 'Легко потерять и невозможно забыть',
            background_color: '#FFFFFF',
            map: YandexMap.tpl_default(),
            info_lines:  Map.tpl_default_info_lines(),
            send_message_button: Map.tpl_default_send_message()
        }
    }

    tpl_4(val) {
        return html`
             <div class="contacts contacts_4" style="background: ${val.background_color}">
                <div class="container">
                    <div class="row">
                        <div class="col-5">
                            ${val.show_title && html`
                                <h2 class="sub_title">
                                    <${Text} name="title" options=${Text.plain_text} />
                                </h2>
                            `}
                            ${val.show_title_2 && html`
                                <div class="sub_title_2">
                                    <${Text} name="title_2" options=${Text.plain_text} />
                                </div>
                            `}
                            <div class="info-lines">
                                <${Repeater} name="info_lines">
                                    ${item => html` 
                                        <div class="info-line">
                                            <${Text} name="text" options=${Text.plain_text} />
                                        </div>
                                    `}
                                <//> 
                            </div>
                        </div>
                        <div class="col-6 before-1">
                            <div class="form">
                                <div class="form_data">
                                    <${FormOrder} name="send_message_button.form" />
                                </div>
                                <div class="form_bottom">
                                    <${Text} name="send_message_button.form_bottom_text" options=${Text.plain_text} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_4() {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            title: 'How to find us',
            title_2: 'Not as easy as you supposed to think',
            background_color: '#FFFFFF',
            info_lines: Map.tpl_default_info_lines(),
            send_message_button: Map.tpl_default_send_message()
        } : {
            show_title: true,
            show_title_2: true,
            title: 'Как нас найти',
            title_2: 'Легко потерять и невозможно забыть',
            background_color: '#FFFFFF',
            info_lines: Map.tpl_default_info_lines(),
            send_message_button: Map.tpl_default_send_message()
        }

    }

    tpl_5(val) {
        return html`
            <div class="contacts contacts_5" style="background: ${val.background_color}">
                <div class="container">
                    ${val.show_title && html`
                        <h2 class="title">
                            <${Text} name="title" options=${Text.plain_text}/>
                        </h2>
                    `}
                    ${val.show_title_2 && html`
                        <div class="title_2"> 
                            <${Text} name="title_2" options=${Text.plain_text}/>
                        </div>
                    `}
                    <div class="locations">
                           <${Repeater} name="locations">
                                ${item => html`
                                    <div class="location">
                                        <div class="map-block">
                                            <${YandexMap} name="map" />
                                        </div>
                                        <div class="name">
                                            <${Text} name="text" options=${Text.plain_text} />
                                        </div>
                                        <div class="desc">
                                            <${Text} name="desc" options=${Text.plain_text} />
                                        </div>
                                    </div>
                                `}
                           <//>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_5() {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            background_color: '#FFFFFF',
            title: 'How to find us',
            title_2: 'Not as easy as you supposed to think',
            locations: [
                Map.tpl_default_location("55.770600", "37.620000", "First office", "Moscow, Color avenue, 13", "+7 (495) 112-11-55"),
                Map.tpl_default_location("40.706014", "-74.008899", "Second office", "New York, Wall street, 15", "+7 (495)783-22-14"),
                Map.tpl_default_location("48.870502", "2.306838", "Third office", "Paris, Les Champs, 56", "+7 (495) 763-34-12")
            ],
        } : {
            show_title: true,
            show_title_2: true,
            background_color: '#FFFFFF',
            title: 'Как нас найти',
            title_2: 'Легко потерять и невозможно забыть',
            locations: [
                Map.tpl_default_location("55.770600", "37.620000", "Первый офис", "Москва, Цветной бульвар, 13", "+7 (495) 112-11-55"),
                Map.tpl_default_location("40.706014", "-74.008899", "Второй офис", "Нью-Йорк, Уолл-стрит, 15", "+7 (495)783-22-14"),
                Map.tpl_default_location("48.870502", "2.306838", "Третий офис", "Париж, Елисейские поля, 56", "+7 (495) 763-34-12")
            ]
        } 
    }

    tpl_6(val) {
         return html`
            <div class="contacts contacts_6" style="background: ${val.background_color}">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="sub_title">
                                <${Text} name="title" options=${Text.plain_text} />
                            </h2>
                            <div class="sub_title_2">
                                <${Text} name="title_2" options=${Text.plain_text} />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="contact-lines">
                                <${Repeater} name="contact_lines">
                                    ${item => html` 
                                        <div class="contact-line">
                                            <${Icon} name="icon" />
                                            <${Text} name="title" options=${Text.plain_text} />
                                            <${Text} name="text" options=${Text.plain_text} />
                                        </div>
                                    `}
                                <//>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_6() { 
        return config.language == 'en' ? {
            title:  'How to find us',
            title_2:  'Not as easy as you supposed to think',
            background_color: '#313138',
            contact_lines:  [
                {
                    icon: `${config.assets_url}/ico/195.png`,
                    title: 'Address',
                    text: ' Moscow, Color Blvd., 13'
                },
                {
                    icon:  `${config.assets_url}/ico/217.png`,
                    title: 'Phone',
                    text: '+7 (495) 321-46-98'
                },
                {
                    icon:  `${config.assets_url}/ico/26.png`,
                    title: 'E-mail',
                    text: 'smile@zaraza.net'
                },
            ]
        } : {
            title: 'Как нас найти',
            title_2: 'Легко потерять и невозможно забыть',
            background_color: '#313138',
            contact_lines: [
                {
                    icon: `${config.assets_url}/ico/195.png`,
                    title: 'Адрес',
                    text: 'г. Москва, Цветной бульвар, 13'
                },
                {
                    icon: `${config.assets_url}/ico/217.png`,
                    title: 'Телефон',
                    text: '+7 (495) 321-46-98'
                },
                {
                    icon: `${config.assets_url}/ico/26.png`,
                    title: 'E-mail',
                    text: 'smile@zaraza.net'
                },
            ]
        }
    }
}

Block.register('Map',exports = Map);