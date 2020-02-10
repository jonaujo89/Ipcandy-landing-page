<?php

namespace LPCandy\Components;

class Map extends Block {
    public $name;
    public $description;
    public $editor = "lp.map";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Contacts';
            $this->description = "Company contacts";
        } else {
            $this->name = 'Контакты';
            $this->description = "Карта и адреса";
        }        
    }
    
    function tpl($val) {?>
        <div class="contacts contacts_1">
            <div class="container">
                <? if ($cls = $this->vis($val['show_container_text'])): ?>
                    <div class="container_text <?=$cls?>" >  
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                                <div class="map_overlay">
                                    <div class="title">
                                        <?= $self->sub('Text','title_1',Text::$plain_heading)?>
                                    </div>
                                    <div class="desc">
                                        <?= $self->sub('Text','desc_1',Text::$default_text)?>
                                    </div> 
                                </div>
                            <? }) ?>
                        </div>                
                <? endif ?>
                <div class="map-block">
                    <? $this->sub('YandexMap','map') ?>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'show_container_text' => true, 
            'map' => YandexMap::get()->tpl_default(),
            'items' => array(
                array(
                    'title_1' => 'One and the same are at the circus ring',
                    'desc_1' => 'Moscow, Color Blvd., 13<br>200 meters from the rotation<br>Тел: +7 (495) 321-46-98<br>smile@zaraza.net'
                )
            )            
        ] : [
            'show_container_text' => true,  
            'map' => YandexMap::get()->tpl_default(),
            'items' => array(
                array(
                    'title_1' => "На манеже все те же",
                    'desc_1' => "г. Москва, Цветной бульвар, 13<br>200 метров от поворота<br>Тел: +7 (495) 321-46-98<br>smile@zaraza.net"
                )
            )
        ];
    }

    function tpl_2($val) {?>
        <div class="contacts contacts_2" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <?php if ($cls = $this->vis($val['show_title'])): ?>
                    <h2 class="title <?=$cls?>">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h2>
                <?php endif?>
                <? if ($cls = $this->vis($val['show_title_2'])): ?>
                    <div class="title_2 <?=$cls?>">
                        <? $this->sub('Text','title_2',Text::$plain_text) ?>
                    </div>
                <?php endif?>
                <div class="row">
                    <div class="col-5">
                        <div class="map-block">
                            <? $this->sub('YandexMap','map') ?>
                        </div>
                        <div class="info-lines">
                            <? $this->repeat('info_lines', function($item_val,$self) use ($val){ ?> 
                                <div class="info-line">
                                    <? $this->sub('Text','text') ?>
                                </div>
                            <? }); ?>
                        </div>
                        <div class="span_btn" >
                            <div class="btn_wrap">
                                <? $this->sub("FormButton",'send_message_button') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <? $this->sub('Image','image') ?>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_send_message() {
        return self::$en ? [
            'type' => 'form',
            'link' => '',
            'form_title' => "Contact us",
            'form_bottom_text' => "We don't provide Israeli intelligence with your personal information",
            'color' => 'red',
            'text' => "Contact us",
            'form' => array(
                'fields' => array(
                    array(
                        'label' => 'Name', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Phone', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Message', 'sub_label' => '', 'required' => true,
                        'name' => 'message', 'type' => 'textarea', 
                    ),
                ),
                'button' => array('color'=>'blue','label'=>'Send message'),                
                'form_done_title' => 'Message sent',
                'form_done_text' => 'Application is sent. Our manager will contact you shortly.',
            )
        ] : [
            'type' => 'form',
            'link' => '',
            'form_title' => "Напишите нам",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
            'color' => 'blue',
            'text' => "Напишите нам",
            'form' => array(
                'fields' => array(
                    array(
                        'label' => 'Имя', 'sub_label' => '', 'required' => true,
                        'name' => 'name', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Телефон', 'sub_label' => '', 'required' => true,
                        'name' => 'phone', 'type' => 'text', 
                    ),
                    array(
                        'label' => 'Сообщение', 'sub_label' => '', 'required' => true,
                        'name' => 'message', 'type' => 'textarea', 
                    ),
                ),
                'button' => array('color'=>'blue','label'=>'Отправить сообщение'),                
                'form_done_title' => 'Сообщение отправлено',
                'form_done_text' => 'Наш менеджер свяжется с Вами в ближайшее время.',
            ),        
        ];
    }

    function tpl_default_info_lines() {
        return self::$en ? [
            ['text' => '<b>Address:</b> Moscow, Color Blvd., 13'],
            ['text' => '<b>Phone:</b> +7 (495) 321-46-98'],
            ['text' => '<b>E-Mail:</b> smile@zaraza.net'],
        ] : [
            ['text' => '<b>Адрес:</b> г. Москва, Цветной бульвар, 13'],
            ['text' => '<b>Телефон:</b> +7 (495) 321-46-98'],
            ['text' => '<b>E-mail:</b> smile@zaraza.net'],
        ];
    }

    function tpl_default_2() {
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => true,
            'title' => 'How to find us',
            'title_2' => 'Not as easy as you supposed to think',
            'background_color' =>'#FFFFFF',            
            'map' => YandexMap::get()->tpl_default(),
            'info_lines' => $this->tpl_default_info_lines(),
            'image' => Configuration::$assets_url.'/gallery/4.jpg',
            'send_message_button' => $this->tpl_default_send_message()
        ] : [
            'show_title' => true,
            'show_title_2' => true,
            'title' => 'Как нас найти',
            'title_2' => 'Легко потерять и невозможно забыть',
            'background_color' =>'#FFFFFF',            
            'map' => YandexMap::get()->tpl_default(),
            'info_lines' => $this->tpl_default_info_lines(),
            'image' => Configuration::$assets_url.'/gallery/4.jpg',
            'send_message_button' => $this->tpl_default_send_message()
        ];
    }

    function tpl_3($val) {?>
        <div class="contacts contacts_3" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <?php if ($cls = $this->vis($val['show_title'])): ?>
                            <h2 class="sub_title <?=$cls?>"><? $this->sub('Text','title',Text::$plain_text) ?></h2>
                        <?php endif?>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="sub_title_2 <?=$cls?>"><? $this->sub('Text','title_2',Text::$plain_text) ?></div>
                        <?php endif?>
                        <div class="info-lines">
                            <? $this->repeat('info_lines', function($item_val,$self) use ($val){ ?> 
                                <div class="info-line"><? $this->sub('Text','text') ?></div>
                            <? }); ?>
                        </div>
                        <div class="span_btn" >
                            <div class="btn_wrap">
                                <? $this->sub("FormButton",'send_message_button') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="map-block">
                            <? $this->sub('YandexMap','map') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_3() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => true,
            'title' => 'How to find us',
            'title_2' => 'Not as easy as you supposed to think',
            'background_color' =>'#FFFFFF',
            'map' => YandexMap::get()->tpl_default(),
            'info_lines' => $this->tpl_default_info_lines(),
            'send_message_button' => $this->tpl_default_send_message()
        ] : [
            'show_title' => true,
            'show_title_2' => true,
            'title' => 'Как нас найти',
            'title_2' => 'Легко потерять и невозможно забыть',
            'background_color' =>'#FFFFFF',
            'map' => YandexMap::get()->tpl_default(),
            'info_lines' => $this->tpl_default_info_lines(),
            'send_message_button' => $this->tpl_default_send_message()
        ];
    }

    function tpl_4($val) {?>
        <div class="contacts contacts_4" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <?php if ($cls = $this->vis($val['show_title'])): ?>
                            <h2 class="sub_title <?=$cls?>"><? $this->sub('Text','title',Text::$plain_text) ?></h2>
                        <?php endif?>
                        <?php if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="sub_title_2 <?=$cls?>"><? $this->sub('Text','title_2',Text::$plain_text) ?></div>
                        <?php endif?>
                        <div class="info-lines">
                            <? $this->repeat('info_lines', function($item_val,$self) use ($val){ ?> 
                                <div class="info-line"><? $this->sub('Text','text') ?></div>
                            <? }); ?>
                        </div>
                    </div>
                    <div class="col-6 before-1">
                        <div class="form ">
                            <div class="form_data">
                                <? $this->sub('FormOrder','send_message_button.form'); ?>
                            </div>
                            <div class="form_bottom">
                                <? $this->sub('Text','send_message_button.form_bottom_text'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_4() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => true,
            'title' => 'How to find us',
            'title_2' => 'Not as easy as you supposed to think',
            'background_color' =>'#FFFFFF',
            'info_lines' => $this->tpl_default_info_lines(),
            'send_message_button' => $this->tpl_default_send_message()
        ] : [
            'show_title' => true,
            'show_title_2' => true,
            'title' => 'Как нас найти',
            'title_2' => 'Легко потерять и невозможно забыть',
            'background_color' =>'#FFFFFF',
            'info_lines' => $this->tpl_default_info_lines(),
            'send_message_button' => $this->tpl_default_send_message()
        ];
    }

    function tpl_5($val) {?>
        <div class="contacts contacts_5" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <?php if ($cls = $this->vis($val['show_title'])): ?>
                    <h2 class="title <?=$cls?>"><? $this->sub('Text','title',Text::$plain_text) ?></h2>
                <?php endif?>
                <?php if ($cls = $this->vis($val['show_title_2'])): ?>
                    <div class="title_2 <?=$cls?>"><? $this->sub('Text','title_2',Text::$plain_text) ?></div>
                <?php endif?>
                <div class="locations">
                    <? $this->repeat('locations', function($item_val,$self) use ($val){ ?>                                
                        <div class="location">
                            <div class="map-block">
                                <? $self->sub('YandexMap','map') ?>
                            </div>
                            <div class="name"><? $self->sub('Text','name') ?></div>
                            <div class="desc"><? $self->sub('Text','desc') ?></div>
                        </div>
                    <? },array('editor' => 'lp.mapRepeater'));?>											
                </div>
            </div>
        </div>
    <?}

    function tpl_default_location($lat,$lng,$name,$address,$phone) {
        $phone_label = self::$en ? "Phone" : "Телефон";
        return [
            'name' => $name,
            'desc' => $address."<br><b>".$phone_label.":</b> ".$phone,
            'map' => [
                'map' => [
                    'map_type' => 'yandex',
                    'map_center' => [$lat,$lng],
                    'map_zoom' => 15,
                    'map_places' => [[
                        'type' => 'placemark',
                        'title' => $name,
                        'address' => $address,
                        'lat' => $lat,
                        'lng' => $lng,
                        'color' => 'red'
                    ]]
                ]
            ]
        ];
    }

    function tpl_default_5() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => true,
            'background_color' =>'#FFFFFF',
            'title' => 'How to find us',
            'title_2' => 'Not as easy as you supposed to think',
            'locations' => [
                $this->tpl_default_location("55.770600", "37.620000","First office","Moscow, Color avenue, 13","+7 (495) 112-11-55"),
                $this->tpl_default_location("40.706014","-74.008899","Second office","New York, Wall street, 15","+7 (495)783-22-14"),
                $this->tpl_default_location("48.870502",  "2.306838","Third office","Paris, Les Champs, 56","+7 (495) 763-34-12")
            ],
        ] : [
            'show_title' => true,
            'show_title_2' => true,
            'background_color' =>'#FFFFFF',
            'title' => 'Как нас найти',
            'title_2' => 'Легко потерять и невозможно забыть',
            'locations' => [
                $this->tpl_default_location("55.770600", "37.620000","Первый офис","Москва, Цветной бульвар, 13","+7 (495) 112-11-55"),
                $this->tpl_default_location("40.706014","-74.008899","Второй офис","Нью-Йорк, Уолл-стрит, 15","+7 (495)783-22-14"),
                $this->tpl_default_location("48.870502",  "2.306838","Третий офис","Париж, Елисейские поля, 56","+7 (495) 763-34-12")
            ]
        ];
    }

    function tpl_6($val) {?>
        <div class="contacts contacts_6" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="sub_title"><? $this->sub('Text','title',Text::$plain_text) ?></h2>
                        <div class="sub_title_2"><? $this->sub('Text','title_2',Text::$plain_text) ?></div>
                    </div>
                    <div class="col-6">
                        <div class="contact-lines">
                            <? $this->repeat('contact_lines', function($item_val,$self) use ($val){ ?> 
                                <div class="contact-line">
                                    <?= $this->sub('Icon','icon') ?>
                                    <div class="line-title"><? $this->sub('Text','title') ?></div>
                                    <div class="line-text"><? $this->sub('Text','text') ?></div>
                                </div>
                            <? }); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}

    function tpl_default_6() { 
        return self::$en ? [
            'title' => 'How to find us',
            'title_2' => 'Not as easy as you supposed to think',
            'background_color' =>'#313138',
            'contact_lines' => [
                [
                    'icon' => Configuration::$assets_url.'/ico/195.png',
                    'title' => 'Address',
                    'text' => ' Moscow, Color Blvd., 13'
                ],
                [
                    'icon' => Configuration::$assets_url.'/ico/217.png',
                    'title' => 'Phone',
                    'text' => '+7 (495) 321-46-98'
                ],
                [
                    'icon' => Configuration::$assets_url.'/ico/26.png',
                    'title' => 'E-mail',
                    'text' => 'smile@zaraza.net'
                ],
            ]
        ] : [
            'title' => 'Как нас найти',
            'title_2' => 'Легко потерять и невозможно забыть',
            'background_color' =>'#313138',
            'contact_lines' => [
                [
                    'icon' => Configuration::$assets_url.'/ico/195.png',
                    'title' => 'Адрес',
                    'text' => 'г. Москва, Цветной бульвар, 13'
                ],
                [
                    'icon' => Configuration::$assets_url.'/ico/217.png',
                    'title' => 'Телефон',
                    'text' => '+7 (495) 321-46-98'
                ],
                [
                    'icon' => Configuration::$assets_url.'/ico/26.png',
                    'title' => 'E-mail',
                    'text' => 'smile@zaraza.net'
                ],
            ]
        ];
    }
}