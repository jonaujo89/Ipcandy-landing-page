<?php

class TextBlock extends Block {
    public $name = 'Text';
    public $description = "Text blocks";
    
    function tpl($val) {?>
        <div class="container-fluid text text1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>
                    <div class="text">
                        <? $this->sub('Text','text') ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => 'Заголовок текстового блока',
            'title_2' => 'Подзаголовок блока совсем небольшой',
            'text' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Постарайтесь, у вас должен получиться шедевральный лендос.',
        );
    }

    
    
    function tpl_2($val) {?>
        <div class="container-fluid text text2" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title"><? $this->sub('Text','title') ?></h1>

                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_2')?>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => 'Заголовок текстового блока',
            'items' => array(
                array(
                'name_1' => 'Информационное сопровождение',
                'desc_1' => 'Коротко опишите, что вас отличает от конкурентов, причины по которым должны довериться именно вам. Что вы даете такого ценного, чего нет на рынке. С какими проблемами не сталкнется ваш потенциальный клиент, если выберет вас.',
                'name_2' => 'Точный расчет стоимости',
                'desc_2' => 'Коротко опишите, что вас отличает от конкурентов, причины по которым должны довериться именно вам. Что вы даете такого ценного, чего нет на рынке. С какими проблемами не сталкнется ваш потенциальный клиент, если выберет вас.',
                )
            )          
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid text text3" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>

                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>

                    <div class="item_list clear">
                        
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_2')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_3')?>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? }) ?>                        

                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => 'Заголовок текстового блока',
            'title_2' => 'Подзаголовок блока совсем небольшой',
            'items' => array(
                array(
                'name_1' => 'Информационное сопровождение',
                'desc_1' => 'Коротко опишите, что вас отличает от конкурентов, причины по которым должны довериться именно вам. Что вы даете такого ценного, чего нет на рынке. С какими проблемами не сталкнется ваш потенциальный клиент, если выберет вас.',
                'name_2' => 'Точный расчет стоимости',
                'desc_2' => 'Коротко опишите, что вас отличает от конкурентов, причины по которым должны довериться именно вам. Что вы даете такого ценного, чего нет на рынке. С какими проблемами не сталкнется ваш потенциальный клиент, если выберет вас.',
                'name_3' => 'Информационное сопровождение',
                'desc_3' => 'Коротко опишите, что вас отличает от конкурентов, причины по которым должны довериться именно вам. Что вы даете такого ценного, чего нет на рынке. С какими проблемами не сталкнется ваш потенциальный клиент, если выберет вас.',
                )
            )          
        );
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid text text4" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear editor_hide_remove">
                                <div class="img">
                                    <?=$self->sub('ImageSrc','img_1')?>
                                </div>
                                <div class="text_wrap">
                                    <div class="text_title">
                                        <?=$self->sub('Text','text_title')?>
                                    </div> 
                                    <div class="text_title_2">
                                        <?=$self->sub('Text','text_title_2')?>
                                    </div>
                                    <div class="text">
                                        <?=$self->sub('Text','text')?>
                                    </div>                            
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
        'bg_color' => '#F7F7F7',
        'items' => array(
            array(
                'text_title' => 'Несколько моментов с конференции',
                'text_title_2' => 'Информационные технологии 2014',
                'text' => ' <div>Мы показали все самое новое, красивое и восстребованное. Встреча никого не оставила равнодушным, все были довольны развитием событий. Наше устройство является лучшим в премиальном сегменте и любых других сегментах. Это просто пример текста, не забудьте заменить его на свой.</div>
                            <div>
                                <br>
                            </div>
                            <div>
                                <ul>
                                    <li>Современный процессор</li>
                                    <li>Стильный дизайн</li>
                                    <li>И вообще</li>
                                </ul>
                            </div>',
                'img_1' => 'templater_modules/lpcandy/assets/text/case_1.jpg',
                )
            )
        );
    }
    
    
    
    function tpl_5($val) {?>
        <div class="container-fluid text text5" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="item_list clear">
                       
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear editor_hide_remove">
                                <div class="img">
                                    <?=$self->sub('ImageSrc','img')?>
                                </div>
                                <div class="text_wrap">
                                    <div class="text_title">
                                        <?=$self->sub('Text','text_title')?>
                                    </div>
                                    <div class="text">
                                        <?=$self->sub('Text','text')?>
                                    </div>
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
        'bg_color' => '#F7F7F7',
        'items' => array(
            array(
                'text_title' => 'Несколько моментов с конференции',
                'text' => ' <div>Мы показали все самое новое, красивое и восстребованное. Встреча никого не оставила равнодушным, все были довольны развитием событий. Наше устройство является лучшим в премиальном сегменте и любых других сегментах. Это просто пример текста, не забудьте заменить его на свой.</div>
                            <div>
                                <br>
                            </div>
                            <div>
                                <ul>
                                    <li>Современный процессор</li>
                                    <li>Стильный дизайн</li>
                                    <li>И вообще</li>
                                </ul>
                            </div>',
                'img' => 'templater_modules/lpcandy/assets/text/case_1.jpg',
                )
            )
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid text text6" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16 clear">
                    <div class="text_data">
                        <h1 class="title">
                            <? $this->sub('Text','title') ?>
                        </h1>
                        <div class="title_2">
                            <? $this->sub('Text','title_2') ?>                    
                        </div>
                        <div class="text">
                            <? $this->sub('Text','text') ?>
                        </div>
                    </div>
                    <div class="ico_data">
                        <div class="item_list clear">
                            <? $this->repeat('items',function($val,$self){ ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_1')?>
                                    <div class="name">
                                        <?=$self->sub('Text','name_1')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_1')?>                            
                                    </div>                        
                                </div>
                            <? }) ?>
                            <? $this->repeat('items',function($val,$self){ ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_2')?>
                                    <div class="name">
                                        <?=$self->sub('Text','name_2')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_2')?>                            
                                    </div>                        
                                </div>
                            <? }) ?>
                            <? $this->repeat('items',function($val,$self){ ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_3')?>
                                    <div class="name">
                                        <?=$self->sub('Text','name_3')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_3')?>                            
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
        'bg_color' => '#F7F7F7',
        'title' => 'Текст с иконками',
        'title_2' => 'Подзаголовок блока совсем небольшой',
        'text' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
        'items' => array(
            array(
                'name_1' => 'Текст с хорошей иконкой',
                'desc_1' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
                'icon_1' => 'templater_modules/lpcandy/assets/ico/77.png',
                'name_2' => 'Текст с хорошей иконкой',
                'desc_2' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
                'icon_2' => 'templater_modules/lpcandy/assets/ico/89.png',
                'name_3' => 'Текст с хорошей иконкой',
                'desc_3' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
                'icon_3' => 'templater_modules/lpcandy/assets/ico/127.png',
                )
            ),
            
        );
    }
    
    
    
}


TextBlock::register();