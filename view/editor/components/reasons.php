<?php

class Reasons extends Block {
    public $name = 'Почему мы';
    public $description = "Отличие от конкурентов";
    public $editor = "lp.reasons";
    
    function tpl($val) {?>
        <div class="container-fluid reasons reasons_1">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title <?= !$val['show_title'] ? "hidden" : "" ?> " >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2 <?= !$val['show_title_2'] ? "hidden" : "" ?> " >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
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
                                        <? $self->sub('Text','name_'.$i,array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>true)) ?>
                                    </div>
                                    <div class="desc">
                                        <? $self->sub('Text','desc_'.$i,array('buttons'=>array("bold","italic","removeformat"),'oneline'=>false)) ?>
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
    
    function item_default($url_1,$url_2) {
        return array(
            'icon_1' => "view/editor/assets/ico/".$url_1,
            'icon_2' => "view/editor/assets/ico/".$url_2,
            'name_1' => "Информационное сопровождение",
            'name_2' => "Точный расчет стоимости",
            'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области.",
            'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области.",
                    
        );
    }
    
    function tpl_default() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Почему с нами работают<br>свыше 1 000 клиентов каждый месяц",
            'title_2' => "6 причин выбрать именно нас",
            'items' => array(
                $this->item_default('57.png','33.png'),
                $this->item_default('62.png','42.png'),
                $this->item_default('45.png','43.png')
            )
        );
    }
}

Reasons::register();