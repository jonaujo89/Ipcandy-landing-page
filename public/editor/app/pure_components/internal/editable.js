const Block = require("./block");

class Editable extends preact.Component {

    constructor(props) {
        super(props);
        this.fullName = "";
        this.value = undefined;
    }

    setValue(val) {
        this.block.editorChange(this.fullName,val,true);
    }

    passValue() {
        this.block = preact.hooks.useContext(Block.BlockContext);
        const parentContext = preact.hooks.useContext(Block.ValueContext);
        this.fullName = parentContext.name ? (parentContext.name+"."+this.props.name) : this.props.name;
        this.value = (parentContext.value || {})[this.props.name || ""];
        this.defaultValue = (parentContext.defaultValue || {})[this.props.name || ""];
        console.debug("editable render",this.constructor.name,this.value);
    }
    
    render(props,state) {
        this.passValue();
        return html`<div>
            ${this.tpl(props,state)}
        </div>`;
    }
}

exports = Editable;