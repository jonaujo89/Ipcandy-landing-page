<?php

class Stages extends Block {
    public $name = 'Порядок работы';
    public $description = "Основные этапы работы";
    public $editor = "lp.stages";
    
    
    function tpl($val) {?>
        <div class="container-fluid stages stages_1" style="background: <?=$val['background_color']?>;">
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
                        <? for ($i=1; $i <= 4; $i++): ?>
                            <div class="item">
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
    <?}
    
    function tpl_default() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#FFFFFF',
            'title' => "Порядок работы",
            'title_2' => "Подзаголовок",
            'icon_1' => "view/editor/assets/ico/154.png",
            'icon_2' => "view/editor/assets/ico/90.png",
            'icon_3' => "view/editor/assets/ico/82.png",
            'icon_4' => "view/editor/assets/ico/77.png",
            'name_1' => "Заявка или звонок",
            'name_2' => "Расчет стоимости",
            'name_3' => "Договор и оплата",
            'name_4' => "Изготовление и доставка",
            'desc_1' => "Оставляете заявку на нашем сайте. Наш менеджер свяжется с вами для уточнения деталей.",
            'desc_2' => "Бесплатно разрабатываем подробную смету. Согласовываем окончательную стоимость заказа.",
            'desc_3' => "Подписываем договор на поставку, предоплата 50%. Оплачиваете удобным вам способом",
            'desc_4' => "Изготавливаем материал в течение 3-5 дней, бесплатная доставка и консультация по установке.",
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid stages stages_2" style="background: <?=$val['background_color']?>;">
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
                        <? for ($i=1; $i <= 5; $i++): ?>
                            <div class="item">
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
    <?}
    
    function tpl_default_2() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#FFFFFF',
            'title' => "Порядок работы",
            'title_2' => "Подзаголовок",
            'name_1' => "Заявка или звонок",
            'name_2' => "Расчет стоимости",
            'name_3' => "Договор и оплата",
            'name_4' => "Изготовление и доставка",
            'name_5' => "Вы наш постоянный клиент",
        );
    }    
}

Stages::register();