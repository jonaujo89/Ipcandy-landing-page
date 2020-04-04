const {Editable} = require("../Editable/Editable");

const UploadButton = Editable(class extends preact.Component{
    render(props) {
        const doUpload = (e) => {
            e.preventDefault();

            if (!this.uploader) {
                this.uploader = document.createElement("input");
                this.uploader.type = "file";
                this.uploader.accept = ".jpg,.jpeg,.png,.gif";
                this.uploader.style.position = "fixed";
                this.uploader.style.top = 0;
                this.uploader.style.left = 0;
                this.uploader.style.width = 0;
                this.uploader.style.zIndex = 10000;
                this.uploader.style.display = "none";
                document.body.appendChild(this.uploader);

                this.uploader.addEventListener("change",()=>{
                    var data = new FormData();
                    [...this.uploader.files].forEach((file,i) => {                
                        data.append('file-'+i, file);
                    });
                    data.append('name',this.props.uploadDir);
                    data.append('iconWidth',this.props.iconWidth);
                    data.append('iconHeight',this.props.iconHeight);

                    App.instance.request("upload",data,(data)=>{
                        data = JSON.parse(data);
                        if (data && data.length) {
                            if (data[0].error) {
                                alert(data[0].error);
                            } else {
                                var sub_url = data[0].url.substring(base_url.length);
                                if (sub_url[0]=="/") sub_url = sub_url.substring(1);
                                this.props.onChange(sub_url);
                            }
                        }
                    });
                });            
            }
            
            this.uploader.value = "";
            this.uploader.style.display = "";
            this.uploader.click();
            this.uploader.style.display = "none";
        }

        return html`
            <button onClick=${doUpload}>${props.label}</button>
        `;
    }
})
UploadButton.Type.defaultProps = {
    iconWidth: 64,
    iconHeight: 52,
    uploadDir: 'files'
}

exports.UploadButton = UploadButton;
