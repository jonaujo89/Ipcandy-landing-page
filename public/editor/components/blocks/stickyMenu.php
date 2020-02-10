<?php

namespace LPCandy\Components;

class StickyMenu extends Block {
    public $name;
    public $description;
    public $editor = "lp.stickyMenu";
    
    function __construct() { 
        if (self::$en) {
            $this->name = 'Sticky menu';
            $this->description = "Navigation menu";
        } else {
            $this->name = 'Липкое меню';
            $this->description = "Меню навигации";
        }        
    }
    
    function tpl($val) {?>
        <div class="container-fluid sticky_menu <?= $val['isDark'] ? 'dark' : '' ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12 menu-col">
                        <? 
                            $enabledItems = [];
                            foreach ($val['items'] ?? [] as $item) {
                                if ($item['enabled']) $enabledItems[] = $item;
                            };
                        ?>

                        <? if ($cls = $this->vis(count($enabledItems)!=0)): ?>
                            <div class="toggler <?=$cls?>">
                                <span class="toggler-icon"></span>
                            </div>
                        <? endif ?>
                        <ul class="items">
                            <? foreach ($enabledItems as $item): ?>
                                <li>
                                    <a href="#" data-id="#<?=$item['id']?>"><?= $item['title'] ?></a>
                                </li>
                            <? endforeach ?>
                        </ul>
                        <? if ($cls = $this->vis(count($enabledItems)==0)): ?>
                            <div class="empty-placeholder <?=$cls?>">
                                <?= self::$en ? 'Add components to display menu items' : 'Добавьте компоненты для отображения пунктов меню' ?>
                            </div>
                        <? endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?}
    
    function tpl_default() { 
        return [
            'fixedWidth' => false,
            'isDark' => true,
            'items' => []
        ];
    }
}