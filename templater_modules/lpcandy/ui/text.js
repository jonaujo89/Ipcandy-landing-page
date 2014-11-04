require("./../lib/spacedText/spacedText.js");
require("./../lib/spacedText/spacedText.css");

lp.text = teacss.ui.control.extend({
    init: function (o) {
        var me = this;

        this._super($.extend({
            buttons: ["bold","italic","removeformat"],
            oneline: false
        },o));
        this.element = this.options.element;
        
        
        this.element.wrapInner('<div class="editor_text"></div>');
        var editor = this.element.find("> .editor_text");
        var toolbar = $('<div class="text_toolbar">').hide();
        this.element.append(toolbar);
        
        editor.spacedText({
            document: Component.previewFrame.frame[0].contentWindow.document,
            window: Component.previewFrame.frame[0].contentWindow,
            toolbarExternal: toolbar,
            focus: false,
            convertLinks: false,
            buttons: this.options.buttons,
            buttons_extra: [],
            oneline: this.options.oneline,
            on_change: $.proxy(function(val) {
                if (me.value != val) {
                    me.value = val;
                    me.trigger("change");
                }
            }, this)
        });
        
        if (toolbar.find("ul li").length < 1) {
            toolbar.css("visibility", "hidden")
        }        
        
        editor.on("focus", $.proxy(function(d) {
            toolbar.show()
        }, this)).on("blur", $.proxy(function(d) {
            if ($(d.relatedTarget).closest("ul.spacedText_toolbar").length < 1) {
                toolbar.hide()
            }
        }, this));
    }
});