window.bundler = {
    base_url: "",
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
    isAbs : (path) => /^(.:\/|http:\/\/|https:\/\/|\/)/.test(path),
    isData: (path) => /^(data:)/.test(path),
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
    cleanPath: function (path) {
        var parts = path.split("/");
        var pos = 0;
        while (parts[pos]) {
            if (parts[pos]==".") parts.splice(pos,1);
            else if (pos > 0 && parts[pos]==".." && parts[pos-1]!="..") parts.splice(pos-- - 1,2);
            else pos++;
        }
        return parts.join("/");
    },
    dir: (path) => path.replace(/\/[^/]*?$/,''),
    ext: (path) => ((/\.[0-9a-z]+$/.exec(path) || {})[0] || ".").slice(1),

    loadRequire: function (w,root) {
        w.require = function (path) {
            var res_path = root+path;
            if (w.require.cache.modules[res_path]) return w.require.cache.modules[res_path];
            if (!w.require.cache.defines[res_path]) {
                console.debug("Can't require on path: ",path,res_path);
                return {};
            }
            return w.require.cache.modules[res_path] = w.require.cache.defines[res_path]();
        }
        w.require.cache = w.require.cache || { modules:{}, defines:{} }
        w.define = w.define || function (path,f) { w.require.cache.defines[root+path] = f };
    },

    run: function (entry_point,bundle_path,base_url,deps,options) {

        var me = this;
        me.base_url = base_url;
        setTimeout(function(){
            if (window.parent && window.parent!=window && !window.parent.bundler) {
                window.parent.bundler = me;
            }
        },1000);

        var bundle_url = this.absUrl(base_url+bundle_path);
        var bundle_dir_wo_slash = this.dir(bundle_url);
        var bundle_dir = this.dir(bundle_url)+"/";

        function path_string(path) {
            return "'"+path.replace(/\\?("|')/g,'\\$1')+"'";
        }

        var sheet = {
            entry_point: entry_point,
            build_js: "("+me.loadRequire.toString()+")(window,document.currentScript.src.replace(/\\/[^/]*?$/,'/'))\n",
            build_css: ""
        };

        me.loadRequire(window,bundle_dir);

        let css_pattern = /url\(['"]?([^'"\)]*)['"]?\)/g;

        function processTea(abs_url) {
            let old_getFile = teacss.getFile;
            teacss.getFile = function (path,cb) {
                var rel = me.relativePath(path,bundle_dir_wo_slash);
                var rel_clean = me.cleanPath(rel);
                var text = deps.js[rel_clean] || deps.tea[rel_clean];
                if (text===undefined) console.debug("Can't import tea",path,rel); else teacss.files[path] = text;
                cb(text);
            };
            teacss.process(abs_url,()=>{
                teacss.tea.Style.insert(document);
                teacss.tea.Script.insert(document);

                teacss.getFile = old_getFile;

                teacss.tea.Style.get(
                    (css) => sheet.build_css += css+"\n",
                    (text,path) => text.replace(css_pattern,(s,part) => {
                        var is_abs = me.isAbs(part);
                        if (me.isData(part)) return s;
                        if (!is_abs && !path) return s;
                        var part_abs = is_abs ? part : me.dir(path)+"/"+part;
                        var rel = me.relativePath(part_abs,bundle_dir_wo_slash);
                        var rel_clean = me.cleanPath(rel);
                        return 'url('+rel_clean+')';
                    })
                );
                teacss.tea.Script.get((js) => sheet.build_js += js);
            });
        };

        for (let rel_path in deps.js) {
            let abs_url = bundle_dir+rel_path;
            let text = deps.js[rel_path];
            if (text===false) continue;

            let ext = me.ext(rel_path);
            if (ext=='js') {
                var js = "(function(){var exports={},module={exports:false};";
                js += "\n"+text;
                js += "\n" + "return module.exports || exports;})";

                sheet.build_js += "define("+path_string(rel_path)+","+js+")\n";
                define(rel_path,eval(js+"\n//# sourceURL="+abs_url));
            }
            if (ext=="css") {
                sheet.build_js += "define("+path_string(rel_path)+",()=>{})\n";
                define(rel_path,function(){
                    var head = document.getElementsByTagName("head")[0];
                    var node = document.createElement("style");
                    node.type = "text/css";
                    head.appendChild(node);

                    var css_live =  text.replace(css_pattern,(s,part)=> (me.isAbs(part) || me.isData(part)) ? s : 'url('+me.absUrl(bundle_dir+part)+')');
                    node.appendChild(document.createTextNode(css_live));
                    sheet.build_css += text+"\n";
                });
            }
            if (ext=="tea") {
                sheet.build_js += "define("+path_string(rel_path)+",()=>true)\n";
                define(rel_path,()=>processTea(abs_url));
            }            
        }

        var entry_ext = me.ext(entry_point);
        var entry_rel = Object.keys(deps[entry_ext])[0];

        if (entry_ext=="js") {
            require(entry_rel);
            sheet.build_js += "require("+path_string(entry_rel)+")";
        }
        if (entry_ext=="tea") {
            sheet.build_js = "";
            processTea(bundle_dir+entry_rel);
        }
        this.js_sheets.push(sheet);
    }
}