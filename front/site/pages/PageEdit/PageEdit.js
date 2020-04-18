const {Layout} = require("../Layout/Layout");
const {Link} = require("../../components/Link/Link");
const {Text,TextArea} = require("../../components/Form/Form");
const {ApiForm} = require("../../components/ApiForm/ApiForm");

exports.PageEdit = (props) => {
    [page,setPage] = preact.hooks.useState(false);
    return html`
        <${Layout} 
            onLoad=${()=>{
                if (props.id) {
                    SiteApp.fetchApi("page",{id:props.id},setPage);
                } else {
                    setPage({parent_id:props.parent_id});
                }
            }}
            title=${props.id ? _t('Edit page') : _t('Create page')}
        >
            ${page && html`
                <${ApiForm}
                    value=${page}
                    href="page-save"
                    onSuccess=${()=>SiteApp.redirect("page-list")}
                >
                    <section>
                        <div class="form-field">
                            <label>${_t('Title')}</label>
                            <${Text} name="title" />
                        </div>
                        ${ !page.parent_id && html`
                            <div class="form-field">
                                <label>${_t('Domain')}</label>
                                <${Text} name="domain" />
                            </div>
                        `}
                        ${ page.parent_id && html`
                            <div class="form-field">
                                <label>${_t('Path relative to parent')}</label>
                                <${Text} name="pathname" />
                            </div>
                        `}
                        <div class="form-field">
                            <label>${_t('Meta tag "robots" content')}</label>
                            <${TextArea} rows="5" name="meta_robots" />
                        </div>                        
                        <div class="form-field">
                            <label>${_t('Meta tag "keywords" content')}</label>
                            <${TextArea} rows="5" name="meta_keywords" />
                        </div>                        
                        <div class="form-field">
                            <label>${_t('Meta tag "description" content')}</label>
                            <${TextArea} rows="5" name="meta_description" />
                        </div>                        
                    </section>
                    <section>
                        <button type="submit">${_t('Save page')}</button>
                    </section>
                </form>
            `}
        <//>
    `;
}