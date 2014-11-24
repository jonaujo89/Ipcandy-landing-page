<?php

class WorkOrder extends Block {
    public $name = 'Work order';
    public $description = "Benefits with icon";
    public $editor = "lp.workOrder";
    
    
    function tpl($val) {?>
        <div class="container-fluid workOrder workOrder1" style="background: <?=$val['background_color']?>;">
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
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_1')?>
                            <div class="name">
                                <?=$this->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                            <div class="desc">
                                <?=$this->sub('Text','desc_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_2')?>
                            <div class="name">
                                <? $this->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                            <div class="desc">
                                <? $this->sub('Text','desc_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_3')?>
                            <div class="name">
                                <? $this->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                            <div class="desc">
                                <? $this->sub('Text','desc_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_4')?>
                            <div class="name">
                                <? $this->sub('Text','name_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                            <div class="desc">
                                <? $this->sub('Text','desc_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false))?>
                            </div>
                        </div>
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
            'icon_1' => "templater_modules/lpcandy/assets/ico/154.png",
            'icon_2' => "templater_modules/lpcandy/assets/ico/90.png",
            'icon_3' => "templater_modules/lpcandy/assets/ico/82.png",
            'icon_4' => "templater_modules/lpcandy/assets/ico/77.png",
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
        <div class="container-fluid workOrder workOrder2" style="background: <?=$val['background_color']?>;">
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
                        <div class="item">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_1')?>
                            </div>
                        </div>

                        <div class="item">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_2')?>
                            </div>
                        </div>

                        <div class="item">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_3')?>
                            </div>
                        </div>

                        <div class="item">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_4')?>
                            </div>
                        </div>

                        <div class="item">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_5')?>
                            </div>
                        </div>

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


WorkOrder::register();