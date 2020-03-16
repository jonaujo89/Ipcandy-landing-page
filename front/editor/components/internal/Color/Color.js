require("./Color.tea");
const {Combo} = require("../Combo/Combo");

class Color extends Combo {
    tpl_item(item) {
        return html`
            <div 
                class="lp-color-panel-item" 
                style="background-color:${item.color || item.value}"
            />
        `;
    }
}

class BlockColor extends Color {}
BlockColor.defaultProps = {
    items: [
        { value: "#FFFFFF" },
        { value: "#F7F7F7" }
    ]       
}

exports.Color = Color;
exports.BlockColor = BlockColor;