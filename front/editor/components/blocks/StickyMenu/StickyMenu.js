require("./StickyMenu.tea");

const {Dialog,Switch,Input,Block} = require("../../internal");

class StickyMenu extends Block {
    static get title() { return _t('Sticky menu') }
    static get description() { return _t("Navigation menu") }

    shouldComponentUpdate() {
        return true;
    }

    configForm() {
        return html`
            <${Dialog} width=${300}>
                ${this.getItems().map((item)=>html`
                    <div class="lp-row-inline">
                        <div>
                            <${Switch.Type} 
                                value=${item.enabled} 
                                onChange=${(val)=>this.itemChanged(item.id,{enabled:val})} 
                            />
                        </div>
                        <div>
                            <${Input.Type} 
                                value=${item.title} 
                                onChange=${(val)=>this.itemChanged(item.id,{title:val})} 
                            />
                        </div>
                    </div>
                `)}
                <${Switch} label=${_t('Dark background')} name="isDark" />
            <//>
        `;
    }

    itemChanged(id,what) {
        var new_items = this.getItems().map((item)=>{
            if (item.id==id) return {...item,...what};
            return item;
        });
        this.editorChange("items",new_items);   
    }

    getItems() {
        let hash = {};
        this.value.items.forEach((item)=>hash[item.id]=item);
        return lp.app.state.blocks.filter((block)=>block.value.id!=this.value.id).map((block)=>{
            let id = block.value.id;
            return {
                id,
                enabled: hash[id] && hash[id].enabled!==undefined ? hash[id].enabled : true,
                title: hash[id] && hash[id].title ? hash[id].title : Block.list[block.value.type].title
            };
        });

    }
    
    tpl_1(val) {
        let enabledItems = this.getItems().filter((one)=>one.enabled);
        return html`
            <div class="container-fluid sticky_menu sticky_menu_component ${val.isDark ? 'dark':''}">
                <div class="container">
                    <div class="row">
                        <div class="col-12 menu-col">
                            ${enabledItems.length!=0 && html`
                                <div class="toggler">
                                    <span class="toggler-icon"></span>
                                </div>
                            `}
                            <ul class="items">
                                ${enabledItems.map((item)=>html`
                                    <li>
                                        <a href="#" data-id="#${item.id}">${item.title}</a>
                                    </li>
                                `)}
                            </ul>
                            ${enabledItems.length==0 && html`
                                <div class="empty-placeholder">
                                    ${ locale_lang=='en' ? 'Add components to display menu items' : 'Добавьте компоненты для отображения пунктов меню' }
                                </div>
                            `}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    
    tpl_default_1() { 
        return {
            'isDark':true,
            'items': []
        };
    }    
}

Block.register('StickyMenu',exports = StickyMenu);