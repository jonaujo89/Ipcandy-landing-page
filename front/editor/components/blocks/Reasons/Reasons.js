require("./Reasons.tea");

const {Block,Repeater,Text,Icon,BlockColor,Switch,Dialog} = require("../../internal");  

class Reasons extends Block {

    static get title() { return _t('Reasons') }
    static get description() { return _t('Otherness') } 
    
    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" showWhen=${{variant:[1]}} /> 
                <${Switch} name="show_title_2" label="${_t("Show second title")}" showWhen=${{variant:[1]}} />
                <label>${_t("Background color:")}</label>
                <${BlockColor} name="background_color" />
            <//>
        `;
    }

    tpl_1(val) {
        return html`
            <div class="container-fluid reasons reasons_1" style="background: ${val.background_color}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            ${val.show_title && html`
                                <h1 class="title"> 
                                    <${Text} name="title" options=${Text.plain_text} />
                                </h1>
                            `}
                            ${val.show_title_2 && html`
                                <div class="title_2">
                                    <${Text} name="title_2" options=${Text.plain_text} />
                                </div>
                            `}
                            <div class="item_list clear">
                                <${Repeater} name="items">
                                    ${item => html`   
                                        <div class="row">
                                            ${[1, 2].map( (i) => {
                                                return html` 
                                                    <div class="col-6 item">
                                                        <div class="ico_wrap">
                                                            <${Icon} name="icon_${i}"/>
                                                        </div>                    
                                                        <div class="name">
                                                            <${Text} name="name_${i}" options=${Text.plain_heading} />
                                                        </div>
                                                        <div class="desc">
                                                            <${Text} name="desc_${i}" options=${Text.default_text} />
                                                        </div>
                                                    </div>
                                                `
                                            })}
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

    tpl_default_1(val) {
        return window.locale_lang == 'en' ? {
            show_title: true,
            show_title_2: true,
            background_color: '#FFFFFF',
            title: "We have more than 5 000 visitors each month",
            title_2: "6 reasons",
            items: [
                {
                    icon_1: `${App.assets_url}/ico/799.png`,
                    icon_2: `${App.assets_url}/ico/806.png`,
                    name_1: "Funny clowns",
                    name_2: "Comfortable viewing",
                    desc_1: "Our circus clown makes you plenty of laugh and take part in the show, and feel like a real artist.",
                    desc_2: "The hall is equipped with soft, comfortable seats that provide comfortable viewing from anywhere in the show hall.",
                },
                {
                    icon_1: `${App.assets_url}/ico/341.png`,
                    icon_2: `${App.assets_url}/ico/359.png`,
                    name_1: "Acrobatics",
                    name_2: "A lively dance",
                    desc_1: "Dizzying stunts, jumps and movements on the verge, as well as freewheeling.",
                    desc_2: "Our show-ballet bedazzles by vivid colours and suits , which encourage us not to sit but to dance!",
                },
                {
                    icon_1: `${App.assets_url}/ico/342.png`,
                    icon_2: `${App.assets_url}/ico/252.png`,
                    name_1: "Starry acrobatics",
                    name_2: "Magic tricks",
                    desc_1: "The best directors, choreographers, geographers, physicists and biologists of our country worked at our show.",
                    desc_2: "David Kopperfildman will perform a pass with the disappearance of your purse and jewelry that could not be forgotten.",
                },
            ]
        } : {
            show_title: true,
            show_title_2: true,
            background_color: '#FFFFFF',
            title: "Зачем к нам приходят более 5 000 зрителей каждый месяц",
            title_2: "шесть причин",
            items: [
                {
                    icon_1: `${App.assets_url}/ico/799.png`,
                    icon_2: `${App.assets_url}/ico/806.png`,
                    name_1: "Весёлые клоуны",
                    name_2: "Комфортный просмотр",
                    desc_1: "Наша цирковая клоунада заставляет вдоволь насмеяться и принять участие в шоу, ощутив себя настоящим артистом.",
                    desc_2: "Зал оборудован мягкими, комфортными сиденьями, что обеспечивает удобный просмотр шоу с любой точки зала.",
                },
                {
                    icon_1: `${App.assets_url}/ico/341.png`,
                    icon_2: `${App.assets_url}/ico/359.png`,
                    name_1: "Акробатические номера",
                    name_2: "Зажигательные танцы",
                    desc_1: "Головокружительные трюки, ловкие прыжки и движения на грани, а также свободное падение без страховки.",
                    desc_2: "Яркими красками и костюмами впечатляет наш шоу-балет, вместе в которым сложно усидеть на месте от желания танцевать!",
                },
                {
                    icon_1: `${App.assets_url}/ico/342.png`,
                    icon_2: `${App.assets_url}/ico/252.png`,
                    name_1: "Звездные номера",
                    name_2: "Волшебные фокусы",
                    desc_1: "Над шоу-программой работали лучшие режиссеры, хореографы, географы, физики и биологи нашей страны.",
                    desc_2: "Давид Копперфильдман покажет фокус с исчезновением Вашего кошелька и ювелирных украшений который невозможно забыть.",
                },
            ]
        } 
    }
}

Block.register('Reasons',exports = Reasons);