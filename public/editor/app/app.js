require("./../components/style/makefile.tea");

require("./../../assets/lib/teacss-ui/teacss-ui.js");
require("./../../assets/lib/teacss-ui/teacss-ui.css");

window.$ = teacss.jQuery;
window.ui = teacss.ui;

window._t = function(s) { return window._t.hash[s] || s; };
window._t.hash = {};
window._t.load = function(h) { $.extend(window._t.hash,h) }

if (window.locale_lang=="ru") {
    require("./locale/ru.js");
    window._t.load({
        "Yes" : "Да",
        "Cancel" : "Отмена",
        "Preview" : "Предпросмотр",
        "Publish" : "Публиковать",
        "Editor" : "Редактор",
        "Add Section" : "Добавить блок",
        "Select component type" : "Выбрать тип блока",
        'Your page was successfully published and now is available to your customers' : 'Ваша страница теперь опубликована и на нее смогут зайти посетители',
        'Publish success' : 'Успешная публикация'
    });
}

window.lp = {};

require("./style/font-awesome.css");
require("./style/editor.css");

require("./pure_components/internal/checkbox");
require("./pure_components/internal/color");
require("./pure_components/internal/prompts");

window.preact = require("./lib/preact");
window.preact.hooks = require("./lib/preact_hooks");
window.html = require("./lib/htm").bind(preact.h);

const Block = require("./pure_components/internal/block");
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
            preview: false
        }
        this.baseId = (new Date()).getTime();

        lp.app = this;
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
        return html`
            ${ !props.viewOnly && html`
                <div id="preview-toolbar">
                    ${ state.preview && html`
                        <button onClick=${()=>this.setState({preview:false})} class="editor-button"><i class="fa fa-cog" />${_t("Editor")}</button>
                    `}
                    ${ !state.preview && html`
                        <button onClick=${()=>this.setState({preview:true})}><i class="fa fa-times" />${_t("Preview")}</button>
                        <button onClick=${()=>this.publish()}><i class="fa fa-play" />${_t("Publish")}</button>
                        <button onClick=${()=>this.showAddBlockDialog()}><i class="fa fa-plus" />${_t("Add Section")}</button>
                    `}
                </div>
            `}
            <div id="frame-panel" class="${ (state.preview || props.viewOnly) && 'view-layout' }">
                ${state.blocks.map((block) => {
                    return preact.h(AppBlock,{value:block.value, key: block.value.id})
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
                    ui.alert({
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

    showAddBlockDialog() {
        if (!this.typeDialog) {
            this.typeDialog = teacss.ui.dialog({
                modal: true,
                resizable: false,
                draggable: false,
                width: 607,
                dialogClass: 'change-type-dialog',
                title: _t("Select component type")
            });        

            var div = $("<div style='position:relative !important;'>")
                .addClass('button-select-panel')
                .click(function(e){
                    e.stopPropagation();
                })
            
            this.typeDialog.element.css({padding:0}).append(div);
            div.append(div = $("<div>"));

            for (var typeId in Block.list) {
                var type = Block.list[typeId];
                var item = $("<div class='combo-item draggable'>")
                    .append(
                        $("<div class='combo-item-miniature'>").css({backgroundImage:"url("+base_url+"/editor/app/style/miniatures/"+typeId.toLowerCase()+".jpg)"}),
                        document.createTextNode(type.title),
                        $("<small>").html(type.description)
                    )
                    .click(()=>{
                        this.typeDialog.close();
                        this.addBlock(typeId);
                    })
                ;
                
                div.append(item);
            };
        }
        this.typeDialog.element.css({maxHeight:$(window).height()*0.8});                
        this.typeDialog.open();        
    }
}


lp.run = function (options) {
    $(()=> preact.render(preact.h(App,options),$("#app")[0]));
}