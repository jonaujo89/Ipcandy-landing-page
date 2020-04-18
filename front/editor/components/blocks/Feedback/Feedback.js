require("./Feedback.tea");

const {Block,Repeater,Text,Image,BlockColor,Switch,Dialog} = require("../../internal");

class Feedback extends Block {

    static get title() { return _t('Feedback') }
    static get description() { return _t('Customer reviews') }

    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" showWhen=${{variant:[1]}} />
                <${Switch} name="show_title_2" label="${_t("Show second title")}" showWhen=${{variant:[1]}}  />
                <${Switch} name="show_image" label="${_t("Show image")}" showWhen=${{variant:[1]}} /> 
                <label value=${_t("Background color:")} />
                <${BlockColor} name="background_color" />
            <//>
        `;
    }

    tpl_1(val) {
        return html`
        <div class="container-fluid feedback feedback_1" style="background: ${val.background_color}">
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
                        <div class="item_list clear">
                            <${Repeater} name="items">
                                ${item_val => html`
                                    <div class="row">
                                        ${ [1,2,3].map((i) => html`                           
                                            <div class="item col-4">
                                                <div class="item_data">
                                                    <div class="text">
                                                        <${Text} name=${'text_'+i} options=${Text.default_text} />
                                                    </div>
                                                    <div class="name">
                                                        <${Text} name=${'name_'+i} options=${Text.default_text} />
                                                    </div>
                                                    <div class="desc">
                                                        <${Text} name=${'desc_'+i} options=${Text.color_text} />
                                                    </div>
                                                    ${ val.show_image && html`
                                                        <div class="img_wrap">
                                                            <${Image} name=${'image_'+i} />
                                                        </div>
                                                    `}
                                                </div>
                                            </div>
                                        `)}
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

    tpl_default_1() {
        return config.language == 'en' ? {
            'show_image': true,
            'show_title': true,
            'show_title_2': false,
            'show_name': true,
            'show_desc': true,
            'background_color': '#F7F7F7',
            'title': "Our comments",
            'title_2': "Subtitle",
            'items': [
                {
                    'image_1': `${config.assets_url}/feedback/1.jpg`,
                    'image_2': `${config.assets_url}/feedback/2.jpg`,
                    'image_3': `${config.assets_url}/feedback/3.jpg`,
                    'name_1': "Afrosinya Nikonorovna",
                    'name_2': "Ludwig Aristarkhovich",
                    'name_3': "Just Kolyan",
                    'desc_1': "Pensioner",
                    'desc_2': "Сoncierge",
                    'desc_3': "Cool guy",
                    'text_1': "We visited circus with my grandson. A wonderful performance. I like it very much. The artists are fine fellow. With pleasure would have gone more. I am delighted with this circus.",
                    'text_2': "Thank you to those who did it and director for the wonderful Christmas tree. Especially I liked the dance, the Snow Maiden and her girlfriend.",
                    'text_3': "Guys with tigers are the best. Super show with the girls in feathers. I liked the performance with a knife. I get satisfaction from watching. I'll go one more time.",
                },
            ],
        } : {
            'show_image': true,
            'show_title': true,
            'show_title_2': false,
            'show_name': true,
            'show_desc': true,
            'background_color': '#F7F7F7',
            'title': "Что о нас говорят клиенты",
            'title_2': "Подзаголовок",
            'items': [
                {
                    'image_1': `${config.assets_url}/feedback/1.jpg`,
                    'image_2': `${config.assets_url}/feedback/2.jpg`,
                    'image_3': `${config.assets_url}/feedback/3.jpg`,
                    'name_1': "Афросинья Никоноровна",
                    'name_2': "Людвиг Аристархович",
                    'name_3': "Прохожий просто Колян",
                    'desc_1': "Пенсионерка",
                    'desc_2': "Консьерж",
                    'desc_3': "Чёткий пацантрэ",
                    'text_1': "Были в цирке 12 числа с внуком. Замечательное представление. Очень понравилось. Артисты молодцы. С удовольствием пошла бы ещё. Я в восторге от этого цирка.",
                    'text_2': "Спасибо тому кто это сделал и отдельно режиссёру за прекрасную новогоднюю ёлку. Особенно понравился хоровод, снегурочка и подружки снегурочки.",
                    'text_3': "Пацаны с тиграми вообще ребята. Супер шоу с девочками в перьях. Заценил номер с ножиками. Получил удовлетворение от просмотра. Ещё разок схожу."
                },
            ],
        }
    }
}

Block.register('Feedback',exports = Feedback);