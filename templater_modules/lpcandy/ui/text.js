// require("./../lib/medium.js");

lp.text = teacss.ui.control.extend({
    init: function (el) {
        var me = this;

        this._super({});
        this.element = el;
        
        /*var d = this.element[0].ownerDocument;
        var w = d.defaultView;
        
        var MediumClass = Medium(w,d);
        this.editor = new MediumClass({
            element: el[0],
            mode: Medium.richMode
        });
        
        me.element.bind('blur keyup paste copy cut mouseup', function () {
            var new_value = me.element.html();
            if (me.value!=new_value) {
                me.value = new_value;
                me.trigger("change");
            }
        })*/
    }
});