require("./TextBlock.tea");

const {Block,Text,Icon,Repeater,Image,BlockColor,Switch,Dialog} = require("../../internal"); 

class TextBlock extends Block {
    
    static get title() { return _t('Text') }
    static get description() { return _t('Text blocks') }

    configForm() {
        return html`
            <${Dialog}> 
                <${Switch} name="show_title" label="${_t("Show first title")}" showWhen=${{variant:[1,2,3]}} />
                <${Switch} name="show_title_2" label="${_t("Show second title")}" showWhen=${{variant:[1,2,3]}} />
                <${Switch} name="show_list" label="${_t("Show list")}" showWhen=${{variant:[1]}} />
                <${Switch} name="show_name" label="${_t("Show name cell")}" showWhen=${{variant:[2]}} />
                <${Switch} name="show_text_title_2" label="${_t("Show second name")}" showWhen=${{variant:[4,6]}} />
                <${Switch} name="show_border" label="${_t("Show image border")}" showWhen=${{variant:[5,6]}} />
                <label>${_t('Background:')}</label>
                <${BlockColor} name="background_color" />
            <//>
        `;
    }

    tpl_1(val) {
        return html`
            <div class="container-fluid text_block text_block_1" style="background: ${val.background_color}">
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
                            <div class="text">
                                <${Text} name="text" options=${Text.color_text}/>  
                            </div>
                            ${val.show_list && html`
                                <div class="list_wrap row">
                                    <div class="list list_1 col-5 before-2">
                                        <${Text} name="list_1" options=${Text.plain_text}/>  
                                    </div>
                                    <div class="list list_2 col-5">
                                        <${Text} name="list_2" options=${Text.plain_text}/>  
                                    </div>
                                </div>
                            `}
                        </div>
                    </div>
                </div>
            </div>
        `
    }

    tpl_default_1() {
        return window.locale_lang == 'en' ? {
            show_title: true,
            show_title_2: true,
            show_list: false,
            background_color: '#FFFFFF',
            title: 'Circus program ',
            title_2: 'Created by the best experts over a beer',
            text: `Famous trained baboons are the stars of program. Baboons are very rare, endangered species of monkeys, which are sacred animals in Africa. However, they are brave predators and hunters, who are not afraid of attacking lions. And their stunning looks, shaggy mane, has become the purpose of  collectors hunting from around the world. The program performs a large number of animals. Such as trained Himalayan and brown bears, who ride motorcycles, bicycles and skateboards. Giant pythons and Nile crocodiles, dancing on the glass will surprise the audience.
                    Original performances with horses, performing acrobatic steps, will give the audience mood and smiles. Acrobatic triple flips, somersaults with a sack on the head in the darkness and live music will be remembered forever to the audience. You will be entranced by the work of two charming girls performing in a unique genre of juggling balls in the style of Argentine gauchos. Cheerful Clown are the unique example of a new trend of sparkling humor in the circus arts. Laughter will stand throughout the show!`,
            list_1: `<ul>
                        <li>Crocodiles</li>
                        <li>Hippos</li>
                        <li>Monkeys</li>
                        <li>Whales</li>
                    </ul>`,
            list_2: `<ul>
                        <li>Crocodiles</li>
                        <li>Hippos</li>
                        <li>Monkeys</li>
                        <li>Whales</li>
                    </ul>`,
        } : {
            show_title: true,
            show_title_2: true,
            show_list: false,
            background_color: '#FFFFFF',
            title: 'Программа цирка',
            title_2: 'Создана лучшими специалистами за кружечкой пива',
            text: `Звездами программы является знаменитые дрессированные гамадрилы-павианы. Гамадрилы очень редкий, исчезающий вид обезьян, которые являются священными животными в Африке. При этом они хищники и отважные охотники, которые даже не боятся нападать на львов. А их потрясающий внешний вид-мохнатая грива, давно стали предметом охоты коллекционеров со всего мира. В программе выступает большое количество животных. Это и дрессированные гималайские и бурые медведи, которые ездят на мотоциклах, велосипедах и скейтбордах. Гигантские питоны и нильские крокодилы, танцующий ногами на стеклах вызовет изумление публики.
                        Оригинальные номера с лошадьми, выполняющими конные скульптуры и акробатические па, подарят зрителям настроение и улыбки.Выполняемые акробатами тройные сальто, сальто с мешком на голове в полной темноте и живая музыка навсегда запомнятся зрителям. Вас заворожит работа двух очаровательных девушек, выступающих в уникальном жанре жонглирования шаров в стиле аргентинских гаучо. Веселый и неподражаемый клоун является образцом нового направления искрометного юмора в цирковом искусстве. Смех в зале будет стоять на протяжении всего представления!`,
            list_1: `<ul>
                        <li>Крокодилы</li>
                        <li>Бегемоты</li>
                        <li>Обезьяны</li>
                        <li>Кашалоты</li>
                    </ul>`,
            list_2: `<ul>
                        <li>Крокодилы</li>
                        <li>Бегемоты</li>
                        <li>Обезьяны</li>
                        <li>Кашалоты</li>
                    </ul>`,
        }
    }

