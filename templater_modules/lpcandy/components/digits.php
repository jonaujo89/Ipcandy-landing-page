<?php

class Digits extends Block {
    public $name = 'Digits';
    public $description = "Сompany figures";
    
    function tpl($val) {?>
        <div class="container-fluid digits digits1" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">
                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_1')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_2')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_3')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="value">
                                    <?=$self->sub('Text','value_4')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_4')?>
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
        <div class="container-fluid digits digits2" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">

                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_1')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_2')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_3')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        <? }) ?>

                        <div style="clear: both"></div>

                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'bg_color' => '#F7F7F7',
            'items' => array(
                array(
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'value_2' => '75',
                    'name_2' => 'Международных наград',
                    'value_3' => '105',
                    'name_3' => 'Выполненных проектов',
                )
            )                       
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid digits digits3" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">

                        <? $this->repeat('items',function($val,$self){ ?>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_1')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_2')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                            <div class="item clear">
                                <div class="value">
                                    <?=$self->sub('Text','value_3')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        <? }) ?>

                        <div style="clear: both"></div>

                    </div>                
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
            'bg_color' => '#24242a',
            'items' => array(
                array(
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'value_2' => '75',
                    'name_2' => 'Международных наград',
                    'value_3' => '105',
                    'name_3' => 'Выполненных проектов',
                )
            )                       
        );
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid digits digits4" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">

                        <? $this->repeat('items',function($val,$self){ ?>

                            <div class="item">
                                <?=$self->sub('Icon','icon_1')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_1')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_2')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_2')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_3')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_3')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_4')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_4')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_4')?>
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
            'bg_color' => '#fff',
            'items' => array(
                array(
                    'icon_1' => 'templater_modules/lpcandy/assets/ico/112.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'templater_modules/lpcandy/assets/ico/99.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'templater_modules/lpcandy/assets/ico/80.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'templater_modules/lpcandy/assets/ico/167.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_5($val) {?>
        <div class="container-fluid digits digits5" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">

                        <? $this->repeat('items',function($val,$self){ ?>

                            <div class="item">
                                <?=$self->sub('Icon','icon_1')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_1')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_2')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_2')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_3')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_3')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_4')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_4')?>
                                </div>
                                <hr>
                                <div class="name">
                                    <?=$self->sub('Text','name_4')?>
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
            'bg_color' => '#24242a',
            'items' => array(
                array(
                    'icon_1' => 'templater_modules/lpcandy/assets/ico/969.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'templater_modules/lpcandy/assets/ico/949.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'templater_modules/lpcandy/assets/ico/957.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'templater_modules/lpcandy/assets/ico/1018.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_6($val) {?>
        <div class="container-fluid digits digits6" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">

                        <? $this->repeat('items',function($val,$self){ ?>

                            <div class="item">
                                <?=$self->sub('Icon','icon_1')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_1')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_2')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_2')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_3')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_3')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                            </div>
                            <div class="item">
                                <?=$self->sub('Icon','icon_4')?>
                                <div class="value">
                                    <?=$self->sub('Text','value_4')?>
                                </div>
                                <div class="name">
                                    <?=$self->sub('Text','name_4')?>
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
            'bg_color' => '#24242a',
            'items' => array(
                array(
                    'icon_1' => 'templater_modules/lpcandy/assets/ico/969.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'templater_modules/lpcandy/assets/ico/949.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'templater_modules/lpcandy/assets/ico/957.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'templater_modules/lpcandy/assets/ico/1018.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_7($val) {?>
        <div class="container-fluid digits digits7" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">

                        <? $this->repeat('items',function($val,$self){ ?>

                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_1')?>
                                </div>
                                <?=$self->sub('Icon','icon_1')?>
                                <div class="name">
                                    <?=$self->sub('Text','name_1')?>
                                </div>
                            </div>
                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_2')?>
                                </div>
                                <?=$self->sub('Icon','icon_2')?>
                                <div class="name">
                                    <?=$self->sub('Text','name_2')?>
                                </div>
                            </div>
                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_3')?>
                                </div>
                                <?=$self->sub('Icon','icon_3')?>
                                <div class="name">
                                    <?=$self->sub('Text','name_3')?>
                                </div>
                            </div>
                            <div class="item">                                
                                <div class="value">
                                    <?=$self->sub('Text','value_4')?>
                                </div>
                                <?=$self->sub('Icon','icon_4')?>
                                <div class="name">
                                    <?=$self->sub('Text','name_4')?>
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
            'bg_color' => '#24242a',
            'items' => array(
                array(
                    'icon_1' => 'templater_modules/lpcandy/assets/ico/969.png',
                    'value_1' => '13',
                    'name_1' => 'Лет на международном рынке',
                    'icon_2' => 'templater_modules/lpcandy/assets/ico/949.png',
                    'value_2' => '750',
                    'name_2' => 'Компаний на постоянном обслуживании',
                    'icon_3' => 'templater_modules/lpcandy/assets/ico/957.png',
                    'value_3' => '85',
                    'name_3' => 'Розничных магазинов по всей России',
                    'icon_4' => 'templater_modules/lpcandy/assets/ico/1018.png',
                    'value_4' => '500',
                    'name_4' => 'Положительных откликов',

                )
            )                       
        );
    }
    
    
    function tpl_8($val) {?>
        <div class="container-fluid digits digits8" style="background: repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <div class="margin"></div>
                    <div class="item_list clear">

                        <? $this->repeat('items',function($val,$self){ ?>

                            <div class="item">
                                <div class="value_wrap">
                                    <div class="value" style="color:#E6332A">
                                        <?=$self->sub('Text','value_1')?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_1')?>
                                    </div>
                                </div>
                            </div>


                            <div class="item item2">
                                <div class="value_wrap value_wrap2">
                                    <div class="value" style="color:#E6332A">
                                        <?=$self->sub('Text','value_2')?>
                                    </div>
                                    <div class="name name2">
                                        <?=$self->sub('Text','name_2')?>
                                    </div>
                                </div>
                            </div>

                             <div class="item">
                                <div class="value_wrap">
                                    <div class="value" style="color:#E6332A">
                                        <?=$self->sub('Text','value_3')?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_3')?>
                                    </div>
                                </div>
                            </div>

                             <div class="item item4">
                                <div class="value_wrap value_wrap2">
                                    <div class="value" style="color:#E6332A">
                                        <?=$self->sub('Text','value_4')?>
                                    </div>
                                    <div class="name name4">
                                        <?=$self->sub('Text','name_4')?>
                                    </div>
                                </div>
                            </div>

                             <div class="item">
                                <div class="value_wrap">
                                    <div class="value" style="color:#E6332A">
                                        <?=$self->sub('Text','value_5')?>
                                    </div>
                                    <div class="name">
                                        <?=$self->sub('Text','name_5')?>
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
    
    function tpl_default_8() { 
        return  array(
            'bg_color' => '#fff',
            'items' => array(
                array(
                    'icon_1' => 'templater_modules/lpcandy/assets/ico/969.png',
                    'value_1' => '13',
                    'name_1' => 'лет на рынке',
                    'icon_2' => 'templater_modules/lpcandy/assets/ico/949.png',
                    'value_2' => '44',
                    'name_2' => 'награды',
                    'icon_3' => 'templater_modules/lpcandy/assets/ico/957.png',
                    'value_3' => '85',
                    'name_3' => 'магазинов по РФ',
                    'icon_4' => 'templater_modules/lpcandy/assets/ico/1018.png',
                    'value_4' => '56',
                    'name_4' => 'пушистых кота',
                    'icon_5' => 'templater_modules/lpcandy/assets/ico/1018.png',
                    'value_5' => '500',
                    'name_5' => 'постоянных клиентов',

                )
            )                       
        );
    }
        
}


Digits::register();