lp.formControls = {};
    
lp.formControls.text = teacss.ui.composite.extendOptions({
    selectLabel: "Text",
    selectIcon: "fa fa-font",
    tpl: function (val) {
        return $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label),
                $('<input class="form_field_text" type="text">'),
                $('<div class="error">')
            )
        );
    }
},{
    items: [
        "Field label",
        { type: "text", name: "label" },
        "Field description",
        { type: "text", name: "desc" },
        { type: "check", name: "required", label: "Is required?" }
    ]
});

lp.formControls.textarea = lp.formControls.text.extend({
    selectLabel: "Textarea",
    selectIcon: "fa fa-bars",
    tpl: function (val) {
        return $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label),
                $('<textarea class="form_field_textarea">'),
                $('<div class="error">')
            )
        );
    }
},{});

lp.formControls.checkbox = teacss.ui.composite.extendOptions({
    selectLabel: "Checkbox",
    selectIcon: "fa fa-check-square-o"
},{
    items: [
        "Field label",
        { type: "text", name: "label" }
    ]
});

lp.formControls.select = teacss.ui.composite.extendOptions({
    selectLabel: "Select",
    selectIcon: "fa fa-toggle-down",
    default: { options: "Option 1\nOption 2\nOption 3" },
    tpl: function (val) {
        var select;
        var ret = $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label),
                select = $('<select class="form_field_select">'),
                $('<div class="error">')
            )
        );
        $.each(val.options.split("\n"),function(){
            select.append($("<option>").text(this));
        });
        return ret;
    }
},{
    items: [
        "Field label",
        { type: "text", name: "label" },
        "Field description",
        { type: "text", name: "desc" },
        "Options",
        { type: "textarea", name: "options" }
    ]
});

lp.formControls.radio = lp.formControls.select.extend({
    selectLabel: "Radio",
    selectIcon: "fa fa-dot-circle-o",
},{});

lp.formControls.file = lp.formControls.text.extend({
    selectLabel: "File",
    selectIcon: "fa fa-paperclip"
},{});


lp.form = lp.cover.extendOptions({
},{
    change: function(){
        var val = this.getValue();
        var fields_div = this.element.find(".form_fields").empty();
        $.each(val.fields,function(f,field){
            var sub = lp.formControls[field.type];
            fields_div.append(sub.tpl(field));
        });
        this.element.find(".form_submit .form_field_submit")
            .attr("class","form_field_submit "+val.button.color)
            .find("span").text(val.button.label);
    },
    configForm: {
        title: "Form",
        items: [
            {
                name: "fields", 
                repeaterClass: "lp-field-repeater",
                type:  teacss.ui.repeater.extend({
                    init: function (o) {
                        this._super(o);
                        
                        var me = this;
                        this.addCombo = teacss.ui.combo({
                            label: "Add Field",
                            comboWidth: 300,
                            itemTpl: function (item) {
                                return $("<div>")
                                    .addClass("lp-add-field "+item.sub.selectIcon)
                                    .text(item.sub.selectLabel)
                                    .mousedown(function(){
                                        me.addElement($.extend(
                                            item.sub.default || {},
                                            { type: item.type, label: item.sub.selectLabel }
                                        ));
                                        me.trigger("change");
                                    });
                            },
                            items: function () {
                                var items = [];
                                $.each(lp.formControls,function (key,sub){
                                    if (sub && sub.selectLabel) {
                                        items.push({ value: key, sub: sub, type: key });
                                    }
                                });
                                return items;
                            }
                        });
                        this.addButton.replaceWith(this.addCombo.element);
                    },
                    itemTemplate: function (el) {
                        var ret = this._super(el);
                        var content = ret.find(".ui-repeater-item-content").hide();
                        ret.find(".ui-repeater-item-title").css({cursor:"pointer"})
                        .prepend($("<span>"))
                        .click(function(){
                            var visible = content.is(":visible");
                            ret.parent().find(".ui-repeater-item-content").hide();
                            content.toggle(!visible);
                        });
                        return ret;
                    },                    
                    updateLabel: function (el) {
                        var val = el.getValue();
                        var title = el.itemContainer.find(".ui-repeater-item-title").addClass(lp.formControls[val.type].selectIcon);
                        title.children("span").eq(0).text(val.label);
                    },
                    addElement: function (val) {
                        val = val || {};
                        var el = lp.formControls[val.type]();
                        el.setValue(val);
                        var me = this;
                        el.bind("change",function(){
                            me.updateLabel(el);
                            me.trigger("change");
                        });
                        this.push(el);
                        this.updateLabel(el);
                        return el;
                    }
                })
            },
            { type: "label", value: "Button text:", width: "53%", margin: "0 0 5px" },
            { type: "label", value: "Button color:", width: "47%", margin: "0 0 5px" },
            { type: "text", name: "button.label", width: "50%", margin: "0 3% 15px 0" },
            { 
                type: lp.color, name: "button.color", width: "47%", iconSize: 15,
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
            {
                type: "button", label: "Edit confirmation window", click: function () {
                    alert(123);
                }
            }
        ]
    }
})