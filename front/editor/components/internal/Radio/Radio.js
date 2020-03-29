require("./Radio.tea");
const {Editable} = require("../Editable/Editable");

const Radio = Editable(class extends preact.Component {
    constructor(props) {
        super(props);
        var cnt = Radio.cnt = (Radio.cnt || 0)+1;
        this.name = 'radio_input_'+cnt;
    }
    render(props) {
        return html`
            <div class="lp-radio ${props.inline ? '':'lp-radio-block'}">
                ${props.items.map((item,i)=>html`
                    <label>
                        <input type='radio' value=${item.value} name=${this.name} checked=${item.value==props.value} onChange=${()=>{
                            var val = undefined;

                            [...this.base.getElementsByTagName("input")].forEach(function(input){
                                if (input.checked) val = input.value;
                            });
                            props.onChange(val);
                        }} />
                        ${item.label}
                    </label>
                `)}
            </div>
        `
    }
});
Radio.defaultProps = {
    inline: true
}

exports.Radio = Radio;