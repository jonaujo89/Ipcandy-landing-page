<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="<?= htmlspecialchars(str_replace(array("'","\""), "",$page->meta_robots), ENT_QUOTES)?>">
    <meta name="keywords" content="<?= htmlspecialchars(str_replace(array("'","\""), "",$page->meta_keywords), ENT_QUOTES)?>">
    <meta name="description" content="<?= htmlspecialchars(str_replace(array("'","\""), "", $page->meta_description), ENT_QUOTES)?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= _h($page->title) ?></title>
    <script>
        var base_url = "<?=INDEX_URL?>";
        var page_id = <?=$page->id?>;
        var locale_lang = "<?=explode("_",bingo_get_locale())[0]?>";
    </script>

    <script src="<?=url('assets/editor.min.js')?>"></script>
    <link  href="<?=url('assets/editor.min.css')?>" rel="stylesheet" type="text/css">

    <script>
        lp.run({
            assets_url: "assets/components",
            blocks: <?=json_encode($page->loadBlocks($published=true))?>,
            viewOnly: true
        });
    </script>

</head>                
    <body>
        <div id="app"><?=$page->getPublishedHtml()?></div>
    </body>
</html>