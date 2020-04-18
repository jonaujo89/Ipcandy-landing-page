require("./Icon.tea");
const {Cover} = require("../Cover/Cover");
const {Combo} = require("../Combo/Combo");
const {Dialog} = require("../Dialog/Dialog");
const {Editable} = require("../Editable/Editable");

const iconComboItemTpl = (item)=>html`
    <div class="lp-icon-panel-item" style=${{backgroundImage:"url('"+config.base_url+"/"+item.value+"')"}} />
`;

const IconCombo = (props) => preact.h(Combo,{...props,
    tpl_item: iconComboItemTpl,
    items: () => {
        var items = [];
        for (var i=1;i<=841;i++) {
            if (i>=285 && i<=289) continue;
            if (i>=365 && i<=716) continue;
            if (i>=743 && i<=766) continue;
            items.push({value:config.assets_url+"/ico/"+i+".png"});
        }
        return items;
    }
})

const IconComboWhite = (props) => preact.h(Combo,{...props,
    tpl_item: iconComboItemTpl,
    items: () => {
        var items = [];
        for (var i=365;i<=716;i++) {
            items.push({value:config.assets_url+"/ico/"+i+".png"});
        }
        return items;
    },
    background: "#555"
})


const Icon = Editable(class extends preact.Component{
    render(props) {
        var IconComboCls = props.iconType=="white" ? IconComboWhite : IconCombo;
        return html`
            <${Cover} 
                configForm=${html`
                    <${Dialog} title=${_t("Icons")} class="lp-icon-config-dialog" onOpen=${function(){
                        var el = this.div.getElementsByClassName("lp-selected")[0];
                        if (el) el.scrollIntoView();
                    }}>
                        <${IconComboCls} />
                    <//>
                `}
                customCover=${true}
                ref=${(r)=>this.coverCmp=r}
            >
                <div class="ico" style="background-image: url(${config.base_url+"/"+props.value})">
                    ${ !Editor.instance.state.preview && html`
                        <div ref=${(r)=>this.cover=r} class='cmp-cover cmp-config-cover fa fa-gear' onClick=${()=>this.coverCmp.openConfig(this.cover)} />
                    `}
                </div>
            <//>
        `
    }
});

exports.Icon = Icon;