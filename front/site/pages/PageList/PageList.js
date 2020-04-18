require("./PageList.tea");
const {Layout} = require("../Layout/Layout");
const {Link} = require("../../components/Link/Link");

const PageItem = ({page,parent,onDelete}) => html`
    <section class="page-item ${parent ? "page-item-child" : ""}">
        <div class="page-item-preview">
            <img width="200" src=${page.screenshot_url} />
        </div>
        <div class="page-item-description">
            <h3>
                ${ page.title + " " }
                <${Link} href="page-view/${page.id}" target="_blank">${_t('(page preview)')}<//>
            </h3>
            ${!parent && html`
                ${ page.domain || _t("No domain assigned") }
            `}
            ${!!parent && page.pathname}
            <br />
            ${!parent && html`
                <${Link} href="page-child-create/${page.id}">${_t('+ add child page')}<//>
            `}
            <div class="page-item-actions">
                <${Link} class="design button" href="page-design/${page.id}">${_t('Launch Designer')}<//>
                ${" "}
                <${Link} class="edit button" href="page-edit/${page.id}">${_t('Edit')}<//>
                ${" "}
                <${Link} 
                    class="delete button" 
                    onClick=${(e)=>{
                        e.preventDefault();
                        SiteApp.fetchApi("page-delete",{id:page.id},onDelete);
                    }} 
                    href="page-delete/${page.id}">${_t('Delete')}
                <//>
            </div>
        </div>
    </section>
    ${ !parent && page.children.map((sub)=>html`
        <${PageItem} page=${sub} parent=${page} onDelete=${onDelete} />
    `)}
`;

exports.PageList = function(props) {
    [pages,setPages] = preact.hooks.useState(false);
    const load = () => SiteApp.fetchApi("page-list",{},setPages);

    return html`
        <${Layout} 
            onLoad=${load}
            title=${_t('Pages')}
            actions=${{
                'page-create' : _t('Create New Landing Page')
            }}
        >
            <div class="page-list">
                ${(pages && pages.length>0) && pages.map((page)=>html`
                    <${PageItem} page=${page} onDelete=${load} />
                `)}
                ${(pages && !pages.length) && html`
                    <div class="message">
                        ${_t('No pages yet')}
                    </div>
                `}
            </div>
        <//>
    `;
}