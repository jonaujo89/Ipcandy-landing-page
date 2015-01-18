<!doctype html>
<html>
    <head>
        <title><?=_t('Templater editor')?></title>
        <meta charset="utf-8">
        
        <script src="/~boomyjee/teacss/lib/teacss.js"></script>
        <script src="/~boomyjee/teacss-ui/lib/teacss-ui.js"></script>
        <link  href="/~boomyjee/teacss-ui/lib/teacss-ui.css" rel="stylesheet" type="text/css">
        <script src="/~boomyjee/dayside/client/lib/require.js"></script>
        
        <script src="<?=t_url('assets/script/lpcandy.js')?>"></script>

        <script>
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
            <link  href="<?=url('view/editor/editor.min.css')?>" rel="stylesheet" type="text/css">
            <script src="<?=url('view/editor/editor.min.js')?>"></script>
            <script>
                require_min(run);
            </script>
        <? endif ?>
    </head>
    <body>
        <? include partial('lpcandy/logged-info') ?>
    </body>
</html>
