<?php

namespace LPCandy\Components;

class Stages extends Block {
    public $name;
    public $description;
    public $editor = "lp.stages";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Stages';
            $this->description = "Work order";
        } else {
            $this->name = 'Порядок работы';
            $this->description = "Основные этапы работы";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid stages stages_1" style="background: <?=$val['background_color']?>;">
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
                            <div class="row">
                                <? for ($i=1;$i<=4;$i++): ?>
                                    <div class="item col-3">
                                        <div class="arrow"></div>
                                        <?= $this->sub('Icon','icon_'.$i) ?>
                                        <? if ($cls = $this->vis($val['show_name'])): ?>
                                            <div class="name <?=$cls?>" >
                                                <?=$this->sub('Text','name_'.$i,Text::$plain_text)?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $this->vis($val['show_desc'])): ?>
                                            <div class="desc <?=$cls?>" >
                                                <?=$this->sub('Text','desc_'.$i,Text::$plain_text)?>
                                            </div>
                                        <? endif ?>
                                    </div>
                                <? endfor ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#FFFFFF',
            'title' => "The procedure for obtaining a positive charge of vivacity",
            'title_2' => "Subtitle",
            'icon_1' => Configuration::$assets_url."/ico/822.png",
            'icon_2' => Configuration::$assets_url."/ico/175.png",
            'icon_3' => Configuration::$assets_url."/ico/778.png",
            'icon_4' => Configuration::$assets_url."/ico/345.png",
            'name_1' => "Ticket",
            'name_2' => "The arrival in the circus",
            'name_3' => "Program viewing",
            'name_4' => "Positive impression",
            'desc_1' => "Day-and-night service orders. Book tickets by phone. Delivery pigeons.",
            'desc_2' => "The hall is equipped with comfortable sofas, which ensures strong and sweet dream for each visitor.",
            'desc_3' => "Our circus clown makes plenty of laugh and take part in the show, feeling yourself in the shoes of the clown.",
            'desc_4' => "Each seat in the audience is patched a high-voltage cable. You will definitely get positive impressions.",
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#FFFFFF',
            'title' => "Порядок получения позитивного заряда бодрости",
            'title_2' => "Подзаголовок",
            'icon_1' => Configuration::$assets_url."/ico/822.png",
            'icon_2' => Configuration::$assets_url."/ico/175.png",
            'icon_3' => Configuration::$assets_url."/ico/778.png",
            'icon_4' => Configuration::$assets_url."/ico/345.png",
            'name_1' => "Заказ билета",
            'name_2' => "Приход в цирк",
            'name_3' => "Просмотр программы",
            'name_4' => "Позитивный заряд",
            'desc_1' => "Круглосуточно работающая служба заказов. Закажите билет по телефону. Доставка почтовыми голубями.",
            'desc_2' => "Зал оборудован комфортными диванами, что обеспечивает крепкий и сладкий сон каждому посетителю.",
            'desc_3' => "Наша цирковая клоунада заставляет вдоволь насмеяться и принять участие в шоу, ощутив себя в шкуре клоуна.",
            'desc_4' => "К каждому креслу в зале подведён высоковольтный кабель. Получение заряда бодрости Вам обеспечено.",
        ];
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid stages stages_2" style="background: <?=$val['background_color']?>;">
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
                        <div class="item_list row">
                            <? for ($i=1;$i<=5;$i++): ?>
                                <div class="item col-2">
                                    <div class="line"></div>
                                    <div class="number"></div>
                                    <div class="name">
                                        <? $this->sub('Text','name_'.$i,Text::$default_text)?>
                                    </div>
                                </div>
                            <? endfor ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#FFFFFF',
            'title' => "5 steps towards a good mood",
            'title_2' => "Subtitle",
            'name_1' => "Selection of data",
            'name_2' => "Ticket booking",
            'name_3' => "Cost calculation",
            'name_4' => "Program viewing",
            'name_5' => "Euphoria"
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#FFFFFF',
            'title' => "Пять шагов к отличному настроению",
            'title_2' => "Подзаголовок",
            'name_1' => "Выбор даты",
            'name_2' => "Заказа билета",
            'name_3' => "Расчет стоимости",
            'name_4' => "Просмотр программы",
            'name_5' => "Вам супер классно"
        ];
    }    
}