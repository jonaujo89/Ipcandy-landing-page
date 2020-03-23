require("./Combo.tea");
const {Editable} = require("../Editable/Editable");

class Combo extends preact.Component {

    componentDidMount() {
        if (this.props.dropdown) {
            $(document).mousedown((e)=>{
                if (e.which!=1) return;
                var meClick = false;
                $(e.target).parents().andSelf().each((i,item)=>{
                    if (item==this.button || item==this.panel) meClick = true;
                })
                if (!meClick) this.setState({is_open:false});
            }); 
        }       
    }

    toggle() {
        this.setState({is_open:!this.state.is_open},()=>{
            if (this.state.is_open) {
                var rect = this.button.getBoundingClientRect();
                var panelPos = {left:rect.left,top:rect.top+rect.height};

                var prect = this.panel.getBoundingClientRect();
                var dw = document.documentElement.clientWidth;
                var dh = document.documentElement.clientHeight;

                if (panelPos.top+prect.height > dh) panelPos.top = dh - prect.height;
                if (panelPos.left+prect.width > dw) panelPos.left = dw - prect.width;

                this.panel.style.left = panelPos.left+"px";
                this.panel.style.top = panelPos.top+"px";
            }
        });

    }

    render(props,state) {
        this.items = this.items || (props.items.call ? props.items.call(this) : props.items);

        let selectedItem = {value:props.value};
        this.items.forEach((item)=>{
            if (item.value==props.value) selectedItem = item;
        })

        return html`
            ${props.dropdown && html`
                <button class='lp-combo' ref=${(r)=>this.button=r} onClick=${()=>this.toggle()}>
                    <div class="lp-combo-button-item">
                        ${props.tpl_item(selectedItem)}
                    </div>
                    <i class="fa fa-sort-down"/>
                </button>            
            `}
            ${(!props.dropdown || state.is_open) && html`
                <div class="lp-panel ${props.dropdown ? "lp-panel-dropdown":""}" ref=${(r)=>this.panel=r} style=${{
                    background: props.background,
                    width: props.dropdown ? props.comboWidth+"px" : undefined,
                    height: props.dropdown ? props.comboHeight+"px" : undefined
                }}>
                    ${ this.items.map((item)=> html`
                        <div 
                            class="lp-panel-item ${(state.prevValue==item.value || (!state.prevValue && props.value==item.value)) ? "lp-selected":""}"
                            onClick=${()=>{
                                this.setState({prevValue:undefined});
                                props.onChange(item.value);
                            }}
                            onMouseEnter=${()=>{
                                if (!props.preview) return;
                                this.setState({prevValue:props.value});
                                if (props.value!=item.value) props.onChange(item.value);
                            }}
                            onMouseLeave=${()=>{
                                if (!props.preview) return;
                                if (state.prevValue && state.prevValue!=props.value) props.onChange(state.prevValue);
                                this.setState({prevValue:undefined});
                            }}
                        >
                            ${props.tpl_item(item)}
                        </div>
                    `)}
                </div>
            `}
        `;
    }
};

Combo.defaultProps = { 
    items: [],
    background: "",
    preview: true,
    dropdown: false
}
Combo = Editable(Combo);


exports.Combo = Combo;