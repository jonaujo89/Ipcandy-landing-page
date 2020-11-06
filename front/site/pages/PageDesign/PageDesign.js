const {LayoutHeader} = require("../Layout/Layout");

class PageDesign extends Component {

    constructor(props) {
        super(props);
        this.state = { blocks: false }; 
        this.editorChanged = false;
    }

    componentDidMount() {
        if (this.props.promo) {
            SiteApp.fetchApi("page-design-promo",{},(blocks) => this.setState({ blocks }));

            window.onbeforeunload = e => {
                if (this.editorChanged) {
                    const message = "You have unsaved changes! Please login to save them.";
                    e.returnValue = message;
                    return message;
                }
                return null;
            };

            SiteApp.onBeforeRedirect = (route) => {
                if (route.match(/login/)) {
                    if (this.editorChanged) {
                        localStorage.setItem('promo_page_blocks', JSON.stringify(this.editor.state.blocks));
                    }   
                    return route;
                } else {
                    window.location.reload(false);
                    return false;
                }
            };
        } 
        else {
            SiteApp.fetchApi(this.props.viewOnly ? "page-view":"page-design",{id:this.props.id},(blocks) => this.setState({ blocks }));
        }
    }

    componentWillUnmount() {
        if (this.props.promo) {
            window.onbeforeunload = null;
            SiteApp.onBeforeRedirect = null;
        }
    }

    render(props, { blocks }) {
        if (!blocks) return;

        return html`
            ${!props.viewOnly && html`<${LayoutHeader} />`}
            <${Editor} 
                ref=${(r)=>this.editor=r}
                onChange=${() => this.editorChanged = true}
                blocks=${blocks} 
                viewOnly=${props.viewOnly}
                ajaxUrl=${props.id ? "api/page-editor/"+props.id : false}
                toolbarExtraButtons=${props.promo && html`
                    <button onClick=${() => SiteApp.redirect('login?redirect=page-design-promo') }><i class="fa fa-floppy-o" />${_t("Save")}</button> 
                `} 
            />
        `;
    }
}

exports.PageDesign = PageDesign;