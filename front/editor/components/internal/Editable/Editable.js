const {Block,BlockContext,ValueContext} = require("../Block/Block");

function Editable(Type) {
    class TypeWrap extends preact.Component {
        shouldComponentUpdate(props,state) {
            if (props.alwaysRender) return true;
            if (props.value==this.props.value) return false;
            return true;
        }

        render(props) {
            console.debug("editable",props.fullName,props.value);
            return preact.h(ValueContext.Provider,{value:{value:props.value,name:props.fullName}},
                preact.h(Type,{...props})
            ); 
        }
    }

    const EditableType = class extends preact.Component {
        render (props) {
            var block = preact.hooks.useContext(BlockContext);
            var parentContext = preact.hooks.useContext(ValueContext);

            var fullName, value, defaultValue;

            if (props.name && props.name[0]=="@") {
                fullName = props.name;
                value = block.value[props.name];
                defaultValue = block.defaultValue[props.name];
            } else {
                fullName = parentContext.name ? (parentContext.name+"."+props.name) : props.name;
                value = (parentContext.value || {})[props.name || ""];
                defaultValue = (parentContext.defaultValue || {})[props.name || ""];
            }
            var onChange = (val) => block.editorChange(fullName,val,true);

            var show = true;
            var when = props.showWhen;
            if (when) {
                var val = block.value;
                for (var key in when) {
                    if (Array.isArray(when[key])) {
                        if (!when[key].includes(val[key])) show = false;
                    } else {
                        if (when[key]!=val[key]) show = false;
                    }
                }
            }
            return show && preact.h(TypeWrap,{...props,fullName,value,defaultValue,onChange});
        }
    }
    EditableType.Type = Type;
    return EditableType;
}

exports.Editable = Editable;