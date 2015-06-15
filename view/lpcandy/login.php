<? include partial('lpcandy/layout') ?>
<? startblock('content') ?>

    <? $full = "http://".$_SERVER['SERVER_NAME'].url('login?redirect='.@$_GET['redirect']) ?>

    <h3><?= _t("Login") ?></h3>
    <section>
        <form>
            <fieldset style="max-width: 600px"> 
                <p>
                    <?= _t("You can get an account on this site, if you have an account in the popular social networks or services. Select the authentication method below. If you already went this way on this site, you already have an account.") ?>
                </p>

                <script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
                <iframe src="http://loginza.ru/api/widget?overlay=loginza&lang=<?=(bingo_get_locale()=="ru_RU")?"ru":"en"?>&token_url=<?=$full?>" style="display:block;margin:0 auto;width:359px;height:300px;" scrolling="no" frameborder="no"></iframe>
            </fieldset>            
        </form>
    </section>

<? endblock() ?>