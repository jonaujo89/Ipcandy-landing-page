require("./Video.tea");

const {Block,Repeater,Text,Media,Radio,BlockColor,Switch,Dialog} = require("../../internal"); 

class Video extends Block {

    static get title() { return _t('Video') }
    static get description() { return _t('Add video') }

    configForm() {
        var val = this.value;
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" showWhen=${{variant:[1, 3]}} />
                <${Switch} name="show_title_2" label="${_t("Show second title")}" showWhen=${{variant:[1, 3]}} /> 
                <${Switch} name="show_text_title_2" label="${_t("Show second text title")}" showWhen=${{variant:[2]}} />
                <${Switch} name="show_desc" label="${_t("Show description")}" showWhen=${{variant:[3]}} /> 
                <${Switch} name="show_border" label="${_t("Show border")}" showWhen=${{variant:[3]}} /> 
                ${val.variant == 1 && html`<label>${_t("Video size:")}</label>`} 
                <${Radio} name="video_size" items=${[
                    {label: _t("small"), value:"small"},
                    {label: _t("medium"), value:"medium"},
                    {label: _t("large"), value:"large"},
                ]} showWhen=${{variant: [1]}} />
                <label>${_t('Background:')}</label>
                <${BlockColor} name="background_color" />
            <//>
        `;
    }

    tpl_1(val) {
        return html`<div class="container-fluid video_block video_block_1" style="background: ${val.background_color};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${val.show_title && html`
                            <h1 class="title"> 
                                <${Text} name="title" options=${Text.plain_heading}/>
                            </h1>
                        `}
                        ${val.show_title_2 && html`
                            <div class="title_2"> 
                                <${Text} name="title_2" options=${Text.plain_heading}/>
                            </div>
                        `}
                        <div class="video ${val.video_size || 'small'}">  
                             <${Media} name="video" switchType=${false}/>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    }

    tpl_default_1() { 
        return window.locale_lang == 'en' ? {
            video_size: "small",
            show_title: true,
            show_title_2: false,
            background_color: '#FFFFFF',
            title: 'Watch our video',
            title_2: 'Subtitle',
            video: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'},
        } : {
            video_size: "small",
            show_title: true,
            show_title_2: false,
            background_color: '#FFFFFF',
            title: 'Посмотрите видео о нашем цирке',
            title_2: 'Нарезка выступлений',
            video: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'},
        }
    }

    tpl_2(val) {   
        return  html`<div class="container-fluid video_block video_block_2" style="background: ${val.background_color};">
                <div class="container">
                    <div class="row">
                        <div class="item_list col-12">
                            <${Repeater} name="items">
                                ${(item_val, self) => html`
                                    <div class="item row">
                                        ${val.items.map (item => html`
                                            <div class="video col-6">
                                                <${Media} name="video" switchType=${false} />
                                            </div>
                                            <div class="text_wrap col-6"> 
                                                    <h1 class="text_title"> 
                                                        <${Text} name="text_title" options=${Text.plain_heading}/>
                                                    </h1> 
                                                    ${val.show_text_title_2 && html`
                                                        <div class="text_title_2"> 
                                                            <${Text} name="text_title_2" options=${Text.plain_heading}/>
                                                        </div>
                                                    `} 
                                                <div class="text"> 
                                                    <${Text} name="text" options=${Text.plain_heading}/>
                                                </div>
                                            </div>
                                        `)}
                                    </div>
                                `}
                            <//>
                        </div>
                    </div>                
                </div>
            </div>`
   }
    
    tpl_default_2() {
        return window.locale_lang == 'en' ? {
            show_text_title_2: true,
            background_color: '#FFFFFF',
            items: [
                    {
                        text_title: 'Circus «One and the same are at the circus ring»',
                        text_title_2: 'The best circus program',
                        text: `<div>Meeting with the clown duo, reprises which are built in the modern spirit, and do not leave indifferent neither kids nor adults. The stunts of the gymnast on the trapeze under the dome of our circus take your breath away.</div>
                                <br>
                                <div>
                                -Comfortable hall <br>
                                -Funny acts <br>
                                -Exciting performances <br>
                                </div>`,
                        video: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'}
                    },  
                ],
        } : {
            show_text_title_2: true,
            background_color: '#FFFFFF',
            items: [
                    {
                        text_title: 'Цирк «НА МАНЕЖЕ ВСЕ ТЕ ЖЕ»',
                        text_title_2: 'Лучшая цирковая программа',
                        text: `<div>Встреча с клоунскими дуэтами, репризы которых построены в современном духе и не оставляют равнодушными ни детей, ни взрослых. Под куполом цирка воздушная гимнастка на трапеции, отважные трюки которой захватывают дыхание.</div>
                                <br>
                                <div>
                                -Комфортный зал <br>
                                -Смешные номера <br>
                                -Захватывающие выступления <br>
                                </div>`,
                        video: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'},
                    },
                ],
        };
    }

    tpl_3(val) {  
        return html`<div class="container-fluid video_block video_block_3" style="background: ${val.background_color};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${val.show_title && html`
                            <h1 class="title"> 
                                <${Text} name="title" options=${Text.plain_heading}/>
                            </h1>
                        `}
                        ${val.show_title_2 && html`
                            <div class="title_2"> 
                                <${Text} name="title_2" options=${Text.plain_heading}/>
                            </div>
                        `}                    
                        <div class="item_list clear">
                            <${Repeater} name="items">
                                ${(item_val, self) => html`
                                    <div class="row"> 
                                        ${[1, 2, 3].map (i => html` 
                                            <div class="item col-4"> 
                                                <div class="video ${!val.show_border ? 'hide_border' : ''}">
                                                    <${Media} name="video_${i}" switchType=${false}/>
                                                </div>
                                                <div class="info">
                                                    <div class="name">
                                                        <${Text} name="name_${i}" options=${Text.plain_heading}/>
                                                    </div>
                                                    ${val.show_desc && html`
                                                        <div class="desc">
                                                            <${Text} name="desc_${i}" options=${Text.plain_heading}/>
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
        </div>`
    }
    
    tpl_default_3() { 
        return window.locale_lang == 'en' ? {
            show_title: true,
            show_title_2: false,
            show_border: true,
            show_desc: true,   
            background_color: '#FFFFFF',
            title: 'Testimonials',
            title_2: 'Subtitle', 
            items: [
                {
                    name_1: 'Service phone',
                    desc_1: 'Sergei Zaduysvechku, office plankton',
                    video_1: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'}, 
                    name_2: 'Pushing paper',
                    desc_2: 'Alina Seshsalo, chairman of the meeting',
                    video_2: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'}, 
                    name_3: 'Clearing',
                    desc_3: 'Ivan Zaveditraktor, navigator of combine',
                    video_3: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'}, 
                }
            ]
                
        } : {
            show_title: true,
            show_title_2: false,
            show_border: true,
            show_desc: true,   
            background_color: '#FFFFFF',
            title: 'Отзывы о цирковой программе',
            title_2: 'Что понравилось нашим клиентам', 
            items:[
                {
                    name_1: 'Обслуживание телефонов',
                    desc_1: 'Сергей Задуйсвечку, офисный планктон',
                    video_1: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'}, 
                    name_2: 'Перекладывание бумаг',
                    desc_2: 'Алина Съешсало, председатель заседаний',
                    video_2: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'}, 
                    name_3: 'Освоение целины',
                    desc_3: 'Иван Заведитрактор, штурман комбайна',
                    video_3: {video_url: 'www.youtube.com/embed/slMub4NtrSk', type: 'video'}, 
                }
            ]
        };       
    }
}

Block.register('Video',exports = Video);