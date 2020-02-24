var preact = require("../lib/preact");
var h = preact.h;

var htm = require("../lib/htm");
var html = htm.bind(h);

var $ = teacss.jQuery;

class PreactComponent extends preact.Component {
    state = { value: {} };

    componentDidMount() {
        var me = this;
        this.props.clientControl.bind("setValue",updateState);
        this.props.clientControl.bind("change",updateState);

        function updateState(){
            me.setState({value:this.getValue()});
        }        
    }    

    componentDidUpdate() {
        this.props.clientControl.bindEditors();
    }

    render(props,state) {
        return props.clientControl.options.template(props,state);
    }
}

class PreactRepeater extends preact.Component {
}

window.pure = window.pure || {};
pure.Component = lp.block.extend({
    title: "",
    description: "",
    registerAll: function (app) {
        for (var id in pure) {
            var cls = pure[id];
            if (cls.title) {
                app.components[id] = {
                    name: cls.name,
                    description: cls.description,
                    area: false,
                    category: "Pure",
                    clientControl: "pure."+id,
                    id: id,
                    new: {
                        html: "<div></div>"
                    }
                }
            }
        }
    }
},{
    init: function (o) {
        this._super(o);
        var me = this;
        var vEl = h(PreactComponent,{clientControl:this});
        preact.render(vEl,this.element[0]);        
    },
    tpl: function (props,state) {
        var tpl_f,def_f;
        var variant = state.value.variant || 1;
        if (tpl_f = this['tpl_'+variant]) {
            if (def_f = this['tpl_default_'+variant]) {
                var def = def_f.call(this);
                state.value = $.extend(def,state.value || {});
            }
            return tpl_f.call(this,props,state);
        } else {
            return html`<div>Unsupported variant ${variant}</div>`;
        }
    }
});

function Container(props) {
    return html`<div class="container" style="background-color:${props.background_color}">`;
}

pure.Div = pure.Component.extendOptions({
    title: "Test component",
    description: "Test test"
},{
    tpl_1: function (props,state) {
        return html`
        <${Container} background_color=${state.value.background_color}> 
            <h1 class="title">
                <${Text} name="title" />
                <${Repeater} name="items">
                    <div class="question">
                        <${Text} name="question" />
                    </div>
                    <div class="answer">
                        <${Text} name="answer" />
                    </div>
                    <div class="items">
                        <${Repeater} name="icons">
                            <div class="icon">${id}</div>
                        <//>
                    </div>
                <//>
            </h1>
        <//>`;
    },

    tpl_default_1: function () {
        return {
            title: 'Hello title',
            items: [
                { question: "Hello?", answer: 'Hello!', icons: [{id:'bla',id:'mla'}] },
                { question: "Wazzup?", answer: 'Wazzup', icons: [{id:'foo',id:'boo'}] },
            ]
        };
    },

    configForm: {
        items: [
            { 
                type: lp.darkBlockColor, name: "background_color", margin: "10px 0 0 0"
            }                
        ]
    }
});


//const html = htm.bind(preact.h);


