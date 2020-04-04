require("./Header.tea");

const {Block,Logo,Text,FormButton,Icon,BlockColor,Switch,Dialog } = require("../../internal");

class Header extends Block {

    static get title() { return _t('Header') }
    static get description() { return _t('Logo and contacts') }

    configForm() {
        return html`
            <${Dialog}> 
                <${Switch} name="show_desc_and_order_button" label="${_t("Show description and order button")}" showWhen=${{variant:[3]}} />
                <${Switch} name="show_order_button" label="${_t("Show order button")}" showWhen=${{variant:[2,4]}} />
                <label value="${_t("Background color")}" />
                <${BlockColor} name="background" />
            <//>
        `;
    } 

    tpl_1(val) { 
       return html`
        <div class="container-fluid header header_1" style="background: ${val.background};">
            <div class="container">
                <div class="row">
                    <div class="col-3 span_logo">
                        <${Logo} name="logo"/>
                    </div>
                    <div class="col-5 span_desc">
                          <${Text} name="desc" options=${Text.size_text}/>
                    </div>
                    <div class="col-4 span_phone">        
                        <div class="phone"> 
                            <${Text} name="phone" options=${Text.color_heading}/>
                        </div>
                        <div class="phone_desc">
                            <${Text} name="phone_desc" options=${Text.default_heading}/>
                        </div>                          
                    </div>
                </div>
            </div>
        </div>`
    }
    
   tpl_default_1() {    
        return window.locale_lang == 'en' ? {
            background:'#FFFFFF',
            logo: { ...Logo.tpl_default(), 'size': 100},
            desc: '<span style="font-size: 1.1em;">Circus<b> One and the same are at the circus ring</b></span><br><span style="font-size: 0.9em;">Tickets delivery by bear on a bicycle</span>',
            phone: '<span style="font-size: 1.35em;">+7 <span style="color: #C1103A;">(495)</span> 321-46-98</span>',
            phone_desc: 'Moscow, Color Blvd., 13'
          } : {  
            background:'#FFFFFF',
            logo: { ...Logo.tpl_default(), 'size': 100},
            desc: "<span style='font-size: 1.1em;'>Цирк<b> НА МАНЕЖЕ ВСЕ ТЕ ЖЕ</b></span><br><span style='font-size: 0.9em;'>Доставка билетов медведем на велосипеде</span>",
            phone: '<span style="font-size: 1.35em;">+7 <span style="color: #C1103A;">(495)</span> 321-46-98</span>',
            phone_desc: 'г. Москва, Цветной бульвар, 13'
        };
    }
    
    tpl_2(val) {
       return html` 
            <div class="container-fluid header header_2" style="background: ${val.background_color};"> 
                <div class="container">
                    <div class="row">
                        <div class="col-4 span_logo">
                            <${Logo} name="logo"/>
                        </div>
                        <div class="col-5 before-3 span_phone">
                            <div class="phone ${!val.show_order_button && 'no_btn'}">
                                <${Text} name="phone" options=${Text.default_heading}/>
                            </div> 
                            ${val.show_order_button && html`
                                <div class="btn_wrap">
                                    <${FormButton} name="order_button"/>
                                </div>
                            ` }
                        </div>
                    </div>
                </div>
            </div>
        `
    }   
    
   tpl_default_2() {    
        return window.locale_lang == 'en' ? {
            show_order_button: true,
            background:'#FFFFFF',
            logo: { ...Logo.tpl_default(), 'size': 62},
            order_button:  FormButton.tpl_default(),
            phone: '+7 (495) 321-46-98',
        } : {
            show_order_button : true,
            background:'#FFFFFF',
            logo: { ...Logo.tpl_default(), 'size': 62},
            order_button:  FormButton.tpl_default(),
            phone: '+7 (495) 321-46-98',
        };
    }
    
    
    tpl_3(val) {
       return html` 
        <div class="container-fluid header header_3" style="background: ${val.background};"> 
            <div class="container">
                <div class="row">
                    <div class="col-4 span_desc">
                        <div class="desc_1 ${!val.show_desc_and_order_button && 'no_btn'}">
                             <${Text} name="desc_1" options=${Text.default_heading}/>
                        </div>          
                        ${val.show_desc_and_order_button && html`
                            <div class="desc_2">
                                <${Text} name="desc_2" options=${Text.color_text}/>
                            </div>
                        `}                  
                    </div>
                    <div class="col-4 span_logo"><${Logo} name="logo"/></div>
                    <div class="col-4 span_phone"> 
                        <div class="phone ${!val.show_desc_and_order_button && 'no_btn'}">
                             <${Text} name="phone" options=${Text.default_heading}/>
                        </div>
                        ${val.show_desc_and_order_button && html`
                            <div class="btn_wrap">
                                <${FormButton} name="order_button"/>
                            </div>
                        `}
                    </div>
                </div>
            </div>
        </div>   
    `} 
    
