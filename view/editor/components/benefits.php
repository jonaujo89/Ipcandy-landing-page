<?php

class Benefits extends Block {
    public $name = 'Преимущества';
    public $description = "Ваши главные преимущества";
    public $editor = "lp.benefits";
    
    function tpl($val) {?>
        <div class="container-fluid benefits benefits_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?>">
                            <? $this->sub('Text','title',Text::$plain_text) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?>" >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list <?= $val['show_icon_arounds'] ? "" : "hide_ico_border" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                            
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?= $cls ?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_desc_benefit'])): ?>
                                        <div class="desc <?= $cls ?>" >
                                            <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
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
            'show_title_2' => false,
            'show_icon_arounds' => true,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/77.png",
                    'icon_2' => "view/editor/assets/ico/89.png",
                    'icon_3' => "view/editor/assets/ico/127.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }
    
    function tpl_2($val) {?>
        <div class="container-fluid benefits benefits_2" style="background: <?=$val['background_color']?>;">
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
                    <div class="item_list">
                         <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?=$cls?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_desc_benefit'])): ?>
                                        <div class="desc <?=$cls?>" >
                                            <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                </div>   
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/77.png",
                    'icon_2' => "view/editor/assets/ico/89.png",
                    'icon_3' => "view/editor/assets/ico/127.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid benefits benefits_3" style="background: <?=$val['background_color']?>;">
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
                    <div class="item_list <?= !$val['show_name_benefit'] ? "hide_name" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=2;$i++): ?>
                                <div class="item">                                
                                    <?=$self->sub('Icon','icon_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?=$cls?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                    <? endif ?>
                                    <div class="desc">
                                        <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
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
    
    function tpl_default_3() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_icon_arounds' => true,
            'show_name_benefit' => true,
            'background_color' =>'#F7F7F7',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",           
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/77.png",
                    'name_1' => "Бесплатная доставка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Можно обойтись и без этого краткого описания, только заголовки.",
                    'icon_2' => "view/editor/assets/ico/37.png",                    
                    'name_2' => "Индивидуальное обучение ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Можно обойтись и без этого краткого описания, только заголовки.",
                ),
                array(
                    'icon_1' => "view/editor/assets/ico/127.png",
                    'name_1' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Можно обойтись и без этого краткого описания, только заголовки.",
                    'icon_2' => "view/editor/assets/ico/336.png",                    
                    'name_2' => "Система скидок",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Можно обойтись и без этого краткого описания, только заголовки.",
                ),
            )
        );
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid benefits benefits_4" style="background: <?=$val['background_color']?>;">
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
                    <div class="item_list clear <?= !$val['show_image_border'] ? "hide_border" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=2;$i++): ?>
                                <div class="item">                                
                                    <div class="image_wrap">                                     
                                        <?=$self->sub('Image','image_'.$i)?>
                                    </div>
                                    <div class="name">
                                        <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                    </div>
                                    <div class="desc">
                                        <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
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
           'show_title_2' => false,
           'show_image_border' => true,
           'background_color' =>'#FFFFFF',
           'title' => "Преимущества нашей компании",
           'title_2' => "Подзаголовок",
           'items' => array(
                array(
                    'image_1' => 'view/editor/assets/benefits/1.jpg',
                    'image_2' => 'view/editor/assets/benefits/2.jpg',
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
                array(
                    'image_1' => 'view/editor/assets/benefits/3.jpg',
                    'image_2' => 'view/editor/assets/benefits/4.jpg',                    
                    'name_1' => "Круглосуточная поддержка",
                    'name_2' => "Система скидок",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
            )
        );
    }
    
    function tpl_5($val) {?>
        <div class="container-fluid benefits benefits_5" style="background: <?=$val['background_color']?>;">
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
                        <div class="item_list clear <?= !$val['show_image_border'] ? "hide_border" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Image','image_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?=$cls?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_desc_benefit'])): ?>
                                        <div class="desc <?=$cls?>" >
                                            <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
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
            'show_title_2' => false,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'show_image_border' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => 'view/editor/assets/benefits/1.jpg',
                    'image_2' => 'view/editor/assets/benefits/2.jpg',
                    'image_3' => 'view/editor/assets/benefits/3.jpg',
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }        
}

Benefits::register();