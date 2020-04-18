require("./Services.tea");

const {Block,Repeater,Text,Image,FormButton,Icon,BlockColor,Switch,Dialog,Radio} = require("../../internal"); 

class Services extends Block {
 
    static get title() { return _t('Services') }
    static get description() { return _t('List of services') }

    configForm() {
        var val = this.value;
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" /> 
                <${Switch} name="show_title_2" label="${_t("Show second title")}" /> 
                <${Switch} name="show_image" label="${_t("Show image")}" showWhen=${{variant:[1,4,5]}} /> 
                <${Switch} name="show_name" label="${_t("Show name")}" showWhen=${{variant:[]}}  /> 
                <${Switch} name="show_desc" label="${_t("Show description")}" showWhen=${{variant:[1,2,3,4,5]}} />  
                <${Switch} name="show_price" label="${_t("Show price")}" showWhen=${{variant:[1,2,3,4,5]}} /> 
                <${Switch} name="show_text_above_button" label="${_t("Show text above order button")}" showWhen=${{variant:[3]}} /> 
                <${Switch} name="show_order_button" label="${_t("Show order button")}" showWhen=${{variant:[1,2,3,4,5]}} /> 
                <${Switch} name="show_image_shadow" label="${_t("Show image shadow")}" showWhen=${{variant:[2]}} />
                <${Switch} name="show_image_shadow" label="${_t("Show shadow under image")}" showWhen=${{variant:[3]}} />
                ${val.variant == 3 && html`<label>${_t("Image size:")}</label>`}
                <${Radio} name="image_size" inline=${false} items=${[
                    {label: _t("middle"), value:"middle"},
                    {label: _t("large"), value:"large"},
                ]} showWhen=${{variant:[3]}} />
                ${(val.variant == 2 || val.variant == 5) && html`<label>${_t("Image shape:")}</label>`}
                <${Radio} name="image_shape" inline=${false} items=${[
                    { label: _t("circle"), value:"circle"},
                    { label: _t("square"), value:"square"},
                ]} showWhen=${{variant:[2,5]}} />
                <label>${_t("Background color:")}</label>
                <${BlockColor} name="background" />
            <//>
        `;
    } 

     tpl_1(val) {
        return html`
        <div class="container-fluid services services_1" style="background: ${val.background};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${val.show_title && html`
                        <h1 class="title"> 
                            <${Text} name="title" options=${Text.plain_text}/>
                        </h1>
                        `}
                        ${val.show_title_2 && html`
                            <div class="title_2"> 
                                <${Text} name="title_2" options=${Text.plain_text} />
                            </div>
                        `}
                        <div class="item_list clear"> 
                            <${Repeater} name="items">${item => html`
                                <div class="item_datas row">
                                    ${[1, 2, 3].map(i => {
                                        return html`
                                            <div class="col-4"> 
                                                <div class="item">
                                                    <div class="item_data">
                                                        ${val.show_image && html`
                                                            <div class="img_wrap" >
                                                                <${Image} name="image_${i}"/>
                                                            </div>
                                                        `}
                                                        <div class="name">
                                                            <${Text} name="name_${i}" options=${Text.plain_heading}/>
                                                        </div>
                                                        ${val.show_desc && html`
                                                            <div class="desc">
                                                                <${Text} name="desc_${i}" options=${Text.default_text}/> 
                                                            </div>
                                                        `}
                                                    </div>
                                                    <div class="item_action">
                                                        ${val.show_price && html`
                                                            <div class="price" >
                                                                <${Text} name="price_${i}" options=${Text.color_heading}/> 
                                                            </div>
                                                        `}

                                                        ${val.show_order_button && html`
                                                            <div class="btn_wrap">
                                                                <${FormButton} name="@order_button"/>
                                                            </div>
                                                        `}
                                                    </div>
                                                </div>
                                            </div>
                                        `}
                                    )}
                                </div>
                            `}</>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_1() {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            show_image: true,
            show_desc: true,
            show_price: true,
            show_order_button: true,
            background: '#F7F7F7',
            title: "The program for corporate events",
            title_2: "We have a plenty of choices",
            items: [
                {
                    image_1: `${config.assets_url}/services/1.jpg`,
                    image_2: `${config.assets_url}/services/2.jpg`,
                    image_3: `${config.assets_url}/services/3.jpg`,
                    name_1: "Smiling dog",
                    name_2: "Flying gymnast",
                    name_3: "Clam cats",
                    desc_1: "Ordering this program you'll enjoy the smiling dog the whole party.",
                    desc_2: "The program includes a dizzying stunts, jumps and movements at the brink.",
                    desc_3: "During this program you will be able to enjoy the silence. The chorus does not say a single sound.",
                    price_1: "3 000 $",
                    price_2: "5 000 $",
                    price_3: "7 000 $",
                },
            ],
            order_button: {...FormButton.tpl_default(), text: 'Order', color: 'blue'},
        } : {
            show_title: true,
            show_title_2: true,
            show_image: true,
            show_desc: true,
            show_price: true,
            show_order_button: true,
            background: '#F7F7F7',
            title: "Программа для корпоративов",
            title_2: "У нас супер выбор",
            items: [
                {
                    image_1: `${config.assets_url}/services/1.jpg`,
                    image_2: `${config.assets_url}/services/2.jpg`,
                    image_3: `${config.assets_url}/services/3.jpg`,
                    name_1: "Собака-улыбака",
                    name_2: "Летающий гимнаст",
                    name_3: "Коты-молчуны",
                    desc_1: "Заказав эту программу Вы будете наслаждаться улыбкой друга человека всю вечеринку.",
                    desc_2: "Программа включает в себя головокружительные трюки, прыжки и движения на грани.",
                    desc_3: "За эту программу вы сможете насладиться тишиной. Хор не произносит ни единого звука.",
                    price_1: "3 000 руб.",
                    price_2: "5 000 руб.",
                    price_3: "7 000 руб.",
                },
            ],
            order_button: {...FormButton.tpl_default(), text: 'Заказать', color: 'blue'}
        }
    }

     tpl_2(val) {
        return html`
            <div class="container-fluid services services_2" style="background: ${val.background}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            ${val.show_title && html`
                                <h1 class="title" > 
                                    <${Text} name="title" options=${Text.plain_text}/>
                                </h1>
                            `}
                            ${val.show_title_2 && html`
                                <div class="title_2">
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                            `}
                            <div class="item_list clear ${val.image_shape ? val.image_shape : 'circle'}">
                                <${Repeater} name="items">${item => html`
                                    <div class="row">
                                        ${[1, 2].map( i => {
                                            return html`
                                                <div class="item col-6 ${!val.show_image_shadow && "hide_shadow"}">
                                                    <div class="img_data">
                                                        <${Image} name="image_${i}"/>
                                                    </div>
                                                    <div class="item_data">
                                                        <div class="name">
                                                            <${Text} name="name_${i}" options=${Text.plain_heading}/>
                                                        </div>
                                                        ${val.show_desc && html`
                                                            <div class="desc">
                                                                <${Text} name="desc_${i}" options=${Text.plain_default}/>
                                                            </div>
                                                        `}
                                                        ${val.show_price && html`
                                                            <div class="price">
                                                                <${Text} name="price_${i}" options=${Text.plain_heading}/>
                                                            </div>
                                                        `}
                                                        ${val.show_order_button && html`
                                                            <div class="btn_wrap">
                                                                <${FormButton} name="@order_button"/>
                                                            </div>
                                                        `}
                                                    </div>
                                                </div>
                                            `}
                                        )}
                                    </div> 
                                `}<//>
                            </div>    
                        </div> 
                    </div>
                </div>
            </div>
            
    `}

