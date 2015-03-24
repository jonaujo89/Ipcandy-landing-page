(function(){
    var cache = {
        files: {},
        modules: {},
        defined: {}
    };
    
    function path_string(path) {
        return "'"+path.replace(/\\?("|')/g,'\\$1')+"'";
    }
    
    // Path utils
    var path_utils = {
        isAbsoluteOrData : function(path) {
            return /^(.:\/|data:|http:\/\/|https:\/\/|\/)/.test(path)
        },
        absolute: function (src) {
            var a = document.createElement('a');
            a.href = src;
            return a.href;            
        },
        clean : function (part) {
            part = part.replace(/\\/g,"/");
            part = part.split("/");
            for (var p=0;p<part.length;p++) {
                if (part[p]=='..' && part[p-1]) {
                    part.splice(p-1,2);
                    p = p - 2;
                }
                if (part[p]==".") {
                    part.splice(p,1);
                    p = p - 1;
                }
            }
            return part = part.join("/");
        },
        dir : function (path) {
            var dir = path.replace(/\\/g,"/").split('/');dir.pop();dir = dir.join("/")+'/';
            return dir;
        },
        relative : function (path,from) {
            var pathParts = path.split("/");
            var fromParts = from.split("/");

            var once = false;
            while (pathParts.length && fromParts.length && pathParts[0]==fromParts[0]) {
                pathParts.splice(0,1);
                fromParts.splice(0,1);
                once = true;
            }
            if (!once || fromParts.length>2) return path;
            return new Array(fromParts.length+1).join("../") + pathParts.join("/");
        }
    }       
    
    var extensions = {
        js: {
            pre: function (path,callback,async) {
                if (cache.files[path]) return callback();
                getFile(path,function(text){
                    if (text===false) {
                        throw "Could not load module on path "+path;
                        callback(false);
                        return;
                    }
                    var m,r = /require\(\s*('|")(.*?)('|")\s*\)/g;
                    var deps = {}, count = 0;

                    while (m=r.exec(text)) {
                        deps[resolve(m[2],path)] = 1;
                        count++;
                    }

                    var loaded = 0;
                    for (var key in deps) {
                        extensions.js.pre(key,function(){
                            loaded++;
                            if (loaded==count) callback(text);
                        },async);
                    }
                    if (count==0) callback(text);
                },async);
            },
            wrap: function (path) {
                var js = "";
                js += "(function(path){";
                js += "var require = window.require.factory(path);";
                js += "var module = { exports: false };";
                js += "var exports = {};\n";
                
                js += cache.files[path];
                
                js += "\n"+"return module.exports || exports;";
                js += "})";
                return js;
            },
            get: function (path,callback) {
                var path_s = path_string(path);
                var js = this.wrap(path);
                js += "("+path_s+");//# sourceURL="+path;
                
                try {
                    var res = eval(js);
                } catch (e) {
                    console.debug(path);
                    throw(e);
                }
                callback(res);
            },
            build: function (path,callback,options) {
                if (options.scriptPath) {
                    var path_s = '_root_+'+path_string(path_utils.relative(path,options.scriptPath));
                } else {
                    var path_s = path_string(path);
                }
                var js = 'require.define('+path_s+','+this.wrap(path)+')\n';
                callback({js:js});
            }
        },
        css: {
            get: function (path,callback) {
                var head = document.getElementsByTagName("head")[0];
                var append = document.createElement("link");
                append.type = "text/css";
                append.rel = "stylesheet";
                append.href = path;
                head.appendChild(append);
                callback(true);
            },
            build: function (href,callback,options) {
                if (options.scriptPath) {
                    var path_s = '_root_+'+path_string(path_utils.relative(href,options.scriptPath));
                } else {
                    var path_s = path_string(href);
                }
                var js = 'require.define('+path_s+',true)\n';
                
                var rootStylePath = false;
                if (options.stylePath && path_utils.isAbsoluteOrData(options.stylePath)) {
                    rootStylePath = path_utils.absolute(options.stylePath);
                }            
                
                getFile(href,function(text){
                    text = text.replace(/url\(['"]?([^'"\)]*)['"]?\)/g, function( whole, part ) {
                        var rep = (!path_utils.isAbsoluteOrData(part) && href!==undefined) ? path_utils.dir(path_utils.clean(href)) + part : part;
                        if (rootStylePath) rep = path_utils.relative(rep,rootStylePath);
                        return 'url('+rep+')';
                    });
                    callback({js:js,css:text});
                },true);
            }
        },
        tea: {
            get: function (path,callback,async) {
                if (!async) throw "Can't load tea file synchronously";
                teacss.process(
                    path,
                    function(){
                        teacss.tea.Style.insert(document);
                        teacss.tea.Script.insert(document,callback);
                    },
                    document
                );
            }
        }
    }
    
    function build() {
        var args = Array.prototype.slice.call(arguments);
        var options = args[args.length-1] || {};
        var defaults = {
            callback: false,
            stylePath: false,
            scriptPath: false
        };
        for (var key in defaults) if (!options[key]) options[key] = defaults[key];
        if (options.scriptPath) options.scriptPath = path_utils.absolute(options.scriptPath);
        
        var pathes = [];
        var loaded = 0;
        var result = {
            css: "",
            js: "var require_min = (function(){\n"
        };
        
        result.js += "var _scripts= document.getElementsByTagName('script');\n";
        result.js += "var _root_ = _scripts[_scripts.length-1].src.split('?')[0].split('/').slice(0, -1).join('/')+'/';\n"
        result.js += "return function(f){\n";
        
        args[args.length-1] = function(){
            for (var path in cache.modules) {
                var mod = cache.modules[path];
                var ext = mod.ext;
                if (extensions[ext] && extensions[ext].build) {
                    pathes.push({ext:extensions[ext],path:path});
                }
            }
            
            for (var i=0;i<pathes.length;i++) {
                var one = pathes[i];
                one.ext.build(one.path,function(res){
                    if (res.css) result.css += res.css;
                    if (res.js) result.js += res.js;
                    done_cb();
                },options);
            }
        };
        
        function done_cb() {
            loaded++;
            if (loaded>=pathes.length && options.callback) {
                var out_path = [];
                for (var i=0;i<args.length;i++) {
                    var arg = args[i];
                    var path = path_utils.absolute(arg);
                    if (options.scriptPath) {
                        var path_s = '_root_+'+path_string(path_utils.relative(path,options.scriptPath));
                    } else {
                        var path_s = path_string(path);
                    }
                    if (arg!==true && !arg.call) out_path.push(path_s);
                }
                out_path.push('f || function(){}');
                
                result.js += 'require('+out_path.join(", ")+')\n';
                result.js += "}})();\n";
                setTimeout(function(){ options.callback(result); },1);
                
            }
        }
        window.require.apply(window.required,args);
    }
    
    function define(path,f) {
        var path = path_utils.absolute(path);
        cache.files[path] = "defined";
        cache.defined[path] = f;
        return f;
    }
    
    function resolve(what,base) {
        var root = require.root.replace(/\/$/,'');
        if (/^\.{1,2}\//.test(what)) {
            if (base===undefined) base = require.base;
            if (base===undefined) base = require.root;
            
            var path = base.split("/");
            path.pop(); 
            path.push(what);
            path = path.join("/");
        } 
        else if (what[0]=='/' || /^http/.test(what)) {
            path = what;
        }
        else {
            path = require.root + "/" + what;
        }
        
        var a = document.createElement('a');
        a.href = path;
        return a.href;
    }
        
    function getFile(path,callback,async) {
        if (cache.files[path]) {
            callback(cache.files[path]);
            return;
        }
        var xhr = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : (XMLHttpRequest && new XMLHttpRequest()) || null;
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                var text = cache.files[path] = xhr.status==200 ? xhr.responseText:false;
                try 
                {
                    callback(text);
                } 
                catch (e) {
                    setTimeout(function(){ throw e; },1);
                }
            }
        }
        xhr.open('GET', path, async);
        xhr.send();
    }
        
    var factory = function (base) {
        var r = function () {
            var old = window.require.base;
            window.require.base = base;
            
            var args = Array.prototype.slice.call(arguments);
            var last = args[args.length-1];
            var async = (last && (last.call || last===true)) ? args.pop() : false;
            
            var pathes = [];
            var exts = [];
            var loaded = 0;
            var result = [];
            
            for (var i=0;i<args.length;i++) {
                var path,ext;
                if (args[i].ext!==undefined) {
                    path = resolve(args[i].path);
                    ext = args[i].ext;
                } else {
                    path = resolve(args[i]);
                    ext = (path.match(/[^\\\/]\.([^.\\\/]+)$/) || [null]).pop();
                    if (!ext) {
                        path = path + ".js";
                        ext = "js";
                    }
                }
                pathes.push(path);
                exts.push(ext);
            }
            for (var i=0;i<pathes.length;i++) {
                var path = pathes[i];
                var ext = exts[i];
                if (cache.modules[path] || cache.defined[path]) { loaded_cb(); continue; }
                
                var pre = extensions[ext].pre;
                if (pre)
                    pre(path,loaded_cb,async);
                else
                    loaded_cb();
            }
            if (pathes.length==0) loaded_cb();
            
            function loaded_cb() {
                loaded++;
                if (loaded>=args.length) {
                    var got = 0;
                    function next() {
                        if (got<pathes.length) {
                            var path = pathes[got];
                            var ext = exts[got];
                            if (!cache.modules[path]) {
                                
                                function get_cb(res) {
                                    cache.modules[path] = {result:res,ext:ext};
                                    result.push(res);
                                    got++; next();
                                }
                                
                                var defined = cache.defined[path];
                                if (defined) {
                                    get_cb(defined.call ? defined(path) : defined);
                                } else {
                                    extensions[ext].get(path,get_cb,async);
                                }
                            } else {
                                result.push(cache.modules[path].result);
                                got++; next();
                            }
                        } else {
                            if (result.length==0) result = false;
                            else if (result.length==1) result = result[0];
                            if (async && async.call) async.call(this,result);
                            window.require.base = old;
                        }
                    }
                    next();
                }
            }
            return result;
        }
        r.path = base;
        r.dir = r.path ? r.path.replace(/\\/g, '/').replace(/\/[^\/]*\/?$/, '') : r.path;
        r.define = define;
        return r;
    }
    
    if (!window.require) {
        window.require = factory();
        window.require.root = ".";
        window.require.extensions = extensions;
        window.require.factory = factory;
        window.require.cache = cache;
        window.require.getFile = getFile;
        window.require.build = build;
        window.require.path = path_utils;
    }
})();