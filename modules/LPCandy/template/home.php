<? include partial('lpcandy/layout') ?>
<? startblock('content') ?>
    <script>
        var base_url = "<?=INDEX_URL?>";
        var page_id = <?=$page->id?>;
        var locale_lang = "<?=explode("_",bingo_get_locale())[0]?>";
    </script>

    <script src="<?=url('editor/app.min.js')?>"></script>
    <link  href="<?=url('editor/app.min.css')?>" rel="stylesheet" type="text/css">
    <script src="<?=url('editor/components.min.js')?>"></script>
    <link  href="<?=url('editor/components.min.css')?>" rel="stylesheet" type="text/css">

    <script>
        lp.run({
            assets_url: "editor/components/assets",
            blocks: <?=json_encode($page->loadBlocks($published=true))?>,
            viewOnly: true
        });
    </script>
    <div id="app"></div>

<? endblock() ?>