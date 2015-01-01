<?php

class Video extends Block {
    public $name = 'Видео';
    public $description = "Вставка видео";
    public $editor = "lp.video";
    
    function tpl($val) {?>
        <div class="container-fluid video_block video_block_1" style="background: <?=$val['background_color']?>;">
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
                    <div class="video <?= $val['video_size'] ? $val['video_size'] : "small" ?>">
                        <?=$this->sub('VideoStream','video')?>
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
            'video' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q'),
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
                                    <?=$self->sub('VideoStream','video')?>
                                </div>
                                <div class="text_wrap">
                                    <div class="text_title">
                                        <?=$self->sub('Text','text_title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                    </div>
                                    <? if ($val['show_text_title_2'] || $self->edit): ?>
                                        <div class="text_title_2" <?= !$val['show_text_title_2'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','text_title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor","removeformat"))) ?>
                                        </div>
                                    <? endif ?>
                                    <div class="text">
                                        <?=$self->sub('Text','text',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat")))?>
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
                    'video' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q'),
                )
            )
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid video_block video_block_3" style="background: <?=$val['background_color']?>;">
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
                        <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                            <div class="item">
                                <div class="video <?= $val['show_border'] ? "" : "hide_border" ?>" >
                                    <?=$self->sub('VideoStream','video_1')?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false), "oneline"=> true))?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_1',array('buttons'=>array("bold","italic","fontcolor","removeformat"))) ?>
                                        </div>
                                    <? endif ?> 
                                </div>
                            </div>
                            <div class="item">
                                <div class="video <?= $val['show_border'] ? "" : "hide_border" ?>">
                                    <?=$self->sub('VideoStream','video_2')?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false), "oneline"=> true))?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_2',array('buttons'=>array("bold","italic","fontcolor","removeformat"))) ?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="video <?= $val['show_border'] ? "" : "hide_border" ?>">
                                    <?=$self->sub('VideoStream','video_3')?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false), "oneline"=> true))?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_3',array('buttons'=>array("bold","italic","fontcolor","removeformat"))) ?>
                                        </div>
                                    <? endif ?>
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
                    'video_1' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q'),
                    'name_2' => 'Переустановка ПО',
                    'desc_2' => 'Алина Полякова, мед работник',
                    'video_2' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q'),
                    'name_3' => 'Замена корпуса',
                    'desc_3' => 'Елена Назарова, владелица магазина',
                    'video_3' => array('video_url'=> 'www.youtube.com/embed/xbK8rl9wH4Q'),
                    )
                )
        );
    }
}

Video::register();