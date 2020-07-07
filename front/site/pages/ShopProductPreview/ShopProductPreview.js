const {Block} = require("../../../editor/components/internal/Block/Block");
const {LayoutHeader} = require("../Layout/Layout");
const {Shop} = require("../Shop/Shop");

class ShopProductPreview extends Component {
    constructor(props) {
        super(props);
        this.state = {
            product: false,
        }
        this.productWasLoaded = false;
    }

    componentDidMount() {
        SiteApp.fetchApi("product-view",{id:this.props.id},(product) => {
            this.productWasLoaded = Shop.addProductFiles(product);
            this.setState({product: product});
        });
    }

    componentWillUnmount() {
        if (!this.productWasLoaded && !this.props.cart.products.find(one => one.id === this.state.product.id))
            Shop.removeProductFiles(this.state.product);
    }

    render(props, {product, type}) {
        const {cart} = props;

        let typeId;
        let blocks = Object.entries(Block.list).map(([type, cls]) => {
            if (product.js_url && cls.currentScript === product.js_url) return {value: {type: type, id: product.id}};
        }).filter(one => one);

        return html`
            ${!props.viewOnly && html`<${LayoutHeader} />`}
            ${blocks.length > 0 && html`
                <${Editor} 
                    blocks=${blocks}
                    toolbarExtraButtons=${html`
                        ${!product.bought && cart.products && !cart.products.find(one => one.id === product.id) ? html` 
                            <button onClick=${()=>Shop.addProductToCart(product)}><i class="fa fa-shopping-cart" />${_t("Add to cart")}</button> 
                        ` : html` 
                            <button onClick=${()=>SiteApp.redirect('shop/cart')}><i class="fa fa-shopping-cart" />${_t("Go to cart")}</button> 
                        `}
                    `}
                    viewOnly=${false} 
                />
            `}
        `;
    }
}

exports.ShopProductPreview = ShopProductPreview;