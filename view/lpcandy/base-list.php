<? include partial('lpcandy/layout') ?>
<? startblock('content') ?>
    <? if (!isset($heading) || $heading): ?>
    <h3 class='page-title'>
        <? if (isset($heading)): ?>
            <?=$heading?>
        <? else: ?>
            <?=$title?>
        <? endif ?>
        <? if (isset($page_actions)): ?>
        <span class="page_actions">
            <? foreach ($page_actions as $url=>$action): ?>
                <?=anchor($url,$action)?>
            <? endforeach ?>
        </span>
        <? endif ?>
    </h3>
    <? endif ?>
    <? bingo_domain('cms') ?>
    <? include(BINGO_PATH.'/template/admin/cms/list.php') ?>
<? endblock() ?>