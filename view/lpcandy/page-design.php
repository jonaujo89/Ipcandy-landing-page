<!doctype html>
<html>
    <head>
        <title><?=_t('Templater editor')?></title>
        <meta charset="utf-8">

        <script src="/~boomyjee/teacss/lib/teacss.js"></script>
        <script src="/~boomyjee/teacss-ui/lib/teacss-ui.js"></script>
        <link  href="/~boomyjee/teacss-ui/lib/teacss-ui.css" rel="stylesheet" type="text/css">
        <script src="/~boomyjee/dayside/client/lib/require.js"></script>
        <script src="/~boomyjee/dayside/client/lib/require.proxy.php"></script>
        
        <script>
            var base_url = "<?=INDEX_URL?>";
            require(
                "/~boomyjee/templater/lib/client/app.js",
                "<?=url('templater_modules/lpcandy/lpcandy.js')?>",
                function(exports){
                    var templater_app = exports[0];
                    var lpcandy_app = exports[1];
                    lpcandy_app(templater_app,{
                        template: "<?=$tpl?>",
                        publishScreenshot: true,
                        ajax_url: "<?=url('page-ajax/'.$page->id)?>",
                        upload_url: "<?=url('upload/LPCandy/files/'.$page->user->id)?>",
                        browse_url: "<?=url('files/browse.php')?>",
                        allowSkipType: false
                    });
                }
            );
        </script>        
    </head>
    <body>
        <div id="logged_info">
            <? $user = \LPCandy\Models\User::checkLoggedIn() ?>
            <? if ($user): ?>
                <?=_t('Logged as')?>
                <a href="<?=url('profile')?>"><?= $user->name ?></a>
                |
                <a href="<?=url('logout')?>"><?=_t('Logout')?></a>
            <? endif ?>
        </div>            
    </body>
</html>
