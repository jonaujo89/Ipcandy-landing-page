<!doctype html>
<html>
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8" />

    <script>var base_url = "<?=url('')?>"</script>
    
    <? if (isset($_GET['dev']) && \CMS\Models\User::checkLoggedIn()): ?>
        <? 
            if (isset($_POST['css'])) {
                file_put_contents(__DIR__."/assets/style.css",$_POST['css']);
                if (isset($_POST['js'])) {
                    file_put_contents(__DIR__."/assets/script.js",$_POST['js']);
                }
                die();
            }
        ?>
    
        <script tea="<?=t_url('assets/tea/makefile.tea')?>"></script>
        <script src="<?=t_url('assets/script/jquery.js')?>"></script>
        <script src="/~boomyjee/teacss/lib/teacss.js"></script>
        <script>
            teacss.buildCallback = function (files) {
                var dir = teacss.path.absolute("../src/teacss-ui/style")+"/";
                var css = files['/default.css'];
                while (css.indexOf(dir)!=-1) css = css.replace(dir,"");
                $.post(location.href,{css:css,js:files['/default.js']},function(data){
                    alert('ok');
                });
            }
            teacss.update();
        </script>    
    <? else: ?>
        <link rel="stylesheet" type="text/css" href="<?=t_url('assets/style.css')?>">
        <script src="<?=t_url('assets/script.js')?>"></script>
    <? endif ?>
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
    
    <div id="header">
        <div class="in">
            <a id="logo" href="<?=url('')?>">LP-Candy</a>
            <div id="cloud">
                Extensive landing page generator
            </div>
        </div>
    </div>
    
    <div id="page">

        <? $menu = array() ?>
        <? 
            if ($user) {
                $menu = array(
                    array('url'=>'page-list','label'=>'Pages'),
                    array('url'=>'tpl-list' ,'label'=>'Templates')
                );
            }
            $menu = \Bingo\Action::filter('admin_menu',array($menu,$user));
        ?>
        <? if (count($menu)): ?>
            <div id="menu">
                <ul>
                    <? foreach ($menu as $item): ?> 
                        <?
                            $cls = ($item['url']==\Bingo\Routing::$uri) ? "current-menu-item":"";
                        ?>
                        <li class="<?= $cls ?>">
                            <a href="<?=url($item['url'])?>"><?= $item['label'] ?></a>
                        </li>
                    <? endforeach ?>
                </ul>
            </div>
        <? endif ?>
    
        <div id="content">
            <? emptyblock('content') ?>
        </div>
    
        <div id="footer">
            Powered by Bingo and TeaCss
        </div>
    </div>
</body>
</html>