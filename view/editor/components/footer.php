<?php

class Footer extends Block {
    public $name = 'Подвал';
    public $description = "Завершающий блок";
    public $editor = "lp.footer";
    
    function tpl($val) {?>
        <div class="container-fluid footer footer_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span4">
                    <? $this->sub("Logo",'logo') ?>
                </div>
                <div class="span7">
                    <div class="desc">
                        <? $this->sub('Text','desc',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"),'oneline'=>false)) ?>                            
                    </div>
                    <? if ($val['show_policy'] || $this->edit): ?>
                        <div class="policy_wrap" <?= !$val['show_policy'] ? "style='display:none'" : "" ?>>
                            <a class="policy">Политика конфиденциальности</a>
                        </div>
                    <? endif ?>                    
                </div>
                <div class="span5">
                    <div class="phone">
                        <? $this->sub('Text','phone',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"),'oneline'=>true)) ?>
                    </div>
                    <div class="phone_desc">
                        <? $this->sub('Text','phone_desc',array('buttons'=>array("bold","italic","fontcolor"=>false,"removeformat"),'oneline'=>false)) ?>
                    </div>
                </div>
                <? if ($val['show_copyright'] || $this->edit): ?>
                    <div class="copyright" <?= !$val['show_copyright'] ? "style='display:none'" : "" ?>>
                        <a href="//lpcandy.ru" target='_blank'><i></i><span>Создано на платформе LPCandy</span></a>
                    </div>
                <? endif ?>                
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_policy' => true,
            'show_copyright' => true,
            'background_color' => '#FFFFFF',
            'logo' => Logo::tpl_default(),
            'desc' => "ООО «Компания», 123456, г.Москва, ул. Тверская, д.6<br>ИНН 1234567890 ОГРН 123456789012",            
            'phone' => '8 (800) 123 45 67',
            'phone_desc' => 'Звонок по России бесплатный',
        );
    }
    
}

Footer::register();