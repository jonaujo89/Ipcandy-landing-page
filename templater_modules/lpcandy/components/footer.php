<?php

class Footer extends Block {
    public $name = 'Footer';
    public $description = "Final block";
    
    function tpl($val) {?>
        <div class="container-fluid footer footer1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container show_copyright">
                <div class="span4">
                    <div class="logo">
                        <? $this->sub("Logo",'logo') ?>
                    </div>
                </div>
                <div class="span7">
                    <div class="desc">
                        <? $this->sub('Text','desc') ?>                            
                    </div>
                    <div class="policy_wrap">
                        <? $this->sub('Text','policy_wrap') ?>
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
                <div class="copyright">
                    <? $this->sub("Text",'copyright') ?>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'logo' => Logo::tpl_default(),
            'desc' => "<div>ООО «Компания», 123456, г.Москва, ул. Тверская, д.6</div>
                       <div>ИНН 1234567890 ОГРН 123456789012</div>",
            'policy_wrap' => '<a class="policy">Политика конфиденциальности</a>',
            'phone' => '8 (800) 123 45 67',
            'phone_desc' => 'Звонок по России бесплатный',
            'copyright' => '<a href="" target="_blank"><i></i><span>Создано на платформе "Beejee"</span></a>',
        );
    }
    
}


Footer::register();