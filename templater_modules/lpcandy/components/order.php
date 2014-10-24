<?php

class FormOrder extends Block {
    public $editor = "";
    public $internal = true;
    
    function tpl($val) {?>
         <form action="" method="post" >
            <div class="form_fields">
                <div class="form_field">
                    <label>
                        <div class="field_title">Имя:<i>*</i>
                        </div>
                        <input type="text" class="form_field_text" name="">
                        <div class="error"></div>
                    </label>
                </div>
                <div class="form_field">
                    <label>
                        <div class="field_title">Телефон:<i>*</i>
                        </div>
                        <input type="text" class="form_field_text" name="">
                    </label>
                </div>
            </div>
            <div class="form_submit">
                <a class="form_field_submit <?=$val['colorBtn']?>">
                    <div>
                        <span><?=$val['valueBtn']?></span>
                    </div>
                </a>
            </div>
        </form>
    <?}
}

class Order extends Block {
    public $name = 'Order';
    public $description = "Block with a picture and a form";
    
    function tpl($val) {?>
        <div class="container-fluid order order_1" style="background-image: url('<?=INDEX_URL."/".$val['bg_img']?>');">
            <div class="dark">
                <div class="container">
                    <div class="span10">
                        <div class="title_1">
                            <span><? $this->sub('Text','title_1') ?></span>                                
                        </div>
                        <div class="title_2">
                            <span><? $this->sub('Text','title_2') ?></span>
                        </div>
                    </div>
                    <div class="span6">  
                        <div class="form">
                            <div class="form_title">
                                <? $this->sub('Text','form_title_1') ?>    
                            </div>
                            <div class="form_title_2">
                                <? $this->sub('Text','form_title_2') ?>
                            </div>
                            <div class="form_data">
                                <? $this->sub('FormOrder','form') ?>
                            </div>
                            <div class="form_bottom" >
                                <? $this->sub('Text','form_bottom_text') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'bg_img' =>'templater_modules/lpcandy/assets/order/bg_car.jpg',
            'title_1' => "ЭКОНОМИЧНЫЕ<br>ГРУЗОПЕРЕВОЗКИ<br>ПО ВСЕЙ РОССИИ</li>",
            'title_2' => "С нами вы экономите до 50%<br> Гарантированная сохранность груза<br> Своевременная доставка</li>",
            'form_title_1' => "Оставьте заявку на бесплатный образец или расчет стоимости",
            'form_title_2' => "И получите выгодное предложение<br> в течение дня",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
            'form' => array('valueBtn'=>'Получить консультацию', 'colorBtn'=>'blue' ),
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid order order_2" style="background-image: url('<?=INDEX_URL."/".$val['bg_img']?>');">
            <div class="dark_noise">
                <div class="container">
                    <div class="title_1">
                        <? $this->sub('Text','title_1') ?>
                    </div>
                    <div class="title_2">
                        <? $this->sub('Text','title_1') ?>
                    </div>
                    <div class="btn_note">
                        <? $this->sub('Text','btn_note') ?>
                    </div>
                    <br>
                    <div class="btn_wrap" >                        
                        <span><? $this->sub('Button','btn') ?></span>                        
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_2() { 
        return  array(
            'bg_img' =>'templater_modules/lpcandy/assets/order/bg_laptop.jpg',
            'title_1' => "Образование за рубежом",
            'title_2' => "150 языковых школ и 250 высших учебных заведений мира",
            'btn_note' => "Присоединяйтесь к нашим студентам",
            'btn' =>  array('text'=>'<span>Заявка на обучение</span>', 'colorBtn'=>'green'),            
        );
    }
    
    function tpl_3($val) {?>
        <div class="container-fluid order order_3" style="background-image: url('<?=INDEX_URL."/".$val['bg_img']?>');">
            <div class="container">
                <div class="img_wrap">
                    <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img']?>');"></div>
                </div>
                <div class="data_wrap">
                    <div class="title_1">
                        <? $this->sub('Text','title_1') ?>
                    </div>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>
                    <div class="desc">
                        <? $this->sub('Text','desc') ?>
                    </div>
                    <div class="btn_wrap" >                        
                        <? $this->sub('Button','button') ?>                        
                    </div>
                </div>            
            </div>
        </div>

    <?}
    
     function tpl_default_3() { 
        return  array(
            'bg_img' =>'templater_modules/lpcandy/assets/order/bg.jpg',
            'img' =>'/templater_modules/lpcandy/assets/order/moto.jpg',
            'title_1' => "КУПИТЕ КОНЯ ВАШЕЙ МЕЧТЫ ЗА 2 ЧАСА",
            'title_2' => "СЭКОНОМЬТЕ ВРЕМЯ ПРИ ПОКУПКЕ МОТО",
            'desc' => "Бесплатно подберем варианты и проконсультируем перед покупкой. Подбор займет не больше 20 минут.",
            'button' =>  array('text'=>'<span>Получить консультацию</span>', 'colorBtn'=>'red'),            
        );
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid order order_4" style="background:<?=$val['bg']?> repeat;">
            <div class="container">
                <div class="title_1">
                    <? $this->sub('Text','title_1') ?>
                </div>
                <div class="title_2">
                    <? $this->sub('Text','title_2') ?>
                </div>
                <div class="img_wrap">
                    <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img']?>');"></div>
                </div>
                <div class="form">
                    <div class="form_title">
                        <? $this->sub('Text','form_title') ?>
                    </div>
                    <div class="form_data">
                        <? $this->sub('FormOrder','form') ?>
                    </div>
                    <div class="form_bottom">
                        <? $this->sub('Text','form_bottom_text') ?>
                    </div>
                </div>           
            </div>
        </div>

