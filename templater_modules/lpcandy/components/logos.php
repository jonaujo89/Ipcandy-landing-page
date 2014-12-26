<?php

class Logos extends Block {
    public $name = 'Logos';
    public $description = "Logos our clients";
    public $editor = "lp.logos";
    
    function tpl($val) {?>
        <div class="container-fluid clientsLogos clientsLogos_1" style="background: ;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title', array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2', array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear <?= $val['grayscale_logo'] ? "gray" : "" ?>">
                        <? 
                            $this->repeat('items', function($sub,$self) {
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
            'show_title' => true,
            'show_title_2' => false,
            'grayscale_logo' => true,
            'background_color' =>'rgb(247, 247, 247)',
            'title' => "Наши клиенты",
            'title_2' => "Подзаголовок ",
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