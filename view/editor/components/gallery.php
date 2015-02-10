<?php

namespace LPCandy\Components;

class Gallery extends Block {
    public $name = 'Галерея';
    public $description = "Фотографии работ";
    public $editor = "lp.gallery";
    
    function tpl($val) {?>		
        <div class="container-fluid gallery gallery_1" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                    <div class="item_list <?=$opacity?>"> 
						<? $this->repeat('items', function($item_val,$self) use ($val) { ?>							
                            <div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$item_val['image']?>');"></div>
                                <? if ($cls = $self->vis($val['enable_fancybox'])): ?>
                                    <a class="fancybox big_img <?=$cls?>" href="<?=INDEX_URL."/".$item_val['image']?>" title="<?=$item_val['title']?>"></a>
                                <? endif ?>
                            <div class="overlay">
                                <div class="wrap_title_desc">
                                    <? if ($cls = $self->vis($val['show_image_title'])): ?>
                                        <div class="img_title <?=$cls?>" >
                                            <?= $item_val['title'] ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                        <div class="img_desc <?=$cls?>" >
                                            <?= $item_val['desc'] ?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>                           	
						<? },array('editor' => 'lp.galleryRepeater'));?> 
					</div> 
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
            'enable_fancybox' => true,
            'background' =>'#FFFFFF',
            'title' => "Наша программа в фотографиях",
            'title_2' => "Подзаголовок",
            'items' => array(
                array( 'image' => "view/editor/assets/gallery/21.jpg", 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах' ),
                array( 'image' => "view/editor/assets/gallery/24.jpg", 'title' => 'Бивень', 'desc' => 'Дрессированный носорог' ),
                array( 'image' => "view/editor/assets/gallery/25.jpg", 'title' => 'Прыгун', 'desc' => 'Номер с конём' ),
                array( 'image' => "view/editor/assets/gallery/26.jpg", 'title' => 'Ламбада', 'desc' => 'Танцующие слоны' ),
                array( 'image' => "view/editor/assets/gallery/27.jpg", 'title' => 'Тигрица', 'desc' => 'Это та, что слева' ),
                array( 'image' => "view/editor/assets/gallery/30.jpg", 'title' => 'Грация', 'desc' => 'Девушка на лентах' ),            
            )
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid gallery gallery_2" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                     <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list <?= !$val['show_image_desc'] ? "hide_desc" : "" ?> <?= !$val['show_image_overlay'] ? "hide_overlay" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1; $i <= 2; $i++): ?>
                                <div class="item">
                                    <?=$self->sub('GalleryImage','image_'.$i)?>
                                    <div class="overlay">
                                        <div class="in">                                        
                                            <div class="img_title">
                                                <? $self->sub('Text','img_title_'.$i,Text::$plain_heading) ?>
                                            </div>
                                            <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                <div class="img_desc <?=$cls?>" >
                                                    <? $self->sub('Text','img_desc_'.$i,Text::$color_heading) ?>
                                                </div>
                                            <? endif ?>
                                            <div class="img_text">
                                                <? $self->sub('Text','img_text_'.$i,Text::$default_text) ?>
                                            </div>
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
    
    function tpl_default_2() { 
        return  array(
			'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
            'background' => '#FFFFFF',
            'title' => "Наша Прима",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/1.jpg'),
                    'img_title_1' => "В кольце",
                    'img_desc_1' => "Завораживающее зрелище",
                    'img_text_1' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                    'image_2' => array('image'=> 'view/editor/assets/gallery/2.jpg'),
                    'img_title_2' => "У входа",                    
                    'img_desc_2' => "На входе встречает она",
                    'img_text_2' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                ),
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/5.jpg'),
                    'img_title_1' => "Форма №2",
                    'img_desc_1' => "Голый торс",
                    'img_text_1' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                    'image_2' => array('image'=> 'view/editor/assets/gallery/6.jpg'),
                    'img_title_2' => "Прима и клоун",
                    'img_desc_2' => "Номер с фокусами",
                    'img_text_2' => "Дополнительное описание картинки. Краткость - сестра таланта.",
                )
            )
        );    
    }
    
    function tpl_3($val) {?>
        <div class="container-fluid gallery gallery_3" style="background: <?=$val['background']?>;">
           <div class="container">
                <div class="span16">
                     <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1; $i <= 3; $i++): ?>                        
                                <div class="item">								
                                    <? $self->sub('GalleryImage','image_'.$i) ?>
                                    <? if ($cls = $self->vis($val['show_image_overlay'])): ?>
                                        <div class="overlay <?=$cls?>" >
                                            <div class="img_title">
                                                <? $self->sub('Text','img_title_'.$i,Text::$plain_heading) ?>
                                            </div>
                                            <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                <div class="img_desc <?=$cls?>" >
                                                    <? $self->sub('Text','img_desc_'.$i,Text::$default_text) ?>
                                                </div>
                                            <? endif ?>
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
    
    function tpl_default_3() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Просто хорошая девушка",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/1.jpg'),
                    'img_title_1' => "В кольце",
                    'img_desc_1' => "Завораживающее зрелище",
                    'image_2' => array('image'=> 'view/editor/assets/gallery/2.jpg'),                   
                    'img_title_2' => "У входа",
                    'img_desc_2' => "На входе встречает она",
                    'image_3' => array('image'=> 'view/editor/assets/gallery/3.jpg'),
                    'img_title_3' => "Метание ножей",
                    'img_desc_3' => "Опасный трюк с ножами",
                ),
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/5.jpg'),
                    'img_title_1' => "Форма №2",
                    'img_desc_1' => "Голый торс",
                    'image_2' => array('image'=> 'view/editor/assets/gallery/6.jpg'),                   
                    'img_title_2' => "Прима и клоун",
                    'img_desc_2' => "Номер с фокусами",
                    'image_3' => array('image'=> 'view/editor/assets/gallery/7.jpg'),
                    'img_title_3' => "Ноги от ушей",
                    'img_desc_3' => "От 16 и старше",

                )
            )
        );    
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid gallery gallery_4" style="background: <?=$val['background']?>;">
           <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1; $i <= 4; $i++): ?>                            
                                <div class="item">								
                                    <? $self->sub('GalleryImage','image_'.$i) ?>
                                    <? if ($cls = $self->vis($val['show_image_overlay'])): ?>
                                        <div class="overlay <?=$cls?>" >
                                            <div class="img_title">
                                                <? $self->sub('Text','img_title_'.$i,Text::$plain_heading) ?>
                                            </div>
                                            <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                <div class="img_desc <?=$cls?>" >
                                                    <? $self->sub('Text','img_desc_'.$i,Text::$default_text) ?>
                                                </div>
                                            <? endif ?>
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
    
    function tpl_default_4() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Изящная чертовка",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/1.jpg'),
                    'img_title_1' => "В кольце",
                    'img_desc_1' => "Завораживающее зрелище",
                    'image_2' => array('image'=> 'view/editor/assets/gallery/2.jpg'),                   
                    'img_title_2' => "У входа",
                    'img_desc_2' => "На входе встречает она",
                    'image_3' => array('image'=> 'view/editor/assets/gallery/3.jpg'),
                    'img_title_3' => "Метание ножей",
                    'img_desc_3' => "Опасный трюк с ножами",
					'image_4' => array('image'=> 'view/editor/assets/gallery/4.jpg'),                   
                    'img_title_4' => "Обилечивание",
                    'img_desc_4' => "У кассы снова прима",
                ),
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/5.jpg'),                   
                    'img_title_1' => "Форма №2",
                    'img_desc_1' => "Голый торс",
                    'image_2' => array('image'=> 'view/editor/assets/gallery/6.jpg'),                   
                    'img_title_2' => "Прима и клоун",
                    'img_desc_2' => "Номер с фокусами",
                    'image_3' => array('image'=> 'view/editor/assets/gallery/7.jpg'),                   
                    'img_title_3' => "Ноги от ушей",
                    'img_desc_3' => "От 16 и старше",
					'image_4' => array('image'=> 'view/editor/assets/gallery/8.jpg'),
                    'img_title_4' => "В гримёрке",
                    'img_desc_4' => "Перед выходом на сцену",
                )
            )
        );    
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid gallery gallery_5" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
					<div class="item_list clear <?=$opacity?>">
						<div class="slider">
							<? $this->repeat('items', function($item_val,$self) use ($val){ ?>                                
                                <div class="preview_img">									
                                    <img src="<?=INDEX_URL."/".$item_val['image']?>">
                                    <? if ($cls = $self->vis($val['enable_fancybox'])): ?>
                                        <a class="fancybox big_img <?=$cls?>" href="<?=INDEX_URL."/".$item_val['image']?>" title="<?=$item_val['title']?>"></a>
                                    <? endif ?>                                        
                                </div>                                    
                                <div class="overlay">
                                    <div class="wrap_title_desc">
                                        <? if ($cls = $self->vis($val['show_image_title'])): ?>
                                            <div class="img_title <?=$cls?>" >
                                                <?= $item_val['title'] ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                            <div class="img_desc <?=$cls?>" >
                                                <?= $item_val['desc'] ?>
                                            </div>
                                        <? endif ?>
                                    </div>
                                </div>                                
							<? },array('editor'=>'lp.galleryRepeater','sortable'=>false));?>											
						</div>
					</div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_5() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' => '#F7F7F7',
            'title' => "Активистка, комсомолка и просто...",
            'title_2' => "Подзаголовок",
            'items' => array(
                array( 'image' => "view/editor/assets/gallery/1.jpg", 'title' => 'В кольце', 'desc' => 'Завораживающее зрелище' ),
                array( 'image' => "view/editor/assets/gallery/2.jpg", 'title' => 'У входа', 'desc' => 'На входе встречает она' ),
                array( 'image' => "view/editor/assets/gallery/3.jpg", 'title' => 'Метание ножей', 'desc' => 'Опасный трюк с ножами' ),
                array( 'image' => "view/editor/assets/gallery/4.jpg", 'title' => 'Обилечивание', 'desc' => 'У кассы снова прима' ),
                array( 'image' => "view/editor/assets/gallery/5.jpg", 'title' => 'Форма №2', 'desc' => 'Голый торс' ),
                array( 'image' => "view/editor/assets/gallery/6.jpg", 'title' => 'Прима и клоун', 'desc' => 'Номер с фокусами' ),  
                array( 'image' => "view/editor/assets/gallery/7.jpg", 'title' => 'Ноги от ушей', 'desc' => 'От 16 и старше' ),
                array( 'image' => "view/editor/assets/gallery/8.jpg", 'title' => 'В гримёрке', 'desc' => 'Перед выходом на сцену' ),
                array( 'image' => "view/editor/assets/gallery/9.jpg", 'title' => 'Качели', 'desc' => 'Прима под куполом' ), 
            )
        );
    }
    
     
	function tpl_6($val) {?>		
        <div class="container-fluid gallery gallery_6" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                    <div class="item_list masonry <?=$opacity?>">
						<? $this->repeat('items', function($item_val,$self) use ($val){ ?>
                            <div class="preview_img">									
                                <img src="<?=INDEX_URL."/".$item_val['image']?>">
                                <? if ($cls = $self->vis($val['enable_fancybox'])): ?>
                                    <a class="fancybox big_img <?=$cls?>" href="<?=INDEX_URL."/".$item_val['image']?>" title="<?=$item_val['title']?>"></a>
                                <? endif ?> 
                            </div>
                            <div class="overlay">
                                <div class="outer">
                                    <div class="wrap_title_desc">
                                        <? if ($cls = $self->vis($val['show_image_title'])): ?>
                                            <div class="img_title <?=$cls?>" >
                                                <?= $item_val['title'] ?>
                                            </div>
                                        <? endif ?>
                                        <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                            <div class="img_desc <?=$cls?>" >
                                                <?= $item_val['desc'] ?>
                                            </div>
                                        <? endif ?>
                                    </div>
                                </div>
                            </div>
						<? },array('editor'=>'lp.galleryRepeater','sortable'=>false));?> 
					</div> 
                </div>
            </div>
        </div>
    <?}
    
    function item_default_6($url) {
        return array(
            'image' => "view/editor/assets/gallery/".$url,
            'title' => 'Заголовок картинки',
            'desc' => 'Описание картинки',
        );
    }
    
    function tpl_default_6() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' =>'#FFFFFF',
            'title' => "Фото цирковых номеров",
            'title_2' => "Подзаголовок",
            'items' => array(
                array( 'image' => "view/editor/assets/gallery/11.jpg", 'title' => 'Клоун Жора', 'desc' => 'Смехун цирка №1' ),
                array( 'image' => "view/editor/assets/gallery/12.jpg", 'title' => 'Жонглёры', 'desc' => 'Высёлые ребята' ),
                array( 'image' => "view/editor/assets/gallery/13.jpg", 'title' => 'Клоун Клёва', 'desc' => 'Весёлые фокусы-покусы' ),
                array( 'image' => "view/editor/assets/gallery/14.jpg", 'title' => 'Парящие', 'desc' => 'Пара в воздухе' ),
                array( 'image' => "view/editor/assets/gallery/15.jpg", 'title' => 'Фигура', 'desc' => 'Девушки под куполом цирка' ),
                array( 'image' => "view/editor/assets/gallery/16.jpg", 'title' => 'Питон и Жора', 'desc' => 'Опасный номер' ),  
                array( 'image' => "view/editor/assets/gallery/17.jpg", 'title' => 'Бегемотица с шаром', 'desc' => 'Капибара и женщина с шаром' ), 
            )
        );
    }
	
    
