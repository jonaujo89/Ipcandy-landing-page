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
    <link rel="stylesheet" type="text/css" href="<?=url('editor/components.min.css')?>">
    <script src="<?=url('editor/components.min.js')?>"> </script>    
    <script>
        window.extraHtmlSubmit = function() {
            <?= strip_tags($page->extra_html_submit) ?>
        }
    </script>
</head>                
    <body>
        <?= $body_html ?>
        <?= $page->extra_html?>                    
    </body>
</html>