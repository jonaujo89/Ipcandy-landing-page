require("./Cases.tea");

const {Block,Repeater,Text,Media,BlockColor,Dialog,Switch} = require("../../internal");

class Cases extends Block {

    static get title() { return _t('Cases') }
    static get description() { return _t('The results of our customers') } 

    configForm() { 
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label=${_t("Show first title")} />
                <${Switch} name="show_title_2" label=${_t("Show second title")} />
                <${Switch} name="show_name" label=${_t("Show name company")} />
                <${Switch} name="show_desc" label=${_t("Show description")} />
                <label>${_t("Background color:")}</label>
                <${BlockColor} name="background_color" />
            <//>
        `
    }

    tpl_1(val) {
        return html`
        <div class="container-fluid cases cases_1" style="background: ${val.background_color}">
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
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">                       
                                    <div class="media_wrap col-6">
                                        <${Media} name="media" />
                                    </div>
                                    <div class="info col-6">
                                        <div class="info_wrapper">
                                            ${val.show_name && html`
                                                <div class="name">
                                                    <${Text} name="name" options=${Text.plain_heading} />
                                                </div>
                                            `}
                                            ${val.show_desc && html`
                                                <div class="desc">
                                                    <${Text} name="desc" options=${Text.color_heading} />
                                                </div>
                                            `}
                                            <div class="text">
                                                <${Text} name="text" options=${Text.color_text} />
                                            </div>
                                        </div>
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

    tpl_default_1() {
        return window.locale_lang == 'en' ? {
            'show_title': true,
            'show_title_2': false,
            'show_name': true,
            'show_desc': true,
            'background_color': '#F7F7F7',
            'title': "The result of work",
            'title_2': "Subtitle",
            'items': [
                {
                    'media': {...Media.tpl_default(), 'type': 'image', 'image_url': `${lp.app.options.assets_url}/cases/1.jpg` },
                    'name': "Happy faces of the children",
                    'desc': "FUNNY TECHNOLOGIES",
                    'text': "Task: Evoke a childlike smile<br><br>The show includes events suited to every fancy: mystical performances with magic events, wild animals, acrobats, tightrope walkers, magicians and, of course, a circus clown.",
                },
                {
                    'media': {...Media.tpl_default(), 'type': 'image', 'image_url': `${lp.app.options.assets_url}/cases/2.jpg` },
                    'name': "Joyful face",
                    'desc': "FUNNY TECHNOLOGIES",
                    'text': "Task: Evoke an adult smile<br><br>Only glass of cold beer is able to give a joy to the fathers whose children will be watching our circus program.",
                },
            ],
        } : {
            'show_title': true,
            'show_title_2': false,
            'show_name': true,
            'show_desc': true,
            'background_color': '#F7F7F7',
            'title': "Результат работы",
            'title_2': "Подзаголовок",
            'items': [
                {
                    'media': {...Media.tpl_default(), 'type': 'image', 'image_url': `${lp.app.options.assets_url}/cases/1.jpg` },
                    'name': "Радостные лица детей",
                    'desc': "СМЕШНЫЕ ТЕХНОЛОГИИ",
                    'text': "Задание: Вызвать улыбку у детей<br><br> В шоу включены номера на любой вкус: мистические выступления с магическими номерами, выступления диких животных, акробатов, эквилибристов, иллюзионистов и, конечно же, цирковая клоунада.",
                },
                {
                    'media': {...Media.tpl_default(), 'type': 'image', 'image_url': `${lp.app.options.assets_url}/cases/2.jpg` },
                    'name': "Радостные лица взрослых",
                    'desc': "СМЕШНЫЕ ТЕХНОЛОГИИ",
                    'text': "Задание: Вызвать улыбку у родителей<br><br>Только подарочный бокал пенного холодного пива способен подарить отцам радость, дети которых с восторгом будут смотреть нашу цирковую программу.",
                }
            ]
        }
    }
}

Block.register('Cases',exports = Cases);