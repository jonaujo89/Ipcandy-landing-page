require("Layout.tea");
const {Link} = require("../../components/Link/Link");
const {Entity} = require("../../Entity");

const LayoutHeader = () => {
    let user = SiteApp.instance.state.user;
    return html`
        <div class="page-header">
            ${!!user && html`
                <${Link} class="home" href='page-list' />
                ${" "}
                <${Link} href="profile">${user.name}<//>${" | "}
                <${Link} 
                    onClick=${(e)=>{
                        e.preventDefault();
                        SiteApp.fetchApi("user-logout",{},(user)=>SiteApp.instance.setState({user}));
                    }}
                    href="logout"
                >
                    ${_t('Logout')}
                <//>
            `}
            ${!user && html`<${Link} href="login">${_t('Login')}<//>`}
        </div>
    `;
}

const Layout = class Layout extends Component {
    componentDidMount() {
        this.props.onLoad && this.props.onLoad();
    }

    render(props) {
        const {title,actions,children} = props;
        let user = SiteApp.instance.state.user;
        return html`
            <${LayoutHeader} />
            <div class="page-menu">
                <ul>
                    <li><${Link} id="logo" href="">LPCandy<//></li>
                    ${user && html`
                        <li><${Link} href="page-list">${_t('Pages')}<//></li>
                        <li><${Link} href="profile">${_t('Profile')}<//></li>
                        <li><${Link} href="shop">${_t('Shop')}<//></li>
                        ${ Object.entries(Entity.list).map(([id,Cls])=>{
                            if (!Cls.menuLabel) return;
                            return html`<li><${Link} href=${id}>${Cls.menuLabel}<//></li>`;
                        })}
                    `}
                </ul>
            </div>
            <div class="page-wrapper ${props['class'] || ''}">
                ${title && html`
                    <div class='page-title'>
                        ${title}
                        ${actions && html`
                            <span class="page-actions">
                                ${Object.entries(actions).map(([url,label])=>html`
                                    <${Link} class="button" href=${url}>${label}<//>
                                `)}
                            </span>
                        `} 
                    </div>                
                `}         
                <div class="page-content">  
                    ${props.loading && html`<div class="page-content-loading" />`}
                    ${children}
                </div>
                <div class="page-footer">
                    <a class="beejee-info" href="http://beejee.ru" target="_blank">
                        <span>BeeJee's design lair</span>
                        <p>        
                            ${_t("LPCandy is developed by")} <span>BeeJee</span><br />
                            <span>BeeJee</span> ${_t("is looking for mind-blowing project")}
                        </p>    
                    </a>                    
                </div>
            </div>
        `;
    }
}

exports.Layout = Layout;
exports.LayoutHeader = LayoutHeader;