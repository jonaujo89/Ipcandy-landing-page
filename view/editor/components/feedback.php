<?php

class Feedback extends Block {
    public $name = 'Отзывы';
    public $description = "Отзывы наших клиентов";
    public $editor = "lp.feedback";
    
    function tpl($val) {?>
        <div class="container-fluid feedback feedback_1" style="background: <?=$val['background_color']?>;">
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
                        <? $this->repeat('items',function($val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=3;$i++): ?>                            
                                <div class="item">
                                    <div class="item_data">
                                        <div class="text">
                                            <?=$self->sub('Text','text_'.$i,Text::$default_text)?>
                                        </div>
                                        <div class="name">
                                            <?=$self->sub('Text','name_'.$i,Text::$default_text)?>
                                        </div>
                                        <div class="desc">
                                            <?=$self->sub('Text','desc_'.$i,Text::$color_text)?>                            
                                        </div>
                                        <? if ($cls = $self->vis($val['show_image'])): ?>
                                            <div class="img_wrap <?=$cls?>" >
                                                <? $self->sub('Image','image_'.$i) ?>
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
    
    function tpl_default() { 
        return  array(
            'show_image' => true,
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#F7F7F7',
            'title' => "Что о нас говорят клиенты ",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => "view/editor/assets/feedback/r_1.jpg",
                    'image_2' => "view/editor/assets/feedback/r_2.jpg",
                    'image_3' => "view/editor/assets/feedback/r_3.jpg",
                    'name_1' => "Петров Петр",
                    'name_2' => "Петрова Ирина",
                    'name_3' => "Петрова Анна",
                    'desc_1' => "CEO, мобильные приложения",
                    'desc_2' => "Дизайнер, мобильные приложения",
                    'desc_3' => "Аналитик, мобильные приложения",
                    'text_1' => "Я в восторге от службы поддержки клиентов. Это не компания, а просто клад. Пишите только реальные отзывы. Пишите только реальные отзывы.",
                    'text_2' => "Я в восторге от службы поддержки клиентов. Это не компания, а просто клад. Пишите только реальные отзывы. Пишите только реальные отзывы.",
                    'text_3' => "Я в восторге от службы поддержки клиентов. Это не компания, а просто клад. Пишите только реальные отзывы. Пишите только реальные отзывы.",
                )
            )
        );
    }    
}

feedback::register();