<?php

namespace LPCandy\Components;

class Projects extends Block {
    public $name = 'Проекты';
    public $description = "Проекты из бд";
    public $editor = "lp.projects";
    public $access_resource = "project_editor";
    
    function tpl($val) {?>
        <div class="container-fluid cases cases_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?> " >
                            <? $this->sub('Text','title',Text::$plain_text) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list clear">
                        <?
                            $ids = explode(",",$val['ids']);
                            foreach ($ids as &$id) {
                                $id = (int)$id;
                            }
                            $projects = \LPExtra\Models\Project::findBy(['id'=>$ids]);
                        ?>
                        
                        <? foreach ($projects as $project): ?>
                            <div class="item_block">
                                <div class="media_wrap">
                                    <div class="media">
                                    <? if (@$project->data['thumb']): ?>
                                        <div class='img' style='background-image: url("<?= INDEX_URL.$project->data['thumb']?>")'></div>
                                    <? endif ?>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="top"></div>
                                    <div class="name">
                                        <?=$project->title?>
                                    </div>
                                    <div class="text">
                                        <?=$project->excerpt?>
                                    </div>
                                    <div class="btn_wrap">
                                        <a class="btn_form blue">Читать полный кейс</a>
                                        <div style='display:none'>
                                            <div class="form wide project_popup">
                                                <h1><?=$project->title?></h1>
                                                <?=$project->excerpt?>
                                                <?=$project->content?>
                                            </div>
                                        </div>
                                        
                                    <div>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'ids' => '',
            'show_title' => true,
            'show_title_2' => false,
            'show_name' => true,
            'show_desc' => true,
            'background_color' =>'#F7F7F7',
            'title' => "Результат работы",
            'title_2' => "Подзаголовок"
        );
    }
    
}