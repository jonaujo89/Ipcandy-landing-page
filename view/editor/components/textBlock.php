<?php

namespace LPCandy\Components;

class TextBlock extends Block {
    public $name;
    public $description;
    public $editor = "lp.textBlock";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Text';
            $this->description = "Text blocks";
        } else {
            $this->name = 'Текст';
            $this->description = "Текстовые блоки";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid text_block text_block_1" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_text) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="text">
                        <? $this->sub('Text','text',Text::$color_text) ?>
                    </div>
                    <? if ($cls = $this->vis($val['show_list'])): ?>
                        <div class="list_wrap clear <?=$cls?>">
                            <div class="list list_1">
                                <? $this->sub('Text','list_1',Text::$plain_text) ?>
                            </div>
                            <div class="list list_2">
                                <? $this->sub('Text','list_2',Text::$plain_text) ?>
                            </div>
                        </div>
                    <? endif ?>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => true,
            'show_list' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Circus program ',
            'title_2' => 'Created by the best experts over a beer',
            'text' => 'Famous trained baboons are the stars of program. Baboons are very rare, endangered species of monkeys, which are sacred animals in Africa. However, they are brave predators and hunters, who are not afraid of attacking lions. And their stunning looks, shaggy mane, has become the purpose of  collectors hunting from around the world. The program performs a large number of animals. Such as trained Himalayan and brown bears, who ride motorcycles, bicycles and skateboards. Giant pythons and Nile crocodiles, dancing on the glass will surprise the audience. 
                       Original performances with horses, performing acrobatic steps, will give the audience mood and smiles. Acrobatic triple flips, somersaults with a sack on the head in the darkness and live music will be remembered forever to the audience. You will be entranced by the work of two charming girls performing in a unique genre of juggling balls in the style of Argentine gauchos. Cheerful Clown are the unique example of a new trend of sparkling humor in the circus arts. Laughter will stand throughout the show!',          
            'list_1' => '<ul>                    
                            <li>Crocodiles</li>                    
                            <li>Hippos</li>                    
                            <li>Monkeys</li>                    
                            <li>Whales</li>                    
                         </ul>',
            'list_2' => '<ul>                    
                            <li>Crocodiles</li>                    
                            <li>Hippos</li>                    
                            <li>Monkeys</li>                    
                            <li>Whales</li>                   
                         </ul>',
        ] : [
            'show_title' => true,
            'show_title_2' => true,
            'show_list' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Программа цирка',
            'title_2' => 'Создана лучшими специалистами за кружечкой пива',
            'text' => 'Звездами программы является знаменитые дрессированные гамадрилы-павианы. Гамадрилы очень редкий, исчезающий вид обезьян, которые являются священными животными в Африке. При этом они хищники и отважные охотники, которые даже не боятся нападать на львов. А их потрясающий внешний вид-мохнатая грива, давно стали предметом охоты коллекционеров со всего мира. В программе выступает большое количество животных. Это и дрессированные гималайские и бурые медведи, которые ездят на мотоциклах, велосипедах и скейтбордах. Гигантские питоны и нильские крокодилы, танцующий ногами на стеклах вызовет изумление публики.
                       Оригинальные номера с лошадьми, выполняющими конные скульптуры и акробатические па, подарят зрителям настроение и улыбки.Выполняемые акробатами тройные сальто, сальто с мешком на голове в полной темноте и живая музыка навсегда запомнятся зрителям. Вас заворожит работа двух очаровательных девушек, выступающих в уникальном жанре жонглирования шаров в стиле аргентинских гаучо. Веселый и неподражаемый клоун является образцом нового направления искрометного юмора в цирковом искусстве. Смех в зале будет стоять на протяжении всего представления!',
            'list_1' => '<ul>                    
                            <li>Крокодилы</li>                    
                            <li>Бегемоты</li>                    
                            <li>Обезьяны</li>                    
                            <li>Кашалоты</li>                    
                         </ul>',
            'list_2' => '<ul>                    
                            <li>Крокодилы</li>                    
                            <li>Бегемоты</li>                    
                            <li>Обезьяны</li>                    
                            <li>Кашалоты</li>                   
                         </ul>',
        ];
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid text_block text_block_2" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_text) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self) { ?>
                            <? for ($i=1;$i<=2;$i++): ?>
                                <div class="item">
                                    <? if ($cls = $self->vis($val['show_name'])): ?>
                                        <div class="name <?=$cls?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                    <? endif ?>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_'.$i,Text::$default_text)?>
                                    </div>
                                </div>
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'background_color' => '#FFFFFF',
            'title' => 'Description of the best performances',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'name_1' => 'Acrobat acrobatic',
                    'desc_1' => 'It is a miracle of nature only in our circus. Hurry, do not miss it! These include funny stories from Chappy.',
                    'name_2' => 'Talking bisons',
                    'desc_2' => 'Unfortunately, out of stock. But dancing heifers, we do provide. This performance is suggested to watch from 3+.',
                ),
                array(
                    'name_1' => 'Coto-moto',
                    'desc_1' => 'Dancing Cat on a motorcycle is able to enchant any audience with his dance. You will  indeed smile!',
                    'name_2' => 'Zingaresca',
                    'desc_2' => 'Bear Baiyun and poodles will dance famous dance "Gipsy". Seeing this once - will remember forever!',
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'background_color' => '#FFFFFF',
            'title' => 'Описание лучших номеров',
            'title_2' => 'Подзаголовок блока',
            'items' => array(
                array(
                    'name_1' => 'Акробатический акробат',
                    'desc_1' => 'Это чудо природы только в нашем цирке. Спешите, не пропустите! К ним прилагается смешные истории от клоуна Чаппи.',
                    'name_2' => 'Говорящие бизоны',
                    'desc_2' => 'К сожалению, уже закончились. А вот танцующих тёлочек-бурёнок мы Вам обеспечим. Этот номер советуем смотреть от 3+.',
                ),
                array(
                    'name_1' => 'Кото-мот',
                    'desc_1' => 'Танцующий кот на мотоцикле способен заворожить своим танцем любого зрителя. Без улыбок Вы не останетесь!',
                    'name_2' => 'Цыганочка с выходом',
                    'desc_2' => 'Медведь Баюн и отряд пуделей задорно станцуют вам известный танец "цыганочка". Увидев это однажды - запомнишь навсегда!',
                )
            )
        ];
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid text_block text_block_3" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_text) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">                        
                        <? $this->repeat('items',function($val,$self){ ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_'.$i,Text::$default_text)?>
                                    </div>
                                </div>
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => true,
            'background_color' => '#FFFFFF',
            'title' => 'The best performance for you',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                'name_1' => 'Tomcats',
                'desc_1' => 'The extraordinary repertoire of this remarkable duet is able to cheer even avid phlegmatic. Their show "howling at the moon" will stop your ears.',
                'name_2' => 'Thorny needles',
                'desc_2' => 'You think hedgehogs? Have another think coming! We have African porcupines, and our  favorite tomcats will accompany them.',
                'name_3' => 'Hocus Pocus',
                'desc_3' => 'Magician from distant countries Funtik Alibaba Zuckerman will surprise you with his skillful hands and the power of thought. Come and see for yourself!',
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => true,
            'background_color' => '#FFFFFF',
            'title' => 'Лучшие предстваления для Вас',
            'title_2' => 'Подзаголовок блока',
            'items' => array(
                array(
                'name_1' => 'Мартовские коты',
                'desc_1' => 'Своим незаурядным репертуаром этот замечательный дует способен взбодрить даже заядлых флегматиков. А их номер "Вою на луну" заставит Вас заткнуть уши.',
                'name_2' => 'Колючие иголки',
                'desc_2' => 'Думаете ёжики? А вот и не угадали! Только у нас для вас выступят африканские дикобразы, а аккомпанировать им будет всеми любимый дует "Мартовские коты".',
                'name_3' => 'Фокус-покус',
                'desc_3' => 'Маг и волшебник из далекого зарубежья Фунтик Алибаба Цукерман удивит вас своими умелыми руками и силой мысли. Приходите и убедитесь в этом сами!',
                )
            )
        ];
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid text_block text_block_4" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                            <?=$self->sub('Image','image')?>
                            <div class="text_wrap">
                                <div class="text_title">
                                    <?=$self->sub('Text','text_title',Text::$plain_heading)?>
                                </div> 
                                <? if ($cls = $self->vis($val['show_text_title_2'])): ?>
                                    <div class="text_title_2 <?=$cls?>" >
                                        <? $self->sub('Text','text_title_2',Text::$color_text) ?>
                                    </div>
                                <? endif ?>
                                <div class="text">
                                    <?=$self->sub('Text','text',Text::$default_text)?>
                                </div>                            
                            </div>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return self::$en ? [
            'show_text_title_2' => true,
            'background_color' => '#FFFFFF',
            'items' => array(
                array(
                    'text_title' => 'Madagascar quartet',
                    'text_title_2' => 'Crying with laughter',
                    'text' => ' <div>Super quartet insludes lion, giraffe, hippo and zebra will become for you a sensation. Pets balance-masters will flutter under the big top, giving you incomparable emotions.</div>
                                <br>
                                <div>
                                    - Great story<br>
                                    - Super suits<br>
                                    - And others<br>
                                </div>',
                    'image' => Configuration::$assets_url.'/text/3.jpg',
                )
            )
        ] : [
            'show_text_title_2' => true,
            'background_color' => '#FFFFFF',
            'items' => array(
                array(
                    'text_title' => 'Мадагаскарская четвёрка',
                    'text_title_2' => 'Плачь от смеха',
                    'text' => ' <div>Супер четвёрка в составе льва, жирафа, бегемота и зебры станут для вас сенсацией. Животные эквилибристы будут порхать под куполом цирка, даря вам несравненные ни с чем эмоции.</div>
                                <br>
                                <div>
                                    - Отличный сюжет<br>
                                    - Супер костюмы<br>
                                    - Да и всё остальное тоже<br>
                                </div>',
                    'image' => Configuration::$assets_url.'/text/3.jpg',
                )
            )
        ];
    }
    
        
    function tpl_5($val) {?>
        <div class="container-fluid text_block text_block_5" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="item_list clear <?= $val['show_border'] ? "" : "hide_border" ?>">                       
                        <? $this->repeat('items',function($val,$self){ ?>
                            <?=$self->sub('Image','image')?>
                            <div class="text_wrap">
                                <div class="text_title">
                                    <?=$self->sub('Text','text_title',Text::$plain_heading)?>
                                </div>
                                <div class="text">
                                    <?=$self->sub('Text','text',Text::$default_text)?>
                                </div>
                            </div>               
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_5() { 
        return self::$en ? [
            'show_border' => true,
            'background_color' => '#FFFFFF',
            'items' => array(
                array(
                    'text_title' => 'Hocus Pocus',
                    'text' => ' <div> Magician from distant countries will surprise you with his skillful hands and the power of thought. Come and see for yourself!</div>
                                <br>
                                <div>
                                    - Mystique<br>
                                    - Magic<br>
                                    - And wonder<br>
                                </div>',
                    'image' => Configuration::$assets_url.'/text/1.jpg',
                ),
                array(
                    'text_title' => 'the Little Humpbacked Horse',
                    'text' => ' <div>The Arabian horses, running around the arena, take you into the prairie! You are guaranteed emotional decompensation!</div>
                                <br>
                                <div>
                                    - Dynamics<br>
                                    - Diversity of colors<br>
                                    - Entertainment<br>
                                </div>',
                    'image' => Configuration::$assets_url.'/text/2.jpg',
                )
            )
        ] : [
            'show_border' => true,
            'background_color' => '#FFFFFF',
            'items' => array(
                array(
                    'text_title' => 'Фокус-покус',
                    'text' => ' <div>Маг и волшебник из далекого зарубежья удивит вас своими умелыми руками и силой мысли. Приходите и убедитесь в этом сами!</div>
                                <br>
                                <div>
                                    - Таинственность<br>
                                    - Магия<br>
                                    - И Удивление<br>
                                </div>',
                    'image' => Configuration::$assets_url.'/text/1.jpg',
                ),
                array(
                    'text_title' => 'Конёк-горбунок',
                    'text' => ' <div>Табун арабских скакунов, пробежав галопом по арене, перенесет вас в прерию! Эмоциональный взрыв вам гарантирован!</div>
                                <br>
                                <div>
                                    - Динамика<br>
                                    - Пестрота<br>
                                    - Зрелищность<br>
                                </div>',
                    'image' => Configuration::$assets_url.'/text/2.jpg',
                )
            )
        ];
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid text_block text_block_6" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16 clear">
                    <div class="text_data">
                        <h1 class="title">
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                        <? if ($cls = $this->vis($val['show_text_title_2'])): ?>
                            <div class="title_2 <?=$cls?>" >
                                <? $this->sub('Text','title_2',Text::$color_text) ?>
                            </div>
                        <? endif ?> 
                        <div class="text">
                            <? $this->sub('Text','text',Text::$default_text) ?>
                        </div>
                    </div>
                    <div class="ico_data">
                        <div class="item_list clear <?= $val['show_border'] ? "" : "hide_border" ?>">
                            <? $this->repeat('items',function($val,$self){ ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon')?>
                                    <div class="name">
                                        <?=$self->sub('Text','name',Text::$plain_heading)?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc',Text::$default_text)?>                            
                                    </div>                        
                                </div>
                            <? }) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_6() { 
        return self::$en ? [
            'show_text_title_2' => true,
			'show_border' => true,
			'background_color' => '#FFFFFF',
			'title' => 'CIRCUS',
			'title_2' => 'Short summary',
			'text' => 'Circus is that place where the adults become happy like the kids. Here, serious men and women can not resist laughter, welcoming trained animals in the circus arena. Unaffected joy is also mentioned here ... We present you the opportunity to plunge into the world of smiles, surprise and delight!',
			'items' => array(
				array(
					'name' => 'Amusement',
					'desc' => 'We have the funny presentation for each taste and age.',
					'icon' => Configuration::$assets_url.'/ico/77.png',
				),
				array(                
					'name' => 'Gladness',
					'desc' => "Pants are full of joy for all visitors. Come, you won't regret it.",
					'icon' => Configuration::$assets_url.'/ico/89.png',
				),
				array(
					'name' => 'Laughter',
					'desc' => 'You will laugh your head off. You are welcome!',
					'icon' => Configuration::$assets_url.'/ico/127.png',
					)
             ),
        ] : [
            'show_text_title_2' => true,
			'show_border' => true,
			'background_color' => '#FFFFFF',
			'title' => 'Цирк',
			'title_2' => 'Краткое описание',
			'text' => 'Цирк - это то самое место, где взрослые снова становятся счастливыми детьми. Здесь серьезные мужчины и уважаемые женщины не сдерживают смеха, приветствуя дрессированных животных на манеже. Здесь упоминается и чистая, искренняя радость, которой мы сияли в детстве... 
                       Представляем Вам возможность снова окунуться в мир улыбок, удивление и восторга! ',
			'items' => array(
				array(
					'name' => 'Веселье',
					'desc' => 'Только у нас самые весёлые представления на любой вкус и возраст.',
					'icon' => Configuration::$assets_url.'/ico/77.png',
				),
				array(                
					'name' => 'Радость',
					'desc' => 'Полные штаны радости всем посетителям обеспечено. Приходите, не пожалеете.',
					'icon' => Configuration::$assets_url.'/ico/89.png',
				),
				array(
					'name' => 'Смех',
					'desc' => 'Надрывать живот от смеха гарантировано всем. Ждем Вас в гости.',
					'icon' => Configuration::$assets_url.'/ico/127.png',
					)
             ),
        ];
    }   
}
