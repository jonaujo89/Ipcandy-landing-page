<? include partial('lpcandy/layout') ?>

<? startblock('content') ?>

    <h3><?= _t("Page list") ?></h3>
    <p class='actions'>
        <a href="<?=url('page-edit')?>"><?=_t('Create a new page')?></a>
    </p>
    <? if (count($pages)): ?>
        <table>
            <tr>
                <th><?=_t('Title')?></th>
                <th><?=_t('Template')?></th>
                <th><?=_t('Domain')?></th>
                <th></th>
                <th></th>
            </tr>
            <? foreach ($pages as $page): ?>
            <tr>
                <td><?=$page->title?></td>
                <td>
                    <? if ($page->template): ?>
                        <?= $page->template ?>
                    <? else: ?>
                        <?=_t("No template selected")?>
                    <? endif ?>
                </td>
                <td>
                    <a target="_blank" href="<?=url('pages/'.$page->id)?>">
                        <?= $page->domain ?: _t('No domain') ?>
                    </a>
                </td>
                <td>
                    <a href="<?=url('page-design/'.$page->id)?>"><?=_t('design')?></a>
                </td>
                <td>
                    <a href="<?=url('page-edit/'.$page->id)?>"><?=_t('edit')?></a>
                </td>
            </tr>
            <? endforeach ?>
        </table>
    <? else: ?>
        <p><?=_t('There are no pages')?> <a href="<?=url('page-edit')?>"><?=_t('Create a new page?')?></a></p>
    <? endif ?>

    <? if (count($templates)): ?>
        <h3><?= _t("Template list") ?></h3>
        <table>
            <tr>
                <th><?=_t('Name')?></th>
                <th></th>
            </tr>
            <? foreach ($templates as $key=>$t): ?>
            <tr>
                <td><?=$key?></td>
                <td>
                    <a href="<?=url('tpl-edit/'.$key)?>"><?=_t('edit')?></a>
                </td>
            </tr>
            <? endforeach ?>
        </table>
    <? endif ?>


  
<? endblock() ?>