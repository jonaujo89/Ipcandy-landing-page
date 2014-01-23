var opts = {
    table: true, addLabel: '+ Add Field',
    repeaterClass: 'ui-form-repeater',
    items:[{
        type: 'text', name: 'label', tableLabel: '<b>Field Label</b><br>This is the name which will appear on the EDIT page'
    },{
        type: 'text', name: 'name',  tableLabel: '<b>Field Name</b><br>Single word, no spaces. Underscores and dashes allowed'
    },{
        type: 'switcher', showSelect: true, tableLabel: "<b>Field Type</b>",
        repository: {
            text: {
                label: 'Text',
                items: [{
                    type: 'text', tableLabel: '<b>Instructions</b><br>Instructions for authors. Shown when submitting data'
                },{
                    type: 'text', name: 'default', tableLabel: '<b>Default value</b>'
                }]
            },
            textarea: {
                label: 'Textarea',
                items: [{
                    type: 'text', tableLabel: '<b>Instructions</b><br>Instructions for authors. Shown when submitting data'
                },{
                    type: 'textarea', name: 'default', tableLabel: '<b>Default value</b>'
                }]
            },
            wysiwyg: {
                label: 'Rich Text Editor',
                items: [{
                    type: 'text', tableLabel: '<b>Instructions</b><br>Instructions for authors. Shown when submitting data'
                },{
                    type: 'textarea',  name: 'default', tableLabel: '<b>Default value</b>'
                }]
            },
            repeater: {
                label: 'Repeater',
                items: [{
                    type: 'text', tableLabel: '<b>Instructions</b><br>Instructions for authors. Shown when submitting data'
                },{
                    type: 'formRepeater', tableLabel: '<b>Fields</b>', name: 'fields', addLabel: '+ Add Sub Field'
                }]
            }
        }
    }]
}

teacss.ui.formRepeater = teacss.ui.repeater.extendOptions(opts).extend({
    itemTemplate: function (el) {
        var panel = this._super(el);
        var title = panel.find("> .ui-repeater-item-title");
        
        var label,name,type;
        title.append(
            label = $("<div class='item-label'></div>"),
            name = $("<div class='item-name'></div>"),
            type = $("<div class='item-type'></div>")
        );
        
        function updateLabels() {
            var val = el.getValue();
            
            label.text(val.label || 'New Field');
            name.text(val.name || 'new_field');
            var vtype = el.element.find(".combo-label").eq(0).text();
            type.text(vtype || 'Text');
        };
        updateLabels();
        el.bind("change",updateLabels);
        el.bind("setValue",updateLabels);
        
        title.click(function(){
            panel.toggleClass('expanded');
        });
        return panel;
    },
    newElement: function () {
        var el = this._super();
        el.itemContainer.addClass('expanded');
    }
});