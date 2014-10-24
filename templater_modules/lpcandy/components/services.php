<?php

class Services extends Block {
    public $name = 'Services';
    public $description = "Services with image";
    
    function tpl($val) {?>
        <div class="container-fluid services services_1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="item_data">
                                <div class="img">
                                    <img src="<?=INDEX_URL."/".$val['img1']?>">
                                </div>
                                <div class="name">
                                    <? $this->sub('Text','name_1') ?>
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_1') ?>
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_1') ?>
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="img">
                                    <img src="<?=INDEX_URL."/".$val['img2']?>">
                                </div>
                                <div class="name">
                                    <? $this->sub('Text','name_2') ?>
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_2') ?>
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_2') ?>
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="img">
                                    <img src="<?=INDEX_URL."/".$val['img3']?>">
                                </div>
                                <div class="name">
                                    <? $this->sub('Text','name_3') ?>
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_3') ?>
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_3') ?>
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                 </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img1' => "templater_modules/lpcandy/assets/services/1.jpg",
            'img2' => "templater_modules/lpcandy/assets/services/2.jpg",
            'img3' => "templater_modules/lpcandy/assets/services/3.jpg",
            'name_1' => "Перевозки по России  ",
            'name_2' => "Международные перевозки  ",
            'name_3' => "Таможенное оформление ",
            'desc_1' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя. ",
            'desc_2' => "еревозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. ",
            'desc_3' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя. ",
            'price_1' => "1 000 руб. ",
            'price_2' => "3 000 руб. ",
            'price_3' => "5 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
    

    function tpl_2($val) {?>
        <div class="container-fluid services services_2">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img1']?>');"></div>
                            <div class="item_data">                            
                                <div class="name">
                                   <? $this->sub('Text','name_1') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_1') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_1') ?> 
                                </div>
                                <div class="btn_wrap">
                                        <div class="btn form_btn">
                                            <? $this->sub('Button','btn') ?>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img2']?>');"></div>
                            <div class="item_data">                            
                                <div class="name">
                                   <? $this->sub('Text','name_2') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_2') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_2') ?> 
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_2() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img1' => "templater_modules/lpcandy/assets/services/1.jpg",
            'img2' => "templater_modules/lpcandy/assets/services/2.jpg",
            'name_1' => "Перевозки по России",
            'name_2' => "Международные перевозки",
            'desc_1' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя.  ",
            'desc_2' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. ",
            'price_1' => "2 000 руб. ",
            'price_2' => "<span style='color: #BBBBBB'><strike>7 000 руб.</strike></span> 3 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid services services_3">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="img_data">
                                <div style="background-image: url('<?=INDEX_URL."/".$val['img']?>');" class="img" ></div>
                            </div>
                            <div class="item_data">                            
                                <div class="name">
                                    <? $this->sub('Text','name') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc') ?> 
                                </div>
                                <div class="price">
                                   <? $this->sub('Text','price') ?>
                                </div>
                                <div class="btn_note">
                                    <i><? $this->sub('Text','btn_note') ?></i>
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_3() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img' => "templater_modules/lpcandy/assets/services/1.jpg",
            'name' => "Перевозки по России",
            'desc' => "Перевозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя.  ",
            'price' => "<span style='color: #BBBBBB'><strike>7 000 руб.</strike></span> 3 000 руб. ",
            'btn_note' => "Предложение ограниченно",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
        
    
    function tpl_4($val) {?>
        <div class="container-fluid services services_4">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="item_data">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['img_1']?>');" > </div>
                                <div class="name">
                                    <? $this->sub('Text','name_1') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_1') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_1') ?> 
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['img_2']?>');" > </div>
                                <div class="name">
                                    <? $this->sub('Text','name_2') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_2') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_2') ?> 
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$val['img_3']?>');" ></div>
                                <div class="name">
                                    <? $this->sub('Text','name_3') ?> 
                                </div>
                                <div class="desc">
                                    <? $this->sub('Text','desc_3') ?> 
                                </div>
                                <div class="price">
                                    <? $this->sub('Text','price_3') ?> 
                                </div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_4() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img_1' => "templater_modules/lpcandy/assets/ico/741.png",
            'img_2' => "templater_modules/lpcandy/assets/ico/333.png",
            'img_3' => "templater_modules/lpcandy/assets/ico/319.png",
            'name_1' => "РЫБАЛКА КРУГЛЫЙ ГОД ",
            'name_2' => "ОХОТА НА ЛЮБОГО ЗВЕРЯ ",
            'name_3' => "ОТДЫХ В ПАЛАТКАХ ",
            'desc_1' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
            'desc_2' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
            'desc_3' => "Краткое описание услуги. Краткое описание услуги. Краткое описание услуги. ",
            'price_1' => "1 000 руб. ",
            'price_2' => "3 000 руб. ",
            'price_3' => "5 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
    
    
     function tpl_5($val) {?>
        <div class="container-fluid services services_5">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="item_data">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_1']?>');"></div>
                                <div class="name"><? $this->sub('Text','name_1') ?></div>
                                <div class="desc"><? $this->sub('Text','desc_1') ?></div>
                                <div class="price"><? $this->sub('Text','price_1') ?></div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_2']?>');"></div>
                                <div class="name"><? $this->sub('Text','name_2') ?></div>
                                <div class="desc"><? $this->sub('Text','desc_2') ?></div>
                                <div class="price"><? $this->sub('Text','price_2') ?></div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_3']?>');"></div>
                                <div class="name"><? $this->sub('Text','name_3') ?></div>
                                <div class="desc"><? $this->sub('Text','desc_3') ?></div>
                                <div class="price"><? $this->sub('Text','price_3') ?></div>
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                 </div>
            </div>
        </div>
    <?}
    
     function tpl_default_5() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img_1' => "templater_modules/lpcandy/assets/services/1.jpg",
            'img_2' => "templater_modules/lpcandy/assets/services/2.jpg",
            'img_3' => "templater_modules/lpcandy/assets/services/3.jpg",
            'name_1' => "Перевозки по России  ",
            'name_2' => "Международные перевозки  ",
            'name_3' => "Таможенное оформление ",
            'desc_1' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя. ",
            'desc_2' => "еревозки грузов на дальние расстояния без каких-либо ограничений. Любой груз доставим вовремя. ",
            'desc_3' => "Все оформление берем на себя, от вас ничего не потребуется. Любой груз доставим вовремя. ",
            'price_1' => "1 000 руб. ",
            'price_2' => "3 000 руб. ",
            'price_3' => "5 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid services services_6">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title_1') ?> 
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?> 
                    </div>    
                    <div class="item_list clear">
                        <div class="item">
                            <div class="item_data">
                                <div class="name"><? $this->sub('Text','name_1') ?></div>
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_1']?>');"></div>                           
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                                <div class="price"><? $this->sub('Text','price_1') ?></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="name"><? $this->sub('Text','name_2') ?></div>
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_2']?>');"></div>                           
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                                <div class="price"><? $this->sub('Text','price_2') ?></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_data">
                                <div class="name"><? $this->sub('Text','name_3') ?></div>
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_3']?>');"></div>                           
                                <div class="btn_wrap">
                                    <div class="btn form_btn">
                                        <? $this->sub('Button','btn') ?>
                                    </div>
                                </div>
                                <div class="price"><? $this->sub('Text','price_3') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_6() { 
        return  array(
            'title_1' => "Что мы предлагаем",
            'title_2' => "У нас огромный выбор самых различных услуг",
            'img_1' => "templater_modules/lpcandy/assets/services/1.jpg",
            'img_2' => "templater_modules/lpcandy/assets/services/2.jpg",
            'img_3' => "templater_modules/lpcandy/assets/services/3.jpg",
            'name_1' => "Перевозки по России  ",
            'name_2' => "Международные перевозки  ",
            'name_3' => "Таможенное оформление ",
            'price_1' => "1 000 руб. ",
            'price_2' => "3 000 руб. ",
            'price_3' => "5 000 руб. ",
            'btn' =>  array('text'=>'<span>Заказать</span>', 'colorBtn'=>'blue'),
        );
    }
}


Services::register();