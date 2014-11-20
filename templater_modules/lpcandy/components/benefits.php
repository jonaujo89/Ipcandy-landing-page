<?php

class Benefits extends Block {
    public $name = 'Benefits';
    public $description = "Benefits with icon";
    public $editor = "lp.benefits";
    
    function tpl($val) {?>
        <div class="container-fluid benefits benefits_1" style="background: <?=$val['background_color']?>;">
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
                    <div class="item_list <?= $val['show_icon_border'] ? "" : "hide_ico_border" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">
                                <?=$self->sub('Icon','icon_1')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_1') ?>
                                    </div>
                                <? endif ?>
                            </div>   
                            <div class="item">
                                <?=$self->sub('Icon','icon_2')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_2') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_2') ?>
                                    </div>
                                <? endif ?>
                            </div>
                            <div class='item'>
                                <?=$self->sub('Icon','icon_3')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_3') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_3') ?>
                                    </div>
                                <? endif ?>
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
            'show_title_2' => false,
            'show_icon_border' => true,
            'show_benefits_name' => true,
            'show_benefits_desc' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/89.png",
                    'icon_3' => "templater_modules/lpcandy/assets/ico/127.png",
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
                    <div class="item_list">
                         <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">
                                <?=$self->sub('Icon','icon_1')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_1') ?>
                                    </div>
                                <? endif ?>
                            </div>   
                            <div class="item">
                                <?=$self->sub('Icon','icon_2')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_2') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_2') ?>
                                    </div>
                                <? endif ?>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_3')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_3') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_3') ?>
                                    </div>
                                <? endif ?>
                            </div>
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
            'show_benefits_name' => true,
            'show_benefits_desc' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/89.png",
                    'icon_3' => "templater_modules/lpcandy/assets/ico/127.png",
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
                    <div class="item_list <?= !$val['show_benefits_name'] ? "hide_name" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">                                
                                <?=$self->sub('Icon','icon_1')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                <? endif ?>
                                <div class="desc">
                                    <? $self->sub('Text','desc_1') ?>
                                </div>
                            </div>   
                            <div class="item">
                                <?=$self->sub('Icon','icon_2')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_2') ?>
                                    </div>
                                <? endif ?>
                                <div class="desc">
                                    <? $self->sub('Text','desc_2') ?>
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
            'show_title_2' => false,
            'show_icon_border' => true,
            'show_benefits_name' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",           
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'name_1' => "Бесплатная доставка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Можно обойтись и без этого краткого описания, только заголовки.",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/37.png",                    
                    'name_2' => "Индивидуальное обучение ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Можно обойтись и без этого краткого описания, только заголовки.",
                ),
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/127.png",
                    'name_1' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Можно обойтись и без этого краткого описания, только заголовки.",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/336.png",                    
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
                    <div class="item_list clear <?= !$val['show_border_image'] ? "hide_border" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">                                
                                <div class="image_wrap">                                     
                                    <?=$self->sub('Image','image_1')?>
                                </div>
                                <div class="name">
                                    <? $self->sub('Text','name_1') ?>
                                </div>
                                <div class="desc">
                                    <? $self->sub('Text','desc_1') ?>
                                </div>
                            </div>   
                            <div class="item">
                                <div class="image_wrap">
                                    <?=$self->sub('Image','image_2')?>
                                </div>
                                <div class="name">
                                    <? $self->sub('Text','name_2') ?>
                                </div>
                                <div class="desc">
                                    <? $self->sub('Text','desc_2') ?>
                                </div>
                            </div>
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
           'show_border_image' => true,
           'background_color' =>'#FFFFFF',
           'title' => "Преимущества нашей компании",
           'title_2' => "Подзаголовок",
           'items' => array(
                array(
                    'image_1' => 'templater_modules/lpcandy/assets/benefits/1.jpg',
                    'image_2' => 'templater_modules/lpcandy/assets/benefits/2.jpg',
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
                array(
                    'image_1' => 'templater_modules/lpcandy/assets/benefits/3.jpg',
                    'image_2' => 'templater_modules/lpcandy/assets/benefits/4.jpg',                    
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
                        <div class="item_list clear <?= !$val['show_border_image'] ? "hide_border" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">
                                <?=$self->sub('Image','image_1')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_1') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_1') ?>
                                    </div>
                                <? endif ?>
                            </div>   
                            <div class="item">
                                <?=$self->sub('Image','image_2')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_2') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_2') ?>
                                    </div>
                                <? endif ?>
                            </div>
                            <div class="item">
                                <?=$self->sub('Image','image_3')?>
                                <? if ($val['show_benefits_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_benefits_name'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','name_3') ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_benefits_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_benefits_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc_3') ?>
                                    </div>
                                <? endif ?>
                            </div>
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
            'show_benefits_name' => true,
            'show_benefits_desc' => true,
            'show_border_image' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашей компании",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => 'templater_modules/lpcandy/assets/benefits/1.jpg',
                    'image_2' => 'templater_modules/lpcandy/assets/benefits/2.jpg',
                    'image_3' => 'templater_modules/lpcandy/assets/benefits/3.jpg',
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