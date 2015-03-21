<? include partial('lpcandy/layout') ?>
<? startblock('content') ?>
    <link rel="stylesheet" type="text/css" href="<?=url('view/editor/style/style.min.css')?>">
    <style>
        html,body {
            font-size:12px;
            line-height:1.5em;
        }
        @media (max-width:1369px) {
            .container {
              width: 930px;
              margin: 0 auto;
              margin-left: auto !important;
              margin-right: auto !important;
            }
            .span16 {
              display: inline;
              float: left;
              width: 930px;
              margin-left: 30px;
            }
            .span16:first-child {
              margin-left: 0;
            }
            .stages_1 .item_list .item .name, .benefits_1 .item_list .item .name {
              font-size: 18px;
            }
        }
    </style>
    <script src="<?=url('view/editor/style/style.min.js')?>"></script>
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <?= $body_html ?>
<? endblock() ?>