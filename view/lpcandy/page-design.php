<!doctype html>
<html>
    <head>
        <title><?=_t('Templater editor')?></title>
        <meta charset="utf-8">

        <script src="/~boomyjee/templater/lib/templater.js"></script>
        <script>
            templater({
                template: "<?=$tpl?>",
                ajax_url: "<?=url('page-ajax/'.$page->id)?>",
                modules: [
                    "core",
                    "<?=url('view/assets/script/templater.js')?>"
                ]
            })
        </script>        
    </head>
    <body>
        <div id="logged_info">
            <? $user = \LPCandy\Models\User::checkLoggedIn() ?>
            <? if ($user): ?>
                <?=_t('Logged as')?>
                <a href="<?=url('profile')?>"><?= $user->name ?></a>
                |
                <a href="<?=url('logout')?>"><?=_t('Logout')?></a>
            <? endif ?>
        </div>            
    </body>
</html>
