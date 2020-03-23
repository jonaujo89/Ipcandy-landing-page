require("./Background.tea");
const {Combo} = require("../Combo/Combo");
const {Editable} = require("../Editable/Editable");

const Background = (props) => preact.h(Combo,{...props,
    preview: false,
    dropdown: true,
    tpl_item: (item) => html`
        <div 
            class="lp-background-panel-item" 
            style=${{
                width: props.itemWidth+"px",
                height: props.itemHeight+"px",
                backgroundImage: "url('"+(base_url + "/" + (item.thumb || item.value))+"')"
            }}
        />
    `
});

exports.Background = Background;