function _t(s){ return s; }

require("./lpcandy.css");

require("./ui/internal/block.js");
require("./ui/internal/repeater.js");

require("./ui/internal/text.js");
require("./ui/internal/color.js");
require("./ui/internal/cover.js");
require("./ui/internal/logo.js");
require("./ui/internal/icon.js");
require("./ui/internal/formOrder.js");
require("./ui/internal/image.js");
require("./ui/internal/imageSrc.js");
require("./ui/internal/formButton.js");
require("./ui/internal/uploadButton.js");
require("./ui/internal/fontCombo.js");
require("./ui/internal/media.js");
require("./ui/internal/videoStream.js");
require("./ui/internal/countdown.js");
require("./ui/internal/galleryRepeater.js");
require("./ui/internal/galleryRepeaterImg.js");
require("./ui/internal/imageWithSignature.js");
require("./ui/internal/imageFancyboxWithoutTitle.js");

require("./lib/ymaps.js");
require("./ui/internal/map.js");

require("./ui/header.js");
require("./ui/order.js");
require("./ui/benefits.js");
require("./ui/services.js");
require("./ui/reasons.js");
require("./ui/gallery.js");
require("./ui/logos.js");
require("./ui/cases.js");
require("./ui/workOrder.js");
require("./ui/reviews.js");
require("./ui/maps.js");
require("./ui/footer.js");
require("./ui/video.js");
require("./ui/textBlock.js");
require("./ui/digits.js");
require("./ui/timer.js");


var dir = require.dir;

exports = function(templater_app,options) {
    var app = templater_app.extend({
        init: function (o) {
            teacss.ui.Control.prototype.init.call(this,o);
            Component.app = this;
            
            this.staticStyles = [dir + "/style/style.tea"];
            this.styles = [];
            
            var me = this;
            teacss.jQuery(function(){
                me.request('load',{cache:0},function (data){
                    try {
                        data = data || {};

                        me.settings = {};
                        me.settings.templates = $.parseJSON(data.templates || "{}");
                        me.settings.theme = $.parseJSON(data.theme || "{}");
                        teacss.functions.settings = me.settings

                        me.components = data.components;
                        me.settings.upload = data.upload;
                    } catch (e) {
                        alert(data);
                    }
                    
                    me.initUI();
                });            
            });
            
            this.bind("change",function(){
                if (me.skipSave) return;
                me.request('save',{
                    templates: JSON.stringify(me.settings.templates),
                    theme: JSON.stringify(me.settings.theme,undefined, 2)
                });
            });
        },
        
        initUI: function () {
            var me = this;
            this._super();
            
            this.frame.bind("init",function(){
                me.frame.$f("head").append(
                    "<link type='text/css' rel='stylesheet' href='"+dir+"/style/frame.css'>"
                );
            });

            this.frame.element.css({left:0});
            $(".editor-sidebar").detach();
            $(".preview-toolbar").width("100%");
            me.templateTabs.element.detach();
            me.view3dButton.element.detach();
        }
    });
    app(options);
}