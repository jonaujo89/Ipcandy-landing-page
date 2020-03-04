const Cover = require("./cover");

lp.iconCombo = ui.combo.extendOptions({
    panelClass: "only-icons lp-icon-panel",
    inline: true,
    height: "100%",
    margin: 0,
    name: "",
    items: function () {
        var items = [];
        for (var i=1;i<=841;i++) {
            if (i>=285 && i<=289) continue;
            if (i>=365 && i<=716) continue;
            if (i>=743 && i<=766) continue;
            items.push({value:Component.app.options.assets_url+"/ico/"+i+".png"});
        }
        return items;
    },
    itemTpl: function (item) {
        return $("<div class='combo-item'>").css({
            backgroundImage:"url("+base_url+"/"+item.value+")"
        });
    }
})

lp.iconComboWhite = lp.iconCombo.extendOptions({
    items: function () {
        var items = [];
        this.element.css({background:'transparent'});
        this.element.parent().css({background:"#555"});
        for (var i=365;i<=716;i++) {
            items.push({value:Component.app.options.assets_url+"/ico/"+i+".png"});
        }
        return items;
    }
});

class Icon extends Cover {
    constructor(props) {
        super(props);
        this.configForm = {
            title: _t("Icons"),
            width: 550,
            height: 500,
            item: props.iconType=='white' ? lp.iconComboWhite : lp.iconCombo
        }    
        if (props.iconType) this.configForm.id = "dialog_"+props.iconType;
    }

    render() {
        this.passValue();
        return html`<div>
            <div class="ico" style="background-image: url(${base_url+"/"+this.value})">
                <div ref=${this.cover} class='cmp-cover fa fa-gear' onClick=${()=>{this.openDialog()}} />
            </div>
        </div>`;
    }
}

exports = Icon;