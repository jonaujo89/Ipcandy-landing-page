<?php

class Reasons extends Block {
    public $name = 'Reasons';
    public $description = "Otherness";
    public $editor = "lp.reasons";
    
    function tpl($val) {?>
        <div class="container-fluid reasons reasons_1">
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
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">
                                <div class="ico_wrap">
                                    <? $self->sub('Icon','icon_1') ?>
                                </div>                    
                                <div class="name">
                                    <? $self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>true)) ?>
                                </div>
                                <div class="desc">
                                    <? $self->sub('Text','desc_1',array('buttons'=>array("bold","italic","removeformat"),'oneline'=>false)) ?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ico_wrap">
                                    <? $self->sub('Icon','icon_2') ?>
                                </div>                    
                                <div class="name">
                                    <? $self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>true)) ?>
                                </div>
                                <div class="desc">
                                    <? $self->sub('Text','desc_2',array('buttons'=>array("bold","italic","removeformat"),'oneline'=>false)) ?>
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
            'show_title_2' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Почему с нами работают<br>свыше 1 000 клиентов каждый месяц",
            'title_2' => "6 причин выбрать именно нас",
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/57.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/33.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    
                ),
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/62.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/42.png",
                    'name_1' => "Круглосуточная поддержка",
                    'name_2' => "Работа по договору",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    
                ),
                array(  
                    'icon_1' => "templater_modules/lpcandy/assets/ico/45.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/43.png",  
                    'name_1' => "Оплата после выполненных работ",
                    'name_2' => "Собственное производство",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }
   
}


Reasons::register();