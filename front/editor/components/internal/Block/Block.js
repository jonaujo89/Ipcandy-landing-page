require("./Block.tea");
const {Dialog} = require("../Dialog/Dialog");

const ValueContext = preact.createContext({name:"",value:{}});
const BlockContext = preact.createContext(false);

class Block extends preact.Component {
    static register(clsName,cls) {
        Block.list = Block.list || {};
        Block.list[clsName] = cls;
        for (var i=0;i<13;i++) {
            cls.id = clsName;
            Block.list[clsName+i.toString()] = cls;
        }
    }

    constructor(props) {
        super(props);

        this.configButton = preact.createRef();
        this.configDialog = preact.createRef();
        this.variantValues = {}

        this.variantCount = 0;
        while (this['tpl_'+(this.variantCount+1)]) this.variantCount++;

        this.setValue(props.value);
    }

    setValue(val) {
        var variant = val.variant || 1;
        var def_f = this['tpl_default_'+variant] || (() => {});
        var defaultValue = def_f();
        var fullValue = $.extend(true,{variant},defaultValue,val);
        
        this.defaultValue = defaultValue;
        this.value = fullValue;
    }

    editorChange(fullName,val) {
        function shallowClone(o) {
            if(!o || "object" !== typeof o) return o || {};
            var c = "function" === typeof o.pop ? [] : {};
            for(var p in o) {
                if(o.hasOwnProperty(p)) c[p] = o[p];
            }
            return c;
        }

        var ret = shallowClone(this.value);
        var current = ret;

        var parts = fullName.split(".");
        parts.forEach((part,i)=>{
            if (parts.length==i+1) {
                current[part] = val;
            } else {
                current[part] = shallowClone(current[part]);
            }
            current = current[part];
        });
        this.value = ret;
        lp.app.blockChanged(this);
    }


    prev() {
        var newVariant = (this.value.variant - 2 + this.variantCount) % this.variantCount + 1;
        this.setVariant(newVariant);
    }

    next() {
        var newVariant = (this.value.variant % this.variantCount) + 1;
        this.setVariant(newVariant);
    }

    setVariant(variant) {
        this.variantValues[this.value.variant] = this.value;
        this.setValue(
            $.extend(this.variantValues[variant] || { type:this.value.type, id:this.value.id },{variant})
        );
        lp.app.blockChanged(this);
    }

    remove() {
        Dialog.confirm({title:_t("Remove confirmation"),text:_t("Sure to remove component?")},(res) => {
            if (res) lp.app.removeBlock(this);
        })
    }

    configForm() {
        return false;
    }

    render(props,state) {
        console.debug("block render",this.value.type,this.value);

        var variant = this.value.variant;
        var tpl_f = this['tpl_'+variant] || (() => html`<div>Unsupported variant ${variant}</div>`);

        var configForm = this.configForm();
        if (configForm) configForm.ref = this.configDialog;

        return html`
        <${BlockContext.Provider} value=${this}>
        <${ValueContext.Provider} value=${{name:"",value:this.value,defaultValue:this.defaultValue}}>
            <div class="lp-block">
                ${tpl_f.call(this,this.value,props,state)}
                ${ !lp.app.options.viewOnly && html`
                    <div class='cmp-controls'>
                        ${ this.variantCount > 1 && html`
                            <div class='fa fa-chevron-left lp-button' onClick=${()=>this.prev()} />
                            <div class='fa fa-chevron-right lp-button' onClick=${()=>this.next()} />
                            <div class='lp-variant-label'>
                                ${variant}/${this.variantCount}
                            </div>
                        `}
                        ${ configForm && html`
                            <div 
                                ref=${this.configButton} 
                                class='fa fa-gear lp-button right' 
                                onClick=${
                                    () => {
                                        let dlg = this.configDialog.current;
                                        let rect = this.configButton.current.getBoundingClientRect();
                                        dlg.open({x:rect.x-dlg.props.width+rect.width-1,y:rect.y});
                                    }
                                } 
                            />
                        `}
                        <div class='fa fa-arrows lp-button right' onMouseDown=${(e)=>lp.app.draggableMouseDown(e,this)} />
                        <div class='fa fa-trash-o lp-button right' onClick=${()=>this.remove()} />
                    </div>
                `}
            </div>
            ${ !lp.app.options.viewOnly && configForm }
        <//>
        <//>
        `;
    }
}

exports.BlockContext = BlockContext;
exports.ValueContext = ValueContext;
exports.Block = Block;