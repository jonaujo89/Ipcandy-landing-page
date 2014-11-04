<?php

class WorkOrder extends Block {
    public $name = 'Work order';
    public $description = "Benefits with icon";
    
    function tpl($val) {?>
        <div class="container-fluid workOrder workOrder1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$this->sub('Text','title')?>
                    </h1>
                    <div class="item_list clear">
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_1')?>
                            <div class="name">
                                <?=$this->sub('Text','name_1')?>
                            </div>
                            <div class="desc">
                                <?=$this->sub('Text','desc_1')?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_2')?>
                            <div class="name">
                                <? $this->sub('Text','name_2')?>
                            </div>
                            <div class="desc">
                                <? $this->sub('Text','desc_2')?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_3')?>
                            <div class="name">
                                <? $this->sub('Text','name_3')?>
                            </div>
                            <div class="desc">
                                <? $this->sub('Text','desc_3')?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="arrow"></div>
                            <?=$this->sub('Icon','icon_4')?>
                            <div class="name">
                                <? $this->sub('Text','name_4')?>
                            </div>
                            <div class="desc">
                                <? $this->sub('Text','desc_4')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Порядок работы",
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
        <div class="container-fluid workOrder workOrder2" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$this->sub('Text','title')?>
                    </h1>
                    <div class="item_list clear">
                        <div class="item item0">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_1')?>
                            </div>
                        </div>

                        <div class="item item1">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_2')?>
                            </div>
                        </div>

                        <div class="item item2">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_3')?>
                            </div>
                        </div>

                        <div class="item item3">
                            <div class="line"></div>
                            <div class="number"></div>
                            <div class="name">
                                <? $this->sub('Text','name_4')?>
                            </div>
                        </div>

                        <div class="item item4">
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
            'bg_color' => '#F7F7F7',
            'title' => "Как мы работаем",
            'name_1' => "Заявка или звонок",
            'name_2' => "Расчет стоимости",
            'name_3' => "Договор и оплата",
            'name_4' => "Изготовление и доставка",
            'name_5' => "Вы наш постоянный клиент",
        );
    }
    
}


WorkOrder::register();