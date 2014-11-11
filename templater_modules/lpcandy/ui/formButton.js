lp.formButton = lp.cover.extendOptions({
},{
    configForm: {
        title: "Order form",
        items: [
            { 
                type: "button", label: "Show button form", click: function () {
                    var form = lp.formButton.current.element.find("form").parent()[0];
                    $(".ui-dialog-content:visible").dialog("close");
                    Component.previewFrame.window.alertify.genericDialog(form);
                }
            }
        ]
    }
})