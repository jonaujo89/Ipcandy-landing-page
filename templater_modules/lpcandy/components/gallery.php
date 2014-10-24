<?php

class Gallery extends Block {
    public $name = 'Gallery';
    public $description = "Photo and image";
    
    function tpl($val) {?>
    <div class="container-fluid gallery gallery_1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
        <div class="container">
            <div class="span16">
                <h1 class="title">
                    <? $this->sub('Text','title') ?>
                </h1>     
                
                <div class="item_list">
                    <div class="item">
                        <a href="#">
                            <img src="<?=INDEX_URL."/".$val['img1']?>"/>
                            <span class="text-content">
                                <span>
                                    <div class="img_title"><? $this->sub('Text','img_title_1') ?></div>
                                    <div class="img_desc"><? $this->sub('Text','img_desc_1') ?></div>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="<?=INDEX_URL."/".$val['img2']?>"/>
                            <span class="text-content">
                                <span>
                                    <div class="img_title"><? $this->sub('Text','img_title_2') ?></div>
                                    <div class="img_desc"><? $this->sub('Text','img_desc_2') ?></div>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="<?=INDEX_URL."/".$val['img3']?>"/>
                            <span class="text-content">
                                <span>
                                    <div class="img_title"><? $this->sub('Text','img_title_3') ?></div>
                                    <div class="img_desc"><? $this->sub('Text','img_desc_3') ?></div>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="<?=INDEX_URL."/".$val['img4']?>"/>
                            <span class="text-content">
                                <span>
                                    <div class="img_title"><? $this->sub('Text','img_title_4') ?></div>
                                    <div class="img_desc"><? $this->sub('Text','img_desc_4') ?></div>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="<?=INDEX_URL."/".$val['img5']?>"/>
                            <span class="text-content">
                                <span>
                                    <div class="img_title"><? $this->sub('Text','img_title_5') ?></div>
                                    <div class="img_desc"><? $this->sub('Text','img_desc_5') ?></div>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="<?=INDEX_URL."/".$val['img6']?>"/>
                            <span class="text-content">
                                <span>
                                    <div class="img_title"><? $this->sub('Text','img_title_6') ?></div>
                                    <div class="img_desc"><? $this->sub('Text','img_desc_6') ?></div>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Галерея работ",
            'img1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",
            'img2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
            'img3' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
            'img4' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",
            'img5' => "templater_modules/lpcandy/assets/gallery/gallery_5.jpg",
            'img6' => "templater_modules/lpcandy/assets/gallery/gallery_6.jpg",
            'img_title_1' => "Дорога в облака",
            'img_title_2' => "Дорога в облака",
            'img_title_3' => "Дорога в облака",
            'img_title_4' => "Дорога в облака",
            'img_title_5' => "Дорога в облака",
            'img_title_6' => "Дорога в облака",
            'img_desc_1' => "Подпись к фото",
            'img_desc_2' => "Подпись к фото",
            'img_desc_3' => "Подпись к фото",
            'img_desc_4' => "Подпись к фото",
            'img_desc_5' => "Подпись к фото",
            'img_desc_6' => "Подпись к фото",
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid gallery gallery_2" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
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
            'title' => "Галерея работ",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подпись к фото",
                    'img_text_1' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подпись к фото",
                    'img_text_2' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                ),
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подпись к фото",
                    'img_text_1' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подпись к фото",
                    'img_text_2' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
                )
            )
        );    
    }
    
    function tpl_3($val) {?>
        <div class="container-fluid gallery gallery_3" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
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
            'title' => "Галерея работ",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта, интересные факты",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта, интересные факты",
                ),
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта, интересные факты",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_5.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта, интересные факты",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_6.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта, интересные факты",
                )
            )
        );    
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid gallery gallery_4" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
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
            'title' => "Галерея работ",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                ),
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_5.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_6.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid gallery gallery_5" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
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
            'title' => "Галерея работ",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid gallery gallery_6" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
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
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                    'img_6' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",                   
                    'img_title_6' => "Дорога в облака",
                    'img_desc_6' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_7($val) {?>
        <div class="container-fluid gallery gallery_7" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
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
                                    <a class="big_img" href="/" title="Дорога в облака">
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
                                    <a class="big_img" href="/img/217204_1200/gallery_6.jpg" title="Дорога в облака">
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
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                    'img_6' => "templater_modules/lpcandy/assets/gallery/gallery_6.jpg",                   
                    'img_title_6' => "Дорога в облака",
                    'img_desc_6' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_8($val) {?>
        <div class="container-fluid gallery gallery_7" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">           
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$val['title'] ?>
                    </h1>
                    
                    <div class="item_list clear">
                      <? foreach ($val['items'] as $sub): ?>
                        <div class="img_side">
                            <div class="img img_w1 img_h2">
                                <a class="big_img" href="" title="Дорога в облака">
                                    <div class="preview_img" style="background-image: url('/img/217204_600/gallery_1.jpg');"></div>
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
                                    <div class="preview_img" style="background-image: url('/img/217201_600/gallery_2.jpg');"></div>
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
                                    <div class="preview_img" style="background-image: url('/img/217199_600/gallery_3.jpg');"></div>
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
                                    <div class="preview_img" style="background-image: url('/img/217206_600/gallery_4.jpg');"></div>
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
                                    <div class="preview_img" style="background-image: url('/img/217202_600/gallery_5.jpg');"></div>
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
                            <div style="clear: both"></div>
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
                    'img_1' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'img_2' => "templater_modules/lpcandy/assets/gallery/gallery_2.jpg",
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'img_3' => "templater_modules/lpcandy/assets/gallery/gallery_3.jpg",
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
                    'img_4' => "templater_modules/lpcandy/assets/gallery/gallery_4.jpg",
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                    'img_5' => "templater_modules/lpcandy/assets/gallery/gallery_1.jpg",                   
                    'img_title_5' => "Дорога в облака",
                    'img_desc_5' => "Подробное описание проекта",
                    'img_6' => "templater_modules/lpcandy/assets/gallery/gallery_6.jpg",                   
                    'img_title_6' => "Дорога в облака",
                    'img_desc_6' => "Подробное описание проекта",
                )
            )
        );    
    }
    
}

Gallery::register();