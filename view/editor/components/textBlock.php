<?php

class TextBlock extends Block {
    public $name = 'Текст';
    public $description = "Текстовые блоки";
    public $editor = "lp.textBlock";
    
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
        return  array(
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
                            <li>Бегомоты</li>                    
                            <li>Обезьяны</li>                    
                            <li>Кашалоты</li>                    
                         </ul>',
            'list_2' => '<ul>                    
                            <li>Крокодилы</li>                    
                            <li>Бегомоты</li>                    
                            <li>Обезьяны</li>                    
                            <li>Кашалоты</li>                   
                         </ul>',
        );
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
                        <? $this->repeat('items',function($val,$self) use ($val){ ?>
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
        return  array(
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
                    'name_2' => 'Циганочка с выходом',
                    'desc_2' => 'Медведь Баюн и отряд пуделей задорно станцуют вам известный танец "цыганочка". Увидев это однажды - запомнишь навсегда!',
                )
            )          
        );
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
        return  array(
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
                'desc_2' => 'Думаете ёжики? А вот и нет, не угадали! Только у нас и только сегодня выступят для вас африканские дикобразы, а аккомпанировать им будет всеми любимый дует "Мартовские коты".',
                'name_3' => 'Фокус-покус',
                'desc_3' => 'Маг и волшебник из далекого зарубежья Фунтик Алибаба Цукерман удивит вас своими умелыми руками и силой мысли. Приходите и убедитесь в этом сами!',
                )
            )          
        );
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
        return  array(
            'show_text_title_2' => true,
            'background_color' => '#FFFFFF',
            'items' => array(
                array(
                    'text_title' => 'Мадагаскарская четверка',
                    'text_title_2' => 'Плачь от смеха',
                    'text' => ' <div>Супер четверка в составе льва, жира, бегемота и зебры станут для вас сенсацией. Животные эквилибристы будут порхать под куполом цирка, даря вам несравненные ни с чем эмоции.</div>
                                <br>
                                <div>
                                    - Отличный сюжет<br>
                                    - Супер костюмы<br>
                                    - Да и тоже<br>
                                </div>',
                    'image' => 'view/editor/assets/text/3.jpg',
                )
            )
        );
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
        return  array(
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
                    'image' => 'view/editor/assets/text/1.jpg',
                ),
                array(
                    'text_title' => 'Конек-горбунок',
                    'text' => ' <div>Табун арабских скакунов, пробежав галопом по арене, перенесет вас в прерию! Эмоциональный взрыв вам гарантирован!</div>
                                <br>
                                <div>
                                    - Динамика<br>
                                    - Пестрота<br>
                                    - Зрелищность<br>
                                </div>',
                    'image' => 'view/editor/assets/text/2.jpg',
                )
            )
        );
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
        return  array(
			'show_text_title_2' => true,
			'show_border' => true,
			'background_color' => '#FFFFFF',
			'title' => 'Текст с иконками',
			'title_2' => 'Подзаголовок блока совсем небольшой',
			'text' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
			'items' => array(
				array(
					'name' => 'Текст с хорошей иконкой',
					'desc' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
					'icon' => 'view/editor/assets/ico/77.png',
				),
				array(                
					'name' => 'Текст с хорошей иконкой',
					'desc' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
					'icon' => 'view/editor/assets/ico/89.png',
				),
				array(
					'name' => 'Текст с хорошей иконкой',
					'desc' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
					'icon' => 'view/editor/assets/ico/127.png',
					)
				),

        );
    }   
}

TextBlock::register();