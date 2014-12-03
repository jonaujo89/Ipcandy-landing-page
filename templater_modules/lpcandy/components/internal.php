<?php

class Text extends Block {
    public $editor = "lp.text";
    public $internal = true;
    
    function tpl($val) {
        echo $val ?:'';
    }
}

class Logo extends Block {
    public $editor = "lp.logo";
    public $internal = true;
    
    function tpl_default() {
        return array(
            'type' => 'image',
            'url' => 'templater_modules/lpcandy/assets/default_logo.png',
            'text' => 'Название компании',
            'bold' => true,
            'italic' => false,
            'color' => '#000',
            'size' => 80,
            'fontSize' => 24
        );        
    }
    
    function tpl($val) {?>
        <div class="logo">
            <? if ($val['type']=='image'): ?>
                <img src="<?=INDEX_URL."/".$val['url']?>" width="<?=$val['size']?>%">
            <? else: ?>
                <?
                    $style = "";
                    if ($val['italic']) $style .= "font-style:italic;";
                    if ($val['bold']) $style .= "font-weight:bold;";
                    if ($val['font']) $style .= "font-family:".$val['font'].";";
                    if ($val['color']) $style .= "color:".$val['color'].";";
                    if ($val['fontSize']) $style .= "font-size:".$val['fontSize']."px;";
                ?>
                <div class='company_name' style="<?=$style?>"><?=$val['text']?></div>
            <? endif ?>
        </div>
    <?}
}

Class FormButton extends Block {
    public $editor = "lp.formButton";
    public $internal = true;    
    
    function tpl_default() {
        return array(  
            'class' => '',
            'form_title' => 'Оставить заявку ',
            'form_bottom_text' => 'Мы не передаем Вашу персональную информацию третьим лицам',
            'color' => 'red',
            'text' => 'Оставить заявку',
            'form' => array(
                'fields' => array(
                    array(
                        'label' => 'Name', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Phone', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Email', 'sub_label' => '', 'required' => false,
                        'name' => 'email', 'type' => 'text', 
                    ),
                ),
                'button' => array('color'=>'blue','label'=>'Получить консультацию'),                
                'form_done_title' => 'Спасибо за заявку',
                'form_done_text' => 'Заявка отправлена. Наш менеджер свяжется с Вами в ближайшее время. ',                
            )
        );
    }
    
    function tpl($val,$name) { ?>
        <a class='btn_form <?=$val['color']?> <?=$val['class']?>'><?=$val['text']?></a>
        <div style='display:none'>
                <div class="form">
                    <div class="form_title">
                        <? $this->sub('Text','form_title') ?>    
                    </div>
                    <div class="form_data">
                        <?= FormOrder::get()->getHtml($val['form'],$this->edit,$name.'.form') ?>
                    </div>
                    <div class="form_bottom" >
                        <? $this->sub('Text','form_bottom_text') ?>
                    </div>
                </div>
         </div>
    <? }
}

class FormOrder extends Block {
    public $editor = "lp.formOrder";
    public $internal = true;
    
