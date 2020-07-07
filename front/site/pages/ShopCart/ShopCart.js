require('./ShopCart.tea');

const {Shop} = require("../Shop/Shop");
const {Layout} = require("../Layout/Layout");
const {Link} = require("../../components/Link/Link");

exports.ShopCart = function (props) {
    const [loading, setLoading] = preact.hooks.useState(false);
    return html`
        <${Layout} 
            loading=${loading}
            title=${_t('Cart')}
        >
            <div class="shop-cart-page">
                <div class="shop-cart-page-main">
                    <div class="shop-cart-page-actions">
                        <${Link} href="shop" class="button">${_t('Continue shopping')}<//>
                        ${props.cart.count > 0 && html`
                            <button onClick=${() => {
                                setLoading(true);
                                SiteApp.fetchUser('cart-empty',{},() =>{
                                    props.cart.products.forEach(product=>Shop.removeProductFiles(product));
                                    setLoading(false);
                                });
                            }} class="button">${_t('Empty cart')}</button>
                        `}
                    </div>
                    <div class="cart-products">
                        ${props.cart.count > 0 ? html`
                            ${(props.cart.products && props.cart.products.length>0) && props.cart.products.map((product)=>html`
                                <div class="cart-item">
                                    <div class="cart-item-thumb">
                                        <div class="img">
                                            <img src=${product.thumbnail} />
                                        </div>
                                    </div>

                                    <div class="cart-item-content">
                                        <${Link} href="shop/component/${product.id}" class="cart-item-title">${product.title}<//>
                                        <div class="cart-item-description">${product.excerpt}</div>
                                    </div>

                                    <div class="cart-item-remove" onClick=${() => {
                                        setLoading(true);
                                        Shop.removeProductFromCart(product, () => setLoading(false));
                                    }}></div>
                                    <div class="cart-item-price">${product.price + "$"}</div>
                                </div>
                            `)}
                        ` : html`
                            <div class="cart-products-empty">${_t('Your shopping cart is empty.')} <${Link} href="shop">${_t('Continue shopping')}<//> ${_t('to add items to your cart.')}</div>
                        `}
                    </div>
                </div>
                <div class="shop-cart-page-sidebar">
                    <div class="cart-total">
                        <div class="cart-total-title">
                            ${_t('Your cart total')}
                        </div>
                        <div class="cart-total-price">
                            ${props.cart.total + "$"}
                        </div>
                        ${props.cart.count > 0 && html`
                            <div class="cart-total-action">
                                <button class="button checkout" onClick=${() => Shop.checkout()}>${_t('Secure Checkout')}</button>
                            </div>
                        `}
                    </div>
                </div>
            </div>
        <//>
    `;
};