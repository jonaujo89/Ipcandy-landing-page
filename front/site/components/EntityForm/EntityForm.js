require("./EntityForm.tea");
const {Form} = require("../Form/Form");
const {Layout} = require("../../pages/Layout/Layout");

exports.EntityForm = (props) => {
    const [loading, setLoading] = preact.hooks.useState(false);
    const [formValue, setFormValue] = preact.hooks.useState({});

    if (props.id) {
        preact.hooks.useEffect(() => SiteApp.fetchApi(
            "entity-list",
            {id: [props.id], type:props.entity.id},
            ({list})=> setFormValue({...list[0]})
        ),[]);
    }

    return html`
        <${Layout} 
            title=${props.entity.labelMultiple}
            loading=${loading}
        >
            <${Form} 
                ...${props} 
                value=${formValue}
                class="entity-form ${props.class}"
                onSubmit=${function(e,value) {
                    setLoading(true);
                    let errors = false;
                    if (this.props.validate) errors = this.props.validate(value);

                    if (errors && Object.keys(errors).length) {
                        this.setErrors(errors);
                        setLoading(false);
                    } else {
                        SiteApp.fetchApi("entity-edit",{
                            ...value,
                            id: props.id || 0,
                            type:props.entity.id
                        },(res)=>{
                            props.onSuccess && props.onSuccess(res);
                            SiteApp.redirect(props.entity.id);
                        });
                    }
                }}
            />
        <//>
    `;
}