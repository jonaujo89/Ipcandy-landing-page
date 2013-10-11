var $ = teacss.jQuery;
var dir = require.dir;
var base_url = dir + "/../../../";

require("./templater.css");

ui.wysiwyg = ui.wysiwyg.extendOptions({
    file_browser_callback: function (field_name, url, type, win) {
        window.KCFinder = {};
        window.KCFinder.callBack = function(url) {
            win.document.getElementById(field_name).value = url;
            popup.close();
        };            
        
        var popup = tinyMCE.activeEditor.windowManager.open({
            file:base_url+"files/browse.php?opener=tinymce4&lang=en&type=files",
            title: 'File Browser',
            width: 800, height: 600,
            resizable: "yes",
            inline: true,
            close_previous: "no",
            popup_css: false
        }, {
            window: win,
            input: field_name
        });
    }
});