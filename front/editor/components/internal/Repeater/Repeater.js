require("./Repeater.tea");
const {Editable} = require("../Editable/Editable");
const {Block,BlockContext,ValueContext} = require("../Block/Block");

class Repeater extends Editable {
    constructor(props) {
        super(props);
        this.state = {
            hoverIdx: -1,
            hoverType: undefined
        }
    }

    buttonHover(idx,type) {
        this.setState({
            hoverIdx: idx,
            hoverType: type
        });
    }

    addAfter(idx,type) {
        const parentContext = preact.hooks.useContext(ValueContext);
        var item_default = this.defaultValue[0] || {};

        var new_value = [...this.value];
        new_value.splice(idx+1,0,item_default);
        this.setValue(new_value);
    }

    remove(idx) {
        var new_value = [...this.value];
        new_value.splice(idx,1);
        this.setValue(new_value);
    }

    tpl(props,state) {
        var list = this.value || [];
        var item_f = props.children;

        return html`
            ${list.map((sub,sub_idx) => html`
                <div class="item_block">
                    <${ValueContext.Provider} value=${{value:sub,name:this.fullName+"."+sub_idx}}>
                        ${item_f(sub)}
                    <//>
                    ${ !lp.app.options.viewOnly && html`
                        <div class='cmp-repeater-cover'>
                            <div 
                                class='fa fa-plus lp-button' 
                                onMouseEnter=${()=>{ this.buttonHover(sub_idx,'add') }} 
                                onMouseLeave=${()=>{ this.buttonHover(-1) }}
                                onClick=${()=>{ this.addAfter(sub_idx) }}
                            />
                            <div 
                                class='fa fa-trash-o lp-button lp-remove-button' 
                                onMouseEnter=${()=>{ this.buttonHover(sub_idx,'remove') }} 
                                onMouseLeave=${()=>{ this.buttonHover(-1) }} 
                                onClick=${()=>{ this.remove(sub_idx) }}
                            />
                        </div>
                        ${ state.hoverType=='remove' && state.hoverIdx==sub_idx && html`<div class='cmp-cover cmp-remove-cover fa fa-trash-o' style="opacity:1" />` }
                        ${ state.hoverType=='add'    && state.hoverIdx==sub_idx && html`<div class='cmp-cover cmp-add-cover' style="opacity:1" />` }
                    `}
                </div>
            `)}
        `;
    }
}

exports.Repeater = Repeater;