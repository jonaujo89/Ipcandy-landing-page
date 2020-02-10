<?php

namespace LPCandy\Components;

class Cover extends Block {
    public $name;
    public $description;
    public $editor = "lp.coverBlock";
    

    function __construct() {
        if (self::$en) {
            $this->name = 'Cover';
            $this->description = 'Fullscreen block';
        } else {
            $this->name = 'Обложка';
            $this->description = 'На весь экран';
        }
    }

    function tpl($val,$variant=1,$block_align="center") {?>
        <div class="container-fluid cover cover_<?=$variant?> cover_1_2 cover_1_2_<?=$block_align?>" style="background-image: url('<?=$this->api->base_url."/".$val['background']?>');">
            <div class="container">
                <div class="row">
                    <div class="col-6 before-3">
                        <? if ($cls = $this->vis($val['show_icon'])): ?>
                            <div class="icon <?=$cls?>">
                                <? $this->sub('Icon', 'icon',['iconType'=>'white']); ?>
                            </div>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title'])): ?>
                            <div class="sub_title <?=$cls?>">
                                <? $this->sub('Text', 'title', Text::$plain_text); ?>
                            </div>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="sub_title_2 <?=$cls?>">
                                <? $this->sub('Text', 'title_2', Text::$plain_text); ?>
                            </div>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_form'] && $val['show_form_as_popup'])): ?>
                            <div class="form form_popup <?=$cls?>">
                                <form>
                                    <div class="form_submit">
                                        <div class="btn_wrap">
                                            <? $this->sub('FormButton','form_button'); ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_form'] && !$val['show_form_as_popup'])): ?>
                            <div class="form form_inline <?=$cls?>">
                                <? $this->sub('FormOrder','form_button.form'); ?>
                            </div>
                        <? endif ?>

                        <? if ($cls = $this->vis($val['show_description'])): ?>
                            <div class="description <?=$cls?>">
                                <? $this->sub('Text', 'description', Text::$default_text); ?>
                            </div>
                        <? endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default() {
        return (self::$en ? [
            'title' => 'Our circus works from dusk till down',
            'title_2' => 'Bring your kids, colleagues, enemies, strangers, aliens and even pets here',
            'description' => 'Leave your email and we will send you some jokes',

            'form_button' => [
                'type' => 'form',
                'link' => '',
                'form_title' => 'Subscribe to jokes',
                'form_bottom_text' => "We do not share anything from your personal info",
                'color' => 'blue',
                'text' => 'Gimme some jokes!',

                'form' => [
                    'button' => ['color'=>'blue','label'=> "Subscribe"],
                    'form_done_title' => 'Thank you!',
                    'form_done_text' => 'You have subscribed',
                    'fields' => [
                        [
                            'label' => 'Name', 'sub_label' => '', 'required' => true,
                            'name' => 'name', 'type' => 'text'
                        ],
                        [
                            'label' => 'E-mail', 'sub_label' => '', 'required' => true,
                            'name' => 'email', 'type' => 'text', 'placeholder' => ''
                        ]
                    ]
                ]
            ]            
        ] : [
            'title' => 'Двери нашего цирка открыты всегда',
            'title_2' => 'Приводите детей, дедушек, бабушек и даже домашних животных',
            'description' => 'Оставьте свою почту и мы будем присылать вам смешные анекдоты от наших клоунов',

            'form_button' => [
                'type' => 'form',
                'link' => '',
                'form_title' => 'Подписка на шутки',
                'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
                'color' => 'blue',
                'text' => 'Хочу подписку на шутки!',

                'form' => [
                    'button' => ['color'=>'blue','label'=> "Подписаться"],
                    'form_done_title' => 'Спасибо!',
                    'form_done_text' => 'Вы успешно подписались',
                    'fields' => [
                        [
                            'label' => 'Имя', 'sub_label' => '', 'required' => true,
                            'name' => 'name', 'type' => 'text'
                        ],
                        [
                            'label' => 'E-mail', 'sub_label' => '', 'required' => true,
                            'name' => 'email', 'type' => 'text', 'placeholder' => ''
                        ]
                    ]
                ]
            ]
        ]) + [
            'background' => Configuration::$assets_url.'/gallery/6.jpg',
            'icon' => Configuration::$assets_url.'/ico/383.png',
            'show_icon' => false,
            'show_title' => true,
            'show_title_2' => true,
            'show_form' => true,
            'show_form_as_popup' => false,
            'show_description' => true
        ];
    }


    function tpl_2($val){
        $this->tpl($val,$variant=2,$block_align="right");
    }

    function tpl_default_2() {
        return [
            'background' => Configuration::$assets_url.'/gallery/8.jpg',
            'show_form' => true,
            'show_title_2' => false,
            'show_form_as_popup' => true,
            'show_description' => true
        ] 
            + $this->tpl_default();
    }

    
    function tpl_3($val) {?>
        <div class="container-fluid cover cover_3" style="background-image: url('<?=$this->api->base_url."/".$val['background']?>');">
            <div class="container">
                <div class="cover-content">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <div class="title <?=$cls?>">
                            <? $this->sub('Text', 'title', Text::$plain_text); ?>
                        </div>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?>">
                            <? $this->sub('Text', 'title_2', Text::$plain_text); ?>
                        </div>
                    <? endif ?>

                    <div class="row">
                        <div class="col-6 before-1 media-col">
                            <? $this->sub('Media', 'media'); ?>
                        </div>
                        <div class="col-4 form-col">
                            <div class="form">
                                <? $this->sub('FormOrder', 'form_button.form'); ?>
                                <div class="form_bottom" >
                                    <? $this->sub('Text','form_button.form_bottom_text') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_3() {
        $default = $this->tpl_default();
        return self::$en ? [] : [
            'show_title' => true,
            'show_title_2' => true,
            'title' => $default['title'],
            'title_2' => $default['title_2'],
            'background' => Configuration::$assets_url.'/gallery/3.jpg',
            'media' =>  array_merge(Media::get()->tpl_default(),array('type'=>'video')),
            'form_button' => $default['form_button']
        ];
    }

}