require("./Input.tea");
const {Editable} = require("../../internal/Editable/Editable");

const Input = Editable((props)=>html`
    <div class="lp-input">
        <input class=${props.class} type=${props.type} value=${props.value} min=${props.min} max=${props.max} onInput=${(e)=>props.onChange(e.srcElement.value)} />
    </div>
`);
Input.defaultProps = {
    type: 'text'
}
exports.Input = Input;