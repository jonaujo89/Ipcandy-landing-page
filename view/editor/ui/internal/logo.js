lp.logo = lp.cover.extendOptions({
    change: function(){
        var me = this;
        var logo_div = me.element.find(".logo");
        logo_div.empty(logo_div);
        if (me.value.type=="image") {
            logo_div.append($("<img>").attr({src:base_url+"/"+me.value.url,width:me.value.size+"%"}));
        } else {
            logo_div.append($('<div class="company_name">').text(me.value.text).css({
                fontStyle: me.value.italic ? 'italic' : '',
                fontWeight: me.value.bold ? 'bold' : '',
                fontFamily: me.value.font || '',
                color: me.value.color || '',
                fontSize: me.value.fontSize ? me.value.fontSize + 'px' : ''
            }));
        }
    },
    configForm: {
        title: _t("Logotype"),
        items: [
            {
                name: 'type', type: 'radio', margin: "15px 0 20px", items: [
                    { label: _t("Image logo"), value: 'image' },
                    { label: _t("Text name logo"), value: 'text' }
                ]
            },
            {
                name: 'url', type: 'uploadButton', label: _t('Upload file'),
                showWhen: { type: 'image' }
            },
            {
                type: 'label',
                value: _t("Company name:"), margin: "10px 0 5px",
                showWhen: { type: 'text' }
            },
            {
                name: "text", type: "text",
                showWhen: { type: 'text' }
            },
            { 
                type: 'label',
                value: _t("Font settings:"), margin: "10px 0 5px",
                showWhen: { type: 'text' }
            },
            {
                name: "font", type: "fontCombo", width: '50%',
                showWhen: { type: 'text' }
            },
            {
                name: "bold", label: "<b>B</b>", type: "check", width: 27, height: 27, 
                margin: "0 0 10px 5px", showCheckbox: false,
                showWhen: { type: 'text' }
            },
            {
                name: "italic", label: "<i>I</i>", type: "check", width: 27, height: 27, 
                margin: "0 0 10px 5px", showCheckbox: false,
                showWhen: { type: 'text' }
            },
            {
                name: "color", type: "colorPicker", width: 27, height: 27, margin: "0 0 10px 5px",
                showWhen: { type: 'text' }
            },
            _t("Size:"),
            {
                margin: "5px 0",
                name: 'size', type: 'slider', min: 0, max: 100,
                showWhen: { type: 'image' }
            },
            {
                margin: "5px 0",
                name: 'fontSize', type: 'slider', min: 14, max: 30,
                showWhen: { type: 'text' }
            }
        ]
    }
})