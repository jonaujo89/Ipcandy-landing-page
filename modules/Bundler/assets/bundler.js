function bundler_build() {
    bundler.build();
}

window.bundler = {
    base_url: "",
    tea_sheets: [],
    js_sheets: [],
    build: function () {
        var me = this;
        var savePath = me.base_url;
 
        function bundlerRequest(entry_point,css,js) {
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
            teacss.build(sheet.src,{
                callback: function (files) {
                    bundlerRequest(sheet.entry_point,files[savePath+'/default.css'],files[savePath+'/default.js']);
                },
                stylePath: savePath,
                scriptPath: savePath,
            });                                        
        });

        this.js_sheets.forEach(function(sheet) {
            bundlerRequest(sheet.entry_point,"",sheet.build_js);
        });
    },
    absUrl: function (url) {
        var link = document.createElement("a");
        link.href = url;
        return link.href;
    }, 
    loadTea: function (entry_point,base_url,deps) {
        this.base_url = base_url;
        var $ = teacss.jQuery;
        var me = this;
        var entry_url = this.absUrl(base_url+entry_point);

        for (url in deps) teacss.files[me.absUrl(url)] = deps[url];
        var script = document.createElement("script");
        script.setAttribute("tea",entry_url);
        document.getElementsByTagName('head')[0].appendChild(script);

        this.tea_sheets.push({src:entry_url,entry_point:entry_point});

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
                var a = document.createElement('a');a.href = path;
                return a.href.replace(/http(s):\/\/[^\/]*?\//,'/');
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

    loadJS: function (entry_point,base_url,deps,options) {
        this.base_url = base_url;
        var me = this;
        var entry_url = this.absUrl(base_url+entry_point);

        function path_string(path) {
            return "'"+path.replace(/\\?("|')/g,'\\$1')+"'";
        }        

        var build_js = "("+me.loadRequire.toString()+")(window)\n";
        var build_css = "";
        me.loadRequire(window);
        
        for (var url in deps) {
            var path = url;
            var text = deps[url];
            if (text===false) {
                console.debug("Dependancy is missing:",url);
            }

            var ext_match = /\.[0-9a-z]+$/.exec(path);
            var ext = ext_match ? ext_match[0] : null;

            if (ext==".css") {
                var append = document.createElement("style");
                document.getElementsByTagName("head")[0].appendChild(append);

                var rel_text = text.replace(/url\(['"]?([^'"\)]*)['"]?\)/g, function( whole, part ) {
                    var rep = (!path_utils.isAbsoluteOrData(part) && href!==undefined) ? path_utils.dir(path_utils.clean(href)) + part : part;
                    if (rootStylePath) rep = path_utils.relative(rep,rootStylePath);
                    return 'url('+rep+')';
                });


                append.appendChild(document.createTextNode(text));
            }

            if (ext!='.js') continue;

            js = "(function(require){var exports={},module={exports:false};";

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
                js += "\n//# sourceURL=file://bundler"+path;
            }
            define(path,eval(js));     
        }

        var entry_uri = Object.keys(deps)[0];
        if (entry_uri) {
            require(entry_uri);
        } else {
            console.debug("Entry not found in deps",entry_url,deps);
        }

        build_js += "require("+path_string(entry_url)+")";
        this.js_sheets.push({entry_point:entry_point,build_js:build_js});
    }
}