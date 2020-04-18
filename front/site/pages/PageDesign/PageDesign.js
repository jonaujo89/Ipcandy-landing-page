const {LayoutHeader} = require("../Layout/Layout");

exports.PageDesign = (props) => {
    [blocks,setBlocks] = preact.hooks.useState(false);
    preact.hooks.useEffect(()=>SiteApp.fetchApi(props.viewOnly ? "page-view":"page-design",{id:props.id},setBlocks),[])
    
    if (!blocks) return;
    return html`
        ${!props.viewOnly && html`<${LayoutHeader} />`}
        <${Editor} blocks=${blocks} viewOnly=${props.viewOnly} ajaxUrl=${"api/page-editor/"+props.id} />
    `;
}