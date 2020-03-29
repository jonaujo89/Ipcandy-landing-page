require("./Cover.tea");
const {Editable} = require("../Editable/Editable");

class Cover extends preact.Component {
    openConfig(cover) {
        let dlg = this.configDialog;
        let rect = cover.getBoundingClientRect();
        var dw = document.documentElement.clientWidth;
        var dh = document.documentElement.clientHeight;
        var dlgw = parseInt(dlg.props.width);

        var x = rect.x+rect.width;
        if (x+dlgw > dw) {
            x = rect.x-dlgw-1;
            if (x<0) x = 0;
        }
        dlg.open({x,y:rect.y});
    }    

    render(props) {
        var configForm = props.configForm;
        if (configForm) configForm.ref = (r) => this.configDialog = r;

        return html`<div class="lp-cover">
            ${props.children}
            ${ !lp.app.options.viewOnly && html`
                ${ !props.customCover && html`
                    <div ref=${(r)=>this.cover=r} class='cmp-cover cmp-config-cover fa fa-gear' onClick=${()=>this.openConfig(this.cover)} />
                `}
                ${ configForm || "" }
            `}
        </div>`
    }
}

exports.Cover = Cover;