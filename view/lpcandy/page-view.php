<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="<?= htmlspecialchars(str_replace(array("'","\""), "",$page->meta_robots), ENT_QUOTES)?>">
    <meta name="keywords" content="<?= htmlspecialchars(str_replace(array("'","\""), "",$page->meta_keywords), ENT_QUOTES)?>">
    <meta name="description" content="<?= htmlspecialchars(str_replace(array("'","\""), "", $page->meta_description), ENT_QUOTES)?>">
    <title><?= $page->title ?></title>
    <script>
        var base_url = "<?=INDEX_URL?>";
        var page_id = <?=$page->id?>; 
    </script>
    <link rel="stylesheet" type="text/css" href="<?=url('view/editor/style/style.min.css')?>">
    <script src="<?=url('view/editor/style/style.min.js')?>"> </script>    
    <script>
        function SubmitJS(){
            <?= strip_tags($page->extra_html_submit) ?>
        }
    </script>
</head>                
    <body>
        <?= $body_html ?>
        <?= $page->extra_html?>                    
    </body>
</html>