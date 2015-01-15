lp.formButton = lp.cover.extendOptions({
    change: function(){
        var jq = Component.previewFrame.window.$;
        var me = this;
        var button = me.element.find(".btn_form");        
        button.attr("href", me.value.type == 'link' ? me.value.a_href : ''); 
        button.text(me.value.text).prop("class", "btn_form "+ me.value.color || "btn_form");
    },
    configForm: {
        title: _t("Order button"),        
        items: [
            { type: "label", value: _t("Button behavior after click:"), width: "100%", margin: "2px 0" },
            {
                name: 'type', type: 'radio', margin: "5px 0 15px", items: [
                    { label: _t("Show order form"), value: 'form' },
                    { label: _t("Go to the link"), value: 'link' }
                ]
            },    
            { type: "label", value: _t("Button text:"), width: "53%", margin: "5px 0 2px 0" },
            { type: "label", value: _t("Button color:"), width: "47%", margin: "5px 0 2px 0" },
            { type: "text", name: "text", width: "50%", margin: "0 3% 10px 0" },
            { 
                type: lp.color, name: "color", width: "47%", iconSize: 15, margin: "0 0 8px",
                items: [
                    { value: 'blue', color: '#0187BC' },
                    { value: 'green', color: '#3E9802' },
                    { value: 'orange', color: '#FD6F00' },
                    { value: 'purple', color: '#8C33D2' },
                    { value: 'purple_light', color: '#9581BF' },
                    { value: 'rose', color: '#F372A4' },
                    { value: 'red', color: '#CE0707' },
                    { value: 'yellow', color: '#FFC415' }
                ]
            },
            { type: "label", value: _t("Form"), width: "100%", margin: "5px 0", showWhen: { type: 'form' } },
            { type: "label", value: _t("Link"), width: "100%", margin: "5px 0", showWhen: { type: 'link' } },
            { 
                type: "button", label: _t("Show form"), width: 'auto', margin: "0 0 10px", showWhen: { type: 'form' }, click: function () {
                    lp.formButton.showForm();
                }
            },
            { 
                type: "button", label: _t("Show success window"), width: 'auto',  margin: "0 0 10px 8px", showWhen: { type: 'form' }, click: function () {
                    lp.formButton.showFormSuccess();
                }
            },
            { type: "text", name: "a_href", width: "100%", margin: "0 3% 10px 0", showWhen: { type: 'link' } },
        ]
    }
})
