<?php

class Order extends Block {
    public $name = 'Заявка';
    public $description = "Блок с картинкой и формой";
    public $editor = "lp.order";
    
    function tpl($val) {?>
        <div class="container-fluid order order_1" style="background: url('<?=INDEX_URL."/".$val['background']?>')">
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
        return  array(
            'show_form_title_2' => true,
            'show_form_bottom_text' => true,
            'background' =>'view/editor/assets/background/91.jpg',
            'title_1' => "<div>ДОСТАВКА</div><div>УЛЫБОЧЕК</div><div>ВАМ ДОМОЙ</div>",
            'title_2' => "<div>Только качественные улыбочки</div><div>Гарантированная сохранность груза</div><div>Своевременная доставка</div>",
            'form_title_2' => "Улыбочку доставят к Вам домой",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке",
            'form' => FormOrder::tpl_default(),
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid order order_2" style="background: url('<?=INDEX_URL."/".$val['background']?>')">
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
        return  array( 
            'show_background_noise' => true,
            'show_text_above_button' => true,
            'show_arrow' => true,
            'background' =>'view/editor/assets/background/192.jpg',
            'title_1' => "Бесплатное обучение жонглированию",
            'title_2' => "Секретная методика жонглирования от клоуна Жоры",
            'button_note' => "Закажите Жору и его друга Клеву прямо сейчас!",
            'button_order' =>  array_merge(FormButton::tpl_default(),array('text'=>'Обучить меня жонглировать', 'color'=>'orange'))            
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid order order_3" style="background: url('<?=INDEX_URL."/".$val['background']?>');">
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
        return  array( 
            'show_border' => true,
            'show_title_2' => true,
            'show_list_box' => false,
            'background' =>'view/editor/assets/texture/1.png',
            'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=> 'view/editor/assets/order/order_3.jpg')),
            'title_1' => "ТОЛЬКО <span style='color:#C1103A'>НАСТОЯЩИЕ</span> СЛОНЫ ИЗ АФРИКИ",
            'title_2' => "НИКАКИХ ПОДДЕЛОК ИЗ КИТАЯ",
            'desc' => "Бесплатно покажем Вам фиолетового сомалийского слона.<br>Время показа - 10 минут.",
            'list' => "<p>Только у нас слон сбрасывает свою шкуру</p><p>Только у нас слон лает</p><p>Только у нас слон выполняет команду СИДЕТЬ</p>",
            'button_order' =>  array_merge(FormButton::tpl_default(),array('text'=>'Посмотреть слона', 'color'=>'purple_light')),             
        );
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
        return  array(
            'show_form_bottom_text' => true,
            'show_box_shadow' => true,
            'show_title_2' => true,
            'background_color' =>'#313138',
            'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/order/order_4.jpg')),
            'title_1' => "Эксклюзивный сеанс заразительного смеха",
            'title_2' => "Неповторимая улыбочка от малыша Джереми",
            'form_title' => "ОСТАВЬТЕ ЗАЯВКУ НА БЕСПЛАТНЫЙ СЕАНС УЛЫБКИ",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке",  
            'form' => array_merge(FormOrder::tpl_default(),array('button' => array('color'=>'rose','label'=>'Получить улыбочку')))
        );
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
        return  array(
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
            'form' => array_merge(FormOrder::tpl_default(),array('button' => array('color'=>'purple','label'=>'Заказать сеанс')))
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid order order_6" style="background: url('<?=INDEX_URL."/".$val['background']?>')">
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
        return  array(
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
            'form' => array_merge(FormOrder::tpl_default_email(),array('button' => array('color'=>'blue','label'=>'Заказать лендинг')))
        );
    }    
}

Order::register();