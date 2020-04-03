const {Editable} = require("../Editable/Editable");
const {ValueContext} = require("../Block/Block");
const {Combo} = require("../Combo/Combo");
const {formControls} = require("FormControl");

const FieldsRepeater = Editable((props)=>{

    [selected,setSelected] = preact.hooks.useState(-1);

    function addField(type) {
        var cls = formControls[type];
        var item_default = {...cls.default,type:type,label:cls.title};
        var new_value = [...props.value,item_default];
        setSelected(new_value.length-1);
        props.onChange(new_value);            
    }

    function removeField(idx) {
        var new_value = [...props.value];
        new_value.splice(idx,1);
        props.onChange(new_value);
        if (selected==idx) setSelected(-1);
    }

    return html`<div class="lp-form-repeater">
        <div class="lp-form-repeater-items">
            ${props.value.map((sub,sub_idx)=>{
                var type = formControls[sub.type];
                return html`
                    <div class="lp-form-repeater-item ${sub_idx==selected ? "selected":""}">
                        <div class="lp-form-repeater-item-title" onClick=${()=>setSelected(sub_idx==selected ? -1 : sub_idx)}>
                            <i class="fa fa-${type.icon}" />
                            ${sub.label || "["+(sub.placeholder || "")+"]"}
                            <span class="lp-form-repeater-button-remove" onClick=${()=>removeField(sub_idx)}>
                                <i class="fa fa-times" />
                            </span>
                        </div>
                        <div class="lp-form-repeater-item-content">
                            <${ValueContext.Provider} value=${{value:sub,name:props.fullName+"."+sub_idx}}>
                                <${type.configForm} />
                            <//>
                        </div>
                    </div>
                `;
            })}
        </div>
        <div class="lp-form-repeater-item">
            <div class="lp-form-repeater-item-content">
                <${Combo.Type} 
                    onChange=${(type_id)=>addField(type_id)}
                    dropdown=${true}
                    preview=${false}
                    comboWidth=${282}
                    closeOnSelect=${true}
                    tpl_item=${(item,is_button)=>
                        is_button ? 
                        _t('Add Field'):
                        html`
                            <div class="lp-form-repeater-type-item">
                                <i class="fa fa-${item.type.icon}"></i>
                                ${item.type.title}
                            </div>
                        `
                    }
                    items=${()=>{
                        return Object.keys(formControls).map((id)=>{
                            return {type:formControls[id],value:id}
                        })
                    }}
                />
            </div>
        </div>
    </div>`
});

exports.FieldsRepeater = FieldsRepeater;