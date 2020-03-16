require("./Icon.tea");
const Cover = require("../cover");
const {Combo} = require("../Combo/Combo");
const {Dialog} = require("../Dialog/Dialog");

class IconCombo extends Combo {
    tpl_item(item) {
        return html`
            <div class="lp-icon-panel-item" style=${{backgroundImage:"url("+base_url+"/"+item.value+")"}} />
        `;
    }
}
IconCombo.defaultProps = {
    items: ()=>{
        var items = [];
        for (var i=1;i<=841;i++) {
            if (i>=285 && i<=289) continue;
            if (i>=365 && i<=716) continue;
            if (i>=743 && i<=766) continue;
            items.push({value:lp.app.options.assets_url+"/ico/"+i+".png"});
        }
        return items;
    }
}

class IconComboWhite extends IconCombo {};
IconComboWhite.defaultProps = {
   items: ()=>{
       var items = [];
       for (var i=365;i<=716;i++) {
            items.push({value:lp.app.options.assets_url+"/ico/"+i+".png"});
        }
        return items;
   },
   background: '#555'
}
 
class Icon extends Cover {
    configForm() {
        var IconComboCls = this.props.iconType=="white" ? IconComboWhite : IconCombo;
        return html`
            <${Dialog} title=${_t("Icons")} class="lp-icon-config-dialog">
                <${IconComboCls} name=${this.props.name} />
            <//>
        `;
    }

    render() {
        var configForm = this.configForm();
        if (configForm) configForm.ref = this.configDialog;
        this.passValue();
        return html`<div class="lp-cover">
            <div class="ico" style="background-image: url(${base_url+"/"+this.value})">
                ${ !lp.app.options.viewOnly && html`
                    <div ref=${this.cover} class='cmp-cover fa fa-gear' onClick=${()=>this.openConfig()} />
                    ${ configForm }
                
                `}
            </div>
        </div>`;
    }
}

exports.Icon = Icon;
exports.IconCombo = IconCombo;
exports.IconComboWhite = IconComboWhite;