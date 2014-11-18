<?php

class Header extends Block {
    public $name = 'Header';
    public $description = 'Logo + contacts';
    public $editor = "lp.header";
    
    function tpl($val) {?>
        <div class="container-fluid header header_1" style="background: <?=$val['background']?>;">        
            <div class="container">
                <div class="span4">   
                    <? $this->sub("Logo",'logo') ?>
                </div>
                <div class="span7">  
                    <div class="desc">
                        <? $this->sub('Text','desc',array('buttons'=>array("bold","italic","size","removeformat")) ) ?>
                    </div>
                </div>
                <div class="span5">        
                    <div class="phone">
                        <? $this->sub("Text",'phone',array('buttons'=>array("bold","italic","fontcolor","removeformat"),'oneline'=>true) ) ?>
                    </div>
                    <div class="phone_desc">
                        <? $this->sub("Text",'phone_desc',array('oneline'=>true)) ?>
                    </div>                          
                </div>
            </div>
        </div>

    <?}
    
    function tpl_default() { 
        return  array(
            'background' =>'#FFFFFF',
            'logo' => Logo::tpl_default(),
            'desc' => "<div>Производство чего либо компанией</div><div>Доставка по всей России</div>",
            'phone' => '8 <span style="color: #C1103A;">(800)</span> 123 45 67',
            'phone_desc' => 'г.Москва, ул. Тверская, д.6, офис 207'
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid header header_2" style="background: <?=$val['background']?>;">    
            <div class="container">
                <div class="span4">
                    <? $this->sub("Logo",'logo') ?>
                </div>
                <div class="span12">
                    <? if ($val['show_order_button'] || $this->edit): ?>
                        <div class="span_btn" <?= $val['show_order_button'] ? "" : "style='display:none'" ?>>
                            <div class='btn_wrap'>
                                <? $this->sub("FormButton",'order_button') ;?>
                            </div>
                        </div>
                    <? endif ?>                    
                    <div class="phone <? if($val['show_order_button'] == 0){?>no_btn<?}?>">
                        <? $this->sub("Text",'phone',array('buttons'=>array("bold","italic","fontcolor","removeformat"),'oneline'=>true) ) ?>
                    </div>                                          
                </div>
            </div>
        </div>
    <?}    
    
    function tpl_default_2() { 
        return  array(
            'background' =>'#FFFFFF',
            'logo' => Logo::tpl_default(),
            'order_button' => FormButton::tpl_default(),
            'phone' => '8 <span style="color: #C1103A;">(800)</span> 123 45 67',
            'show_order_button' => true,
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid header header_3" style="background:<?=$val['background']?>;">
            <div class="container">
                <div class="span6">
                    <div class="desc_1 <?= !$val['show_desc_and_order_button'] ? "no_btn" : ""?>" >
                        <? $this->sub('Text','desc_1') ?>
                    </div>                    
                    <? if ($val['show_desc_and_order_button'] || $this->edit): ?>
                        <div class="desc_2" <?= !$val['show_desc_and_order_button'] ? "style='display:none'" : "" ?> >
                                <? $this->sub('Text','desc_2',array('buttons'=>array("bold","italic","fontcolor","removeformat"),'oneline'=>false)) ?>
                        </div>
                    <? endif ?>                    
                </div>
                <div class="span5">
                        <? $this->sub("Logo",'logo') ?>        
                </div>
                <div class="span5">
                    <div class="phone <?= !$val['show_desc_and_order_button'] ? "no_btn" : ""?>">
                        <? $this->sub("Text",'phone') ?>
                    </div> 
                    <? if ($val['show_desc_and_order_button'] || $this->edit): ?>
                        <div class="span_btn" <?= !$val['show_desc_and_order_button'] ? "style='display:none'" : "" ?>>
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
            'logo' => Logo::tpl_default(),
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
                    <? if ($val['show_desc'] || $this->edit): ?>
                        <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                <? $this->sub('Text','desc') ?>
                        </div>
                    <? endif ?>
                </div>
                <div class="span6 span_ico">
                    <div class="ico_wrap ico_1">
                        <? $this->sub('Icon','ico_1') ?>
                        <div class="ico_name"><? $this->sub('Text','text_1') ?></div>
                    </div>
                    <div class="ico_wrap ico_2">
                        <? $this->sub('Icon','ico_2') ?>
                        <div class="ico_name"><? $this->sub('Text','text_2') ?></div>
                    </div>
                    <div class="ico_wrap ico_3">
                        <? $this->sub('Icon','ico_3') ?>
                        <div class="ico_name"><? $this->sub('Text','text_3') ?></div>
                    </div>
                </div>           
                <div class="span4">
                    <div class="phone <?= !$val['show_order_button'] ? "no_btn" : ""?>">
                        <? $this->sub("Text",'phone') ?>
                    </div> 
                    <? if ($val['show_order_button'] || $this->edit): ?>
                        <div class="span_btn" <?= !$val['show_order_button'] ? "style='display:none'" : "" ?> >
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
            'background' =>'#FFFFFF',
            'logo' => array_merge(Logo::tpl_default(),array('type'=>'text', 'fontSize' =>28, 'color' => '#C1103A')),
            'show_desc' => true,
            'desc' => "ТРУБЫ С ДОСТАВКОЙ ПО ЦЕНАМ ПРОИЗВОДИТЕЛЯ",
            "ico_1" => 'templater_modules/lpcandy/assets/ico/14.png',
            "ico_2" => 'templater_modules/lpcandy/assets/ico/47.png',
            "ico_3" => 'templater_modules/lpcandy/assets/ico/27.png',
            'text_1' => "ОПЫТ<br>С 2005 ГОДА",
            'text_2' => "БЕСПЛАТНАЯ<br>ДОСТАВКА",
            'text_3' => "ГАРАНТИЯ<br>1 ГОД",
            'phone' => "8 (800) 123 45 67",
            'order_button' => array_merge(FormButton::tpl_default(),array('text'=>'Оставить заявку')),
            'show_order_button' => true,
        );
    }
    
    
}

Header::register();