    function tpl($val) {?>
            <form action="" method="post" >
                <div class="form_fields">
                    <? if (is_array(@$val['fields'])) foreach ($val['fields'] as $field): ?>
                        <div class="form_field">                            
                            <? if ($field['type']=='text'): ?>
                                <label>
                                    <div class="field_title">
                                        <?= $field['label']?>
                                        <?= ($field['required']) ? "<i>*</i>" : "" ?>
                                    </div>                                    
                                    <? If ($field['desc']): ?>
                                        <div class="desc">
                                            <?=$field['desc']?>
                                        </div>
                                    <? endif ?>
                                    <input type="text" class="form_field_text">
                                </label>
                            <? elseif ($field['type']=='select'): ?>
                                 <label>
                                    <div class="field_title">
                                        <?=$field['label']?>
                                        <? if ($field['required']): ?>
                                            <i>*</i>
                                        <? endif ?>
                                    </div>
                                    <? If ($field['desc']): ?>
                                        <div class="desc">
                                            <?=$field['desc']?>
                                        </div>
                                    <? endif ?>
                                    <div class='form_field_select_wrap'>
                                        <select class='form_field_select'>
                                            <? foreach (explode("\n",$field['options']) as $key=>$option): ?>
                                                <option><?=$option?></option>
                                            <? endforeach ?>
                                        </select>
                                     </div>
                                </label>
                            <? elseif ($field['type']=='textarea'): ?>
                                 <label>
                                    <div class="field_title">
                                        <?=$field['label']?>
                                        <?= ($field['required']) ? "<i>*</i>" : "" ?>
                                    </div>
                                    <? If ($field['desc']): ?>
                                        <div class="desc">
                                            <?=$field['desc']?>
                                        </div>
                                    <? endif ?>
                                    <textarea class="form_field_textarea" rows="3"></textarea>
                                </label>
                            <? elseif ($field['type']=='checkbox'): ?>
                                <label>
                                    <div class="field_title">
                                        <?=$field['label']?>
                                        <?= ($field['required']) ? "<i>*</i>" : "" ?>
                                    </div>
                                    <div class="desc" <?= !$field['desc'] ? "style='display:none'": ""?>>
                                        <?=$field['desc']?>
                                    </div>
                                    <div class="form_field_checkbox_values">
                                        <? foreach (explode("\n",$field['options']) as $key=>$option): ?>
                                            <div class="form_field_checkbox_value">
                                                <label>
                                                    <input class="form_field_checkbox" value="<?=$option?>" type="checkbox" /> <?=$option?>
                                                </label>
                                            </div>
                                        <? endforeach ?>
                                    </div>
                                </label>
                            <? elseif ($field['type']=='radio'): ?>
                                <label>
                                    <div class="field_title">
                                        <?=$field['label']?>
                                        <?= ($field['required']) ? "<i>*</i>" : "" ?>
                                    </div>
                                    <? If ($field['desc']): ?>
                                        <div class="desc">
                                            <?=$field['desc']?>
                                        </div>
                                    <? endif ?>
                                    <div class="form_field_radio_values">
                                        <? foreach (explode("\n",$field['options']) as $key=>$option): ?>
                                            <div class="form_field_radio_value">
                                                <label>
                                                    <input class="form_field_radio" value="<?=$option?>" type="radio" /> <?=$option?>
                                                </label>
                                            </div>
                                        <? endforeach ?>
                                    </div>
                                </label>
                            <? elseif ($field['type']=='file'): ?>
                                 <label>
                                    <div class="field_title">
                                        <?=$field['label']?>
                                        <?= ($field['required']) ? "<i>*</i>" : "" ?>
                                    </div>
                                    <? If ($field['desc']): ?>
                                        <div class="desc">
                                            <?=$field['desc']?>
                                        </div>
                                    <? endif ?>
                                    <input class="form_field_file" multiple="" type="file">
                                </label>
                            <? endif ?>
                            <div class="error"></div>
                        </div>
                    <? endforeach ?>
                </div>
                <div class="form_submit">
                    <a class="form_field_submit <?=$val['button']['color']?>">
                        <div>
                            <span><?=$val['button']['label']?></span>
                        </div>
                    </a>
                </div>
                <div style="display:none">
                    <div class="form_done">
                        <div class="form_done_title">
                            <? $this->sub('Text','form_done_title') ?>
                        </div>
                        <div class="form_done_text">
                            <? $this->sub('Text','form_done_text') ?>
                        </div>
                     </div>
                 </div>
            </form>        
    <?}
}

class Icon extends Block {
    public $editor = "lp.icon";
    public $internal = true;
    
    function tpl($val) {
        echo "<div class='ico' style='background-image: url(".INDEX_URL."/".$val.")'></div>";
    }
}

class Image extends Block {
    public $editor = "lp.image";
    public $internal = true;    
   
    function tpl($val) {
       echo "<div class='img' style='background-image: url(".INDEX_URL."/".$val.")'></div>";                
    }
}

class ImageFancyboxWhithoutTitle extends Block {
    public $editor = "lp.imageFancyboxWhithoutTitle";
    public $internal = true;   
	
	function tpl_default() {
        return array(
			'url_image' => '',	
			'url_image_preview' => '',
			'fancy_group' => '',
        );        
    }
   
    function tpl($val) {?>
		<a class="fancybox-whithout-title big_img" rel="<?=$val['fancy_group']?>" href="<?=INDEX_URL."/".$val['url_image']?>">
			<div class='img preview_img' style='background-image: url("<?=INDEX_URL."/".$val['url_image_preview']?>")'></div>
		</a>		
    <?}
}

class ImageSrc extends Block {
    public $editor = "lp.imageSrc";
    public $internal = true;
    
    function tpl($val) {
        echo "<img src=".INDEX_URL."/".$val.">";
    }
}

class ImageWithSiganture extends Block {
    public $editor = "lp.imageWithSignature";
    public $internal = true;	
	
	function tpl_default() {
        return array(
			'url_image' => '',
			'url_image_preview' => '',
            'show_image_title' => true,
            'show_image_desc' => true,			
            'title' => 'Дорога в облака',
			'desc' => 'Описание',
			'fancy_group' => '',
        );        
    }
   