    tpl_2(val) {
        return html`
          <div class="container-fluid text_block text_block_2" style="background:${val.background_color};">
            <div class="container">
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
                    <${Repeater} name="items">
                        ${item => html` 
                            <div class="row">
                                ${[1, 2].map(i => {
                                    return html`
                                        <div class="item col-6">
                                        ${val.show_name && html`
                                                <div class="name">
                                                <${Text} name="name_${i}" options=${Text.default_text}/>
                                                </div>
                                        `}
                                            <div class="desc">
                                                <${Text} name="desc_${i}" options=${Text.plain_heading}/> 
                                            </div>
                                        </div>
                                    `
                                })}
                            </div> 
                        `}
                    <//>
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
            background_color: '#FFFFFF',
            title: 'Description of the best performances',
            title_2: 'Subtitle',
            items: [
                {
                    name_1: 'Acrobat acrobatic',
                    desc_1: 'It is a miracle of nature only in our circus. Hurry, do not miss it! These include funny stories from Chappy.',
                    name_2: 'Talking bisons',
                    desc_2: 'Unfortunately, out of stock. But dancing heifers, we do provide. This performance is suggested to watch from 3+.',
                },
                {
                    name_1: 'Coto-moto',
                    desc_1: 'Dancing Cat on a motorcycle is able to enchant any audience with his dance. You will  indeed smile!',
                    name_2: 'Zingaresca',
                    desc_2: 'Bear Baiyun and poodles will dance famous dance "Gipsy". Seeing this once - will remember forever!',
                },
            ],
        } : {
            show_title: true,
            show_title_2: false,
            show_name: true,
            background_color: '#FFFFFF',
            title: 'Описание лучших номеров',
            title_2: 'Подзаголовок блока',
            items: [
                {
                    name_1: 'Акробатический акробат',
                    desc_1: 'Это чудо природы только в нашем цирке. Спешите, не пропустите! К ним прилагается смешные истории от клоуна Чаппи.',
                    name_2: 'Говорящие бизоны',
                    desc_2: 'К сожалению, уже закончились. А вот танцующих тёлочек-бурёнок мы Вам обеспечим. Этот номер советуем смотреть от 3+.',
                },
                {
                    name_1: 'Кото-мот',
                    desc_1: 'Танцующий кот на мотоцикле способен заворожить своим танцем любого зрителя. Без улыбок Вы не останетесь!',
                    name_2: 'Цыганочка с выходом',
                    desc_2: 'Медведь Баюн и отряд пуделей задорно станцуют вам известный танец "цыганочка". Увидев это однажды - запомнишь навсегда!',
                },
            ],
        }
    }

    tpl_3(val) {
        return html`
            <div class="container-fluid text_block text_block_3" style="background:${val.background_color};">
                <div class="container">
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
                                ${[1, 2, 3].map(i => {
                                    return html`
                                        <div class="item col-4">
                                            <div class="name">
                                                <${Text} name="name_${i}" options=${Text.plain_heading}/> 
                                            </div>
                                            <div class="desc">
                                                <${Text} name="desc_${i}" options=${Text.default_text}/> 
                                            </div>
                                        </div> 
                                    `
                                })} 
                            </div>  
                        `}<//>
                    </div>
                </div>
            </div>
        `
    }


