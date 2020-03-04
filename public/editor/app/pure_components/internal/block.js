var $ = teacss.jQuery;

lp.pureBlock = teacss.ui.control.extend({
    init: function (o) {
        this._super(o);
        var me = this;
        this.cmp = this.options.cmp;
        this.element = this.cmp.element;
    },
    setValue: function (val) {
        if (!this.preactReady) {
            this.preactReady = true;
            var vEl = preact.h(this.options.blockClass,{ clientControl: this, initialValue: val });
            preact.render(vEl,this.element[0]);
        } else {
            this.block.setValue(val);
        }
        this.cmp.componentHandle.detach();
    },
    getValue: function () {
        if (!this.block) return {};
        return this.block.value;
    }
});

const ValueContext = preact.createContext({name:"",value:{}});
const BlockContext = preact.createContext(false);

class Block extends preact.Component {
    static listToRegister = {};
    static register(cls) {
        var className = cls.name;
        var id = "pure_"+className;
        Block.listToRegister[id] = {
            name: cls.title,
            description: cls.description,
            area: false,
            category: "Pure",
            clientControlClass: lp.pureBlock.extendOptions({ blockClass: cls }),
            clientControl: "lp.Block.listToRegister."+id+".clientControlClass",
            id: id,
            new: {
                html: "<div></div>"
            }
        }        
    }

    static registerAll(app) {
        for (var key in this.listToRegister) {
            app.components[key] = this.listToRegister[key];
        }
    }    

    variantValues = {}

    constructor(props) {
        super(props);
        this.clientControl = props.clientControl;
        this.clientControl.block = this;
        this.setValue(props.initialValue);

        this.variantCount = 0;
        while (this['tpl_'+(this.variantCount+1)]) this.variantCount++;
    }

    setValue(val) {
        var variant = val.variant || 1;
        var def_f = this['tpl_default_'+variant] || (() => {});
        var defaultValue = def_f();
        var fullValue = $.extend(true,{variant},defaultValue,val);
        
        this.defaultValue = defaultValue;
        this.value = fullValue;

        this.forceUpdate();
    }

    editorChange(fullName,val) {
        teacss.ui.prop(this.value,fullName,val);
        this.triggerChange();
    }

    triggerChange() {
        this.forceUpdate();
        this.clientControl.trigger("change");
    }

    prev() {
        var newVariant = (this.value.variant - 2 + this.variantCount) % this.variantCount + 1;
        this.setVariant(newVariant);
    }

    next() {
        var newVariant = (this.value.variant % this.variantCount) + 1;
        this.setVariant(newVariant);
    }

    setVariant(variant) {
        this.variantValues[this.value.variant] = this.value;
        this.setValue(
            $.extend(this.variantValues[variant] || { type:this.value.type, id:this.value.id },{variant})
        );
        this.clientControl.trigger("change");
    }

    remove() {
        ui.confirm({title:_t("Remove confirmation"),text:_t("Sure to remove component?")},(res) => {
            if (res) this.clientControl.cmp.remove();
        })
    }

    config(position) {
        var me = this;
        
        var dialogId = this.configForm.id || "dialog";
        var dialog = this.constructor[dialogId];
        
        function setVisible() {
            var form = dialog.form;
            if (!form.innerForm) return;
            var val = form.getValue();
            $.each(form.innerForm.items,function(i,item){
                var when = item.options.showWhen;
                if (when) {
                    var show = true;
                    for (var key in when) {
                        if ($.isArray(when[key])) {
                            if (jQuery.inArray(val[key],when[key])==-1) show = false;
                        } else {
                            if (when[key]!=val[key]) show = false;
                        }
                    }
                    if (show)
                        item.element.show();
                    else
                        item.element.hide();
                }
            });
        }
        
        if (!dialog) {
            var dialogWidth = 500;
            var dialogHeight = undefined;
            var form;
            
            if (this.configForm.width) {
                dialogWidth = this.configForm.width;
                delete this.configForm.width;
            }
            if (this.configForm.height) {
                dialogHeight = this.configForm.height;
                delete this.configForm.height;
            }
            if (this.configForm.item) {
                form = this.configForm.item({});
            } else {
                form = lp.formComposite(this.configForm);
            }
            
            dialog = this.constructor[dialogId] = teacss.ui.dialog({
                width: dialogWidth,
                height: dialogHeight,
                modal: false,
                title: this.configForm.title || _t("Settings"),
                resizable: false,
                items: [ form ],
                open: function (){
                    dialog.detached.appendTo(dialog.element);
                    if (!lp.configOverlay) {
                        lp.configOverlay = $("<div>").css({
                            position: "absolute", left: 0, right: 0, top: 0, bottom: 0, zIndex: 20000
                        }).click(function(){
                            $(".ui-dialog-content:visible").dialog("close");
                            $(".button-select-panel:visible").hide();
                        });
                        Component.previewFrame.$f("body").append(lp.configOverlay);
                    }
                    lp.configOverlay.show();
                },
                close: function () {
                    lp.configOverlay.hide();
                }
            });
            form.bind("change",function(){
                me.constructor.current.value = form.getValue();
                setVisible();
                me.triggerChange();
            });
            dialog.form = form;
        }
        dialog.form.setValue(this.value);
        this.constructor.current = this;
        setVisible();
        
        dialog.detached = dialog.element.children().detach();
        if (position) {
            position = $.extend({},position);
            
            var off = position.of.offset();
            var scrollY = $(Component.previewFrame.window).scrollTop();
            var frame_off = Component.previewFrame.frame.offset();
            var y = Math.floor(frame_off.top - scrollY);
            
            position.at = position.at.replace("top","top+"+y+"px");
            dialog.element.dialog("option","position",position);
        }
        
        $(".ui-dialog-content:visible").dialog("close");
        dialog.open();
    }

    dragButton = preact.createRef();
    configButton = preact.createRef();

    render(props,state) {
        var variant = this.value.variant;
        var tpl_f = this['tpl_'+variant] || (() => html`<div>Unsupported variant ${variant}</div>`);
        return html`
            <${BlockContext.Provider} value=${this}>
                <${ValueContext.Provider} value=${{name:"",value:this.value,defaultValue:this.defaultValue}}>
                    ${tpl_f.call(this,this.value,props,state)}
                <//>
            <//>
            <div class='cmp-controls'>
                ${ this.variantCount > 1 && html`
                    <div class='fa fa-chevron-left lp-button' onClick=${()=>this.prev()} />
                    <div class='fa fa-chevron-right lp-button' onClick=${()=>this.next()} />
                    <div class='lp-variant-label'>
                        ${variant}/${this.variantCount}
                    </div>
                `}
                ${ this.configForm && html`
                    <div 
                        ref=${this.configButton} 
                        class='fa fa-gear lp-button right' 
                        onClick=${ 
                            () => this.config({
                                my:"right top",
                                at:"right top",
                                of:$(this.configButton.current)
                            }) 
                        } 
                    />
                `}
                <div ref=${this.dragButton} class='fa fa-arrows lp-button right draggable' />
                <div class='fa fa-trash-o lp-button right' onClick=${()=>this.remove()} />
            </div>
        `;
    }

    componentDidMount() {
        $(this.dragButton.current).data("component",this.clientControl.cmp);
    }
}

lp.Block = Block;
Block.BlockContext = BlockContext;
Block.ValueContext = ValueContext;
exports = Block;
