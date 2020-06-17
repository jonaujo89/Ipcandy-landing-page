require('./ProjectForm.tea');
const {EntityForm} = require("../../../../site/components/EntityForm/EntityForm");
const {FormContext,Error,Text,TextArea} = require("../../../../site/components/Form/Form");
const {UploadButton} = require("../../../../editor/components/internal/UploadButton/UploadButton");

const MarkdownTextArea = (props) => {
    const textareaRef = preact.hooks.useRef();
    return html`
        <${FormContext.Consumer}>${(form)=>html`
            <${TextArea} ref=${textareaRef} name=${props.name} />

            <${UploadButton.Type} label=${_t('Select file')} onChange=${(url) => {
                let textareaEl = textareaRef.current.base;
                let value = textareaEl.value;
                let selectionStartPos = textareaEl.selectionStart;
                let selectionEndPos = textareaEl.selectionEnd;

                textareaEl.value = 
                    value.substring(0, selectionStartPos) + 
                    `![Image alt](${url}) *Image caption*`+ 
                    value.substring(selectionEndPos, value.length); 

                textareaEl.dispatchEvent(new Event('change'));
            }} />
            <${Error} name=${props.name} />
        `}<//>
    `;
}

const Thumbnail = (props) => html`
    <${FormContext.Consumer}>${(form)=> html`
        ${form.value[props.name] && html`
            <div class="thumb">
                <img src=${config.base_url+"/"+form.value[props.name]} />
            </div>
        `}
        <${UploadButton.Type} label=${_t('Select file')} onChange=${(url) => {
            form.setValue({[props.name]: url});
        }} />
        <${Error} name=${props.name} />
    `}<//>
`;

const ProjectForm = (props) => html`
    <${EntityForm} 
        ...${props}
        class="project-edit-form"
        validate=${(value)=>{
            let errors = {};
            if (!value.thumb) errors.thumb = _t('field is required');
            if (!value.title) errors.title = _t('field is required');
            if (!value.excerpt) errors.excerpt = _t('field is required');
            return errors;
        }}
    >
        <div class="form_field">
            <div class="form_title">
                <label>${_t('Image')}</label>
            </div>
            <${Thumbnail} class="thumb" name="thumb" />
        </div>
        <div class="form_field">
            <div class="form_title">
                <label>${_t('Title')}</label>
            </div>
            <${Text} name="title" />
        </div>
        <div class="form_field">
            <div class="form_title">
                <label>${_t('Short description')}</label>
            </div>
            <${TextArea} name="excerpt" />
        </div>
        <div class="form_field large_textarea">
            <div class="form_title">
                <label>${_t('Text')}</label>
            </div>
            <${MarkdownTextArea} name="text" />
        </div>
        <div class="form_field large_textarea">
            <button type="submit">${props.id ? _t('Save project') : _t('Create project')}</button>
        </div>
    <//>
`;

exports.ProjectForm = ProjectForm;