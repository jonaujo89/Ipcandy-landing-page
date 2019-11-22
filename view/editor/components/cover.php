<?php

namespace LPCandy\Components;

class Cover extends Block {
    public $name;
    public $description;
    public $editor = "lp.cover";
    

    function __construct() {
        if (self::$en) {
            $this->name = 'Cover';
            $this->description = '';
        } else {
            $this->name = 'Обложка';
            $this->description = '';
        }
    }

    function tpl($val) {?>
        <div class="container-fluid cover cover_1" style="background-image: url('<?=$this->api->base_url."/".$val['background']?>');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="icon">
                            <? $this->sub('Icon', 'icon'); ?>
                        </div>
                        <div class="title">
                            <? $this->sub('Text', 'title', Text::$plain_heading); ?>
                        </div>
                        <div class="form">
                            <? $this->sub('FormOrder','form'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default() {
        return self::$en ? [
            'background' => Configuration::$assets_url.'/cover/cover-1.jpg',
            'icon' => Configuration::$assets_url.'/ico/740.png',
            'title' => 'Soft furniture<br> for house',
            'form' => array(
                'button' => array('color'=>'blue','label'=> "Get a catalog"),
                'form_done_title' => 'Thanks',
                'form_done_text' => 'Catalog has been sent on your email',
                'fields' => array(
                    array(
                        'label' => '', 'sub_label' => '', 'required' => true,
                        'name' => 'email', 'type' => 'text', 'placeholder' => 'Email *'
                    )
                )
            )
        ] : [
            'background' => Configuration::$assets_url.'/cover/cover-1.jpg',
            'icon' => Configuration::$assets_url.'/ico/740.png',
            'title' => 'Мягкая мебель<br> для дома',
            'form' => array(
                'button' => array('color'=>'blue','label'=> "Получить каталог"),
                'form_done_title' => 'Спасибо',
                'form_done_text' => 'Каталог был отправлен на Вашу почту',
                'fields' => array(
                    array(
                        'label' => '', 'sub_label' => '', 'required' => true,
                        'name' => 'email', 'type' => 'text', 'placeholder' => 'Email *'
                    )
                )
            )
        ];
    }

    function tpl_2($val){?>
        <div class="container-fluid cover cover_2" style="background-image: url('<?=$this->api->base_url."/".$val['background']?>');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="icon">
                            <? $this->sub('Icon', 'icon'); ?>
                        </div>
                        <div class="form">
                            <? $this->sub('FormOrder','form'); ?>
                        </div>
                        <div class="row">
                            <div class="text col-5">
                                <? $this->sub('Text', 'text', Text::$default_text); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_2() {
        return self::$en ? [
            'background' => Configuration::$assets_url.'/cover/cover-46.jpg',
            'icon' => Configuration::$assets_url.'/ico/31.png',
            'text' => 'Subscribe on mailing and get hot offers to travel in different countries.',
            'form' => array(
                'button' => array('color'=>'purple','label'=> "Subscribe"),
                'form_done_title' => 'Thanks',
                'form_done_text' => 'You have subscribed successfully',
                'fields' => array(
                    array(
                        'label' => 'Name', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Email', 'sub_label' => '', 'required' => true,
                        'name' => 'email', 'type' => 'text', 'placeholder' => ''
                    )
                )
            )
        ] : [
            'background' => Configuration::$assets_url.'/cover/cover-46.jpg',
            'icon' => Configuration::$assets_url.'/ico/31.png',
            'text' => 'Подписывайтесь на рассылку и получайте на почту горячие предложения о путешествиях в разные страны.',
            'form' => array(
                'button' => array('color'=>'purple','label'=> "Подписаться"),
                'form_done_title' => 'Спасибо',
                'form_done_text' => 'Вы успешно подписались',
                'fields' => array(
                    array(
                        'label' => 'Имя', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Электронная почта', 'sub_label' => '', 'required' => true,
                        'name' => 'email', 'type' => 'text', 'placeholder' => ''
                    )
                )
            )
        ];
    }

    function tpl_3($val) {?>
        <div class="container-fluid cover cover_3" style="background-image: url('<?=$this->api->base_url."/".$val['background']?>');">
            <div class="container">
                <div class="content">
                    <div class="title">
                        <? $this->sub('Text', 'text', Text::$color_text); ?>
                    </div>
                    <div class="row">
                        <div class="col-6 before-1 media-col">
                            <? $this->sub('Media', 'media'); ?>
                        </div>
                        <div class="col-4 form-col">
                            <div class="form">
                                <? $this->sub('FormOrder', 'form'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_3() {
        return self::$en ? [
            'background' => Configuration::$assets_url.'/cover/cover-99.jpg',
            'media' =>  array_merge(Media::get()->tpl_default(),array('type'=>'video')),
            'text' => 'True school run',
            'form' => array(
                'fields' => array(
                    'button' => array('color'=>'purple','label'=> "Sign up on a training"),
                    'form_done_title' => 'Thanks',
                    'form_done_text' => 'You successfully signed up on a training',
                    array(
                        'label' => 'Name', 'sub_label' => '', 'required' => false,
                        'name' => 'name', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Email', 'sub_label' => '', 'required' => false,
                        'name' => 'email', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Phone', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text'
                    )
                )
            )
        ] : [
            'background' => Configuration::$assets_url.'/cover/cover-99.jpg',
            'media' =>  array_merge(Media::get()->tpl_default(),array('type'=>'video')),
            'text' => 'Школа правильного бега',
            'form' => array(
                'button' => array('color'=>'purple','label'=> "Записаться на тренировку"),
                'form_done_title' => 'Спасибо',
                'form_done_text' => 'Вы успешно записались на тренировку',
                'fields' => array(
                    array(
                        'label' => 'Имя', 'sub_label' => '', 'required' => false,
                        'name' => 'name', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Электронная почта', 'sub_label' => '', 'required' => false,
                        'name' => 'email', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Телефон', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text'
                    )
                )
            )
        ];
    }

    function tpl_4($val) {?>
        <div class="container-fluid cover cover_4" style="background-image: url('<?=$this->api->base_url."/".$val['background']?>');">
            <div class="container">
                <div class="logo-col">
                    <? $this->sub('Logo', 'logo'); ?>
                </div>

                <div class="content-col">
                    <div class="row">
                        <div class="col-6 before-6">
                            <div class="title">
                                <? $this->sub('Text', 'title', Text::$color_text); ?>
                            </div>
                            <div class="desc">
                                <? $this->sub('Text', 'desc', Text::$default_text); ?>
                            </div>
                            <div class="btn_wrap">
                                <? $this->sub('FormButton','button_form'); ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_4() {
        return self::$en ? [
            'background' => Configuration::$assets_url.'/cover/cover-10.jpg',
            'logo' => Logo::get()->tpl_default(),
            'title' => 'Extremal driving course',
            'desc' => 'Driving courses in extremal situations might decrease time in road and prevent hard situations on road',
            'button_form' => array_merge(FormButton::get()->tpl_default(), array('form' => array(
                'fields' => array(
                    array(
                        'label' => 'Name', 'sub_label' => '', 'required' => false,
                        'name' => 'name', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Phone', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text'
                    )
                ),
                'button' => array('color' => 'purple', 'label' => 'Order the call'),
                'form_done_title' => 'Thanks',
                'form_done_text' => 'We will call you as soon as possible' 
            ),'text' => 'Order the call', 'color' => 'purple'))
        ] : [
            'background' => Configuration::$assets_url.'/cover/cover-10.jpg',
            'logo' => Logo::get()->tpl_default(),
            'title' => 'Курс экстремального вождения',
            'desc' => 'Курсы вождения в экстремальных ситуациях помогут сэкономить время в пути и предотвратить неприятные ситуации на дороге',
            'button_form' => array_merge(FormButton::get()->tpl_default(), array('form' => array(
                'fields' => array(
                    array(
                        'label' => 'Имя', 'sub_label' => '', 'required' => false,
                        'name' => 'name', 'type' => 'text'
                    ),
                    array(
                        'label' => 'Номер телефона', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text'
                    )
                ),
                'button' => array('color' => 'purple', 'label' => 'Заказать звонок'),
                'form_done_title' => 'Спасибо',
                'form_done_text' => 'Мы перезвоним вам как только сможем' 
            ),'text' => 'Заказать звонок', 'color' => 'purple'))
        ];
    }
}