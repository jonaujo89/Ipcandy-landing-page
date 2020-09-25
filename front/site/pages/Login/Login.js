const {Layout} = require("../Layout/Layout");

exports.Login = ({redirect = ''}) => {
    let redirect_url = config.base_url+"/api/user-login" + (redirect ? '?redirect='+redirect : '');
    return html`
        <${Layout} title=${_t('Login')}>
            <section>
                <p>
                    ${_t("You can get an account on this site, if you have an account in the popular social networks or services. Select the authentication method below. If you already went this way on this site, you already have an account.")}
                </p>
                <br />
                <script src="//ulogin.ru/js/ulogin.js"></script>
                <div 
                    id="uLogin" 
                    data-ulogin="redirect_uri=${encodeURIComponent(redirect_url)};display=panel;theme=classic;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;mobilebuttons=0;"
                />
            </section>
        <//>
    `;
}