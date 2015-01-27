<?php

class Reasons extends Block {
    public $name = 'Почему мы';
    public $description = "Отличие от конкурентов";
    public $editor = "lp.reasons";
    
    function tpl($val) {?>
        <div class="container-fluid reasons reasons_1">
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
                            <? for ($i=1; $i <= 2; $i++): ?>
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
            'title' => "Почему с нами работают<br>свыше 1 000 клиентов каждый месяц",
            'title_2' => "6 причин выбрать именно нас",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/32.png",
                    'icon_2' => "view/editor/assets/ico/22.png",
                    'name_1' => "Информационное сопровождение",
                    'name_2' => "Точный расчет стоимости",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области.",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области.",

                ),
                array(
                    'icon_1' => "view/editor/assets/ico/62.png",
                    'icon_2' => "view/editor/assets/ico/42.png",
                    'name_1' => "Информационное сопровождение",
                    'name_2' => "Точный расчет стоимости",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области.",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области.",

                ),
            )
        );
    }
}

Reasons::register();