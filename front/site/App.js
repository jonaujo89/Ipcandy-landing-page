require("./lib");
require("./../editor");

const {Link} = require("components/Link/Link");
const {Home,Login,PageList,PageCreate,PageEdit,PageDesign,Profile} = require("pages");

class App extends Component {

    static run(options) {
        document.addEventListener("DOMContentLoaded",()=>{
            preact.render(preact.h(this,options),document.body);
        });
    }

    static fetchApi(path,data,cb) {
        let formData = new FormData();
        for (var key in data) formData.append(key,data[key]);
        fetch(config.base_url+"/api/"+path,{ method:"POST", body: formData}).then((resp)=>{resp.json().then(cb)});
    }

    static redirect(to) {
        if (App.instance.state.route==to) return;
        App.instance.setState({route:to});
        window.history.pushState({route:to},"",config.base_url+"/"+to);
    }

    constructor(props) {
        super(props);
        this.constructor.instance = this;
        for (var key in props) config[key] = props[key];
        App.fetchApi("user",{},(res)=>{
            this.routeToState();
            this.setState({
                user: res.user,
                loaded: true
            });
        });
        window.onpopstate = this.routeToState.bind(this);
    }

    routeToState() {
        if (location.href.indexOf(config.base_url)==0) {
            this.setState({
                route: location.href.substring(config.base_url.length).replace(/^\/|\/$/g, '')
            });
        }
    }

    render(_,{route,loaded,user}) {
        let m;
        if (!loaded) return html`<div />`;

        if (user && route=='login') return App.redirect("");
        if (!user && route!='login') return App.redirect("login");

        if (route=="") return html`<${Home} />`
        if (route=="login") return html`<${Login} />`
        if (route=="page-list") return html`<${PageList} />`
        if (route=="page-create") return html`<${PageCreate} />`
        if (m = route.match(/page\-child\-create\/(\d+)/)) return html`<${PageEdit} parent_id=${m[1]} />`
        if (m = route.match(/page\-edit\/(\d+)/)) return html`<${PageEdit} id=${m[1]} />`
        if (m = route.match(/page\-design\/(\d+)/)) return html`<${PageDesign} id=${m[1]} />`
        if (m = route.match(/page\-view\/(\d+)/)) return html`<${PageDesign} viewOnly=${true} id=${m[1]} />`
        if (route=="profile") return html`<${Profile} />`
    }
};

window.SiteApp = App;
exports.App = App;