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
                        <? 
                            $this->repeat(
                                'items',
                                function($sub,$self) {
                                    $self->sub('ImageSrc','image');
                                },
                                array('inline' => true)
                            ) 
                        ?>
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
            'items' => array(
                array('image'=>"templater_modules/lpcandy/assets/logos/logo_1.png"),
                array('image'=>"templater_modules/lpcandy/assets/logos/logo_6.png"),
                array('image'=>"templater_modules/lpcandy/assets/logos/logo_3.png"),
                array('image'=>"templater_modules/lpcandy/assets/logos/logo_4.png"),
                array('image'=>"templater_modules/lpcandy/assets/logos/logo_5.png"),
                array('image'=>"templater_modules/lpcandy/assets/logos/logo_6.png"),
                array('image'=>"templater_modules/lpcandy/assets/logos/logo_7.png"),
            )
        );
    }
    
}


Logos::register();