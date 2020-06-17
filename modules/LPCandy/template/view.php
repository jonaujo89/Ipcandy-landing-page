<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="<?= htmlspecialchars($page->meta_robots)?>">
    <meta name="keywords" content="<?= htmlspecialchars($page->meta_keywords)?>">
    <meta name="description" content="<?= htmlspecialchars($page->meta_description)?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link id="favicon" rel="icon" type="image/png" sizes="64x64" href="assets/images/lpcandy.png" /> 
    <title><?= $page->title ?></title>
    <script src="<?=INDEX_URL?>/assets/lpcandy.min.js"></script>
    <link  href="<?=INDEX_URL?>/assets/lpcandy.min.css" rel="stylesheet" type="text/css">

    <script src="<?=INDEX_URL?>/assets/extra/projects.min.js"></script>
    <link  href="<?=INDEX_URL?>/assets/extra/projects.min.css" rel="stylesheet" type="text/css">

    <script>
        lpcandyRun("Editor",{
            language: "<?= explode("_",\Bingo\Configuration::$locale)[0] ?>",
            base_url: location.origin+"<?=INDEX_URL?>",
            assets_url: 'assets/components',

            ajaxUrl: "api/page-editor/<?=$page->id?>",
            blocks: <?=json_encode($page->loadBlocks($published=true)) ?>,
            viewOnly: true
        })
    </script>

</head>                
<body>
    <?=$page->getPublishedHtml()?>
</body>
</html>