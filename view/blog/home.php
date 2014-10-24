<? include partial('layout') ?>

<? startblock('content') ?>

    <h3><?= $post->title ?></h3>
    <section>
        <?= $post->content ?>
    </section>

<? endblock() ?>