function tpl_7($val) {?>
        <div class="container-fluid gallery gallery_7" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                    <div class="item_list clear <?=$opacity?>">
						<? $this->repeat('items',function($item_val,$self) use ($val) { ?>
							<div class="img_double"> 
								<div class="img img_w2 img_h2">
									<? $self->sub('OverlayImage','image_1') ?>	
								</div>
							</div>
							<div class="img_side">
                                <? for ($i=2; $i <= 5; $i++): ?>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('OverlayImage','image_'.$i) ?>
                                    </div>	
                                <? endfor ?>
							</div>
							<div style="clear: both"></div>
						<? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_7() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея цирковых номеров",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
					'image_1' => array('image'=> 'view/editor/assets/gallery/30.jpg', 'title' => 'Грация', 'desc' => 'Девушка на лентах'),
                    'image_2' => array('image'=> 'view/editor/assets/gallery/22.jpg', 'title' => 'Коршун Веня', 'desc' => 'Веня сидит на бочке'),
                    'image_3' => array('image'=> 'view/editor/assets/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
                    'image_4' => array('image'=> 'view/editor/assets/gallery/25.jpg', 'title' => 'Прыгун', 'desc' => 'Номер с конём'),
                    'image_5' => array('image'=> 'view/editor/assets/gallery/28.jpg', 'title' => 'Живое время', 'desc' => 'Девушки имитируют часы'),
                )
            )
        );    
    }
    
    
    function tpl_8($val) {?>
        <div class="container-fluid gallery gallery_8" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                    <div class="item_list clear <?=$opacity?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="img_side">
                                <div class="img img_w1 img_h2">
                                    <? $self->sub('OverlayImage','image_1') ?> 
                                </div>
                                <div class="img img_w1 img_h1">
                                    <? $self->sub('OverlayImage','image_2') ?> 
                                </div>
                            </div>
                            <div class="img_double">
                                <div class="img img_w2 img_h1">
                                    <? $self->sub('OverlayImage','image_3') ?> 
                                </div>
                                <div class="img img_w1 img_h1">
                                    <? $self->sub('OverlayImage','image_4') ?> 
                                </div>
                                <div class="img img_w1 img_h1">
                                    <? $self->sub('OverlayImage','image_5') ?>
                                </div>
                                <div class="img img_w2 img_h1">
                                    <? $self->sub('OverlayImage','image_6') ?>
                                </div>                                
                            </div>                            
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_8() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Фото нашей работы",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/25.jpg', 'title' => 'Прыгун', 'desc' => 'Номер с конём'),
                    'image_2' => array('image'=> 'view/editor/assets/gallery/26.jpg', 'title' => 'Ламбада', 'desc' => 'Танцующие слоны'),
                    'image_3' => array('image'=> 'view/editor/assets/gallery/30.jpg', 'title' => 'Грация', 'desc' => 'Девушка на лентах'),
                    'image_4' => array('image'=> 'view/editor/assets/gallery/24.jpg', 'title' => 'Бивень', 'desc' => 'Дрессированный носорог'),
                    'image_5' => array('image'=> 'view/editor/assets/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
					'image_6' => array('image'=> 'view/editor/assets/gallery/27.jpg', 'title' => 'Тигрица', 'desc' => 'Это та, что слева'),
				) 
            )
        );    
    }
    
    
    function tpl_9($val) {?>
        <div class="container-fluid gallery gallery_9" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                    <div class="item_list clear <?=$opacity?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                    
                                <div class="img_double">
                                    <div class="img img_w3 img_h2">
                                        <? $self->sub('OverlayImage','image_1') ?>
                                    </div>
                                </div>
                                <div class="img_side">
                                    <div class="img img_w2 img_h1">
                                        <? $self->sub('OverlayImage','image_2') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('OverlayImage','image_3') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('OverlayImage','image_4') ?>
                                    </div>                                    
                                </div>
                                <div class="img img_w2 img_h1">
                                    <? $self->sub('OverlayImage','image_5') ?>
                                </div>
                                <div class="img img_w3 img_h1">
                                    <? $self->sub('OverlayImage','image_6') ?>
                                </div>
                                <div style="clear: both"></div>
                            <? }) ?>
                        </div>                    
                    </div>
                </div>
            </div>

    <?}
    
    function tpl_default_9() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея цирковых выступлений",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/23.jpg', 'title' => 'Чехарда', 'desc' => 'Люди в синих трениках'),
                    'image_2' => array('image'=> 'view/editor/assets/gallery/28.jpg', 'title' => 'Живое время', 'desc' => 'Девушки имитируют часы'),
                    'image_3' => array('image'=> 'view/editor/assets/gallery/29.jpg', 'title' => 'Лунтики', 'desc' => 'Полёт людей на луну'),
                    'image_4' => array('image'=> 'view/editor/assets/gallery/30.jpg', 'title' => 'Грация', 'desc' => 'Девушка на лентах'),
                    'image_5' => array('image'=> 'view/editor/assets/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
					'image_6' => array('image'=> 'view/editor/assets/gallery/22.jpg', 'title' => 'Коршун Веня', 'desc' => 'Веня сидит на бочке'),
				)                
            )
        );    
    }
    
    
    function tpl_10($val) {?>
        <div class="container-fluid gallery gallery_10" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_heading) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                    <? (!$val['show_image_title'] && !$val['show_image_desc']) ? $opacity ='no_opacity': $opacity ='' ?>
                    <div class="item_list clear <?=$opacity?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                    
                                <div class="img_side">
                                    <div class="img img_w1 img_h2">
                                        <? $self->sub('OverlayImage','image_1') ?>
                                    </div>
                                </div>
                                <div class="img_double">
                                    <div class="img img_w2 img_h1">
                                       <? $self->sub('OverlayImage','image_2') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('OverlayImage','image_3') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('OverlayImage','image_4') ?>
                                    </div>
                                    <div class="img img_w2 img_h1">
                                        <? $self->sub('OverlayImage','image_5') ?>
                                    </div>
                                </div>
                                <div style="clear: both"></div>
                            <? }) ?>
                        </div>                    
                    </div>
                </div>
            </div>

    <?}
    
    function tpl_default_10() { 
        return  array(
            'show_title' => true,
            'show_title_2' => false,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => array('image'=> 'view/editor/assets/gallery/21.jpg', 'title' => 'Трое в шляпах', 'desc' => 'Акробаты на канатах'),
                    'image_2' => array('image'=> 'view/editor/assets/gallery/22.jpg', 'title' => 'Коршун Веня', 'desc' => 'Веня сидит на бочке'),
                    'image_3' => array('image'=> 'view/editor/assets/gallery/23.jpg', 'title' => 'Чехарда', 'desc' => 'Люди в синих трениках'),
                    'image_4' => array('image'=> 'view/editor/assets/gallery/24.jpg', 'title' => 'Бивень', 'desc' => 'Дрессированный носорог'),
                    'image_5' => array('image'=> 'view/editor/assets/gallery/25.jpg', 'title' => 'Прыгун', 'desc' => 'Номер с конём'),
					'image_6' => array('image'=> 'view/editor/assets/gallery/26.jpg', 'title' => 'Ламбада', 'desc' => 'Танцующие слоны'),
				)
            )
        );    
    }
}