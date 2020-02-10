window.bundler = {
    base_url: "",
    tea_sheets: [],
    js_sheets: [],
    build: function () {
        var me = this;

        function bundlerRequest(entry_point,css,js) {
            console.debug('minifying css '+entry_point);
            css = css ? CleanCSS.process(css) : '';
            console.debug('minifying js '+entry_point);
            js = js ? uglify(js) : '';

            var request = new XMLHttpRequest();
            request.open('POST', me.base_url + "bundler/build", true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.onload = function() {
                if (request.status >= 200 && request.status < 400) {
                    console.debug(request.responseText);
                }
            };        
            request.send(
                "entry_point="+encodeURIComponent(entry_point)+"&"+
                "css="+encodeURIComponent(css||"")+"&"+
                "js="+encodeURIComponent(js||"")
            );
        }

        this.tea_sheets.forEach(function(sheet) {
            
            var savePath = me.dir(me.absUrl(base_url+'/'+sheet.bundle_path));
            console.debug('building tea '+sheet.entry_point);

            teacss.build(sheet.src,{
                callback: function (files) {
                    bundlerRequest(sheet.entry_point,files[savePath+'/default.css'],files[savePath+'/default.js']);
                },
                stylePath: savePath,
                scriptPath: savePath,
            });                                        
        });

        this.js_sheets.forEach(function(sheet) {
            console.debug('building js '+sheet.entry_point);
            bundlerRequest(sheet.entry_point,sheet.build_css,sheet.build_js);
        });

        try {
            [].slice.call(document.getElementsByTagName('iframe')).forEach(function(fr){
                if (fr.contentWindow.bundler) fr.contentWindow.bundler.build();
            });
        } catch {};
    },

    absUrl: function (url) {
        var link = document.createElement("a");
        link.href = url;
        return link.href;
    }, 
    isAbsoluteOrData : function(path) {
        return /^(.:\/|data:|http:\/\/|https:\/\/|\/)/.test(path)
    },
    relativePath : function (path,from) {
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
    },
    dir: function (path) {
        return path.replace(/\/[^/]*?$/,'');        
    },

    init: function (base_url) {
        var me = this;
        me.base_url = base_url;
        setTimeout(function(){
            if (window.parent && window.parent!=window && !window.parent.bundler) {
                window.parent.bundler = me;
            }
        },1000);
    },

    loadTea: function (entry_point,bundle_path,base_url,deps) {
        
        this.init(base_url);

        var $ = teacss.jQuery;
        var me = this;
        var entry_url = this.absUrl(base_url+entry_point);

        for (url in deps) teacss.files[me.absUrl(url)] = deps[url];
        var script = document.createElement("script");
        script.setAttribute("tea",entry_url);
        document.getElementsByTagName('head')[0].appendChild(script);

        this.tea_sheets.push({src:entry_url,entry_point:entry_point,bundle_path:bundle_path});

        setTimeout(function(){
            teacss.update();
        },1);
    },

    loadRequire: function (w) {
        w.require = w.require || require_factory(location.href);
        w.require.cache = w.require.cache || { modules:{}, defines:{} }
        w.define = w.define || function (path,f) { w.require.cache.defines[path] = f };
        function require_factory(base) {
            var root = base.replace(/\/[^/]*?$/,'');
            function resolve(what) {
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
            var f = function (path) {
                var res_path = resolve(path);
                var ext_match = /\.[0-9a-z]+$/.exec(path);
                var ext = ext_match ? ext_match[0] : null;
                if (ext==".css") return;
                if (w.require.cache.modules[res_path]) return w.require.cache.modules[res_path];
                if (!w.require.cache.defines[res_path]) {
                    console.debug("Can't require on path: "+res_path);
                    return {};
                }
                return w.require.cache.modules[res_path] = w.require.cache.defines[res_path](require_factory(res_path));
            }            
            f.dir = root;
            return f;
        }
    },

    loadJS: function (entry_point,bundle_path,base_url,deps,options) {
        
        this.init(base_url);
        
        var me = this;
        var entry_url = this.absUrl(base_url+entry_point);
        var bundle_url = this.absUrl(base_url+bundle_path);
        var bundle_dir = this.dir(bundle_url);

        function path_string(path) {
            return "'"+path.replace(/\\?("|')/g,'\\$1')+"'";
        }        

        var build_js = "("+me.loadRequire.toString()+")(window)\n";
        var build_css = "";
        me.loadRequire(window);

        for (var url in deps) {
            var path = me.absUrl(url);
            var text = deps[url];

            var ext_match = /\.[0-9a-z]+$/.exec(path);
            var ext = ext_match ? ext_match[0] : null;
            
            if (ext==".css") {
                var head = document.getElementsByTagName("head")[0];
                var append = document.createElement("link");
                append.type = "text/css";
                append.rel = "stylesheet";
                append.href = path;
                head.appendChild(append);

                var css = text.replace(/url\(['"]?([^'"\)]*)['"]?\)/g, function( whole, part ) {
                    var rep = part;
                    if (!me.isAbsoluteOrData(part)) rep = me.absUrl(me.dir(path) + "/" + part);
                    return 'url('+me.relativePath(rep,bundle_dir)+')';
                });
                build_css += css + "\n";
                continue;
            }
            if (ext!='.js') continue;

            var js = "(function(require){var exports={},module={exports:false};";

            var transform = false;
            if (options.target=="es5") {
                transform = Babel.transform(text, { 
                    presets: ['es2015'],
                    filename: path,
                    sourceMap: true
                });
                transform.map.sources = [path];
                js += transform.code;
            } else {
                js += "\n"+text;
            }

            js += "\n" + "return module.exports || exports;})";
            build_js += "define("+path_string(path)+","+js+")\n";

            if (transform) {
                var mapURI = "data:application/json;charset=utf-8," + encodeURIComponent(JSON.stringify(transform.map));
                js += "\n//# sourceMappingURL="+mapURI;
            } else {
                js += "\n//# sourceURL="+path;
            }

            define(path,eval(js));     
        }

        require(entry_url);
        build_js += "require("+path_string(entry_url)+")";
        this.js_sheets.push({src:entry_url,entry_point:entry_point,build_js:build_js,build_css:build_css});
    }
}