    tpl_default_2() {
        return config.language == 'en' ? { 
            show_title: true,
            show_title_2: true,
            show_desc: true,
            show_price: true,
            show_order_button: true,
            show_image_shadow: true,
            image_shape: 'circle',
            background: '#FFFFFF',
            title: "Hot deals",
            title_2: "Hire of deers team",
            items: [
                {
                    image_1: `${config.assets_url}/services/4.jpg`,
                    image_2: `${config.assets_url}/services/5.jpg`,
                    name_1: "KITTEH-DEER",
                    name_2: "DOG-DEER",
                    desc_1: "Team of the kitteh-deer will carry you away beyond the horizon from the bad mood.",
                    desc_2: "Dog-deers could break right in the snowy dawn.",
                    price_1: "6 000 $",
                    price_2: "<span style='color: #BBBBBB'><strike>5 000 $</strike></span> 4 000 $",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Order', color: 'blue'}
        } : {
            show_title: true,
            show_title_2: true,
            show_desc: true,
            show_price: true,
            show_order_button: true,
            show_image_shadow: true,
            image_shape: 'circle',
            background: '#FFFFFF',
            title: "Горячее предложение",
            title_2: "Упряжка оленей на прокат",
            items:[
                    {
                        image_1: `${config.assets_url}/services/4.jpg`,
                        image_2: `${config.assets_url}/services/5.jpg`,
                        name_1: "КОТ-ОЛЕНЬ",
                        name_2: "ПЁС-ОЛЕНЬ",
                        desc_1: "Упряжка из котов-оленей унесет Вас за горизонт прочь от плохого настроения.",
                        desc_2: "На собаках-оленях можно отчаянно ворваться прямо в снежную зарю.",
                        price_1: "6 000 руб. ",
                        price_2: "<span style='color: #BBBBBB'><strike>5 000 руб.</strike></span> 4 000 руб.",
                    }
                 ],
            order_button: {...FormButton.tpl_default(), text: 'Заказать', color: 'blue'}

        }
    }

        tpl_3(val) {
        return html`
        <div class="container-fluid services services_3" style="background: ${val.background}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${val.show_title && html`
                            <h1 class="title"> 
                                <${Text} name="title" options=${Text.plain_text}/>
                            </h1>
                        `}
                        ${val.show_title_2 && html`
                            <div class="title_2">
                                 <${Text} name="title_2" options=${Text.plain_text}/>
                            </div>
                        `}   
                        <div class="item_list">
                            <${Repeater} name="items">${item => html`  
                                <div class="item row ${!val.show_image_shadow && "hide_shadow"}">
                                    <div class="img_data col-5 before-1 image_${val.image_size || val.image_middle}">
                                        <${Image} name="image"/>
                                    </div>
                                    <div class="item_data col-6">
                                        <div class="name">
                                            <${Text} name="name" options=${Text.plain_heading}/>
                                        </div> 
                                        ${val.show_desc && html`
                                           <div class="desc"> 
                                                 <${Text} name="desc" options=${Text.default_text}/>
                                           </div>
                                        `}
                                        ${val.show_price && html`
                                           <div class="price" > 
                                                <${Text} name="price" options=${Text.color_heading}/>
                                           </div>
                                        `} 
                                        ${val.show_text_above_button && html`
                                            <div class="btn_note">
                                                 <${Text} name="btn_note" options=${Text.default_heading}/>
                                            </div>
                                        `}
                                        ${val.show_order_button && html`
                                          <div class="btn_wrap" >
                                                <${FormButton} name="@order_button"/>
                                          </div>
                                        `}
                                    </div>
                                </div>
                             `}<//>
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
            show_desc: true,
            show_price: true,
            show_text_above_button: true,
            show_order_button: true,
            show_image_shadow: true,
            image_size: 'middle',
            background: '#FFFFFF',
            title: "Old maid rejuvenation",
            title_2: "Miracle for human eyes",
            items: [
                {
                    image: `${config.assets_url}/services/12.jpg`,
                    name: "CONJURER FEDOR",
                    desc: `Using forbidden magic spell, Sedoborodov Fedor Yakovlevich creats a miracle on your eyes never happened yet. Your  old wife will be transformed into a young maiden.<i>Rejuvenating apples are included.</i>.`,
                    price: "<span style='color: #BBBBBB'><strike>50 000 $</strike></span> 25 000 $",
                    btn_note: "<i>Rejuvenating the old woman that are not older than 30 years</i>",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Rejuvenate', color: 'blue'}
        } : {
            show_title: true,
            show_title_2: true,
            show_desc: true,
            show_price: true,
            show_text_above_button: true,
            show_order_button: true,
            show_image_shadow: true,
            image_size: 'middle',
            background: '#FFFFFF',
            title: "Омоложение старых дев",
            title_2: "Чарующее людской взор чудо",
            items: [
                {
                    image: `${config.assets_url}/services/12.jpg`,
                    name: "ЗАКЛИНАТЕЛЬ ФЁДОР",
                    desc: `Используя запрещённое магическое заклинание, Седобородов Фёдор Яковлевич на Ваших глазах сотворит чудо каких не бывало ещё.
                    Ваша изнеможденная жена-старуха будет превращена в молодую деву. <i>Молодильные яблоки входят в стоимость</i>.`,
                    price: "<span style='color: #BBBBBB'><strike>50 000 руб.</strike></span> 25 000 руб.",
                    btn_note: "<i>Омоложиваются старухи не старше 30 годков</i>",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Омолодить', color: 'blue'}
        }
    }

    tpl_4(val) {  
        return html`
            <div class="container-fluid services services_4" style="background: ${val.background}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            ${val.show_title && html`
                                <h1 class="title">
                                    <${Text} name="title" options=${Text.plain_text}/>
                                </h1>
                            `}
                            ${val.show_title_2 && html` 
                                <div class="title_2" >
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                            `}    
                            <div class="item_list clear">
                                <${Repeater} name="items">${item => html`
                                    <div class="row">
                                        ${[1, 2, 3].map( i => {
                                            return html`
                                                <div class="item col-4">
                                                    ${val.show_image && html`
                                                        <div class="img_wrap"   >
                                                            <${Icon} name="image_${i}"/>
                                                        </div>
                                                    `}                               
                                                    <div class="item_data">
                                                        <div class="name">
                                                            <${Text} name="name_${i}" options=${Text.plain_heading}/>
                                                        </div>
                                                        ${val.show_desc && html`
                                                            <div class="desc"> 
                                                                <${Text} name="desc_${i}" options=${Text.default_text}/>
                                                            </div>
                                                        `}
                                                        ${val.show_price && html`
                                                            <div class="price"> 
                                                                <${Text} name="price_${i}" options=${Text.color_heading}/>
                                                            </div>
                                                        `}
                                                        ${val.show_order_button && html`
                                                            <div class="btn_wrap">
                                                                <${FormButton} name="@order_button"/>
                                                            </div>
                                                        `}
                                                    </div>
                                                </div>
                                            `
                                        })}
                                    </div>
                                `}<//>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_4(val) {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            show_image: true,
            show_desc: true,
            show_price: true,
            show_order_button: true,
            background: '#F7F7F7',
            title: "We are offering",
            title_2: "Parties for the littlest",
            items: [
                {
                    image_1: `${config.assets_url}/ico/772.png`,
                    image_2: `${config.assets_url}/ico/335.png`,
                    image_3: `${config.assets_url}/ico/255.png`,
                    name_1: "FUNNY STRUMMING",
                    name_2: "EATING BISCUITS",
                    name_3: "KARAOKE",
                    desc_1: "Our guitarist Vityusha will teach your child to strum.",
                    desc_2: "Competition 'Eating biscuits' is very exciting, dynamic and cool.",
                    desc_3: "Your children will be able to sing such hits as 'Mamani Combat' and 'Killed Negro'",
                    price_1: "5 000 $",
                    price_2: "10 000 $",
                    price_3: "7 000 $", 
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Order', color: 'blue'}

        } : {
            show_title: true,
            show_title_2: true,
            show_image: true,
            show_desc: true,
            show_price: true,
            show_order_button: true,
            background: '#F7F7F7',
            title: "Что мы предлагаем",
            title_2: "Проведение детских праздников для самых маленьких",
            items: [
                {
                    image_1: `${config.assets_url}/ico/772.png`,
                    image_2: `${config.assets_url}/ico/335.png`,
                    image_3: `${config.assets_url}/ico/255.png`,
                    name_1: "ВЕСЁЛОЕ БРЫНЧАНИЕ",
                    name_2: "ПОЕДАНИЕ ПЕЧЕНЬЯ",
                    name_3: "КАРАОКЕ-БАР",
                    desc_1: "Наш специалист гитарист Витюша научит Вашего ребенка брынчать на весь квартал.",
                    desc_2: "Конкурс поедания печенья очень захватывающий, динамичный и крутой.",
                    desc_3: "Ваши дети смогут спеть такие хиты как 'Маманя Комбат' и 'Убили негра'",
                    price_1: "5 000 руб. ",
                    price_2: "10 000 руб. ",
                    price_3: "7 000 руб. ",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Заказать', color: 'blue'}
        }

    }

     tpl_5(val) {
        return html`
            <div class="container-fluid services services_5" style="background: ${val.background}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            ${val.show_title && html`
                                <h1 class="title">
                                      <${Text} name="title" options=${Text.$plain_text}/>
                                </h1>
                            `}
                            ${val.show_title_2 && html`
                                <div class="title_2"> 
                                    <${Text} name="title_2" options=${Text.$plain_text}/>
                                </div>
                            `}
                            <div class="item_list clear ${val.image_shape || 'circle'}">
                                <${Repeater} name="items">${item => html`
                                    <div class="row">
                                        ${[1, 2, 3].map( i => {
                                            return html`
                                                <div class="item col-4">
                                                    <div class="item_data">
                                                        ${val.show_image && html`
                                                            <div class="img_wrap">
                                                            <${Image} name="image_${i}"/>
                                                            </div>
                                                        `}
                                                        <div class="name"> 
                                                            <${Text} name="name_${i}" options=${Text.plain_heading}/>
                                                        </div>
                                                        ${val.show_desc && html`
                                                            <div class="desc"> 
                                                                <${Text} name="desc_${i}" options=${Text.default_text}/>
                                                            </div>
                                                        `}
                                                        ${val.show_price && html`
                                                            <div class="price"> 
                                                                <${Text} name="price_${i}" options=${Text.color_heading}/>
                                                            </div>
                                                        `}
                                                        ${val.show_order_button && html`
                                                            <div class="btn_wrap">
                                                                <${FormButton} name="@order_button"/>
                                                            </div>
                                                        `}
                                                    </div>
                                                </div>
                                            `
                                        })}
                                    </div>
                                `}<//>              
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_5(val) {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            show_image: true,
            show_desc: true,
            show_price: true,
            image_shape: 'circle',
            show_order_button: true,
            background: '#F7F7F7',
            title: "Top offer",
            title_2: "Circus entertainment program for those who are over 50",
            items: [
                {
                    image_1: `${config.assets_url}/services/6.jpg`,
                    image_2: `${config.assets_url}/services/7.jpg`,
                    image_3: `${config.assets_url}/services/8.jpg`,
                    name_1: "Chess battle",
                    name_2: "Soviet movie",
                    name_3: "Yard gatherings",
                    desc_1: "All expenses we will incur. The horse walks by some consonant of the alphabet.",
                    desc_2: "We offer a wide selection of the Soviet era movies.",
                    desc_3: "On a bench near the entrance the squadron will be created to identify prostitutes.",
                    price_1: "5 000 $",
                    price_2: "5 000 $",
                    price_3: "5 000 $",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Order', color: 'blue'}
        } : {
            show_title: true,
            show_title_2: true,
            show_image: true,
            show_desc: true,
            show_price: true,
            image_shape: 'circle',
            show_order_button: true,
            background: '#F7F7F7',
            title: "Супер предложение",
            title_2: "Увеселительная цирковая программа для тех, кому за 50",
            items: [
                {
                    image_1: `${config.assets_url}/services/6.jpg`,
                    image_2: `${config.assets_url}/services/7.jpg`,
                    image_3: `${config.assets_url}/services/8.jpg`,
                    name_1: "Шахматный бой",
                    name_2: "Советское кино",
                    name_3: "Дворовые посиделки",
                    desc_1: "Все расходы мы берем на себя. Конь ходит любой согласной буквой алфавита.",
                    desc_2: "Мы предоставляем широкий выбор кинофильмов для просмотра эпохи СССР.",
                    desc_3: "На лавочке возле подъезда будет создан отряд по выявлению проституток.",
                    price_1: "5 000 руб.",
                    price_2: "5 000 руб.",
                    price_3: "5 000 руб.",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Заказать', color: 'blue'}
        } 
    }
    
        tpl_6(val) {
        return html`
          <div class="container-fluid services services_6" style="background: ${val.background}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       ${val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_text}/>
                            </h1>
                        `}
                        ${val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_text}/>
                            </div>
                        `} 
                        <div class="item_list"> 
                            <${Repeater} name="items">${item => html`
                                <div class="row">
                                    ${[1, 2, 3].map( i => {
                                        return html`
                                            <div class="item col-4">
                                                <div class="item_data">
                                                    <div class="name">
                                                        <${Text} name="name_${i}" options=${Text.plain_heading}/>
                                                    </div>
                                                    <div class="img_wrap"> 
                                                        <${Image} name="image_${i}"/>
                                                    </div> 
                                                    <div class="price_wrap row">
                                                        <div class="price col-2">
                                                            <${Text} name="price_${i}" options=${Text.color_heading}/>
                                                        </div>
                                                        <div class="btn_wrap col-2">
                                                            <${FormButton} name="@order_button"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `
                                    })}
                                </div>
                            `}<//> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `
    }

    tpl_default_6(val) {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            background: '#F7F7F7',
            title: "Fun and play",
            title_2: "The best games for your corporate party",
            items: [
                {
                    image_1: `${config.assets_url}/services/9.jpg`,
                    image_2: `${config.assets_url}/services/10.jpg`,
                    image_3: `${config.assets_url}/services/11.jpg`,
                    name_1: "Chief is in two",
                    name_2: "Prick for accountant",
                    name_3: "Admin is alongside",
                    price_1: "10 000 $",
                    price_2: "8 000 $",
                    price_3: "6 000 $",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Order', color: 'blue'}
        } : {
            show_title: true,
            show_title_2: true,
            background: '#F7F7F7',
            title: "Весёлые забавы",
            title_2: "Лучшие игры для Вашего корпоратива",
            items: [
                {
                    image_1: `${config.assets_url}/services/9.jpg`,
                    image_2: `${config.assets_url}/services/10.jpg`,
                    image_3: `${config.assets_url}/services/11.jpg`,
                    name_1: "Начальника по полам",
                    name_2: "Укол бухгалтеру",
                    name_3: "Админ у стенки",
                    price_1: "10 000 руб.",
                    price_2: "8 000 руб.",
                    price_3: "6 000 руб.",
                }
            ],
            order_button: {...FormButton.tpl_default(), text: 'Заказать', color: 'blue'}
        }
    }


} 

Block.register('Services',exports = Services);