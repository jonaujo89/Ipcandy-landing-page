require("./Dialog.tea");
const {createPortal,Portal} = require("../Portal/Portal");

class Dialog extends preact.Component {
    constructor(props) {
        super(props);
        this.state = {
            open: props.open ? true : false,
            pos: { x:0, y:0 },
            dragging: false,
            rel: null // position relative to the cursor            
        };
    }

    open(pos) {
        this.setState({open:true,pos});
    }

    close() {
        this.setState({open:false});
    }

    componentDidUpdate(props, state) {
        this.mm = this.mm || this.onMouseMove.bind(this);
        this.mu = this.mu || this.onMouseUp.bind(this);

        if (this.state.dragging && !state.dragging) {
            document.addEventListener('mousemove', this.mm)
            document.addEventListener('mouseup', this.mu)
        } else if (!this.state.dragging && state.dragging) {
            document.removeEventListener('mousemove', this.mm)
            document.removeEventListener('mouseup', this.mu)
        }
        if (this.state.open && !state.open) {
            let rect = this.div.querySelector(".lp-dialog").getBoundingClientRect();
            var dh = document.documentElement.clientHeight;
            if (this.state.pos.y+rect.height>dh) {
                var y = dh-rect.height-1;
                if (y<0) y = 0;
                this.setState({
                    pos: {x:this.state.pos.x,y}
                });
            }
        }
    }

    onMouseDown(e) {
        if (e.button !== 0) return;
        this.setState({
            dragging: true,
            rel: {
                x: e.pageX - this.state.pos.x,
                y: e.pageY - this.state.pos.y
            }
        })
        e.stopPropagation()
        e.preventDefault()
    }
    
    onMouseUp(e) {
        this.setState({dragging: false})
        e.stopPropagation()
        e.preventDefault()
    }
    
    onMouseMove(e) {
        if (!this.state.dragging) return
        this.setState({
            pos: {
                x: e.pageX - this.state.rel.x,
                y: e.pageY - this.state.rel.y
            }
        })
        e.stopPropagation()
        e.preventDefault()
    }      

    render(props,state) {
        if (state.open) {
            if (!this.div) this.div = document.createElement("div");
            if (!this.div.parentElement) document.body.append(this.div);
        } else {
            if (this.div && this.div.parentElement) this.div.remove();
        }

        return this.div && createPortal(state.open && html`
            <div class="lp-dialog ${props.class || ""}" style=${{
                    width:props.width+"px",
                    left: this.state.pos.x + 'px',
                    top: this.state.pos.y + 'px'
                }}>
                <div class="lp-dialog-title" onMouseDown=${(e)=>this.onMouseDown(e)}>
                    ${props.title || ""}
                    <span class="lp-dialog-button-close" onClick=${()=>this.close()}>
                        <i class="fa fa-times" />
                    </span>
                </div>
                <div class="lp-dialog-content">
                    ${ props.children.call ? props.children() : props.children }
                </div>
            </div>
            ${ props.modal && html`
                <div class="lp-dialog-overlay" style=${{backgroundColor:props.overlayColor}} onClick=${()=>this.close()} />
            `}
        `,this.div);
    }
}
Dialog.defaultProps = {
    title: _t("Settings"),
    modal: true,
    width: 510,
    overlayColor: 'transparent'
};

class Prompts extends preact.Component {

    constructor(props) {
        super(props);
        this.state = {
            alert: {},
            confirm: {}
        }
    }

    componentDidMount() {
        let open = (what) => {
            what.open({
                x: document.body.clientWidth/2 - what.props.width/2,
                y: document.body.clientHeight/5
            });
        };

        Dialog.confirm = (options,cb) => {
            if ($.type(options)=="string") {
                options = {
                    text: options
                }
            };
            
            options.title = options.title || _t('Confirm');
            options.yes = options.yes || _t('Yes');
            options.no = options.no || _t('Cancel');
            options.cb = (res) => {
                this.confirm.close();
                cb(res);
            }
            
            this.setState({confirm:options});
            open(this.confirm)
        }

        Dialog.alert = (options,cb) => {
            if ($.type(options)=="string") {
                options = {
                    text: options
                }
            };
            options.title = options.title ||  _t('Alert');
            this.setState({alert:options});
            open(this.alert);
        }
    }

    render(props,state) {
        return html`
            <${Dialog} key="confirm" title=${state.confirm.title} width=300 overlayColor="rgba(0,0,0,0.3)" ref=${(r)=>this.confirm=r}>
                ${state.confirm.text}
                <div class="lp-dialog-buttons">
                    <button onClick=${()=>state.confirm.cb(true)}>${state.confirm.yes}</button>
                    <button onClick=${()=>state.confirm.cb(false)}>${state.confirm.no}</button>
                </div>
            <//>
            <${Dialog} key="alert" title=${state.alert.title} width=300 overlayColor="rgba(0,0,0,0.3)" ref=${(r)=>this.alert=r}>
                ${state.alert.text}
                <div class="lp-dialog-buttons">
                    <button onClick=${()=>this.alert.close()}>OK</button>
                </div>
            <//>
        `;
    }
}
preact.render(preact.h(Prompts,{}),document.createElement("div"));


exports.Dialog = Dialog;