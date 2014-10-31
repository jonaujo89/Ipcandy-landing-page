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

class ButtonForm extends Block {
    public $editor = "";
    public $internal = true;
    
    function tpl($val) {
        echo "<button>Button</button>";
    }
}

class Button extends Block {
    public $editor = "";
    public $internal = true;    
    
    function tpl($val) {
        echo "<a class='btn ".$val['colorBtn']."'>".$val['text']."</a>";
    }
}

class Form extends Block {
    public $editor = "";
    public $internal = true;
    
    function tpl($val) {?>
        <form>
            <div class="form_field">
                <label>Some label 1</label>
                <input type="text" />
            </div>
            <div class="form_field">
                <label>Some label 2</label>
                <input type="text" />
            </div>
            <button>Submit form</button>
        </form>
    <?}
}


class Header extends Block {
    public $name = 'Header';
    public $description = 'Logo + contacts';
    public $editor = "lp.header";
    
    function tpl($val) {?>
        <div class="container-fluid header header_1">        
            <div class="container">
                <div class="span4">
                    <div class="logo">
                        <? $this->sub("Logo",'logo') ?>
                    </div>
                </div>
                <div class="span7">  
                    <div class="desc">
                        <? $this->sub('Text','desc') ?>
                    </div>
                </div>
                <div class="span5">        
                    <div class="phone">
                        <? $this->sub("Text",'phone') ?>
                    </div>
                    <div class="phone_desc">
                        <? $this->sub("Text",'phone_desc') ?>
                    </div>                          
                </div>
            </div>
        </div>

    <?}
    
    function tpl_default() { 
        return  array(
            'logo' => Logo::tpl_default(),
            'desc' => "<p><span style='font-size:22px'>Производство чего либо компанией</span></p>
                       <p>Доставка по всей России</p>",
            'phone' => '8 <span style="color: #C1103A;">(800)</span> 123 45 67',
            'phone_desc' => 'г.Москва, ул. Тверская, д.6, офис 207'
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid header header_2">    
            <div class="container">
                <div class="span4">
                    <div class="logo">
                        <? $this->sub("Logo",'logo') ?>
                    </div>
                </div>
                <div class="span12"> 
                    <div class="span_btn">
                        <div class='btn_wrap'>
                            <? $this->sub("Button",'order_button') ?>
                        </div>
                    </div>
                    <div class="phone">
                        <? $this->sub("Text",'phone') ?>
                    </div>                                          
                </div>
            </div>
        </div>
    <?}    
    
    function tpl_default_2() { 
        return  array(
            'logo' => Logo::tpl_default(),
            'order_button' => array('text'=>'Заказать доставку','colorBtn'=>'red'),
            'phone' => '8 <span style="color: #C1103A;">(800)</span> 123 45 67'
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid header header_3">
            <div class="container">
                <div class="span6">
                    <div class="desc_1">
                        <? $this->sub('Text','desc1') ?>
                    </div>
                    <div class="desc_2">
                        <? $this->sub('Text','desc2') ?>
                    </div>
                </div>
                <div class="span4">
                        <? $this->sub("Logo",'logo') ?>        
                </div>
                <div class="span6">
                    <div class="phone">
                        <? $this->sub("Text",'phone') ?>
                    </div> 
                    <div class="span_btn">
                        <div class='btn_wrap'>
                            <? $this->sub("Button",'order_button') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    <?}    
    
    function tpl_default_3() { 
        return  array(
            'logo' => Logo::tpl_default(),
            'desc1' => "Организация праздников",
            'desc2' => "Организация детских праздников под ключ",
            'phone' => "8 (800) 123 45 67",
            'order_button' => array('text'=>'Оставить заявку','colorBtn'=>'red'),
        );
    }
    
    
    function tpl_4($val) {?>
        
        <div class="container-fluid header header_4">
            <div class="container">
                <div class="span6">
                    <div class="logo">                        
                        <? $this->sub('Text','desc1') ?>
                    </div>
                    <div class="desc">
                        <? $this->sub('Text','desc2') ?>
                    </div>
                </div>
                <div class="span6 span_ico">
                    <div class="ico_wrap ico_1">
                        <? $this->sub('Icon','ico1') ?>
                        <div class="ico_name"><? $this->sub('Text','text_1') ?></div>
                    </div>
                    <div class="ico_wrap ico_2">
                        <? $this->sub('Icon','ico2') ?>
                        <div class="ico_name"><? $this->sub('Text','text_2') ?></div>
                    </div>
                    <div class="ico_wrap ico_3">
                        <? $this->sub('Icon','ico3') ?>
                        <div class="ico_name"><? $this->sub('Text','text_3') ?></div>
                    </div>
                </div>           
                <div class="span4">
                    <div class="phone">
                        <? $this->sub("Text",'phone') ?>
                    </div> 
                    <div class="span_btn">
                        <div class="btn_wrap">
                            <? $this->sub("Button",'order_button') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
    <?}    
    
    function tpl_default_4() { 
        return  array(
            'logo' => Logo::tpl_default(),
            'desc1' => "<div class='company_name' style='color:#C1103A;font-size:26px;font-family:Arial;font-weight:bold;font-style:normal;'>НАЗВАНИЕ КОМПАНИИ</div>",
            'desc2' => "ТРУБЫ С ДОСТАВКОЙ ПО ЦЕНАМ ПРОИЗВОДИТЕЛЯ",
            "ico1" => 'templater_modules/lpcandy/assets/ico/14.png',
            "ico2" => 'templater_modules/lpcandy/assets/ico/47.png',
            "ico3" => 'templater_modules/lpcandy/assets/ico/27.png',
            'text_1' => "ОПЫТ С 2005 ГОДА",
            'text_2' => "БЕСПЛАТНАЯ ДОСТАВКА",
            'text_3' => "ГАРАНТИЯ 1 ГОД",
            'phone' => "8 (800) 123 45 67",
            'order_button' => array('text'=>'Заказать доставку','colorBtn'=>'red'),
        );
    }
    
    
}


Text::register();
Logo::register();
ButtonForm::register();
Button::register();
Form::register();
Icon::register();

Header::register();





