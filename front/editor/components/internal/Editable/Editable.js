const {Block,BlockContext,ValueContext} = require("../Block/Block");

function Editable(Type) {
    class TypeWrap extends preact.Component {
        shouldComponentUpdate(props,state) {
            if (props.alwaysRender) return true;
            if (lp.app.state.preview!=this.preview) return true;
            if (props.value==this.props.value) return false;
            return true;
        }

        render(props) {
            //console.debug("editable",props.fullName,props.value);
            this.preview = lp.app.state.preview;
            return preact.h(ValueContext.Provider,{value:{value:props.value,name:props.fullName}},
                preact.h(Type,{...props,ref:(r)=>props.wrapper.editable=r})
            ); 
        }
    }

    function getSub(value,name) {
        name.split(".").forEach((part)=>{
            if (part) {
                value = value ? value[part] : undefined;
            }
        });
        return value;
    }

    const EditableType = class extends preact.Component {
        render (props) {
            var block = preact.hooks.useContext(BlockContext);
            var parentContext = preact.hooks.useContext(ValueContext);

            var fullName, value, defaultValue;

            if (props.name && props.name[0]=="@") {
                let name = props.name.substring(1);
                fullName = name;
                value = getSub(block.value,name);
                defaultValue = getSub(block.defaultValue,name);
            } 
            else if (props.name) {
                fullName = parentContext.name ? (parentContext.name+"."+props.name) : props.name;
                value = getSub(parentContext.value || {},props.name || "");
                defaultValue = getSub(parentContext.defaultValue || {},props.name || "");
            }
            else {
                fullName = parentContext.name;
                value = parentContext.value;
                defaultValue = parent.defaultValue;
            }

            var onChange = (val,cb) => block.editorChange(fullName,val,cb);

            var show = true;
            var when = props.showWhen;
            if (when) {
                var val = parentContext.value;
                for (var key in when) {
                    if (Array.isArray(when[key])) {
                        if (!when[key].includes(val[key])) show = false;
                    } else {
                        if (when[key]!=val[key]) show = false;
                    }
                }
            }
            return show && preact.h(TypeWrap,{...props,fullName,value,defaultValue,onChange,block,wrapper:this});
        }
    }
    EditableType.Type = Type;
    return EditableType;
}

exports.Editable = Editable;