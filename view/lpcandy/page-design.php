<!doctype html>
<html>
    <head>
        <title><?=_t('Templater editor')?></title>
        <meta charset="utf-8">
        <link  href="<?=t_url('assets/style.css')?>" rel="stylesheet" type="text/css">
        <link  href="<?=t_url('assets/script/alertify/css/style_lpcandy.css')?>" rel="stylesheet" type="text/css">
        <script src="<?=t_url('assets/script/alertify/alertify.js')?>"></script>
        <script src="<?=t_url('assets/script/jquery.js')?>"></script>      
        <script src="<?=t_url('assets/script/lpcandy.js')?>"></script>
        
        <script src="/~boomyjee/teacss/lib/teacss.js"></script>
        <script src="/~boomyjee/teacss-ui/lib/teacss-ui.js"></script>
        <link  href="/~boomyjee/teacss-ui/lib/teacss-ui.css" rel="stylesheet" type="text/css">
        <script src="/~boomyjee/dayside/client/lib/require.js"></script>
        <link  href="<?=t_url('editor/editor.css')?>" rel="stylesheet" type="text/css">

        <script>
            /*var base_url = "<?=INDEX_URL?>";*/
            var base_url = "<?=url('')?>"
            var page_id = <?=json_encode($page_id)?>;
            function run(exports){
                var templater_app = exports[0];
                var lpcandy_app = exports[1];
                lpcandy_app(templater_app,{
                    template: "<?=$tpl?>",
                    publishScreenshot: false,
                    ajax_url: "<?=url('page-ajax/'.$page_id)?>",
                    upload_url: "<?=url('upload/LPCandy/files/'.$page->user->id)?>",
                    browse_url: "<?=url('files/browse.php')?>",
                    allowSkipType: false
                });
            }
        </script>        
        
        <? if (\Bingo\Configuration::$applicationMode=='development'): ?>
            <script src="/~boomyjee/dayside/client/lib/require.proxy.php"></script>        
            <script>
                require(
                    "/~boomyjee/templater/lib/client/app.js",
                    "<?=url('view/editor/editor.js')?>",
                    run
                );
            </script>
        <? else: ?>
            <script src="<?=url('view/editor/editor.min.js')?>"></script>
            <script>
                editor_min(run);
            </script>
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
    </body>
</html>
