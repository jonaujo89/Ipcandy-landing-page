<?php

class Reviews extends Block {
    public $name = 'Reviews';
    public $description = "Clients with photo";
    
    function tpl($val) {?>
        <div class="container-fluid reviews reviews1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">Что о нас говорят клиенты</h1>


                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <div class="item_data">
                                    <div class="text">
                                        <?=$self->sub('Text','text_1')?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_1')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_1')?>                            
                                    </div>
                                    <div class="img_wrap">
                                        <?=$self->sub('ImageBg','img_1')?>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item_data">
                                    <div class="text">
                                        <?=$self->sub('Text','text_2')?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_2')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_2')?>                            
                                    </div>
                                    <div class="img_wrap">
                                        <?=$self->sub('ImageBg','img_2')?>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item_data">
                                    <div class="text">
                                        <?=$self->sub('Text','text_3')?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_3')?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_3')?>                            
                                    </div>
                                    <div class="img_wrap">
                                        <?=$self->sub('ImageBg','img_3')?>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'title' => "Преимущества нашей компании",
            'items' => array(
                array(
                    'img_1' => "templater_modules/lpcandy/assets/reviews/r_1.jpg",
                    'img_2' => "templater_modules/lpcandy/assets/reviews/r_2.jpg",
                    'img_3' => "templater_modules/lpcandy/assets/reviews/r_3.jpg",
                    'name_1' => "Петров Петр",
                    'name_2' => "Петрова Ирина",
                    'name_3' => "Петрова Анна",
                    'desc_1' => "CEO, мобильные приложения",
                    'desc_2' => "Дизайнер, мобильные приложения",
                    'desc_3' => "Аналитик, мобильные приложения",
                    'text_1' => "Я в восторге от службы поддержки клиентов. Это не компания, а просто клад. Пишите только реальные отзывы. Пишите только реальные отзывы.",
                    'text_2' => "Я в восторге от службы поддержки клиентов. Это не компания, а просто клад. Пишите только реальные отзывы. Пишите только реальные отзывы.",
                    'text_3' => "Я в восторге от службы поддержки клиентов. Это не компания, а просто клад. Пишите только реальные отзывы. Пишите только реальные отзывы.",
                )
            )
        );
    }
    
}


Reviews::register();