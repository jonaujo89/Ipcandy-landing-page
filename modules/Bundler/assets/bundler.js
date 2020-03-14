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
            js = js || '';
            if (js) {
                var terserResult = Terser.minify(js);
                if (terserResult.error) {
                    window._js = js;
                    console.debug("minify error", terserResult.error);
                } else {
                    js = terserResult.code;
                }
            }

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
            
            var savePath = me.dir(me.absUrl(base_url+sheet.bundle_path));
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

    loadRequire: function (w,root) {
        w.require = function (path) {
            var res_path = root+path;
            if (w.require.cache.modules[res_path]) return w.require.cache.modules[res_path];
            if (!w.require.cache.defines[res_path]) {
                console.debug("Can't require on path: "+res_path);
                return {};
            }
            return w.require.cache.modules[res_path] = w.require.cache.defines[res_path]();
        }
        w.require.cache = w.require.cache || { modules:{}, defines:{} }
        w.define = w.define || function (path,f) { w.require.cache.defines[root+path] = f };
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

        var sheet = {
            src: entry_url,
            entry_point: entry_point,
            build_js: "("+me.loadRequire.toString()+")(window,"+path_string(base_url)+")\n",
            build_css: ""
        };

        me.loadRequire(window,base_url);

        for (let rel_path in deps) {
            let abs_url = me.absUrl(base_url)+rel_path;
            let text = deps[rel_path];
            if (text===false) continue;

            var ext_match = /\.[0-9a-z]+$/.exec(rel_path);
            var ext = ext_match ? ext_match[0] : null;

            let css_filter = (css_in) => {
                return css_in.replace(/url\(['"]?([^'"\)]*)['"]?\)/g, function( whole, part ) {
                    var rep = part;
                    if (!me.isAbsoluteOrData(part)) rep = me.absUrl(me.dir(abs_url) + "/" + part);
                    return 'url('+me.relativePath(rep,bundle_dir)+')';
                });
            };

            if (ext=='.js') {
                var js = "(function(){var exports={},module={exports:false};";
                js += "\n"+text;
                js += "\n" + "return module.exports || exports;})";

                sheet.build_js += "define("+path_string(rel_path)+","+js+")\n";
                define(rel_path,eval(js+"\n//# sourceURL="+abs_url));
            }
            if (ext==".css") {
                sheet.build_js += "define("+path_string(rel_path)+",()=>true)\n";
                define(rel_path,function(){
                    var head = document.getElementsByTagName("head")[0];
                    var append = document.createElement("link");
                    append.type = "text/css";
                    append.rel = "stylesheet";
                    append.href = abs_url;
                    head.appendChild(append);

                    sheet.build_css += css_filter(text) + "\n";
                    return true;
                });
            }
            if (ext==".tea") {
                sheet.build_js += "define("+path_string(rel_path)+",()=>true)\n";
                define(rel_path,function(){

                    teacss.getFile = function (path,cb) {
                        var rel = me.relativePath(me.absUrl(path),me.absUrl(base_url.slice(0,-1)));
                        if (deps[rel]) return cb(deps[rel]);
                        cb(""); 
                        console.debug(rel);
                        console.debug("Can't import tea file",path);
                    }

                    teacss.process(abs_url,()=>{
                        teacss.tea.Style.insert(document);
                        teacss.tea.Script.insert(document);

                        teacss.tea.Style.get(
                            (css) => sheet.build_css += css+"\n",
                            css_filter
                        );
                        teacss.tea.Script.get((js) => sheet.build_js += js);
                    });
                });
            }            
        }

        require(entry_point);
        sheet.build_js += "require("+path_string(entry_point)+")";
        
        this.js_sheets.push(sheet);
    }
}