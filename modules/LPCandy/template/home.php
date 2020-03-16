<? include partial('lpcandy/layout') ?>
<? startblock('content') ?>
    <script>
        var base_url = "<?=INDEX_URL?>";
        var page_id = <?=$page->id?>;
        var locale_lang = "<?=explode("_",bingo_get_locale())[0]?>";
    </script>

    <script src="<?=url('assets/editor.min.js')?>"></script>
    <link  href="<?=url('assets/editor.min.css')?>" rel="stylesheet" type="text/css">

    <style>
        body {
            font-size: 12px;
            line-height: 1.5em;
        }
    </style>

    <script>
        lp.run({
            assets_url: "assets/components",
            blocks: <?=json_encode($page->loadBlocks($published=true))?>,
            viewOnly: true
        });
    </script>
    <div id="app"></div>

<? endblock() ?>