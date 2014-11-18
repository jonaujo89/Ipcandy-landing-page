lp.formButton = lp.cover.extendOptions({
    change: function(){
        var me = this;
        var button = me.element.find(".btn_form");
        button.text(me.value.text).prop("class", "btn_form "+me.value.color);
    },
    configForm: {
        title: "Order form",
        items: [            
            { type: "label", value: "Button text:", width: "53%", margin: "10px 0 5px 0" },
            { type: "label", value: "Button color:", width: "47%", margin: "10px 0 5px 0" },
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
            { type: "label", value: "Form:", width: "100%", margin: "0 0 5px" },
            { 
                type: "button", label: "Show form", width: 'auto', margin: "0 0 10px", click: function () {
                    lp.formButton.showForm();
                }
            },
            { 
                type: "button", label: "Show success window", width: 'auto',  margin: "0 0 10px 8px", click: function () {
                    lp.formButton.showFormSuccess();
                }
            }
        ]
    }
})
