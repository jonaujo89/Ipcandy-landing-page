require("./ShopProduct.tea");
const {Layout} = require("../Layout/Layout");
const {CartFloat} = require("../../components/CartFloat/CartFloat");
const {Link} = require("../../components/Link/Link");
const {Shop} = require("../Shop/Shop");

exports.ShopProduct = function (props) {
    const [loading, setLoading] = preact.hooks.useState(false);
    const [product, setProduct] = preact.hooks.useState(false);

    return html`
        <${Layout} 
            loading=${!product || loading}
            onLoad=${() => SiteApp.fetchApi("product-view",{id: props.id},(res)=>setProduct(res))}
            title=${product.title}
        >
            <${CartFloat} productsCount=${props.cart.count} />
            ${product && html`
                <div class="shop-product">
                    <div class="shop-product-header">
                        <div class="shop-product-thumbnail">
                            <img src=${product.thumbnail} />
                        </div>
                        <div class="shop-product-info">
                            <div class="shop-product-title">
                                ${product.title}
                            </div>
                            <div class="shop-product-price">
                                ${product.price + "$"}
                            </div>
                            <div class="shop-product-excerpt">
                                ${product.excerpt}
                            </div>
                            <div class="shop-product-actions">
                                ${ product.isBought ? html`
                                    <button class="shop-product-button button" disabled>${_t('Bought')}</button>
                                ` : props.cart.products && !props.cart.products.find(one => one.id === product.id) ? html `
                                    <button class="shop-product-button button" onClick=${() => {
                                        setLoading(true);
                                        Shop.addProductToCart(product, () => setLoading(false));
                                    }}>${_t('Add to cart')}</button>
                                ` : html`
                                    <button class="shop-product-button button" onClick=${() => {
                                        setLoading(true);
                                        Shop.removeProductFromCart(product, () => setLoading(false));
                                    }}>${_t('Remove from cart')}</button>
                                `}
                                
                                <${Link} class="shop-product-button button" href="shop/component-preview/${product.id}">${_t('View demo')}<//>
                            </div>
                        </div>
                    </div>
                    ${product.description && html`
                        <div class="shop-product-description" dangerouslySetInnerHTML=${{__html: product.description}} />
                    `}
                </div>
            `}
        <//>
    `;
};