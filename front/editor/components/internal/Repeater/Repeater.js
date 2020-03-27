require("./Repeater.tea");
const {Editable} = require("../Editable/Editable");
const {Block,BlockContext,ValueContext} = require("../Block/Block");

const Repeater = Editable(class extends preact.Component {

    addAfter(idx,type) {
        var item_default = this.props.defaultValue[0] || {};
        var new_value = [...this.props.value];
        new_value.splice(idx+1,0,item_default);
        this.props.onChange(new_value);
    }

    remove(idx) {
        var new_value = [...this.props.value];
        new_value.splice(idx,1);
        this.props.onChange(new_value);
    }

    render(props,state) {
        var list = props.value || [];
        var item_f = props.children;

        return html`
            ${list.map((sub,sub_idx) => html`
                <div class="item_block">
                    <${ValueContext.Provider} value=${{value:sub,name:props.fullName+"."+sub_idx}}>
                        ${item_f(sub)}
                    <//>
                    ${ !lp.app.options.viewOnly && html`<${RepeaterCover} parent=${this} index=${sub_idx} />`}
                </div>
            `)}
        `;
    }
});
Repeater.defaultProps = {
    alwaysRender: true
};

const RepeaterCover = function (props) {
    const {inline,configForm} = this.props.parent.props;
    const {index,parent} = this.props;
    const [hoverType,setHoverType] = preact.hooks.useState("");

    return html`
        <div class='cmp-repeater-cover ${inline ? "cmp-repeater-cover-inline":""}'>
            <div 
                class='fa fa-plus lp-button' 
                onMouseEnter=${()=>{ setHoverType("add") }} 
                onMouseLeave=${()=>{ setHoverType("") }}
                onClick=${()=>{ parent.addAfter(index) }}
            />
            ${ configForm && html`
                <div 
                    class='fa fa-gear lp-button lp-config-button' 
                    onClick=${()=>{}}
                />
            `}
            <div 
                class='fa fa-trash-o lp-button lp-remove-button' 
                onMouseEnter=${()=>{ setHoverType('remove') }} 
                onMouseLeave=${()=>{ setHoverType('') }} 
                onClick=${()=>{ parent.remove(index) }}
            />                            
        </div>
        ${ hoverType=='remove' && html`<div class='cmp-cover cmp-remove-cover fa fa-trash-o' style="opacity:1" />` }
        ${ hoverType=='add'    && html`<div class='cmp-cover cmp-add-cover' style="opacity:1" />` }
    `;
};

exports.Repeater = Repeater;