    tpl_default_3() {
        return window.locale_lang == 'en' ? {
            show_title: true,
            show_title_2: true,
            background_color: '#FFFFFF',
            title: 'The best performance for you',
            title_2: 'Subtitle',
            items: [
                {
                    name_1: 'Tomcats',
                    desc_1: 'The extraordinary repertoire of this remarkable duet is able to cheer even avid phlegmatic. Their show "howling at the moon" will stop your ears.',
                    name_2: 'Thorny needles',
                    desc_2: 'You think hedgehogs? Have another think coming! We have African porcupines, and our  favorite tomcats will accompany them.',
                    name_3: 'Hocus Pocus',
                    desc_3: 'Magician from distant countries Funtik Alibaba Zuckerman will surprise you with his skillful hands and the power of thought. Come and see for yourself!',
                }
            ]
        } : {
            show_title: true,
            show_title_2: true,
            background_color: '#FFFFFF',
            title: 'Лучшие представления для Вас',
            title_2: 'Подзаголовок блока',
            items: [
                {
                    name_1: 'Мартовские коты',
                    desc_1: 'Своим незаурядным репертуаром этот замечательный дует способен взбодрить даже заядлых флегматиков. А их номер "Вою на луну" заставит Вас заткнуть уши.',
                    name_2: 'Колючие иголки',
                    desc_2: 'Думаете ёжики? А вот и не угадали! Только у нас для вас выступят африканские дикобразы, а аккомпанировать им будет всеми любимый дует "Мартовские коты".',
                    name_3: 'Фокус-покус',
                    desc_3: 'Маг и волшебник из далекого зарубежья Фунтик Алибаба Цукерман удивит вас своими умелыми руками и силой мысли. Приходите и убедитесь в этом сами!',
                }
            ]
        }
    }

    tpl_4(val) {
        return html`
        <div class="container-fluid text_block text_block_4" style="background:${val.background_color};">
            <div class="container">
                <div class="item_list clear">
                    <${Repeater} name="items">${item => html`   
                        <div class="row">
                            <div class="image_wrap col-6"> 
                                <${Image} name="image"/>
                            </div>
                            <div class="text_wrap col-6">
                                <div class="text_title"> 
                                    <${Text} name="text_title" options=${Text.plain_heading}/>
                                </div> 
                                ${val.show_text_title_2 && html`
                                    <div class="text_title_2">
                                        <${Text} name="text_title_2" options=${Text.color_text}/> 
                                    </div>
                                `}
                                <div class="text">
                                    <${Text} name="text" options=${Text.default_text}/>
                                </div>                            
                            </div>
                        </div>
                    `}<//>
                </div>
            </div>
        </div>
        `
    }

    tpl_default_4() {
        return window.locale_lang == 'en' ? {
            show_text_title_2: true,
            background_color: '#FFFFFF',
            items: [
                {
                    text_title: 'Madagascar quartet',
                    text_title_2: 'Crying with laughter',
                    text: `<div>Super quartet insludes lion, giraffe, hippo and zebra will become for you a sensation. Pets balance-masters will flutter under the big top, giving you incomparable emotions.</div>
                        <br>
                        <div>
                            - Great story<br>
                            - Super suits<br>
                            - And others<br>
                        </div> `,
                    image: `${App.assets_url}/text/3.jpg`,
                }
            ]
        } : {
            show_text_title_2: true,
            background_color: '#FFFFFF',
            items: [
                {
                    text_title: 'Мадагаскарская четвёрка',
                    text_title_2: 'Плачь от смеха',
                    text: `<div>Супер четвёрка в составе льва, жирафа, бегемота и зебры станут для вас сенсацией. Животные эквилибристы будут порхать под куполом цирка, даря вам несравненные ни с чем эмоции.</div>
                                <br>
                                <div>
                                    - Отличный сюжет<br>
                                    - Супер костюмы<br>
                                    - Да и всё остальное тоже<br>
                                </div>`,
                    image: `${App.assets_url}/text/3.jpg`,
                }
            ]
        }
    }

    tpl_5(val) {
        return html`
                <div class="container-fluid text_block text_block_5" style="background:${val.background_color}">
            <div class="container">
                <div class="item_list clear ${!val.show_border ? 'hide_border' : ''}">                       
                    <${Repeater} name="items">${item => html`  
                        <div class="row">
                            <div class="image_wrap col-3">
                                <${Image} name="image"/>
                            </div>
                            <div class="text_wrap col-9">
                                <div class="text_title"> 
                                    <${Text} name="text_title" options=${Text.plain_heading}/>
                                </div>
                                <div class="text">
                                    <${Text} name="text" options=${Text.default_text}/>
                                </div>
                            </div>         
                        </div>
                     `}<//>
                </div>
            </div>
        </div>
        `
    }

