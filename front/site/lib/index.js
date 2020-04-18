window._t = function(s) { return window._t.hash[s] || s; };
window._t.hash = {};
window._t.load = function(h) { window._t.hash = {...window._t.hash,...h} }

window.config = {};

window.preact = require("./preact/preact");
window.preact.hooks = require("./preact/preact_hooks");
window.Component = preact.Component;
window.html = require("./preact/htm").bind(preact.h);