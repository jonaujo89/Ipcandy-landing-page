<?php

class Logos extends Block {
    public $name = 'Логотипы';
    public $description = "Логотипы клиентов и партнёров";
    public $editor = "lp.logos";
    
    function tpl($val) {?>
        <div class="container-fluid clientsLogos clientsLogos_1" style="background: ;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_text) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear <?= $val['grayscale_logo'] ? "gray" : "" ?>">
                        <? $this->repeat(
                                    'items', 
                                     function($sub,$self) { $self->sub('ImageSrc','image'); },
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
            'show_title' => true,
            'show_title_2' => false,
            'grayscale_logo' => true,
            'background_color' =>'rgb(247, 247, 247)',
            'title' => "Наши клиенты",
            'title_2' => "Подзаголовок ",
            'items' => array(
                array('image'=>"view/editor/assets/logos/logo_1.png"),
                array('image'=>"view/editor/assets/logos/logo_6.png"),
                array('image'=>"view/editor/assets/logos/logo_3.png"),
                array('image'=>"view/editor/assets/logos/logo_4.png"),
                array('image'=>"view/editor/assets/logos/logo_5.png"),
                array('image'=>"view/editor/assets/logos/logo_6.png"),
                array('image'=>"view/editor/assets/logos/logo_7.png"),
            )
        );
    }    
}

Logos::register();