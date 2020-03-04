const Block = require("./internal/block");
const Repeater = require("./internal/repeater");
const Text = require("./internal/text");
const Icon = require("./internal/icon");

class Benefits extends Block {

    static title = _t('Benefits')
    static description = _t('Main advantages')

    configForm = {
        items: [            
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px",
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px",
            },
            { 
                name: "show_icon_border", label: _t("Show icon around"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1] }
            },
            { 
                name: "show_name_benefit", label: _t("Show name benefit"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,3,5] }
            },
            { 
                name: "show_desc_benefit", label: _t("Show description benefit"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [1,2,5] }
            },
            { 
                name: "show_image_border", label: _t("Show image around"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px", showWhen: { variant: [4,5] }
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background_color"  
            }
        ]
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
        return window.locale_lang=='en' ? {
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
                    'icon_1': `${Component.app.options.assets_url}/ico/740.png`,
                    'icon_2': `${Component.app.options.assets_url}/ico/274.png`,
                    'icon_3': `${Component.app.options.assets_url}/ico/218.png`,
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
                    'icon_1': `${Component.app.options.assets_url}/ico/740.png`,
                    'icon_2': `${Component.app.options.assets_url}/ico/274.png`,
                    'icon_3': `${Component.app.options.assets_url}/ico/218.png`,
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
        return window.locale_lang=='en' ? {
            'show_title': true,
            'show_title_2': false,
            'show_name_benefit': true,
            'show_desc_benefit': true,
            'background_color':'#FFFFFF',
            'title': "The advantages of our circus",
            'title_2': "Subtitle",
            'items': [
                {
                    'icon_1': `${Component.app.options.assets_url}/ico/729.png`,
                    'icon_2': `${Component.app.options.assets_url}/ico/308.png`,
                    'icon_3': `${Component.app.options.assets_url}/ico/341.png`,
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
                    'icon_1': `${Component.app.options.assets_url}/ico/729.png`,
                    'icon_2': `${Component.app.options.assets_url}/ico/308.png`,
                    'icon_3': `${Component.app.options.assets_url}/ico/341.png`,
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
}

Block.register(exports = Benefits);