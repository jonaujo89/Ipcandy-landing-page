require('./CartFloat.tea');
const {Link} = require('../Link/Link');

exports.CartFloat = ({productsCount}) => {
    return html`
        <${Link} href="shop/cart" class="cart-float">
            <div class="cart-float-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="cart-float-count">
                ${productsCount}
            </div>
        <//>
    `;
}