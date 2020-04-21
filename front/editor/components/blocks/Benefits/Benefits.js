require("./Benefits.tea");

const {Block,Repeater,Text,Image,Icon,BlockColor,Switch,Dialog} = require("../../internal");

class Benefits extends Block {

    static get title() { return _t('Benefits') }
    static get description() { return _t('Main advantages') }

    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" />
                <${Switch} name="show_title_2" label="${_t("Show second title")}" />
                <${Switch} name="show_icon_border" label="${_t("Show icon border")}" showWhen=${{variant:[1]}} />
                <${Switch} name="show_name_benefit" label="${_t("Show benefit name")}" showWhen=${{variant:[1,2,3,5]}} />
                <${Switch} name="show_desc_benefit" label="${_t("Show benefit desc")}" showWhen=${{variant:[1,2,5]}} />
                <${Switch} name="show_image_border" label="${_t("Show image border")}" showWhen=${{variant:[4,5]}} />
                <${BlockColor} name="background_color" />
            <//>
        `;
    }

    tpl_1(val) {
        return html`
        <div class="container-fluid benefits benefits_1" style="background: ${val.background_color}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_text} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_text} />
                            </div>
                        `}
                        <div class="item_list ${val.show_icon_border ? "" : "hide_ico_border"}">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">                       
                                    ${ [1,2,3].map((i) => html`
                                        <div class="item col-4">
                                            <${Icon} name=${'icon_'+i} />
                                            ${ val.show_name_benefit && html`
                                                <div class="name">
                                                    <${Text} name=${'name_'+i} options=${Text.plain_text} />
                                                </div>
                                            `}
                                            ${ val.show_desc_benefit && html`
                                                <div class="desc">
                                                    <${Text} name=${'desc_'+i} options=${Text.plain_text} />
                                                </div>
                                            `}
                                        </div>                                    
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_1() {
        return config.language=='en' ? {
            'show_title': true,
            'show_title_2': false,
            'show_icon_border': true,
            'show_name_benefit': true,
            'show_desc_benefit': true,
            'background_color': '#FFFFFF',
            'title': "Our circus is the coolest in the world!",
            'title_2': "Subtitle",
            'items': [
                {
                    'icon_1': `${config.assets_url}/ico/740.png`,
                    'icon_2': `${config.assets_url}/ico/274.png`,
                    'icon_3': `${config.assets_url}/ico/218.png`,
                    'name_1': "You can go on foot",
                    'name_2': "It increases the degree of mood",
                    'name_3': "It inspires by selective positive ",
                    'desc_1': "It's too simple. Come and fill the place.",
                    'desc_2': "Only in our lunchroom you have intimate conversations over a beer.",
                    'desc_3': "You get an excellent mood for the longest time.",
                }
            ]
         } : {
            'show_title': true,
            'show_title_2': false,
            'show_icon_border': true,
            'show_name_benefit': true,
            'show_desc_benefit': true,
            'background_color': '#FFFFFF',
            'title': "Наш цирк самый крутой в мире!",
            'title_2': "Подзаголовок о крутизне цирка",
            'items': [
                {
                    'icon_1': `${config.assets_url}/ico/740.png`,
                    'icon_2': `${config.assets_url}/ico/274.png`,
                    'icon_3': `${config.assets_url}/ico/218.png`,
                    'name_1': "В него можно придти пешком",
                    'name_2': "Повышает градус настроения",
                    'name_3': "Заряжает отборным позитивом",
                    'desc_1': "Все просто до безобразия. Приходите и занимаете места по купленным билетам.",
                    'desc_2': "Только в нашем буфете проходят задушевные беседы за кружечкой пенистого.",
                    'desc_3': "Вы получите заряд превосходного настроения на самое длительное время.",
                }
            ]
        };
    }

