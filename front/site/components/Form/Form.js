const FormContext = preact.createContext(false);

const Form = class extends Component {
    constructor(props) {
        super(props);
        this.value = props.value || {};
        this.state = {errors:{}};
    }

    componentDidUpdate(props) {
        if (props.value !== this.props.value) {
            this.setValue(this.props.value);
        }
    }

    setValue(change) {
        this.value = {...this.value,...change};
        this.setState({errors: {}});
    }

    setErrors(errors) {
        this.setState({errors:errors});
    }

    render(props) {
        return html`
            <${FormContext.Provider} value=${this}>
                <form ...${props} onSubmit=${(e)=>{
                    e.preventDefault();
                    props.onSubmit && props.onSubmit.call(this,e,this.value);
                }}>
                    ${props.children}
                </form>
            <//>
        `;
    }
}

const Error = (props) => html`
    <${FormContext.Consumer}>${(form)=>html`
        ${form.state.errors[props.name] && html`
            <span class="error">${form.state.errors[props.name]}</span>
        `}
    `}<//>
`;

const Text = (props) => html`
    <${FormContext.Consumer}>${(form)=>html`
        <input 
            type="text" 
            ...${props} 
            value=${form.value[props.name]} 
            onChange=${(e)=>{
                form.setValue({
                    [props.name]:e.target.value
                });
            }}
            class=${props['class'] || '' + (form.state.errors[props.name] ? ' error':'')}
        />
        <${Error} name=${props.name} />
    `}<//>
`;

const TextArea = (props) => html`
    <${FormContext.Consumer}>${(form)=>html`
        <textarea 
            ...${props} 
            value=${form.value[props.name]} 
            onChange=${(e)=>{
                form.setValue({
                    [props.name]:e.target.value
                });
            }}
            class=${props['class'] || '' + (form.state.errors[props.name] ? ' error':'')}
        />
        <${Error} name=${props.name} />
    `}<//>
`;

const Radio = (props) => html`
    <${FormContext.Consumer}>${(form)=>html`
        <input 
            type="radio" 
            ...${props} 
            checked=${form.value[props.name]==props.value} 
            onChange=${(e)=>{
                form.setValue({
                    [props.name]:props.value
                });
            }}
            class=${props['class'] || '' + (form.state.errors[props.name] ? ' error':'')}
        />
        ${form.value[props.name]==props.value && html`
            <${Error} name=${props.name} />
        `}
    `}<//>
`;

const Select = (props) => html`
    <${FormContext.Consumer}>${(form)=>html`
        <select
            ...${props} 
            value=${form.value[props.name]}
            onChange=${(e)=>{
                form.setValue({
                    [props.name]:e.target.value
                });
            }}
            class=${props['class'] || '' + (form.state.errors[props.name] ? ' error':'')}
        >
            ${props.children}
        <//>
        <${Error} name=${props.name} />
    `}<//>
`;

exports.FormContext = FormContext;
exports.Form = Form;
exports.Error = Error;
exports.Text = Text;
exports.TextArea = TextArea;
exports.Radio = Radio;
exports.Select = Select;