require("./Textarea.tea");
const {Editable} = require("../../internal/Editable/Editable");

const Textarea = Editable((props)=>html`
    <div class="lp-textarea">
        <textarea rows=${props.rows || 5} value=${props.value || ''} onInput=${(e)=>props.onChange(e.srcElement.value)}/>
    </div>
`);
exports.Textarea = Textarea;