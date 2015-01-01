<?php

class Digits extends Block {
    public $name = 'Цифры';
    public $description = "Цифры компании";
    public $editor = "lp.digits";
    
    function tpl($val) {?>
        <div class="container-fluid digits digits_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
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
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'value_1' => '15',
                    'name_1' => 'Лет на рынке ювелирных услуг',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов', 
                )
            )                       
        );
    }
    
    
    
    function tpl_2($val) {?>
        <div class="container-fluid digits digits_2" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                             </div>
                             <div style="clear: both"></div>
                        <? }) ?>
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => '#FFFFFF',
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'value_1' => '13',
                    'name_1' => 'Лет на международном<br> рынке',
                    'value_2' => '75',
                    'name_2' => 'Международных<br> наград',
                    'value_3' => '105',
                    'name_3' => 'Выполненных<br> проектов',
                )
            )                       
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid digits digits_3" style="
            <?
                preg_match("/#\w{3,6}/", $val['background'], $background);
                if($background){
                  print('background:'.$background[0]);
                } else {
                  print('background:repeat scroll 0% 0% transparent url('.INDEX_URL.$val['background'].')');
                }
            ?> 
         ;">  
            <div class="container">                
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
            'show_title' => false,
            'show_title_2' => false,
            'background' => '/view/editor/assets/texture_black/1.jpg',
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'value_1' => '13',
                    'name_1' => 'Лет на международном<br> рынке',
                    'value_2' => '75',
                    'name_2' => 'Международных<br> наград',
                    'value_3' => '250',
                    'name_3' => 'Выполненных<br> проектов',
                )
            )                       
        );
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid digits digits_4" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list <?= $val['icon_color'] ? $val['icon_color'] : "icon_grey" ?>">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <?=$self->sub('Icon','icon_1')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_2')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_3')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_4')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            
                            <div style="clear: both"></div>

                        <? }) ?>                     

                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return  array(
            'show_title' => false,
            'show_title_2' => false,
            'icon_color' => 'icon_grey',
            'background_color' => '#FFFFFF',
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/112.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'view/editor/assets/ico/99.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'view/editor/assets/ico/80.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'view/editor/assets/ico/167.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid digits digits_5" style="
            <?
                preg_match("/#\w{3,6}/", $val['background'], $background);
                if($background){
                  print('background:'.$background[0]);
                } else {
                  print('background:repeat scroll 0% 0% transparent url('.INDEX_URL.$val['background'].')');
                }
            ?> 
         ;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <?=$self->sub('Icon','icon_1',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_2',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_3',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_4',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>                            
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_5() { 
        return  array(
            'show_title' => false,
            'show_title_2' => false,
            'background' => '/view/editor/assets/texture_black/1.jpg',
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/969.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'view/editor/assets/ico/949.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'view/editor/assets/ico/957.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'view/editor/assets/ico/1018.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid digits digits_6" style="
            <?
                preg_match("/#\w{3,6}/", $val['background'], $background);
                if($background){
                  print('background:'.$background[0]);
                } else {
                  print('background:repeat scroll 0% 0% transparent url('.INDEX_URL.$val['background'].')');
                }
            ?> 
         ;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <?=$self->sub('Icon','icon_1',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_2',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_3',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_4',array('iconType'=>'white'))?>
                                <div class="value">
                                    <?=$self->sub('Text','value_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>                            
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_6() { 
        return  array(
            'show_title' => false,
            'show_title_2' => false,
            'background' => '/view/editor/assets/texture_black/1.jpg',
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/969.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'view/editor/assets/ico/949.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'view/editor/assets/ico/957.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'view/editor/assets/ico/1018.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_7($val) {?>
        <div class="container-fluid digits digits_7" style="
            <?
                preg_match("/#\w{3,6}/", $val['background'], $background);
                if($background){
                  print('background:'.$background[0]);
                } else {
                  print('background:repeat scroll 0% 0% transparent url('.INDEX_URL.$val['background'].')');
                }
            ?> 
         ;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list <?= $val['icon_color'] ? $val['icon_color'] : "icon_grey" ?>">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <?=$self->sub('Icon','icon_1',array('iconType'=>'white'))?>
                                <div class="name">
                                    <?=$self->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <?=$self->sub('Icon','icon_2',array('iconType'=>'white'))?>
                                <div class="name">
                                    <?=$self->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <?=$self->sub('Icon','icon_3',array('iconType'=>'white'))?>
                                <div class="name">
                                    <?=$self->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <?=$self->sub('Icon','icon_4',array('iconType'=>'white'))?>
                                <div class="name">
                                    <?=$self->sub('Text','name_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>                            
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_7() { 
        return  array(
            'show_title' => false,
            'show_title_2' => false,
            'icon_color' => 'icon_grey',
            'background' => '/view/editor/assets/texture_black/1.jpg',
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'items' => array(
                array(
                    'icon_1' => 'view/editor/assets/ico/969.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'view/editor/assets/ico/949.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'view/editor/assets/ico/957.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'view/editor/assets/ico/1018.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_8($val) {?>
        <div class="container-fluid digits digits_8" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
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
                    <div class="item_list">
                        <div class="item">
                            <div class="value_wrap">
                                <div class="value" style="color: <?=$val['digits_color']?>;">
                                    <?=$this->sub('Text','value_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$this->sub('Text','name_1',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="value_wrap">
                                <div class="value" style="color: <?=$val['digits_color']?>;">
                                    <?=$this->sub('Text','value_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name name2">
                                    <?=$this->sub('Text','name_2',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="value_wrap">
                                <div class="value" style="color: <?=$val['digits_color']?>;">
                                    <?=$this->sub('Text','value_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$this->sub('Text','name_3',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="value_wrap">
                                <div class="value" style="color: <?=$val['digits_color']?>;">
                                    <?=$this->sub('Text','value_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name name4">
                                    <?=$this->sub('Text','name_4',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="value_wrap">
                                <div class="value" style="color: <?=$val['digits_color']?>;">
                                    <?=$this->sub('Text','value_5',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false),"oneline"=>true))?>
                                </div>
                                <div class="name">
                                    <?=$this->sub('Text','name_5',array('buttons'=>array("bold"=>false,"italic"=>false,"fontcolor"=>false,"removeformat"=>false)))?>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_8() { 
        return  array(
            'show_title' => false,
            'show_title_2' => false,
            'background_color' => "#FFFFFF",
            'digits_color' => "#E6332A",
            'title' => 'Факты о нашей компании',
            'title_2' => 'Подзаголовок',
            'icon_1' => 'view/editor/assets/ico/969.png',
            'value_1' => '13',
            'name_1' => 'лет<br> на рынке',
            'icon_2' => 'view/editor/assets/ico/949.png',
            'value_2' => '44',
            'name_2' => 'награды',
            'icon_3' => 'view/editor/assets/ico/957.png',
            'value_3' => '85',
            'name_3' => 'магазинов<br> по РФ',
            'icon_4' => 'view/editor/assets/ico/1018.png',
            'value_4' => '56',
            'name_4' => 'пушистых кота',
            'icon_5' => 'view/editor/assets/ico/1018.png',
            'value_5' => '500',
            'name_5' => 'постоянных клиентов',                      
        );
    }     
}

Digits::register();