<!doctype html>
<html>
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8" />

    <script>var base_url = "<?=url('')?>"</script>
    <?
        include BINGO_PATH."/../teacss/lib/teacss.php";
        teacss(
            $makefile = t_url('assets/tea/makefile.tea'),
            $css = t_url('assets/style.css'),
            $js = t_url('assets/script.js'),
            $dir = __DIR__."/assets",
            $dev = (isset($_GET['dev']) && \CMS\Models\User::checkLoggedIn()),
            $teacss = "/~boomyjee/teacss/lib/teacss.js"
        );
    ?>
</head>
<body>
    <div id="logged_info">
        <? $user = \LPCandy\Models\User::checkLoggedIn() ?>
        <? if ($user): ?>
            <?=_t('Logged as')?>
            <a href="<?=url('profile')?>"><?= $user->name ?></a>
            |
            <a href="<?=url('logout')?>"><?=_t('Logout')?></a>
        <? else: ?>
            <a href="<?=url('login')?>"><?=_t('Login')?></a>
        <? endif ?>
    </div>            
    
    <? $menu = array() ?>
    <? 
        if ($user) {
            $menu = array(
                array('url'=>'page-list','label'=>'Pages'),
                array('url'=>'track-list','label'=>'Track'),
                array('url'=>'profile','label'=>'Profile')
            );
        }
        $menu = \Bingo\Action::filter('admin_menu',array($menu,$user));
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
        <div id="content">
            <? emptyblock('content') ?>
        </div>
    
        <div id="footer">
            Powered by Bingo and TeaCss
        </div>
    </div>
</body>
</html>