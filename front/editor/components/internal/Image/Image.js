const {Cover} = require("../Cover/Cover");
const {Editable} = require("../Editable/Editable");
const {Dialog} = require("../Dialog/Dialog");
const {UploadButton} = require("../UploadButton/UploadButton");

const Image = Editable(class extends preact.Component {
    render(props) {
        return html`
            <${Cover}
                configForm=${html`
                    <${Dialog} title=${_t("Image")} width=300>
                        <${UploadButton} label="${_t('Upload image file')}" />
                    <//>
                `}
                customCover=${true}
                ref=${(r)=>this.coverCmp=r}
            >
                <div class="img">
                    <img src="${config.base_url+"/"+props.value}" alt="" />
                    ${ !Editor.instance.state.preview && html`
                        <div ref=${(r)=>this.cover=r} class='cmp-cover cmp-config-cover fa fa-gear' onClick=${()=>this.coverCmp.openConfig(this.cover)} />
                    `}
                </div>
            <//>
        `;
    }
});

exports.Image = Image;