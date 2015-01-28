<?php

class Text extends Block {
    public $editor = "lp.text";
    public $internal = true; 
    
    static $plain_heading = array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>true);
    static $default_heading = array('buttons'=>array("bold","italic","deleted","removeformat"),'oneline'=>true);    
    static $size_heading = array('buttons'=>array("bold","italic","deleted","size","removeformat"),'oneline'=>true);
    static $color_heading = array('buttons'=>array("bold","italic","deleted","size","fontcolor","removeformat"),'oneline'=>true);
        
    static $plain_text = array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false));
    static $default_text = array('buttons'=>array("bold","italic","deleted","removeformat"),'oneline'=>false);    
    static $size_text = array('buttons'=>array("bold","italic","deleted","size","removeformat"),'oneline'=>false);
    static $color_text = array('buttons'=>array("bold","italic","deleted","size","fontcolor","removeformat"),'oneline'=>false);
    
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
            'url' => 'view/editor/assets/default_logo.png',
            'text' => 'Название компании',
            'bold' => true,
            'italic' => false,
            'color' => '#000',
            'size' => 70,
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

class FormButton extends Block {
    public $editor = "lp.formButton";
    public $internal = true;    
    
    function tpl_default() {
        return array( 
            'type' => 'form',
            'link' => '',
            'form_title' => 'Оставить заявку',
            'form_bottom_text' => 'Мы не передаем Вашу персональную информацию третьим лицам',
            'color' => 'red',
            'text' => 'Оставить заявку',
            'form' => FormOrder::tpl_default()
        );
    }
    
    function tpl($val,$name) { ?>
        <? $href = ($val['type']=='link') ? "href='".htmlspecialchars($val['link'])."'" : '' ?>
        <a class='btn_form <?=$val['color']?>' <?=$href?>> <?=$val['text']?> </a>
        <? if ($val['type']=="form" || $this->edit): ?>
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
        <? endif ?> 
    <? }
}

class FormOrder extends Block {
    public $editor = "lp.formOrder";
    public $internal = true;
    
    function tpl_default() {
        return array(
            'fields' => array(
                array(
                    'label' => 'Имя', 'sub_label' => '', 'required' => true,
                    'name' => 'name', 'type' => 'text', 
                ),
                array(
                    'label' => 'Телефон', 'sub_label' => '', 'required' => true,
                    'name' => 'phone', 'type' => 'text', 
                ),
            ),
            'button' => array('color'=>'blue','label'=>'Получить консультацию'),                
            'form_done_title' => 'Спасибо за заявку',
            'form_done_text' => 'Заявка отправлена. Наш менеджер свяжется с Вами в ближайшее время.',
        );
    }
    
    function tpl_default_email() {
        return array_merge_recursive(
            self::tpl_default(),
            array(
                'fields' => array(
                    array(
                        'label' => 'Электронная почта', 'sub_label' => '', 'required' => false,
                        'name' => 'email', 'type' => 'text', 
                    )
                )
            )
        );
    }
    
