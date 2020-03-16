require("./Switch.tea");
const Editable = require("../editable");

class Switch extends Editable {
    tpl(props,state) {
        return html`
            <label class="lp-switch">
                <input type="checkbox" checked=${this.value||false} onClick=${()=>this.setValue(!this.value)}/>
                <span class="lp-switch-slider"></span>
                <span class="lp-switch-label">${props.label}</span>
            </label>        
        `;
    }
}
Switch.defaultProps = {
    label: ""
}

exports.Switch = Switch;