    <?}
    
     function tpl_default_4() { 
        return  array(
            'bg' =>'#313138',
            'img' =>'templater_modules/lpcandy/assets/order/furniture.jpg',
            'title_1' => "Эксклюзивная садовая мебель от мировых производителей",
            'title_2' => "Мы работаем только с продукцией премиум класса из экологически чистых и высокачественных материалов.",
            'form_title' => "Оставьте заявку на бесплатный каталог или расчет стоимости",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",  
            'form' => array('valueBtn'=>'Получить каталог бесплатно', 'colorBtn'=>'yellow' ),
        );
    }
    
     function tpl_5($val) {?>
        <div class="container-fluid order_5">
            <div class="title_wrap">
                <div class="container">
                    <div class="title_1">
                        <? $this->sub('Text','title_1') ?>
                    </div>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="ico_list">
                    <div class="item">
                        <div class="ico"  style="background-image: url('<?=INDEX_URL."/".$val['ico1']?>');"></div>
                        <div class="name"><? $this->sub('Text','icoName1') ?></div>
                        <div class="desc"><? $this->sub('Text','icoDesc1') ?> </div>
                    </div>
                    <div class="item">
                        <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['ico2']?>');"></div>
                        <div class="name"><? $this->sub('Text','icoName2') ?></div>
                        <div class="desc"><? $this->sub('Text','icoDesc2') ?></div>
                    </div>
                    <div class="item">
                        <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['ico3']?>');"></div>
                        <div class="name"><? $this->sub('Text','icoName3') ?></div>
                        <div class="desc"><? $this->sub('Text','icoDesc3') ?></div>
                    </div>
                </div>
                 <div class="form">
                <div class="form_title">
                    <? $this->sub('Text','form_title') ?>
                </div>
                <div class="form_data">
                    <? $this->sub('FormOrder','form') ?>
                </div>
                <div class="form_bottom">
                    <? $this->sub('Text','form_bottom_text') ?>
                </div>
            </div>    
            </div>              
	</div>

    <?}
    
     function tpl_default_5() { 
        return  array(
            'title_1' => "Эксклюзивная садовая мебель от мировых производителей",
            'title_2' => "Мы работаем только с продукцией премиум класса из экологически чистых и высокачественных материалов.",
            'form_title' => "Оставьте заявку на бесплатный каталог или расчет стоимости",
            'ico1' =>'templater_modules/lpcandy/assets/ico/388.png',
            'ico2' =>'templater_modules/lpcandy/assets/ico/523.png',
            'ico3' =>'templater_modules/lpcandy/assets/ico/434.png',
            'icoName1' => "10 лет на рынке",
            'icoName2' => "Огромный выбор",
            'icoName3' => "Более 2 000 моделей в наличии",
            'icoDesc1' => "Компания зарекомендовала себя как надежный поставщик высококачественной садовой мебели.",
            'icoDesc2' => "Широкий выбор кресел, диванов, столов. ",
            'icoDesc3' => "Наличие товаров на складе позволяет получить мебель в кратчайшие сроки. ",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",  
            'form' => array('valueBtn'=>'Получить каталог бесплатно', 'colorBtn'=>'yellow' ),
        );
    }
    
    function tpl_6($val) {?>
        <div class="container-fluid order order_6" style="background-image: url('<?=INDEX_URL."/".$val['bg_img']?>');">
            <div class="dark">
                <div class="container">
                    <div class="content_wrap align_right">
                        <div class="title_1"><? $this->sub('Text','title_1') ?></div>
                        <div class="title_2"><? $this->sub('Text','title_2') ?></div>
                        <div class="title_3"><? $this->sub('Text','title_3') ?></div>
                        <div class="form">
                            <div class="form_title">
                                <? $this->sub('Text','form_title') ?>
                            </div>
                            <div class="form_data">
                                <? $this->sub('FormOrder','form') ?>
                            </div>
                            <div class="form_bottom">
                                <? $this->sub('Text','form_bottom_text') ?>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>

    <?}
    
     function tpl_default_6() { 
        return  array(
            'bg_img' =>'templater_modules/lpcandy/assets/order/bg_1.jpg',
            'title_1' => "Используйте наш конструктор",
            'title_2' => "Для своего лендинга",
            'title_3' => "Создайте эффективный лендинг за несколько минут",
            'form_title' => "Оставьте заявку на создание лендинга ",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",  
            'form' => array('valueBtn'=>'Отправить заявку на разработку', 'colorBtn'=>'blue' ),
        );
    }
    
}

FormOrder::register();
Order::register();