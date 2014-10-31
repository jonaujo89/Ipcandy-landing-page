<?php

class Cases extends Block {
    public $name = 'Cases';
    public $description = "The results of our clients";
    
    function tpl($val) {?>
        <div class="container-fluid cases cases_1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title"><? $this->sub('Text','title') ?></h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                            <div class="item clear">
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_1']?>');"></div>
                                <div class="info">
                                    <div class="top"></div>
                                    <div class="name">
                                        <? $this->sub('Text','name_1') ?>
                                    </div>
                                    <div class="desc">
                                        <? $this->sub('Text','desc_1') ?>
                                    </div>
                                    <div class="text">
                                        <div><? $this->sub('Text','text_1_1') ?></div>
                                        <div><? $this->sub('Text','text_1_2') ?></div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach ?>
                            <div class="item clear">
                                <div class="info">
                                    <div class="top"></div>
                                    <div class="name">
                                        <? $this->sub('Text','name_2') ?>
                                    </div>
                                    <div class="desc">
                                        <? $this->sub('Text','desc_2') ?>
                                    </div>                        
                                    <div class="text">
                                        <div class="editor_text spacedText">
                                            <div><? $this->sub('Text','text_2_2') ?></div>
                                            <div><? $this->sub('Text','text_2_2') ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="img" style="background-image: url('<?=INDEX_URL."/".$val['img_2']?>');"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Что мы предлагаем",
            
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
    
}


Cases::register();