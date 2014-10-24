<?php

class Benefits extends Block {
    public $name = 'Benefits';
    public $description = "Benefits with icon";
    
    function tpl($val) {?>
        <div class="container-fluid advantage advantage_1">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="item_list">
                        <? foreach ($val['items'] as $sub): ?>
                            <div class="item">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_1']?>');" ></div>
                                <div class="name"><?=$sub['name_1']?></div>
                                <div class="desc"><?=$sub['desc_1']?></div>
                            </div>
                            <div class="item">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_2']?>');" ></div>
                                <div class="name"><?=$sub['name_2']?></div>
                                <div class="desc"><?=$sub['desc_2']?></div>
                            </div>
                            <div class="item">
                                <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_3']?>');" ></div>
                                <div class="name"><?=$sub['name_3']?></div>
                                <div class="desc"><?=$sub['desc_3']?></div>
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
            'title' => "Преимущества нашей компании",
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/89.png",
                    'icon_3' => "templater_modules/lpcandy/assets/ico/127.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/89.png",
                    'icon_3' => "templater_modules/lpcandy/assets/ico/127.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }
    
    function tpl_2($val) {?>
        <div class="container-fluid advantage advantage_2">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="item_list">
                        <? foreach ($val['items'] as $sub): ?>
                        <div class="item">
                            <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_1']?>');"   >
                            </div>
                            <div class="name"><?=$sub['name_1']?></div>
                            <div class="desc"><?=$sub['desc_1']?></div>
                        </div>
                        <div class="item">
                            <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_2']?>');"  >
                            </div>
                            <div class="name"><?=$sub['name_2']?></div>
                            <div class="desc"><?=$sub['desc_2']?></div>
                        </div>
                        <div class="item">
                            <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_3']?>');"  >
                            </div>
                            <div class="name"><?=$sub['name_3']?></div>
                            <div class="desc"><?=$sub['desc_3']?></div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_2() { 
        return  array(
            'title' => "Преимущества нашей компании",
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/89.png",
                    'icon_3' => "templater_modules/lpcandy/assets/ico/127.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/89.png",
                    'icon_3' => "templater_modules/lpcandy/assets/ico/127.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid advantage advantage_3">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="item_list">
                        <? foreach ($val['items_top'] as $sub): ?>
                        <div class="item">
                            <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_1']?>');">
                            </div>
                            <div class="name"><?=$sub['name_1']?></div>
                            <div class="desc"><?=$sub['desc_1']?></div>
                        </div>
                        <div class="item item_right">
                            <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_2']?>');" >
                            </div>
                            <div class="name"><?=$sub['name_2']?></div>
                            <div class="desc"><?=$sub['desc_2']?></div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                        <? foreach ($val['items_bottom'] as $sub): ?>
                        <div class="item">
                            <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_3']?>');" >
                            </div>
                            <div class="name"><?=$sub['name_3']?></div>
                            <div class="desc"><?=$sub['desc_3']?></div>
                        </div>
                        <div class="item item_right">
                            <div class="ico" style="background-image: url('<?=INDEX_URL."/".$sub['icon_4']?>');" >
                            </div>
                            <div class="name"><?=$sub['name_4']?></div>
                            <div class="desc"><?=$sub['desc_4']?></div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_3() { 
        return  array(
            'title' => "Преимущества нашей компании",           
            'items_top' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/ico/77.png",
                    'icon_2' => "templater_modules/lpcandy/assets/ico/89.png",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
            ),
            'items_bottom' => array(
                array(
                    'icon_3' => "templater_modules/lpcandy/assets/ico/127.png",
                    'icon_4' => "templater_modules/lpcandy/assets/ico/165.png",                    
                    'name_3' => "Круглосуточная поддержка",
                    'name_4' => "Индивидуальное обучение ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_4' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
            )
        );
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid advantage advantage_4">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items_top'] as $sub): ?>
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['icon_1']?>');">
                            </div>
                            <div class="name"><?=$sub['name_1']?></div>
                            <div class="desc"><?=$sub['desc_1']?></div>
                        </div>
                        <div class="item item_right">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['icon_2']?>');">
                            </div>
                            <div class="name"><?=$sub['name_2']?></div>
                            <div class="desc"><?=$sub['desc_2']?></div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                        <? foreach ($val['items_bottom'] as $sub): ?>
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['icon_3']?>');">
                            </div>
                            <div class="name"><?=$sub['name_3']?></div>
                            <div class="desc"><?=$sub['desc_3']?></div>
                        </div>
                        <div class="item item_right">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['icon_4']?>');">
                            </div>
                           <div class="name"><?=$sub['name_4']?></div>
                            <div class="desc"><?=$sub['desc_4']?></div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_4() { 
        return  array(
           'title' => "Преимущества нашей компании",
           'items_top' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/benefits/1.jpg",
                    'icon_2' => "templater_modules/lpcandy/assets/benefits/2.jpg",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
            ),
            'items_bottom' => array(
                array(
                    'icon_3' => "templater_modules/lpcandy/assets/benefits/3.jpg",
                    'icon_4' => "templater_modules/lpcandy/assets/benefits/4.jpg",                    
                    'name_3' => "Круглосуточная поддержка",
                    'name_4' => "Индивидуальное обучение ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_4' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
            )
        );
    }
    
     function tpl_5($val) {?>
        <div class="container-fluid advantage advantage_5">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="item_list clear">
                        <? foreach ($val['items'] as $sub): ?>
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['icon_1']?>');" >
                            </div>
                            <div class="name"><?=$sub['name_1']?></div>
                            <div class="desc"><?=$sub['desc_1']?></div>
                        </div>
                        <div class="item item_right">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['icon_2']?>');">
                            </div>
                            <div class="name"><?=$sub['name_1']?></div>
                            <div class="desc"><?=$sub['desc_1']?></div>                    
                        </div>
                        <div class="item">
                            <div class="img" style="background-image: url('<?=INDEX_URL."/".$sub['icon_3']?>');">
                            </div>
                            <div class="name"><?=$sub['name_1']?></div>
                            <div class="desc"><?=$sub['desc_1']?></div>
                        </div>
                        <div style="clear: both"></div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default_5() { 
        return  array(
            'title' => "Преимущества нашей компании",
            'items' => array(
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/benefits/1.jpg",
                    'icon_2' => "templater_modules/lpcandy/assets/benefits/2.jpg",
                    'icon_3' => "templater_modules/lpcandy/assets/benefits/3.jpg",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                ),
                array(
                    'icon_1' => "templater_modules/lpcandy/assets/benefits/1.jpg",
                    'icon_2' => "templater_modules/lpcandy/assets/benefits/2.jpg",
                    'icon_3' => "templater_modules/lpcandy/assets/benefits/3.jpg",
                    'name_1' => "Бесплатная доставка",
                    'name_2' => "Индивидуальное обучение",
                    'name_3' => "Круглосуточная поддержка",
                    'desc_1' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_2' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                    'desc_3' => "Коротко и ясно о преимуществах вашей компании. Например, бесплатная доставка по Москве и области. ",
                )
            )
        );
    }
        
}


Benefits::register();