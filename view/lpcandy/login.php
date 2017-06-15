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

                <script src="//ulogin.ru/js/ulogin.js"></script>
                <? $redirect_url = '//'.$_SERVER['HTTP_HOST'].url('login') ?>
                <div id="uLogin" data-ulogin="redirect_uri=<?=urlencode($redirect_url)?>;display=panel;theme=classic;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;mobilebuttons=0;"></div>
            </fieldset>            
        </form>
    </section>

<? endblock() ?>