const Link = (props) => {
    var cls = ((props.class || "")+(SiteApp.instance.state.route===props.href ? " active":"")).trim();
    return html`<a 
        href="#"
        onClick=${(e)=>{
            e.preventDefault();
            SiteApp.redirect(props.href);
        }} 
        ...${props}
        class=${cls}
    />`;
}

exports.Link = Link;
