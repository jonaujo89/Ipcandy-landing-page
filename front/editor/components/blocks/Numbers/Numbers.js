require("./Numbers.tea");

const {Block,Repeater,Text,Icon,Background,BlockColor, Color,Dialog,Radio,Switch,TextureBackground} = require("../../internal"); 

class Numbers extends Block {

    static get title() { return _t('Numbers') }
    static get description() { return _t('Indicators company') }

    configForm() { 
        var val = this.value;
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label=${_t("Show first title")} />
                <${Switch} name="show_title_2" label=${_t("Show second title")} />
                ${val.variant == 4 && html`<label>${ _t("Icons color:")}</label>`} 
                <${Radio} name="icon_color" inline=${false} items=${[
                    {value: 'black', label: _t('black')},
                    {value: 'grey', label: _t('grey')},
                ]} showWhen=${{variant:[4]}} />
                ${val.variant == 7 && html`<label>${ _t("Icons color:")}</label>`} 
                <${Radio} name="icon_color" inline=${false} items=${[
                    {value: 'white', label: _t('white')},
                    {value: 'grey', label: _t('grey')}
                ]} showWhen=${{variant:[7]}} />
                ${val.variant == 8 && html`<label>${ _t("Numbers color:")}</label>`} 
                <${Color} name="numbers_color" items=${[
                    {value: "#000"},
                    {value: "#979797"},
                    {value: "#E6332A"},
                    {value: "#FF3E3E"},
                    {value: "#78CA43"},
                    {value: "#12ABE7"},
                    {value: "#FD6F00"},
                    {value: "#A659E2"},
                    {value: "#E05189"},
                ]} showWhen=${{variant: [8]}} />
                ${[1,2,4,8].includes(val.variant) && html`<label>${ _t("Background:")}</label>`}
                <${BlockColor} name="background_color" showWhen=${{variant: [1,2,4,8]}} /> 
                ${[3,5,6,7].includes(val.variant) && html`<label>${ _t("Background:")}</label>`} 
                <${TextureBackground} name="background" dropdown=${false} showWhen=${{variant:[3,5,6,7]}}  />
            <//>
        `;
    } 

    tpl_1(val) {
        return html`
            <div class="container-fluid numbers numbers_1" style="background: ${val.background_color}">
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
                                        ${[1, 2, 3, 4].map( i => {
                                            return html`
                                                <div class="item col-3">
                                                    <div class="value">
                                                        <${Text} name="value_${i}" options=${Text.plain_heading}/>
                                                    </div>
                                                    <div class="name"> 
                                                        <${Text} name="name_${i}" options=${Text.plain_text}/>
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

    tpl_default_1(val) {
        return config.language == 'en' ? {
            show_title: false,
            show_title_2: false,
            background_color: '#FFFFFF',
            title: 'Circus facts',
            title_2: 'Subtitle',
            items: [
                {
                    value_1: '15',
                    name_1: 'Years old elephant',
                    value_2: '7',
                    name_2: 'Months Clown does not drink',
                    value_3: '3',
                    name_3: 'Are in a silent chorus',
                    value_4: '300',
                    name_4: 'Sincere smiles',
                }
            ]
        } : {
            show_title: false,
            show_title_2: false,
            background_color: '#FFFFFF',
            title: 'Факты о цирке',
            title_2: 'Подзаголовок',
            items: [
                {
                    value_1: '15',
                    name_1: 'Лет старому слону',
                    value_2: '7',
                    name_2: 'Месяцев не пьет клоун',
                    value_3: '3',
                    name_3: 'Кота в молчаливом хоре',
                    value_4: '300',
                    name_4: 'Искренних улыбок',
                }
            ]
        }
    }

    tpl_2(val) {
        return html`
        <div class="container-fluid numbers numbers_2" style="background: ${val.background_color}">
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
                                                <div class="row text_wrap">
                                                    <div class="value col-2">
                                                        <${Text} name="value_${i}" options=${Text.plain_heading}/>
                                                    </div>
                                                    <div class="name col-2">
                                                        <${Text} name="name_${i}" options=${Text.plain_text}/>
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

    tpl_default_2(val) {
        return config.language == 'en' ? {
            show_title: false,
            show_title_2: false,
            background_color: '#FFFFFF',
            title: 'Circus facts',
            title_2: 'Subtitle',
            items: [
                {
                    value_1: '17',
                    name_1: 'Moments<br>on the market',
                    value_2: '75',
                    name_2: 'Baby<br>smiles',
                    value_3: '105',
                    name_3: 'Hippo<br>weight',
                }
            ]
        } : {
            show_title: false,
            show_title_2: false,
            background_color: '#FFFFFF',
            title: 'Факты о цирке',
            title_2: 'Подзаголовок',
            items: [
                {
                    value_1: '17',
                    name_1: 'Мгновений<br>на рынке',
                    value_2: '75',
                    name_2: 'Детских<br>улыбок',
                    value_3: '105',
                    name_3: 'Весит<br>бегемот',
                }
            ]
        }
    }

    tpl_3(val) {
        return html`
          <div class="container-fluid numbers numbers_3" style=${this.bg_style(val.background)}>
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
                                                <div class="row text_wrap">
                                                    <div class="value col-2"> 
                                                        <${Text} name="value_${i}" options=${Text.plain_heading}/>
                                                    </div>
                                                    <div class="name col-2">
                                                        <${Text} name="name_${i}" options=${Text.plain_text}/>
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

    tpl_default_3(val) {
        return config.language == 'en' ? {
            show_title: false,
            show_title_2: false,
            background: {url:`${config.assets_url}/texture_black/1.jpg`},
            title: 'Circus facts',
            title_2: 'Subtitle',
            items: [
                {
                    value_1: '5',
                    name_1: "The length<br>of the giraffe's neck",
                    value_2: '15',
                    name_2: 'Baby<br>smiles',
                    value_3: '2',
                    name_3: 'Bottles<br>for three',
                }
            ]
        } : {
            show_title: false,
            show_title_2: false,
            background: {url:`${config.assets_url}/texture_black/1.jpg`},
            title: 'Факты о цирке',
            title_2: 'Подзаголовок',
            items: [
                {
                    value_1: '5',
                    name_1: 'Метров<br>шея жирафа',
                    value_2: '15',
                    name_2: 'Детских<br>улыбок',
                    value_3: '2',
                    name_3: 'Бутылки<br>на троих',
                }
            ]
        }
    }

    tpl_4(val) {
        return html`
          <div class="container-fluid numbers numbers_4" style="background: ${val.background_color}">
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
                        <div class="item_list icon_${val.icon_color || "grey"}">
                            <${Repeater} name="items">${item => html`
                                 <div class="row">
                                    ${[1, 2, 3, 4].map( i => {
                                        return html`
                                            <div class="item col-3">
                                                <${Icon} name="icon_${i}"/>
                                                <div class="value">
                                                    <${Text} name="value_${i}" options=${Text.plain_heading}/>
                                                </div>
                                                <hr/>
                                                <div class="name">
                                                    <${Text} name="name_${i}" options=${Text.plain_text}/>
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
            show_title: false,
            show_title_2: false,
            icon_color: 'grey',
            background_color: '#FFFFFF',
            title: 'Circus facts',
            title_2: 'Subtitle',
            items: [
                {
                    icon_1: `${config.assets_url}/ico/101.png`,
                    value_1: '5000',
                    name_1: 'Diplomas',
                    icon_2: `${config.assets_url}/ico/99.png`,
                    value_2: '20',
                    name_2: 'Satisfied visitors',
                    icon_3: `${config.assets_url}/ico/178.png`,
                    value_3: '50',
                    name_3: 'Pour out in the cafeteria',
                    icon_4: `${config.assets_url}/ico/739.png`,
                    value_4: '350',
                    name_4: 'Smiling children',
                }
            ]
        } : {
            show_title: false,
            show_title_2: false,
            icon_color: 'grey',
            background_color: '#FFFFFF',
            title: 'Факты о цирке',
            title_2: 'Подзаголовок',
            items: [
                {
                icon_1: `${config.assets_url}/ico/101.png`,
                value_1: '5000',
                name_1: 'Почётных грамот',
                icon_2: `${config.assets_url}/ico/99.png`,
                value_2: '20',
                name_2: 'Довольных клиентов',
                icon_3: `${config.assets_url}/ico/178.png`,
                value_3: '50',
                name_3: 'Грамм наливают в буфете',
                icon_4: `${config.assets_url}/ico/739.png`,
                value_4: '350',
                name_4: 'Улыбающихся детей',
                }
            ]
        }
    }

    tpl_5(val) {
        return html`
         <div class="container-fluid numbers numbers_5" style=${this.bg_style(val.background)}>
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
                                    ${[1, 2, 3, 4].map( i => {
                                        return html`
                                            <div class="item col-3">
                                                <${Icon} name="icon_${i}" iconType="white"/> 
                                                <div class="value">
                                                    <${Text} name="value_${i}" options=${Text.heading}/>
                                                </div>
                                                <hr/>
                                                <div class="name">
                                                    <${Text} name="name_${i}" options=${Text.plain_text}/>
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
            show_title: false,
            show_title_2: false,
            background: {url: `${config.assets_url}/texture_black/1.jpg`},
            title: 'Circus facts',
            title_2: 'Subtitle',
            items: [
                {
                    icon_1: `${config.assets_url}/ico/491.png`,
                    value_1: '1',
                    name_1: 'Ttrained tiger',
                    icon_2: `${config.assets_url}/ico/447.png`,
                    value_2: '750',
                    name_2: 'Loving audience',
                    icon_3: `${config.assets_url}/ico/379.png`,
                    value_3: '80',
                    name_3: 'Ticket price',
                    icon_4: `${config.assets_url}/ico/645.png`,
                    value_4: '3',
                    name_4: 'Stars in the picture',
                }
            ]
        } : {
            show_title: false,
                show_title_2: false,
                background: {url: `${config.assets_url}/texture_black/1.jpg`},
                title: 'Факты о цирке',
                title_2: 'Подзаголовок',
                items: [
                {
                    icon_1: `${config.assets_url}/ico/491.png`,
                    value_1: '1',
                    name_1: 'Дрессированный тигр',
                    icon_2: `${config.assets_url}/ico/447.png`,
                    value_2: '750',
                    name_2: 'Любящих зрителей',
                    icon_3: `${config.assets_url}/ico/379.png`,
                    value_3: '80',
                    name_3: 'Цена билета',
                    icon_4: `${config.assets_url}/ico/645.png`,
                    value_4: '3',
                    name_4: 'Звезды на картинке',
                }
            ]
        }
    }
    
    tpl_6(val) {
        return html`
            <div class="container-fluid numbers numbers_6" style=${this.bg_style(val.background)}>
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
                            <div class="item_list clear">
                                <${Repeater} name="items">${item => html`
                                    <div class="row">
                                        ${[1, 2, 3, 4].map( i => {
                                            return html`
                                                <div class="item col-4">
                                                    <${Icon} name="icon_${i}" iconType="white"/>
                                                    <div class="value">
                                                        <${Text} name="value_${i}" options=${Text.plain_heading}/>
                                                    </div>
                                                    <div class="name">
                                                        <${Text} name="name_${i}" options=${Text.plain_text}/>
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
            show_title: false,
            show_title_2: false,
            background: {url:`${config.assets_url}/texture_black/1.jpg`},
            title: 'Circus facts',
            title_2: 'Subtitle',
            items: [
                    {
                        icon_1: `${config.assets_url}/ico/648.png`,
                        value_1: '50',
                        name_1: 'UNNECESSARY SCHEDULES',
                        icon_2: `${config.assets_url}/ico/684.png`,
                        value_2: '15',
                        name_2: 'HANGER IN THE DRESSING ROOM',
                        icon_3: `${config.assets_url}/ico/501.png`,
                        value_3: '85',
                        name_3: 'ENERGIZED LAMPS',
                        icon_4: `${config.assets_url}/ico/624.png`,
                        value_4: '20',
                        name_4: ' SOCKETS OUT OF GEAR',
                    }
                ]
        } : {
                show_title: false,
                show_title_2: false,
                background: {url:`${config.assets_url}/texture_black/1.jpg`},
                title: 'Факты о цирке',
                title_2: 'Подзаголовок',
                items: [
                {
                    icon_1: `${config.assets_url}/ico/648.png`,
                    value_1: '50',
                    name_1: 'НЕНУЖНЫХ ГРАФИКОВ',
                    icon_2: `${config.assets_url}/ico/684.png`,
                    value_2: '15',
                    name_2: 'ВЕШАЛОК В ГАРДЕРОБНОЙ',
                    icon_3: `${config.assets_url}/ico/501.png`,
                    value_3: '85',
                    name_3: 'ГОРЯЩИХ ЛАПОЧЕК',
                    icon_4: `${config.assets_url}/ico/624.png`,
                    value_4: '20',
                    name_4: 'НЕРАБОТАЮЩИХ РОЗЕТОК',
                }
            ]
        }
    }

    tpl_7(val) {
        return html`
         <div class="container-fluid numbers numbers_7" style=${this.bg_style(val.background)}>
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
                        <div class="item_list icon_${val.icon_color || "grey"}">
                           <${Repeater} name="items">${item => html`
                                <div class="row">
                                   ${[1, 2, 3, 4].map( i => {
                                       return html`
                                        <div class="item col-3">                                
                                            <div class="value">
                                                <${Text} name="value_${i}" options=${Text.plain_heading}/>
                                            </div>
                                            <${Icon} name="icon_${i}" iconType="white"/>
                                            <div class="name">
                                                <${Text} name="name_${i}" options=${Text.plain_text}/>
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

    tpl_default_7(val) {
        return config.language == 'en' ? {
            show_title: false,
            show_title_2: false,
            icon_color: 'grey',
            background: {url: `${config.assets_url}/texture_black/1.jpg`},
            title: 'Circus facts',
            title_2: 'Subtitle',
            items: [
                {
                    icon_1: `${config.assets_url}/ico/596.png`,
                    value_1: '10',
                    name_1: 'Talking parrots',
                    icon_2: `${config.assets_url}/ico/620.png`,
                    value_2: '22',
                    name_2: 'Balloon',
                    icon_3: `${config.assets_url}/ico/396.png`,
                    value_3: '85',
                    name_3: 'Fluttering butterflies',
                    icon_4: `${config.assets_url}/ico/696.png`,
                    value_4: '1',
                    name_4: 'Directors whiskers',
                }
            ]
            } : {
                show_title: false,
                show_title_2: false,
                icon_color: 'grey',
                background: {url: `${config.assets_url}/texture_black/1.jpg`},
                title: 'Факты о цирке',
                title_2: 'Подзаголовок',
                items: [
                {
                    icon_1: `${config.assets_url}/ico/596.png`,
                    value_1: '10',
                    name_1: 'Говорящих попугаев',
                    icon_2: `${config.assets_url}/ico/620.png`,
                    value_2: '22',
                    name_2: 'Воздушных шарика',
                    icon_3: `${config.assets_url}/ico/396.png`,
                    value_3: '85',
                    name_3: 'Порхающих бабочек',
                    icon_4: `${config.assets_url}/ico/696.png`,
                    value_4: '1',
                    name_4: 'Усы у директора цирка',
                }
            ]
        }
    }

    tpl_8(val) {
        return html`
            <div class="container-fluid numbers numbers_8" style="background: ${val.background_color}">
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
                            <div class="item_list row">
                                <div class="col-10 after-1 before-1">
                                    ${[1, 2, 3, 4, 5].map( i => {
                                        return html` 
                                            <div class="item">
                                                <div class="value_wrap">
                                                    <div class="value" style="color: ${val.numbers_color}">
                                                        <${Text} name="value_${i}" options=${Text.plain_heading}/>
                                                    </div>
                                                    <div class="name">
                                                        <${Text} name="name_${i}" options=${Text.plain_text}/>
                                                    </div>
                                                </div>
                                            </div>
                                        `
                                    })}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_8(val) {
        return config.language == 'en' ? {
            show_title: false,
            show_title_2: false,
            background_color: "#FFFFFF",
            numbers_color: "#E6332A",
            title: 'Circus facts',
            title_2: 'Subtitle',
            value_1: '12',
            name_1: 'Months<br>in a year',
            value_2: '32',
            name_2: 'Teeth',
            value_3: '64',
            name_3: 'Trampolines<br>years',
            value_4: '5',
            name_4: 'Gymnasts<br>soft-boiled',
            value_5: '2',
            name_5: 'Elephants<br>ears',
        } : {
            show_title: false,
            show_title_2: false,
            background_color: "#FFFFFF",
            numbers_color: "#E6332A",
            title: 'Факты о цирке',
            title_2: 'Подзаголовок',
            value_1: '12',
            name_1: 'Месяцев<br>в году',
            value_2: '32',
            name_2: 'Зуба должно быть',
            value_3: '64',
            name_3: 'Года<br>батуту',
            value_4: '5',
            name_4: 'Гимнастов<br>всмятку',
            value_5: '2',
            name_5: 'Уха<br>у слона',
        }
    }
}

Block.register('Numbers',exports = Numbers);