<?php

class Cases extends Block {
    public $name = 'Кейсы';
    public $description = "Результаты наших клиентов";
    public $editor = "lp.cases";
    
    function tpl($val) {?>
        <div class="container-fluid cases cases_1" style="background: <?=$val['background_color']?>;">
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
                            <div class="media_wrap">
                                <? $self->sub('Media','media') ?>
                            </div>
                            <div class="info">
                                <div class="top"></div>
                                <? if ($cls = $self->vis($val['show_name'])): ?>
                                    <div class="name <?=$cls?>" >
                                        <? $self->sub('Text','name',Text::$plain_heading) ?>
                                    </div>
                                <? endif ?>
                                <? if ($cls = $self->vis($val['show_desc'])): ?>
                                    <div class="desc <?=$cls?>" >
                                        <? $self->sub('Text','desc',Text::$color_heading) ?>
                                    </div>
                                <? endif ?>
                                <div class="text">
                                    <? $self->sub('Text','text',Text::$color_text) ?>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,
            'background_color' =>'#F7F7F7',
            'title' => "Результаты наших клиентов",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/services/1.jpg')),
                    'name' => "TRADENORDSERVCICES",
                    'desc' => "ИНФОРМАЦИОННЫЕ ТЕХНОЛОГИИ",
                    'text' => "Задача: Доставить груз в течение 6 дней.<br><br> Результат: Перевезли из офиса в Москве во Владивосток больше двух тонн орг техники и комплектующих. По времени составило 6 дней. В этом блоке опишите свои достигнутые результаты, что сделано по факту. Предельно ясно и коротко. Приложите фотографию процесса или результата.",
                ),
                array(
                    'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/services/2.jpg')),
                    'name' => "TRADENORDSERVCICES",
                    'desc' => "ИНФОРМАЦИОННЫЕ ТЕХНОЛОГИИ",
                    'text' => "Задача: Доставить груз в течение 6 дней.<br><br> Результат: Перевезли из офиса в Москве во Владивосток больше двух тонн орг техники и комплектующих. По времени составило 6 дней. В этом блоке опишите свои достигнутые результаты, что сделано по факту. Предельно ясно и коротко. Приложите фотографию процесса или результата.",
                )
            )
        );
    }
    
}


Cases::register();