require("./Order.tea"); 

const {Block,Repeater,Text,Media,FormOrder,FormButton,Icon,Radio,Background,UploadButton,Color,DarkBlockColor,Switch,Dialog} = require("../../internal");  

class Order extends Block { 

    static get title() { return _t('Order') }
    static get description() { return _t('Block with a picture and form') } 

    configForm() {
        var val = this.value;
        return html`
            <${Dialog}> 
                <label showWhen=${{variant:[1, 2, 6]}} >${_t("Background image:")}</label>
                <${Background}
                    name="background"
                    items=${() => {
                            var items = [];
                            for (var i=1;i<=221;i++) {
                                items.push({
                                    value:lp.app.options.assets_url+"/background/"+i+".jpg",
                                    thumb:lp.app.options.assets_url+"/background/thumbs/"+i+".jpg",
                                });
                            }
                            return items;
                    }}
                    itemWidth=${210}
                    itemHeight=${50}
                    comboWidth=${665}
                    comboHeight=${600}
                    dropdown=${true}
                    showWhen=${{variant:[1, 2, 6]}}
                />
                <${UploadButton} name="background" label=${_t('Upload image file')} showWhen=${{variant:[1, 2, 6]}} />
                <${Switch} name="show_background_noise" label="${_t("Show noise")}" showWhen=${{variant:[2]}}/>
                <${Switch} name="show_text_above_button" label="${_t("Show text above the button")}" showWhen=${{variant:[2]}}/>
                <${Switch} name="show_arrow" label="${_t("Show arrow")}" showWhen=${{variant:[2]}}/>
                <${Switch} name="show_form_title_2" label="${_t("Show text under the form title")}" showWhen=${{variant:[1]}}/> 
                <${Switch} name="show_title_2" label="${_t("Show second title")}" showWhen=${{variant:[3,4,5,6]}}/>
                <${Switch} name="show_title_3" label="${_t("Show third title")}" showWhen=${{variant:[6]}}/>
                <${Switch} name="show_form_bottom_text" label="${_t("Show text under the form")}" showWhen=${{variant:[1,4,5,6]}}/>
                <${Switch} name="show_border" label="${_t("Show image around")}" showWhen=${{variant:[3]}}/>
                <${Switch} name="show_box_shadow" label="${_t("Show image around")}" showWhen=${{variant:[4]}}/>
                <${Switch} name="show_list_box" label="${_t("Show list box")}" showWhen=${{variant:[3]}}/>
                ${val.variant == 6 && html`<label>${_t("Form align:")}</label>`}  
                <${Radio} name="form_align" items=${[
                    { label: _t("left"), value:"left"},
                    { label: _t("center"), value:"center"},
                    { label: _t("right"), value:"right"}
                ]} showWhen=${{variant:[6]}} /> 
                ${(val.variant == 4 || val.variant ==  5) && html`<label>${_t("Background color:")}</label>`}  
                <${DarkBlockColor} name="background_color" showWhen=${{variant:[4,5]}} />
                ${val.variant == 3 && html`<label>${_t("Background texture:")}</label>`} 
                <${Background} name="background"
                    items=${() => {
                        var items = [];
                        for (var i=1;i<=24;i++) {
                            items.push({
                                value:lp.app.options.assets_url+"/texture/"+i+".png",
                            });
                        }
                        return items;
                    }}
                    itemWidth=${50}
                    itemHeight=${50}
                    comboWidth=${435}
                    comboHeight=${175}
                    dropdown=${true}
                    showWhen=${{variant:[3]}}
                />
            <//>
       `
    } 

