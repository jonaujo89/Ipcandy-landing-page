<? $full = "http://".$_SERVER['SERVER_NAME'].url('login?redirect='.@$_GET['redirect']) ?>

<h3><?= _t("Register") ?></h3>
<section>
    <form>
        <fieldset style="max-width: 600px"> 
            <p>
                Вы можете получить учетную запись на этом сайте, если у вас есть учетная запись в популярных социальных сетях
                или сервисах. Выберите способ авторизации ниже. Если вы уже заходили подобным образом на этом сайте, то
                у вас уже есть учетная запись.
            </p>

            <script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
            <iframe src="http://loginza.ru/api/widget?overlay=loginza&lang=ru&token_url=<?=$full?>" style="display:block;margin:0 auto;width:359px;height:200px;" scrolling="no" frameborder="no"></iframe>
        </fieldset>
    </form>
</section>