    tpl_default_3() {
        return window.locale_lang == 'en' ? {
            background:'#FFFFFF',
            logo: { ...Logo.tpl_default(), 'size': 80},
            desc_1: "Hippos hire",
            desc_2: "<b><span style='color: #C1103A;'>Lowest Prices<br><span style='font-size: 1em; line-height: 1;'>The thickest hiking hippos</span></span></b>",
            phone: "+7 (495) 321-46-98",
            order_button:  FormButton.tpl_default(),
            show_desc_and_order_button: true,
        }:{
            background:'#FFFFFF',
            logo: { ...Logo.tpl_default(), 'size': 80},
            desc_1: "Прокат бегемотов",
            desc_2: "<b><span style='color: #C1103A;'>Самые низкие цены<br><span style='font-size: 1em; line-height: 1;'>Самые толстые прогулочные бегемоты</span></span></b>",
            phone: "+7 (495) 321-46-98",
            order_button:  FormButton.tpl_default(),
            show_desc_and_order_button: true, 
        }
    }
    
    tpl_4(val) {
 
       return html` 
            <div class="container-fluid header header_4" style="background: ${val.background};"> 
                <div class="container">
                    <div class="row">
                        <div class="col-4 span_logo"> 
                        <${Logo} name="logo"/>
                            ${val.logo.type ==='text' && html`
                                <div class="desc ${val.logo.type}">
                                    <${Text} name="desc" options=${Text.plain_text}/>
                                </div>
                            `}     
                        </div>
                        <div class="col-4 span_ico">
                            <div class="ico_wrap ico_1">
                                <${Icon} name="ico_1"/>
                                <div class="ico_name">
                                    <${Text} name="text_1" options=${Text.plain_text}/>
                                </div>
                            </div>
                            <div class="ico_wrap ico_2"> 
                                <${Icon} name="ico_2"/>
                                <div class="ico_name">
                                    <${Text} name="text_2" options=${Text.plain_text}/>
                                </div>
                            </div>
                            <div class="ico_wrap ico_3"> 
                                <${Icon} name="ico_3"/>
                                <div class="ico_name">
                                    <${Text} name="text_3" options=${Text.plain_text}/>
                                </div>
                            </div>
                        </div>           
                        <div class="col-3 before-1 span_phone">
                            <div class="phone ${!val.show_order_button && 'no_btn'}">
                                <${Text} name="phone" options=${Text.default_heading}/>
                            </div> 
                            ${val.show_order_button && html`
                                <div class="span_btn" >
                                    <div class="btn_wrap">
                                        <${FormButton} name="order_button"/>
                                    </div>
                                </div>
                            `}
                        </div> 
                    </div>
                </div>
            </div>
        `
   }  
    
    tpl_default_4() {
        return window.locale_lang == 'en' ? {
            show_order_button: true,
            background: '#FFFFFF',
            logo: { ...Logo.tpl_default(), type: 'text', text: 'One and the same are at the circus ring', fontSize: 19, color: '#C1103A', font: 'Trebuchet MS' },
            desc: 'WE ONLY HAVE REMEDY FROM BAD MOOD',
            ico_1: `${App.assets_url}/ico/209.png`,
            ico_2: `${App.assets_url}/ico/204.png`,
            ico_3: `${App.assets_url}/ico/795.png`, 
            text_1: "MASKED<br>MAN",
            text_2: "PUSSY<br>CAT",
            text_3: "ClOWN<br>JORA",
            phone: "+7 (495) 321-46-98",
            order_button: FormButton.tpl_default(),
        }:{
            show_order_button: true,
            background:'#FFFFFF',
            logo: { ...Logo.tpl_default(), type: 'text', text: 'На манеже все те же', fontSize: 28, color: '#C1103A', font: 'Trebuchet MS' },
            desc: "ТОЛЬКО У НАС ЕСТЬ ЛЕКАРСТВО ОТ ГРУСТИ",
            ico_1: `${App.assets_url}/ico/209.png`, 
            ico_2: `${App.assets_url}/ico/204.png`, 
            ico_3: `${App.assets_url}/ico/795.png`, 
            text_1: "ЧЕЛОВЕК<br>В МАСКЕ",
            text_2: "КОТ<br>КОТОВЕЙ",
            text_3: "КЛОУН<br>ЖОРА",
            phone: "+7 (495) 321-46-98",
            order_button: FormButton.tpl_default(),
        }
    }  
}

Block.register('Header',exports = Header);