require("./Background.tea");
const {Combo} = require("../Combo/Combo");
const {Editable} = require("../Editable/Editable");

const Background = (props) => preact.h(Combo,{...props,
    tpl_item: (item) => { 
        return html`
            <div 
                class="lp-background-panel-item" 
                style=${{
                    width: props.itemWidth+"px",
                    height: props.itemHeight+"px",
                    background: item.value.color || ("url('"+(config.base_url + "/" + (item.value.url || item.thumb || item.value))+"')"),
                    backgroundSize: "cover",
                    backgroundPosition: "auto 100%"
                }}
            />
        `
    }
});

const TextureBackground = (props) => preact.h(Background,{...props});
TextureBackground.defaultProps = {
    dropdown: false,
    preview: true,
    itemWidth: 50,
    itemHeight: 50,
    items: function () {
        var items = [];
        items.push(
            { value: {color:"#313138"} },
            { value: {color:"#24242A"} }
        );
        for (var i=1;i<=3;i++) {
            items.push({
                value: {url:config.assets_url+"/texture_black/"+i+".jpg"},
            });
        }                        
        return items;
    }
}

exports.Background = Background;
exports.TextureBackground = TextureBackground;