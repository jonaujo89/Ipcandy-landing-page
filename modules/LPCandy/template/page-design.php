<!doctype html>
<html>
    <head>
        <title><?=_t('Templater editor')?></title>
        <meta charset="utf-8" alt>
        <link id="favicon" rel="icon" type="image/png" sizes="64x64" href="../view/assets/images/lpcandy.png"/> 

        <script>
            var base_url = "<?=INDEX_URL?>";
            var page_id = <?=json_encode($page_id)?>;
            var locale_lang = "<?=explode("_",bingo_get_locale())[0]?>";
        </script>

        <script src="<?=url('editor/app.min.js')?>"></script>
        <link  href="<?=url('editor/app.min.css')?>" rel="stylesheet" type="text/css">

        <script>
            lp.addressText.geocoder_api_key = "<?= \LPCandy\Configuration::$geocoder_api_key ?>";
            lp.app({
                template: "<?=$tpl?>",
                publishScreenshot: false,
                ajax_url: "<?=url('page-ajax/'.$page_id)?>",
                assets_url: "view/editor/assets",
                upload_url: "<?=url('upload/LPCandy/files/'.$page->user->id)?>",
                browse_url: "<?=url('files/browse.php')?>",
                allowSkipType: false
            });
        </script>
    </head>
    <body>
        <? include partial('lpcandy/banner') ?>
        <? include partial('lpcandy/logged-info') ?>
        <?= $page->extra_html ?>
    </body>
</html>
