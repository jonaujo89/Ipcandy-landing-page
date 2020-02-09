<!doctype html>
<html>
<head>
    <title><?= _h($title) ?></title>
    <meta charset="utf-8" />
    <link id="favicon" rel="icon" type="image/png" sizes="64x64" href="view/assets/images/lpcandy.png"/> 
    <script>
        var base_url = "<?=rtrim(url(''),"/")?>";
        var locale_lang = "<?=explode("_",bingo_get_locale())[0]?>";
        var browse_text = "<?=_t('Browse')?>";
    </script>   

    <script src="<?= url('view/assets/lpcandy.min.js') ?>"></script>
    <link  href="<?= url('view/assets/lpcandy.min.css') ?>" rel="stylesheet" type="text/css" /> 
</head>
<body>    
    <? include partial('lpcandy/logged-info') ?>
    <? $menu = array() ?>
    <? 
        if ($user) {
            $menu = array(
                array('url'=>'page-list','label'=>_t('Pages')),
                array('url'=>'track-list','label'=>_t('Tracking')),
                array('url'=>'profile','label'=>_t('Profile'))
            );
        }
        $menu = \Bingo\Action::filter('lpcandy_menu',array($menu,$user));
    ?>
    <div id="menu">
        <ul>
            <li>
                <a id="logo" href="<?=url('')?>">LP-Candy</a>
            </li>
            <? if (count($menu)) foreach ($menu as $item): ?> 
                <?
                    $cls = ($item['url']==\Bingo\Routing::$uri) ? "current-menu-item":"";
                ?>
                <li class="<?= $cls ?>">
                    <a href="<?=url($item['url'])?>"><?= $item['label'] ?></a>
                </li>
            <? endforeach ?>
        </ul>
    </div>
    <div id="page">
        <? startblock('page') ?>
        <div id="content">            
            <? emptyblock('content') ?>
        </div>
    
        <div id="footer">
            <? include partial('lpcandy/banner') ?>
        </div>
        <? endblock() ?>
    </div>
</body>
</html>