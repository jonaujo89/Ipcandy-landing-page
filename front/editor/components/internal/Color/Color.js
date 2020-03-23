require("./Color.tea");
const {Combo} = require("../Combo/Combo");

const Color = (props) => preact.h(Combo,{...props,
    tpl_item: (item) => html`
        <div 
            class="lp-color-panel-item" 
            style="background-color:${item.color || item.value};width:${props.iconSize}px;height:${props.iconSize}px;"
        />
    `
})
Color.defaultProps = {
    iconSize: 30
}

const ButtonColor = (props) => preact.h(Color,{...props,
    iconSize: 15,
    items: [
        { value: 'blue', color: '#0187BC' },
        { value: 'green', color: '#3E9802' },
        { value: 'orange', color: '#FD6F00' },
        { value: 'purple', color: '#8C33D2' },
        { value: 'purple_light', color: '#9581BF' },
        { value: 'rose', color: '#F372A4' },
        { value: 'red', color: '#CE0707' },
        { value: 'yellow', color: '#FFC415' }
    ]
})


const BlockColor = (props) => preact.h(Color,{...props,
    items: [
        { value: "#FFFFFF" },
        { value: "#F7F7F7" }
    ]
})

const DarkBlockColor = (props) => preact.h(Color,{...props,
    items: [
        { value: "#313138"},
        { value: "#143A4F"},
        { value: "#19678B"},
        { value: "#4E6D8D"},
        { value: "#607FA4"},
        { value: "#0E93B3"},
        { value: "#1E4147"},
        { value: "#198B82"},
        { value: "#0C884A"},
        { value: "#393458"},
        { value: "#583458"},
        { value: "#614C8A"},
        { value: "#8C0C24"},
        { value: "#593D36"}      
    ]
})

exports.Color = Color;
exports.ButtonColor = ButtonColor;
exports.BlockColor = BlockColor;
exports.DarkBlockColor = DarkBlockColor;