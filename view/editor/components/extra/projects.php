<?php

namespace LPCandy\Components;

class Projects extends Block {
    public $name = 'Проекты';
    public $description = 'Проекты из бд';
    public $editor = "lp.projects";
    public $access_resource = "project_editor";
    
    function tpl($val) {?>

        <div class="container-fluid services services_1" style="background: <?=$val['background_color']?>;">
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
                            $res = \LPExtra\Models\Project::findBy(['id'=>$ids]);
                        
                            $hash = array();
                            $projects = array();
                            foreach ($res as $project) $hash[$project->id] = $project;
                            foreach ($ids as $oneId) if (isset($hash[$oneId])) $projects[] = $hash[$oneId];
                        ?>
                        
                        <? for ($p=0;$p<count($projects);$p+=3): ?>
                            <div class="item_block">
                                <div class="item_datas">
                                <? for ($pp=0;$pp<3;$pp++): ?>
                                    <? $project = @$projects[$p+$pp]; ?>
                                    <? if ($project): ?>
                                        <div class="item_data">
                                            <div class="img_wrap" >
                                                <? if (@$project->data['thumb']): ?>
                                                    <div class='img' style='background-image: url("<?= $this->api->base_url.$project->data['thumb']?>")'></div>
                                                <? endif ?>
                                            </div>
                                            <div class="name">
                                                <?=$project->title?>
                                            </div>
                                            <div class="desc" >
                                                <?=$project->excerpt?>
                                            </div>
                                            <div class="btn_wrap">
                                                <a class="btn_form blue"><?=@$val['button_text']?></a>
                                            </div>
                                        </div>
                                    <? else: ?>
                                        <div class="item_data"></div>
                                    <? endif ?>
                                <? endfor ?>
                                </div>
                                <div class="item_actions">
                                <? for ($pp=0;$pp<3;$pp++): ?>
                                    <? $project = @$projects[$p+$pp]; ?>
                                    <? if ($project): ?>
                                        <div class="item_action">
                                            <div class="btn_wrap">
                                                <a class="btn_form <?=@$val['button_color']?>"><?=@$val['button_text']?></a>
                                                <div style='display:none'>
                                                    <div class="form wide project_popup">
                                                        <h1><?=$project->title?></h1>
                                                        <?=$project->excerpt?>
                                                        <?=$project->content?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? else: ?>
                                        <div class="item_action"></div>
                                    <? endif ?>
                                <? endfor ?>              
                                </div>
                            </div>
                        <? endfor ?>
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
            'title' => 'Самые крутые проекты',
            'title_2' => 'Круче нас - только яйца',
            'button_text' => 'Читать кейс',
            'button_color' => 'blue'
        );
    }
    
}