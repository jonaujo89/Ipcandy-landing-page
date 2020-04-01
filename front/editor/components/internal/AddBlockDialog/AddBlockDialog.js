require("./AddBlockDialog.tea");
const {Block} = require("../Block/Block");
const {Dialog} = require("../Dialog/Dialog");

class AddBlockDialog extends preact.Component {
    open() {
        this.dialog.open({
            x: document.body.clientWidth/2 - this.dialog.props.width/2,
            y: document.getElementById("preview-toolbar").offsetHeight
        });
    }
    close() {
        this.dialog.close();
    }
    render() {
        return html`
            <${Dialog} class="lp-add-block-dialog" title=${_t("Select component type")} width=595 ref=${(r)=>this.dialog=r}>${()=>{
                var items = [];
                for (let typeId in Block.list) {                    
                    let type = Block.list[typeId];
                    items.push(html`
                        <div class='lp-add-block-item' 
                            onClick=${()=>{
                                this.dialog.close();
                                lp.app.addBlock(typeId);
                            }}
                            onMouseDown=${(e)=>{
                                lp.app.draggableMouseDown(e,{value:{type:typeId}})
                            }}
                        >
                            <div class='lp-add-block-item-pic' style=${{backgroundImage:"url('"+base_url+"/"+lp.app.options.assets_url+"/miniatures/"+type.id.toLowerCase()+".jpg')"}} />
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