<?php

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
    
    function item_default($url) {
        return array(
            'image' => "view/editor/assets/gallery/".$url,
            'title' => 'Заголовок картинки',
            'desc' => 'Описание картинки',
        );
    }
    
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
                $this->item_default('21.jpg'),
                $this->item_default('24.jpg'),
                $this->item_default('25.jpg'),
                $this->item_default('26.jpg'),
                $this->item_default('27.jpg'),
                $this->item_default('30.jpg'),                
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
                                                <? $self->sub('Text','image_title_'.$i,Text::$plain_heading) ?>
                                            </div>
                                            <? if ($cls = $self->vis($val['show_image_desc'])): ?>
                                                <div class="img_desc <?=$cls?>" >
                                                    <? $self->sub('Text','image_desc_'.$i,Text::$color_heading) ?>
                                                </div>
                                            <? endif ?>
                                            <div class="img_text">
                                                <? $self->sub('Text','image_text_'.$i,Text::$default_text) ?>
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
					'image_1' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/1.jpg')),                   
                    'image_title_1' => "Заголовок картинки",
					'image_desc_1' => "Описание картинки",
					'image_text_1' => "Еще одно описание картинки. Краткость - сестра таланта.",
					'image_2' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/2.jpg')),
                    'image_title_2' => "Заголовок картинки",
					'image_desc_2' => "Описание картинки",
					'image_text_2' => "Еще одно описание картинки. Краткость - сестра таланта.",
				),
				array(
					'image_1' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/3.jpg')),
                    'image_title_1' => "Заголовок картинки",
					'image_desc_1' => "Описание картинки",
					'image_text_1' => "Еще одно описание картинки. Краткость - сестра таланта.",
					'image_2' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/4.jpg')),
                    'image_title_2' => "Заголовок картинки",
					'image_desc_2' => "Описание картинки",
					'image_text_2' => "Еще одно описание картинки. Краткость - сестра таланта.",
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
                    'image_1' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/1.jpg')),                   
                    'img_title_1' => "Заголовок картинки",
                    'img_desc_1' => "Еще одно описание картинки. Краткость - сестра таланта.",
                    'image_2' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/2.jpg')),                   
                    'img_title_2' => "Заголовок картинки",
                    'img_desc_2' => "Еще одно описание картинки. Краткость - сестра таланта.",
                    'image_3' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/3.jpg')),                   
                    'img_title_3' => "Заголовок картинки",
                    'img_desc_3' => "Еще одно описание картинки. Краткость - сестра таланта.",
                ),
                array(
                    'image_1' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/4.jpg')),                   
                    'img_title_1' => "Заголовок картинки",
                    'img_desc_1' => "Еще одно описание картинки. Краткость - сестра таланта.",
                    'image_2' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/5.jpg')),                   
                    'img_title_2' => "Заголовок картинки",
                    'img_desc_2' => "Еще одно описание картинки. Краткость - сестра таланта.",
                    'image_3' => array_merge(GalleryImage::tpl_default(),array('image'=>'view/editor/assets/gallery/6.jpg')),                   
                    'img_title_3' => "Заголовок картинки",
                    'img_desc_3' => "Еще одно описание картинки. Краткость - сестра таланта.",
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
                    'image_1' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/1.jpg')),                   
                    'img_title_1' => "Заголовок картинки",
                    'img_desc_1' => "Краткость - сестра таланта.",
                    'image_2' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/2.jpg')),                   
                    'img_title_2' => "Заголовок картинки",
                    'img_desc_2' => "Краткость - сестра таланта.",
                    'image_3' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/3.jpg')),                   
                    'img_title_3' => "Заголовок картинки",
                    'img_desc_3' => "Краткость - сестра таланта.",
					'image_4' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/4.jpg')),                   
                    'img_title_4' => "Заголовок картинки",
                    'img_desc_4' => "Краткость - сестра таланта.",
                ),
                array(
                    'image_1' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/5.jpg')),                   
                    'img_title_1' => "Заголовок картинки",
                    'img_desc_1' => "Краткость - сестра таланта.",
                    'image_2' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/6.jpg')),                   
                    'img_title_2' => "Заголовок картинки",
                    'img_desc_2' => "Краткость - сестра таланта.",
                    'image_3' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/7.jpg')),                   
                    'img_title_3' => "Заголовок картинки",
                    'img_desc_3' => "Краткость - сестра таланта.",
					'image_4' => array_merge(GalleryImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/8.jpg')),                   
                    'img_title_4' => "Заголовок картинки",
                    'img_desc_4' => "Краткость - сестра таланта.",
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
                            <? $id_group = $val['id']; ?>
							<? $this->repeat('items', function($item_val,$self) use ($val,$id_group){ ?>                                
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
    
	function item_default_5($url) {
        return array(
            'image' => "view/editor/assets/gallery/".$url,
            'title' => 'Заголовок картинки',
            'desc' => 'Описание картинки',
        );
    }
    
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
                $this->item_default_5('1.jpg'),
                $this->item_default_5('2.jpg'),
                $this->item_default_5('3.jpg'),
                $this->item_default_5('4.jpg'),
                $this->item_default_5('5.jpg'),
                $this->item_default_5('6.jpg'),
                $this->item_default_5('7.jpg'),
                $this->item_default_5('8.jpg'),
                $this->item_default_5('9.jpg'),
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
                        <? $id_group = $val['id']; ?>
						<? $this->repeat('items', function($item_val,$self) use ($val, $id_group){ ?>                            						
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
                $this->item_default_6('11.jpg'),
                $this->item_default_6('12.jpg'),
                $this->item_default_6('13.jpg'),
                $this->item_default_6('14.jpg'),
				$this->item_default_6('15.jpg'),
                $this->item_default_6('16.jpg'),
                $this->item_default_6('17.jpg'),
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
					'image_1' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/30.jpg')),
                    'image_2' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/22.jpg')),
                    'image_3' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/21.jpg')),
                    'image_4' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/25.jpg')),
                    'image_5' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/28.jpg')),
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
                    'image_1' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/25.jpg')),
                    'image_2' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/26.jpg')),
                    'image_3' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/30.jpg')),
                    'image_4' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/24.jpg')),
                    'image_5' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/21.jpg')),
					'image_6' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/27.jpg')),
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
                    'image_1' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/23.jpg')),
                    'image_2' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/28.jpg')),
                    'image_3' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/29.jpg')),
                    'image_4' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/30.jpg')),
                    'image_5' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/21.jpg')),
					'image_6' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/22.jpg')),
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
                    'image_1' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/21.jpg')),
                    'image_2' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/22.jpg')),
                    'image_3' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/23.jpg')),
                    'image_4' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/24.jpg')),
                    'image_5' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/25.jpg')),
					'image_6' => array_merge(OverlayImage::tpl_default(),array('image'=> 'view/editor/assets/gallery/26.jpg')),
				)
            )
        );    
    }
}

Gallery::register();