
window._t = function(s) { return window._t.hash[s] || s; };
window._t.hash = {};
window._t.load = function(h) { window._t.hash = {...window._t.hash,...h} }

if (window.locale_lang=="ru") require("./locale/ru.js");

window.lp = {};
require("./lib/jquery.min.js");

require("./style/font-awesome.css");
require("./style/page.css");
require("./style/pageFonts.css");
require("./style/components.tea");
require("../../public/assets/plugins/plugins.tea");

window.preact = require("./lib/preact");
window.preact.hooks = require("./lib/preact_hooks");
window.html = require("./lib/htm").bind(preact.h);

const {App} = require("./components/App");

require("./components/blocks/Benefits/Benefits");
require("./components/blocks/CoverBlock/CoverBlock");
require("./components/blocks/Faq/Faq");
require("./components/blocks/Gallery/Gallery");
require("./components/blocks/Timer/Timer");
require("./components/blocks/Header/Header");
require("./components/blocks/Services/Services");
require("./components/blocks/Reasons/Reasons");
require("./components/blocks/Cases/Cases");
require("./components/blocks/Stages/Stages");
require("./components/blocks/Feedback/Feedback");
require("./components/blocks/Order/Order");
require("./components/blocks/Logos/Logos");
require("./components/blocks/Footer/Footer");

lp.run = function (options) {
    options.isGlobal = true;
    $(()=> preact.render(preact.h(App,options),$("#app")[0]));
}