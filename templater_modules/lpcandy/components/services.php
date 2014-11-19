<?php

class Services extends Block {
    public $name = 'Services';
    public $description = "Services with image";
    public $editor = "lp.services";
    
    function tpl($val) {?>
        <div class="container-fluid services services_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title') ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2') ?>
                        </div>
                    <? endif ?>    
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">
                                <div class="item_data">
                                    <? if ($val['show_image'] || $self->edit): ?>
                                        <div class="img" <?= !$val['show_image'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Image','image_1') ?>
                                        </div>
                                    <? endif ?>
                                    <div class="name">
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_1') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_price'] || $self->edit): ?>
                                        <div class="price" <?= !$val['show_price'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','price_1') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_order_button'] || $self->edit): ?>
                                        <div class="btn_wrap" <?= !$val['show_order_button'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub("FormButton",'order_button_1') ;?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item_data">
                                    <? if ($val['show_image'] || $self->edit): ?>
                                        <div class="img" <?= !$val['show_image'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Image','image_2') ?>
                                        </div>
                                    <? endif ?>
                                    <div class="name">
                                        <? $self->sub('Text','name_2') ?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_2') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_price'] || $self->edit): ?>
                                        <div class="price" <?= !$val['show_price'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','price_2') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_order_button'] || $self->edit): ?>
                                        <div class="btn_wrap" <?= !$val['show_order_button'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub("FormButton",'order_button_2') ;?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item_data">
                                    <? if ($val['show_image'] || $self->edit): ?>
                                        <div class="img" <?= !$val['show_image'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Image','image_3') ?>
                                        </div>
                                    <? endif ?>
                                    <div class="name">
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_3') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_price'] || $self->edit): ?>
                                        <div class="price" <?= !$val['show_price'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','price_3') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_order_button'] || $self->edit): ?>
                                        <div class="btn_wrap" <?= !$val['show_order_button'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub("FormButton",'order_button_3') ;?>
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
    
     function tpl_default() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_image' => true,
            'show_desc' => true,
            'show_price' => true,
            'show_order_button' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                    'image_1' =>  array_merge(Image::tpl_default(),array('type'=>'image_src','image_url'=>'templater_modules/lpcandy/assets/services/1.jpg')),
                    'image_2' =>  array_merge(Image::tpl_default(),array('type'=>'image_src','image_url'=>'templater_modules/lpcandy/assets/services/2.jpg')),
                    'image_3' =>  array_merge(Image::tpl_default(),array('type'=>'image_src','image_url'=>'templater_modules/lpcandy/assets/services/3.jpg')),
                    'name_1' => "Перевозки по России",
                    'name_2' => "Международные перевозки",
                    'name_3' => "Таможенное оформлении",
                    'desc_1' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя.",
                    'desc_2' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя.",
                    'desc_3' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя.",
                    'price_1' => "1 000 руб.",
                    'price_2' => "3 000 руб.",
                    'price_3' => "5 000 руб.",
                    'order_button_1' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать')),
                    'order_button_2' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать')),
                    'order_button_3' => array_merge(FormButton::tpl_default(),array('text'=>'Оформить')),
                )
            )
        );
    }
    

    function tpl_2($val) {?>
        <div class="container-fluid services services_2" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title') ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2') ?>
                        </div>
                    <? endif ?>    
                    <div class="item_list clear <?= $val['image_format'] ? $val['image_format'] : "circle" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item <?= $val['show_image_shadow'] ? '' : "hide_shadow" ?>">
                                <? $self->sub('Image','image_1') ?>
                                <div class="item_data">
                                    <div class="name">
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_1') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_price'] || $self->edit): ?>
                                        <div class="price" <?= !$val['show_price'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','price_1') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_order_button'] || $self->edit): ?>
                                        <div class="btn_wrap" <?= !$val['show_order_button'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub("FormButton",'order_button_1') ;?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="item <?= $val['show_image_shadow'] ? '' : "hide_shadow" ?>">
                                <? $self->sub('Image','image_2') ?>
                                <div class="item_data">
                                    <div class="name">
                                        <? $self->sub('Text','name_2') ?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_2') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_price'] || $self->edit): ?>
                                        <div class="price" <?= !$val['show_price'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','price_2') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_order_button'] || $self->edit): ?>
                                        <div class="btn_wrap" <?= !$val['show_order_button'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub("FormButton",'order_button_2') ;?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
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
            'image_format' => 'circle',
            'background_color' =>'#FFFFFF',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                'image_1' =>  array_merge(Image::tpl_default(),array('type'=>'image_background','image_url'=>'templater_modules/lpcandy/assets/services/1.jpg')),
                'image_2' =>  array_merge(Image::tpl_default(),array('type'=>'image_background','image_url'=>'templater_modules/lpcandy/assets/services/2.jpg')),
                'name_1' => "Перевозки по России",
                'name_2' => "Международные перевозки",
                'desc_1' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя.  ",
                'desc_2' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. ",
                'price_1' => "2 000 руб. ",
                'price_2' => "<span style='color: #BBBBBB'><strike>7 000 руб.</strike></span> 3 000 руб. ",
                'order_button_1' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать')),
                'order_button_2' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать')),
                )
            )
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid services services_3" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                   <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title') ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2') ?>
                        </div>
                    <? endif ?>    
                    <div class="item_list clear">
                         <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item <?= $val['show_shadow_under_image'] ? "" : "hide_shadow" ?>">
                                <div class="img_data <?= $val['image_size'] ? $val['image_size'] : "image_middle" ?>">
                                    <? $self->sub('Image','image_1') ?>
                                </div>
                                <div class="item_data">
                                    <div class="name">
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                    <? if ($val['show_desc'] || $self->edit): ?>
                                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','desc_1') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_price'] || $self->edit): ?>
                                        <div class="price" <?= !$val['show_price'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Text','price_1') ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_text_above_button'] || $self->edit): ?>
                                        <div class="btn_note" <?= !$val['show_text_above_button'] ? "style='display:none'" : "" ?> >
                                            <i><? $self->sub('Text','btn_note_1') ?></i>
                                        </div>
                                    <? endif ?>
                                    <? if ($val['show_order_button'] || $self->edit): ?>
                                        <div class="btn_wrap" <?= !$val['show_order_button'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub("FormButton",'order_button_1') ;?>
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
            'show_shadow_under_image' => true,
            'image_size' => 'image_middle',
            'background_color' =>'#FFFFFF',
            'title' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг ",
            'items' => array(
                array(
                    'image_1' =>  array_merge(Image::tpl_default(),array('type'=>'image_background','image_url'=>'templater_modules/lpcandy/assets/services/1.jpg')),
                    'name_1' => "Международные перевозки ",
                    'desc_1' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя.",
                    'price_1' => "1 000 руб.",
                    'btn_note_1' => "Предложение ограниченно",
                    'order_button_1' => array_merge(FormButton::tpl_default(),array('text'=>'Заказать')),
                )
            )
        );
    }
        
    
    function tpl_4($val) {?>
        <div class="container-fluid services services_4">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="item_data">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['img_1']?>');" > </div>
                                <div class="name">
                                    <? $this->sub('Text','name_1') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_1') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_1') ?> 
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['img_2']?>');" > </div>
                                <div class="name">
                                    <? $this->sub('Text','name_2') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_2') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_2') ?> 
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['img_3']?>');" ></div>
                                <div class="name">
                                    <? $this->sub('Text','name_3') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_3') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_3') ?> 
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_4() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img_1' => "templater_modules/lpcandy/assets/ico/741.png",
            'img_2' => "templater_modules/lpcandy/assets/ico/333.png",
            'img_3' => "templater_modules/lpcandy/assets/ico/319.png",
            'name_1' => "РЫБАЛКА КРУГЛЫЙ ГОД ",
            'name_2' => "ОХОТА НА ЛЮБОГО ЗВЕРЯ ",
            'name_3' => "ОТДЫХ В ПАЛАТКАХ ",
            'desc_1' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
            'desc_2' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
            'desc_3' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
            'price_1' => "1 000 руб. ",
            'price_2' => "3 000 руб. ",
            'price_3' => "5 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
    
    
     function tpl_5($val) {?>
        <div class="container-fluid services services_5">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="item_data">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_1']?>');"></div>
                                <div class="name"><? $this->sub('Text','name_1') ?></div>
                                <div class="desc"><? $this->sub('Text','desc_1') ?></div>
                                <div class="price"><? $this->sub('Text','price_1') ?></div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_2']?>');"></div>
                                <div class="name"><? $this->sub('Text','name_2') ?></div>
                                <div class="desc"><? $this->sub('Text','desc_2') ?></div>
                                <div class="price"><? $this->sub('Text','price_2') ?></div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_3']?>');"></div>
                                <div class="name"><? $this->sub('Text','name_3') ?></div>
                                <div class="desc"><? $this->sub('Text','desc_3') ?></div>
                                <div class="price"><? $this->sub('Text','price_3') ?></div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                 </div>
            </div>
        </div>
    <?}
    
     function tpl_default_5() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img_1' => "templater_modules/lpcandy/assets/services/1.jpg",
            'img_2' => "templater_modules/lpcandy/assets/services/2.jpg",
            'img_3' => "templater_modules/lpcandy/assets/services/3.jpg",
            'name_1' => "Перевозки по России  ",
            'name_2' => "Международные перевозки  ",
            'name_3' => "Таможенное оформление ",
            'desc_1' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя. ",
            'desc_2' => "еревозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. ",
            'desc_3' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя. ",
            'price_1' => "1 000 руб. ",
            'price_2' => "3 000 руб. ",
            'price_3' => "5 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid services services_6">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="item_data">
                                <div class="name"><? $this->sub('Text','name_1') ?></div>
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_1']?>');"></div>                           
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                                <div class="price"><? $this->sub('Text','price_1') ?></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="name"><? $this->sub('Text','name_2') ?></div>
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_2']?>');"></div>                           
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                                <div class="price"><? $this->sub('Text','price_2') ?></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="name"><? $this->sub('Text','name_3') ?></div>
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_3']?>');"></div>                           
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('FormButton','btn') ?>
                                    </div>
                                </div>
                                <div class="price"><? $this->sub('Text','price_3') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_6() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img_1' => "templater_modules/lpcandy/assets/services/1.jpg",
            'img_2' => "templater_modules/lpcandy/assets/services/2.jpg",
            'img_3' => "templater_modules/lpcandy/assets/services/3.jpg",
            'name_1' => "Перевозки по России  ",
            'name_2' => "Международные перевозки  ",
            'name_3' => "Таможенное оформление ",
            'price_1' => "1 000 руб. ",
            'price_2' => "3 000 руб. ",
            'price_3' => "5 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
}


Services::register();