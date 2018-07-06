<?php

namespace LPCandy\Components;

class Logos extends Block {
    public $name;
    public $description;
    public $editor = "lp.logos";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Logos';
            $this->description = "Logos of the partners";
        } else {
            $this->name = 'Логотипы';
            $this->description = "Логотипы партнёров";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid clientsLogos clientsLogos_1" style="background:<?=$val['background_color']?>;">
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
                        
                        <? $this->repeat('items',function($sub,$self) { ?>
                        
                            <? $self->sub('LogoItem','image'); ?>
                        
                        <? },array('inline' => true)) ?>
                        
                        <div style="clear: both"></div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'grayscale_logo' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Our partners",
            'title_2' => "Subtitle about our partners",
            'items' => array(
                array('image'=>Configuration::$assets_url."/logos/1.png"),
                array('image'=>Configuration::$assets_url."/logos/2.png"),
                array('image'=>Configuration::$assets_url."/logos/3.png"),
                array('image'=>Configuration::$assets_url."/logos/4.png"),
                array('image'=>Configuration::$assets_url."/logos/5.png"),
                array('image'=>Configuration::$assets_url."/logos/6.png"),
                array('image'=>Configuration::$assets_url."/logos/7.png"),
                array('image'=>Configuration::$assets_url."/logos/8.png"),
                array('image'=>Configuration::$assets_url."/logos/9.png"),
                array('image'=>Configuration::$assets_url."/logos/11.png"),
                array('image'=>Configuration::$assets_url."/logos/12.png"),
            )
        ] : [            
            'show_title' => true,
            'show_title_2' => false,
            'grayscale_logo' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Наши партнёры",
            'title_2' => "Подзаголовок про партнёров",
            'items' => array(
                array('image'=>Configuration::$assets_url."/logos/1.png"),
                array('image'=>Configuration::$assets_url."/logos/2.png"),
                array('image'=>Configuration::$assets_url."/logos/3.png"),
                array('image'=>Configuration::$assets_url."/logos/4.png"),
                array('image'=>Configuration::$assets_url."/logos/5.png"),
                array('image'=>Configuration::$assets_url."/logos/6.png"),
                array('image'=>Configuration::$assets_url."/logos/7.png"),
                array('image'=>Configuration::$assets_url."/logos/8.png"),
                array('image'=>Configuration::$assets_url."/logos/9.png"),
                array('image'=>Configuration::$assets_url."/logos/11.png"),
                array('image'=>Configuration::$assets_url."/logos/12.png"),
            )
        ];
    }    
}