    tpl_default_5() {
        return window.locale_lang == 'en' ? {
            show_border: true,
            background_color: '#FFFFFF',
            items: [
                {
                    text_title: 'Hocus Pocus',
                    text: `<div> Magician from distant countries will surprise you with his skillful hands and the power of thought. Come and see for yourself!</div>
                        <br> <div> - Mystique<br> - Magic<br> - And wonder<br> </div>`,
                    image: `${App.assets_url}/text/1.jpg`,
                },
                {
                    text_title: 'the Little Humpbacked Horse',
                    text: `<div>The Arabian horses, running around the arena, take you into the prairie! You are guaranteed emotional decompensation!</div>
                    <br><div>- Dynamics<br>  - Diversity of colors<br> - Entertainment<br></div>`,
                    image: `${App.assets_url}/text/2.jpg`,
                }]
        } : {
            show_border: true,
            background_color: '#FFFFFF',
            items: [
                {
                    text_title: 'Фокус-покус',
                    text: `<div>Маг и волшебник из далекого зарубежья удивит вас своими умелыми руками и силой мысли. Приходите и убедитесь в этом сами!</div>
                        <br> <div> - Таинственность<br> - Магия<br> - И Удивление<br></div>`,
                    image: `${App.assets_url}/text/1.jpg`,
                },
                {
                    text_title: 'Конёк-горбунок',
                    text: ` <div>Табун арабских скакунов, пробежав галопом по арене, перенесет вас в прерию! Эмоциональный взрыв вам гарантирован!</div>
                        <br> <div> - Динамика<br> - Пестрота<br> - Зрелищность<br> </div>`,
                    image: `${App.assets_url}/text/2.jpg`,
                }
            ]
        }
    }

    tpl_6(val) {
        return html`
        <div class="container-fluid text_block text_block_6" style="background:${val.background_color};">
            <div class="container">
                <div class="row">
                    <div class="text_data col-6">
                        <h1 class="title">
                            <${Text} name="title" options=${Text.plain_heading}/>
                        </h1>
                        ${val.show_text_title_2 && html`
                            <div class="title_2"> 
                                <${Text} name="title_2" options=${Text.color_text}/>
                            </div>
                         `}
                        <div class="text">
                            <${Text} name="text" options=${Text.default_text}/>
                        </div>
                    </div>
                    <div class="ico_data col-6">
                        <div class="item_list clear ${!val.show_border ? 'hide_border' : ''}">
                            <${Repeater} name="items">${item => html` 
                                <div class="item">
                                    <${Icon} name="icon"/>
                                    <div class="name">
                                        <${Text} name="name" options=${Text.plain_heading}/> 
                                    </div>
                                    <div class="desc">
                                        <${Text} name="desc" options=${Text.default_text}/>                          
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

    tpl_default_6() {
        return window.locale_lang == 'en' ? {
            show_text_title_2: true,
            show_border: true,
            background_color: '#FFFFFF',
            title: 'CIRCUS',
            title_2: 'Short summary',
            text: 'Circus is that place where the adults become happy like the kids. Here, serious men and women can not resist laughter, welcoming trained animals in the circus arena. Unaffected joy is also mentioned here ... We present you the opportunity to plunge into the world of smiles, surprise and delight!',
            items: [
                {
                    name: 'Amusement',
                    desc: 'We have the funny presentation for each taste and age.',
                    icon: `${App.assets_url}/ico/77.png`,
                },
                {
                    name: 'Gladness',
                    desc: "Pants are full of joy for all visitors. Come, you won't regret it.",
                    icon: `${App.assets_url}/ico/89.png`,
                },
                {
                    name: 'Laughter',
                    desc: 'You will laugh your head off. You are welcome!',
                    icon: `${App.assets_url}/ico/127.png`,
                }
            ],
        } : {
            show_text_title_2: true,
            show_border: true,
            background_color: '#FFFFFF',
            title: 'Цирк',
            title_2: 'Краткое описание',
            text: `Цирк - это то самое место, где взрослые снова становятся счастливыми детьми. Здесь серьезные мужчины и уважаемые женщины не сдерживают смеха, приветствуя дрессированных животных на манеже. Здесь упоминается и чистая, искренняя радость, которой мы сияли в детстве... 
                        Представляем Вам возможность снова окунуться в мир улыбок, удивление и восторга! `,
            items: [
                {
                    name: 'Веселье',
                    desc: 'Только у нас самые весёлые представления на любой вкус и возраст.',
                    icon: `${App.assets_url}/ico/77.png`,
                },
                {
                    name: 'Радость',
                    desc: 'Полные штаны радости всем посетителям обеспечено. Приходите, не пожалеете.',
                    icon: `${App.assets_url}/ico/89.png`,
                },
                {
                    name: 'Смех',
                    desc: 'Надрывать живот от смеха гарантировано всем. Ждем Вас в гости.',
                    icon: `${App.assets_url}/ico/127.png`,
                }
            ],
        }
    } 
}

Block.register('TextBlock',exports = TextBlock);