<? include partial('layout') ?>
<? startblock('content') ?>
    <? if (!isset($heading) || $heading): ?>
    <h3 class='page-title'>
        <?=$title?>
        <? if (isset($page_actions)): ?>
        <span class="page_actions">
            <? foreach ($page_actions as $url=>$action): ?>
                <?=anchor($url,$action)?>
            <? endforeach ?>
        </span>
        <? endif ?>
    </h3>
    <? endif ?>

    <? if (count($list)): ?>

        <form>
            <? foreach ($list as $obj): ?>
                <table class="list">
                <tr>
                    <td class='preview'>
                        <img width=200 src='<?=$obj->getScreenshotUrl()?>'>
                    </td>
                    <td class='title'>
                        <h3>
                            <?=$obj->title?>
                            <?=anchor('page-view/'.$obj->id,_t('(page preview)'),'_blank')?>
                        </h3>
                        <?= $obj->domain ?: _t("No domain assigned") ?>
                        <br>
                        <?= anchor('page-child-edit/'.$obj->id,_t('+ add child page')) ?>
                    </td>
                    <td class='designer'>
                        <?= anchor('page-design/'.$obj->id,_t('Launch Designer')) ?>
                    </td>
                    <td class='actions'>
                        <?= anchor('page-edit/'.$obj->id,_t('edit')) ?>
                        <?= anchor('page-delete/'.$obj->id,_t('delete')) ?>
                    </td>
                </tr>
                <? foreach ($obj->children as $obj): ?>
                    <tr class='child'>
                        <td class='preview'>
                            <img width=100 src='<?=$obj->getScreenshotUrl()?>'>
                        </td>
                        <td class='title'>
                            <h3>
                                <?=$obj->title?>
                                <?=anchor('page-view/'.$obj->id,_t('(page preview)'),'_blank')?>
                            </h3>
                        </td>
                        <td class='designer'>
                            <?= anchor('page-design/'.$obj->id,_t('Launch Designer')) ?>
                        </td>
                        <td class='actions'>
                            <?= anchor('page-edit/'.$obj->id,_t('edit')) ?>
                            <?= anchor('page-delete/'.$obj->id,_t('delete')) ?>
                        </td>
                    </tr>                
                <? endforeach ?>
                </table>
            <? endforeach ?>
        </form>

    <? else: ?>

        <div class="message">
            <?=_t('No pages yet')?>
        </div>

    <? endif ?>
    
<? endblock() ?>