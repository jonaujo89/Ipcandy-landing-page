require("./Combo.tea");
const Editable = require("../editable");

class Combo extends Editable {
    tpl(props,state) {
        this.items = this.items || (props.items.call ? props.items.call(this) : props.items);
        return html`
            <div class="lp-panel" style=${{background:props.background}}>
                ${ this.items.map((item)=> html`
                    <div 
                        class="lp-panel-item ${(state.prevValue==item.value || (!state.prevValue && this.value==item.value)) ? "lp-selected":""}"
                        onClick=${()=>{
                            this.setState({prevValue:undefined});
                            this.setValue(item.value);
                        }}
                        onMouseEnter=${()=>{
                            this.setState({prevValue:this.value});
                            if (this.value!=item.value) this.setValue(item.value);
                        }}
                        onMouseLeave=${()=>{
                            if (state.prevValue && state.prevValue!=this.value) this.setValue(state.prevValue);
                            this.setState({prevValue:undefined});
                        }}
                    >
                        ${this.tpl_item(item)}
                    </div>
                `)}
            </div>
        `;
    }

    tpl_item(item) {
        return html`${item.value}`;
    }
}
Combo.defaultProps = {
    items: [],
    background: ""
};

exports.Combo = Combo;