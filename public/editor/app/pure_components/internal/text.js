const Editable = require("./editable");
const $ = teacss.jQuery;

class Text extends Editable {

    static plain_heading = {'buttons':{"bold":false,"italic":false,"fontcolor":false,"removeformat":false},'oneline':true};
    static default_heading = {'buttons':["bold","italic","deleted","removeformat"],'oneline':true};    
    static size_heading = {'buttons':["bold","italic","deleted","size","removeformat"],'oneline':true};
    static color_heading = {'buttons':["bold","italic","deleted","size","fontcolor","removeformat"],'oneline':true};
        
    static plain_text = {'buttons':{"bold":false,"italic":false,"fontcolor":false,"removeformat":false}};
    static default_text = {'buttons':["bold","italic","deleted","removeformat"],'oneline':false};    
    static size_text = {'buttons':["bold","italic","deleted","size","removeformat"],'oneline':false};
    static color_text = {'buttons':["bold","italic","deleted","size","fontcolor","removeformat"],'oneline':false};

    render(props,state) {
        this.passValue();
        return html`<${EditableText} onChange=${(val) => this.setValue(val)} value=${this.value} options=${props.options} />`;
    }
}

class EditableText extends preact.Component {

    editor = preact.createRef();
    toolbar = preact.createRef();
    value = undefined;

    shouldComponentUpdate(nextProps) {
        return nextProps.value!=this.value;
    }

    componentDidMount() {
        var $editor = $(this.editor.current);
        var $toolbar = $(this.toolbar.current).hide();
        var options = $.extend({
            oneline: false,
            buttons: ["bold","italic","removeformat"]
        },this.props.options || {});

        $editor.spacedText({
            document: Component.previewFrame.frame[0].contentWindow.document,
            window: Component.previewFrame.frame[0].contentWindow,
            toolbarExternal: $toolbar,
            focus: false,
            convertLinks: false,
            buttons: options.buttons,
            buttons_extra: [],
            oneline: options.oneline,
            on_change: (val) => {
                this.value = val;
                if (this.props.onChange) this.props.onChange(val);
            }
        });
        
        if ($toolbar.find("ul li").length < 1) {
            $toolbar.css("visibility", "hidden")
        }        
        
        $editor.on("focus", () => $toolbar.show());
        $editor.on("blur", (d) => {
            if ($(d.relatedTarget).closest("ul.spacedText_toolbar").length < 1) {
                $toolbar.hide();
            }
        });
    }

    render(props,state) {
        this.value = props.value;
        return html`<div>
            <div ref=${this.editor} class="editor_text" dangerouslySetInnerHTML=${{__html:props.value}} />
            <div ref=${this.toolbar} class="text_toolbar" />
        </div`;        
    }
}

exports = Text;