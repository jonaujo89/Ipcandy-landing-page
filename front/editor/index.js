
window._t = function(s) { return window._t.hash[s] || s; };
window._t.hash = {};
window._t.load = function(h) { window._t.hash = {...window._t.hash,...h} }

if (window.locale_lang=="ru") require("./locale/ru.js");

window.lp = {};

require("./style/font-awesome.css");
require("./style/page.css");
require("./style/pageFonts.css");
require("./style/components.tea");

window.preact = require("./lib/preact");
window.preact.hooks = require("./lib/preact_hooks");
window.html = require("./lib/htm").bind(preact.h);

const {App} = require("./components/App");

require("./components/blocks/CoverBlock/CoverBlock");
require("./components/blocks/Header/Header");
require("./components/blocks/Order/Order");
require("./components/blocks/StickyMenu/StickyMenu");
require("./components/blocks/Benefits/Benefits");
require("./components/blocks/Services/Services");
require("./components/blocks/Reasons/Reasons");
require("./components/blocks/Gallery/Gallery");
require("./components/blocks/Cases/Cases");
require("./components/blocks/Stages/Stages");
require("./components/blocks/Feedback/Feedback");
require("./components/blocks/Map/Map");
require("./components/blocks/Logos/Logos");
require("./components/blocks/Footer/Footer");
require("./components/blocks/Video/Video");
require("./components/blocks/TextBlock/TextBlock");
require("./components/blocks/Timer/Timer");
require("./components/blocks/Numbers/Numbers");
require("./components/blocks/Faq/Faq");
require("./components/blocks/Custom/Custom"); 

lp.run = function (options) {
    options.isGlobal = true;
    document.addEventListener("DOMContentLoaded",()=>{
        preact.render(preact.h(App,options),document.getElementById("app"));
    });
}