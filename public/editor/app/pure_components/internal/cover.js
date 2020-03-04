const Editable = require("./editable");
const Block = require("./block");

class Cover extends Editable {
    cover = preact.createRef();
    editor = undefined;

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
            <div ref=${this.cover} class='cmp-cover fa fa-gear' onClick=${()=>{this.openDialog()}} />
        </div>`;
    }
}
Cover.prototype.config = Block.prototype.config;

exports = Cover;