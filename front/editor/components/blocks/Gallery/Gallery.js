require("./Gallery.tea");
const {Block,Repeater,Text,BlockColor,Switch,Dialog} = require("../../internal");
const {GalleryRepeater,GallerySlider} = require("GalleryRepeater");
const {GalleryImage} = require("GalleryImage");
const {OverlayImage} = require("OverlayImage");
const {ImageLink} = require("ImageLink");

class Gallery extends Block {

    static get title() { return _t('Gallery') }
    static get description() { return _t('Photos and images') }

    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" />
                <${Switch} name="show_title_2" label="${_t("Show second title")}" />
                <${Switch} name="show_image_title" label="${_t("Show image title")}" showWhen=${{variant:[1,5,6,7,8,9,10]}} /> 
                <${Switch} name="show_image_overlay" label="${_t("Show block with text")}" showWhen=${{variant:[2,3,4]}} /> 
                <${Switch} name="show_image_desc" label="${_t("Show image description")}" showWhen=${{variant:[1,5,6,7,8,9,10]}} /> 
                <${Switch} name="show_image_desc" label="${_t("Show image description")}" showWhen=${{variant:[2,3,4], show_image_overlay: true}} /> 
                <${Switch} name="enable_fancybox" label="${_t("Show big image")}" showWhen=${{variant:[1,3,4,5,6,7,8,9,10]}} />
                <label value=${_t("Background color:")} />
                <${BlockColor} name="background" />
            <//>
        `;
    }

    tpl_1(val) {
        return html`<div class="container-fluid gallery gallery_1" style="background: ${val.background}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list ${(!val.show_image_title && !val.show_image_desc) ? 'no_opacity': '' }">
                            <${GalleryRepeater} name="items">${item_val => html`
                                <div class="preview_img" style="background-image: url('${base_url}/${item_val.image}');"></div>
                                ${val.enable_fancybox && html`
                                    <${ImageLink} href="${base_url}/${item_val.image}" title=${item_val.title} />
                                `}
                                <div class="overlay">
                                    <div class="wrap_title_desc">
                                        ${val.show_image_title && html`
                                            <div class="img_title" >
                                                ${item_val.title}
                                            </div>
                                        `}
                                        ${val.show_image_desc && html`
                                            <div class="img_desc" >
                                                ${item_val.desc}
                                            </div>
                                        `}
                                    </div>
                                </div>
                            `}<//>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_1() {
        return window.locale_lang=='en' ? {
                'show_title': true,
                'show_title_2': false,
                'show_image_title': true,
                'show_image_desc': true,
                'enable_fancybox': true,
                'background': '#FFFFFF',
                'title': "Our program in photos",
                'title_2': "Subtitle",
                'items': [
                    { 'image': `${App.assets_url}/gallery/21.jpg`, 'title': 'Three people put the hats on', 'desc': 'Acrobats on the ropes' },
                    { 'image': `${App.assets_url}/gallery/24.jpg`, 'title': 'Tusk', 'desc': 'Trained rhino' },
                    { 'image': `${App.assets_url}/gallery/25.jpg`, 'title': 'Jumper', 'desc': 'Show with the horse' },
                    { 'image': `${App.assets_url}/gallery/26.jpg`, 'title': 'Lambada', 'desc': 'Dancing elephants' },
                    { 'image': `${App.assets_url}/gallery/27.jpg`, 'title': 'Tigress', 'desc': 'It is the one on the left' },
                    { 'image': `${App.assets_url}/gallery/30.jpg`, 'title': 'Grace', 'desc': 'Girl on the tape' },
                ]
            } : {
            'show_title': true,
            'show_title_2': false,
            'show_image_title': true,
            'show_image_desc': true,
            'enable_fancybox': true,
            'background':'#FFFFFF',
            'title': "Наша программа в фотографиях",
            'title_2': "Подзаголовок",
            'items': [
                { 'image': `${App.assets_url}/gallery/21.jpg`, 'title': 'Трое в шляпах', 'desc': 'Акробаты на канатах' },
                { 'image': `${App.assets_url}/gallery/24.jpg`, 'title': 'Бивень', 'desc': 'Дрессированный носорог' },
                { 'image': `${App.assets_url}/gallery/25.jpg`, 'title': 'Прыгун', 'desc': 'Номер с конём' },
                { 'image': `${App.assets_url}/gallery/26.jpg`, 'title': 'Ламбада', 'desc': 'Танцующие слоны' },
                { 'image': `${App.assets_url}/gallery/27.jpg`, 'title': 'Тигрица', 'desc': 'Это та, что слева' },
                { 'image': `${App.assets_url}/gallery/30.jpg`, 'title': 'Грация', 'desc': 'Девушка на лентах' },
            ]
        };
    }

    tpl_2(val) {
        return html`
        <div class="container-fluid gallery gallery_2" style="background: ${val.background};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list ${ val.show_image_desc ? "" : "hide_desc"} ${ val.show_image_overlay ? "" : "hide_overlay" }">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">
                                    ${ [1,2].map((i) => html`
                                        <div class="col-6">
                                            <div class="item">
                                                <${GalleryImage} name=${"image_"+i} />
                                                <div class="overlay">
                                                    <div class="in">                                        
                                                        <div class="img_title">
                                                            <${Text} name=${"img_title_"+i} options=${Text.plain_heading} />
                                                        </div>
                                                        ${val.show_image_desc && html`
                                                            <div class="img_desc" >
                                                                <${Text} name=${"img_desc_"+i} options=${Text.color_heading} />
                                                            </div>
                                                        `}
                                                        <div class="img_text">
                                                            <${Text} name=${"img_text_"+i} options=${Text.default_text} />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    }

    tpl_default_2() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_overlay' : true,
            'background' : '#FFFFFF',
            'title' : "Our Prima",
            'title_2' : "Subtilte",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/1.jpg`},
                    'img_title_1' : "In ring",
                    'img_desc_1' : "Fascinating spectacle",
                    'img_text_1' : "Additional description of the picture. Brevity - the sister of talent.",
                    'image_2' : {'image': `${App.assets_url}/gallery/2.jpg`},
                    'img_title_2' : "Entrance",
                    'img_desc_2' : "At the entrance she meets",
                    'img_text_2' : "Additional description of the picture. Brevity - the sister of talent.",
                },
                {
                    'image_1' : {'image': `${App.assets_url}gallery/5.jpg`},
                    'img_title_1' : "Form №2",
                    'img_desc_1' : "Nude torso",
                    'img_text_1' : "Additional description of the picture. Brevity - the sister of talent.",
                    'image_2' : {'image': `${App.assets_url}/gallery/6.jpg`},
                    'img_title_2' : "Prima and clown",
                    'img_desc_2' : "Foci",
                    'img_text_2' : "Additional description of the picture. Brevity - the sister of talent.",
                }
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
			'show_image_desc' : true,
			'show_image_overlay' : true,
            'background' : '#FFFFFF',
            'title' : "Наша Прима",
			'title_2' : "Подзаголовок",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/1.jpg`},
                    'img_title_1' : "В кольце",
                    'img_desc_1' : "Завораживающее зрелище",
                    'img_text_1' : "Дополнительное описание картинки. Краткость - сестра таланта.",
                    'image_2' : {'image': `${App.assets_url}/gallery/2.jpg`},
                    'img_title_2' : "У входа",
                    'img_desc_2' : "На входе встречает она",
                    'img_text_2' : "Дополнительное описание картинки. Краткость - сестра таланта.",
                },
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/5.jpg`},
                    'img_title_1' : "Форма №2",
                    'img_desc_1' : "Голый торс",
                    'img_text_1' : "Дополнительное описание картинки. Краткость - сестра таланта.",
                    'image_2' : {'image': `${App.assets_url}/gallery/6.jpg`},
                    'img_title_2' : "Прима и клоун",
                    'img_desc_2' : "Номер с фокусами",
                    'img_text_2' : "Дополнительное описание картинки. Краткость - сестра таланта.",
                }
            ]
        };
    }

    tpl_3(val) {
        return html`
        <div class="container-fluid gallery gallery_3" style="background: ${val.background};">
           <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">
                                    ${ [1,2,3].map((i) => html`       
                                        <div class="col-4">       
                                            <div class="item">
                                                <${GalleryImage} name=${"image_"+i} />
                                                ${val.show_image_overlay && html`
                                                    <div class="overlay" >
                                                        <div class="img_title">
                                                            <${Text} name=${"img_title_"+i} options=${Text.plain_heading} />
                                                        </div>
                                                        ${val.show_image_desc && html`
                                                            <div class="img_desc>" >
                                                                <${Text} name=${"img_desc_"+i} options=${Text.default_text} />
                                                            </div>
                                                        `}
                                                    </div>
                                                `}
                                            </div>
                                        </div>
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `
    }

    tpl_default_3() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_overlay' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Good girl",
            'title_2' : "Subtitle",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/1.jpg`},
                    'img_title_1' : "In ring",
                    'img_desc_1' : "Fascinating spectacle",
                    'image_2' : {'image': `${App.assets_url}/gallery/2.jpg`},
                    'img_title_2' : "Entrance",
                    'img_desc_2' : "At the entrance she meets",
                    'image_3' : {'image': `${App.assets_url}/gallery/3.jpg`},
                    'img_title_3' : "Throwing knives",
                    'img_desc_3' : "Dangerous stunts with knives",
                },
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/5.jpg`},
                    'img_title_1' : "Form №2",
                    'img_desc_1' : "Nude torso",
                    'image_2' : {'image': `${App.assets_url}/gallery/6.jpg`},
                    'img_title_2' : "Prima and clown",
                    'img_desc_2' : "Foci",
                    'image_3' : {'image': `${App.assets_url}/gallery/7.jpg`},
                    'img_title_3' : "Long legs",
                    'img_desc_3' : "16 and up",
                }
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_overlay' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Просто хорошая девушка",
            'title_2' : "Подзаголовок",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/1.jpg`},
                    'img_title_1' : "В кольце",
                    'img_desc_1' : "Завораживающее зрелище",
                    'image_2' : {'image': `${App.assets_url}/gallery/2.jpg`},
                    'img_title_2' : "У входа",
                    'img_desc_2' : "На входе встречает она",
                    'image_3' : {'image': `${App.assets_url}/gallery/3.jpg`},
                    'img_title_3' : "Метание ножей",
                    'img_desc_3' : "Опасный трюк с ножами",
                },
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/5.jpg`},
                    'img_title_1' : "Форма №2",
                    'img_desc_1' : "Голый торс",
                    'image_2' : {'image': `${App.assets_url}/gallery/6.jpg`},
                    'img_title_2' : "Прима и клоун",
                    'img_desc_2' : "Номер с фокусами",
                    'image_3' : {'image': `${App.assets_url}/gallery/7.jpg`},
                    'img_title_3' : "Ноги от ушей",
                    'img_desc_3' : "От 16 и старше",
                }
            ]
        };
    }

    tpl_4(val) {
        return html`<div class="container-fluid gallery gallery_4" style="background: ${val.background};">
           <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list clear">
                            <${Repeater} name="items">${item_val => html`
                                <div class="row">
                                    ${[1,2,3,4].map((i) => html`
                                        <div class="col-3">                         
                                            <div class="item">
                                                <${GalleryImage} name=${"image_"+i} />
                                                ${val.show_image_overlay && html`
                                                    <div class="overlay" >
                                                        <div class="img_title">
                                                            <${Text} name=${"img_title_"+i} options=${Text.plain_heading} />
                                                        </div>
   
                                                        ${val.show_image_desc && html`
                                                            <div class="img_desc">
                                                                <${Text} name=${'img_desc_'+i} option=${Text.default_text} />
                                                            </div>
                                                        `}
                                                    </div>
                                                `}
                                            </div>
                                        </div>
                                    `)}
                                </div>
                            `}<//>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_4() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_overlay' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Graceful beauty",
            'title_2' : "Subtitle",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/1.jpg`},
                    'img_title_1' : "In ring",
                    'img_desc_1' : "Fascinating spectacle",
                    'image_2' : {'image': `${App.assets_url}/gallery/2.jpg`},
                    'img_title_2' : "Entrance",
                    'img_desc_2' : "At the entrance she meets",
                    'image_3' : {'image': `${App.assets_url}/gallery/3.jpg`},
                    'img_title_3' : "Throwing knives",
                    'img_desc_3' : "Dangerous stunts with knives",
                    'image_4' : {'image': `${App.assets_url}/gallery/4.jpg`},
                    'img_title_4' : "Ticketing",
                    'img_desc_4' : "At the box office again Prima",
                },
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/5.jpg`},
                    'img_title_1' : "Form №2",
                    'img_desc_1' : "Nude torso",
                    'image_2' : {'image': `${App.assets_url}/gallery/6.jpg`},
                    'img_title_2' : "Prima and clown",
                    'img_desc_2' : "Foci",
                    'image_3' : {'image': `${App.assets_url}/gallery/7.jpg`},
                    'img_title_3' : "Long legs",
                    'img_desc_3' : "16 and up",
                    'image_4' : {'image': `${App.assets_url}/gallery/8.jpg`},
                    'img_title_4' : "In the dressing room",
                    'img_desc_4' : "Before going on stage",
                }
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_overlay' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Изящная чертовка",
            'title_2' : "Подзаголовок",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/1.jpg`},
                    'img_title_1' : "В кольце",
                    'img_desc_1' : "Завораживающее зрелище",
                    'image_2' : {'image': `${App.assets_url}/gallery/2.jpg`},
                    'img_title_2' : "У входа",
                    'img_desc_2' : "На входе встречает она",
                    'image_3' : {'image': `${App.assets_url}/gallery/3.jpg`},
                    'img_title_3' : "Метание ножей",
                    'img_desc_3' : "Опасный трюк с ножами",
                    'image_4' : {'image': `${App.assets_url}/gallery/4.jpg`},
                    'img_title_4' : "Обилечивание",
                    'img_desc_4' : "У кассы снова Прима",
                },
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/5.jpg`},
                    'img_title_1' : "Форма №2",
                    'img_desc_1' : "Голый торс",
                    'image_2' : {'image': `${App.assets_url}/gallery/6.jpg`},
                    'img_title_2' : "Прима и клоун",
                    'img_desc_2' : "Номер с фокусами",
                    'image_3' : {'image': `${App.assets_url}/gallery/7.jpg`},
                    'img_title_3' : "Ноги от ушей",
                    'img_desc_3' : "От 16 и старше",
                    'image_4' : {'image': `${App.assets_url}/gallery/8.jpg`},
                    'img_title_4' : "В гримёрке",
                    'img_desc_4' : "Перед выходом на сцену",
                }
            ]
        };
    }

    tpl_5(val) {
        return html`<div class="container-fluid gallery gallery_5" style="background: ${val.background};">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list ${(!val.show_image_title && !val.show_image_desc) ? 'no_opacity': '' }">
                            <${GallerySlider} name="items">${item_val => html`                                
                                <div class="preview_img">
                                    <img src="${base_url}/${item_val.image}" />
                                    ${val.enable_fancybox && html`
                                        <${ImageLink} href="${base_url}/${item_val.image}" title=${item_val.title} />
                                    `}
                                </div>                                    
                                <div class="overlay">
                                    <div class="wrap_title_desc">
                                        ${val.show_image_title && html`
                                        <div class="img_title" >
                                            ${item_val.title}
                                        </div>
                                    `}
                                    ${val.show_image_desc && html`
                                        <div class="img_desc" >
                                            ${item_val.desc}
                                        </div>
                                    `}
                                    </div>
                                </div>                                
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_5() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_title' : true,
            'show_image_desc' : true,
            'enable_fancybox' : true,
            'background' : '#F7F7F7',
            'title' : "Lovely",
            'title_2' : "Subtitle",
            'items' : [
                { 'image' : `${App.assets_url}/gallery/1.jpg`, 'title' : 'In ring', 'desc' : 'Fascinating spectacle' },
                { 'image' : `${App.assets_url}/gallery/2.jpg`, 'title' : 'Entrance', 'desc' : 'At the entrance she meets' },
                { 'image' : `${App.assets_url}/gallery/3.jpg`, 'title' : 'Throwing knives', 'desc' : 'Dangerous stunts with knives' },
                { 'image' : `${App.assets_url}/gallery/4.jpg`, 'title' : 'Ticketing', 'desc' : 'At the box office again Prima' },
                { 'image' : `${App.assets_url}/gallery/5.jpg`, 'title' : 'Form №2', 'desc' : 'Nude torso' },
                { 'image' : `${App.assets_url}/gallery/6.jpg`, 'title' : 'Prima and clown', 'desc' : 'Foci' },
                { 'image' : `${App.assets_url}/gallery/7.jpg`, 'title' : 'Long legs', 'desc' : '16 and up' },
                { 'image' : `${App.assets_url}/gallery/8.jpg`, 'title' : 'In the dressing room', 'desc' : 'Before going on stage' },
                { 'image' : `${App.assets_url}/gallery/9.jpg`, 'title' : 'Swing', 'desc' : 'Prima under the dome' },
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_title' : true,
            'show_image_desc' : true,
            'enable_fancybox' : true,
            'background' : '#F7F7F7',
            'title' : "Активистка, комсомолка и просто...",
            'title_2' : "Подзаголовок",
            'items' : [
                { 'image' : `${App.assets_url}/gallery/1.jpg`, 'title' : 'В кольце', 'desc' : 'Завораживающее зрелище' },
                { 'image' : `${App.assets_url}/gallery/2.jpg`, 'title' : 'У входа', 'desc' : 'На входе встречает она' },
                { 'image' : `${App.assets_url}/gallery/3.jpg`, 'title' : 'Метание ножей', 'desc' : 'Опасный трюк с ножами' },
                { 'image' : `${App.assets_url}/gallery/4.jpg`, 'title' : 'Обилечивание', 'desc' : 'У кассы снова прима' },
                { 'image' : `${App.assets_url}/gallery/5.jpg`, 'title' : 'Форма №2', 'desc' : 'Голый торс' },
                { 'image' : `${App.assets_url}/gallery/6.jpg`, 'title' : 'Прима и клоун', 'desc' : 'Номер с фокусами' },
                { 'image' : `${App.assets_url}/gallery/7.jpg`, 'title' : 'Ноги от ушей', 'desc' : 'От 16 и старше' },
                { 'image' : `${App.assets_url}/gallery/8.jpg`, 'title' : 'В гримёрке', 'desc' : 'Перед выходом на сцену' },
                { 'image' : `${App.assets_url}/gallery/9.jpg`, 'title' : 'Качели', 'desc' : 'Прима под куполом' },
            ]
        };
    }

    tpl_6(val) {
        return html`<div class="container-fluid gallery gallery_6" style="background: ${val.background};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list ${(!val.show_image_title && !val.show_image_desc) ? 'no_opacity': '' }">
                            <${GalleryRepeater} name="items">${item_val => html`
                                <div class="preview_img">
                                    <img src="${base_url}/${item_val.image}" />
                                    ${val.enable_fancybox && html`
                                        <${ImageLink} href="${base_url}/${item_val.image}" title=${item_val.title} />
                                    `}
                                </div>
                                <div class="overlay">
                                    <div class="outer">
                                        <div class="wrap_title_desc">
                                            ${val.show_image_title && html`
                                                <div class="img_title" >
                                                    ${item_val.title}
                                                </div>
                                            `}
                                            ${val.show_image_desc && html`
                                                <div class="img_desc" >
                                                    ${item_val.desc}
                                                </div>
                                            `}
                                        </div>
                                    </div>
                                </div>
                            `}<//>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_6() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_title' : true,
            'show_image_desc' : true,
            'enable_fancybox' : true,
            'background' :'#FFFFFF',
            'title' : "Our program in photos",
            'title_2' : "Subtitle",
            'items' : [
                { 'image' : `${App.assets_url}/gallery/11.jpg`, 'title' : 'Clown Zhora', 'desc' : 'Play-actor №1' },
                { 'image' : `${App.assets_url}/gallery/12.jpg`, 'title' : 'Jugglers', 'desc' : 'Funny boys' },
                { 'image' : `${App.assets_url}/gallery/13.jpg`, 'title' : 'Clown John', 'desc' : 'Funny hocus-pocus' },
                { 'image' : `${App.assets_url}/gallery/14.jpg`, 'title' : 'Soaring', 'desc' : 'Two in the air' },
                { 'image' : `${App.assets_url}/gallery/15.jpg`, 'title' : 'Figure', 'desc' : 'Girls under the big top' },
                { 'image' : `${App.assets_url}/gallery/16.jpg`, 'title' : 'Python and Zhora', 'desc' : 'Dangerous performance' },
                { 'image' : `${App.assets_url}/gallery/17.jpg`, 'title' : 'Hippo with a ball', 'desc' : 'Woman with ball' },
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_title' : true,
            'show_image_desc' : true,
            'enable_fancybox' : true,
            'background' :'#FFFFFF',
            'title' : "Фото цирковых номеров",
            'title_2' : "Подзаголовок",
            'items' : [
                { 'image' : `${App.assets_url}/gallery/11.jpg`, 'title' : 'Клоун Жора', 'desc' : 'Смехун цирка №1' },
                { 'image' : `${App.assets_url}/gallery/12.jpg`, 'title' : 'Жонглёры', 'desc' : 'Весёлые ребята' },
                { 'image' : `${App.assets_url}/gallery/13.jpg`, 'title' : 'Клоун Клёва', 'desc' : 'Весёлые фокусы-покусы' },
                { 'image' : `${App.assets_url}/gallery/14.jpg`, 'title' : 'Парящие', 'desc' : 'Пара в воздухе' },
                { 'image' : `${App.assets_url}/gallery/15.jpg`, 'title' : 'Фигура', 'desc' : 'Девушки под куполом цирка' },
                { 'image' : `${App.assets_url}/gallery/16.jpg`, 'title' : 'Питон и Жора', 'desc' : 'Опасный номер' },
                { 'image' : `${App.assets_url}/gallery/17.jpg`, 'title' : 'Бегемотица с шаром', 'desc' : 'Капибара и женщина с шаром' },
            ]
        };
    }

    tpl_7(val) {
        return html`<div class="container-fluid gallery gallery_7" style="background: ${val.background};">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list ${(!val.show_image_title && !val.show_image_desc) ? 'no_opacity': '' }">
                            <${Repeater} name="items">${item_val => html`
                                <div class="img_double"> 
                                    <div class="img">
                                        <${OverlayImage} name="image_1" />	
                                    </div>
                                </div>
                                <div class="img_side">
                                    ${[2,3,4,5].map(i => html`
                                        <div class="img">
                                            <${OverlayImage} name=${"image_" + i} />
                                        </div>
                                    `)}
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_7() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Gallery circus",
            'title_2' : "Subtitle",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/30.jpg`, 'title' : 'Grace', 'desc' : 'Girl on the tape'},
                    'image_2' : {'image': `${App.assets_url}/gallery/22.jpg`, 'title' : 'Kite Bob', 'desc' : 'Bob is sitting on a barrel'},
                    'image_3' : {'image': `${App.assets_url}/gallery/21.jpg`, 'title' : 'Three people put the hats on', 'desc' : 'Acrobats on the ropes'},
                    'image_4' : {'image': `${App.assets_url}/gallery/25.jpg`, 'title' : 'Jumper', 'desc' : 'Show with the horse'},
                    'image_5' : {'image': `${App.assets_url}/gallery/28.jpg`, 'title' : 'Live time', 'desc' : 'Girls imitate watches'},
                }
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Галерея цирковых номеров",
            'title_2' : "Подзаголовок",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/30.jpg`, 'title' : 'Грация', 'desc' : 'Девушка на лентах'},
                    'image_2' : {'image': `${App.assets_url}/gallery/22.jpg`, 'title' : 'Коршун Веня', 'desc' : 'Веня сидит на бочке'},
                    'image_3' : {'image': `${App.assets_url}/gallery/21.jpg`, 'title' : 'Трое в шляпах', 'desc' : 'Акробаты на канатах'},
                    'image_4' : {'image': `${App.assets_url}/gallery/25.jpg`, 'title' : 'Прыгун', 'desc' : 'Номер с конём'},
                    'image_5' : {'image': `${App.assets_url}/gallery/28.jpg`, 'title' : 'Живое время', 'desc' : 'Девушки имитируют часы'},
                }
            ]
        };
    }

    tpl_8(val) {
        return html`<div class="container-fluid gallery gallery_8" style="background: ${val.background};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list clear ${(!val.show_image_title && !val.show_image_desc) ? 'no_opacity': '' }">
                            <${Repeater} name="items">${item_val => html`
                                <div class="img_side">
                                    <div class="img img_h2">
                                        <${OverlayImage} name="image_1" /> 
                                    </div>
                                    <div class="img">
                                        <${OverlayImage} name="image_2" /> 
                                    </div>
                                </div>
                                <div class="img_double">
                                    <div class="img img_w2">
                                        <${OverlayImage} name="image_3" /> 
                                    </div>
                                    <div class="img">
                                        <${OverlayImage} name="image_4" /> 
                                    </div>
                                    <div class="img">
                                        <${OverlayImage} name="image_5" />
                                    </div>
                                    <div class="img img_w2">
                                        <${OverlayImage} name="image_6" />
                                    </div>                                
                                </div>                            
                                <div style="clear: both"></div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_8() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Photos of our work",
            'title_2' : "Subtitle",
            'items' : [
                {
                    'image_1': {
                        'image': `${App.assets_url}/gallery/25.jpg`,
                        'title': 'Jumper',
                        'desc': 'Show with the horse'
                    },
                    'image_2': {
                        'image': `${App.assets_url}/gallery/26.jpg`,
                        'title': 'Lambada',
                        'desc': 'Dancing elephants'
                    },
                    'image_3': {
                        'image': `${App.assets_url}/gallery/30.jpg`,
                        'title': 'Grace',
                        'desc': 'The girl on the tape'
                    },
                    'image_4': {
                        'image': `${App.assets_url}/gallery/24.jpg`,
                        'title': 'Tusk',
                        'desc': 'Trained rhino'
                    },
                    'image_5': {
                        'image': `${App.assets_url}/gallery/21.jpg`,
                        'title': 'Three people put the hats on',
                        'desc': 'Acrobats on the ropes'
                    },
                    'image_6': {
                        'image': `${App.assets_url}/gallery/27.jpg`,
                        'title': 'Tigress',
                        'desc': 'It is the one on the left'
                    },
                },
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Фото нашей работы",
            'title_2' : "Подзаголовок",
            'items' : [
                {
                    'image_1': {
                        'image': `${App.assets_url}/gallery/25.jpg`,
                        'title': 'Прыгун',
                        'desc': 'Номер с конём'
                    },
                    'image_2': {
                        'image': `${App.assets_url}/gallery/26.jpg`,
                        'title': 'Ламбада',
                        'desc': 'Танцующие слоны'
                    },
                    'image_3': {
                        'image': `${App.assets_url}/gallery/30.jpg`,
                        'title': 'Грация',
                        'desc': 'Девушка на лентах'
                    },
                    'image_4': {
                        'image': `${App.assets_url}/gallery/24.jpg`,
                        'title': 'Бивень',
                        'desc': 'Дрессированный носорог'
                    },
                    'image_5': {
                        'image': `${App.assets_url}/gallery/21.jpg`,
                        'title': 'Трое в шляпах',
                        'desc': 'Акробаты на канатах'
                    },
                    'image_6': {
                        'image': `${App.assets_url}/gallery/27.jpg`,
                        'title': 'Тигрица',
                        'desc': 'Это та, что слева'
                    },
                },
            ]
        };
    }

    tpl_9(val) {
        return html`<div class="container-fluid gallery gallery_9" style="background: ${val.background};">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list clear ${(!val.show_image_title && !val.show_image_desc) ? 'no_opacity': '' }">
                            <${Repeater} name="items">${item_val => html`                    
                                <div class="img_double">
                                    <div class="img">
                                        <${OverlayImage} name="image_1" />
                                    </div>
                                </div>
                                <div class="img_side">
                                    <div>
                                        <div class="img img_w2">
                                            <${OverlayImage} name="image_2" />
                                        </div>
                                        <div class="img">
                                            <${OverlayImage} name="image_3" />
                                        </div>
                                        <div class="img">
                                            <${OverlayImage} name="image_4" />
                                        </div>  
                                    </div>                                  
                                </div>
                                <div class="img_left_bottom">
                                    <div class="img img_w2">
                                        <${OverlayImage} name="image_5" />
                                    </div>
                                </div>
                                <div class="img_right_bottom">
                                    <div class="img img_w3">
                                        <${OverlayImage} name="image_6" />
                                    </div>
                                </div>
                            `}<//>
                        </div>      
                    </div>              
                </div>
            </div>
        </div>
    `}

    tpl_default_9() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Gallery circus performances",
            'title_2' : "Subtitle",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/23.jpg`, 'title' : 'Leapfrog', 'desc' : 'People in blue trousers'},
                    'image_2' : {'image': `${App.assets_url}/gallery/28.jpg`, 'title' : 'Live time', 'desc' : 'Girls imitate watches'},
                    'image_3' : {'image': `${App.assets_url}/gallery/29.jpg`, 'title' : 'Moon', 'desc' : 'Flying people on the moon'},
                    'image_4' : {'image': `${App.assets_url}/gallery/30.jpg`, 'title' : 'Grace', 'desc' : 'The girl on the tape'},
                    'image_5' : {'image': `${App.assets_url}/gallery/21.jpg`, 'title' : 'Three people put the hats on', 'desc' : 'Acrobats on the ropes'},
                    'image_6' : {'image': `${App.assets_url}/gallery/22.jpg`, 'title' : 'Kite Bob', 'desc' : 'Bob is sitting on a barrel'},
                }
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Галерея цирковых выступлений",
            'title_2' : "Подзаголовок",
            'items' : [
                {
                    'image_1': {
                        'image': `${App.assets_url}/gallery/23.jpg`,
                        'title': 'Чехарда',
                        'desc': 'Люди в синих трениках'
                    },
                    'image_2': {
                        'image': `${App.assets_url}/gallery/28.jpg`,
                        'title': 'Живое время',
                        'desc': 'Девушки имитируют часы'
                    },
                    'image_3': {
                        'image': `${App.assets_url}/gallery/29.jpg`,
                        'title': 'Лунтики',
                        'desc': 'Полёт людей на луну'
                    },
                    'image_4': {
                        'image': `${App.assets_url}/gallery/30.jpg`,
                        'title': 'Грация',
                        'desc': 'Девушка на лентах'
                    },
                    'image_5': {
                        'image': `${App.assets_url}/gallery/21.jpg`,
                        'title': 'Трое в шляпах',
                        'desc': 'Акробаты на канатах'
                    },
                    'image_6': {
                        'image': `${App.assets_url}/gallery/22.jpg`,
                        'title': 'Коршун Веня',
                        'desc': 'Веня сидит на бочке'
                    },
                },
            ]
        };
    }

    tpl_10(val) {
        return html`<div class="container-fluid gallery gallery_10" style="background: ${val.background};">           
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${ val.show_title && html`
                            <h1 class="title">
                                <${Text} name="title" options=${Text.plain_heading} />
                            </h1>
                        `}
                        ${ val.show_title_2 && html`
                            <div class="title_2">
                                <${Text} name="title_2" options=${Text.plain_heading} />
                            </div>
                        `}
                        <div class="item_list clear ${(!val.show_image_title && !val.show_image_desc) ? 'no_opacity': '' }">
                            <${Repeater} name="items">${item_val => html`
                                <div class="img_side">
                                    <div class="img img_w1 img_h2">
                                        <${OverlayImage} name="image_1" />
                                    </div>
                                </div>
                                <div class="img_double">
                                    <div class="img img_w2">
                                    <${OverlayImage} name="image_2" />
                                    </div>
                                    <div class="img">
                                        <${OverlayImage} name="image_3" />
                                    </div>
                                    <div class="img">
                                        <${OverlayImage} name="image_4" />
                                    </div>
                                    <div class="img img_w2">
                                        <${OverlayImage} name="image_5" />
                                    </div>
                                </div>
                            `}<//>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_10() {
        return window.locale_lang=='en' ? {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Gallery",
            'title_2' : "Subtitle",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/21.jpg`, 'title' : 'Three people put the hats on', 'desc' : 'Acrobats on the ropes'},
                    'image_2' : {'image': `${App.assets_url}/gallery/22.jpg`, 'title' : 'Kite Bob', 'desc' : 'Bob is sitting on a barrel'},
                    'image_3' : {'image': `${App.assets_url}/gallery/23.jpg`, 'title' : 'Leapfrog', 'desc' : 'People in blue trousers'},
                    'image_4' : {'image': `${App.assets_url}/gallery/24.jpg`, 'title' : 'Tusk', 'desc' : 'Trained rhino'},
                    'image_5' : {'image': `${App.assets_url}/gallery/25.jpg`, 'title' : 'Jumper', 'desc' : 'Show with the horse'},
                    'image_6' : {'image': `${App.assets_url}/gallery/26.jpg`, 'title' : 'Lambada', 'desc' : 'Dancing elephants'},
                }
            ]
        } : {
            'show_title' : true,
            'show_title_2' : false,
            'show_image_desc' : true,
            'show_image_title' : true,
            'enable_fancybox' : true,
            'background' : '#FFFFFF',
            'title' : "Галерея",
            'title_2' : "Подзаголовок",
            'items' : [
                {
                    'image_1' : {'image': `${App.assets_url}/gallery/21.jpg`, 'title' : 'Трое в шляпах', 'desc' : 'Акробаты на канатах'},
                    'image_2' : {'image': `${App.assets_url}/gallery/22.jpg`, 'title' : 'Коршун Веня', 'desc' : 'Веня сидит на бочке'},
                    'image_3' : {'image': `${App.assets_url}/gallery/23.jpg`, 'title' : 'Чехарда', 'desc' : 'Люди в синих трениках'},
                    'image_4' : {'image': `${App.assets_url}/gallery/24.jpg`, 'title' : 'Бивень', 'desc' : 'Дрессированный носорог'},
                    'image_5' : {'image': `${App.assets_url}/gallery/25.jpg`, 'title' : 'Прыгун', 'desc' : 'Номер с конём'},
                    'image_6' : {'image': `${App.assets_url}/gallery/26.jpg`, 'title' : 'Ламбада', 'desc' : 'Танцующие слоны'},
                }
            ]
        };
    }
}

Block.register('Gallery',exports = Gallery);