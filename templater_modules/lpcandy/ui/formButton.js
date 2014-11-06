lp.formButton = lp.cover.extendOptions({
    change: function(){
        var me = this;
        //me.cover.detach();
        var button = me.element.find(".btn_form");
        button.empty();
        button.text(me.value.text).css({
            background: me.value.background || '',
        });
    },
    configForm: {
        title: "Order form",
        items: [            
            {
                type: 'label',
                value: "Button name:",
            },
            {
                name: "text", type: "text",
            },  
            { 
                type: "button", label: "Show button form", width: '45%', margin: "0 0 10px", click: function () {
                    var form = lp.formButton.current.element.find("form").parent()[0];
                    $(".ui-dialog-content:visible").dialog("close");
                    Component.previewFrame.window.alertify.genericDialog(form);
                }
            },
            { 
                type: "button", label: "Show form done", width: '45%',  margin: "0 5px 10px 10px", click: function () {
                    var form_done = lp.formButton.current.element.find(".form_done")[0];
                    $(".ui-dialog-content:visible").dialog("close");
                    Component.previewFrame.window.alertify.genericDialog(form_done);
                }
            },
            {
                name: "background", type: "colorPicker", width: 27, height: 27, margin: "0 0 10px 5px",
            },
        ]
    }
})
