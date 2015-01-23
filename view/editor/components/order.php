<?php

class Order extends Block {
    public $name = 'Заявка';
    public $description = "Блок с картинкой и формой";
    public $editor = "lp.order";
    
        function tpl($val) {?>
        <div class="container-fluid order order_1" style="background: url('<?=INDEX_URL."/".$val['background']?>') no-repeat center top;background-size:cover;">
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
                            <? if ($val['show_form_title_2'] || $this->edit): ?>
                                <div class="form_title_2 <?=$cls?>" >
                                    <? $this->sub('Text','form_title_2',Text::$default_text) ?>
                                </div>
                            <? endif ?>
                            <div class="form_data">
                                <? $this->sub('FormOrder','form') ?>
                            </div>
                            <? if ($val['show_form_bottom_text'] || $this->edit): ?>
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
            'background' =>'view/editor/assets/background/219.jpg',
            'title_1' => "<p>ЭКОНОМИЧНЫЕ</p><p>ГРУЗОПЕРЕВОЗКИ</p><p>ПО ВСЕЙ РОССИИ</p>",
            'title_2' => "<p>С нами вы экономите до 50%</p><p>Гарантированная сохранность груза</p><p>Своевременная доставка</p>",
            'form_title_1' => "Оставьте заявку на бесплатный образец или расчет стоимости",
            'form_title_2' => "И получите выгодное предложение<br> в течение дня",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
            'form' => FormOrder::tpl_default(),
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid order order_2" style="background: url('<?=INDEX_URL."/".$val['background']?>') no-repeat center top;background-size:cover;">
            <div class="background_toggle_noise <?= $val['add_background_noise'] ? "with_noise" : "dark"?>">
                <div class="container">
                    <div class="title_1">
                        <? $this->sub('Text','title_1',Text::$plain_text) ?>
                    </div>
                    <div class="title_2">
                        <? $this->sub('Text','title_2',Text::$plain_text) ?>
                    </div>
                    <? if ($val['show_text_above_button'] || $this->edit): ?>
                        <div class="btn_note <?=$cls?>" >
                            <? $this->sub('Text','button_note',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <br>
                    <div class="btn_wrap <?= !$val['add_arrow'] ? "no_arrow" : ""?> <?= !$val['show_text_above_button'] ? "no_btn_note" : ""?> " >                        
                        <? $this->sub("FormButton",'button_order') ?>                        
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array( 
            'add_background_noise' => true,
            'show_text_above_button' => true,
            'add_arrow' => true,
            'background' =>'view/editor/assets/background/196.jpg',
            'title_1' => "Образование за рубежом",
            'title_2' => "150 языковых школ и 250 высших учебных заведений мира",
            'button_note' => "Присоединяйтесь к нашим студентам",
            'button_order' =>  array_merge(FormButton::tpl_default(),array('text'=>'Заявка на обучение', 'color'=>'green'))            
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid order order_3" style="background: url('<?=INDEX_URL."/".$val['background']?>');">
            <div class="container">                
                <div class="img_wrap <?= $val['show_media_border'] ? "" : "hide_border" ?>">
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
                    <? if ($val['show_list_box'] || $this->edit): ?>
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
            'background' =>'view/editor/assets/texture/1.png',
            'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=> 'view/editor/assets/order/order_3.jpg')),
            'title_1' => "КУПИТЕ КОНЯ ВАШЕЙ МЕЧТЫ ЗА <span style='color:#C1103A'>2 ЧАСА</span>",
            'title_2' => "СЭКОНОМЬТЕ ВРЕМЯ ПРИ ПОКУПКЕ МОТО",
            'desc' => "Бесплатно подберем варианты и проконсультируем перед покупкой. Подбор займет не больше 20 минут.",
            'list' => "<p>С нами вы экономите до 50%</p><p>Гарантированная сохранность груза</p><p>Своевременная доставка</p>",
            'button_order' =>  array_merge(FormButton::tpl_default(),array('text'=>'Получить консультацию', 'color'=>'red')), 
            'show_media_border' => true,
            'show_title_2' => true,
            'show_list_box' => false,
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
                <div class="img_wrap <?= $val['show_box_shadow_media'] ? "" : "hide_box_shadow" ?>">
                    <? $this->sub('Media','media') ?>
                </div>
                <div class="form">
                    <div class="form_title">                        
                        <? $this->sub('Text','form_title',Text::$plain_text) ?>
                    </div>
                    <div class="form_data">
                        <? $this->sub('FormOrder','form') ?>
                    </div>
                    <? if ($val['show_form_bottom_text'] || $this->edit): ?>
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
            'show_box_shadow_media' => true,
            'show_title_2' => true,
            'background_color' =>'#313138',
            'media' =>  array_merge(Media::tpl_default(),array('type'=>'image','image_url'=>'view/editor/assets/order/order_4.jpg')),
            'title_1' => "Эксклюзивная садовая мебель от мировых производителей",
            'title_2' => "Мы работаем только с продукцией премиум класса из экологически чистых и высокачественных материалов.",
            'form_title' => "Оставьте заявку на бесплатный каталог или расчет стоимости",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",  
            'form' => array_merge(FormOrder::tpl_default(),array('button' => array('color'=>'yellow','label'=>'Получить каталог бесплатно')))
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
                    <? if ($val['show_form_bottom_text'] || $this->edit): ?>
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
            'title_1' => "Эксклюзивная садовая мебель от мировых производителей",
            'title_2' => "Мы работаем только с продукцией премиум класса из экологически чистых и высокачественных материалов.",
            'form_title' => "Оставьте заявку на бесплатный каталог или расчет стоимости",
            'items' => array(
                array(
                    'icon' =>'view/editor/assets/ico/388.png',
                    'icon_title' => "10 лет на рынке",
                    'icon_desc' => "Компания зарекомендовала себя как надежный поставщик высококачественной садовой мебели."
                ),
                array(
                    'icon' =>'view/editor/assets/ico/523.png',
                    'icon_title' => "Огромный выбор",
                    'icon_desc' => "Широкий выбор кресел, диванов, столов. "
                ),
                array(
                    'icon' =>'view/editor/assets/ico/434.png',
                    'icon_title' => "Более 2 000 моделей в наличии",
                    'icon_desc' => "Наличие товаров на складе позволяет получить мебель в кратчайшие сроки. "
                )
                
            ),            
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам", 
            'form' => array_merge(FormOrder::tpl_default(),array('button' => array('color'=>'yellow','label'=>'Получить каталог бесплатно')))
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid order order_6" style="background: url('<?=INDEX_URL."/".$val['background']?>') no-repeat center top;background-size:cover;">
            <div class="dark">
                <div class="container">
                    <div class="content_wrap <?= $val['move_form'] ? $val['move_form'] : "align_right" ?>">
                        <div class="title_1">
                            <? $this->sub('Text','title_1',Text::$plain_text) ?>
                        </div>
                        <? if ($cls = $this->vis($val['show_title_2'])): ?>
                            <div class="title_2 <?=$cls?> " >
                                <? $this->sub('Text','title_2',Text::$plain_text) ?>
                            </div>
                        <? endif ?>
                        <? if ($val['show_title_3'] || $this->edit): ?>
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
                            <? if ($val['show_form_bottom_text'] || $this->edit): ?>
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
            'move_form' => "align_right",
            'background' => "view/editor/assets/background/220.jpg",
            'title_1' => "Используйте наш конструктор",
            'title_2' => "Для своего лендинга",
            'title_3' => "Создайте эффективный лендинг за несколько минут",
            'form_title' => "Оставьте заявку на создание лендинга ",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",  
            'form' => array_merge(FormOrder::tpl_default_with_email(),array('button' => array('color'=>'blue','label'=>'Заказать лендинг')))
        );
    }
    
}

Order::register();