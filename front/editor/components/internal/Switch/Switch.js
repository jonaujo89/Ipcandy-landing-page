require("./Switch.tea");
const {Editable} = require("../Editable/Editable");

const Switch = Editable((props)=>html`<div>
    <label class="lp-switch">
        <input type="checkbox" checked=${props.value||false} onClick=${()=>props.onChange(!props.value)}/>
        <span class="lp-switch-slider"></span>
        <span class="lp-switch-label">${props.label || ""}</span>
    </label>        
</div>`);

exports.Switch = Switch;