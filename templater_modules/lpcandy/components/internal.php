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
            'url' => INDEX_URL . '/templater_modules/lpcandy/assets/default_logo.png',
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
                <img src="<?=$val['url']?>" width="<?=$val['size']?>%">
            <? else: ?>
                <?
                    $style = "";
                    if ($val['italic']) $style .= "font-style:italic;";
                    if ($val['bold']) $style .= "font-weight:bold;";
                    if ($val['font']) $style .= "font-family:".$val['font'].";";
                    if ($val['color']) $style .= "color:".$val['color'].";";
                    if ($val['fontSize']) $style .= "font-size:".$val['fontSize']."px;";
                ?>
                <span style="<?=$style?>"><?=$val['text']?></span>
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
            'color' => 'red',
            'text' => 'Оставить заявку',
            'form' => array(
                'fields' => array(
                    array(
                        'label' => 'Имя:', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Телефон:', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text', 
                    )
                ),
                'button' => array('color'=>'blue','label'=>'Получить консультацию')
            )
        );
    }
    
    function tpl($val,$name) {
        echo "<a class='btn_form btn ".$val['color']."'>".$val['text']."</a>";
        echo "<div style='display:none'>";
            echo FormOrder::get()->getHtml($val['form'],$this->edit,$name.'.form');
        echo "</div>";
    }
}

class FormOrder extends Block {
    public $editor = "lp.form";
    public $internal = true;
    
    function tpl($val) {?>
         <form action="" method="post" >
            <div class="form_fields">
                <? if (is_array(@$val['fields'])) foreach ($val['fields'] as $field): ?>
                    <div class="form_field">
                        <label>
                            <div class="field_title">
                                <?=$field['label']?>
                                <? if ($field['required']): ?>
                                    <i>*</i>
                                <? endif ?>
                            </div>
                            <? if ($field['type']=='text'): ?>
                                <input type="text" class="form_field_text">
                            <? elseif ($field['type']=='select'): ?>
                                <select>
                                    <? foreach (explode("\n",$field['options']) as $key=>$option): ?>
                                        <option value="<?=$key?>"><?=$option?></option>
                                    <? endforeach ?>
                                </select>
                            <? endif ?>
                            <div class="error"></div>
                        </label>
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
        </form>
    <?}
}

class ImageBg extends Block {
    public $editor = "";
    public $internal = true;
    
    function tpl($val) {
        echo "<div class='img' style='background: url(".INDEX_URL."/".$val.")'></div>";
    }
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

class Clock extends Block {
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
ImageSrc::register();
ImageBg::register();
VideoFrame::register();
Clock::register();