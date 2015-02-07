<?php

namespace LPCandy\Components;

class Reasons extends Block {
    public $name = 'Почему мы';
    public $description = "Отличие от конкурентов";
    public $editor = "lp.reasons";
    
    function tpl($val) {?>
        <div class="container-fluid reasons reasons_1" style="background: <?=$val['background_color']?>;">
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
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=2;$i++): ?>
                                <div class="item">
                                    <div class="ico_wrap">
                                        <? $self->sub('Icon','icon_'.$i) ?>
                                    </div>                    
                                    <div class="name">
                                        <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                    </div>
                                    <div class="desc">
                                        <? $self->sub('Text','desc_'.$i,Text::$default_text) ?>
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
            'show_title' => true,
            'show_title_2' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Зачем к нам приходят более 5 000 зрителей каждый месяц",
            'title_2' => "шесть причин",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/799.png",
                    'icon_2' => "view/editor/assets/ico/806.png",
                    'name_1' => "Весёлые клоуны",
                    'name_2' => "Комфортный просмотр",
                    'desc_1' => "Наша цирковая клоунада заставляет вдоволь насмеяться и принять участие в шоу, ощутив себя настоящим артистом.",
                    'desc_2' => "Зал оборудован мягкими, комфортными сиденьями, что обеспечивает удобный просмотр шоу с любой точки зала.",

                ),
                array(
                    'icon_1' => "view/editor/assets/ico/341.png",
                    'icon_2' => "view/editor/assets/ico/359.png",
                    'name_1' => "Акробатические номера",
                    'name_2' => "Зажигательные тынцы",
                    'desc_1' => "Головокружительные трюки, ловкие прыжки и движения на грани, а также свободное падение без страховки.",
                    'desc_2' => "Яркими красками и костюмами впечатляет наш шоу-балет, вместе в которым сложно усидеть на месте от желания танцевать!",

                ),
                array(
                    'icon_1' => "view/editor/assets/ico/342.png",
                    'icon_2' => "view/editor/assets/ico/252.png",
                    'name_1' => "Звездные номера",
                    'name_2' => "Волшебные фокусы",
                    'desc_1' => "Над шоу-программой работали лучшие режиссеры, хореографы, географы, физики и биологи нашей страны.",
                    'desc_2' => "Давид Копперфильдман покажет фокус с исчезновением Вашего кошелька и ювелирных украшений который невозможно забыть.",

                ),
            )
        );
    }
}