require("./Dialog.tea");
const {createPortal,Portal} = require("../Portal/Portal");


class Dialog extends preact.Component {

    constructor(props) {
        super(props);
        this.onMouseMove = this.onMouseMove.bind(this);
        this.onMouseUp = this.onMouseUp.bind(this);
        Dialog.list.push(this);
    }

    createElements() {
        if (!this.div) {
            this.div = document.createElement("div");
            this.div.className = "lp-dialog "+(this.props.class || "");
            this.div.style.width = parseInt(this.props.width)+"px";

            this.closeButton = document.createElement("span");
            this.closeButton.className = "lp-dialog-button-close";
            this.closeButton.innerHTML = '<i class="fa fa-times" />';
            this.closeButton.addEventListener("click",()=>this.close());

            this.divTitle = document.createElement("div");
            this.divTitle.className = "lp-dialog-title";
            this.divTitle.append(
                this.nodeTitle = document.createTextNode(this.props.title || ""),
                this.closeButton
            );
            this.divTitle.addEventListener("mousedown",(e)=>this.onMouseDown(e));

            this.divContent = document.createElement("div");
            this.divContent.className = "lp-dialog-content";

            this.divOverlay = document.createElement("div");
            this.divOverlay.className = "lp-dialog-overlay";
            if (this.props.overlayColor) this.divOverlay.style.backgroundColor = this.props.overlayColor;
            this.divOverlay.addEventListener("click",()=>this.close());

            this.div.append(this.divTitle,this.divContent);
        }
    }

    open(pos,onOpen) {
        if (!pos) {
            pos = {
                x: document.documentElement.clientWidth*0.5 - parseInt(this.props.width)*0.5,
                y: document.documentElement.clientHeight*0.2
            }
        }

        this.createElements();

        if (this.props.modal) document.body.append(this.divOverlay);
        document.body.append(this.div);

        this.nodeTitle.nodeValue = this.props.title || "";

        this.div.style.left = pos.x+"px";
        this.div.style.top = pos.y+"px";
        this.isOpen = true;
        this.setState({},()=>{
            let rect = this.div.getBoundingClientRect();
            var dh = document.documentElement.clientHeight;
            if (rect.top+rect.height>dh) {
                var y = dh-rect.height-1;
                if (y<0) y = 0;
                this.div.style.top = y+"px";
            }
            var dw = document.documentElement.clientWidth;
            if (rect.left<0) this.div.style.left = "0px";
            else if (rect.left+rect.width>dw) {
                var x = dw-rect.width-1;
                if (x<0) x = 0;
                this.div.style.left = x+"px";
            }
            this.props.onOpen && this.props.onOpen.bind(this)();
            onOpen && onOpen();
        });
    }

    onMouseDown(e) {
        if (e.button !== 0) return;
        this.dragging = true;

        document.addEventListener('mousemove', this.onMouseMove)
        document.addEventListener('mouseup', this.onMouseUp)

        this.rel = {
            x: e.pageX - this.div.offsetLeft,
            y: e.pageY - this.div.offsetTop
        };
        e.stopPropagation()
        e.preventDefault()
    }    

    onMouseUp(e) {
        this.dragging = false;
        document.removeEventListener('mousemove', this.onMouseMove)
        document.removeEventListener('mouseup', this.onMouseUp)

        e.stopPropagation()
        e.preventDefault()
    }
    
    onMouseMove(e) {
        if (!this.dragging) return
        this.div.style.left = (e.pageX - this.rel.x)+"px";
        this.div.style.top = (e.pageY - this.rel.y)+"px";

        e.stopPropagation()
        e.preventDefault()
    }     

    close() {
        this.divOverlay.remove();
        this.div.remove();
        this.isOpen = false;
    }

    static closeAll() {
        Dialog.list.forEach((one)=>{
            if (one.isOpen) one.close();
        });
    }

    render(props) {
        if (this.divContent) { 
            return createPortal(
                props.children.call ? props.children() : props.children,
                this.divContent
            );  
        }
    }
}
Dialog.list = [];
Dialog.defaultProps = {
    title: "",
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
            
            this.setState({confirm:options},()=>open(this.confirm));
        }

        Dialog.alert = (options,cb) => {
            if ($.type(options)=="string") {
                options = {
                    text: options
                }
            };
            options.title = options.title ||  _t('Alert');
            this.setState({alert:options},()=>open(this.alert));
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