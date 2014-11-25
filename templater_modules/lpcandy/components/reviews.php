<?php

class Reviews extends Block {
    public $name = 'Reviews';
    public $description = "Clients with photo";
    public $editor = "lp.reviews";
    
    function tpl($val) {?>
        <div class="container-fluid reviews reviews_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($val['show_title'] || $this->edit): ?>
                        <h1 class="title" <?= !$val['show_title'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </h1>
                    <? endif ?>
                    <? if ($val['show_title_2'] || $this->edit): ?>
                        <div class="title_2" <?= !$val['show_title_2'] ? "style='display:none'" : "" ?> >
                            <? $this->sub('Text','title_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false))) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self) use ($val) { ?>
                            <div class="item">
                                <div class="item_data">
                                    <div class="text">
                                        <?=$self->sub('Text','text_1',array('buttons'=>array("bold","italic","removeformat")))?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic","fontcolor"=>false,"removeformat")))?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_1',array('buttons'=>array("bold"=>false,"italic","fontcolor","removeformat")))?>                            
                                    </div>
                                    <? if ($val['show_image'] || $self->edit): ?>
                                        <div class="img_wrap" <?= !$val['show_image'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Image','image_1') ?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item_data">
                                    <div class="text">
                                        <?=$self->sub('Text','text_2',array('buttons'=>array("bold","italic","removeformat")))?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic","fontcolor"=>false,"removeformat")))?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_2',array('buttons'=>array("bold"=>false,"italic","fontcolor","removeformat")))?>                            
                                    </div>
                                    <? if ($val['show_image'] || $self->edit): ?>
                                        <div class="img_wrap" <?= !$val['show_image'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Image','image_2') ?>
                                        </div>
                                    <? endif ?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item_data">
                                    <div class="text">
                                        <?=$self->sub('Text','text_3',array('buttons'=>array("bold","italic","removeformat")))?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic","fontcolor"=>false,"removeformat")))?>
                                    </div>
                                    <div class="desc">
                                        <?=$self->sub('Text','desc_3',array('buttons'=>array("bold"=>false,"italic","fontcolor","removeformat")))?>                            
                                    </div>
                                    <? if ($val['show_image'] || $self->edit): ?>
                                        <div class="img_wrap" <?= !$val['show_image'] ? "style='display:none'" : "" ?> >
                                            <? $self->sub('Image','image_3') ?>
                                        </div>
                                    <? endif ?>
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
            'show_image' => true,
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,         
            'background_color' => '#F7F7F7',
            'title' => "Что о нас говорят клиенты ",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'image_1' => "templater_modules/lpcandy/assets/reviews/r_1.jpg",
                    'image_2' => "templater_modules/lpcandy/assets/reviews/r_2.jpg",
                    'image_3' => "templater_modules/lpcandy/assets/reviews/r_3.jpg",
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