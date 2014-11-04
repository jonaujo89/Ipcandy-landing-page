<?php

class Video extends Block {
    public $name = 'Video';
    public $description = "Мideo about our activities";
    
    function tpl($val) {?>
        <div class="container-fluid video video1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$this->sub('Text','title')?>
                    </h1>
                    <div class="title_2">
                        <?=$this->sub('Text','title_2')?>
                    </div>
                    <div class="video size_small">
                        <?=$this->sub('VideoFrame','video')?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => 'Посмотрите видео о нашей продукции',
            'title_2' => 'От начала производства до доставки и установки',
            'video' => 'www.youtube.com/embed/xbK8rl9wH4Q',
        );
    }
    
    function tpl_2($val) {?>
        <div class="container-fluid video video2" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear editor_hide_remove">
                                <div class="video">
                                    <?=$self->sub('VideoFrame','video')?>
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
    
    function tpl_default_2() { 
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
                'video' => 'www.youtube.com/embed/cIyHm6hSMrc?rel=0&amp;wmode=transparent&amp;controls=2&amp;modestbranding=1',
                )
            )
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid video video3" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$this->sub('Text','title')?>
                    </h1>
                    <div class="title_2">
                        <?=$this->sub('Text','title_2')?>
                    </div>
                    
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear">
                                <div class="video">
                                    <?=$self->sub('VideoFrame','video_1')?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <?=$self->sub('Text','name_1')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_1')?>                        
                                    </div>
                                </div>
                            </div>
                            <div class="item clear">
                                <div class="video">
                                    <?=$self->sub('VideoFrame','video_2')?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <?=$self->sub('Text','name_2')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_2')?>                        
                                    </div>
                                </div>
                            </div>
                            <div class="item clear">
                                <div class="video">
                                    <?=$self->sub('VideoFrame','video_3')?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <?=$self->sub('Text','name_3')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_3')?>                        
                                    </div>
                                </div>
                            </div>                            
                        <? }) ?>
                        <div style="clear: both"></div>
                    </div>
                </div>                
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
        'bg_color' => '#F7F7F7',
        'title' => 'Можно использовать видео для отзывов',
        'title_2' => 'Почему клиенты выбирают наши услуги',
        'items' => array(
            array(                
                'name_1' => 'Обслуживание телефонов',
                'desc_1' => 'Сергей Долгоруков, офис менеджер',
                'video_1' => 'www.youtube.com/embed/cIyHm6hSMrc?rel=0&amp;wmode=transparent&amp;controls=2&amp;modestbranding=1',
                'name_2' => 'Переустановка ПО',
                'desc_2' => 'Алина Полякова, мед работник',
                'video_2' => 'www.youtube.com/embed/cIyHm6hSMrc?rel=0&amp;wmode=transparent&amp;controls=2&amp;modestbranding=1',
                'name_3' => 'Замена корпуса',
                'desc_3' => 'Елена Назарова, владелица магазина',
                'video_3' => 'www.youtube.com/embed/cIyHm6hSMrc?rel=0&amp;wmode=transparent&amp;controls=2&amp;modestbranding=1',
                )
            )
        );
    }
    
    
    
}


Video::register();