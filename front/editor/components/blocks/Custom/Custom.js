const {Block,Liquid,Dialog} = require("../../internal");

class Custom extends Block { 
    
    static get title() { return _t('HTML') }
    static get description() { return _t('Custom html+css') }

    tpl_1(val) {
        return html`
            <div class="container-fluid custom">
                <div class="container">
                    <${Liquid} name='liquid' />
                </div>
            </div>
        `
    }

    tpl_default_1() {
        return {
            liquid: Liquid.tpl_default()
        }
    }
}

Block.register('Custom', exports = Custom);