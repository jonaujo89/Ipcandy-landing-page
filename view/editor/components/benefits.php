<?php

namespace LPCandy\Components;

class Benefits extends Block {
    public $name;
    public $description;
    public $editor = "lp.benefits";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Benefits';
            $this->description = "Main advantages";
        } else {
            $this->name = 'Преимущества';
            $this->description = "Ваши главные преимущества";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid benefits benefits_1" style="background: <?=$val['background_color']?>;">
            <div class="container">
                <div class="span16">
                    <? if ($cls = $this->vis($val['show_title'])): ?>
                        <h1 class="title <?=$cls?>">
                            <? $this->sub('Text','title',Text::$plain_text) ?>
                        </h1>
                    <? endif ?>
                    <? if ($cls = $this->vis($val['show_title_2'])): ?>
                        <div class="title_2 <?=$cls?>" >
                            <? $this->sub('Text','title_2',Text::$plain_text) ?>
                        </div>
                    <? endif ?>
                    <div class="item_list <?= $val['show_icon_border'] ? "" : "hide_ico_border" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>                            
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?= $cls ?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_desc_benefit'])): ?>
                                        <div class="desc <?= $cls ?>" >
                                            <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                </div>
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_icon_border' => true,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Our circus is the coolest in the world!",
            'title_2' => "Subtitle",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/740.png",
                    'icon_2' => "view/editor/assets/ico/274.png",
                    'icon_3' => "view/editor/assets/ico/218.png",
                    'name_1' => "You can go on foot",
                    'name_2' => "It increases the degree of mood",
                    'name_3' => "It inspires by selective positive ",
                    'desc_1' => "It's too simple. Come and fill the place.",
                    'desc_2' => "Only in our lunchroom you have intimate conversations over a beer.",
                    'desc_3' => "You get an excellent mood for the longest time.",
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_icon_border' => true,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Наш цирк самый крутой в мире!",
            'title_2' => "Подзаголовок о крутизне цирка",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/740.png",
                    'icon_2' => "view/editor/assets/ico/274.png",
                    'icon_3' => "view/editor/assets/ico/218.png",
                    'name_1' => "В него можно придти пешком",
                    'name_2' => "Повышает градус настроения",
                    'name_3' => "Заряжает отборным позитивом",
                    'desc_1' => "Все просто до безобразия. Приходите и занимаете места по купленным билетам.",
                    'desc_2' => "Только в нашем буфете проходят задушевные беседы за кружечкой пенистого.",
                    'desc_3' => "Вы получите заряд превосходного настроения на самое длительное время.",
                )
            )
        ];
    }
    
    function tpl_2($val) {?>
        <div class="container-fluid benefits benefits_2" style="background: <?=$val['background_color']?>;">
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
                    <div class="item_list">
                         <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Icon','icon_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?=$cls?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_desc_benefit'])): ?>
                                        <div class="desc <?=$cls?>" >
                                            <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                </div>   
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_2() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'background_color' =>'#FFFFFF',
            'title' => "The advantages of our circus",
            'title_2' => "Subtitle",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/729.png",
                    'icon_2' => "view/editor/assets/ico/308.png",
                    'icon_3' => "view/editor/assets/ico/341.png",
                    'name_1' => "Free Internet",
                    'name_2' => "Delicious ice cream",
                    'name_3' => "Starry cast",
                    'desc_1' => "Wireless Internet access. You can always change the status in the social network.",
                    'desc_2' => "White cornet. Very sticky and sweet.",
                    'desc_3' => "We have such celebrities as Valentine and Valera.",
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашего цирка",
            'title_2' => "Подзаголовок о преимуществе",
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/729.png",
                    'icon_2' => "view/editor/assets/ico/308.png",
                    'icon_3' => "view/editor/assets/ico/341.png",
                    'name_1' => "Бесплатный интернет",
                    'name_2' => "Вкусное мороженное",
                    'name_3' => "Звездный состав",
                    'desc_1' => "Беспроводной доступ в интернет. Вы всегда сможете поменять статус в соцсети.",
                    'desc_2' => "Белое мороженное в вафельном стаканчике. Очень липкое и сладкое.",
                    'desc_3' => "Только у нас выступают такие знаменитости как Валентин и Валера.",
                )
            )
        ];
    }
    
    
    function tpl_3($val) {?>
        <div class="container-fluid benefits benefits_3" style="background: <?=$val['background_color']?>;">
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
                    <div class="item_list <?= !$val['show_name_benefit'] ? "hide_name" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=2;$i++): ?>
                                <div class="item">                                
                                    <?=$self->sub('Icon','icon_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?=$cls?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_heading) ?>
                                        </div>
                                    <? endif ?>
                                    <div class="desc">
                                        <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                    </div>
                                </div>  
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?>                       
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_3() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_icon_arounds' => true,
            'show_name_benefit' => true,
            'background_color' =>'#F7F7F7',
            'title' => "The advantages of our circus",
            'title_2' => "Subtitle",     
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/3.png",
                    'name_1' => "Color TV",
                    'desc_1' => "We have a color TV RUBIN-2M in the lobby.",
                    'icon_2' => "view/editor/assets/ico/790.png",                    
                    'name_2' => "Cozy circus tent",
                    'desc_2' => "Our tent will protect you from snow and wind during a spectacular view.",
                ),
                array(
                    'icon_1' => "view/editor/assets/ico/231.png",
                    'name_1' => "Discount system",
                    'desc_1' => "Buy a ticket to the circus for six months and you can live here free of charge for another three months.",
                    'icon_2' => "view/editor/assets/ico/150.png",                    
                    'name_2' => "Barbecue at the entrance gate",
                    'desc_2' => "Uncle Izzy cooks barbecue for visitors and aunt Sarah accompanies him.",
                ),
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_icon_arounds' => true,
            'show_name_benefit' => true,
            'background_color' =>'#F7F7F7',
            'title' => "Преимущества нашего цирка",
            'title_2' => "Подзаголовок о преимуществах",           
            'items' => array(
                array(
                    'icon_1' => "view/editor/assets/ico/3.png",
                    'name_1' => "Цветной телевизор",
                    'desc_1' => "Только в нашем цирке есть практически цветной телевизор РУБИН-2М в холле.",
                    'icon_2' => "view/editor/assets/ico/790.png",                    
                    'name_2' => "Уютный цирковой шатёр",
                    'desc_2' => "Наш шатер защитит Вас от снега и ветра во время захватывающего представления.",
                ),
                array(
                    'icon_1' => "view/editor/assets/ico/231.png",
                    'name_1' => "Система скидок",
                    'desc_1' => "Купи абонемент в цирк на полгода и можешь оставаться жить ещё три месяца бесплатно.",
                    'icon_2' => "view/editor/assets/ico/150.png",                    
                    'name_2' => "Шашлычная у входа",
                    'desc_2' => "Дядя Изя готовит шашлык для посетителей цирка. Аккомпанирует ему тетя Сара.",
                ),
            )
        ];
    }
    
    function tpl_4($val) {?>
        <div class="container-fluid benefits benefits_4" style="background: <?=$val['background_color']?>;">
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
                    <div class="item_list clear <?= !$val['show_image_border'] ? "hide_border" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=2;$i++): ?>
                                <div class="item">                                
                                    <div class="image_wrap">                                     
                                        <?=$self->sub('Image','image_'.$i)?>
                                    </div>
                                    <div class="name">
                                        <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                    </div>
                                    <div class="desc">
                                        <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                    </div>
                                </div>   
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?> 
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_4() { 
        return self::$en ? [
           'show_title' => true,
           'show_title_2' => false,
           'show_image_border' => true,
           'background_color' =>'#FFFFFF',
           'title' => "The advantages of our circus",
           'title_2' => "Subtitle", 
           'items' => array(
                array(
                    'image_1' => 'view/editor/assets/benefits/1.jpg',
                    'image_2' => 'view/editor/assets/benefits/2.jpg',
                    'name_1' => "Serious approach",
                    'name_2' => "Attention to detail",
                    'desc_1' => "The seriousness of our approach could not be underestimated. We have the most serious circus. And we are serious!",
                    'desc_2' => "Only attention to details, such as the color of the door handles and the shape of the chair, makes us better.",
                ),               
            )
        ] : [
           'show_title' => true,
           'show_title_2' => false,
           'show_image_border' => true,
           'background_color' =>'#FFFFFF',
           'title' => "Преимущества нашего цирка",
           'title_2' => "Подзаголовок о преимуществах", 
           'items' => array(
                array(
                    'image_1' => 'view/editor/assets/benefits/1.jpg',
                    'image_2' => 'view/editor/assets/benefits/2.jpg',
                    'name_1' => "Серьёзный подход",
                    'name_2' => "Внимание к деталям",
                    'desc_1' => "Серьёзность нашего подхода нельзя недооценивать. Мы самый серьёзный цирк. И это мы серьезно!",
                    'desc_2' => "Только внимание к таким деталям как цвет ручки входной двери и форма стула билетёра делают нас лучшими.",
                ),               
            )
        ];
    }
    
    function tpl_5($val) {?>
        <div class="container-fluid benefits benefits_5" style="background: <?=$val['background_color']?>;">
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
                        <div class="item_list clear <?= !$val['show_image_border'] ? "hide_border" : "" ?>">
                        <? $this->repeat('items',function($item_val,$self) use ($val) { ?>
                            <? for ($i=1;$i<=3;$i++): ?>
                                <div class="item">
                                    <?=$self->sub('Image','image_'.$i)?>
                                    <? if ($cls = $self->vis($val['show_name_benefit'])): ?>
                                        <div class="name <?=$cls?>" >
                                            <? $self->sub('Text','name_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                    <? if ($cls = $self->vis($val['show_desc_benefit'])): ?>
                                        <div class="desc <?=$cls?>" >
                                            <? $self->sub('Text','desc_'.$i,Text::$plain_text) ?>
                                        </div>
                                    <? endif ?>
                                </div>  
                            <? endfor ?>
                            <div style="clear: both"></div>
                        <? }) ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default_5() { 
        return self::$en ? [
            'show_title' => true,
            'show_title_2' => false,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'show_image_border' => true,
            'background_color' =>'#FFFFFF',
            'title' => "The advantages of our circus",
            'title_2' => "Subtitle", 
            'items' => array(
                array(
                    'image_1' => 'view/editor/assets/benefits/3.jpg',
                    'image_2' => 'view/editor/assets/benefits/4.jpg',
                    'image_3' => 'view/editor/assets/benefits/5.jpg',
                    'name_1' => "Simplicity of passage",
                    'name_2' => "Seats",
                    'name_3' => "Support for a laugh",
                    'desc_1' => "The unique design of the circus will not let you get lost. Entry and exit are here in the one place.",
                    'desc_2' => "All seats are numbered. There will not any troubles with your place.",
                    'desc_3' => "Smiling dog is always here! He is always ready to lick you to death.",
                )
            )
        ] : [
            'show_title' => true,
            'show_title_2' => false,
            'show_name_benefit' => true,
            'show_desc_benefit' => true,
            'show_image_border' => true,
            'background_color' =>'#FFFFFF',
            'title' => "Преимущества нашего цирка",
            'title_2' => "Подзаголовок о преимуществах", 
            'items' => array(
                array(
                    'image_1' => 'view/editor/assets/benefits/3.jpg',
                    'image_2' => 'view/editor/assets/benefits/4.jpg',
                    'image_3' => 'view/editor/assets/benefits/5.jpg',
                    'name_1' => "Простота прохода",
                    'name_2' => "Места по номерам",
                    'name_3' => "Поддержка смехом",
                    'desc_1' => "Уникальная конструкция цирка не даст Вам заблудиться. Вход и выход у нас в одном месте.",
                    'desc_2' => "Все места пронумерованы черным маркером. Проблем с поиском своего места не будет.",
                    'desc_3' => "В зале всегда находится дежурный пёс-смехун, который всегда готов зализать Вас до смерти.",
                )
            )
        ];
    }        
}