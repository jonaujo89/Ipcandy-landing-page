require("./AddBlockDialog.tea");
const {Block} = require("../Block/Block");
const {Dialog} = require("../Dialog/Dialog");

class AddBlockDialog extends preact.Component {
    open() {
        this.dialog.open({
            x: document.documentElement.clientWidth/2 - this.dialog.props.width/2,
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
                    let miniature = type.id.replace(/^[A-Z]+/,(match)=>match.toLowerCase());
                    items.push(html`
                        <div class='lp-add-block-item' 
                            onClick=${()=>{
                                this.dialog.close();
                                App.instance.addBlock(typeId);
                            }}
                            onMouseDown=${(e)=>{
                                App.instance.draggableMouseDown(e,{value:{type:typeId}})
                            }}
                        >
                            <div class='lp-add-block-item-pic' style=${{backgroundImage:"url('"+base_url+"/"+App.assets_url+"/miniatures/"+miniature+".jpg')"}} />
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