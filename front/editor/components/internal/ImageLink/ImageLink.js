require("./ImageLink.tea");
const {Editable} = require("../Editable/Editable");

class ImageBox extends preact.Component {
    constructor(props) {
        super(props);
        ImageBox.__one = this;
    }

    goto(e,direction) {
        e.preventDefault();
        e.stopPropagation();
        const {link,others} = this.state;
        const current = others.indexOf(link);
        const next = (current+direction+others.length) % others.length;
        this.setState({link:others[next]});
    }

    render(props,{link,others,open,loaded}) {
        if (!open) return;
        const {href,title} = link.props;
        
        return html`<div class="lp-imagebox ${loaded ? "":"loading"}" onClick=${()=>this.setState({open:false})}>
            ${!loaded && html`<div class="lp-imagebox-loading" />`}
            <div class="lp-imagebox-image">
                <a href="#" class="lp-imagebox-prev" onClick=${(e)=>this.goto(e,-1)} ><i class="fa fa-chevron-left"/></a>
                <img src=${href} onLoad=${()=>this.setState({loaded:true})} />
                ${title && html`
                    <div class="lp-imagebox-title">${title}</div>
                `}
                <a href="#" class="lp-imagebox-next" onClick=${(e)=>this.goto(e,+1)}><i class="fa fa-chevron-right"/></a>
            </div>
        </div>`;
    }
    static instance() {
        if (!ImageBox.__one) {
            preact.render(preact.h(ImageBox),document.body.appendChild(document.createElement("div")));
        }
        return ImageBox.__one;
    }
}

const ImageLink = Editable(class extends preact.Component {
    componentDidMount() {
        this.getOtherLinks().push(this);
    }
    componentWillUnmount() {
        this.getOtherLinks().splice(this.getOtherLinks().indexOf(this),1);
    }
    getOtherLinks() {
        this.props.block.__imageLinks = this.props.block.__imageLinks || [];
        return this.props.block.__imageLinks;
    }
    open(e) {
        e.preventDefault();
        ImageBox.instance().setState({open:true,loaded:false,link:this,others:this.getOtherLinks()});
    }
    render(props) {
        return html`<a class="big_img" href=${props.href} onClick=${(e)=>this.open(e)} />`;
    }
})

exports.ImageLink = ImageLink;
exports.ImageBox = ImageBox;
