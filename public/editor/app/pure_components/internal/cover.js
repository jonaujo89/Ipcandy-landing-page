const Editable = require("./editable");
const Block = require("./block");

class Cover extends Editable {
    constructor(props) {
        super(props);
        this.cover = preact.createRef();
    }

    openDialog() {
        this.config({my:"left top",at:"right+5px top",of:$(this.cover.current),collision:"flipfit"});
    }

    triggerChange() {
        this.setValue(this.value);
    }

    render(props,state) {
        this.passValue();
        return html`<div>
            ${this.tpl(props,state)}
            ${ !lp.app.options.viewOnly && html`
                <div ref=${this.cover} class='cmp-cover fa fa-gear' onClick=${()=>{this.openDialog()}} />
            `}
        </div>`;
    }
}
Cover.prototype.config = Block.prototype.config;

exports = Cover;