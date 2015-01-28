<?php

class Services extends Block {
    public $name = 'Услуги';
    public $description = "Перечень услуг";
    public $editor = "lp.services";
    
    function tpl($val) {?>
        <div class="container-fluid services services_1" style="background: <?=$val['background']?>;">
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
                            <? for ($i=1; $i <= 3; $i++): ?>
                                <div class="item">
                                    <div class="item_data">
                                        <? if ($cls = $self->vis($val['show_image'])): ?>
                                            <div class="img_wrap <?=$cls?>" >
                                                <? $self->sub('Image','image_'.$i) ?>
                                            </div>
                                        <? endif ?>
                                        <div class="name">
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                        <? if ($cls = $self->vis($val['show_desc'])): ?>
                                            <div class="desc <?=$cls?>" >
                                                <? $self->sub('Text','desc_'.$i,Text::$default_text) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_price'])): ?>
                                            <div class="price <?=$cls?>" >
                                                <? $self->sub('Text','price_'.$i,Text::$color_heading) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_order_button'])): ?>
                                            <div class="btn_wrap <?=$cls?>" >
                                                <? $self->sub("FormButton",'@order_button') ;?>
                                            </div>
                                        <? endif ?>
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
            'show_image' => true,
            'show_desc' => true,
            'show_price' => true,
            'show_order_button' => true,
            'background' =>'#F7F7F7',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                    'image_1' => 'view/editor/assets/services/1.jpg',
                    'image_2' => 'view/editor/assets/services/2.jpg',
                    'image_3' => 'view/editor/assets/services/3.jpg',
                    'name_1' => "Перевозки по России",
                    'name_2' => "Международные перевозки",
                    'name_3' => "Таможенное оформление",
                    'desc_1' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя.",
                    'desc_2' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя.",
                    'desc_3' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя.",
                    'price_1' => "1 000 руб.",
                    'price_2' => "3 000 руб.",
                    'price_3' => "5 000 руб.",
                )
            ),
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать','color' =>'blue'))
        );
    }
    

    function tpl_2($val) {?>
        <div class="container-fluid services services_2" style="background: <?=$val['background']?>;">
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
                    <div class="item_list clear <?= $val['image_shape'] ? $val['image_shape'] : "circle" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=2;$i++): ?>
                                <div class="item <?= $val['show_image_shadow'] ? '' : "hide_shadow" ?>">
                                    <div class="img_data">
                                        <? $self->sub('Image','image_'.$i) ?>
                                    </div>
                                    <div class="item_data">
                                        <div class="name">
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                        <? if ($cls = $self->vis($val['show_desc'])): ?>
                                            <div class="desc <?=$cls?>" >
                                                <? $self->sub('Text','desc_'.$i,Text::$default_text) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_price'])): ?>
                                            <div class="price <?=$cls?>" >
                                                <? $self->sub('Text','price_'.$i,Text::$color_heading) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_order_button'])): ?>
                                            <div class="btn_wrap <?=$cls?>" >
                                                <? $self->sub("FormButton",'@order_button') ;?>
                                            </div>
                                        <? endif ?>
                                    </div>
                                </div>
                            <? endfor ?>
                        <? }) ?>
                    </div> 
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_desc' => true,
            'show_price' => true,
            'show_order_button' => true,
            'show_image_shadow' => true,
            'image_shape' => 'circle',
            'background' =>'#FFFFFF',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                'image_1' => 'view/editor/assets/services/1.jpg',
                'image_2' => 'view/editor/assets/services/2.jpg',
                'name_1' => "Перевозки по России",
                'name_2' => "Международные перевозки",
                'desc_1' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя.  ",
                'desc_2' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. ",
                'price_1' => "2 000 руб. ",
                'price_2' => "<span style='color: #BBBBBB'><strike>7 000 руб.</strike></span> 3 000 руб. ",
                )
            ),
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать','color' =>'blue'))
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid services services_3" style="background: <?=$val['background']?>;">
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
                            <div class="item <?= $val['show_image_shadow'] ? "" : "hide_shadow" ?>">
                                <div class="img_data <?= $val['image_size'] ? "image_".$val['image_size'] : "image_middle" ?>">
                                    <? $self->sub('Image','image') ?>
                                </div>
                                <div class="item_data">
                                    <div class="name">
                                        <? $self->sub('Text','name',Text::$plain_heading) ?>
                                    </div>
                                    <? if ($cls = $self->vis($val['show_desc'])): ?>
                                        <div class="desc <?=$cls?>" >
                                            <? $self->sub('Text','desc',Text::$default_text) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_price'])): ?>
                                        <div class="price <?=$cls?>" >
                                            <? $self->sub('Text','price',Text::$color_heading) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_text_above_button'])): ?>
                                        <div class="btn_note <?=$cls?>" >
                                            <? $self->sub('Text','btn_note',Text::$default_heading) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_order_button'])): ?>
                                        <div class="btn_wrap <?=$cls?>" >
                                            <? $self->sub("FormButton",'@order_button') ;?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div> 
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,            
            'show_desc' => true,
            'show_price' => true,
            'show_text_above_button' => true,
            'show_order_button' => true,
            'show_image_shadow' => true,
            'image_size' => 'middle',
            'background' =>'#FFFFFF',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                    'image' => 'view/editor/assets/services/2.jpg',
                    'name' => "Международные перевозки ",
                    'desc' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. ",
                    'price' => "<span style='color: #BBBBBB'><strike>7 000 руб.</strike></span> 3 000 руб.",
                    'btn_note' => "<i>Предложение ограниченно</i>",
                )
            ),
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать','color' =>'blue'))
        );
    }
        
    
    function tpl_4($val) {?>
        <div class="container-fluid services services_4" style="background: <?=$val['background']?>;">
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
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <? if ($cls = $self->vis($val['show_image'])): ?>
                                        <div class="img_wrap <?=$cls?>" >
                                            <?=$self->sub('Icon','image_'.$i)?>
                                        </div>
                                    <? endif ?>                                
                                    <div class="item_data">
                                        <div class="name">
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                        <? if ($cls = $self->vis($val['show_desc'])): ?>
                                            <div class="desc <?=$cls?>" >
                                                <? $self->sub('Text','desc_'.$i,Text::$default_text) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_price'])): ?>
                                            <div class="price <?=$cls?>" >
                                                <? $self->sub('Text','price_'.$i,Text::$color_heading) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_order_button'])): ?>
                                            <div class="btn_wrap <?=$cls?>" >
                                                <? $self->sub("FormButton",'@order_button') ;?>
                                            </div>
                                        <? endif ?>
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
    
     function tpl_default_4() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_image' => true,
            'show_desc' => true,
            'show_price' => true,            
            'show_order_button' => true,
            'background' =>'#F7F7F7',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                    'image_1' => "view/editor/assets/ico/741.png",
                    'image_2' => "view/editor/assets/ico/333.png",
                    'image_3' => "view/editor/assets/ico/319.png",
                    'name_1' => "РЫБАЛКА КРУГЛЫЙ ГОД ",
                    'name_2' => "ОХОТА НА ЛЮБОГО ЗВЕРЯ ",
                    'name_3' => "ОТДЫХ В ПАЛАТКАХ ",
                    'desc_1' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
                    'desc_2' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
                    'desc_3' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
                    'price_1' => "1 000 руб. ",
                    'price_2' => "3 000 руб. ",
                    'price_3' => "5 000 руб. ",
                )
            ),
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать','color' =>'blue'))
        );
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid services services_5" style="background: <?=$val['background']?>;">
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
                    <div class="item_list clear <?= $val['image_shape'] ? $val['image_shape'] : "circle" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <div class="item_data">
                                        <? if ($cls = $self->vis($val['show_image'])): ?>
                                            <div class="img_wrap <?=$cls?>" >
                                                <? $self->sub('Image','image_'.$i) ?>
                                            </div>
                                        <? endif ?>
                                        <div class="name">
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                        <? if ($cls = $self->vis($val['show_desc'])): ?>
                                            <div class="desc <?=$cls?>" >
                                                <? $self->sub('Text','desc_'.$i,Text::$default_text) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_price'])): ?>
                                            <div class="price <?=$cls?>" >
                                                <? $self->sub('Text','price_'.$i,Text::$color_heading) ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_order_button'])): ?>
                                            <div class="btn_wrap <?=$cls?>" >
                                                <? $self->sub("FormButton",'@order_button') ;?>
                                            </div>
                                        <? endif ?>
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
    
    function tpl_default_5() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_image' => true,
            'show_desc' => true,
            'show_price' => true,
            'show_price' => true,
            'image_shape' => 'circle',
            'show_order_button' => true,
            'background' =>'#F7F7F7',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                    'image_1' =>  'view/editor/assets/services/1.jpg',
                    'image_2' =>  'view/editor/assets/services/2.jpg',
                    'image_3' =>  'view/editor/assets/services/3.jpg',
                    'name_1' => "Перевозки по России",
                    'name_2' => "Международные перевозки",
                    'name_3' => "Таможенное оформлении",
                    'desc_1' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя.",
                    'desc_2' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя.",
                    'desc_3' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя.",
                    'price_1' => "1 000 руб.",
                    'price_2' => "3 000 руб.",
                    'price_3' => "5 000 руб.",
                )
            ),
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать','color' =>'blue'))
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid services services_6" style="background: <?=$val['background']?>;">
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
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <div class="item_data">
                                        <div class="name">
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                        <div class="img_wrap">
                                            <? $self->sub('Image','image_'.$i) ?>
                                        </div> 
                                        <div class="btn_wrap">
                                            <? $self->sub("FormButton",'@order_button') ;?>
                                        </div>
                                        <div class="price">
                                            <? $self->sub('Text','price_'.$i,Text::$color_heading) ?>
                                        </div>
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
    
    function tpl_default_6() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'background' =>'#F7F7F7',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'items' => array(
                array(
                    'image_1' => 'view/editor/assets/services/1.jpg',
                    'image_2' => 'view/editor/assets/services/2.jpg',
                    'image_3' => 'view/editor/assets/services/3.jpg',
                    'name_1' => "Перевозки по России",
                    'name_2' => "Международные перевозки",
                    'name_3' => "Таможенное оформлении",
                    'price_1' => "1 000 руб.",
                    'price_2' => "3 000 руб.",
                    'price_3' => "5 000 руб.",
                )
            ),
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать','color' =>'blue'))
        );
    }
}

Services::register();