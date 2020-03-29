require("./Text.tea");

const {Editable} = require("../Editable/Editable");

const Text = Editable(class extends preact.Component {

    constructor(props) {
        super(props);
        this.buttons = {};
        props.options.buttons.forEach((btn)=>{ this.buttons[btn]=true });
    }

    shouldComponentUpdate(nextProps) {
        return nextProps.value!=this.value || this.preview!=lp.app.state.preview;
    }

    componentDidMount() {
        this.editor.addEventListener("keydown",(e)=>{
            if (e.keyCode == 13 && this.props.options.oneline) {
                e.preventDefault();
            }
            if (e.metaKey || e.ctrlKey) {
                e.preventDefault();
                var char = String.fromCharCode(e.keyCode).toLowerCase();
                if (char=="b" && this.buttons.bold) this.cmd(e,"bold");
                if (char=="i" && this.buttons.italic) this.cmd(e,"italic");
            }
        });
        this.editor.addEventListener("input",()=>{
            this.value = this.editor.innerHTML;
            this.props.onChange(this.value);
        });
    }

    cmd(e,cmd) {
        e.preventDefault();
        e.stopPropagation();
        document.execCommand(cmd,false,null);
    }

    color(e) {
        e.preventDefault();
        e.stopPropagation();

        if (!this.colorInput) {
            this.colorInput = document.createElement("input");
            this.colorInput.type = "color";
            this.colorInput.addEventListener("input",()=>{
                document.execCommand('foreColor', false, this.colorInput.value);
            });
        }
        this.colorInput.click();
    }

    size(e,size) {
        e.preventDefault();
        e.stopPropagation();
        document.execCommand('fontSize', false,size);
    }

    render(props) {
        this.preview = lp.app.state.preview;
        this.value = props.value;
        return html`<div class="lp-text">
            <div ref=${(r)=>this.editor=r} class="lp-text-editor" dangerouslySetInnerHTML=${{__html:props.value}} contenteditable=${!this.preview} />
            ${!this.preview && html`<div class="lp-text-toolbar">
                ${this.buttons.bold && html`<span class="lp-text-bold" title=${_t("Bold")} onMouseDown=${(e)=>this.cmd(e,"bold")}>b</span>`}
                ${this.buttons.italic && html`<span class="lp-text-italic" title=${_t("Italic")} onMouseDown=${(e)=>this.cmd(e,"italic")}>i</span>`}
                ${this.buttons.deleted && html`<span class="lp-text-deleted" title=${_t("Deleted")} onMouseDown=${(e)=>this.cmd(e,"strikeThrough")}>d</span>`}
                ${this.buttons.removeformat && html`<span class="lp-text-removeformat" title=${_t("Clear format")} onMouseDown=${(e)=>this.cmd(e,"removeFormat")}>f</span>`}
                ${this.buttons.size && html`<span class="lp-text-size" title=${_t("Font size")}>
                    Tt
                    <span>
                        ${[-3,-2,-1,0,1,2,3].map((size)=>html`
                            <i onMouseDown=${(e)=>this.size(e,size+4)}>
                                ${(size>0 ? "+":"")+size}
                            </i>
                        `)}
                    </span>
                </span>`}
                ${this.buttons.fontcolor && html`<span class="lp-text-color" title=${_t("Text color")} onMouseDown=${(e)=>this.color(e)}>c</span>`}
            </div>`}
        </div>`;   
    }

});

Text.plain_heading = {'buttons':[],'oneline':true};
Text.default_heading = {'buttons':["bold","italic","deleted","removeformat"],'oneline':true};    
Text.size_heading = {'buttons':["bold","italic","deleted","size","removeformat"],'oneline':true};
Text.color_heading = {'buttons':["bold","italic","deleted","size","fontcolor","removeformat"],'oneline':true};
    
Text.plain_text = {'buttons':[] };
Text.default_text = {'buttons':["bold","italic","deleted","removeformat"],'oneline':false};    
Text.size_text = {'buttons':["bold","italic","deleted","size","removeformat"],'oneline':false};
Text.color_text = {'buttons':["bold","italic","deleted","size","fontcolor","removeformat"],'oneline':false};

Text.defaultProps = {
    options: Text.plain_text
};

exports.Text = Text;