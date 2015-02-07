<?php

namespace LPCandy\Components;

class Timer extends Block {
    public $name = 'Таймер';
    public $description = "Счетчик для акций";
    public $editor = "lp.timer";    
  
    function tpl($val) {?>
        <div class="container-fluid timer timer_1" style="background:<?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="countdown_desc">
                        <? $this->sub('Text','countdown_desc',Text::$plain_text) ?>
                    </div>
					<div class="countdown_wrap" style="color:<?=$val['countdown_color']?>;">
						<? $this->sub('Countdown', 'countdown') ?>
					</div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return  array(
            'show_title_2' => true,			
            'background_color' => '#FFFFFF',
            'countdown_color' => '#E76953',
            'title' => 'Сейчас на сцене телепат Василий',
            'title_2' => 'Успейте зайти в зал до окончания выступления',
            'countdown_desc' => 'Осталось до окончания выступления:',  
            'countdown' => Countdown::tpl_default(),
        );
    }
    
    function tpl_2($val) {?>
        <div class="container-fluid timer timer_2" style="<?=$this->bg_style($val['background'])?>">
            <div class="container">
                <div class="span16">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?= $val['title_2_and_countdown_color'] ? "timer_".$val['title_2_and_countdown_color'] : "" ?> <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="countdown_desc">
                        <? $this->sub('Text','countdown_desc',Text::$plain_text) ?>
                    </div>
                    <div class="countdown_wrap <?= $val['title_2_and_countdown_color'] ? "timer_".$val['title_2_and_countdown_color'] : "" ?>">
						<? $this->sub('Countdown','countdown') ?>
					</div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return  array(
            'show_title_2' => true,
            'title_2_and_countdown_color' => 'red',
            'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'Выступление иллюзиониста<br>Гоши Либерман-Алмазова',
            'title_2' => 'Успейте попасть на представление',
            'countdown_desc' => 'До начала осталось:',
            'countdown' => Countdown::tpl_default(),
        );
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid timer timer_3" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span8">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc',Text::$plain_text) ?>
                    </div>
                    <div class="countdown_wrap">
						<? $this->sub('Countdown','countdown') ?>
					</div>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                </div>
                <div class="span8">
                    <div class="form">
                        <div class="form_title">
                            <? $this->sub('Text','form_title_1',Text::$default_text) ?>    
                        </div>
                        <div class="form_data">
                            <? $this->sub('FormOrder','form') ?>
                        </div>
                        <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
							<div class="form_bottom <?=$cls?>" >
								<? $this->sub('Text','form_bottom_text',Text::$default_text) ?>
							</div>
						<? endif ?>                
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return  array(
			'show_title_2' => true,
			'show_form_bottom_text' => true,
            'background_color' => '#FFFFFF',
            'title' => 'АКЦИЯ!<br>ДВА БИЛЕТА ПО ЦЕНЕ ТРЕХ - ТРЕТИЙ В ПОДАРОК',
            'title_2' => 'КОЛИЧЕСТВО БИЛЕТОВ ОГРАНИЧЕНО',
            'timer_desc' => 'ДО ОКОНЧАНИЯ АКЦИИ ОСТАЛОСЬ:',
            'form_title_1' => "Заказать билеты",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке",
            'form' => array_merge(FormOrder::tpl_default(),array('button' => array('color'=>'blue','label'=>'Отправить заявку'))),
			'countdown' => Countdown::tpl_default(),
        );
    }
    
    
    function tpl_4($val) {?>
        <div class="container-fluid timer timer_4" style="<?=$this->bg_style($val['background'])?>">
            <div class="container">
                <div class="span8">
                    <h1 class="title">
                        <? $this->sub('Text','title',Text::$plain_text) ?>
                    </h1>
                    <div class="timer_desc">
                        <? $this->sub('Text','timer_desc',Text::$plain_text) ?>
                    </div>
                    <div class="countdown_wrap">
						<? $this->sub('Countdown','countdown') ?>
					</div>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?> " >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                </div>
                <div class="span8">
                    <div class="form">
                        <div class="form_title">
                            <? $this->sub('Text','form_title_1',Text::$default_text) ?>    
                        </div>
                        <div class="form_data">
                            <? $this->sub('FormOrder','form') ?>
                        </div>
                        <? if ($cls = $this->vis($val['show_form_bottom_text'])): ?>
							<div class="form_bottom <?=$cls?>" >
								<? $this->sub('Text','form_bottom_text',Text::$default_text) ?>
							</div>
						<? endif ?>                
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return  array(
            'show_title_2' => true,
			'show_form_bottom_text' => true,
			'background' => array('url'=>'view/editor/assets/texture_black/1.jpg'),
            'title' => 'АКЦИЯ!<br>ДВА БИЛЕТА ПО ЦЕНЕ ТРЕХ - ТРЕТИЙ В ПОДАРОК',
            'title_2' => 'КОЛИЧЕСТВО БИЛЕТОВ ОГРАНИЧЕНО',
            'timer_desc' => 'ДО ОКОНЧАНИЯ АКЦИИ ОСТАЛОСЬ:',
            'form_title_1' => "Заказать билеты",
            'form_bottom_text' => "Мы не передаем Вашу персональную информацию израильской разведке",
            'form' => array_merge(FormOrder::tpl_default(),array('button' => array('color'=>'blue','label'=>'Отправить заявку'))),
			'countdown' => Countdown::tpl_default(),
        );
    }        
}