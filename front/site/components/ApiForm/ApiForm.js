const {Form} = require("../Form/Form");

exports.ApiForm = (props) => html`
    <${Form} 
        ...${props} 
        onSubmit=${function(e,value) {
            SiteApp.fetchApi(props.href,value,(res)=>{
                if (res.errors) {
                    this.setErrors(res.errors);
                } 
                else {
                    props.onSuccess && props.onSuccess(res);
                }
            });
        }}
    />
`;


