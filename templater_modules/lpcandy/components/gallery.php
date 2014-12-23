<?php

class Gallery extends Block {
    public $name = 'Gallery';
    public $description = "Photo and image";
    public $editor = "lp.gallery";
    
    function tpl($val) {?>		
        <div class="container-fluid gallery gallery_1" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list">
						<? $this->repeat('items', function($item_val,$self) use ($val){ ?>
							<a class="fancybox big_img" rel="<?=$item_val['fancybox_group']?>" href="<?=INDEX_URL."/".$item_val['image']?>" title="<?=$item_val['title']?>">
								<div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$item_val['image']?>');"></div>
								<div class="overlay">
									<div class="wrap_title_desc">
										<? if ($val['show_image_title'] || $self->edit): ?>
											<div class="img_title" <?= !$val['show_image_title'] ? "style='display:none'" : "" ?> >
												<?= $item_val['title'] ?>
											</div>
										<? endif ?>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<?= $item_val['desc'] ?>
											</div>
										<? endif ?>
									</div>
								</div>
							</a>
						<? },array('editor' => 'lp.galleryRepeater'));?> 
					</div> 
                </div>
            </div>
        </div>
    <?}
    
    function item_default($url) {
        return array(
            'image' => "templater_modules/lpcandy/assets/gallery/preview_image/".$url,
            'title' => 'Заголовок картинки',
            'desc' => 'Описание картинки',
			'fancybox_group' => 'group_1',
        );
    }
    
    function tpl_default() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_image_title' => true,
            'show_image_desc' => true,
            'background' =>'#FFFFFF',
            'title' => "Галерея работ 1",
            'title_2' => "Подзаголовок",
            'items' => array(
                $this->item_default('1.jpg'),
                $this->item_default('2.jpg'),
                $this->item_default('3.jpg'),
                $this->item_default('4.jpg'),
                $this->item_default('5.jpg'),
                $this->item_default('6.jpg'),                
            )
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid gallery gallery_2" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                     <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list <?= !$val['show_image_desc'] ? "hide_desc" : "" ?> <?= !$val['show_image_overlay'] ? "hide_overlay" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
							<div class="item">
								<?=$self->sub('Image','image_1')?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay">
										<div class="img_title">
											<? $self->sub('Text','image_title_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','image_desc_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor","removeformat"))) ?>
											</div>
										<? endif ?>
										<div class="img_text">
											<? $self->sub('Text','image_text_1',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
										</div>
									</div>
								<? endif ?>
							</div>
							<div class="item">
								<?=$self->sub('Image','image_2')?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay">
										<div class="img_title">
											<? $self->sub('Text','image_title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','image_desc_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor","removeformat"))) ?>
											</div>
										<? endif ?>
										<div class="img_text">
											<? $self->sub('Text','image_text_2',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
										</div>
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
            'show_title_2' => true,
			'show_image_desc' => true,
			'show_image_overlay' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея работ 2",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
					'image_1' => "templater_modules/lpcandy/assets/gallery/preview_image/1.jpg",                   
					'image_title_1' => "Дорога в облака",
					'image_desc_1' => "Подпись к фото",
					'image_text_1' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
					'image_2' => "templater_modules/lpcandy/assets/gallery/preview_image/2.jpg",
					'image_title_2' => "Дорога в облака",
					'image_desc_2' => "Подпись к фото",
					'image_text_2' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
				),
				array(
					'image_1' => "templater_modules/lpcandy/assets/gallery/preview_image/3.jpg",                   
					'image_title_1' => "Дорога в облака",
					'image_desc_1' => "Подпись к фото",
					'image_text_1' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
					'image_2' => "templater_modules/lpcandy/assets/gallery/preview_image/4.jpg",
					'image_title_2' => "Дорога в облака",
					'image_desc_2' => "Подпись к фото",
					'image_text_2' => "Подробное описание проекта, интересные факты, подробное описание проекта, интересные факты",
				)
            )
        );    
    }
    
