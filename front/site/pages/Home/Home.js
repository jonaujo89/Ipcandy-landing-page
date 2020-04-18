require("./Home.tea");
const {Layout} = require("../Layout/Layout");

const Home = function (props) {

    if (config.home_page_id) {
        preact.hooks.useEffect(()=>SiteApp.fetchApi(
            "page-view",
            {id:config.home_page_id},
            (res)=> { Home.blocks=res; this.setState({}); }
        ),[]);
    };

    return html`
        <${Layout} class="page-wrapper-home">
            ${Home.blocks && html`
                <${Editor} blocks=${Home.blocks} viewOnly=${true} />
            `}        
        <//>
    `;
}
exports.Home = Home;