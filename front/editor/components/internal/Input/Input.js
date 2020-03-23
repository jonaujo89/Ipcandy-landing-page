require("./Input.tea");
const {Editable} = require("../../internal/Editable/Editable");

const Input = Editable((props)=>html`
    <div class="lp-input">
        <input type="text" value=${props.value} onInput=${(e)=>props.onChange(e.srcElement.value)} />
    </div>
`);
exports.Input = Input;