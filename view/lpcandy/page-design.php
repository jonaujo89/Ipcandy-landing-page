<!doctype html>
<html>
    <head>
        <title><?=_t('Templater editor')?></title>
        <meta charset="utf-8" alt>
        <script src="<?=url('lib/teacss/teacss.js')?>"></script>
        <script src="<?=url('/lib/teacss-ui/teacss-ui.js')?>"></script>
        <link  href="<?=url('/lib/teacss-ui/teacss-ui.css')?>" rel="stylesheet" type="text/css">
        <script src="<?=url('/lib/require/require.js')?>"></script>

        <script>
            var base_url = "<?=INDEX_URL?>"
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
                    allowSkipType: false,
                    minified_style: <?= \Bingo\Configuration::$applicationMode=='development' ? 'false':'true' ?>
                });
            }
        </script>        
        
        <? if (\Bingo\Configuration::$applicationMode=='development'): ?>
            <script src="<?=url('lib/require/require.proxy.php')?>"></script>        
            <script>
                require(
                    "<?=url('lib/templater/client/app.js')?>",
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
        <? include partial('lpcandy/beejee-info') ?>
        <? include partial('lpcandy/logged-info') ?>
    </body>
</html>
