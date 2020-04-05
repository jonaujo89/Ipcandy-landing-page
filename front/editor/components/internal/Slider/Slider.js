require("./Slider.tea");
const {Repeater} = require("../Repeater/Repeater");
const {Editable} = require("../Editable/Editable");

const Slider = class extends preact.Component {

    constructor(props) {
        super(props);
        this.position = 0;
    }

    setPosition(pos) {
        var blocks = this.base.getElementsByClassName("item_blocks")[0];
        var first = blocks.children[0];
        var total = blocks.children.length;
        var perPage = Math.round(blocks.clientWidth/first.clientWidth);

        if (pos=="last") {
            this.position = Math.max(0,total-perPage);
        } 
        else if (pos=="same") {
            this.position = Math.max(0,Math.min(this.position,total-perPage));
        }
        else {
            this.position = (pos + total-perPage+1) % (total-perPage+1);
        }
        first.style.marginLeft = -(this.position*100/perPage)+"%";
    }

    next(e) {
        e.preventDefault();
        this.setPosition(this.position+1);
    }

    prev(e) {
        e.preventDefault();
        this.setPosition(this.position-1);
    }

    render(props) {
        return html`
            <div class="lp-slider">
                <a href="#" class="lp-slider-prev" onClick=${(e)=>this.prev(e)} ><i class="fa fa-chevron-left"/></a>
                <a href="#" class="lp-slider-next" onClick=${(e)=>this.next(e)}><i class="fa fa-chevron-right"/></a>
                <${Repeater} 
                    ...${props} 
                    onAdd=${()=>this.setPosition("last")} 
                    onRemove=${()=>this.setPosition("same")}
                />
            </div>
        `;
    }
};

exports.Slider = Slider;