    function tpl_3($val) {?>
        <div class="container-fluid gallery gallery_3" style="background: <?=$val['background']?>;">
           <div class="container">
                <div class="span16">
                     <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                         <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">								
								<? $self->sub('ImageFancyboxWithoutTitle','imageFancybox_1') ?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay" <?= !$val['show_image_overlay'] ? "style='display:none'" : "" ?>>
										<div class="img_title">
											<? $self->sub('Text','img_title_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','img_desc_1',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
											</div>
										<? endif ?>
									</div>
								<? endif ?>
							</div>
							<div class="item">
								<? $self->sub('ImageFancyboxWithoutTitle','imageFancybox_2') ?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay" <?= !$val['show_image_overlay'] ? "style='display:none'" : "" ?>>
										<div class="img_title">
											<? $self->sub('Text','img_title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','img_desc_2',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
											</div>
										<? endif ?>
									</div>
								<? endif ?>
							</div>
                            <div class="item">
								<? $self->sub('ImageFancyboxWithoutTitle','imageFancybox_3') ?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay" <?= !$val['show_image_overlay'] ? "style='display:none'" : "" ?>>
										<div class="img_title">
											<? $self->sub('Text','img_title_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','img_desc_3',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
											</div>
										<? endif ?>
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
    
    function tpl_default_3() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея работ 3",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'imageFancybox_1' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/1.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/1.jpg','fancybox_group' => 'group_3')),                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта, интересные факты",
                    'imageFancybox_2' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/2.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/2.jpg','fancybox_group' => 'group_3')),                   
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта, интересные факты",
                    'imageFancybox_3' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/3.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_3')),                   
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта, интересные факты",
                ),
                array(
                    'imageFancybox_1' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/4.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/4.jpg','fancybox_group' => 'group_3')),                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта, интересные факты",
                    'imageFancybox_2' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/5.jpg','fancybox_group' => 'group_3')),                   
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта, интересные факты",
                    'imageFancybox_3' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/6.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/6.jpg','fancybox_group' => 'group_3')),                   
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта, интересные факты",
                )
            )
        );    
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid gallery gallery_4" style="background: <?=$val['background']?>;">
           <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                         <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="item">								
								<? $self->sub('ImageFancyboxWithoutTitle','imageFancybox_1') ?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay" <?= !$val['show_image_overlay'] ? "style='display:none'" : "" ?>>
										<div class="img_title">
											<? $self->sub('Text','img_title_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','img_desc_1',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
											</div>
										<? endif ?>
									</div>
								<? endif ?>
							</div>
							<div class="item">
								<? $self->sub('ImageFancyboxWithoutTitle','imageFancybox_2') ?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay" <?= !$val['show_image_overlay'] ? "style='display:none'" : "" ?>>
										<div class="img_title">
											<? $self->sub('Text','img_title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','img_desc_2',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
											</div>
										<? endif ?>
									</div>
								<? endif ?>
							</div>
                            <div class="item">
								<? $self->sub('ImageFancyboxWithoutTitle','imageFancybox_3') ?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay" <?= !$val['show_image_overlay'] ? "style='display:none'" : "" ?>>
										<div class="img_title">
											<? $self->sub('Text','img_title_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','img_desc_3',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
											</div>
										<? endif ?>
									</div>
								<? endif ?>
							</div>
							<div class="item">
								<? $self->sub('ImageFancyboxWithoutTitle','imageFancybox_4') ?>
								<? if ($val['show_image_overlay'] || $self->edit): ?>
									<div class="overlay" <?= !$val['show_image_overlay'] ? "style='display:none'" : "" ?>>
										<div class="img_title">
											<? $self->sub('Text','img_title_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=> true)) ?>
										</div>
										<? if ($val['show_image_desc'] || $self->edit): ?>
											<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
												<? $self->sub('Text','img_desc_4',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"))) ?>
											</div>
										<? endif ?>
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
    
    function tpl_default_4() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
			'show_image_desc' => true,
			'show_image_overlay' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея работ 4",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'imageFancybox_1' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/1.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/1.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'imageFancybox_2' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/2.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/2.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'imageFancybox_3' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/3.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
					'imageFancybox_4' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/6.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                ),
                array(
                    'imageFancybox_1' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/4.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/4.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_1' => "Дорога в облака",
                    'img_desc_1' => "Подробное описание проекта",
                    'imageFancybox_2' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/5.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_2' => "Дорога в облака",
                    'img_desc_2' => "Подробное описание проекта",
                    'imageFancybox_3' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/6.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/6.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_3' => "Дорога в облака",
                    'img_desc_3' => "Подробное описание проекта",
					'imageFancybox_4' => array_merge(ImageFancyboxWithoutTitle::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/3.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_4')),                   
                    'img_title_4' => "Дорога в облака",
                    'img_desc_4' => "Подробное описание проекта",
                )
            )
        );    
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid gallery gallery_5" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
					<div class="item_list clear">
						<div class="bxslider">
							<? $this->repeat('items', function($item_val,$self) use ($val){ ?>
                                <a class="fancybox big_img" rel="<?=$item_val['fancybox_group']?>" href="<?=INDEX_URL."/".$item_val['image']?>" title="<?=$item_val['title']?>">
                                    <div class="preview_img">									
                                        <img src="<?=INDEX_URL."/".$item_val['image']?>">
                                    </div>
                                    <div class="overlay">
                                        <div class="wrap_title_desc">
                                            <? if ($val['show_image_title'] || $self->edit): ?>
                                                <div class="img_title" <?= !$val['show_image_title'] ? "style='display:none'" : "" ?> >
                                                    <?= $item_val['title'] ?>
                                                </div>
                                            <? endif ?>
                                            <? if ($val['show_image_desc'] || $self->edit): ?>
                                                <div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
                                                    <?= $item_val['desc'] ?>
                                                </div>
                                            <? endif ?>
                                        </div>
                                    </div>
                                </a>
							<? },array('editor' => 'lp.galleryRepeaterImg'));?>											
						</div>
					</div>
                </div>
            </div>
        </div>
    <?} 

	function item_default_5($url) {
        return array(
            'image' => "templater_modules/lpcandy/assets/gallery/preview_image/".$url,
            'title' => 'Заголовок картинки',
            'desc' => 'Описание картинки',
			'fancybox_group' => 'group_5',
        );
    }
    
    function tpl_default_5() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' => '#F7F7F7',
            'title' => "Галерея работ 5",
            'title_2' => "Подзаголовок",
            'items' => array(
                $this->item_default_5('1.jpg'),
                $this->item_default_5('2.jpg'),
                $this->item_default_5('3.jpg'),
                $this->item_default_5('4.jpg'),
                $this->item_default_5('5.jpg'),
                $this->item_default_5('3.jpg'),
                $this->item_default_5('5.jpg'),
                $this->item_default_5('6.jpg'),
                $this->item_default_5('4.jpg'),
            )
        );
    }
    
     
	function tpl_6($val) {?>		
        <div class="container-fluid gallery gallery_6" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                     <div class="item_list masonry">
						<? $this->repeat('items', function($item_val,$self) use ($val){ ?>
                            <? if ($val['enable_fancybox'] || $self->edit): ?>
                                <a class="<?= $val['enable_fancybox'] ? "fancybox" : "" ?> big_img" rel="<?=$item_val['fancybox_group']?>" href="<?=INDEX_URL."/".$item_val['image']?>" title="<?=$item_val['title']?>">
                            <? endif ?>							
								<div class="preview_img">									
									<img src="<?=INDEX_URL."/".$item_val['image']?>">
								</div>
								<div class="overlay">
									<div class="outer">
										<div class="wrap_title_desc">
											<? if ($val['show_image_title'] || $self->edit): ?>
                                                <div class="img_title" <?= !$val['show_image_title'] ? "style='display:none'" : "" ?> >
                                                    <?= $item_val['title'] ?>
                                                </div>
                                            <? endif ?>
                                            <? if ($val['show_image_desc'] || $self->edit): ?>
                                                <div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
                                                    <?= $item_val['desc'] ?>
                                                </div>
                                            <? endif ?>
										</div>
									</div>
								</div>
							<? if ($val['enable_fancybox'] || $self->edit): ?>
                                </a>
                            <? endif ?>	
						<? },array('editor' => 'lp.galleryRepeaterImg'));?> 
					</div> 
                </div>
            </div>
        </div>
    <?}
    
    function item_default_6($url) {
        return array(
            'image' => "templater_modules/lpcandy/assets/gallery/".$url,
            'title' => 'Заголовок картинки',
            'desc' => 'Описание картинки',
			'fancybox_group' => 'group_6',
        );
    }
    
    function tpl_default_6() { 
        return  array(
            'show_title' => true,
            'show_title_2' => true,
            'show_image_title' => true,
            'show_image_desc' => true,
			'enable_fancybox' => true,
            'background' =>'#FFFFFF',
            'title' => "Галерея работ 6",
            'title_2' => "Подзаголовок",
            'items' => array(
                $this->item_default_6('11.jpg'),
                $this->item_default_6('12.jpg'),
                $this->item_default_6('13.jpg'),
                $this->item_default_6('14.jpg'),
				$this->item_default_6('15.jpg'),
                $this->item_default_6('16.jpg'),
                $this->item_default_6('17.jpg'),
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
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
						<? $this->repeat('items',function($item_val,$self) use ($val) { ?>
							<div class="img_double"> 
								<div class="img img_w2 img_h2">
									<? $self->sub('ImageWithSiganture','ImageWithSiganture_1') ?>	
								</div>
							</div>
							<div class="img_side">
								<div class="img img_w1 img_h1">
									<? $self->sub('ImageWithSiganture','ImageWithSiganture_2') ?>
								</div>	
								<div class="img img_w1 img_h1">
									<? $self->sub('ImageWithSiganture','ImageWithSiganture_3') ?>
								</div>		
								<div class="img img_w1 img_h1">
									<? $self->sub('ImageWithSiganture','ImageWithSiganture_4') ?>
								</div>			
								<div class="img img_w1 img_h1">
									<? $self->sub('ImageWithSiganture','ImageWithSiganture_5') ?>	
								</div>
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
            'show_title_2' => true,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея работ 7",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
					'ImageWithSiganture_1' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/1.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/1.jpg','fancybox_group' => 'group_7')),
                    'ImageWithSiganture_2' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/2.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/2.jpg','fancybox_group' => 'group_7')),
                    'ImageWithSiganture_3' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/3.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_7')),
                    'ImageWithSiganture_4' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/4.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/4.jpg','fancybox_group' => 'group_7')),
                    'ImageWithSiganture_5' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/5.jpg','fancybox_group' => 'group_7')),
                )
            )
        );    
    }
    
    
    function tpl_8($val) {?>
        <div class="container-fluid gallery gallery_8" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <div class="img_side">
                                <div class="img img_w1 img_h2">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_1') ?> 
                                </div>
                                <div class="img img_w1 img_h1">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_2') ?> 
                                </div>
                            </div>
                            <div class="img_double">
                                <div class="img img_w2 img_h1">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_3') ?> 
                                </div>
                                <div class="img img_w1 img_h1">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_4') ?> 
                                </div>
                                <div class="img img_w1 img_h1">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_5') ?>
                                </div>
                                <div class="img img_w2 img_h1">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_6') ?>
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
            'show_title_2' => true,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея работ 8",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'ImageWithSiganture_1' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/1.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/1.jpg','fancybox_group' => 'group_8')),
                    'ImageWithSiganture_2' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/2.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/2.jpg','fancybox_group' => 'group_8')),
                    'ImageWithSiganture_3' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/3.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_8')),
                    'ImageWithSiganture_4' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/4.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/4.jpg','fancybox_group' => 'group_8')),
                    'ImageWithSiganture_5' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/5.jpg','fancybox_group' => 'group_8')),
					'ImageWithSiganture_6' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/6.jpg','fancybox_group' => 'group_8')),
				)              
            )
        );    
    }
    
    
    function tpl_9($val) {?>
        <div class="container-fluid gallery gallery_9" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                    
                                <div class="img_double">
                                    <div class="img img_w3 img_h2">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_1') ?>
                                    </div>
                                </div>
                                <div class="img_side">
                                    <div class="img img_w2 img_h1">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_2') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_3') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_4') ?>
                                    </div>                                    
                                </div>
                                <div class="img img_w2 img_h1">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_5') ?>
                                </div>
                                <div class="img img_w3 img_h1">
                                    <? $self->sub('ImageWithSiganture','ImageWithSiganture_6') ?>
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
            'show_title_2' => true,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея работ 9",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'ImageWithSiganture_1' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/1.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/1.jpg','fancybox_group' => 'group_9')),
                    'ImageWithSiganture_2' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/2.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/2.jpg','fancybox_group' => 'group_9')),
                    'ImageWithSiganture_3' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/3.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_9')),
                    'ImageWithSiganture_4' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/4.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/4.jpg','fancybox_group' => 'group_9')),
                    'ImageWithSiganture_5' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/5.jpg','fancybox_group' => 'group_9')),
					'ImageWithSiganture_6' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/6.jpg','fancybox_group' => 'group_9')),
				)
            )
        );    
    }
    
    
    function tpl_10($val) {?>
        <div class="container-fluid gallery gallery_10" style="background: <?=$val['background']?>;">           
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                    
                                <div class="img_side">
                                    <div class="img img_w1 img_h2">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_1') ?>
                                    </div>
                                </div>
                                <div class="img_double">
                                    <div class="img img_w2 img_h1">
                                       <? $self->sub('ImageWithSiganture','ImageWithSiganture_2') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_3') ?>
                                    </div>
                                    <div class="img img_w1 img_h1">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_4') ?>
                                    </div>
                                    <div class="img img_w2 img_h1">
                                        <? $self->sub('ImageWithSiganture','ImageWithSiganture_5') ?>
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
            'show_title_2' => true,
			'show_image_desc' => true,
			'show_image_title' => true,
			'enable_fancybox' => true,
            'background' => '#FFFFFF',
            'title' => "Галерея работ 10",
			'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'ImageWithSiganture_1' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/1.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/1.jpg','fancybox_group' => 'group_10')),
                    'ImageWithSiganture_2' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/2.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/2.jpg','fancybox_group' => 'group_10')),
                    'ImageWithSiganture_3' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/3.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/3.jpg','fancybox_group' => 'group_10')),
                    'ImageWithSiganture_4' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/4.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/4.jpg','fancybox_group' => 'group_10')),
                    'ImageWithSiganture_5' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/5.jpg','fancybox_group' => 'group_10')),
					'ImageWithSiganture_6' => array_merge(ImageWithSiganture::tpl_default(),array('url_image_preview'=> 'templater_modules/lpcandy/assets/gallery/preview_image/5.jpg','url_image'=> 'templater_modules/lpcandy/assets/gallery/6.jpg','fancybox_group' => 'group_10')),
				)
            )
        );    
    }
     
}

Gallery::register();