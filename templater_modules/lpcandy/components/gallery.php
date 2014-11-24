<?php

class Gallery extends Block {
    public $name = 'Gallery';
    public $description = "Photo and image";
    public $editor = "lp.gallery";
    
    function tpl($val) {?>
    <div class="container-fluid gallery gallery_1" style="background: <?=$val['background_color']?>;">
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
                    <? $this->repeat('items', function($sub,$self) { ?>
                        <?= $self->sub('ImageSrc','image');?>
                        <div class="text_content">
                            <div>
                                <div class="image_title">
                                    <? $self->sub('Text','image_title') ?>
                                </div>
                                <div class="image_desc">
                                    <? $self->sub('Text','image_desc') ?>
                                </div>
                            </div>
                        </div>
                    <? }, array('inline' => true)) ?>
                    <div style="clear: both"></div>
                </div>                
            </div>
        </div>
    </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_image_title' => true,
            'show_image_desc' => true,
            'show_price' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Галерея работ №1",
            'title_2' => "Подзаголовок",
            'items' => array(                
                array(
                    'image'=>"templater_modules/lpcandy/assets/gallery/preview_img/1.jpg",
                    'image_title' => "Дорога в облака",
                    'image_desc' => "Подпись к фото",
                ),
                array(
                    'image'=>"templater_modules/lpcandy/assets/gallery/preview_img/2.jpg",
                    'image_title' => "Дорога в облака",
                    'image_desc' => "Подпись к фото",
                ),
                array(
                    'image'=>"templater_modules/lpcandy/assets/gallery/preview_img/3.jpg",
                    'image_title' => "Дорога в облака",
                    'image_desc' => "Подпись к фото",
                ),
            )
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid gallery 2" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_1']?>');">
                            </div>
                            <div class="overlay">
                                <div class="img_title">
                                    <?=$sub['img_title_1']?>
                                </div>
                                <div class="img_desc">
                                    <?=$sub['img_desc_1']?>
                                </div>
                                <div class="img_text">
                                    <?=$sub['img_text_1']?>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_2']?>');">
                            </div>
                            <div class="overlay">
                                <div class="img_title">
                                    <?=$sub['img_title_2']?>
                                </div>
                                <div class="img_desc">
                                    <?=$sub['img_desc_2']?>
                                </div>
                                <div class="img_text">
                                    <?=$sub['img_text_2']?>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_2() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ 2",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подпись к фото",
                    'img_text_1' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подпись к фото",
                    'img_text_2' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                ),
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/3.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подпись к фото",
                    'img_text_1' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/4.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подпись к фото",
                    'img_text_2' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                )
            )
        );    
    }
    
    function tpl_3($val) {?>
        <div class="container-fluid gallery 3" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
           <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                            <div class="item">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_1']?>');">
                                    <a class="img_big" href=""></a>
                                </div>                                
                                <div class="overlay">
                                    <div class="img_title">
                                        <?=$sub['img_title_1']?>
                                    </div>
                                    <div class="img_desc">
                                        <?=$sub['img_desc_1']?>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_2']?>');">
                                    <a class="img_big" href=""></a>
                                </div>                                
                                <div class="overlay">
                                    <div class="img_title">
                                        <?=$sub['img_title_2']?>
                                    </div>
                                    <div class="img_desc">
                                        <?=$sub['img_desc_2']?>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_3']?>');">
                                    <a class="img_big" href=""></a>
                                </div>                                
                                <div class="overlay">
                                    <div class="img_title">
                                        <?=$sub['img_title_3']?>
                                    </div>
                                    <div class="img_desc">
                                        <?=$sub['img_desc_3']?>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? endforeach ?>                       
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_3() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ 3",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта, интересные факты",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта, интересные факты",
                ),
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/4.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/5.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта, интересные факты",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/6.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта, интересные факты",
                )
            )
        );    
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid gallery 4" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
           <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                            <div class="item">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_1']?>');">
                                    <a class="img_big" href=""></a>
                                </div>                                
                                <div class="overlay">
                                    <div class="img_title">
                                        <?=$sub['img_title_1']?>
                                    </div>
                                    <div class="img_desc">
                                        <?=$sub['img_desc_1']?>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_2']?>');">
                                    <a class="img_big" href=""></a>
                                </div>                                
                                <div class="overlay">
                                    <div class="img_title">
                                        <?=$sub['img_title_2']?>
                                    </div>
                                    <div class="img_desc">
                                        <?=$sub['img_desc_2']?>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_3']?>');">
                                    <a class="img_big" href=""></a>
                                </div>                                
                                <div class="overlay">
                                    <div class="img_title">
                                        <?=$sub['img_title_3']?>
                                    </div>
                                    <div class="img_desc">
                                        <?=$sub['img_desc_3']?>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['img_4']?>');">
                                    <a class="img_big" href=""></a>
                                </div>                                
                                <div class="overlay">
                                    <div class="img_title">
                                        <?=$sub['img_title_4']?>
                                    </div>
                                    <div class="img_desc">
                                        <?=$sub['img_desc_4']?>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? endforeach ?>                       
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_4() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ 4",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/1.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                ),
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/4.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/5.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/6.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/3.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid gallery 5" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                        <div class="item clear">
                            <div class="img_double">
                                <div class="img">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_5']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_5']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_5']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="img_side">
                                <div class="img">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_1']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_1']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_1']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="img">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_2']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_2']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_2']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="img">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_3']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_3']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_3']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="img">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_4']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_4']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_4']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div> 
                            </div>
                            <div style="clear: both"></div>
                        </div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_5() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ 5",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/1.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/4.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid gallery 6" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                        <div class="item clear">
                            <div class="img_side">
                                <div class="img img_w1 img_h2">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_1']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_1']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_1']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="img img_w1 img_h1">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_2']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_2']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_2']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="img_double">
                                <div class="img img_w2 img_h1">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_3']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_3']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_3']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>    
                                <div class="img img_w1 img_h1">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_4']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_4']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_4']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="img img_w1 img_h1">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_5']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_5']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_5']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="img img_w2 img_h1">
                                    <a lass="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_6']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_6']?></div>
                                                        <div class="img_desc"><?=$sub['img_desc_6']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>                                
                            </div>
                            <div style="clear: both"></div>
                            <? endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_6() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ 6",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/1.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/5.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                    'img_6' => "templater_modules/lpcandy/assets/gallery/3.jpg",                   
                    'img_title_6' => "Дорога в облака",
                    'img_desc_6' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_7($val) {?>
        <div class="container-fluid gallery 7" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    
                    <div class="item_list clear">
                            <? foreach ($val['items'] as $sub): ?>
                            <div class="item clear">
                                <div class="img_double">
                                    <div class="img img_w3 img_h2">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_1']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title"><?=$sub['img_title_1']?></div>
                                                            <div class="img_desc"><?=$sub['img_desc_1']?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="img_side">
                                    <div class="img img_w2 img_h1">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_2']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title"><?=$sub['img_title_2']?></div>
                                                            <div class="img_desc"><?=$sub['img_desc_2']?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_3']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title"><?=$sub['img_title_3']?></div>
                                                            <div class="img_desc"><?=$sub['img_desc_3']?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_4']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title"><?=$sub['img_title_4']?></div>
                                                            <div class="img_desc"><?=$sub['img_desc_4']?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="img img_w2 img_h1">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_5']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_5']?></div>
                                                            <div class="img_desc"><?=$sub['img_desc_5']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="img img_w3 img_h1">
                                    <a class="big_img" href="" title="Дорога в облака">
                                        <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_6']?>');"></div>
                                        <div class="overlay">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div class="inner">
                                                        <div class="img_title"><?=$sub['img_title_6']?></div>
                                                            <div class="img_desc"><?=$sub['img_desc_6']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <? endforeach ?>
                        </div>
                    
                    </div>
                </div>
            </div>

    <?}
    
     function tpl_default_7() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ 7",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/4.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                    'img_6' => "templater_modules/lpcandy/assets/gallery/6.jpg",                   
                    'img_title_6' => "Дорога в облака",
                    'img_desc_6' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_8($val) {?>
        <div class="container-fluid gallery 8" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                            <div class="item clear">                      
                                <div class="img_side">
                                    <div class="img img_w1 img_h2">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_1']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title">Дорога в облака</div>
                                                            <div class="img_desc">Подпись к фото</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="img_double">
                                    <div class="img img_w2 img_h1">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_2']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title">Дорога в облака</div>
                                                            <div class="img_desc">Подпись к фото</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_3']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title">Дорога в облака</div>
                                                            <div class="img_desc">Подпись к фото</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_4']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title">Дорога в облака</div>
                                                            <div class="img_desc">Подпись к фото</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="img img_w2 img_h1">
                                        <a class="big_img" href="" title="Дорога в облака">
                                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$sub['img_5']?>');"></div>
                                            <div class="overlay">
                                                <div class="outer">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <div class="img_title">Дорога в облака</div>
                                                            <div class="img_desc">Подпись к фото</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>                      
                            </div>
                        <? endforeach ?>
                        </div>                    
                    </div>
                </div>
            </div>

    <?}
    
     function tpl_default_8() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ 8",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/4.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/1.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                    'img_6' => "templater_modules/lpcandy/assets/gallery/6.jpg",                   
                    'img_title_6' => "Дорога в облака",
                    'img_desc_6' => "Подробное описание проекта",
                )
            )
        );    
    }
    
}

Gallery::register();