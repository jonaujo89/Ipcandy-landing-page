var dir = require.dir;
Component.app.styles.push(
    dir + "/style/style.tea"
);

Component.app.bind("initUI",function(){
    Component.app.frame.bind("init",function(){
        Component.app.frame.$f("head").append(
            "<link type='text/css' rel='stylesheet' href='"+dir+"/style/frame.css'>"
        );
    });
    
    Component.app.frame.element.css({left:0});
    $(".editor-sidebar").hide();
});

require("./lpcandy.css");

require("./ui/block.js");
require("./ui/repeater.js");
require("./ui/header.js");

require("./ui/text.js");
require("./ui/logo.js");
require("./ui/icon.js");
require("./ui/uploadButton.js");
require("./ui/fontCombo.js");





















