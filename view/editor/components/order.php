<?php

namespace LPCandy\Components;

class Order extends Block {
    public $name;
    public $description;
    public $editor = "lp.order";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Order';
            $this->description = "Block with a picture and form";
        } else {
            $this->name = 'Заявка';
            $this->description = "Блок с картинкой и формой";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid order order_1" style="background: url('<?=$this->api->base_url."/".$val['background']?>')">
            <div class="dark">
                <div class="container">
                    <div class="span10">
                        <div class="title_1">
                            <div class="list"><? $this->sub('Text','title_1',Text::$plain_text) ?></div>                               
                        </div>
                        <div class="title_2">
                            <div class="list"><? $this->sub('Text','title_2',Text::$plain_text) ?></div>
                        </div>
                    </div>
                    <div class="span6">  
                        <div class="form">
                            <div class="form_title">
                                <? $this->sub('Text','form_title_1',Text::$default_text) ?>    
                            </div>
                            <? if ($cls = $this->vis($val['show_form_title_2'])): ?>
                                <div class="form_title_2 <?=$cls?>" >
                                    <? $this->sub('Text','form_title_2',Text::$default_text) ?>
                                </div>
                            <? endif ?>
                            <div class="form_data">
                                <? $this->sub('FormOrder','form') ?>
                            </div>
                            <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
                                <div class="form_bottom <?=$cls?>" >
                                    <? $this->sub('Text','form_bottom_text',Text::$default_text) ?>
                                </div>
                            <? endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return self::$en ? [
            'show_form_title_2' => true,
            'show_form_bottom_text' => true,
            'background' =>'view/editor/assets/background/91.jpg',
            'title_1' => "<div>SMILES</div><div>HOME</div><div>DELIVERY</div>",
            'title_2' => "<div>Only quality smiles</div><div>Guaranteed safety of cargo</div><div>Timely delivery</div>",
            'form_title_1' => "Leave the application and get a free smile",
            'form_title_2' => "WAITING FOR A COURIER",
            'form_bottom_text' => "We don't provide Israeli intelligence with your personal information",
            'form' => FormOrder::get()->tpl_default(),
        ] : [
            'show_form_title_2' => true,
            'show_form_bottom_text' => true,
            'background' =>'view/editor/assets/background/91.jpg',
            'title_1' => "<div>ДОСТАВКА</div><div>УЛЫБОЧЕК</div><div>ВАМ ДОМОЙ</div>",
            'title_2' => "<div>Только качественные улыбочки</div><div>Гарантированная сохранность груза</div><div>Своевременная доставка</div>",
            'form_title_1' => "Оставьте заявку и получите бесплатную улыбочку",
            'form_title_2' => "Ожидайте курьера",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке",
            'form' => FormOrder::get()->tpl_default(),
        ];
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid order order_2" style="background: url('<?=$this->api->base_url."/".$val['background']?>')">
            <div class="background_toggle_noise <?= $val['show_background_noise'] ? "with_noise" : "dark"?>">
                <div class="container">
                    <div class="title_1">
                        <? $this->sub('Text','title_1',Text::$plain_text) ?>
                    </div>
                    <div class="title_2">
                        <? $this->sub('Text','title_2',Text::$plain_text) ?>
                    </div>
                    <? if ($cls = $this->vis($val['show_text_above_button'])): ?>
                        <div class="btn_note <?=$cls?>" >
                            <? $this->sub('Text','button_note',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <br>
                    <div class="btn_wrap <?= !$val['show_arrow'] ? "no_arrow" : ""?> <?= !$val['show_text_above_button'] ? "no_btn_note" : ""?> " >                        
                        <? $this->sub("FormButton",'button_order') ?>                        
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return self::$en ? [
            'show_background_noise' => true,
            'show_text_above_button' => true,
            'show_arrow' => true,
            'background' =>'view/editor/assets/background/192.jpg',
            'title_1' => "Free training of juggling",
            'title_2' => "Secret technique of  clown Zhora juggling",
            'button_note' => "Order Zhora and his friend Kleve right now! ",
            'button_order' =>  array_merge(FormButton::get()->tpl_default(),array('text'=>'Teach me to juggle', 'color'=>'orange'))            
        ] : [
            'show_background_noise' => true,
            'show_text_above_button' => true,
            'show_arrow' => true,
            'background' =>'view/editor/assets/background/192.jpg',
            'title_1' => "Бесплатное обучение жонглированию",
            'title_2' => "Секретная методика жонглирования от клоуна Жоры",
            'button_note' => "Закажите Жору и его друга Клеву прямо сейчас!",
            'button_order' =>  array_merge(FormButton::get()->tpl_default(),array('text'=>'Обучить меня жонглировать', 'color'=>'orange'))            
        ];
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid order order_3" style="background: url('<?=$this->api->base_url."/".$val['background']?>');">
            <div class="container">                
                <div class="img_wrap <?= $val['show_border'] ? "" : "hide_border" ?>">
                    <? $this->sub('Media','media') ?>
                </div>
                <div class="data_wrap">
                    <div class="title_1">
                        <? $this->sub('Text','title_1',Text::$color_text) ?>
                    </div>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$color_text) ?>
                        </div>
                    <? endif ?>
                    <div class="desc">
                        <? $this->sub('Text','desc',Text::$default_text) ?>
                    </div>
                    <? if ($cls = $this->vis($val['show_list_box'])): ?>
                        <div class="list <?=$cls?>" >
                            <ul>
                                <? $this->sub('Text','list',Text::$plain_text) ?>
                            </ul>
                        </div>
                    <? endif ?>
                    <div class="btn_wrap" >                        
                        <? $this->sub('FormButton','button_order') ?>                        
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>

    <?}
    
    function tpl_default_3() { 
        return self::$en ? [
            'show_border' => true,
            'show_title_2' => true,
            'show_list_box' => false,
            'background' =>'view/editor/assets/texture/1.png',
            'media' =>  array_merge(Media::get()->tpl_default(),array('type'=>'image','image_url'=> 'view/editor/assets/order/order_3.jpg')),
            'title_1' => "ONLY <span style='color:#C1103A'>REAL</span> AFRICAN ELEPHANTS",
            'title_2' => "NO CHINESE FAKES",
            'desc' => "Free exhibition of the Somali purple elephant.<br>Show time - 10 minutes.",
            'list' => "<p>Only we have clearing skin elephant</p><p>Only we have baking elephant</p><p>Only we have an elephant witch executes the command SIT</p>",
            'button_order' =>  array_merge(FormButton::get()->tpl_default(),array('text'=> "Have a look at the elephant", 'color'=>'purple_light')), 
        ] : [
            'show_border' => true,
            'show_title_2' => true,
            'show_list_box' => false,
            'background' =>'view/editor/assets/texture/1.png',
            'media' =>  array_merge(Media::get()->tpl_default(),array('type'=>'image','image_url'=> 'view/editor/assets/order/order_3.jpg')),
            'title_1' => "ТОЛЬКО <span style='color:#C1103A'>НАСТОЯЩИЕ</span> СЛОНЫ ИЗ АФРИКИ",
            'title_2' => "НИКАКИХ ПОДДЕЛОК ИЗ КИТАЯ",
            'desc' => "Бесплатно покажем Вам фиолетового сомалийского слона.<br>Время показа - 10 минут.",
            'list' => "<p>Только у нас слон сбрасывает свою шкуру</p><p>Только у нас слон лает</p><p>Только у нас слон выполняет команду СИДЕТЬ</p>",
            'button_order' =>  array_merge(FormButton::get()->tpl_default(),array('text'=> 'Посмотреть слона', 'color'=>'purple_light')), 
        ];
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid order order_4" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="title_1">
                    <? $this->sub('Text','title_1',Text::$plain_heading) ?>
                </div>
                <? if ($cls = $this->vis($val['show_title_2'])): ?>
                    <div class="title_2 <?=$cls?> " >
                        <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                    </div>
                <? endif ?>
                <div class="img_wrap <?= $val['show_box_shadow'] ? "" : "hide_box_shadow" ?>">
                    <? $this->sub('Media','media') ?>
                </div>
                <div class="form">
                    <div class="form_title">                        
                        <? $this->sub('Text','form_title',Text::$plain_text) ?>
                    </div>
                    <div class="form_data">
                        <? $this->sub('FormOrder','form') ?>
                    </div>
                    <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
                        <div class="form_bottom <?=$cls?>" >
                            <? $this->sub('Text','form_bottom_text',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                </div>           
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return self::$en ? [
            'show_form_bottom_text' => true,
            'show_box_shadow' => true,
            'show_title_2' => true,
            'background_color' =>'#313138',
            'media' =>  array_merge(Media::get()->tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/order/order_4.jpg')),
            'title_1' => "Exclusive Session of infectious laughter",
            'title_2' => "Inimitable smile from baby Jeremy",
            'form_title' => "LEAVE THE APPLICATION FOR FREE SMILE",
            'form_bottom_text' => "We don't provide Israeli intelligence with your personal information",  
            'form' => array_merge(FormOrder::get()->tpl_default(),array('button' => array('color'=>'rose','label'=> "Get a smile")))
        ] : [
            'show_form_bottom_text' => true,
            'show_box_shadow' => true,
            'show_title_2' => true,
            'background_color' =>'#313138',
            'media' =>  array_merge(Media::get()->tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/order/order_4.jpg')),
            'title_1' => "Эксклюзивный сеанс заразительного смеха",
            'title_2' => "Неповторимая улыбочка от малыша Джереми",
            'form_title' => "ОСТАВЬТЕ ЗАЯВКУ НА БЕСПЛАТНЫЙ СЕАНС УЛЫБКИ",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке",  
            'form' => array_merge(FormOrder::get()->tpl_default(),array('button' => array('color'=>'rose','label'=> 'Получить улыбочку')))
        ];
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid order order_5" style="background: <?=$val['background_color']?>;">
            <div class="title_wrap">
                <div class="container">
                    <div class="title_1">
                        <? $this->sub('Text','title_1',Text::$plain_heading) ?>
                    </div>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_heading) ?>
                        </div>
                    <? endif ?>
                </div>
            </div>
            <div class="container">
                <div class="ico_list">
                    <? $this->repeat('items',function($val,$self){ ?>
                        <div class="item">
                            <?=$self->sub('Icon','icon',array('iconType'=>'white'))?>
                            <div class="name"><?=$self->sub('Text','icon_title',Text::$plain_heading)?></div>
                            <div class="desc"><?=$self->sub('Text','icon_desc',Text::$plain_text)?></div>
                        </div> 
                    <? });?> 
                </div>
                <div class="form">
                    <div class="form_title">
                        <? $this->sub('Text','form_title',Text::$plain_text) ?>
                    </div>
                    <div class="form_data">
                        <? $this->sub('FormOrder','form') ?>
                    </div>
                    <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
                        <div class="form_bottom <?=$cls?>" >
                            <? $this->sub('Text','form_bottom_text',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                </div>    
            </div>              
        </div>
    <?}
    
    function tpl_default_5() { 
        return self::$en ? [
            'show_form_bottom_text' => true,
            'show_title_2' => true,
            'background_color' =>'#313138',
            'title_1' => "Just ridiculous and funny performance",
            'title_2' => "We work only with professionals of premium",
            'form_title' => "ORDER A FREE SEANCE",
            'items' => array(
                array(
                    'icon' =>'view/editor/assets/ico/537.png',
                    'icon_title' => "Injections of infectious laughter",
                    'icon_desc' => "Tested by assistant manager of the circus and allowed in a number of countries, even in Jamaica."
                ),
                array(
                    'icon' =>'view/editor/assets/ico/464.png',
                    'icon_title' => "Laugh to tears  and even more",
                    'icon_desc' => "Laughing the lifespan increases in several times and even more."
                ),
                array(
                    'icon' =>'view/editor/assets/ico/507.png',
                    'icon_title' => "Free candy for everybody",
                    'icon_desc' => "Each visitor will be personally handed a candy on a stick."
                )
                
            ),            
            'form_bottom_text' => "We don't provide Israeli intelligence with your personal information", 
            'form' => array_merge(FormOrder::get()->tpl_default(),array('button' => array('color'=>'purple','label'=> "Order a seance")))
        ] : [
            'show_form_bottom_text' => true,
            'show_title_2' => true,
            'background_color' =>'#313138',
            'title_1' => "Только смешные и весёлые представления",
            'title_2' => "Мы работаем только с профессионалами премиум класса",
            'form_title' => "ЗАКАЖИТЕ БЕСПЛАТНЫЙ СЕАНС",
            'items' => array(
                array(
                    'icon' =>'view/editor/assets/ico/537.png',
                    'icon_title' => "Инъекции заразительного смеха",
                    'icon_desc' => "Протестированы завхозом цирка и разрешены в ряде стран мира, даже на Ямайке."
                ),
                array(
                    'icon' =>'view/editor/assets/ico/464.png',
                    'icon_title' => "Рассмешим до слез и даже больше",
                    'icon_desc' => "Продолжительность жизни увеличивается от смеха в несколько раз и даже больше."
                ),
                array(
                    'icon' =>'view/editor/assets/ico/507.png',
                    'icon_title' => "Бесплатный леденец каждому",
                    'icon_desc' => "Каждому пришедшему персонально будет вручена сосательная конфета на палочке."
                )
                
            ),            
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке", 
            'form' => array_merge(FormOrder::get()->tpl_default(),array('button' => array('color'=>'purple','label'=> 'Заказать сеанс')))
        ];
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid order order_6" style="background: url('<?=$this->api->base_url."/".$val['background']?>')">
            <div class="dark">
                <div class="container">
                    <div class="content_wrap <?= $val['form_align'] ? "align_".$val['form_align'] : "align_right" ?>">
                        <div class="title_1">
                            <? $this->sub('Text','title_1',Text::$plain_text) ?>
                        </div>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_text) ?>
                            </div>
                        <? endif ?>
                        <? if ($cls = $this->vis($val['show_title_3'])): ?>
                            <div class="title_3 <?=$cls?>" >
                                <? $this->sub('Text','title_3',Text::$plain_text) ?>
                            </div>
                        <? endif ?>
                        <div class="form">
                            <div class="form_title">
                                <? $this->sub('Text','form_title',Text::$plain_text) ?>
                            </div>
                            <div class="form_data">
                                <? $this->sub('FormOrder','form') ?>
                            </div>
                            <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
                                <div class="form_bottom <?=$cls?>" >
                                    <? $this->sub('Text','form_bottom_text',Text::$plain_text) ?>
                                </div>
                            <? endif ?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_6() { 
        return self::$en ? [
            'show_title_2' => true,
            'show_title_3' => true,
            'show_form_bottom_text' => true,
            'form_align' => "right",
            'background' => "view/editor/assets/background/187.jpg",
            'title_1' => "USE THIS DESIGNER",
            'title_2' => "CREATE LANDING",
            'title_3' => "JUST A FEW MINUTES",
            'form_title' => "LEAVE AN APPLICATION FOR LANDING CREATION",
            'form_bottom_text' => "We don't provide Israeli intelligence with your personal information",  
            'form' => array_merge(FormOrder::get()->tpl_default_email(),array('button' => array('color'=>'blue','label'=> "Order a landing")))
        ] : [
            'show_title_2' => true,
            'show_title_3' => true,
            'show_form_bottom_text' => true,
            'form_align' => "right",
            'background' => "view/editor/assets/background/187.jpg",
            'title_1' => "ИСПОЛЬЗУЙТЕ ЭТОТ КОНСТРУКТОР",
            'title_2' => "СОЗДАЙТЕ ЛЕНДИНГ",
            'title_3' => "ВСЕГО ЗА НЕСКОЛЬКО МИНУТ",
            'form_title' => "ОСТАВЬТЕ ЗАЯВКУ НА СОЗДАНИЕ ЛЕНДИНГА",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке",  
            'form' => array_merge(FormOrder::get()->tpl_default_email(),array('button' => array('color'=>'blue','label'=> 'Заказать лендинг')))
        ];
    }    
}