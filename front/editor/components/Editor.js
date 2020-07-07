require("../style/fontAwesome.css");
require("../style/fonts.css");
require("../style/global.tea");

require("./Editor.tea");
const {Block} = require("./internal/Block/Block");
const {Dialog} = require("./internal/Dialog/Dialog");
const {AddBlockDialog} = require("./internal/AddBlockDialog/AddBlockDialog");

class Editor extends Component {

    static ready(f) {
        if (Editor.instance) return f();
        Editor.ready_list = Editor.ready_list || [];
        Editor.ready_list.push(f);
    }

    constructor(props) {
        super(props);
        for (var key in props) config[key] = props[key];
        this.state = {
            blocks: props.blocks,
            preview: props.viewOnly ? true : false,
            dragHandleIndex: -1
        }
        this.baseId = (new Date()).getTime();
        
        this.dragComponent = false;
        this.dragging = false;
        
        this.blocks = [];

        Editor.instance = this;
        (Editor.ready_list || []).forEach((f)=>f());

        document.addEventListener("mouseup",(e)=>this.draggableMouseUp());
        document.addEventListener("mousemove",(e)=>this.draggableMouseMove(e));
    }

    draggableMouseDown(e,cmp) {
        if (cmp && !this.dragging) {
            this.dragComponent = cmp;
            this.dragPoint = {x:e.pageX,y:e.pageY};
            e.preventDefault();
        }
    }

    draggableMouseUp() {
        if (this.dragging) {
            var currentIndex = -1;
            this.state.blocks.forEach((block,blockIndex)=>{
                if (block.value.id==this.dragComponent.value.id) currentIndex = blockIndex;
            });
            var dropIndex = this.state.dragHandleIndex;
            if (currentIndex==-1 || (dropIndex!=currentIndex && dropIndex!=currentIndex+1)) {
                var blocks = [...this.state.blocks];

                if (currentIndex==-1) {
                    var block = {value:{...this.dragComponent.value,id:this.newBlockId()}};
                    var dragEl = document.getElementsByClassName("drop-marker");
                    blocks.splice(dropIndex,0,block);
                } else {
                    var block = blocks[currentIndex];
                    var dragEl = this.dragComponent.base;
                    blocks.splice(currentIndex,1);
                    if (currentIndex < dropIndex) dropIndex--;
                    blocks.splice(dropIndex,0,block);
                }

                var rect = document.createElement("div");
                rect.className = "drop-rect";
                Object.assign(rect.style,{ top: dragEl.offsetTop+"px", height: dragEl.clientHeight+"px", opacity: 1 });
                document.body.append(rect);
                
                var scrollTop = document.documentElement.scrollTop;
                    
                this.setState({blocks},()=>{
                    this.triggerChange();
                    var blockEl = this.blocks[dropIndex].base;

                    document.documentElement.scrollTop = scrollTop;
                    Object.assign(rect.style,{top: blockEl.offsetTop+"px", height: blockEl.clientHeight+"px", opacity:0});
                    setTimeout(()=>rect.remove(),1000);
                });
            }

            this.setState({dragHandleIndex:-1});
            this.dragging = false;
            document.body.classList.remove("dragging");
        }
        this.dragComponent = false;
    }

    draggableMouseMove(e) {
        if (this.dragComponent && !this.dragging) {
            if (Math.abs(e.pageX-this.dragPoint.x)>3 || Math.abs(e.pageY-this.dragPoint.y)>3) {
                this.dragging = true;
                document.body.classList.add("dragging");
                this.addBlockDialog.close();
            }
        }

        if (this.dragging) {
            if (this.blocks.length) {
                var dist = [];
                this.blocks.forEach((block)=>{
                    var rect = block.base.getBoundingClientRect();
                    var center = rect.top + rect.height/2;
                    dist.push(e.clientY - center);
                });
                var dist_abs = dist.map((x)=>Math.abs(x));
                var nearestIndex = dist_abs.indexOf(Math.min(...dist_abs));
                var dragHandleIndex =(dist[nearestIndex] < 0) ? nearestIndex : (nearestIndex+1);

                if (this.state.dragHandleIndex!=dragHandleIndex) {
                    this.setState({dragHandleIndex});
                }
            }
            if (this.prevMove) {
                let wh = document.documentElement.clientHeight;
                let dragScrollHeight = 100;
                let delta = Math.abs(this.prevMove.clientY - e.clientY);
                let direction = 0;
                
                if (e.clientY < dragScrollHeight) direction = -5;
                if (e.clientY > wh - dragScrollHeight) direction = 5;

                if (delta*direction) {
                    document.documentElement.scrollTop += delta*direction;
                }
            }

            this.prevMove = e;
        } else {
            this.prevMove = false;
        }
    }

