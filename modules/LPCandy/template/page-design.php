<!doctype html>
<html>
    <head>
        <title><?=_t('Templater editor')?></title>
        <meta charset="utf-8" alt>
        <link id="favicon" rel="icon" type="image/png" sizes="64x64" href="../view/assets/images/lpcandy.png"/> 

        <script>
            var base_url = "<?=INDEX_URL?>";
            var locale_lang = "<?=explode("_",bingo_get_locale())[0]?>";
        </script>

        <script src="<?=url('editor/app.min.js')?>"></script>
        <link  href="<?=url('editor/app.min.css')?>" rel="stylesheet" type="text/css">

        <script>
            lp.addressText && (lp.addressText.geocoder_api_key = "<?= \LPCandy\Configuration::$geocoder_api_key ?>");
            lp.run({
                ajax_url: "<?=url('page-ajax/'.$page->id)?>",
                assets_url: "editor/components/assets",
                upload_url: "<?=url('upload/LPCandy/files/'.$page->user->id)?>",
                blocks: <?=json_encode($page->loadBlocks($published=false))?>,
            });
        </script>
    </head>
    <body>
        <? include partial('lpcandy/logged-info') ?>
        <div id="app" />
    </body>
</html>
