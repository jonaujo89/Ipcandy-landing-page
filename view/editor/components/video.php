<?php

class Video extends Block {
    public $name = 'Видео';
    public $description = "Вставка видео";
    public $editor = "lp.video";
    
    function tpl($val) {?>
        <div class="container-fluid video_block video_block_1" style="background: <?=$val['background_color']?>;">
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
                    <div class="video <?= $val['video_size'] ? $val['video_size'] : "small" ?>">
                        <?=$this->sub('Media','video',array('switchType'=>false))?>
                    </div>
                    
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'video_size' => "small",
            'show_title' => true,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Посмотрите видео о нашей продукции',
            'title_2' => 'От начала производства до доставки и установки',
            'video' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q','type'=>'video'),
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid video_block video_block_2" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                            <div class="item">
                                <div class="video">
                                    <?=$self->sub('Media','video',array('switchType'=>false))?>
                                </div>
                                <div class="text_wrap">
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
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>                
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'show_text_title_2' => true,
            'background_color' => '#FFFFFF',         
            'items' => array(
                array(
                    'text_title' => 'Несколько моментов с конференции',
                    'text_title_2' => 'Информационные технологии 2014',
                    'text' => ' <div>Мы показали все самое новое, красивое и восстребованное. Встреча никого не оставила равнодушным, все были довольны развитием событий. Наше устройство является лучшим в премиальном сегменте и любых других сегментах. Это просто пример текста, не забудьте заменить его на свой.</div>
                                <br>
                                <div>
                                - Современный процессор<br>
                                - Стильный дизайн<br>
                                - И вообще<br>
                                </div>',
                    'video' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q','type'=>'video'),
                )
            )
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid video_block video_block_3" style="background: <?=$val['background_color']?>;">
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
                        <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
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
            'show_title_2' => false,
            'show_border' => true,
            'show_desc' => true,   
            'background_color' => '#FFFFFF',
            'title' => 'Можно использовать видео для отзывов',
            'title_2' => 'Почему клиенты выбирают наши услуги',
            'items' => array(
                array(                
                    'name_1' => 'Обслуживание телефонов',
                    'desc_1' => 'Сергей Долгоруков, офис менеджер',
                    'video_1' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q','type'=>'video'),
                    'name_2' => 'Переустановка ПО',
                    'desc_2' => 'Алина Полякова, мед работник',
                    'video_2' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q','type'=>'video'),
                    'name_3' => 'Замена корпуса',
                    'desc_3' => 'Елена Назарова, владелица магазина',
                    'video_3' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q','type'=>'video'),
                    )
                )
        );
    }
}

Video::register();