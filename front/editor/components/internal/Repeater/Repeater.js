require("./Repeater.tea");
const {Editable} = require("../Editable/Editable");
const {Block,BlockContext,ValueContext} = require("../Block/Block");

const Repeater = Editable(class extends preact.Component {

    addAfter(idx) {
        var item_default = this.props.defaultValue[0] || {};
        var new_value = [...this.props.value];
        new_value.splice(idx+1,0,item_default);
        this.props.onChange(new_value,()=>{
            this.props.onAdd && this.props.onAdd(idx+1);
        });
    }

    remove(idx) {
        var new_value = [...this.props.value];
        new_value.splice(idx,1);
        this.props.onChange(new_value,()=>{
            this.props.onRemove && this.props.onRemove(idx);
        });
    }

    onItemMouseDown(e) {
        if (e.target.classList.contains("lp-drag-handle")) this.enableDrag = true;
    }

    onItemMouseUp(e) {
        this.enableDrag = false;
    }

    onItemDragStart(e) {
        if (!this.enableDrag) { e.preventDefault(); return; }
        var dt = e.dataTransfer;
        dt.effectAllowed = 'move';
        dt.setData('Text', 'dummy');
        this.dragIndex = [...e.target.parentElement.children].indexOf(e.target);
    }

    onItemDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        const otherIndex = [...e.currentTarget.parentElement.children].indexOf(e.currentTarget);
        if (this.dragIndex==otherIndex) return;

        var new_value = [...this.props.value];
        new_value[otherIndex] = this.props.value[this.dragIndex];
        new_value[this.dragIndex] = this.props.value[otherIndex];

        this.props.onChange(new_value,()=>{
            this.dragIndex = otherIndex;
        });        
    }

    render(props,state) {
        var list = props.value || [];
        var item_f = props.children;

        return html`
            <div class="lp-repeater">
                <div class="item_blocks">
                    ${list.map((sub,sub_idx) => html`
                        <div 
                            class="item_block" 
                            draggable=${props.sortable?"draggable":false}
                            onMouseDown=${this.onItemMouseDown.bind(this)}
                            onMouseUp=${this.onItemMouseUp.bind(this)}
                            onDragStart=${this.onItemDragStart.bind(this)}
                            onDragOver=${this.onItemDragOver.bind(this)}
                        >
                            <${ValueContext.Provider} value=${{value:sub,name:props.fullName+"."+sub_idx}}>
                                ${item_f(sub)}
                                ${ !Editor.instance.state.preview && html`<${RepeaterCover} parent=${this} index=${sub_idx} />`}
                            <//>
                        </div>
                    `)}
                </div>
                ${ (props.inline && !Editor.instance.state.preview) && html`
                    <div class='lp-button-repeater-add-wrap'>
                        <div class='fa fa-plus lp-button lp-button-repeater-add' onClick=${()=>this.addAfter(props.value.length-1)}>
                            ${props.addItemText}
                        </div>
                    </div>
                `}
            </div>
        `;
    }
});
Repeater.defaultProps = {
    alwaysRender: true,
    sortable: true,
    addItemText: _t("Add Item")
};

class RepeaterCover extends preact.Component {

    openConfig() {
        let dlg = this.configDialog;
        let rect = this.configButton.getBoundingClientRect();
        dlg.open({
            x:rect.left+rect.width-dlg.props.width,
            y:rect.y
        });
    }
    
    render(props,state) {
        var {inline,sortable,configForm} = this.props.parent.props;
        if (configForm) {
            configForm = {...configForm,ref: (r) => this.configDialog = r}
        }
        const {index,parent} = props;

        return html`
            <div class='cmp-repeater-cover ${inline ? "cmp-repeater-cover-inline":""}'>
                ${ !inline && html`
                    <div 
                        class='fa fa-plus lp-button' 
                        onMouseEnter=${()=>{ this.setState({hoverType:"add"})}} 
                        onMouseLeave=${()=>{ this.setState({hoverType:""})}} 
                        onClick=${()=>{ parent.addAfter(index) }}
                    />
                `}
                ${ configForm && html`
                    <div 
                        class='fa fa-gear lp-button lp-config-button'
                        ref=${(r)=>this.configButton=r}
                        onClick=${()=>this.openConfig()}
                    />
                    ${ configForm || "" }
                `}
                ${ sortable && html`
                    <div 
                        class='fa fa-arrows lp-button lp-drag-handle' 
                        onMouseEnter=${()=>{ this.setState({hoverType:"drag"})}}
                        onMouseLeave=${()=>{ this.setState({hoverType:""})}}
                    />
                `}
                ${ index!=0 && html`
                    <div 
                        class='fa fa-trash-o lp-button lp-remove-button' 
                        onMouseEnter=${()=>{ this.setState({hoverType:"remove"})}}
                        onMouseLeave=${()=>{ this.setState({hoverType:""})}} 
                        onClick=${()=>{ parent.remove(index) }}
                    />                            
                `}
            </div>
            ${ state.hoverType=='remove' && html`<div class='cmp-cover cmp-remove-cover fa fa-trash-o' />` }
            ${ state.hoverType=='add'    && html`<div class='cmp-cover cmp-add-cover' />` }
            ${ state.hoverType=='drag'   && html`<div class='cmp-cover cmp-drag-cover fa fa-arrows' />` }
        `;
    }
};

exports.Repeater = Repeater;