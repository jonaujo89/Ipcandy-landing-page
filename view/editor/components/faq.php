<?php

namespace LPCandy\Components;

class Faq extends Block {
    public $name;
    public $description;
    public $editor = "lp.faq";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'FAQ';
            $this->description = "Frequently Asked Questions";
        } else {
            $this->name = 'ЧаВо';
            $this->description = "Частые вопросы";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid faq" style="background-color:<?=$val['background_color']?>">
            <div class="container">
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

                <div class="row">
                    <div class="col-12">
                        <div class="faq-items <?=$val['two_column_layout'] ? 'two-column-layout' : '' ?>">
                            <? $this->repeat('faq_items',function($item_val,$self) use ($val) { ?>
                                <div class="faq-item">
                                    <? if ($cls = $this->vis($val['show_icon'])): ?>
                                        <div class="icon <?=$cls?>">
                                            <?= $this->sub('Icon','@icon') ?>
                                        </div>
                                    <? endif ?>
                                    <div class="faq-content">
                                        <div class="question">
                                            <? $self->sub('Text','question',Text::$plain_heading) ?>
                                        </div>
                                        <div class="answer">
                                            <? $self->sub('Text','answer',Text::$default_text) ?>
                                        </div>
                                    </div>
                                </div>
                            <? }, ['editor' => 'lp.faqRepeater']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'title' => "Ask anything you want",
            'title_2' => "Random answers to random questions",
            'faq_items' => [
                [
                    'question' => "I want to return the tickets. How to do it?",
                    'answer' => "Refunds are only possible if the event is canceled and/or postponed.",
                ],
                [
                    'question' => "Can I change tickets for another date?",
                    'answer' => "No, we do not have the technical ability to change tickets.",
                ],
                [
                    'question' => "From which age do children need to buy tickets to the circus?",
                    'answer' => "Children from 4 years old. A ticket for an accompanying person on a common basis.",
                ],
                [
                    'question' => "Can I book tickets online?",
                    'answer' => "Yes, you can book tickets on our website.",
                ],
            ]   

        ] : [
            'title' => "Спросите, что хотите",
            'title_2' => "Дадим случайный ответ на случайный вопрос",
            'faq_items' => [
                [
                    'question' => "Я хочу вернуть билеты. Как это сделать?",
                    'answer' => "Возврат денег возможен только при отмене и/или переносе мероприятия.",
                ],
                [
                    'question' => "Можно ли поменять билеты на другую дату?",
                    'answer' => "Нет, у нас нет технической возможности поменять билеты.",
                ],
                [
                    'question' => "С какого возраста детям нужно покупать билеты в цирк?",
                    'answer' => "Детям с 4 лет. Билет для сопровождающего на общих основаниях.",
                ],
                [
                    'question' => "Можно ли забронировать билеты онлайн?",
                    'answer' => "Да, вы можете забронировать билеты у нас на сайте.",
                ],
            ]   
        ] 
        + [
            'show_title' => true,
            'show_title_2' => true,
            'two_column_layout' => false,
            'icon' => Configuration::$assets_url.'/ico/208.png',
            'show_icon' => true,
            'background_color' => "#FFFFFF",
        ];
    }

}