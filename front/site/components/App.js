require("./../../editor");

const {Link} = require("Link/Link");
const {Home,Login,PageList,PageCreate,PageEdit,PageDesign,Profile} = require("../pages");
const {Entity} = require("../Entity");

class App extends Component {

    static fetchApi(path,data,cb) {
        let formData;
        if (data instanceof FormData) {
            formData = data;
        } else {
            formData = new FormData();
            for (var key in data) {
                if (Array.isArray(data[key])) {
                    data[key].forEach(val => formData.append(key+"[]", val));
                } else {
                    formData.append(key,data[key]);
                }
            }
        }
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

        if (route=="login") return html`<${Login} />`
        if (route=="page-list") return html`<${PageList} />`
        if (route=="page-create") return html`<${PageCreate} />`
        if (m = route.match(/page\-child\-create\/(\d+)/)) return html`<${PageEdit} parent_id=${m[1]} />`
        if (m = route.match(/page\-edit\/(\d+)/)) return html`<${PageEdit} id=${m[1]} />`
        if (m = route.match(/page\-design\/(\d+)/)) return html`<${PageDesign} id=${m[1]} />`
        if (m = route.match(/page\-view\/(\d+)/)) return html`<${PageDesign} viewOnly=${true} id=${m[1]} />`
        if (route=="profile") return html`<${Profile} />`
        if (Entity.list[route]) {
            let Cls = Entity.list[route];
            if (Cls.listComponent) return html`<${Cls.listComponent} entity=${Cls} />`;
        }
        if (m = route.match(/(\w+)\/edit(\/(\d+))?/)) {
            if (Entity.list[m[1]]) {
                let Cls = Entity.list[m[1]];
                if (Cls.formComponent) return html`<${Cls.formComponent} id=${m[3]} entity=${Cls} />`;
            }
        }
        return html`<${Home} />`
    }
};

window.SiteApp = App;
exports.App = App;