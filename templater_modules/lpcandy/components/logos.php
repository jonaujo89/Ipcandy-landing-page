<?php

class Logos extends Block {
    public $name = 'Logos';
    public $description = "Logos our clients";
    
    function tpl($val) {?>
        <div class="container-fluid logoClients logoClients1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <?=$this->sub("Text",'title')?>
                    </h1>

                    <div class="item_list clear gray">
                            
                            <div class="item">
                                <?=$this->sub('ImageSrc','img_1')?>
                            </div>
                            <div class="item">
                                <?=$this->sub('ImageSrc','img_2')?>
                            </div>
                            <div class="item">
                                <?=$this->sub('ImageSrc','img_3')?>
                            </div>
                            <div class="item">
                                <?=$this->sub('ImageSrc','img_4')?>
                            </div>
                            <div class="item">
                                <?=$this->sub('ImageSrc','img_5')?>
                            </div>
                            <div class="item">
                                <?=$this->sub('ImageSrc','img_6')?>
                            </div>
                            <div class="item">
                                <?=$this->sub('ImageSrc','img_7')?>
                            </div>

                        
                        <div style="clear: both"></div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Наши клиенты",
            'img_1' => "templater_modules/lpcandy/assets/logos/logo_1.png",
            'img_2' => "templater_modules/lpcandy/assets/logos/logo_6.png",
            'img_3' => "templater_modules/lpcandy/assets/logos/logo_3.png",
            'img_4' => "templater_modules/lpcandy/assets/logos/logo_4.png",
            'img_5' => "templater_modules/lpcandy/assets/logos/logo_5.png",
            'img_6' => "templater_modules/lpcandy/assets/logos/logo_6.png",
            'img_7' => "templater_modules/lpcandy/assets/logos/logo_7.png",
        );
    }
    
}


Logos::register();