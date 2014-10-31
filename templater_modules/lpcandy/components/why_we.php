<?php

class Why_we extends Block {
    public $name = 'Why_we';
    public $description = "Otherness";
    
    function tpl($val) {?>
        <div class="container-fluid why_we why_we_1">
            <div class="container">
                <div class="span16">
                    <h1 class="title"><? $this->sub('Text','title_1') ?></h1>
                    <div class="title_2"><? $this->sub('Text','title_2') ?></div>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                        <div class="item">
                            <div class="ico_wrap">
                                <div class="ico">
                                    <i style="background-image: url('<?=INDEX_URL."/".$sub['icon_1']?>');"></i>
                                </div>
                            </div>                    
                            <div class="name">
                                <?=$sub['name_1']?> 
                            </div>
                            <div class="desc">
                                <?=$sub['desc_1']?> 
                            </div>
                        </div>
                        <div class="item">
                            <div class="ico_wrap">
                                <div class="ico">
                                    <i style="background-image: url('<?=INDEX_URL."/".$sub['icon_2']?>');"></i>
                                </div>
                            </div>
                            <div class="name">
                                <?=$sub['name_2']?> 
                            </div>
                            <div class="desc">
                                <?=$sub['desc_2']?> 
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <div class="item">
                            <div class="ico_wrap">
                                <div class="ico">
                                    <i style="background-image: url('<?=INDEX_URL."/".$sub['icon_3']?>');"></i>
                                </div>
                            </div>                    
                            <div class="name">
                                <?=$sub['name_3']?>
                            </div>
                            <div class="desc">
                                <?=$sub['desc_3']?> 
                            </div>
                        </div>
                        <div class="item">
                            <div class="ico_wrap">
                                <div class="ico">
                                    <i style="background-image: url('<?=INDEX_URL."/".$sub['icon_4']?>');"></i>
                                </div>
                            </div>
                            <div class="name">
                                <?=$sub['name_4']?> 
                            </div>
                            <div class="desc">
                                <?=$sub['desc_4']?> 
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <div class="item">
                            <div class="ico_wrap">
                                <div class="ico">
                                    <i style="background-image: url('<?=INDEX_URL."/".$sub['icon_5']?>');"></i>
                                </div>
                            </div>                    
                            <div class="name">
                               <?=$sub['name_5']?>
                            </div>
                            <div class="desc">
                                <?=$sub['desc_5']?> 
                            </div>
                        </div>
                        <div class="item">
                            <div class="ico_wrap">
                                <div class="ico">
                                    <i style="background-image: url('<?=INDEX_URL."/".$sub['icon_6']?>');"></i>
                                </div>
                            </div>
                            <div class="name">
                                <?=$sub['name_6']?>
                            </div>
                            <div class="desc">
                                <?=$sub['desc_6']?> 
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'title_1' => "Почему с нами работают свыше 1 000 клиентов каждый месяц",
            'title_2' => "6 причин выбрать именно нас ",
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/57.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/33.png",
                    'icon_3' => "templater_modules/lpcandy/assets/ico/62.png",
                    'icon_4' => "templater_modules/lpcandy/assets/ico/42.png",
                    'icon_5' => "templater_modules/lpcandy/assets/ico/45.png",
                    'icon_6' => "templater_modules/lpcandy/assets/ico/43.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'name_4' => "Работа по договору",
                    'name_5' => "Оплата после выполненных работ",
                    'name_6' => "Собственное производство",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_4' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_5' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_6' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }
   
}


Why_we::register();