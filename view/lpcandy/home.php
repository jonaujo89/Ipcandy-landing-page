<? include partial('lpcandy/layout') ?>
<? startblock('content') ?>
    <link rel="stylesheet" type="text/css" href="<?=$assets.'/default.css'?>">
    <style>
        html,body {
            font-size:12px;
            line-height:1.5em;
        }
    </style>
    <script src="<?=$assets.'/default.js'?>"></script>
    <?= $body_html ?>
<? endblock() ?>