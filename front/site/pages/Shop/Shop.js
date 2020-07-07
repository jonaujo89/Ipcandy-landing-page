require("./Shop.tea");
const {Block} = require("../../../editor/components/internal/Block/Block");
const {Entity} = require("../../Entity");
const {Layout} = require("../Layout/Layout");
const {Link}   = require("../../components/Link/Link");
const {Pagination}   = require("../../components/Pagination/Pagination");
const {CartFloat} = require("../../components/CartFloat/CartFloat");

class Shop extends Component {
    constructor(props) {
        super(props);
        this.state = {
            loading: false,
            pagination: false
        }
        this.load = this.load.bind(this);
    }

    load(pageNumber) {
        SiteApp.fetchApi("product-list",{ p: pageNumber },(newPagination)=>this.setState({pagination: newPagination}));
    }

    componentDidMount() {
        this.load(1);
    }

    static addProductToCart(product, cb) {
        SiteApp.fetchUser('cart-add',{id: product.id},()=>{
            Shop.addProductFiles(product);
            cb && cb();
        });
    };

    static removeProductFromCart(product, cb) {
        SiteApp.fetchUser('cart-remove',{id: product.id},()=>{
            Shop.removeProductFiles(product);
            cb && cb();
        });
    };

    static checkout() {
        SiteApp.fetchApi('payment-redirect', {}, ({redirect_url}) => window.location = redirect_url);
    };

    static addProductFiles(product) {
        let script = document.querySelector(`script[src="${product.js_url}"]`);
        if (!script) {
            script = document.createElement('script');
            script.src = product.js_url;
            document.head.appendChild(script);
            script.onload = scriptLoaded;
            script.setAttribute('initiallyLoaded', false);
        } else {
            lpcandyRun.afterRunList.forEach(one => {
                if (one.currentScript = product.js_url) {
                    lpcandyRun.currentScript = one.currentScript;
                    one.f();
                }
            });
            scriptLoaded();
        }

        let styles = document.querySelector(`link[href="${product.css_url}"]`); 
        if (!styles) {
            let styles = document.createElement('link');
            styles.href = product.css_url;
            styles.rel = 'stylesheet';  
            styles.type = 'text/css'; 
            document.head.appendChild(styles);
        } else {
            styles.disabled = false;
        }

        function scriptLoaded() {
            SiteApp.instance.setState({});
        }
        
        return script.getAttribute('initiallyLoaded') !== "false";
    }

    static removeProductFiles(product) {
        let stylesEl = document.querySelector(`link[href="${product.css_url}"]`); 
        stylesEl.disabled = true;

        for (let typeId in Block.list)
            if (Block.list[typeId].currentScript === product.js_url) 
                delete Block.list[typeId];

        for (let typeId in Entity.list) 
            if (Entity.list[typeId].currentScript === product.js_url)
                delete Entity.list[typeId];

        SiteApp.instance.setState({});
    }

    render(props, {pagination, loading}) {
        return html`
            <${Layout} 
                loading=${!pagination || loading}
                onLoad=${this.load}
                title=${_t('Shop')}
            >
                <${CartFloat} productsCount=${props.cart.count} />
                <div class="shop-list">
                    ${pagination && pagination.list.map((product)=>html`
                        <div class="shop-item">
                            <div class="shop-item-wrap">
                                <div class="shop-item-thumbnail">
                                    <img src=${product.thumbnail} />
                                </div>
                                <div class="shop-item-data">
                                    <div class="shop-item-info">
                                        <div class="shop-item-title">
                                            <${Link} href="shop/component/${product.id}">
                                                ${product.title}
                                            <//>
                                        </div>
                                        <div class="shop-item-price">
                                            ${product.price + "$"}
                                        </div>
                                    </div>
                                    <div class="shop-item-excerpt">
                                        ${product.excerpt}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)}
                </div>
                ${pagination && html`
                    <${Pagination} 
                        pageNumber=${pagination.pageNumber} 
                        pageCount=${pagination.pageCount} 
                        onPage=${(i)=> this.load(i)} 
                    />
                `}
            <//>
        `;
    }
};
exports.Shop = Shop;