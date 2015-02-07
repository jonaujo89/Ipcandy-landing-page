<?php

namespace LPCandy\Components;

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
            'title' => "Результат работы",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/cases/1.jpg')),
                    'name' => "Радостные лица детей",
                    'desc' => "СМЕШНЫЕ ТЕХНОЛОГИИ",
                    'text' => "Задание: Вызвать улыбку у детей<br><br> В шоу включены номера на любой вкус: мистические выступления с магическими номерами, выступления диких животных, акробатов, эквилибристов, иллюзионистов и, конечно же, цирковая клоунада.",
                ),
                array(
                    'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/cases/2.jpg')),
                    'name' => "Радостные лица взрослых",
                    'desc' => "СМЕШНЫЕ ТЕХНОЛОГИИ",
                    'text' => "Задание: Вызвать улыбку у родителей<br><br>Только подарочный бокал пенного холодного пива способен подарить отцам радость, дети которых с восторгом будут смотреть нашу цирковую программу.",
                )
            )
        );
    }
    
}