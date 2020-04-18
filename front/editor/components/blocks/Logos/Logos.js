require("./Logos.tea");

const {Block,Repeater,Text,LogoItem,BlockColor,Switch,Dialog} = require("../../internal"); 

class Logos  extends Block {

    static get title() { return _t('Logos') }
    static get description() { return _t('Logos of the partners') }

    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" />
                <${Switch} name="show_title_2" label="${_t("Show second title")}" />
                <${Switch} name="grayscale_logo" label="${_t("Grayscale logo")}" /> 
                <label>${ _t("Background:")}</label>
                <${BlockColor} name="background_color" />
            <//>
        `;
    }

    tpl_1(val) {
       return html`<div class="container-fluid clients_logos clients_logos_1" style="background: ${val.background_color};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${val.show_title && html`
                            <h1 class="title"> 
                                <${Text} name="title" options=${Text.plain_heading}/>
                            </h1>
                        `}
                        ${val.show_title_2 && html`
                            <h1 class="title_2"> 
                                <${Text} name="title_2" options=${Text.plain_heading}/>
                            </h1>
                        `}
                        <div class="item_list ${val.grayscale_logo ? 'gray' : ''}">
                            <${Repeater} name="items" inline=${true}>${item_val => html` 
                                <${LogoItem} name="image" />
                            `}<//> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>`
    }
  
    tpl_default_1() { 
       return config.language == 'en' ? {
            show_title: true,
            show_title_2: false,
            grayscale_logo: true,
            background_colo: '#FFFFFF',
            title: 'Our partners',
            title_2: 'Subtitle about our partners',
            items: [
                {image: `${config.assets_url}/logos/1.png`},
                {image: `${config.assets_url}/logos/2.png`},
                {image: `${config.assets_url}/logos/3.png`},
                {image: `${config.assets_url}/logos/4.png`},
                {image: `${config.assets_url}/logos/5.png`},
                {image: `${config.assets_url}/logos/6.png`},
                {image: `${config.assets_url}/logos/7.png`},
                {image: `${config.assets_url}/logos/8.png`},
                {image: `${config.assets_url}/logos/9.png`},
                {image: `${config.assets_url}/logos/11.png`},
                {image: `${config.assets_url}/logos/12.png`},
            ],
        } : {            
            show_title: true,
            show_title_2: false,
            grayscale_logo: true,
            background_colo: '#FFFFFF',
            title: 'Наши партнёры',
            title_2: 'Подзаголовок про партнёров',
            items: [
                {image: `${config.assets_url}/logos/1.png`},
                {image: `${config.assets_url}/logos/2.png`},
                {image: `${config.assets_url}/logos/3.png`},
                {image: `${config.assets_url}/logos/4.png`},
                {image: `${config.assets_url}/logos/5.png`},
                {image: `${config.assets_url}/logos/6.png`},
                {image: `${config.assets_url}/logos/7.png`},
                {image: `${config.assets_url}/logos/8.png`},
                {image: `${config.assets_url}/logos/9.png`},
                {image: `${config.assets_url}/logos/11.png`},
                {image: `${config.assets_url}/logos/12.png`},
            ],
        };
    }    
}

Block.register('Logos',exports = Logos);