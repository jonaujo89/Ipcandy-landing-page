// require("./../lib/medium.js");

lp.text = teacss.ui.control.extend({
    init: function (o) {
        var me = this;

        this._super(o);
        this.element = this.options.element;
        
        this.element[0].contentEditable = true;
        
        /*var d = this.element[0].ownerDocument;
        var w = d.defaultView;
        
        var MediumClass = Medium(w,d);
        this.editor = new MediumClass({
            element: this.element[0],
            mode: Medium.richMode
        });*/
        
        me.element.bind('blur keyup paste copy cut mouseup', function () {
            var new_value = me.element.html();
            if (me.value!=new_value) {
                me.value = new_value;
                me.trigger("change");
            }
        })
    }
});