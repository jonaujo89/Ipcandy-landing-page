const {Editable} = require("../Editable/Editable");

const UploadButton = Editable((props)=>{

    const doUpload = (e) => {
        e.preventDefault();

        if (!this.uploader) {
            this.uploader = $("<input type='file' accept='.jpg,.jpeg,.png,.gif'>").css({position:'fixed',top:0,left:0,zIndex:10000,width:0}).hide().appendTo("body");
            this.uploader.change(()=>{
                var data = new FormData();
                $.each(this.uploader[0].files, function(i, file) {                
                    data.append('file-'+i, file);
                });
                data.append('_type','upload');
                data.append('name',props.uploadDir);
                data.append('iconWidth',props.iconWidth);
                data.append('iconHeight',props.iconHeight);

                $.ajax({
                    url: lp.app.options.ajax_url,
                    data: data,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(data){
                        if (data && data.length) {
                            if (data[0].error) {
                                alert(data[0].error);
                            } else {
                                var sub_url = data[0].url;
                                if (sub_url[0]=="/") sub_url = sub_url.substring(1);
                                props.onChange(sub_url);
                            }
                        }
                    }
                });            
            });            
        }
        this.uploader.val("").show();
        this.uploader.click();
        this.uploader.hide();
    }

    return html`
        <button onClick=${doUpload}>${props.label}</button>
    `;
})
UploadButton.defaultProps = {
    iconWidth: 64,
    iconHeight: 52,
    uploadDir: 'files'
}

exports.UploadButton = UploadButton;
