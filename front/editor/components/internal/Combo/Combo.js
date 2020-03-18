require("./Combo.tea");
const {Editable} = require("../Editable/Editable");

class Combo extends preact.Component {
    render(props,state) {
        this.items = this.items || (props.items.call ? props.items.call(this) : props.items);
        return html`
            <div class="lp-panel" style=${{background:props.background}}>
                ${ this.items.map((item)=> html`
                    <div 
                        class="lp-panel-item ${(state.prevValue==item.value || (!state.prevValue && props.value==item.value)) ? "lp-selected":""}"
                        onClick=${()=>{
                            this.setState({prevValue:undefined});
                            props.onChange(item.value);
                        }}
                        onMouseEnter=${()=>{
                            this.setState({prevValue:props.value});
                            if (props.value!=item.value) props.onChange(item.value);
                        }}
                        onMouseLeave=${()=>{
                            if (state.prevValue && state.prevValue!=props.value) props.onChange(state.prevValue);
                            this.setState({prevValue:undefined});
                        }}
                    >
                        ${props.tpl_item(item)}
                    </div>
                `)}
            </div>
        `;
    }
};

Combo.defaultProps = { 
    items: [],
    background: ""
}
Combo = Editable(Combo);


exports.Combo = Combo;