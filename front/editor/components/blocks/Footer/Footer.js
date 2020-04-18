require("./Footer.tea");

const {Block,Text,Logo,BlockColor,Switch,Dialog} = require("../../internal");

class Footer extends Block {

    static get title() { return _t('Footer') }
    static get description() { return _t('The final block') }

    configForm() {
        return html`
            <${Dialog}>
                <${Switch} name="show_policy" label="${_t("Show policy")}" showWhen=${{variant:[1]}} />
                <label value=${_t("Background color:")} />
                <${BlockColor} name="background_color" />
            <//>
        `;
    }

    tpl_1(val) {
        return html`
        <div class="container-fluid footer footer_1" style="background: ${val.background_color}">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <${Logo} name="logo" />
                    </div>
                    <div class="col-4">
                        <div class="desc">
                            <${Text} name="desc" options=${Text.default_text} />
                        </div>
                        ${ val.show_policy && html`
                            <div class="policy_wrap">
                                <a class="policy" href="#" onClick=${(e)=>{e.preventDefault();this.policyDialog.open()}}>${_t("Information policy")}</a>
                                <${Dialog} ref=${(r)=>this.policyDialog=r} class="policy_dialog" scrollable=${true} overlayColor="rgba(0,0,0,0.5)">
                                    <div class="policy_info">
                                        <${Text} name="policy_info" options=${Text.size_text} />
                                    </div>
                                <//>   
                            </div>
                        `}
                    </div>
                    <div class="col-4 before-1">
                        <div class="phone">
                            <${Text} name="phone" options=${Text.default_heading} />
                        </div>
                        <div class="phone_desc">
                            <${Text} name="phone_desc" options=${Text.default_text} />
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    `
    }

    tpl_default_1() {
        return config.language == 'en' ? {
            'show_policy': true,
            'background_color': '#FFFFFF',
            'logo': {...Logo.tpl_default(), 'size': 87 },
            'desc': "The best circus «One and the same are at the circus ring»,<br>Moscow, Color Blvd., 13",
            'phone': '+7 (495) 321-46-98',
            'phone_desc': 'Free call from Venus',
            'policy_info': `
                <h2>Privacy Policy</h2>
                <p>This privacy policy discloses the privacy practices for lpcandy.ru. This privacy policy applies solely to information collected by this web site.</p>
                <p>It will notify you of the following:</p>
                <ul>
                <li>What personally identifiable information is collected from you through the web site, how it is used and with whom it may be shared.</li>
                <li>What choices are available to you regarding the use of your data.</li>
                <li>The security procedures in place to protect the misuse of your information.</li>
                </ul>
                <p>How you can correct any inaccuracies in the information.</p>
                <h3>Information Collection, Use, and Sharing</h3>
                <p>We are the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via email or other direct contact from you. We will not sell or rent this information to anyone.</p>
                <p>We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. to ship an order.</p>
                <p>Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.</p>
                <h3>Your Access to and Control Over Information</h3> 
                <p>You may opt out of any future contacts from us at any time. You can do the following at any time by contacting us via the email address or phone number given on our website:<p>
                <ul>
                <li>See what data we have about you, if any.</li>
                    <li>Change/correct any data we have about you.</li>
                <li>Have us delete any data we have about you.</li>
                <li>Express any concern you have about our use of your data.</li>
                </ul>
                <h3>Security</h3> 
                <p>We take precautions to protect your information. When you submit sensitive information via the website, your information is protected both online and offline.</p>
                <p>Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a closed lock icon at the bottom of your web browser, or looking for "https" at the beginning of the address of the web page.</p>
                <p>While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.</p>
                <h3>Updates</h3>
                <p>Our Privacy Policy may change from time to time and all updates will be posted on this page.</p>
                <p>If you feel that we are not abiding by this privacy policy, you should contact us immediately via email.</p>
            `,
        } : {
            'show_policy': true,
            'background_color': '#FFFFFF',
            'logo': {...Logo.tpl_default(), 'size': 87 },
            'desc': "Лучший цирк «НА МАНЕЖЕ ВСЕ ТЕ ЖЕ»,<br>г.Москва, Цветной бульвар, 13",
            'phone': '+7 (495) 321-46-98',
            'phone_desc': 'Звонок с Венеры бесплатный',
            'policy_info': `
                <h2>ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ</h2>
                <p>Соблюдение Вашей конфиденциальности важно для нас. По этой причине, мы разработали Политику Конфиденциальности, которая описывает, как мы используем и храним Вашу информацию. Пожалуйста, ознакомьтесь с нашими правилами соблюдения конфиденциальности и сообщите нам, если у вас возникнут какие-либо вопросы.</p>
                <h3>Сбор и использование персональной информации</h3>
                <p>Под персональной информацией понимаются данные, которые могут быть использованы для идентификации определенного лица либо связи с ним.</p>
                <p>От вас может быть запрошено предоставление вашей персональной информации в любой момент, когда вы связываетесь с нами. </p>
                <p>Ниже приведены некоторые примеры типов персональной информации, которую мы можем собирать, и как мы можем использовать такую информацию.</p>
                <h4>Какую персональную информацию мы собираем</h4>
                <ul>
                <li>Когда вы оставляете заявку на сайте, мы можем собирать различную информацию, включая ваши имя, номер телефона, адрес электронной почты и т.д.</li>
                </ul>
                <h4>Как мы используем вашу персональную информацию</h4>
                <ul>
                <li>Собираемая нами персональная информация позволяет нам связываться с вами и сообщать об уникальных предложениях, акциях и других мероприятиях и ближайших событиях. </li>
                <li>Время от времени, мы можем использовать вашу персональную информацию для отправки важных уведомлений и сообщений. </li>
                <li>Мы также можем использовать персональную информацию для внутренних целей, таких как проведения аудита, анализа данных и различных исследований в целях улучшения услуг предоставляемых нами и предоставления Вам рекомендаций относительно наших услуг.</li>
                <li>Если вы принимаете участие в розыгрыше призов, конкурсе или сходном стимулирующем мероприятии, мы можем использовать предоставляемую вами информацию для управления такими программами.</li>
                </ul>
                <h3>Раскрытие информации третьим лицам</h3>
                <p>Мы не раскрываем полученную от Вас информацию третьим лицам. </p>
                <h4>Исключения</h4>
                <p>В случае если необходимо — в соответствии с законом, судебным порядком, в судебном разбирательстве, и/или на основании публичных запросов или запросов от государственных органов на территории РФ — раскрыть вашу персональную информацию. Мы также можем раскрывать информацию о вас если мы определим, что такое раскрытие необходимо или уместно в целях безопасности, поддержания правопорядка, или иных общественно важных случаях.</p>
                <p>В случае реорганизации, слияния или продажи мы можем передать собираемую нами персональную информацию соответствующему третьему лицу – правопреемнику.</p>
                <h3>Защита персональной информации</h3>
                <p>Мы предпринимаем меры предосторожности — включая административные, технические и физические — для защиты вашей персональной информации от утраты, кражи, и недобросовестного использования, а также от несанкционированного доступа, раскрытия, изменения и уничтожения.</p>
                <h3>Соблюдение вашей конфиденциальности на уровне компании</h3>
                <p>Для того чтобы убедиться, что ваша персональная информация находится в безопасности, мы доводим нормы соблюдения конфиденциальности и безопасности до наших сотрудников, и строго следим за исполнением мер соблюдения конфиденциальности.</p>
            `,
        }
    }
}

Block.register('Footer',exports = Footer);
