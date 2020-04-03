require("./Combo.tea");
const {Editable} = require("../Editable/Editable");

class Combo extends preact.Component {

    componentDidMount() {
        if (this.props.dropdown) {
            document.addEventListener("mousedown",(e)=>{
                if (e.which!=1) return;
                var meClick = false;

                var el = e.target;
                while (el) {
                    if (el==this.button || el==this.panel) meClick = true;
                    el = el.parentElement;
                }
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

        const eq = (a,b) => {
            if (a==b) return true;
            if (Object(a)==a && Object(b)==b) {
                if (Object.keys(a).length!=Object.keys(b).length) return false;
                for (var key in a) {
                    if (a[key]!=b[key]) return false;
                }
                return true;
            }
            return false;
        };

        return html`
            ${props.dropdown && html`
                <button class='lp-combo' ref=${(r)=>this.button=r} onClick=${()=>this.toggle()}>
                    <div class="lp-combo-button-item">
                        ${props.tpl_item(selectedItem,true)}
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
                            class="lp-panel-item ${(eq(state.prevValue,item.value) || (!state.prevValue && eq(props.value,item.value))) ? "lp-selected":""}"
                            onClick=${()=>{
                                this.setState({prevValue:undefined});
                                props.onChange(item.value);
                                if (props.closeOnSelect) this.setState({is_open:false});
                            }}
                            onMouseEnter=${()=>{
                                if (!props.preview) return;
                                this.setState({prevValue:props.value});
                                if (props.value!=item.value) props.onChange(item.value);
                            }}
                            onMouseLeave=${()=>{
                                if (!props.preview) return;
                                if (state.prevValue && !eq(state.prevValue,props.value)) props.onChange(state.prevValue);
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
    dropdown: false,
    closeOnSelect: false
}
Combo = Editable(Combo);


exports.Combo = Combo;