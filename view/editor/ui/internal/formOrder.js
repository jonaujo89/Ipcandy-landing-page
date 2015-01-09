lp.formControls = {};
    
lp.formControls.text = teacss.ui.composite.extendOptions({
    selectLabel: _t("Text"),
    selectIcon: "fa fa-font",
    tpl: function (val) {
        var star_required, show_desc;
        if (val.required) {star_required = " <i>*</i>"};
        if (val.desc) {show_desc = $('<div class="desc">').text(val.desc)} else {show_desc=""};
        return $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label).append(star_required),
                show_desc,
                $('<input class="form_field_text" type="text">'),
                $('<div class="error">')
            )
        );
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" },
        _t("Field description"),
        { type: "text", name: "desc" },
        { type: "check", name: "required", label: _t("Is required?"), margin:"0" }
    ]
});

lp.formControls.textarea = lp.formControls.text.extend({
    selectLabel: _t("Text area"),
    selectIcon: "fa fa-bars",
    tpl: function (val) {
        var star_required, show_desc;
        if (val.required) {star_required = " <i>*</i>"};
        if (val.desc) {show_desc = $('<div class="desc">').text(val.desc)} else {show_desc=""};
        return $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label).append(star_required),
                show_desc,
                $('<textarea class="form_field_textarea" rows="3">'),
                $('<div class="error">')
            )
        );
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" },
        _t("Field description"),
        { type: "text", name: "desc" },
        { type: "check", name: "required", label: _t("Is required?"), margin:"0" }
    ]
});

lp.formControls.checkbox = teacss.ui.composite.extendOptions({
    selectLabel: _t("Checkbox"),
    selectIcon: "fa fa-check-square-o",
    tpl: function (val) {
        var show_desc;
        if (val.desc) {show_desc = $('<div class="desc">').text(val.desc)} else {show_desc=""};
        return $('<div class="form_field">').append(
            $('<label>').append(
                show_desc,
                $('<div class="form_field_checkbox_value"><label><input class="form_field_checkbox" value="'+val.label+'" type="checkbox"/> '+val.label+'</label>'),
                $('<div class="error">')
            )
        );
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" }
    ]
});

lp.formControls.select = teacss.ui.composite.extendOptions({
    selectLabel: _t("Select"),
    selectIcon: "fa fa-toggle-down",
    default: { options: _t("Вариант 1\nВариант 2\nВариант 3") },
    tpl: function (val) {
        var show_desc, select;
        if (val.desc) {show_desc = $('<div class="desc">').text(val.desc)} else {show_desc=""};
        var ret = $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label),
                show_desc,
                select =  $('<select class="form_field_select">'),
                $('<div class="error">')
            )
        );
        $.each(val.options.split("\n"),function(){
            select.append($("<option>").text(this));
        });
        $('.form_field_select>').wrap('<div class="form_field_select_wrap"></div>');
        return ret;
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" },
        _t("Field description"),
        { type: "text", name: "desc" },
        _t("Options"),
        { type: "textarea", name: "options", height: 55, width: 448 }
    ]
});

lp.formControls.radio = teacss.ui.composite.extendOptions({
    selectLabel: _t("Radio"),
    selectIcon: "fa fa-dot-circle-o",
    default: { options: _t("Вариант 1\nВариант 2\nВариант 3") },
    tpl: function (val) {
        var show_desc, radio, checked;
        if (val.desc) {show_desc = $('<div class="desc">').text(val.desc)} else {show_desc=""};
        var ret = $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label),
                show_desc,
                radio = $('<div class="form_field_radio_values">'),
                $('<div class="error">')
            )
        );
        $.each(val.options.split("\n"),function(index, element){
            var form_field = radio.parents('div.form_field');
            console.log($(form_field)[0]);
            index == 0 ? checked = "checked" : "";
            radio.append($('<div class="form_field_radio_value"><label><input name="radio_'+val.label+'" class="form_field_radio" value="'+this+'" type="radio" '+ checked +'/> '+this+'</label>'));
        });
        return ret;
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" },
        _t("Field description"),
        { type: "text", name: "desc" },
        _t("Options"),
        { type: "textarea", name: "options", height: 55, width: 448 },
        { type: "check", name: "required", label: _t("Is required?"), margin:"0" }
    ]
});

lp.formControls.file = teacss.ui.composite.extendOptions({
    selectLabel: _t("File"),
    selectIcon: "fa fa-paperclip",
    tpl: function (val) {
        var star_required, show_desc;
        if (val.required) {star_required = " <i>*</i>"};
        if (val.desc) {show_desc = $('<div class="desc">').text(val.desc)} else {show_desc=""};
        return $('<div class="form_field">').append(
            $('<label>').append(
                $('<div class="field_title">').text(val.label).append(star_required),
                show_desc,
                $('<input class="form_field_file" multiple="" type="file">'),
                $('<div class="error">')
            )
        );
    }
},{
    items: [
        _t("Field label"),
        { type: "text", name: "label" },
        _t("Field description"),
        { type: "text", name: "desc" },
        { type: "check", name: "required", label: _t("Is required?"), margin:"0" }
    ]
});

lp.formOrder = lp.cover.extendOptions({
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
        title: _t("Form"),
        items: [
            {
                name: "fields", 
                repeaterClass: "lp-field-repeater",
                type:  teacss.ui.repeater.extend({
                    init: function (o) {
                        this._super(o);
                        
                        var me = this;
                        this.addCombo = teacss.ui.combo({
                            label: _t("Add Field"),
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
            { type: "label", value: _t("Button text:"), width: "53%", margin: "0 0 5px" },
            { type: "label", value: _t("Button color:"), width: "47%", margin: "0 0 5px" },
            { type: "text", name: "button.label", width: "50%", margin: "0 3% 12px 0" },
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
                type: "button", label: _t("Show success window"), width: 'auto',  margin: "0 0 10px 0px", click: function () {
                    lp.formOrder.showFormSuccess();
                }
            }
        ]
    }
})



