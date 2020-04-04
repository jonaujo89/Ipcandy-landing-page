require("./Faq.tea");
const {Block,Repeater,Text,Icon,BlockColor,Switch,Dialog} = require("../../internal");

const FAQItem = ({val,item_val}) => {
    const [active,setActive] = preact.hooks.useState(false);
    return html`
        <div class="faq-item ${active?'active':''}" onClick=${()=>setActive(!active)}>
            ${ val.show_icon && html`
                <div class="icon"><${Icon} name='@icon' /></div>
            `}
            <div class="faq-content">
                <div class="question">
                    <${Text} name='question' options=${Text.plain_heading} />
                </div>
                <div class="answer">
                    <${Text} name='answer' options=${Text.default_text} />
                </div>
            </div>
        </div>
    `;
}

class FAQ extends Block {
    static get title() { return _t('FAQ') }
    static get description() { return _t('Questions and answers') } 

    configForm() { return html`
        <${Dialog}>
            <${Switch} name="show_title" label="${_t("Show first title")}" />
            <${Switch} name="show_title_2" label="${_t("Show second title")}" />
            <${Switch} name="show_icon" label="${_t("Show icon")}" />
            <${Switch} name="two_column_layout" label="${_t("Two column layout")}" />
            <${BlockColor} name="background_color" />
        <//>
    `;}

    tpl_1(val) {
        return html`
        <div class="container-fluid faq" style="background-color: ${val.background_color}">
            <div class="container">
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

                <div class="row">
                    <div class="col-12">
                        <div class="faq-items ${val.two_column_layout ? "two-column-layout" : ""}">
                            <${Repeater} name="faq_items">${item_val => html`
                                <${FAQItem} val=${val} item_val=${item_val} />
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
            'show_title_2': true,
            'two_column_layout': false,
            'icon': `${App.assets_url}/ico/208.png`,
            'show_icon': true,
            'background_color': "#FFFFFF",
            'title': "Ask anything you want",
            'title_2': "Random answers to random questions",
            'faq_items': [
                {
                    'question': "I want to return the tickets. How to do it?",
                    'answer': "Refunds are only possible if the event is canceled and/or postponed.",
                },
                {
                    'question': "Can I change tickets for another date?",
                    'answer': "No, we do not have the technical ability to change tickets.",
                },
                {
                    'question': "From which age do children need to buy tickets to the circus?",
                    'answer': "Children from 4 years old. A ticket for an accompanying person on a common basis.",
                },
                {
                    'question': "Can I book tickets online?",
                    'answer': "Yes, you can book tickets on our website.",
                },
            ],
        } : {
            'show_title': true,
            'show_title_2': true,
            'two_column_layout': false,
            'icon': `${App.assets_url}/ico/208.png`,
            'show_icon': true,
            'background_color': "#FFFFFF",
            'title': "Спросите, что хотите",
            'title_2': "Дадим случайный ответ на случайный вопрос",
            'faq_items': [
                {
                    'question': "Я хочу вернуть билеты. Как это сделать?",
                    'answer': "Возврат денег возможен только при отмене и/или переносе мероприятия.",
                },
                {
                    'question': "Можно ли поменять билеты на другую дату?",
                    'answer': "Нет, у нас нет технической возможности поменять билеты.",
                },
                {
                    'question': "С какого возраста детям нужно покупать билеты в цирк?",
                    'answer': "Детям с 4 лет. Билет для сопровождающего на общих основаниях.",
                },
                {
                    'question': "Можно ли забронировать билеты онлайн?",
                    'answer': "Да, вы можете забронировать билеты у нас на сайте.",
                },
            ],
        }
    }
}

Block.register('FAQ',exports = FAQ);