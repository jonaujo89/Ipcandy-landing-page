<? include partial('lpcandy/layout') ?>
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
        <? include partial('lpcandy/beejee-info') ?>
    </h3>
    <? endif ?>

    <form>
        <? if (count($list)): ?>        
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
                        <?= anchor('page-child-create/'.$obj->id,_t('+ add child page')) ?>
                        <div class="actions">
                            <a class="design" href="<?=url('page-design/'.$obj->id)?>"><?=_t('Launch Designer')?></a>
                            <a class="edit" href="<?=url('page-edit/'.$obj->id)?>"><?=_t('Edit')?></a>
                            <a class="delete" href="<?=url('page-delete/'.$obj->id)?>"><?=_t('Delete')?></a>
                        </div>
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
                            <?= $obj->pathname ?: _t("No pathname assigned") ?>
                            <br>
                            <div class="actions">
                                <a class="design" href="<?=url('page-design/'.$obj->id)?>"><?=_t('Launch Designer')?></a>
                                <a class="edit" href="<?=url('page-edit/'.$obj->id)?>"><?=_t('Edit')?></a>
                                <a class="delete" href="<?=url('page-delete/'.$obj->id)?>"><?=_t('Delete')?></a>
                            </div>
                        </td>
                    </tr>                
                <? endforeach ?>
                </table>
            <? endforeach ?>
        <? else: ?>
            <div class="message">
                <?=_t('No pages yet')?>
            </div>
        <? endif ?>
    </form>

<? endblock() ?>