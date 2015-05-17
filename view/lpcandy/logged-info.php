<div id="logged_info">
    <? $user = \LPCandy\Models\User::checkLoggedIn() ?>
    <a class="home" href='<?=url('page-list')?>'></a>
    <? if ($user): ?>
        <?=_t('Logged as')?>
        <a href="<?=url('profile')?>"><?= $user->name ?></a>        |
        <a href="<?=url('logout')?>"><?=_t('Logout')?></a>
    <? else: ?>
        <a href="<?=url('login')?>"><?=_t('Login')?></a>
    <? endif ?>
</div>