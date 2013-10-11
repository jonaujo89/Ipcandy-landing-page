<?php

namespace LPCandy\Forms;

class JSControl extends \Bingo\FormElement {
    static public $id_cnt = 0;
    function __construct($args) {
        parent::__construct($args);
        $this->filter = new FormFilter_JSON();
        if (!$this->id)
            $this->id = 'jsctl_'.self::$id_cnt++;
    }
    function render() {?>
        <input type='hidden' <?=$this->attr('name')?> <?=$this->attr('value')?> <?=$this->attr('id')?> />
        <script>teacss.ui.formControl('#<?=$this->id?>',teacss.ui.composite,<?=json_encode($this->config)?>)</script>
    <?}
}