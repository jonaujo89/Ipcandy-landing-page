<? include __DIR__."/base.php" ?>
<? startblock('body') ?>

    <?=_t('You have a new form track')?><br>
    <a href="http://<?=\Bingo\Config::get('config','domain')?>/track-list"><?=_t('Goto track list')?></a><br><br>

    <?
        $val = $track->data;
        if(!$val['values']) return "Данных нет";
        $data = "";
        foreach($val['values'] as $one) {            
            $sub = $one['value'];
            if (is_bool($sub)) $sub = $sub ? _t('yes') : _t('no');
            if (is_array($sub)) {
                $files_str = array();
                foreach ($sub as $f) {
                    if(isset($f['src']) && !empty($f['src']) && isset($f['dest']) && !empty($f['dest']) ){
                        $files_str[] = anchor('track-file/'.$track->id.'?file='.urlencode($f['dest'])."&name=".urlencode($f['src']),$f['src']);
                    }
                }
                $sub = implode(", ",$files_str);
            }
            $data.="<b>".$one['label'].": </b>".$sub."<br>";
        }
        echo $data;
    ?>

<? endblock() ?>