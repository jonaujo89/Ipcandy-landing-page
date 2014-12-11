lp.cover = teacss.ui.control.extend({
    showForm: function () {
        if (!this.current) return;
        $(".ui-dialog-content:visible").dialog("close");
        Component.previewFrame.window.alertify.genericDialog(this.current.form[0]);
    },
    showFormSuccess: function () {
        if (!this.current) return;
        $(".ui-dialog-content:visible").dialog("close");
        Component.previewFrame.window.alertify.genericDialog(this.current.formSuccess[0]);
    }
},{
    init: function (o) {
        var me = this;
        this._super(o);
        this.element = this.options.element;
        me.cover = $("<div class='cmp-cover fa fa-gear'>")
            .click(function(){ 
                var off = me.cover.offset();
                var scrollY = $(Component.previewFrame.frame[0].contentWindow).scrollTop();
                var frame_off = Component.previewFrame.frame.offset();
                
                var y = Math.floor(frame_off.top - scrollY);
                me.config({my:"left top",at:"right+5px top+"+y+"px",of:me.cover,collision:"flipfit"});
            })
            .appendTo(this.element);
        
        me.form = this.element.find(".form");
        me.formSuccess = this.element.find(".form_done");
        
        if (me.options.init) me.options.init.call(me);
    },
    config: lp.block.prototype.config
});