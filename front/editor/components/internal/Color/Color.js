require("./Color.tea");
const {Combo} = require("../Combo/Combo");

const Color = (props) => preact.h(Combo,{...props,
    tpl_item: (item) => html`
        <div 
            class="lp-color-panel-item" 
            style="background-color:${item.color || item.value}"
        />
    `
})

const BlockColor = (props) => preact.h(Color,{...props,
    items: [
        { value: "#FFFFFF" },
        { value: "#F7F7F7" }
    ]
})

exports.Color = Color;
exports.BlockColor = BlockColor;