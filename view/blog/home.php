<? bingo_domain('lpcandy') ?>
<? include partial('lpcandy/layout') ?>

<? startblock('content') ?>

    <h3><?= $post->title ?></h3>
    <section>
        <form>
            <fieldset>
                <?= $post->content ?>
            </fieldset>
        </form>
    </section>

<? endblock() ?>