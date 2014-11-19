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

class Icon extends Block {
    public $editor = "lp.icon";
    public $internal = true;
    
    function tpl($val) {
        echo "<div class='ico' style='background-image: url(".INDEX_URL."/".$val.")'></div>";
    }
}

class FormButton extends Block {
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
    public $editor = "lp.form";
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

class Image extends Block {
    public $editor = "lp.image";
    public $internal = true;
    
    function tpl_default() {
        return array(
            'image_url' => '',
            'type'=> 'image_background',
        );        
    }
    
    function tpl($val) {
        if ($val['type']=='image_background'){
            echo "<div class='img' style='background-image: url(".INDEX_URL."/".$val['image_url'].")'></div>";
        } 
        if ($val['type']=='image_src'){
            echo "<img src=".INDEX_URL."/".$val['image_url'].">";
        }
        
    }
}

class ImageBg extends Block {
    public $editor = "lp.imageBg";
    public $internal = true;
    
    function tpl_default() {
        return array(
            'add_class' => '',
            'image_url' => '',
        );        
    }
    
    function tpl($val) {
        echo "<div class='img ".$val['add_class']."' style='background-image: url(".INDEX_URL."/".$val['image_url'].")'></div>";
    }
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
            <? elseif ($val['type']=='image'): ?>
                <img src="<?= INDEX_URL."/".$val['image_url']?>"/>
            <? elseif($val['type']=='video'): 
                    preg_match("/(vimeo)|(youtu)/", $val['video_url'], $video_source);
                    if($video_source[0] == "youtu"){
                        preg_match("/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/", $val['video_url'], $matches);?>                        
                        <iframe frameborder="0" allowfullscreen="" src="//www.youtube.com/embed/<?=($matches[7]);?>"></iframe><?
                    } 
                    if ($video_source[0] == "vimeo") {
                        preg_match("/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/", $val['video_url'], $matches);?>
                        <iframe frameborder="0" allowfullscreen="" src="//player.vimeo.com/video/<?=($matches[5]);?>"></iframe><? 
                    } ?>                            
            <? endif ?>
        </div>
    <?}
}

class ImageSrc extends Block {
    public $editor = "lp.image";
    public $internal = true;
    
    function tpl($val) {
        echo "<img src=".INDEX_URL."/".$val.">";
    }
}

class VideoFrame extends Block {
    public $editor = "";
    public $internal = true;
    
    function tpl($val) {
        echo "<iframe src='//".$val."' frameborder='0' allowfullscreen=''></iframe>";
    }
}

class Countdown extends Block {
    public $editor = "";
    public $internal = true;
    
    function tpl($val) {
        echo '<div class="timer"><div class="d"> <div id="countDay" class="digitFont"></div><span>дней</span> </div> <div class="h"> <div id="countHour" class="digitFont"></div><span>часов</span> </div> <div class="m"> <div id="countMinute" class="digitFont"></div><span>минут</span> </div> <div class="s"> <div id="countSecond" class="digitFont"></div><span>секунд</span> </div> </div>';
    }
}

Text::register();
Logo::register();
FormButton::register();
FormOrder::register();
Icon::register();
Image::register();
ImageSrc::register();
ImageBg::register();
VideoFrame::register();
Countdown::register();
Media::register();
