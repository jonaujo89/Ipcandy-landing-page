const {Layout} = require("../Layout/Layout");
const {Text} = require("../../components/Form/Form");
const {ApiForm} = require("../../components/ApiForm/ApiForm");

exports.Profile = (props) => {
    return html`
        <${Layout} title=${_t('User profile')} >
            <${ApiForm}
                value=${SiteApp.instance.state.user}
                href="user-save"
                onSuccess=${({user})=>SiteApp.instance.setState({user})}
            >
                <section>
                    <div class="form-field">
                        <label>${_t('Email for notifications')}</label>
                        <${Text} name="email" />
                    </div>
                </section>
                <section>
                    <button type="submit">${_t('Save')}</button>
                </section>
            </form>
        <//>
    `;
}