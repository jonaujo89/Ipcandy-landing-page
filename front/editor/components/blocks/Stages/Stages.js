require("./Stages.tea");

const {Block,Text,Icon,BlockColor,Switch,Dialog} = require("../../internal"); 

class Stages extends Block {

    static get title() { return _t('Stages') }
    static get description() { return _t('Work order') }

    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" showWhen=${{variant:[1,2]}} /> 
                <${Switch} name="show_title_2" label="${_t("Show second title")}" showWhen=${{variant:[1,2]}} /> 
                <${Switch} name="show_name" label="${_t("Show name step")}" showWhen=${{variant:[1]}} /> 
                <${Switch} name="show_desc" label="${_t("Show description step")}" showWhen=${{variant:[1]}} />
                <label>${_t("Background color:")}</label>
                <${BlockColor} name="background_color" />
            <//>
        `;
    }
    
    tpl_1(val) { 
        return html`
            <div class='container-fluid stages stages_1' style='background: ${val.background_color}'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-12'>
                            ${val.show_title && html` 
                                <h1 class='title'> 
                                    <${Text} name='title' options=${Text.plain_text}/>
                                </h1>
                            `}
                            ${val.show_title_2 && html` 
                                <div class='title_2'> 
                                    <${Text} name='title_2' options=${Text.plain_text}/>
                                </div>
                            `}
                            <div class='item_list clear'>
                                <div class='row'> 
                                    ${[1,2,3,4].map(i => {
                                        return html`
                                        <div class='item col-3'>
                                            <div class='arrow'></div>
                                            <${Icon} name="icon_${i}"/>
                                            ${val.show_name && html`
                                                <div class='name'> 
                                                    <${Text} name="name_${i}" options=${Text.plain_text}/>
                                                </div>
                                            `}
                                            ${val.show_desc && html`
                                                <div class='desc'> 
                                                    <${Text} name="desc_${i}" options=${Text.plain_text}/>
                                                </div>
                                            `}
                                        </div>
                                    `})}
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
            show_title: true,
            show_title_2: false,
            show_name: true,
            show_desc: true,
            background_color: '#FFFFFF',
            title: 'The procedure for obtaining a positive charge of vivacity',
            title_2: 'Subtitle', 
            icon_1: `${lp.app.options.assets_url}/ico/822.png`,
            icon_2: `${lp.app.options.assets_url}/ico/175.png`,
            icon_3: `${lp.app.options.assets_url}/ico/778.png`,
            icon_4: `${lp.app.options.assets_url}/ico/345.png`,
            name_1: 'Ticket', 
            name_2: 'The arrival in the circus',
            name_3: 'Program viewing',
            name_4: 'Positive impression',
            desc_1: 'Day-and-night service orders. Book tickets by phone. Delivery pigeons.',  
            desc_2: 'The hall is equipped with comfortable sofas, which ensures strong and sweet dream for each visitor.',  
            desc_3: 'Our circus clown makes plenty of laugh and take part in the show, feeling yourself in the shoes of the clown.',  
            desc_4: 'Each seat in the audience is patched a high-voltage cable. You will definitely get positive impressions.' 
        } : {
            show_title: true,
            show_title_2: false,
            show_name: true,
            show_desc: true,
            background_color: '#FFFFFF',
            title: 'Порядок получения позитивного заряда бодрости',
            title_2: 'Подзаголовок', 
            icon_1: `${lp.app.options.assets_url}/ico/822.png`,
            icon_2: `${lp.app.options.assets_url}/ico/175.png`,
            icon_3: `${lp.app.options.assets_url}/ico/778.png`,
            icon_4: `${lp.app.options.assets_url}/ico/345.png`,
            name_1: 'Заказ билета',
            name_2: 'Приход в цирк',
            name_3: 'Просмотр программы',
            name_4: 'Позитивный заряд',
            desc_1: 'Круглосуточно работающая служба заказов. Закажите билет по телефону. Доставка почтовыми голубями.',   
            desc_2: 'Зал оборудован комфортными диванами, что обеспечивает крепкий и сладкий сон каждому посетителю.',  
            desc_3: 'Наша цирковая клоунада заставляет вдоволь насмеяться и принять участие в шоу, ощутив себя в шкуре клоуна.',  
            desc_4: 'К каждому креслу в зале подведён высоковольтный кабель. Получение заряда бодрости Вам обеспечено.',  
        }
    }

    tpl_2(val) {
        return html`
            <div class='container-fluid stages stages_2' style='background: ${val.background_color}'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-12'>
                            ${val.show_title && html` 
                                <h1 class='title'> 
                                    <${Text} name='title' options=${Text.plain_text}/>
                                </h1>
                            `}  
                            ${val.show_title_2 && html` 
                                <div class='title_2'> 
                                    <${Text} name='title_2' options=${Text.plain_text}/>
                                </div>
                            `}
                            <div class='item_list row'>
                                ${[1,2,3,4,5].map(i => {
                                    return html`
                                        <div class='item col-2'>
                                            <div class='line'></div>
                                            <div class='number'></div>
                                            <div class='name'>
                                                <${Text} name="name_${i}" options=${Text.default_text}/>
                                            </div>
                                        </div>
                                    ` 
                                })}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_2() {
        return window.locale_lang == 'en' ? {
            show_title: true,
            show_title_2: false,
            show_name: true,
            show_desc:  true,
            background_color: '#FFFFFF',
            title: '5 steps towards a good mood',
            title_2: 'Subtitle', 
            name_1: 'Selection of data',
            name_2: 'Ticket booking',
            name_3: 'Cost calculation',
            name_4: 'Program viewing',
            name_5: 'Euphoria',
           
        } : {
            show_title: true,
            show_title_2: false,
            show_name: true,
            show_desc: true,
            background_color: '#FFFFFF',
            title: 'Пять шагов к отличному настроению',
            title_2: 'Подзаголовок', 
            name_1: 'Выбор даты',
            name_2: 'Заказа билета',
            name_3: 'Расчет стоимости',
            name_4: 'Просмотр программы',
            name_5: 'Вам супер классно',
             
        } 
    }

  }

  Block.register('Stages',exports = Stages);