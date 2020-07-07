<?
    $home_domain = \Bingo\Config::get('config','domain')[bingo_get_locale()];        
    $home_page = \LPCandy\Models\Page::findOneByDomain($home_domain);
    $user = \LPCandy\Models\User::checkLoggedIn();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link id="favicon" rel="icon" type="image/png" sizes="64x64" href="assets/images/lpcandy.png" /> 
    <title>LPCandy</title>
    <script src="<?=INDEX_URL?>/assets/lpcandy.min.js"></script>
    <link  href="<?=INDEX_URL?>/assets/lpcandy.min.css" rel="stylesheet" type="text/css">

    <? if ($user): ?>
        <? foreach($user->getBoughtProducts($includeCart=true) as $product): ?>
            <script src="<?=$product->getJsUrl()?>"></script>
            <link  href="<?=$product->getCssUrl()?>" rel="stylesheet" type="text/css">
        <? endforeach; ?>
    <? endif; ?>

    <script>
        lpcandyRun("SiteApp",{
            language: "<?= explode("_",\Bingo\Configuration::$locale)[0] ?>",
            base_url: location.origin+"<?=INDEX_URL?>",
            assets_url: 'assets/components',

            home_page_id: <?=$home_page ? $home_page->id : 0 ?>,
            geocoder_api_key: <?=json_encode(\LPCandy\Configuration::$geocoder_api_key)?>,
        })
    </script>
</head>                
<body>
</body>
</html>