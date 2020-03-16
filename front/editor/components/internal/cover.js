const Editable = require("./editable");
const Block = require("./block");

class Cover extends Editable {
    constructor(props) {
        super(props);
        this.cover = preact.createRef();
        this.configDialog = preact.createRef();
    }

    configForm() {
        return false;
    }

    openConfig() {
        let dlg = this.configDialog.current;
        let rect = this.cover.current.getBoundingClientRect();
        var dw = document.documentElement.clientWidth;
        var dh = document.documentElement.clientHeight;
        var dlgw = dlg.props.width;

        var x = rect.x+rect.width;
        if (x+dlgw > dw) {
            x = rect.x-dlgw-1;
            if (x<0) x = 0;
        }
        dlg.open({x,y:rect.y});
    }

    render(props,state) {
        var configForm = this.configForm();
        if (configForm) configForm.ref = this.configDialog;
        this.passValue();
        return html`<div class="lp-cover">
            ${this.tpl(props,state)}
            ${ !lp.app.options.viewOnly && html`
                <div ref=${this.cover} class='cmp-cover fa fa-gear' onClick=${()=>this.openConfig()} />
                ${ configForm }
            `}
        </div>`;
    }
}
exports = Cover;