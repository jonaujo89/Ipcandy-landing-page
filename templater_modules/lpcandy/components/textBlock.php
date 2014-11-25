<?php

class TextBlock extends Block {
    public $name = 'Text';
    public $description = "Text blocks";
    public $editor = "lp.textBlock";
    
    function tpl($val) {?>
        <div class="container-fluid text_block text_block_1" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </div>
                    <? endif ?>
                    <div class="text">
                        <? $this->sub('Text','text',array('buttons'=>array("bold","italic","fontcolor","removeformat"))) ?>
                    </div>
                    <? if ($val['show_list'] || $this->edit): ?>
                        <div class="list_wrap clear" <?= !$val['show_list'] ? "style='display:none'" : "" ?>>
                            <div class="list list_1">
                                <? $this->sub('Text','list_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true)) ?>
                            </div>
                            <div class="list list_2">
                                <? $this->sub('Text','list_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true)) ?>
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
            'show_title_2' => false,
            'show_list' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Заголовок текстового блока',
            'title_2' => 'Подзаголовок блока совсем небольшой',
            'text' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Постарайтесь, у вас должен получиться шедевральный лендос.',
            'list_1' => '<ul>                    
                            <li>Мощный процессор для игр</li>                    
                            <li>Огромный дисплей</li>                    
                            <li>Мобильный интернет 4G</li>                    
                            <li>Стильный дизайн</li>                    
                         </ul>',
            'list_2' => '<ul>                    
                            <li>Мощный процессор для игр</li>                    
                            <li>Огромный дисплей</li>                    
                            <li>Мобильный интернет 4G</li>                    
                            <li>Стильный дизайн</li>                    
                         </ul>',
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid text_block text_block_2" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self) use ($val){ ?>
                            <div class="item">
                                <? if ($val['show_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true)) ?>
                                    </div>
                                <? endif ?>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <? if ($val['show_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true)) ?>
                                    </div>
                                <? endif ?>
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
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'background_color' => '#FFFFFF',
            'title' => 'Заголовок текстового блока',
            'title_2' => 'Подзаголовок блока совсем небольшой',
            'items' => array(
                array(
                    'name_1' => 'Информационное сопровождение',
                    'desc_1' => 'Коротко опишите, что вас отличает от конкурентов, причины по которым должны довериться именно вам. Что вы даете такого ценного, чего нет на рынке. С какими проблемами не сталкнется ваш потенциальный клиент, если выберет вас.',
                    'name_2' => 'Точный расчет стоимости',
                    'desc_2' => 'Коротко опишите, что вас отличает от конкурентов, причины по которым должны довериться именно вам. Что вы даете такого ценного, чего нет на рынке. С какими проблемами не сталкнется ваш потенциальный клиент, если выберет вас.',
                ),
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
        <div class="container-fluid text_block text_block_3" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">                        
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true))?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true))?>
                                </div>
                                <div class="desc">
                                    <?=$self->sub('Text','desc_2')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true))?>
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
            'show_title' => true,
            'show_title_2' => true,
            'background_color' => '#FFFFFF',
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
        <div class="container-fluid text_block text_block_4" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                            <?=$self->sub('Image','image')?>
                            <div class="text_wrap">
                                <div class="text_title">
                                    <?=$self->sub('Text','text_title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => false))?>
                                </div> 
                                <? if ($val['show_text_title_2'] || $self->edit): ?>
                                    <div class="text_title_2" <?= !$val['show_text_title_2'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','text_title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor","removeformat"),'oneline' => false)) ?>
                                    </div>
                                <? endif ?>
                                <div class="text">
                                    <?=$self->sub('Text','text')?>
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
                    'image' => 'templater_modules/lpcandy/assets/text/case_1.jpg',
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
                                    <?=$self->sub('Text','text_title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => false))?>
                                </div>
                                <div class="text">
                                    <?=$self->sub('Text','text')?>
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
                    'text_title' => 'Несколько моментов с конференции',
                    'text' => ' <div>Мы показали все самое новое, красивое и восстребованное. Встреча никого не оставила равнодушным, все были довольны развитием событий. Наше устройство является лучшим в премиальном сегменте и любых других сегментах. Это просто пример текста, не забудьте заменить его на свой.</div>
                                <br>
                                <div>
                                    <ul>
                                        <li>Современный процессор</li>
                                        <li>Стильный дизайн</li>
                                        <li>И вообще</li>
                                    </ul>
                                </div>',
                    'image' => 'templater_modules/lpcandy/assets/text/case_1.jpg',
                ),
                array(
                    'text_title' => 'Несколько моментов с конференции',
                    'text' => ' <div>Мы показали все самое новое, красивое и восстребованное. Встреча никого не оставила равнодушным, все были довольны развитием событий. Наше устройство является лучшим в премиальном сегменте и любых других сегментах. Это просто пример текста, не забудьте заменить его на свой.</div>
                                <br>
                                <div>
                                    <ul>
                                        <li>Современный процессор</li>
                                        <li>Стильный дизайн</li>
                                        <li>И вообще</li>
                                    </ul>
                                </div>',
                    'image' => 'templater_modules/lpcandy/assets/text/case_1.jpg',
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
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true)) ?>
                        </h1>
                        <? if ($val['show_title_2'] || $this->edit): ?>
                            <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                                <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor","removeformat"),'oneline' => true)) ?>
                            </div>
                        <? endif ?> 
                        <div class="text">
                            <? $this->sub('Text','text') ?>
                        </div>
                    </div>
                    <div class="ico_data">
                        <div class="item_list clear <?= $val['show_border'] ? "" : "hide_border" ?>">
                            <? $this->repeat('items',function($val,$self){ ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon')?>
                                    <div class="name">
                                        <?=$self->sub('Text','name',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline' => true))?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc')?>                            
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
        'show_title_2' => true,
        'background_color' => '#FFFFFF',
        'title' => 'Текст с иконками',
        'title_2' => 'Подзаголовок блока совсем небольшой',
        'text' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего. Постарайтесь, у вас должен получиться шедевральный лендос. И никаких ошибок в тексте. Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
        'items' => array(
            array(
                'name' => 'Текст с хорошей иконкой',
                'desc' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
                'icon' => 'templater_modules/lpcandy/assets/ico/77.png',
            ),
            array(                
                'name' => 'Текст с хорошей иконкой',
                'desc' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
                'icon' => 'templater_modules/lpcandy/assets/ico/89.png',
            ),
            array(
                'name' => 'Текст с хорошей иконкой',
                'desc' => 'Писать много не нужно, только самое важное. Коротко и ясно, ничего лишнего.',
                'icon' => 'templater_modules/lpcandy/assets/ico/127.png',
                )
            ),
            
        );
    }   
}

TextBlock::register();