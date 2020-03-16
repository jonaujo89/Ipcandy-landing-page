
window._t = function(s) { return window._t.hash[s] || s; };
window._t.hash = {};
window._t.load = function(h) { window._t.hash = {...window._t.hash,...h} }

if (window.locale_lang=="ru") require("./locale/ru.js");

window.lp = {};

require("./lib/jquery.min.js");

require("./style/font-awesome.css");
require("./style/editor.css");
require("./../components/style/makefile.tea");

window.preact = require("./lib/preact");
window.preact.hooks = require("./lib/preact_hooks");
window.html = require("./lib/htm").bind(preact.h);

const Block = require("./pure_components/internal/block");
const {Dialog} = require("./pure_components/internal/Dialog/Dialog");
const {AddBlockDialog} = require("./pure_components/internal/AddBlockDialog/AddBlockDialog");

require("./pure_components/benefits");

class AppBlock {
    shouldComponentUpdate(nextProps) {
        return nextProps.value != this.props.value;
    }
    render(props) {
        const BlockType = Block.list[props.value.type];
        if (BlockType) return html`<${ BlockType } value=${props.value} />`;
        console.debug("Undefined block type",props.value);
    }
}

class App extends preact.Component {

    constructor(props) {
        super(props);

        this.options = props;
        this.state = {
            blocks: props.blocks,
            preview: false,
            dragHandleIndex: -1
        }
        this.baseId = (new Date()).getTime();
        
        this.dragComponent = false;
        this.dragging = false;
        
        this.blocks = [];
        this.addBlockDialog = preact.createRef();

        if (props.isGlobal) lp.app = this;

        $(document).mouseup((e)=>this.draggableMouseUp());
        $(document).mousemove((e)=>this.draggableMouseMove(e));
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
            if (dropIndex!=currentIndex && dropIndex!=currentIndex+1) {
                var blocks = [...this.state.blocks];
                var block = blocks[currentIndex];
                
                blocks.splice(currentIndex,1);
                if (currentIndex < dropIndex) dropIndex--;
                blocks.splice(dropIndex,0,block);

                var $drag = $(this.dragComponent.base);
                var $rect = $("<div class='drop-rect'>").appendTo("body").css({ 
                    top: $drag.offset().top, height: $drag[0].clientHeight, opacity: 1
                });
                var scrollTop = $("html").scrollTop();
                    
                this.setState({blocks},()=>{
                    this.triggerChange();
                    var $block = $(this.blocks[dropIndex].base);
                    var off = $block.offset();

                    $("html").scrollTop(scrollTop);
                    $rect.css({top: $block.offset().top, opacity:0});
                    setTimeout(()=>$rect.remove(),1000);
                });
            }

            this.setState({dragHandleIndex:-1});
            this.dragComponent = false;
            this.dragging = false;
            $("body").removeClass("dragging");
        }
    }

    draggableMouseMove(e) {
        if (this.dragComponent && !this.dragging) {
            if (Math.abs(e.pageX-this.dragPoint.x)>3 || Math.abs(e.pageY-this.dragPoint.y)>3) {
                this.dragging = true;
                $("body").addClass("dragging");
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
                let wh = $(window).height();
                let dragScrollHeight = 100;
                let delta = Math.abs(this.prevMove.clientY - e.clientY);
                let direction = 0;
                
                if (e.clientY < dragScrollHeight) direction = -5;
                if (e.clientY > wh - dragScrollHeight) direction = 5;

                if (delta*direction) {
                    $('html').animate({scrollTop: $("html").scrollTop() + delta*direction},0,"linear");
                }
            }

            this.prevMove = e;
        } else {
            this.prevMove = false;
        }
    }

    request(action,data,callback) {
        $.ajax({
            url: this.props.ajax_url,
            type: "POST",
            data: $.extend({},{_type:action},data),
            success: $.proxy(callback,this)
        });        
    }

    render(props,state) {
        console.debug("app render");
        
        var dropMarker = html`<div class="drop-marker" key="drop-marker"/>`;
        return html`
            ${ !props.viewOnly && html`
                <div id="preview-toolbar">
                    ${ state.preview && html`
                        <button onClick=${()=>this.setState({preview:false})} class="editor-button"><i class="fa fa-cog" />${_t("Editor")}</button>
                    `}
                    ${ !state.preview && html`
                        <button onClick=${()=>this.setState({preview:true})}><i class="fa fa-times" />${_t("Preview")}</button>
                        <button onClick=${()=>this.publish()}><i class="fa fa-play" />${_t("Publish")}</button>
                        <button onClick=${()=>this.addBlockDialog.current.open({x:0,y:0})}><i class="fa fa-plus" />${_t("Add Section")}</button>
                    `}
                </div>
                <${AddBlockDialog} ref=${this.addBlockDialog} />
            `}
            <div id="frame-panel" class="${ (state.preview || props.viewOnly) && 'view-layout' }">
                ${state.blocks.map((block,blockIndex) => {
                    var blockNode = preact.h(AppBlock,{
                        value:block.value, 
                        key: block.value.id, 
                        ref: (r) => { 
                            if (!r) return;
                            if (blockIndex==0) this.blocks=[]; 
                            this.blocks.push(r); 
                        } 
                    });
                    if (blockIndex==state.dragHandleIndex) return [dropMarker,blockNode];
                    if (blockIndex==state.blocks.length-1 && state.dragHandleIndex==blockIndex+1) return [blockNode,dropMarker];
                    return blockNode;
                })}
                
            </div>
        `;
    }

    triggerChange() {
        clearTimeout(this.saveTimeout);
        this.saveTimeout = setTimeout(()=>{
            this.request('save',{blocks:JSON.stringify(this.state.blocks)});
        },500);
    }

    blockChanged(blockComponent) {
        this.state.blocks.forEach((block)=>{
            if (block.value.id==blockComponent.value.id) {
                block.value = blockComponent.value;
            }
        });
        this.setState({},()=>this.triggerChange());
    }

    publish() {
        var me = this;
        class AppPublished extends App {
            componentDidMount() {
                me.request("publish",{html:this.base.outerHTML,blocks:JSON.stringify(this.state.blocks)},()=>{
                    Dialog.alert({
                        title:_t('Publish success'),
                        text:_t('Your page was successfully published and now is available to your customers')
                    });
                });
            }
        }

        preact.render(preact.h(AppPublished,{
            assets_url: this.options.assets_url,
            blocks: this.state.blocks,
            viewOnly: true
        }),$("<div>")[0]);
    }

    removeBlock(blockComponent) {
        var blocks = [];
        this.state.blocks.forEach((block)=>{
            if (block.value.id!=blockComponent.value.id) blocks.push(block);
        });
        this.setState({ blocks },()=>this.triggerChange());
    }

    addBlock(typeId) {
        var blocks = [...this.state.blocks];
        blocks.push({
            value: {
                id: 'id'+(++this.baseId),
                type: typeId
            }
        });
        this.setState({ blocks },()=>this.triggerChange());
    }
}


lp.run = function (options) {
    options.isGlobal = true;
    $(()=> preact.render(preact.h(App,options),$("#app")[0]));
}