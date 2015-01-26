<?php

class Header extends Block {
    public $name = 'Шапка';
    public $description = 'Логотип и контакты компании';
    public $editor = "lp.header";
    
    function tpl($val) {?>
        <div class="container-fluid header header_1" style="background: <?=$val['background']?>;">        
            <div class="container">
                <div class="span4">   
                    <? $this->sub("Logo",'logo') ?>
                </div>
                <div class="span7">  
                    <div class="desc">
                        <? $this->sub('Text','desc',Text::$size_text) ?>
                    </div>
                </div>
                <div class="span5">        
                    <div class="phone">
                        <? $this->sub("Text",'phone',Text::$color_heading) ?>
                    </div>
                    <div class="phone_desc">
                        <? $this->sub("Text",'phone_desc',Text::$default_heading) ?>
                    </div>                          
                </div>
            </div>
        </div>

    <?}
    
    function tpl_default() { 
        return  array(
            'background' =>'#FFFFFF',
            'logo' => array_merge(Logo::tpl_default(),array('size'=>100)),
            'desc' => "Производство чего либо компанией<br><span style='font-size: 17px;'>Доставка по всей России</span>",
            'phone' => '8 <span style="color: #C1103A;">(800)</span> 123 45 67',
            'phone_desc' => 'г.Москва, ул. Тверская, д.6, офис 207'
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid header header_2" style="background: <?=$val['background']?>;">    
            <div class="container">
                <div class="span6">
                    <? $this->sub("Logo",'logo') ?>
                </div>
                <div class="span10">
                    <? if ($cls = $this->vis($val['show_order_button'])): ?>
                        <div class="span_btn <?=$cls?>" >
                            <div class="btn_wrap">
                                <? $this->sub("FormButton",'order_button') ?>
                            </div>
                        </div>
                    <? endif ?>                    
                    <div class="phone <? if($val['show_order_button'] == 0){?>no_btn<?}?>">
                        <? $this->sub("Text",'phone',Text::$default_heading) ?>
                    </div>                                          
                </div>
            </div>
        </div>
    <?}    
    
    function tpl_default_2() { 
        return  array(
            'show_order_button' => true,
            'background' =>'#FFFFFF',
            'logo' => array_merge(Logo::tpl_default(),array('size'=>62)),
            'order_button' => FormButton::tpl_default(),
            'phone' => '8 (800) 123 45 67',            
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid header header_3" style="background:<?=$val['background']?>;">
            <div class="container">
                <div class="span6">
                    <div class="desc_1 <?= !$val['show_desc_and_order_button'] ? "no_btn" : ""?>" >
                        <? $this->sub('Text','desc_1',Text::$default_heading) ?>
                    </div>                    
                    <? if ($cls = $this->vis($val['show_desc_and_order_button'])): ?>
                        <div class="desc_2 <?=$cls?>" >
                                <? $this->sub('Text','desc_2',Text::$color_heading) ?>
                        </div>
                    <? endif ?>                    
                </div>
                <div class="span5">
                        <? $this->sub("Logo",'logo') ?>        
                </div>
                <div class="span5">
                    <div class="phone <?= !$val['show_desc_and_order_button'] ? "no_btn" : ""?>">
                        <? $this->sub("Text",'phone',Text::$default_heading) ?>
                    </div> 
                    <? if ($cls = $this->vis($val['show_desc_and_order_button'])): ?>
                        <div class="span_btn <?=$cls?>">
                            <div class='btn_wrap'>
                                <? $this->sub("FormButton",'order_button') ;?>
                            </div>
                        </div>
                    <? endif ?> 
                </div>
            </div>
        </div>   
    <?}    
    
    function tpl_default_3() { 
        return  array(
            'background' =>'#FFFFFF',
            'logo' => array_merge(Logo::tpl_default(),array('size'=>80)),
            'desc_1' => "Организация праздников",
            'desc_2' => "<div>Организация детских праздников</div><div>под ключ</div>",
            'phone' => "8 (800) 123 45 67",
            'order_button' => FormButton::tpl_default(),
            'show_desc_and_order_button' => true,
        );
    }
    
    
    function tpl_4($val) {?>
        
        <div class="container-fluid header header_4" style="background: <?=$val['background']?>;">
            <div class="container">
                <div class="span6 span_logo"> 
                    <? $this->sub("Logo",'logo') ?>
                    <? if ($cls = $this->vis($val['logo']['type']=="text")): ?>
                        <div class="desc <?=$cls?>" >
                            <? $this->sub('Text','desc') ?>
                        </div>
                    <? endif ?>
                </div>
                <div class="span6 span_ico">
                    <div class="ico_wrap ico_1">
                        <? $this->sub('Icon','ico_1') ?>
                        <div class="ico_name"><? $this->sub('Text','text_1',Text::$plain_text) ?></div>
                    </div>
                    <div class="ico_wrap ico_2">
                        <? $this->sub('Icon','ico_2') ?>
                        <div class="ico_name"><? $this->sub('Text','text_2',Text::$plain_text) ?></div>
                    </div>
                    <div class="ico_wrap ico_3">
                        <? $this->sub('Icon','ico_3') ?>
                        <div class="ico_name"><? $this->sub('Text','text_3',Text::$plain_text) ?></div>
                    </div>
                </div>           
                <div class="span4">
                    <div class="phone <?= !$val['show_order_button'] ? "no_btn" : ""?>">
                        <? $this->sub("Text",'phone',Text::$default_heading) ?>
                    </div> 
                    <? if ($cls = $this->vis($val['show_order_button'])): ?>
                        <div class="span_btn <?=$cls?>" >
                            <div class="btn_wrap">
                                <? $this->sub("FormButton",'order_button') ?>
                            </div>
                        </div>
                    <? endif ?>
                </div>
            </div>
        </div>
  
    <?}    
    
    function tpl_default_4() { 
        return  array(
            'show_order_button' => true,
            'background' =>'#FFFFFF',
            'logo' => array_merge(Logo::tpl_default(),array('type'=>'text', 'fontSize' =>28, 'color' => '#C1103A')),            
            'desc' => "ТРУБЫ С ДОСТАВКОЙ ПО ЦЕНАМ ПРОИЗВОДИТЕЛЯ",
            "ico_1" => 'view/editor/assets/ico/14.png',
            "ico_2" => 'view/editor/assets/ico/47.png',
            "ico_3" => 'view/editor/assets/ico/27.png',
            'text_1' => "ОПЫТ<br>С 2005 ГОДА",
            'text_2' => "БЕСПЛАТНАЯ<br>ДОСТАВКА",
            'text_3' => "ГАРАНТИЯ<br>1 ГОД",
            'phone' => "8 (800) 123 45 67",
            'order_button' => FormButton::tpl_default(),            
        );
    }    
}

Header::register();