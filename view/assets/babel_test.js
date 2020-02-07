(function (w) {
        w.require = w.require || require_factory(location.href);
        w.require.cache = w.require.cache || { modules:{}, defines:{} }
        w.define = w.define || function (path,f) { w.require.cache.defines[path] = f };
        function require_factory(base) {
            function resolve(what) {
                var root = base.replace(/\/[^/]*?$/,'');
                if (/\.[0-9a-z]+$/i.test(what)==false) what += ".js";
                if (/^\.{1,2}\//.test(what)) {
                    var path = base.split("/");
                    path.pop(); 
                    path.push(what);
                    path = path.join("/");
                } 
                else if (what[0]=='/' || /^http/.test(what)) path = what;
                else path = root + "/" + what;
                var a = document.createElement('a');a.href = path;return a.href;
            }
            return function (path) {
                var res_path = resolve(path);
                if (w.require.cache.modules[res_path]) return w.require.cache.modules[res_path];
                if (!w.require.cache.defines[res_path]) {
                    console.debug("Can't require on path: "+path);
                    return {};
                }
                return w.require.cache.modules[res_path] = w.require.cache.defines[res_path](require_factory(path));
            }            
        }
    })(window)
define('https://uxcandy.com/~vscode/dev_gavex/lpcandy/view/assets/babel/app.js',(function(require){var exports={},module={exports:false};"use strict";

var _module = require("./module");

var m = require("./module.js");

(0, _module.hello)();
m.bla();return module.exports || exports;}))
define('https://uxcandy.com/~vscode/dev_gavex/lpcandy/view/assets/babel/module.js',(function(require){var exports={},module={exports:false};"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.hello = hello;
exports.bla = bla;

function hello() {
  console.log("hello");
}

function bla() {
  console.log("bla");
}return module.exports || exports;}))
require('https://uxcandy.com/~vscode/dev_gavex/lpcandy/view/assets/babel/app.js')