    function tpl($val) {?>
        <form action="" method="post" >
        <div class="form_fields">
            <? if (is_array(@$val['fields'])) foreach ($val['fields'] as $f=>$field): ?>
                <div class="form_field">
                    <label>
                    <? if ($field['type'] == 'checkbox'): ?>
                        <input class="form_field_checkbox" type="checkbox" />
                        <span class="field_title"><?= htmlspecialchars($field['label'])?></span>
                    <? else: ?>
                        <div class="field_title">
                            <?= htmlspecialchars($field['label'])?>
                            <?= (isset($field['required']) && $field['required']) ? "<i>*</i>" : "" ?>
                        </div>
                        <? if (isset($field['desc']) && $field['desc']): ?>
                            <div class="desc">
                                <?= htmlspecialchars($field['desc'])?>
                            </div>
                        <? endif ?>

                        <? if($field['type'] == 'text'): ?>
                            <input type="text" class="form_field_text">
                        <? elseif ($field['type'] == 'textarea'): ?>
                            <textarea class="form_field_textarea" rows="3"></textarea>
                        <? elseif ($field['type'] == 'file'): ?>
                            <input class="form_field_file" multiple="" type="file">
                        <? elseif ($field['type'] == 'radio'): ?>
                            <div class="form_field_radio_values">
                                <? foreach (explode("\n",$field['options']) as $key=>$option): ?>                                            
                                    <div class="form_field_radio_value">
                                        <label>
                                            <? $checked =  $key==0? "checked" : "" ?>
                                            <input class="form_field_radio" name="radio_<?=$f?>" type="radio" 
                                               value="<?= htmlspecialchars($option)?>" <?=$checked ?>/>
                                            <?= htmlspecialchars($option)?>
                                        </label>
                                    </div>
                                <? endforeach ?>
                            </div>
                        <? elseif ($field['type'] == 'select'): ?>
                            <select class='form_field_select'>
                                <? foreach (explode("\n",$field['options']) as $key=>$option): ?>
                                    <option><?=htmlspecialchars($option)?></option>
                                <? endforeach ?>
                            </select>
                        <? endif ?>
                        <div class="error"></div>
                    <? endif ?>
                    </label>
                </div>
            <? endforeach; ?>
        </div>
        <div class="form_submit">
            <button type="submit" class="form_field_submit <?=$val['button']['color']?>">
                <div>
                    <span><?=$val['button']['label']?></span>
                </div>
            </button>
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

class GalleryImage extends Block {
    public $editor = "lp.galleryImage";
    public $internal = true;   
	
	function tpl_default() {
        return array(
			'image' => '',	
        );        
    }
   
    function tpl($item_val) {?>
        <? $val = $this->parent->val_prefix; ?>
        <? $href = INDEX_URL."/".$item_val['image']; ?>
        
		<div class='preview_img' style='background-image: url("<?=$href?>")'>
			<? if ($cls = $this->vis($val['enable_fancybox'])): ?>
				<a class="fancybox big_img <?=$cls?>" href="<?=$href?>"></a>
			<? endif ?>			
		</div>
    <?}
}

class OverlayImage extends Block {
    public $editor = "lp.overlayImage";
    public $internal = true;	
	
	function tpl_default() {
        return array(
			'image' => '',	
            'title' => 'Заголовок картинки',
			'desc' => 'Описание картинки',
        );        
    }
   
    function tpl($item_val) {?>
        <? $val = $this->parent->val_prefix; ?>
        <? $href = INDEX_URL."/".$item_val['image']; ?>
                
        <div class="preview_img" style="background-image: url('<?=$href?>');">
            <? if ($cls = $this->vis($val['enable_fancybox'])): ?>
                <a class="fancybox big_img <?=$cls?>" href="<?=$href?>" title="<?=$item_val['title']?>"></a>
            <? endif ?>			
            <div class="overlay">
                <div class="outer">
                    <div class="wrap_title_desc">					
                        <? if ($cls = $this->vis($val['show_image_title'])): ?>
                            <div class="img_title <?=$cls?>" >
                                <?= $item_val['title'] ?>
                            </div>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_image_desc'])): ?>
                            <div class="img_desc <?=$cls?>" >
                                <?= $item_val['desc'] ?>
                            </div>
                        <? endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
}

class Media extends Block {
    public $editor = "lp.media";
    public $internal = true;
    
    function tpl_default() {
        return array(
            'type' => 'image',
            'image_url' => '',
            'video_url' => 'http://youtu.be/z1SXw6nlTr0',
        );        
    }
    
    function tpl($val) {?>
        <div class="media">
            <? if ($val['type']=='image'): ?>
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
                    <iframe frameborder="0" allowfullscreen="" src="<?= INDEX_URL."/"?>view/editor/assets/404.php"></iframe><?
                }?>             
            <? endif ?>
        </div>
    <?}
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

class ImageSrc extends Block {
    public $editor = "lp.imageSrc";
    public $internal = true;
    
    function tpl($val) {
        echo "<img src=".INDEX_URL."/".$val.">";
    }
}



Text::register();
Logo::register();
FormButton::register();
FormOrder::register();
Icon::register();
Image::register();
ImageSrc::register();
GalleryImage::register();
OverlayImage::register();
Countdown::register();
Media::register();