    tpl_2(val) {
        return html`
        <div class="container-fluid benefits benefits_2" style="background: ${val.background_color}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_text} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title" options=${Text.plain_text} />
                            </div>
                        `}                        
                        <div class="item_list">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">
                                    ${ [1,2,3].map((i) => html`
                                        <div class="item col-4">
                                            <${Icon} name=${'icon_'+i} />
                                            ${ val.show_name_benefit && html`
                                                <div class="name">
                                                    <${Text} name=${'name_'+i} options=${Text.plain_text} />
                                                </div>
                                            `}
                                            ${ val.show_desc_benefit && html`
                                                <div class="desc">
                                                    <${Text} name=${'desc_'+i} options=${Text.plain_text} />
                                                </div>
                                            `}
                                        </div>   
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_2() {
        return config.language=='en' ? {
            'show_title': true,
            'show_title_2': false,
            'show_name_benefit': true,
            'show_desc_benefit': true,
            'background_color':'#FFFFFF',
            'title': "The advantages of our circus",
            'title_2': "Subtitle",
            'items': [
                {
                    'icon_1': `${config.assets_url}/ico/729.png`,
                    'icon_2': `${config.assets_url}/ico/308.png`,
                    'icon_3': `${config.assets_url}/ico/341.png`,
                    'name_1':  "Free Internet",
                    'name_2': "Delicious ice cream",
                    'name_3': "Starry cast",
                    'desc_1': "Wireless Internet access. You can always change the status in the social network.",
                    'desc_2': "White cornet. Very sticky and sweet.",
                    'desc_3': "We have such celebrities as Valentine and Valera.",
                }
            ]
         } : {
            'show_title': true,
            'show_title_2': false,
            'show_name_benefit': true,
            'show_desc_benefit': true,
            'background_color':'#FFFFFF',
            'title': "Преимущества нашего цирка",
            'title_2': "Подзаголовок о преимуществе",
            'items': [
                {
                    'icon_1': `${config.assets_url}/ico/729.png`,
                    'icon_2': `${config.assets_url}/ico/308.png`,
                    'icon_3': `${config.assets_url}/ico/341.png`,
                    'name_1': "Бесплатный интернет",
                    'name_2': "Вкусное мороженное",
                    'name_3': "Звездный состав",
                    'desc_1': "Беспроводной доступ в интернет. Вы всегда сможете поменять статус в соцсети.",
                    'desc_2': "Белое мороженное в вафельном стаканчике. Очень липкое и сладкое.",
                    'desc_3': "Только у нас выступают такие знаменитости как Валентин и Валера.",
                }
            ]
        };
    }

    tpl_3(val) {
        return html`
        <div class="container-fluid benefits benefits_3" style="background: ${val.background_color}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_text} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title" options=${Text.plain_text} />
                            </div>
                        `}                        
                        <div class="item_list ${val.show_name_benefit ? "" : "hide_name"}">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">
                                    ${ [1,2].map((i) => html`
                                        <div class="item col-6">                                
                                            <${Icon} name=${'icon_'+i} />
                                            ${ val.show_name_benefit && html`
                                                <div class="name">
                                                    <${Text} name=${'name_'+i} options=${Text.plain_heading} />
                                                </div>
                                            `}
                                            <div class="desc">
                                                <${Text} name=${'desc_'+i} options=${Text.plain_text} />
                                            </div>
                                        </div>
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_3() {
        return config.language=='en' ? {
            'show_title': true,
            'show_title_2': false,
            'show_icon_arounds': true,
            'show_name_benefit': true,
            'background_color':'#F7F7F7',
            'title': "The advantages of our circus",
            'title_2': "Subtitle",
            'items': [
                {
                    'icon_1': `${config.assets_url}/ico/3.png`,
                    'name_1': "Color TV",
                    'desc_1': "We have a color TV RUBIN-2M in the lobby.",
                    'icon_2': `${config.assets_url}/ico/790.png`,
                    'name_2': "Cozy circus tent",
                    'desc_2': "Our tent will protect you from snow and wind during a spectacular view.",
                },
                {
                    'icon_1': `${config.assets_url}/ico/231.png`,
                    'name_1': "Discount system",
                    'desc_1': "Buy a ticket to the circus for six months and you can live here free of charge for another three months.",
                    'icon_2': `${config.assets_url}/ico/150.png`,
                    'name_2': "Barbecue at the entrance gate",
                    'desc_2': "Uncle Izzy cooks barbecue for visitors and aunt Sarah accompanies him.",
                }
            ]
        } : {
            'show_title': true,
            'show_title_2': false,
            'show_icon_arounds': true,
            'show_name_benefit': true,
            'background_color':'#F7F7F7',
            'title': "Преимущества нашего цирка",
            'title_2': "Подзаголовок о преимуществах",
            'items': [
                {
                    'icon_1': `${config.assets_url}/ico/3.png`,
                    'name_1': "Цветной телевизор",
                    'desc_1': "Только в нашем цирке есть практически цветной телевизор РУБИН-2М в холле.",
                    'icon_2': `${config.assets_url}/ico/790.png`,
                    'name_2': "Уютный цирковой шатёр",
                    'desc_2': "Наш шатер защитит Вас от снега и ветра во время захватывающего представления.",
                },
                {
                    'icon_1': `${config.assets_url}/ico/231.png`,
                    'name_1': "Система скидок",
                    'desc_1': "Купи абонемент в цирк на полгода и можешь оставаться жить ещё три месяца бесплатно.",
                    'icon_2': `${config.assets_url}/ico/150.png`,
                    'name_2': "Шашлычная у входа",
                    'desc_2': "Дядя Изя готовит шашлык для посетителей цирка. Аккомпанирует ему тетя Сара.",
                }
            ]
        };
    }

    tpl_4(val) {
        return html`
        <div class="container-fluid benefits benefits_4" style="background: ${val.background_color}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_text} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title" options=${Text.plain_text} />
                            </div>
                        `}                        
                        <div class="item_list ${val.show_image_border ? "" : "hide_border"}">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">
                                    ${ [1,2].map((i) => html`
                                        <div class="item col-6">
                                            <div class="image_wrap">
                                                <${Image} name=${'image_'+i} />                                     
                                            </div>
                                            <div class="item_info">
                                                <div class="name">
                                                    <${Text} name=${'name_'+i} options=${Text.plain_text} />
                                                </div>
                                                <div class="desc">
                                                    <${Text} name=${'desc_'+i} options=${Text.plain_text} />
                                                </div>
                                            </div>
                                        </div>
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_4() {
        return config.language=='en' ? {
            'show_title': true,
            'show_title_2': false,
            'show_image_border': true,
            'background_color':'#FFFFFF',
            'title': "The advantages of our circus",
            'title_2': "Subtitle",
            'items': [
                {
                    'image_1': `${config.assets_url}/benefits/1.jpg`,
                    'image_2': `${config.assets_url}/benefits/2.jpg`,
                    'name_1': "Serious approach",
                    'name_2': "Attention to detail",
                    'desc_1': "The seriousness of our approach could not be underestimated. We have the most serious circus. And we are serious!",
                    'desc_2': "Only attention to details, such as the color of the door handles and the shape of the chair, makes us better.",
                }
            ]
        } : {
            'show_title': true,
            'show_title_2': false,
            'show_image_border': true,
            'background_color':'#FFFFFF',
            'title': "Преимущества нашего цирка",
            'title_2': "Подзаголовок о преимуществах",
            'items': [
                {
                    'image_1': `${config.assets_url}/benefits/1.jpg`,
                    'image_2': `${config.assets_url}/benefits/2.jpg`,
                    'name_1': "Серьёзный подход",
                    'name_2': "Внимание к деталям",
                    'desc_1': "Серьёзность нашего подхода нельзя недооценивать. Мы самый серьёзный цирк. И это мы серьезно!",
                    'desc_2': "Только внимание к таким деталям как цвет ручки входной двери и форма стула билетёра делают нас лучшими.",
                }
            ]
        };
    }

    tpl_5(val) {
        return html`
        <div class="container-fluid benefits benefits_5" style="background: ${val.background_color}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_text} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title" options=${Text.plain_text} />
                            </div>
                        `}                        
                        <div class="item_list ${val.show_image_border ? "" : "hide_border"}">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">
                                    ${ [1,2,3].map((i) => html`
                                        <div class="item col-4">
                                            <${Image} name=${'image_'+i} />
                                            ${ val.show_name_benefit && html`
                                                <div class="name">
                                                    <${Text} name=${'name_'+i} options=${Text.plain_text} />
                                                </div>
                                            `}
                                            ${ val.show_desc_benefit && html`
                                                <div class="desc">
                                                    <${Text} name=${'desc_'+i} options=${Text.plain_text} />
                                                </div>
                                            `}
                                        </div>
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_5() {
        return config.language=='en' ? {
            'show_title': true,
            'show_title_2': false,
            'show_name_benefit': true,
            'show_desc_benefit': true,
            'show_image_border': true,
            'background_color':'#FFFFFF',
            'title': "The advantages of our circus",
            'title_2': "Subtitle",
            'items': [
                {
                    'image_1': `${config.assets_url}/benefits/3.jpg`,
                    'image_2': `${config.assets_url}/benefits/4.jpg`,
                    'image_3': `${config.assets_url}/benefits/5.jpg`,
                    'name_1': "Simplicity of passage",
                    'name_2': "Seats",
                    'name_3': "Support for a laugh",
                    'desc_1': "The unique design of the circus will not let you get lost. Entry and exit are here in the one place.",
                    'desc_2': "All seats are numbered. There will not any troubles with your place.",
                    'desc_3': "Smiling dog is always here! He is always ready to lick you to death.",
                }
            ]
        } : {
            'show_title': true,
            'show_title_2': false,
            'show_name_benefit': true,
            'show_desc_benefit': true,
            'show_image_border': true,
            'background_color':'#FFFFFF',
            'title': "Преимущества нашего цирка",
            'title_2': "Подзаголовок о преимуществах",
            'items': [
                {
                    'image_1': `${config.assets_url}/benefits/3.jpg`,
                    'image_2': `${config.assets_url}/benefits/4.jpg`,
                    'image_3': `${config.assets_url}/benefits/5.jpg`,
                    'name_1': "Простота прохода",
                    'name_2': "Места по номерам",
                    'name_3': "Поддержка смехом",
                    'desc_1': "Уникальная конструкция цирка не даст Вам заблудиться. Вход и выход у нас в одном месте.",
                    'desc_2': "Все места пронумерованы черным маркером. Проблем с поиском своего места не будет.",
                    'desc_3': "В зале всегда находится дежурный пёс-смехун, который всегда готов зализать Вас до смерти.",
                }
            ]
        };
    }
}

Block.register('Benefits',exports = Benefits);
