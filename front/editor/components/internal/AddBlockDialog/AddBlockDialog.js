require("./AddBlockDialog.tea");
const Block = require("../block");
const {Dialog} = require("../Dialog/Dialog");

class AddBlockDialog extends preact.Component {
    open() {
        this.dialog.open({x:0,y:$("#preview-toolbar").outerHeight()});
    }
    render() {
        return html`
            <${Dialog} title=${_t("Select component type")} width=595 ref=${(r)=>this.dialog=r}>${()=>{
                var items = [];
                for (let typeId in Block.list) {                    
                    let type = Block.list[typeId];
                    items.push(html`
                        <div class='lp-add-block-item' onClick=${()=>{
                            this.dialog.close();
                            lp.app.addBlock(typeId);
                        }}>
                            <div class='lp-add-block-item-pic' style=${{backgroundImage:"url("+base_url+"/"+lp.app.options.assets_url+"/miniatures/"+type.id.toLowerCase()+".jpg)"}} />
                            ${type.title}
                            <small>${type.description}</small>
                        </div>
                    `);
                }
                return items;
            }}<//>
        `;        
    }
}

exports.AddBlockDialog = AddBlockDialog;