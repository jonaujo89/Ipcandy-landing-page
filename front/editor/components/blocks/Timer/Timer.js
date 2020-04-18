require("./Timer.tea");

const {Block,Text,FormOrder,BlockColor,Color,TextureBackground,Switch,Dialog,Countdown} = require("../../internal");

class Timer extends Block { 
    static get title() { return _t('Countdown') }
    static get description() { return _t('Countdown for the stock') }

    configForm() { 
        var val = this.value;
        return html`
            <${Dialog}> 
                <${Switch} name="show_title_2" label="${_t('Show second title')}" />
                <${Switch} name="show_form_bottom_text" label="${_t('Show text under the form')}" showWhen=${{variant:[3, 4]}} /> 

                ${ val.variant==1 && html`
                    <label>${_t('Countdown color:')}</label>
                    <${Color} name="countdown_color" items=${[
                        { value: "#E76953" },
                        { value: "#3F3F3F" },
                    ]} />
                `}
                ${ val.variant==2 && html`
                    <label>${_t('Second title color:')}</label>
                    <${Color} name="title_2_and_countdown_color" items=${[
                        {value: 'red', color: '#FF3E3E'},
                        {value: 'grey', color: '#C2C2C2'},
                        {value: 'green', color: '#74D336'},
                        {value: 'blue', color: '#12ABE7'},
                        {value: 'orange', color: '#FD6F00'},
                        {value: 'purple', color: '#C274FF'},
                        {value: 'rose', color: '#E05189' },
                        {value: 'yellow', color: '#FFC415'},
                    ]}  /> 

                `}
                <label>${_t('Background:')}</label>
                <${BlockColor} name="background_color" label="Background:" showWhen=${{variant:[1,3]}} />
                <${TextureBackground} name="background"  dropdown=${false} showWhen=${{variant:[2,4]}}  />      
            <//>
        `;
    } 

    tpl_1(val) {
        return html`
            <div class="container-fluid timer timer_1" style="background: ${val.background_color};">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_text}/>
                            </h1>
                            ${val.show_title_2 && html`
                                <div class="title_2" > 
                                    <${Text} name="title_2" options=${Text.plain_text} />
                                </div>
                            `}
                            <div class="row">
                                <div class="countdown_desc col-12">
                                    <${Text} name="countdown_desc" options=${Text.plain_text} />
                                </div>
                            </div>
                            <div class="row">
                                <div class="countdown_wrap col-6 after-3 before-3" style="color:${val.countdown_color};">
                                    <${Countdown} name="countdown" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
    }
     ;
    tpl_default_1() {  
        return config.language == 'en' ? {
            show_title_2: true,
            background_color: '#FFFFFF',
            countdown_color: '#E76953',
            title: 'Telepath Vasily is now on the stage',
            title_2: 'Have time to come before the end of the performances',
            countdown_desc: 'Until the end of the performance:',
            countdown: Countdown.tpl_default(),
        } : {
            show_title_2: true,
            background_color: '#FFFFFF',
            countdown_color: '#E76953',
            title: 'Сейчас на сцене телепат Василий',
            title_2: 'Успейте зайти в зал до окончания выступления',
            countdown_desc: 'Осталось до окончания выступления:',
            countdown: Countdown.tpl_default(),
        };
    }

    tpl_2(val) {
        return html`
        <div class="container-fluid timer timer_2" style="${this.bg_style(val.background)}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="title">
                            <${Text} name="title" options=${Text.plain_text}/>
                        </h1>
                        ${val.show_title_2 && html `
                            <div class="title_2 timer_${val.title_2_and_countdown_color || ''}" > 
                                <${Text} name="title_2" options=${Text.plain_text} />
                            </div>
                        `}
                        <div class="row">
                            <div class="countdown_desc col-12">
                                <${Text} name="countdown_desc" options=${Text.plain_text} />
                            </div>
                        </div>
                        <div class="row">
                            <div class="countdown_wrap col-8 after-2 before-2 timer_${val.title_2_and_countdown_color || ''}">
                                <${Countdown} name="countdown" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    }
    
    tpl_default_2() {
        return config.language == 'en' ? {
            show_title_2:true,
            title_2_and_countdown_color:'red',
            background: {url:`${config.assets_url}/texture_black/1.jpg`},
            title:'Illusionist<br>Gosha Lieberman-Almazov',
            title_2:'Have time to come',
            countdown_desc:'Until curtain:',
            countdown:Countdown.tpl_default(),
    } : {
            show_title_2: true,
            title_2_and_countdown_color: 'red',
            background: {url:`${config.assets_url}/texture_black/1.jpg`},
            title: 'Выступление иллюзиониста Гоши Либерман-Алмазова',
            title_2: 'Успейте попасть на представление',
            countdown_desc: 'До начала осталось:',
            countdown: Countdown.tpl_default(),
        }
    }

