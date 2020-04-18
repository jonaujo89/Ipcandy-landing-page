require("./PageCreate.tea");
const {Layout} = require("../Layout/Layout");
const {Link} = require("../../components/Link/Link");
const {Text,Radio} = require("../../components/Form/Form");
const {ApiForm} = require("../../components/ApiForm/ApiForm");

exports.PageCreate = (props) => {
    [templates,setTemplates] = preact.hooks.useState(false);
    return html`
        <${Layout} 
            onLoad=${()=>SiteApp.fetchApi("page-templates",{},setTemplates)}
            title=${_t('Create page')}
        >
            ${templates && html`
                <${ApiForm}
                    value=${{
                        title: "",
                        domain: "",
                        template: templates.length ? templates[0].id : 0
                    }}
                    href="page-save"
                    onSuccess=${()=>SiteApp.redirect("page-list")}
                >
                    <section>
                        <div class="form-field">
                            <label>${_t('Title')}</label>
                            <${Text} name="title" />
                        </div>
                        <div class="form-field">
                            <label>${_t('Domain')}</label>
                            <${Text} name="domain" />
                        </div>

                        <label>${_t('Template')}</label>
                        <div class="page-create-template-list">
                            <label>
                                <img src=${config.base_url+"/assets/images/no-screenshot.png"} />
                                <${Radio} name="template" value=${0} />
                                ${_t('Start from scratch')}
                            </label>
                            ${templates.map((page)=>html`
                                <label>
                                    <img src=${page.screenshot_url} />
                                    <${Radio} name="template" value=${page.id} />
                                    ${page.title}
                                </label>                            
                            `)}
                        </div>
                    </section>
                    <section>
                        <button type="submit">${_t('Create page')}</button>
                    </section>
                <//>
            `}
        <//>
    `;
}