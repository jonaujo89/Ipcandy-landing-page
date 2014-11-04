<?php

class Timer extends Block {
    public $name = 'Timer';
    public $description = "Counter+clock";
    
    function tpl($val) {?>
        <div class="container-fluid timerBlock timerBlock1" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc') ?>
                    </div>
                    <? $this->sub('Clock','clock') ?>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'clock' => Logo::tpl_default(),
            'bg_color' => '#F7F7F7',
            'title' => 'Семинар пройдет 1 декабря 2014г. в 12:00',
            'title_2' => 'Количество мест ограничено, успейте оплатить участие',
            'timer_desc' => 'До начала мероприятия осталось:',            
        );
    }
    
    
    function tpl_2($val) {?>
        <div class="container-fluid timerBlock timerBlock2" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc') ?>
                    </div>
                    <div class="timer">
                        <div class="d">
                            <div id="countDay" class="digitFont"></div><span>дней</span>
                        </div>
                        <div class="h">
                            <div id="countHour" class="digitFont"></div><span>часов</span>
                        </div>    
                        <div class="m">
                            <div id="countMinute" class="digitFont"></div><span>минут</span>
                        </div>    
                        <div class="s">
                            <div id="countSecond" class="digitFont"></div><span>секунд</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'bg_color' => '#272727',
            'title' => 'Семинар пройдет 1 декабря 2014г. в 12:00',
            'title_2' => 'Количество мест ограничено, успейте оплатить участие',
            'timer_desc' => 'До начала мероприятия осталось:',
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid -fluid timerBlock timerBlock3" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span8">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc') ?>
                    </div>
                    <div class="timer">
                        <div class="d">
                            <div id="countDay" class="digitFont"></div><span>дней</span>
                        </div>
                        <div class="h">
                            <div id="countHour" class="digitFont"></div><span>часов</span>
                        </div>    
                        <div class="m">
                            <div id="countMinute" class="digitFont"></div><span>минут</span>
                        </div>    
                        <div class="s">
                            <div id="countSecond" class="digitFont"></div><span>секунд</span>
                        </div>
                    </div>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>
                </div>
                <div class="span8">
                    <div class="form">
                        <div class="form_title">
                            <? $this->sub('Text','form_title_1') ?>    
                        </div>
                        <div class="form_data">
                            <? $this->sub('FormOrder','form') ?>
                        </div>
                        <div class="form_bottom" >
                            <? $this->sub('Text','form_bottom_text') ?>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
            'bg_color' => '#fff',
            'title' => '<div>Семинар пройдет</div><div>1 декабря 2014 в 12:00</div>',
            'title_2' => '<div>Количество мест ограничено,</div><div>успейте оплатить участие</div>',
            'timer_desc' => 'До начала мероприятия осталось:',
            'form_title_1' => "Заявка на участие",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
            'form' => array('valueBtn'=>'Отправить заявку', 'colorBtn'=>'blue' ),
        );
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid -fluid timerBlock timerBlock4" style="background: none repeat scroll 0% 0% <?=$val['bg_color']?>;">
            <div class="container">
                <div class="span8">
                    <h1 class="title">
                        <? $this->sub('Text','title') ?>
                    </h1>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc') ?>
                    </div>
                    <div class="timer">
                        <div class="d">
                            <div id="countDay" class="digitFont"></div><span>дней</span>
                        </div>
                        <div class="h">
                            <div id="countHour" class="digitFont"></div><span>часов</span>
                        </div>    
                        <div class="m">
                            <div id="countMinute" class="digitFont"></div><span>минут</span>
                        </div>    
                        <div class="s">
                            <div id="countSecond" class="digitFont"></div><span>секунд</span>
                        </div>
                    </div>
                    <div class="title_2">
                        <? $this->sub('Text','title_2') ?>
                    </div>
                </div>
                <div class="span8">
                    <div class="form">
                        <div class="form_title">
                            <? $this->sub('Text','form_title_1') ?>    
                        </div>
                        <div class="form_data">
                            <? $this->sub('FormOrder','form') ?>
                        </div>
                        <div class="form_bottom" >
                            <? $this->sub('Text','form_bottom_text') ?>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return  array(
            'bg_color' => '#272727',
            'title' => '<div>Семинар пройдет</div><div>1 декабря 2014 в 12:00</div>',
            'title_2' => '<div>Количество мест ограничено,</div><div>успейте оплатить участие</div>',
            'timer_desc' => 'До начала мероприятия осталось:',
            'form_title_1' => "Заявка на участие",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию третьим лицам",
            'form' => array('valueBtn'=>'Отправить заявку', 'colorBtn'=>'blue' ),
        );
    }
        
}


Timer::register();