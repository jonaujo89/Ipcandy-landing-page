<?php

class Cases extends Block {
    public $name = 'Cases';
    public $description = "The results of our clients";
    
    function tpl($val) {?>
        <div class="container-fluid cases cases_1" style="background: none repeat scroll 0% 0% <? $this->sub['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title"><? $this->sub('Text','title') ?></h1>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear">
                                <?=$self->sub('ImageBg','img_2')?>
                                <div class="info">
                                    <div class="top"></div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_1')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_1')?>
                                    </div>
                                    <div class="text">
                                            <div>
                                                <?=$self->sub('Text','text_2_1')?>
                                            </div>
                                            <div>
                                                <br>
                                            </div>
                                            <div>
                                                <?=$self->sub('Text','text_2_2')?>
                                                <br>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <? }) ?>
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear">
                                <div class="info">
                                    <div class="top"></div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_2')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_2')?>
                                    </div>
                                    <div class="text">
                                            <div>
                                            <?=$self->sub('Text','text_2_1')?>
                                        </div>
                                        <div>
                                            <br>
                                        </div>
                                        <div>
                                            <?=$self->sub('Text','text_2_2')?>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <?=$self->sub('ImageBg','img_1')?>
                            </div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
     function tpl_default() { 
        return  array(
            'bg_color' =>'#F7F7F7',
            'title' => "Преимущества нашей компании",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/services/1.jpg",
                    'name_1' => "TRADENORDSERVCICES",
                    'desc_1' => "ИНФОРМАЦИОННЫЕ ТЕХНОЛОГИИ",
                    'text_1_1' => "Задача: Доставить груз в течение 6 дней.",
                    'text_1_2' => "Результат: Перевезли из офиса в Москве во Владивосток больше двух тонн орг техники и комплектующих. По времени составило 6 дней. В этом блоке опишите свои достигнутые результаты, что сделано по факту. Предельно ясно и коротко. Приложите фотографию процесса или результата.",
                    'img_2' => "templater_modules/lpcandy/assets/services/2.jpg",
                    'name_2' => "TRADENORDSERVCICES",
                    'desc_2' => "ИНФОРМАЦИОННЫЕ ТЕХНОЛОГИИ",
                    'text_2_1' => "Задача: Доставить груз в течение 6 дней.",
                    'text_2_2' => "Результат: Перевезли из офиса в Москве во Владивосток больше двух тонн орг техники и комплектующих. По времени составило 6 дней. В этом блоке опишите свои достигнутые результаты, что сделано по факту. Предельно ясно и коротко. Приложите фотографию процесса или результата.",
                ),
            )
        );
    }
    
}


Cases::register();