require("./Select.tea");
const {Editable} = require("../../internal/Editable/Editable");

const Select = Editable((props)=>html`
    <div class="lp-select">
        <select value=${props.value} onChange=${(e)=>props.onChange(e.target.value)}>
            ${props.children}
        </select>
    </div>
`);
exports.Select = Select;