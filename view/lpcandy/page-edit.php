<? include partial('layout') ?>
<? startblock('content') ?>

    <link href="/~boomyjee/teacss-ui/lib/teacss-ui.css" rel="stylesheet" type="text/css">
    <script src="/~boomyjee/teacss-ui/lib/teacss-ui.js"></script>

    <script src="<?=t_url('assets/script/ui/formRepeater.js')?>"></script>
    <link href="<?=t_url('assets/script/ui/formRepeater.css')?>" rel="stylesheet" type="text/css" >

    <h3><?= $title ?></h3>
    <section>
        <?= $form ?>
    </section>


<? endblock() ?>