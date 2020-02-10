<?php

namespace LPCandy\Components;

class Video extends Block {
    public $name;
    public $description;
    public $editor = "lp.video";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Video';
            $this->description = "Add video";
        } else {
            $this->name = 'Видео';
            $this->description = "Вставка видео";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid video_block video_block_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
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
                        <div class="video <?= $val['video_size'] ? $val['video_size'] : "small" ?>">
                            <?=$this->sub('Media','video',array('switchType'=>false))?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'video_size' => "small",
            'show_title' => true,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Watch our video',
            'title_2' => 'Subtitle',
            'video' => array('video_url'=> 'www.youtube.com/embed/P55qVX3y134','type'=>'video'),
        ] : [
            'video_size' => "small",
            'show_title' => true,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Посмотрите видео о нашем цирке',
            'title_2' => 'Нарезка выступлений',
            'video' => array('video_url'=> 'www.youtube.com/embed/P55qVX3y134','type'=>'video'),
        ];
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid video_block video_block_2" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="row">
                    <div class="item_list col-12">
                        <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                            <div class="item row">
                                <div class="video col-6">
                                    <?=$self->sub('Media','video',array('switchType'=>false))?>
                                </div>
                                <div class="text_wrap col-6">
                                    <div class="text_title">
                                        <?=$self->sub('Text','text_title',Text::$plain_text)?>
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
                            </div>
                        <? }) ?>
                    </div>
                </div>                
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return self::$en ? [
            'show_text_title_2' => true,
            'background_color' => '#FFFFFF',         
            'items' => array(
                array(
                    'text_title' => 'Circus «One and the same are at the circus ring»',
                    'text_title_2' => 'The best circus program',
                    'text' => ' <div>Meeting with the clown duo, reprises which are built in the modern spirit, and do not leave indifferent neither kids nor adults. The stunts of the gymnast on the trapeze under the dome of our circus take your breath away.</div>
                                <br>
                                <div>
                                - Comfortable hall<br>
                                - Funny acts<br>
                                - Exciting performances<br>
                                </div>',
                    'video' => array('video_url'=> 'www.youtube.com/embed/i0a1cqKsMG8','type'=>'video'),
                )
            )
        ] : [
            'show_text_title_2' => true,
            'background_color' => '#FFFFFF',         
            'items' => array(
                array(
                    'text_title' => 'Цирк «НА МАНЕЖЕ ВСЕ ТЕ ЖЕ»',
                    'text_title_2' => 'Лучшая цирковая программа',
                    'text' => ' <div>Встреча с клоунскими дуэтами, репризы которых построены в современном духе и не оставляют равнодушными ни детей, ни взрослых. Под куполом цирка воздушная гимнастка на трапеции, отважные трюки которой захватывают дыхание.</div>
                                <br>
                                <div>
                                - Комфортный зал<br>
                                - Смешные номера<br>
                                - Захватывающие выступления<br>
                                </div>',
                    'video' => array('video_url'=> 'www.youtube.com/embed/i0a1cqKsMG8','type'=>'video'),
                )
            )
        ];
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid video_block video_block_3" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
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
                            <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                                <div class="row">
                                    <? for ($i=1;$i<=3;$i++): ?>
                                        <div class="item col-4">
                                            <div class="video <?= $val['show_border'] ? "" : "hide_border" ?>" >
                                                <?=$self->sub('Media','video_'.$i,array('switchType'=>false))?>
                                            </div>
                                            <div class="info">
                                                <div class="name">
                                                    <?=$self->sub('Text','name_'.$i,Text::$plain_heading)?>
                                                </div>
                                                <? if ($cls = $self->vis($val['show_desc'])): ?>
                                                    <div class="desc <?=$cls?>" >
                                                        <? $self->sub('Text','desc_'.$i,Text::$color_text) ?>
                                                    </div>
                                                <? endif ?> 
                                            </div>
                                        </div>
                                    <? endfor ?>
                                </div>
                            <? }) ?>                       
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_border' => true,
            'show_desc' => true,   
            'background_color' => '#FFFFFF',
            'title' => 'Testimonials',
            'title_2' => 'Subtitle',
            'items' => array(
                array(                
                    'name_1' => 'Service phone',
                    'desc_1' => 'Sergei Zaduysvechku, office plankton',
                    'video_1' => array('video_url'=> 'www.youtube.com/embed/oKCa_MDmRxo','type'=>'video'),
                    'name_2' => 'Pushing paper',
                    'desc_2' => 'Alina Seshsalo, chairman of the meeting',
                    'video_2' => array('video_url'=> 'www.youtube.com/embed/VnTmHm60K10','type'=>'video'),
                    'name_3' => 'Clearing',
                    'desc_3' => 'Ivan Zaveditraktor, navigator of combine',
                    'video_3' => array('video_url'=> 'www.youtube.com/embed/JhSw7AORNm8','type'=>'video'),
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_border' => true,
            'show_desc' => true,   
            'background_color' => '#FFFFFF',
            'title' => 'Отзывы о цирковой программе',
            'title_2' => 'Что понравилось нашим клиентам',
            'items' => array(
                array(                
                    'name_1' => 'Обслуживание телефонов',
                    'desc_1' => 'Сергей Задуйсвечку, офисный планктон',
                    'video_1' => array('video_url'=> 'www.youtube.com/embed/oKCa_MDmRxo','type'=>'video'),
                    'name_2' => 'Перекладывание бумаг',
                    'desc_2' => 'Алина Съешсало, председатель заседаний',
                    'video_2' => array('video_url'=> 'www.youtube.com/embed/VnTmHm60K10','type'=>'video'),
                    'name_3' => 'Освоение целины',
                    'desc_3' => 'Иван Заведитрактор, штурман комбайна',
                    'video_3' => array('video_url'=> 'www.youtube.com/embed/JhSw7AORNm8','type'=>'video'),
                )
            )
        ];       
    }
}