    function tpl($val) {?>
        <a class="fancybox big_img" rel="<?=$val['fancy_group']?>" href="<?=INDEX_URL."/".$val['url_image']?>" title="<?=$val['title']?>">
			<div class="preview_img" style="background-image: url('<?=INDEX_URL."/".$val['url_image_preview']?>');"></div>
			<div class="overlay">
				<div class="wrap_title_desc">
					<? if ($val['show_image_title'] || $val->edit): ?>
						<div class="img_title" <?= !$val['show_image_title'] ? "style='display:none'" : "" ?> >
							<?= $val['title'] ?>
						</div>
					<? endif ?>
					<? if ($val['show_image_desc'] || $val->edit): ?>
						<div class="img_desc" <?= !$val['show_image_desc'] ? "style='display:none'" : "" ?> >
							<?= $val['desc'] ?>
						</div>
					<? endif ?>
				</div>
			</div> 
		</a>
    <?}
}

class Media extends Block {
    public $editor = "lp.media";
    public $internal = true;
    
    function tpl_default() {
        return array(
            'type' => '',
            'image_url' => '',
            'video_url' => 'http://youtu.be/z1SXw6nlTr0',
        );        
    }
    
    function tpl($val) {?>
        <div class="media">
            <? if ($val['type']=='image_background'): ?>
                <div class='img' style='background-image: url("<?= INDEX_URL."/".$val['image_url']?>")'></div>
            <? elseif($val['type']=='video'): 
                    preg_match("/(vimeo)|(youtu)/", $val['video_url'], $video_source);
                    if($video_source[0] == "youtu"){
                        preg_match("/^.*((youtu\.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/", $val['video_url'], $matches);?>                        
                        <iframe frameborder="0" allowfullscreen="" src="//www.youtube.com/embed/<?=($matches[7]);?>"></iframe><?
                    } else if ($video_source[0] == "vimeo") {
                        preg_match("/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/", $val['video_url'], $matches);?>
                        <iframe frameborder="0" allowfullscreen="" src="//player.vimeo.com/video/<?=($matches[5]);?>"></iframe><? 
                    } else {?>
                        <iframe frameborder="0" allowfullscreen="" src="<?= INDEX_URL."/"?>templater_modules/lpcandy/assets/video_404.html"></iframe><?
                    }?>             
            <? endif ?>
        </div>
    <?}
}

class Map extends Block {
    public $editor = "lp.map";
    public $internal = true;
    
    function tpl_default() {
        return array(

        );        
    }
    
    function tpl($val) {?>

    <?}
}

class VideoStream extends Block {
    public $editor = "lp.videoStream";
    public $internal = true;
    
    function tpl_default() {
        return array(
            'video_url' => 'http://youtu.be/z1SXw6nlTr0',
        );        
    }
    
    function tpl($val) {
        preg_match("/(vimeo)|(youtu)/", $val['video_url'], $video_source);
        if($video_source[0] == "youtu"){
            preg_match("/^.*((youtu\.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/", $val['video_url'], $matches);                        
            ?><iframe frameborder="0" allowfullscreen="" src="//www.youtube.com/embed/<?=($matches[7]);?>"></iframe><?
        } else if ($video_source[0] == "vimeo") {
            preg_match("/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/", $val['video_url'], $matches);
            ?><iframe frameborder="0" allowfullscreen="" src="//player.vimeo.com/video/<?=($matches[5]);?>"></iframe><? 
        } else {
            ?><iframe frameborder="0" allowfullscreen="" src="<?= INDEX_URL."/"?>templater_modules/lpcandy/assets/video_404.html"></iframe><?
        }
    }
}

class Countdown extends Block {
    public $editor = "lp.countdown";
    public $internal = true;
    
		function tpl_default() {
        return array(
            'type' => '',			
			'date' => '',
			'dayOfWeek' => '',
			'day' => '',
			'time' => '',
        );        
    }

    function tpl($val) {?>
		<div class="countdown" data-datetime='{"type":"<?= $val['type']?>","date":"<?= $val['date']?>","day":"<?= $val['day']?>","dayOfWeek":"<?= $val['dayOfWeek']?>","time":"<?= $val['time']?>"}'>
		</div>
    <?}

}

Text::register();
Logo::register();
FormButton::register();
FormOrder::register();
Icon::register();
Image::register();
ImageSrc::register();
ImageFancyboxWhithoutTitle::register();
ImageWithSiganture::register();
VideoStream::register();
Countdown::register();
Media::register();
