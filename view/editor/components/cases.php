<?php

class Cases extends Block {
    public $name = 'Cases';
    public $description = "The results of our clients";
    public $editor = "lp.cases";
    
    function tpl($val) {?>
        <div class="container-fluid cases cases_1" style="background: <?=$val['background_color']?>;">
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
                        <? $this->repeat('items',function($item_val,$self) use ($val){ ?>
                            <div class="media_wrap">
                                <? $self->sub('Media','media_file') ?>
                            </div>
                            <div class="info">
                                <div class="top"></div>
                                <? if ($val['show_name'] || $self->edit): ?>
                                    <div class="name" <?= !$val['show_name'] ? "style='display:none'" : "style='display:block'" ?> >
                                        <? $self->sub('Text','name',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),'oneline'=>true)) ?>
                                    </div>
                                <? endif ?>
                                <? if ($val['show_desc'] || $self->edit): ?>
                                    <div class="desc" <?= !$val['show_desc'] ? "style='display:none'" : "" ?> >
                                        <? $self->sub('Text','desc',array('buttons'=>array("bold","italic","fontcolor","removeformat"),'oneline'=>true)) ?>
                                    </div>
                                <? endif ?>
                                <div class="text">
                                    <? $self->sub('Text','text',array('buttons'=>array("bold","italic","fontcolor","removeformat"))) ?>
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
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Результаты наших клиентов",
            'title_2' => "Подзаголовок",
            'items' => array(
                array(
                    'media_file' =>  array_merge(Media::tpl_default(),array('type'=>'image_background','image_url'=>'view/editor/assets/services/1.jpg')),
                    'name' => "TRADENORDSERVCICES",
                    'desc' => "ИНФОРМАЦИОННЫЕ ТЕХНОЛОГИИ",
                    'text' => "Задача: Доставить груз в течение 6 дней.<br><br> Результат: Перевезли из офиса в Москве во Владивосток больше двух тонн орг техники и комплектующих. По времени составило 6 дней. В этом блоке опишите свои достигнутые результаты, что сделано по факту. Предельно ясно и коротко. Приложите фотографию процесса или результата.",
                ),
                array(
                    'media_file' =>  array_merge(Media::tpl_default(),array('type'=>'image_background','image_url'=>'view/editor/assets/services/2.jpg')),
                    'name' => "TRADENORDSERVCICES",
                    'desc' => "ИНФОРМАЦИОННЫЕ ТЕХНОЛОГИИ",
                    'text' => "Задача: Доставить груз в течение 6 дней.<br><br> Результат: Перевезли из офиса в Москве во Владивосток больше двух тонн орг техники и комплектующих. По времени составило 6 дней. В этом блоке опишите свои достигнутые результаты, что сделано по факту. Предельно ясно и коротко. Приложите фотографию процесса или результата.",
                )
            )
        );
    }
    
}


Cases::register();