    tpl_1(val) {
        return html`
            <div class="container-fluid order order_1" style="background-image: url('${base_url}/${val.background}')">
                <div class="dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 text_wrapper">
                                <div class="title">
                                    <div class="list">
                                        <${Text} name="title_1" options=${Text.plain_text}/>
                                    </div>                               
                                </div>
                                <div class="title_2">
                                    <div class="list">
                                        <${Text} name="title_2" options=${Text.plain_text}/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 before-2 form_wrapper">  
                                <div class="form">
                                    <div class="form_title">
                                        <${Text} name="form_title_1" options=${Text.default_text}/>
                                    </div>
                                    ${val.show_form_title_2 && html`
                                        <div class="form_title_2">
                                            <${Text} name="form_title_2" options=${Text.default_text}/>
                                        </div>
                                    `}
                                    <div class="form_data">
                                        <${FormOrder} name="form"/>
                                    </div>
                                    ${val.show_form_bottom_text && html`
                                        <div class="form_bottom">
                                            <${Text} name="form_bottom_text" options=${Text.default_text}/>
                                        </div>
                                    `}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_1() {
        return window.locale_lang == 'en' ? {
            show_form_title_2: true,
            show_form_bottom_text: true,
            background: `${lp.app.options.assets_url}/background/91.jpg`,
            title_1: "<div>SMILES</div><div>HOME</div><div>DELIVERY</div>",
            title_2: "<div>Only quality smiles</div><div>Guaranteed safety of cargo</div><div>Timely delivery</div>",
            form_title_1: "Leave the application and get a free smile",
            form_title_2: "WAITING FOR A COURIER",
            form_bottom_text: "We don't provide Israeli intelligence with your personal information",
            form: FormOrder.tpl_default(),
        } : {
            show_form_title_2: true,
            show_form_bottom_text: true,
            background: `${lp.app.options.assets_url}/background/91.jpg`,
            title_1: "<div>ДОСТАВКА</div><div>УЛЫБОЧЕК</div><div>ВАМ ДОМОЙ</div>",
            title_2: "<div>Только качественные улыбочки</div><div>Гарантированная сохранность груза</div><div>Своевременная доставка</div>",
            form_title_1: "Оставьте заявку и получите бесплатную улыбочку",
            form_title_2: "Ожидайте курьера",
            form_bottom_text: "Мы не передаем Вашу персональную информацию израильской разведке",
            form: FormOrder.tpl_default(),
        }
    }

    tpl_2(val) {
        return html`
            <div class="container-fluid order order_2" style="background-image: url('${base_url}/${val.background}' )">
                <div class="background_toggle_noise ${val.show_background_noise ? 'with_noise' : 'dark'}">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="title"> 
                                    <${Text} name="title_1" options=${Text.plain_text}/>
                                </div>
                                <div class="title_2">
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                                ${val.show_text_above_button && html`
                                    <div class="btn_note">
                                        <${Text} name="button_note" options=${Text.plain_text}/>
                                    </div>
                                `}
                                <br/>
                                <div class="btn_wrap ${!val.show_arrow && "no_arrow"} ${!val.show_text_above_button && "no_btn_note"}">                        
                                    <${FormButton} name="button_order"/>                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_2() {
        return window.locale_lang == 'en' ? {
            show_background_noise: true,
            show_text_above_button: true,
            show_arrow: true,
            background: `${lp.app.options.assets_url}/background/192.jpg`,
            title_1: "Free training of juggling",
            title_2: "Secret technique of  clown Zhora juggling",
            button_note: "Order Zhora and his friend Kleve right now! ",
            button_order: {...FormButton.tpl_default(), text: 'Teach me to juggle', color: 'orange'}
        } : {
            show_background_noise: true,
            show_text_above_button: true,
            show_arrow: true,
            background: `${lp.app.options.assets_url}/background/192.jpg`,
            title_1: "Бесплатное обучение жонглированию",
            title_2: "Секретная методика жонглирования от клоуна Жоры",
            button_note: "Закажите Жору и его друга Клеву прямо сейчас!",
            button_order: {...FormButton.tpl_default(), text: 'Обучить меня жонглировать', color: 'orange'}
        }
    }

    tpl_3(val) {
        return html`
            <div class="container-fluid order order_3" style="background-image: url('${base_url}/${val.background}')">
                <div class="container">
                    <div class="row">
                        <div class="media_col col-5">       
                            <div class="img_wrap ${!val.show_border && "hide_border"}">
                                <${Media} name="media"/>
                            </div>
                        </div>
                        <div class="data_wrap col-6 before-1">
                            <div class="title">
                                <${Text} name="title_1" options=${Text.color_text}/>
                            </div>
                            ${val.show_title_2 && html`
                                <div class="title_2">
                                    <${Text} name="title_2" options=${Text.color_text}/>
                                </div>
                            `}
                            <div class="desc">
                                <${Text} name="desc" options=${Text.default_text}/>
                            </div>
                            ${val.show_list_box && html`
                                <div class="list" >
                                    <ul>
                                        <${Text} name="list" options=${Text.plain_text}/>
                                    </ul>
                                </div>
                            `}
                            <div class="btn_wrap">                        
                                <${FormButton} name="button_order"/>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_3() {
        return window.locale_lang == 'en' ? {
                show_border: true,
                show_title_2: true,
                show_list_box: false,
                background: `${lp.app.options.assets_url}/texture/1.png`,
                media: {...Media.tpl_default(),type: 'image',  image_url: `${lp.app.options.assets_url}/order/order_3.jpg`,}, 
                title_1: "ONLY <span style='color:#C1103A'>REAL</span> AFRICAN ELEPHANTS",
                title_2: "NO CHINESE FAKES",
                desc: "Free exhibition of the Somali purple elephant.<br>Show time - 10 minutes.",
                list: "<p>Only we have clearing skin elephant</p><p>Only we have baking elephant</p><p>Only we have an elephant witch executes the command SIT</p>",
                button_order: {...FormButton.tpl_default(), text: "Have a look at the elephant", color: 'purple_light'},

            } :
            {
                show_border: true,
                show_title_2: true,
                show_list_box: false,
                background: `${lp.app.options.assets_url}/texture/1.png`,
                media: {...Media.tpl_default(), type: 'image', image_url: `${lp.app.options.assets_url}/order/order_3.jpg`,},
                title_1: "ТОЛЬКО <span style='color:#C1103A'>НАСТОЯЩИЕ</span> СЛОНЫ ИЗ АФРИКИ",
                title_2: "НИКАКИХ ПОДДЕЛОК ИЗ КИТАЯ",
                desc: "Бесплатно покажем Вам фиолетового сомалийского слона.<br>Время показа - 10 минут.",
                list: "<p>Только у нас слон сбрасывает свою шкуру</p><p>Только у нас слон лает</p><p>Только у нас слон выполняет команду СИДЕТЬ</p>",
                button_order: {...FormButton.tpl_default(), text: 'Посмотреть слона', color: 'purple_light'}
            }
    }

    tpl_4(val)
        {
            return html`
           <div class="container-fluid order order_4" style="background: ${val.background_color}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="title">
                                <${Text} name="title_1" options=${Text.plain_heading}/>
                            </div>
                            ${val.show_title_2 && html`
                                <div class="title_2">
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                            `}
                            <div class="row data_wrap">
                                <div class="col-7">
                                    <div class="img_wrap ${!val.show_box_shadow ? 'hide_box_shadow' : ''}">
                                        <${Media} name="media"/>
                                    </div>
                                </div>
                                <div class="col-5"> 
                                    <div class="form">
                                        <div class="form_title">                       
                                            <${Text} name="form_title" options=${Text.plain_text}/>
                                        </div>
                                        <div class="form_data">
                                            <${FormOrder} name="form"/>
                                        </div>
                                        ${val.show_form_bottom_text && html`
                                            <div class="form_bottom">
                                                <${Text} name="form_bottom_text" options=${Text.plain_text}/>
                                            </div>
                                        `}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        `
        }

        tpl_default_4(val)
        {
            return window.locale_lang == 'en' ? {
                    show_form_bottom_text: true,
                    show_box_shadow: true,
                    show_title_2: true,
                    background_color: '#313138',
                    media: {
                        ...Media.tpl_default(),
                        type: 'image',
                        image_url: `${lp.app.options.assets_url}/order/order_4.jpg`
                    },
                    title_1: "Exclusive Session of infectious laughter",
                    title_2: "Inimitable smile from baby Jeremy",
                    form_title: "LEAVE THE APPLICATION FOR FREE SMILE",
                    form_bottom_text: "We don't provide Israeli intelligence with your personal information",
                    form: {...FormOrder.tpl_default(), button: {color: 'rose', label: "Get a smile"}},
                }
                :
                {
                    show_form_bottom_text: true,
                    show_box_shadow: true,
                    show_title_2: true,
                    background_color: '#313138',
                    media: {
                        ...Media.tpl_default(),
                        type: 'image',
                        image_url: `${lp.app.options.assets_url}/order/order_4.jpg`
                    },
                    title_1: "Эксклюзивный сеанс заразительного смеха",
                    title_2: "Неповторимая улыбочка от малыша Джереми",
                    form_title: "ОСТАВЬТЕ ЗАЯВКУ НА БЕСПЛАТНЫЙ СЕАНС УЛЫБКИ",
                    form_bottom_text: "Мы не передаем Вашу персональную информацию израильской разведке",
                    form: {...FormOrder.tpl_default(), button: {color: 'rose', label: "Получить улыбочку"}},
                }
        }

         tpl_5(val) {
        return html`
            <div class="container-fluid order order_5" style="background: ${val.background_color}">
                <div class="title_wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="title">
                                    <${Text} name="title_1" options=${Text.plain_heading}/>
                                </div>
                                ${val.show_title_2 && html`
                                    <div class="title_2">
                                        <${Text} name="title_2" options=${Text.plain_heading}/>
                                    </div>
                            `}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="ico_list col-7">
                            <${Repeater} name="items">${item => html`   
                                <div class="item">
                                    <${Icon} name="icon" iconType="white"/>
                                    <div class="name">
                                        <${Text} name="icon_title" options=${Text.plain_heading}/>
                                    </div>
                                    <div class="desc">
                                        <${Text} name="icon_desc" options=${Text.plain_text}/>
                                    </div>
                                </div> 
                        `}<//>
                        </div>
                        <div class="col-5">
                            <div class="form">
                                <div class="form_title">
                                    <${Text} name="form_title" options=${Text.plain_text}/>
                                </div>
                                <div class="form_data">
                                    <${FormOrder} name="form"/>
                                </div>
                                ${val.show_form_bottom_text && html`
                                    <div class="form_bottom">
                                        <${Text} name="form_bottom_text" options=${Text.plain_text}/>
                                    </div>
                                `}
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_5() {
        return window.locale_lang == 'en' ? {
            show_form_bottom_text: true,
            show_title_2: true,
            background_color: '#313138',
            title_1: "Just ridiculous and funny performance",
            title_2: "We work only with professionals of premium",
            form_title: "ORDER A FREE SEANCE",
            items: [
                {
                    icon: `${lp.app.options.assets_url}/ico/537.png`,
                    icon_title: "Injections of infectious laughter",
                    icon_desc: "Tested by assistant manager of the circus and allowed in a number of countries, even in Jamaica."
                },
                {
                    icon: `${lp.app.options.assets_url}/ico/464.png`,
                    icon_title: "Laugh to tears  and even more",
                    icon_desc: "Laughing the lifespan increases in several times and even more.",
                }

                ,
                {
                    icon: `${lp.app.options.assets_url}/ico/507.png`,
                    icon_title: "Free candy for everybody",
                    icon_desc: "Each visitor will be personally handed a candy on a stick."
                }

            ],
            form_bottom_text: "We don't provide Israeli intelligence with your personal information",
            form: {...FormOrder.tpl_default(), button: {color: 'purple', label: "Order a seance"}},
        } : {
            show_form_bottom_text: true,
            show_title_2: true,
            background_color: '#313138',
            title_1: "Только смешные и весёлые представления",
            title_2: "Мы работаем только с профессионалами премиум класса",
            form_title: "ЗАКАЖИТЕ БЕСПЛАТНЫЙ СЕАНС",
            items: [
                {
                    icon: `${lp.app.options.assets_url}/ico/537.png`,
                    icon_title: "Инъекции заразительного смеха",
                    icon_desc: "Протестированы завхозом цирка и разрешены в ряде стран мира, даже на Ямайке."
                },
                {
                    icon: `${lp.app.options.assets_url}/ico/464.png`,
                    icon_title: "Рассмешим до слез и даже больше",
                    icon_desc: "Продолжительность жизни увеличивается от смеха в несколько раз и даже больше."
                },
                {
                    icon: `${lp.app.options.assets_url}/ico/507.png`,
                    icon_title: "Бесплатный леденец каждому",
                    icon_desc: "Каждому пришедшему персонально будет вручена сосательная конфета на палочке."
                },

            ],
            form_bottom_text: "Мы не передаем Вашу персональную информацию израильской разведке",
            form: {...FormOrder.tpl_default(), button: {color: 'purple', label: "Заказать сеанс"}},
        }
    }

     tpl_6(val) {
        return html`
         <div class="container-fluid order order_6" style="background-image: url('${base_url}/${val.background}')">
                <div class="dark">
                    <div class="container">
                        <div class="row main_wrap ${val.form_align ? `align_${val.form_align}` : "align_right"}">
                            <div class="col-8">
                                <div class="title"> 
                                    <${Text} name="title_1" options=${Text.plain_text}/>
                                </div>
                                ${val.show_title_2 && html`
                                    <div class="title_2">
                                        <${Text} name="title_2" options=${Text.plain_text}/> 
                                    </div>
                                `}
                                ${val.show_title_3 && html`
                                    <div class="title_3"> 
                                        <${Text} name="title_3" options=${Text.plain_text}/> 
                                    </div>
                                `}
                                <div class="form">
                                    <div class="form_title"> 
                                        <${Text} name="form_title" options=${Text.plain_text}/> 
                                    </div>
                                    <div class="form_data">
                                        <${FormOrder} name="form"/>
                                    </div>
                                    ${val.show_form_bottom_text && html`
                                        <div class="form_bottom">
                                            <${Text} name="form_bottom_text" options=${Text.plain_text}/> 
                                        </div>
                                    `}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_6() {
        return window.locale_lang == 'en' ? {
            show_title_2: true,
            show_title_3: true,
            show_form_bottom_text: true,
            form_align: "right",
            background: `${lp.app.options.assets_url}/background/187.jpg`,
            title_1: "USE THIS DESIGNER",
            title_2: "CREATE LANDING",
            title_3: "JUST A FEW MINUTES",
            form_title: "LEAVE AN APPLICATION FOR LANDING CREATION",
            form_bottom_text: "We don't provide Israeli intelligence with your personal information",
            form: {...FormOrder.tpl_default(), button: {color: 'blue', label: "Order a landing"}}
        } : {
            show_title_2: true,
            show_title_3: true,
            show_form_bottom_text: true,
            form_align: "right",
            background: `${lp.app.options.assets_url}/background/187.jpg`,
            title_1: "ИСПОЛЬЗУЙТЕ ЭТОТ КОНСТРУКТОР",
            title_2: "СОЗДАЙТЕ ЛЕНДИНГ",
            title_3: "ВСЕГО ЗА НЕСКОЛЬКО МИНУТ",
            form_title: "ОСТАВЬТЕ ЗАЯВКУ НА СОЗДАНИЕ ЛЕНДИНГА",
            form_bottom_text: "Мы не передаем Вашу персональную информацию израильской разведке",
            form: {...FormOrder.tpl_default(), button: {color: 'blue', label: "Заказать лендинг"}}
        }
    }
}
 
Block.register('Order',exports = Order);