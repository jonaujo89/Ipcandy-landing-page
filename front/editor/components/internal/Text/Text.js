require("../../../../../public/assets/plugins/spacedText/spacedText.js");
require("../../../../../public/assets/plugins/spacedText/spacedText.css");

require("./Text.tea");

const {Editable} = require("../Editable/Editable");

const Text = Editable((props)=>
    html`<${EditableText} onChange=${(val) => props.onChange(val)} value=${props.value} options=${props.options} />`
);

Text.plain_heading = {'buttons':{"bold":false,"italic":false,"fontcolor":false,"removeformat":false},'oneline':true};
Text.default_heading = {'buttons':["bold","italic","deleted","removeformat"],'oneline':true};    
Text.size_heading = {'buttons':["bold","italic","deleted","size","removeformat"],'oneline':true};
Text.color_heading = {'buttons':["bold","italic","deleted","size","fontcolor","removeformat"],'oneline':true};
    
Text.plain_text = {'buttons':{"bold":false,"italic":false,"fontcolor":false,"removeformat":false}};
Text.default_text = {'buttons':["bold","italic","deleted","removeformat"],'oneline':false};    
Text.size_text = {'buttons':["bold","italic","deleted","size","removeformat"],'oneline':false};
Text.color_text = {'buttons':["bold","italic","deleted","size","fontcolor","removeformat"],'oneline':false};

class EditableText extends preact.Component {

    constructor(props) {
        super(props);
        this.editor = preact.createRef();
        this.toolbar = preact.createRef();
        this.value = undefined;
    }

    shouldComponentUpdate(nextProps) {
        return nextProps.value!=this.value;
    }

    componentDidMount() {
        if (lp.app.options.viewOnly) return;

        var $editor = $(this.editor.current);
        var $toolbar = $(this.toolbar.current).hide();
        var options = $.extend({
            oneline: false,
            buttons: ["bold","italic","removeformat"]
        },this.props.options || {});

        $editor.spacedText({
            document: document,
            window: window,
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
        return html`<div class="lp-text">
            <div ref=${this.editor} class="lp-text-editor" dangerouslySetInnerHTML=${{__html:props.value}} />
            <div ref=${this.toolbar} class="lp-text-toolbar" />
        </div`;        
    }
}

exports.Text = Text;