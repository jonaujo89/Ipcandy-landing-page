<?php

namespace LPCandy\Components;

class Numbers extends Block {
    public $name;
    public $description;
    public $editor = "lp.numbers";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Numbers';
            $this->description = "Indicators company";
        } else {
            $this->name = 'Цифры';
            $this->description = "Показатели компании";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid numbers numbers_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                            <? for ($i=1;$i<=4;$i++): ?>
                                <div class="item">
                                    <div class="value">
                                        <?=$self->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_text)?>
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
    
    function tpl_default_1() { 
        return self::$en ? [
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'value_1' => '15',
                    'name_1' => 'Years old elephant',
                    'value_2' => '7',
                    'name_2' => 'Months Clown does not drink',
                    'value_3' => '3',
                    'name_3' => 'Are in a silent chorus',
                    'value_4' => '300',
                    'name_4' => 'Sincere smiles', 
                )
            )  
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'value_1' => '15',
                    'name_1' => 'Лет старому слону',
                    'value_2' => '7',
                    'name_2' => 'Месяцев не пьет клоун',
                    'value_3' => '3',
                    'name_3' => 'Кота в молчаливом хоре',
                    'value_4' => '300',
                    'name_4' => 'Искренних улыбок', 
                )
            )  
        ];
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid numbers numbers_2" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item clear">
                                    <div class="value">
                                        <?=$self->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_text)?>
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
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'value_1' => '17',
                    'name_1' => 'Moments<br>on the market',
                    'value_2' => '75',
                    'name_2' => 'Baby<br>smiles',
                    'value_3' => '105',
                    'name_3' => 'Hippo<br>weight',
                )
            )   
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'value_1' => '17',
                    'name_1' => 'Мгновений<br>на рынке',
                    'value_2' => '75',
                    'name_2' => 'Детских<br>улыбок',
                    'value_3' => '105',
                    'name_3' => 'Весит<br>бегемот',
                )
            )  
        ];
    }
    
    function tpl_3($val) {?>
        <div class="container-fluid numbers numbers_3" style="<?=$this->bg_style($val['background'])?>">  
            <div class="container">                
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item clear">
                                    <div class="value">
                                        <?=$self->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_text)?>
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
            'show_title' => false,
            'show_title_2' => false,
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'value_1' => '5',
                    'name_1' => "The length<br>of the giraffe's neck",
                    'value_2' => '15',
                    'name_2' => 'Baby<br>smiles',
                    'value_3' => '2',
                    'name_3' => 'Bottles<br>for three',
                )
            )  
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'value_1' => '5',
                    'name_1' => 'Метров<br>шея жирафа',
                    'value_2' => '15',
                    'name_2' => 'Детских<br>улыбок',
                    'value_3' => '2',
                    'name_3' => 'Бутылки<br>на троих',
                )
            ) 
        ];
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid numbers numbers_4" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list <?= $val['icon_color'] ? "icon_".$val['icon_color'] : "icon_grey" ?>">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <? for ($i=1;$i<=4;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_'.$i)?>
                                    <div class="value">
                                        <?=$self->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <hr>
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_text)?>
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
    
    function tpl_default_4() { 
        return self::$en ? [
            'show_title' => false,
            'show_title_2' => false,
            'icon_color' => 'grey',
            'background_color' => '#FFFFFF',
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/101.png',
                    'value_1' => '5000',
                    'name_1' => 'Diplomas',
                    'icon_2' => 'view/editor/assets/ico/99.png',
                    'value_2' => '20',
                    'name_2' => 'Satisfied visitors',
                    'icon_3' => 'view/editor/assets/ico/178.png',
                    'value_3' => '50',
                    'name_3' => 'Pour out in the cafeteria',
                    'icon_4' => 'view/editor/assets/ico/739.png',
                    'value_4' => '350',
                    'name_4' => 'Smiling children',

                )
            ) 
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'icon_color' => 'grey',
            'background_color' => '#FFFFFF',
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/101.png',
                    'value_1' => '5000',
                    'name_1' => 'Почётных грамот',
                    'icon_2' => 'view/editor/assets/ico/99.png',
                    'value_2' => '20',
                    'name_2' => 'Довольных клиентов',
                    'icon_3' => 'view/editor/assets/ico/178.png',
                    'value_3' => '50',
                    'name_3' => 'Грамм наливают в буфете',
                    'icon_4' => 'view/editor/assets/ico/739.png',
                    'value_4' => '350',
                    'name_4' => 'Улыбающихся детей',

                )
            ) 
        ];
    }
    
    function tpl_5($val) {?>
        <div class="container-fluid numbers numbers_5" style="<?=$this->bg_style($val['background'])?>">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <? for ($i=1;$i<=4;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_'.$i,array('iconType'=>'white'))?>
                                    <div class="value">
                                        <?=$self->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <hr>
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_text)?>
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
    
    function tpl_default_5() { 
        return self::$en ? [
            'show_title' => false,
            'show_title_2' => false,
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/491.png',
                    'value_1' => '1',
                    'name_1' => 'Ttrained tiger',
                    'icon_2' => 'view/editor/assets/ico/447.png',
                    'value_2' => '750',
                    'name_2' => 'Loving audience',
                    'icon_3' => 'view/editor/assets/ico/379.png',
                    'value_3' => '80',
                    'name_3' => 'Ticket price',
                    'icon_4' => 'view/editor/assets/ico/645.png',
                    'value_4' => '3',
                    'name_4' => 'Stars in the picture',

                )
            ) 
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/491.png',
                    'value_1' => '1',
                    'name_1' => 'Дрессированный тигр',
                    'icon_2' => 'view/editor/assets/ico/447.png',
                    'value_2' => '750',
                    'name_2' => 'Любящих зрителей',
                    'icon_3' => 'view/editor/assets/ico/379.png',
                    'value_3' => '80',
                    'name_3' => 'Цена билета',
                    'icon_4' => 'view/editor/assets/ico/645.png',
                    'value_4' => '3',
                    'name_4' => 'Звезды на картинке',

                )
            ) 
        ];
    }
    
    function tpl_6($val) {?>
        <div class="container-fluid numbers numbers_6" style="<?=$this->bg_style($val['background'])?>">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                            <? for ($i=1;$i<=4;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_'.$i,array('iconType'=>'white'))?>
                                    <div class="value">
                                        <?=$self->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_text)?>
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
    
    function tpl_default_6() { 
        return self::$en ? [
            'show_title' => false,
            'show_title_2' => false,
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/648.png',
                    'value_1' => '50',
                    'name_1' => 'UNNECESSARY SCHEDULES',
                    'icon_2' => 'view/editor/assets/ico/684.png',
                    'value_2' => '15',
                    'name_2' => 'HANGER IN THE DRESSING ROOM',
                    'icon_3' => 'view/editor/assets/ico/501.png',
                    'value_3' => '85',
                    'name_3' => 'ENERGIZED LAMPS',
                    'icon_4' => 'view/editor/assets/ico/624.png',
                    'value_4' => '20',
                    'name_4' => ' SOCKETS OUT OF GEAR',

                )
            ) 
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/648.png',
                    'value_1' => '50',
                    'name_1' => 'НЕНУЖНЫХ ГРАФИКОВ',
                    'icon_2' => 'view/editor/assets/ico/684.png',
                    'value_2' => '15',
                    'name_2' => 'ВЕШАЛОК В ГАРДЕРОБНОЙ',
                    'icon_3' => 'view/editor/assets/ico/501.png',
                    'value_3' => '85',
                    'name_3' => 'ГОРЯЩИХ ЛАПОЧЕК',
                    'icon_4' => 'view/editor/assets/ico/624.png',
                    'value_4' => '20',
                    'name_4' => 'НЕРАБОТАЮЩИХ РОЗЕТОК',

                )
            ) 
        ];
    }
    
    function tpl_7($val) {?>
        <div class="container-fluid numbers numbers_7" style="<?=$this->bg_style($val['background'])?>">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list <?= $val['icon_color'] ? "icon_".$val['icon_color'] : "icon_grey" ?>">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <? for ($i=1;$i<=4;$i++): ?>
                                <div class="item">                                
                                    <div class="value">
                                        <?=$self->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <?=$self->sub('Icon','icon_'.$i,array('iconType'=>'white'))?>
                                    <div class="name">
                                        <?=$self->sub('Text','name_'.$i,Text::$plain_text)?>
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
    
    function tpl_default_7() { 
        return self::$en ? [
            'show_title' => false,
            'show_title_2' => false,
            'icon_color' => 'grey',
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/596.png',
                    'value_1' => '10',
                    'name_1' => 'Talking parrots',
                    'icon_2' => 'view/editor/assets/ico/620.png',
                    'value_2' => '22',
                    'name_2' => 'Balloon',
                    'icon_3' => 'view/editor/assets/ico/396.png',
                    'value_3' => '85',
                    'name_3' => 'Fluttering butterflies',
                    'icon_4' => 'view/editor/assets/ico/696.png',
                    'value_4' => '1',
                    'name_4' => 'Directors whiskers',

                )
            )   
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'icon_color' => 'grey',
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/596.png',
                    'value_1' => '10',
                    'name_1' => 'Говорящих попугаев',
                    'icon_2' => 'view/editor/assets/ico/620.png',
                    'value_2' => '22',
                    'name_2' => 'Воздушных шарика',
                    'icon_3' => 'view/editor/assets/ico/396.png',
                    'value_3' => '85',
                    'name_3' => 'Порхающих бабочек',
                    'icon_4' => 'view/editor/assets/ico/696.png',
                    'value_4' => '1',
                    'name_4' => 'Усы у директора цирка',

                )
            )   
        ];
    }
    
    function tpl_8($val) {?>
        <div class="container-fluid numbers numbers_8" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <? for ($i=1;$i<=5;$i++): ?>
                            <div class="item">
                                <div class="value_wrap">
                                    <div class="value" style="color: <?=$val['numbers_color']?>;">
                                        <?=$this->sub('Text','value_'.$i,Text::$plain_heading)?>
                                    </div>
                                    <div class="name">
                                        <?=$this->sub('Text','name_'.$i,Text::$plain_text)?>
                                    </div>
                                </div>
                            </div>
                        <? endfor ?>
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_8() { 
        return self::$en ? [
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => "#FFFFFF",
            'numbers_color' => "#E6332A",
            'title' => 'Circus facts',
            'title_2' => 'Subtitle',
            'value_1' => '12',
            'name_1' => 'Months<br>in a year',
            'value_2' => '32',
            'name_2' => 'Teeth',
            'value_3' => '64',
            'name_3' => 'Trampolines<br>years',
            'value_4' => '5',
            'name_4' => 'Gymnasts<br>soft-boiled',
            'value_5' => '2',
            'name_5' => 'Elephants<br>ears',    
        ] : [
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => "#FFFFFF",
            'numbers_color' => "#E6332A",
            'title' => 'Факты о цирке',
            'title_2' => 'Подзаголовок',
            'value_1' => '12',
            'name_1' => 'Месяцев<br>в году',
            'value_2' => '32',
            'name_2' => 'Зуба должно быть',
            'value_3' => '64',
            'name_3' => 'Года<br>батуту',
            'value_4' => '5',
            'name_4' => 'Гимнастов<br>всмятку',
            'value_5' => '2',
            'name_5' => 'Уха<br>у слона',  
        ];
    }
}