    tpl_3(val) {
        return html`
            <div class="container-fluid timer timer_3" style="background: ${val.background_color}">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="title">
                                  <${Text} name="title" options=${Text.plain_text}/>
                            </h1>
                            <div class="timer_desc">
                                <${Text} name="timer_desc" options=${Text.plain_text}/>
                            </div>
                            <div class="row">
                                <div class="countdown_wrap col-6">
                                    <${Countdown} name="countdown"/>
                                </div>
                            </div> 
                            ${val.show_title_2 && html`
                                <div class="title_2"> 
                                     <${Text} name="title_2" options=${Text.plain_text}/> 
                                </div>
                            `}
                        </div>    
                        <div class="col-6">
                            <div class="form">
                                <div class="form_title"> 
                                    <${Text} name="form_title_1" options=${Text.plain_text}/> 
                                </div>
                                <div class="form_data">
                                    <${FormOrder} name="form"/>
                                </div> 
                                ${val.show_form_bottom_text && html`
                                    <div class="form_bottom"> 
                                        <${Text} name="form_bottom_text" options=${Text.plain_text}/> 
                                    </div>
                                `} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
    }

    tpl_default_3() {
        return config.language == 'en' ? {
            show_title_2: true,
            show_form_bottom_text: true,
            background_color: '#FFFFFF',
            title: 'PROMOTION ACTION!<br>2 FOR  THE PRICE OF 3 - THIRD AS A GIFT',
            title_2: 'NUMBER OF TICKETS ARE LIMITED',
            timer_desc: 'UNTIL THE END:',
            form_title_1: "Reserve a ticket",
            form_bottom_text: "We don't provide Israeli intelligence with your personal information",
            form: {...FormOrder.tpl_default(), button: {color: 'blue', label: 'Make an enquiry'}},
            countdown: Countdown.tpl_default(),
        } : {

            show_title_2: true,
            show_form_bottom_text: true,
            background_color: '#FFFFFF',
            title: 'АКЦИЯ!<br>ДВА БИЛЕТА ПО ЦЕНЕ ТРЕХ - ТРЕТИЙ В ПОДАРОК',
            title_2: 'КОЛИЧЕСТВО БИЛЕТОВ ОГРАНИЧЕНО',
            timer_desc: 'ДО ОКОНЧАНИЯ АКЦИИ ОСТАЛОСЬ:',
            form_title_1: "Заказать билеты",
            form_bottom_text: "Мы не передаем Вашу персональную информацию израильской разведке",
            form: {...FormOrder.tpl_default(), button: {color: 'blue', label: 'Отправить заявку'}},
            countdown: Countdown.tpl_default(),
        };
    }

    tpl_4(val) {
        return html`
            <div class="container-fluid timer timer_4" style="${this.bg_style(val.background)}">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="title"> 
                                <${Text} name="title" options=${Text.plain_text}/>
                            </h1>
                            <div class="timer_desc"> 
                                <${Text} name="timer_desc" options=${Text.plain_text}/>
                            </div>
                            <div class="row">
                                <div class="countdown_wrap col-6">
                                    <${Countdown} name="countdown"/>
                                </div>
                            </div>
                             ${val.show_title_2 && html`
                                <div class="title_2"> 
                                    <${Text} name="title_2" options=${Text.plain_text}/>
                                </div>
                             `} 
                        </div>
                        <div class="col-6">
                            <div class="form">
                                <div class="form_title"> 
                                    <${Text} name="form_title_1" options=${Text.default_text}/>
                                </div>
                                <div class="form_data">
                                    <${FormOrder} name="form" />
                                </div>
                                ${val.show_form_bottom_text && html`
                                    <div class="form_bottom"> 
                                        <${Text} name="form_bottom_text" options=${Text.default_text} />
                                    </div>
                                `}
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
    }


    tpl_default_4() {
        return config.language == 'en' ? {
            show_title_2: true,
            show_form_bottom_text: true,
            background:{url:`${config.assets_url}/texture_black/1.jpg`},
            title: 'PROMOTION ACTION!<br>2 FOR  THE PRICE OF 3 - THIRD AS A GIFT',
            title_2: 'NUMBER OF TICKETS ARE LIMITED',
            timer_desc: 'UNTIL THE END:',
            form_title_1: "Reserve a ticket",
            form_bottom_text: "We don't provide Israeli intelligence with your personal information",
            form: {...FormOrder.tpl_default(), button: {color: 'blue', label: 'Make an enquiry'}},
            countdown: Countdown.tpl_default(),
        } : {
            show_title_2: true,
            show_form_bottom_text: true,
            background:{url:`${config.assets_url}/texture_black/1.jpg`},
            title: 'АКЦИЯ!<br>ДВА БИЛЕТА ПО ЦЕНЕ ТРЕХ - ТРЕТИЙ В ПОДАРОК',
            title_2: 'КОЛИЧЕСТВО БИЛЕТОВ ОГРАНИЧЕНО',
            timer_desc: 'ДО ОКОНЧАНИЯ АКЦИИ ОСТАЛОСЬ:',
            form_title_1: "Заказать билеты",
            form_bottom_text: "Мы не передаем Вашу персональную информацию израильской разведке",
            form: {...FormOrder.tpl_default(), button: {color: 'blue', label: 'Отправить заявку'}},
            countdown: Countdown.tpl_default(),
        }
    } 

 }

 Block.register('Timer',exports = Timer);