    request(action,data,callback) {
        var formData;
        if (data instanceof FormData) {
            formData = data;
        } else {
            var formData = new FormData;
            for (var key in data) formData.append(key,data[key]);
        }
        formData.append("_type",action);

        fetch(config.base_url+"/"+this.props.ajaxUrl, {
            method: 'POST',
            cache: 'no-cache',
            body: formData
        }).then((response) => response.text().then(callback));
    }

    render(props,state) {
        var dropMarker = html`<div class="drop-marker" key="drop-marker"/>`;
        return html`
            ${ !props.viewOnly && html`
                <div id="preview-toolbar">
                    ${ state.preview && html`
                        <button onClick=${()=>this.setState({preview:false})} class="editor-button"><i class="fa fa-cog" />${_t("Editor")}</button>
                    `}
                    ${ !state.preview && html`
                        <button onClick=${()=>this.setState({preview:true})}><i class="fa fa-times" />${_t("Preview")}</button>
                        
                        ${ props.ajaxUrl && html`<button onClick=${()=>this.publish()}><i class="fa fa-play" />${_t("Publish")}</button>`}
                        <button onClick=${()=>this.addBlockDialog.open({x:0,y:0})}><i class="fa fa-plus" />${_t("Add Section")}</button>
                        ${ props.toolbarExtraButtons }
                    `}
                </div>
                <${AddBlockDialog} ref=${(r)=>this.addBlockDialog=r} />
            `}
            <div id="frame-panel">
                ${state.blocks.map((block,blockIndex) => {
                    const BlockType = Block.list[block.value.type];
                    if (!BlockType) console.debug("Undefined block type",block.value);

                    var blockNode = BlockType && preact.h(BlockType,{
                        value: block.value, 
                        key: block.value.id, 
                        ref: (r) => { 
                            if (!r) return;
                            if (blockIndex==0) this.blocks=[]; 
                            this.blocks.push(r); 
                        } 
                    })

                    if (blockIndex==state.dragHandleIndex) return [dropMarker,blockNode];
                    if (blockIndex==state.blocks.length-1 && state.dragHandleIndex==blockIndex+1) return [blockNode,dropMarker];
                    return blockNode;
                })}
                
            </div>
        `;
    }

    triggerChange() {
        if (!this.props.ajaxUrl) return;
        clearTimeout(this.saveTimeout);
        this.saveTimeout = setTimeout(()=>{
            this.request('save',{blocks:JSON.stringify(this.state.blocks)});
        },500);
    }

    blockChanged(blockComponent,cb) {
        this.state.blocks.forEach((block)=>{
            if (block.value.id==blockComponent.value.id) {
                block.value = blockComponent.value;
            }
        });
        this.setState({},()=>{
            this.triggerChange();
            cb && cb();
        });
    }

    publish() {
        var me = this;
        class Published extends Editor {
            componentDidMount() {
                me.request("publish",{html:this.base.outerHTML,blocks:JSON.stringify(this.state.blocks)},(res)=>{
                    res = JSON.parse(res);
                    if (res.error) {
                        Dialog.alert({
                            title:_t('Publish failed'),
                            text: res.error
                        });
                    } else {
                        Dialog.alert({
                            title:_t('Publish success'),
                            text: _t("Your page was successfully published and now is available to your customers.") + (res.alert || "")
                        });                        
                    }
                });
                Editor.instance = me;
            }
        }

        var div = document.createElement("div");
        preact.render(preact.h(Published,{
            ...this.props,
            blocks: this.state.blocks,
            viewOnly: true
        }),div);
        preact.render(null,div);
    }

    removeBlock(blockComponent) {
        var blocks = [];
        this.state.blocks.forEach((block)=>{
            if (block.value.id!=blockComponent.value.id) blocks.push(block);
        });
        this.setState({ blocks },()=>this.triggerChange());
    }

    newBlockId() {
        return 'id'+(++this.baseId);        
    }

    addBlock(typeId) {
        var blocks = [...this.state.blocks];
        blocks.push({
            value: {
                id: this.newBlockId(),
                type: typeId
            }
        });
        this.setState({ blocks },()=>this.triggerChange());
    }
}

window.Editor = Editor;
exports.Editor = Editor;