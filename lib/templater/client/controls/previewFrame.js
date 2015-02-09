var dir = require.dir;

// iframe to display template preview
ui.previewFrame = ui.panel.extend({
    // constructor, creates some UI
    init: function (o) {
        var me = this;
        this._super(o);
        var blank = dir+"/../blank.htm";
        this.frameWrapper = $("<div>")
            .css({position:"absolute",left:0,right:0,top:0,bottom:0})
            .appendTo(this.element);
        this.frame = $("<iframe>",{
                id: "preview_frame",
                src: blank
            })
            .css({width: "100%", height: "100%"})
            .appendTo(this.frameWrapper);
        this.frame.on("load",function(){
            var win = me.window = me.frame[0].contentWindow;
            var doc = me.document = win.document;
            var context = me.frame.contents();
            me.$f = function (what) { return teacss.jQuery(what,context); }
            me.trigger("init");
            me.layoutMode(true);
            
           // drag'n'drop support
            var dnd_mousedown = function(e){
                var $target = $(e.target);
                
                if (!$target.hasClass("draggable")) $target = $target.parents(".draggable").eq(0);
                if (!$target.hasClass("draggable")) return;
                
                var cmp = $target.data("component");
                if (cmp && !me.dragging) {
                    me.dragComponent = cmp;
                    me.dragPoint = {x:e.pageX,y:e.pageY};
                    e.preventDefault();
                }
            }
            
            var dnd_mouseup = function(e){
                me.dragComponent = false;
                if (me.dragging) {
                    me.drop(e);
                    me.dragEnd(e);
                }
            }
            
            var dnd_mousemove = function(e){
                if (me.dragComponent && !me.dragging) {
                    if (Math.abs(e.pageX-me.dragPoint.x)>3 || Math.abs(e.pageY-me.dragPoint.y)>3) {
                        me.dragStart(e,me.dragComponent);
                    }
                }
                if (me.dragging) {
                    me.dragOver(e);
                }
            }
            
            me.$f(doc).mousedown(function(e){
                me.frame.parent().trigger('mousedown');
                dnd_mousedown.call(this,e);
            });
            me.$f(doc).mouseup(dnd_mouseup);
            me.$f(doc).mousemove(function(e){
                me.frame.parent().trigger(e);
                dnd_mousemove.call(this,e);
            });
            
            if (!me.dnd_parent_initialized) {
                me.dnd_parent_initialized = true;
                
                $(document).mousedown(dnd_mousedown);
                $(document).mouseup(dnd_mouseup);
                $(document).mousemove(dnd_mousemove);
            }            
            
            me.$f(doc).bind("contextmenu",function(){
                me.select(false);
                return false;
            });
            me.$f("body").click(function(e){
                var $t = $(e.target);
                if ($t.is("[type=submit]") || $t.is("[href]")) e.preventDefault();
            });
            
            setInterval(function(e){
                me.updateHandles();
            },1000);
        });
        Component.previewFrame = this;
    },
    
    // load template into preview, create all components
    // val - single template data
    setValue: function (val) {
        var me = this;
        this._super(val);
        
        me.componentsHash = {};
        var $f = me.$f;
        
        $f("head").find("script").remove();
        $f("body").html("").append(
            me.handleContainer = $("<div>").addClass("handle-container")
        );
        me.dropHandle = false;        
        
        // create root element and DOM for it manually (it stands for body)
        var root = me.root = new Component(val.template.value);
        root.element = $f("body");
        root.area = $f("body");
        
        var hash = false, root_data = val.template, inherit = false;
        // if template has a parent then load parent template and create substitution has from current one
        if (me.root.value.parentTemplate) {
            hash = {};
            function findRoot(data,inherit) {
                if (data.value && data.value.parentTemplate) {
                    findRoot(Component.app.settings.templates[data.value.parentTemplate] || {},true);
                    if (data.children) $.each(data.children,function(){
                        if (this.value && this.value.id) hash[this.value.id] = {data:this,inherit:inherit};
                    });
                } else {
                    root_data = data;
                }
            }
            findRoot(val.template,false);
            inherit = root.inherited = true;
        }
        
        // create component hierarchy
        var components = [];
        function createComponents(parent,data,inherit) {
            if (data.children) {
                $.each(data.children,function(){
                    var ch_data = this;
                    var ch_inherit = inherit;
                    if (this.value && this.value.id && hash && hash[this.value.id]) {
                        ch_data = hash[this.value.id].data;
                        ch_inherit = hash[this.value.id].inherit;
                    }
                    
                    var cmp = new Component(this.value);
                    cmp.parent = parent;
                    cmp.inherited = ch_inherit;

                    components.push(cmp);
                    
                    createComponents(cmp,ch_data,ch_inherit);
                    me.componentsHash[cmp.value.id] = cmp;
                });
            }
        }
        createComponents(root,root_data,inherit);
        
        me.setLoading(true);
        Component.load(components,function(){
            root.afterLoad();
            me.setLoading(false);
            me.reloadTea(false,function(){
                me.trigger("loaded");
            });
        });
    },
    
    getValue: function () {
        // get value for standalone component recursively
        function get(cmp) {
            var res = {};
            res.value = cmp.value;
            if (cmp.children.length) {
                res.children = [];
                $.each(cmp.children,function(){
                    if (this && this.type && this.type.name)
                        res.children.push(get(this));
                });
            }
            return res;
        }
        
        var ret;
        // for inherited template first gather redefined components and set them
        // as first level children
        if (this.root.inherited) {
            var ch = this.root.children;
            
            var own = [];
            function get_i(cmp) {
                if (!cmp.inherited) {
                    own.push(cmp);
                } else {
                    $.each(cmp.children,function(){ get_i(this); });
                }
            }
            get_i(this.root);
            this.root.children = own;
            ret = get(this.root);
            this.root.children = ch;
        } else {
            ret = get(this.root);
        }
        return {template:ret,data:this.value.data};
    },    
    
    // show/hide handles (used for drag or move operations
    showHandles: function (flag) {
        var me = this;
        if (!flag) 
            me.$f("body").addClass("hide-handles");
        else
            me.$f("body").removeClass("hide-handles");
    },
    
    // enable/disable 3d view mode for components
    view3dMode: function (flag) {
        var me = this;
        
        if (flag) 
            me.$f("body").addClass("view3d");
        else
            me.$f("body").removeClass("view3d");
        
        if (me.view3d && !flag) {
            $.each(me.componentsHash,function(){
                var cmp = this;
                cmp.element.add(cmp.componentHandle).css({
                    '-webkit-transform': "",
                    '-moz-transform': ""
                });
                cmp.elementScale = undefined;
            });            
            me.updateHandles(true);
        }
        if (flag && !me.view3d) {
            iterate(me.root,-2,1,1);
            me.updateHandles(true);
        }
        
        function iterate(cmp,depth,sx,sy) {
            if (depth > 0) {
                
                var poff = cmp.parent.element.offset();
                var off = cmp.element.offset();
                
                var pw = cmp.parent.element.width();
                var ph = cmp.parent.element.height();
                
                var dsx = (pw - 20)/pw;
                var dsy = (ph - 20)/ph;
                
                var dx = 20 + poff.left - off.left;
                var dy = 20 + poff.top - off.top;
                
                var transform = 'scale('+dsx+','+dsy+') translate(20px,20px)';
                cmp.element.css({
                    '-webkit-transform': transform,
                    '-moz-transform': transform,
                    '-moz-transform-origin': dx+"px "+dy+"px",
                    '-webkit-transform-origin': dx+"px "+dy+"px"
                });
                
                sx *= dsx;
                sy *= dsy;
                cmp.elementScale = {x:sx,y:sy};
            }
            
            $.each(cmp.children,function(){
                iterate(this,depth+1,sx,sy);
            });
        };
        me.view3d = flag;
    },    
    
    // enable/disable layout edit mode where widgets can be modified
    layoutMode: function (enable) {
        var me = this;
        // add special class to iframe body so layout controls will be shown
        this.$f("body").toggleClass("edit-layout",enable);
        this.$f("body").toggleClass("view-layout",!enable);
        
        // disable 3d if we are in preview mode
        if (!enable && this.layoutModeEnabled) {
            me.view3dBackup = me.view3d;
            me.view3dMode(false);
            $(".ui-dialog-content:visible").dialog("close");
        }
        if (enable && !this.layoutModeEnabled) {
            setTimeout(function(){
                me.view3dMode(me.view3dBackup);
            },1);
        }
        if (!enable) {
            me.contentEditableBackup = this.$f("[contenteditable]").removeAttr("contenteditable");
        } else {
            if (me.contentEditableBackup) me.contentEditableBackup.attr("contenteditable","true");
        }
        
        if (this.root) this.root.setHandleIndex();
        this.layoutModeEnabled = enable;
    },    
    
    setLoading: function (flag) {
        if (flag) {
            this.$f("body").append("<div class='loading-handle'>");
        } else {
            this.$f(".loading-handle").remove();
        }
    },
    
    reloadTea: function (callback,firstCallback) {
        var me = this;
        if (me.window.templaterStaticLoaded || !Component.app.staticStyles || Component.app.staticStyles.length==0) {
            loadDynamic();
        } else {
            me.processTea('templater_static',Component.app.staticStyles,false,function(){
                me.window.templaterStaticLoaded = true;
                loadDynamic();
            });
        }
        
        teacss.files['templater_static.tea'] = teacss.files['templater_static.tea'] || " ";
        teacss.files['templater_dynamic.tea'] = teacss.files['templater_dynamic.tea'] || " ";
        teacss.files['templater_makefile.tea'] = teacss.files['templater_makefile.tea']
            || "@import 'templater_static.tea';"
            +  "@import 'templater_dynamic.tea';";

        function loadDynamic() {
            me.processTea('templater_dynamic',Component.app.styles,Component.app.settings.theme.extra_js,callback,firstCallback);
        };
    },
    
    // load styles and scripts from tea file
    processTea: function (id,styles,extra_js,callback,firstCallback) {
        var me = this;
        var frame = this.frame;
        
        var makefile = "";
        for (var i=0;i<styles.length;i++) {
            makefile += '@import "'+styles[i]+'";\n';
        }
        if (extra_js) makefile += 'Script { @append {\n'+extra_js+'\n}\n';
        makefile += " ";
        
        teacss.image.update = function (){};
        teacss.files[id+".tea"] = makefile;
        teacss.process(id+".tea", function() {
            teacss.tea.Style.insert(frame[0].contentWindow.document);
            
            if (me.reloadScript) {
                me.$f("head script."+id).remove();
            }
            me.reloadScript = false;
            teacss.tea.Script.insert(frame[0].contentWindow.document);
            
            me.$f("head script:not([class*=templater])").addClass(id);
            
            me.updateHandles();
            if (firstCallback) firstCallback();
            
            if (teacss.image.getDeferred()) {
                teacss.image.update = function () { me.reloadTea(callback); }
            } else {
                if (callback && callback.call) callback();
            }
        },frame[0].contentWindow.document);            
    },
    
    // update handle and contols positions for all components
    updateHandles: function (immediate) {
        if (this.root) this.root.setHandleIndex(immediate);
    },    
    
    // selects a component, makes it current
    select: function (cmp,e) {
        var me = this;
        var app = Component.app;
        
        $("#teacss-layer > .button-select-panel").hide();
        
        if (e) e.stopPropagation();
        
        if (me.$f) {
            me.$f(".component-handle").removeClass("selected selected-parent");
            me.$f(".controls-handle").removeClass("selected");
            me.$f(".parent-component-handle").removeClass("selected-parent");
        }
        if (cmp) {
            cmp.componentHandle.addClass("selected");
            
            $.each(cmp.overlayControls || [],function(){
                cmp.componentHandle.append(this.element);
            });
            
            cmp.addInsideButton.toggleClass("visible", (cmp.area && !cmp.inherited)? true : false);
            cmp.addTopButton.toggleClass("visible",cmp!=me.root && !cmp.parent.inherited);
            cmp.addBottomButton.toggleClass("visible",cmp!=me.root && !cmp.parent.inherited);
        }
        
        if (cmp==me.root) cmp = false;
        
        me.selected = cmp;
        if (cmp && cmp.parent && cmp.parent!=me.root) {
            cmp.parent.componentHandle.addClass("selected-parent");
            if (cmp.parent.parentComponentHandle)
                cmp.parent.parentComponentHandle.addClass("selected-parent");
        }        
        
        if (!me.contextMenu) {
            me.contextMenu = $("<div>").addClass("context-menu button-select-panel");
            me.contextMenu.appendTo(app.componentPanel.element);
            me.contextMenu.click(function(e){
                e.stopPropagation();
            });
            me.contextMenu.data("combo",me.contextMenu);
            me.contextMenu.getParentCombo = function () { return false; }
            me.contextStyles = ui.fieldset();
            me.contextStyles.element.css({padding:10});
        }
        
        if (cmp) {
            Component.app.updateComponentUI(cmp);
            
            me.contextStyles.element.children().detach();
            me.contextMenu.children().detach();
            me.contextMenu.append(cmp.menu);
            me.contextMenu.show();
            app.stylePanel.element.hide();
            app.breadcrumbs.show().empty();
            
            var p = cmp;
            // create breadcrumbs so parent can be easily selected
            while (p) {
                app.breadcrumbs.prepend(
                    " > ", 
                    $("<a href='#'>").text(p.value.type).click(p,function(e){
                        e.preventDefault();
                        me.select(e.data,e);
                    })
                );
                p = p.parent;
                if (p==me.root) p = false;
            }
            
            var list = cmp.controls;
            if (cmp.controls && cmp.controls.length) {
                me.contextMenu.append(me.contextStyles.element);
                $.each(cmp.controls,function(){
                    this.options.cmp = cmp;
                    if (this.options.position) {
                        cmp[this.options.position].append(this.element);
                    } else {
                        me.contextStyles.push(this);
                        if (this.options.comboDirection=='default') this.options.comboDirection = 'right';
                    }
                });            
            }
        } else {
            me.contextMenu.hide();
            app.breadcrumbs.hide();
            app.stylePanel.element.show();
        }
    },  
    
    // drag scroll is a mechanism to scroll page up/down when dragging towards screen borders
    initDragScroll: function () {
        var me = this;
        if (!me.dragScroll) {
            me.dragScroll = {
                top: $("<div>").css({top:0}),
                bottom: $("<div>").css({bottom:0})
            }
            var both = me.dragScroll.both = $(me.dragScroll.top).add(me.dragScroll.bottom);
            var lastTop;
            var lastBottom;                
            
            both.css({position:"fixed",left:0,right:0,height:20,zIndex:99999});
            both.bind('mousemove', function(e) {
                if (me.dragging) {
                    if (me.$f('html,body').is(':animated')) return true;
                    
                    var win = me.frame[0].contentWindow;
                    var doc = win.document;                    
        
                    var scrollTop = $(win).scrollTop();
                    var direction = (parseInt($(this).css('top'))==0)?-1:+1;
                    var last = (direction==-1)?lastTop:lastBottom;
                    var current = (direction==-1)?scrollTop:$(doc).height()-(scrollTop+$(win).height());
        
                    if (last != undefined && last == current && current > 0) {
                        var newScrollTop = scrollTop+direction*50;
                        me.$f('html,body').animate({scrollTop: newScrollTop},0,'linear');
                    }
                    if (direction == -1) lastTop = current; else lastBottom = current;
                    return true;
                } else {
                    $(this).hide()
                }
            });
        }
        
        me.dragScroll.both.appendTo(me.$f("body"));

        var win = me.frame[0].contentWindow;
        var doc = win.document;
        if ($(doc).height() > $(win).height()) {
            me.dragScroll.both.show();
        } else {
            me.dragScroll.both.hide();
        }
    },
    
    // start drag, called from any draggable to show ui
    dragStart: function (event,what) {
        var me = this;
        if (!me.$f) return;
        me.dragging = true;
        me.initDragScroll();
        me.Class.draggable = me.draggable = what;
        
        if (Component.typeDialog) {
            Component.typeDialog.close();
        }
        
        me.view3dBackupDrag = me.view3d;
        me.view3dMode(true);
        
        me.$f("body").addClass("dragging");
        me.$f(".controls-handle").addClass("hidden");
    },
    
    // hide drag ui
    dragEnd: function () {
        var me = this;
        me.dragging = false;
        me.$f("body").removeClass("dragging");
        me.$f(".controls-handle").removeClass("hidden");
        me.$f(".sort-handle").removeClass("visible");
        me.$f(".area-handle").removeClass("visible");
        if (me.dragScroll) me.dragScroll.both.hide();
        me.view3dMode(me.view3dBackupDrag);
    },
    
    dragOver: function (e) {
        if (!this.dragging) return;
        e.preventDefault();
        
        function sqr(x) { return x * x }
        function dist2(v, w) { return sqr(v.x - w.x) + sqr(v.y - w.y) }
        function distToSegmentSquared(p, v, w) {
          var l2 = dist2(v, w);
          if (l2 == 0) return dist2(p, v);
          var t = ((p.x - v.x) * (w.x - v.x) + (p.y - v.y) * (w.y - v.y)) / l2;
          if (t < 0) return dist2(p, v);
          if (t > 1) return dist2(p, w);
          return dist2(p, { x: v.x + t * (w.x - v.x),
                            y: v.y + t * (w.y - v.y) });
        }
        
        var min = false;
        function check_min(test) {
            var dist = distToSegmentSquared({x:e.pageX,y:e.pageY},{x:test.x0,y:test.y0},{x:test.x1,y:test.y1});
            if (!min || dist < min.dist) {
                test.dist = dist;
                min = test;
            }
        }
        
        var me = this;
        var list = [me.root];
        $.each(me.componentsHash,function(){
            if (this.parent && this.parent.inherited) return;
            var parent = this.parent;
            while (parent) {
                if (parent==me.draggable) return;
                parent = parent.parent;
            }
            list.push(this)
        });
        
        $.each(list,function(){
            var cmp = this;
            var el = cmp.element;
            if (!el) return;
            if (cmp==me.root) return;
            var off = el.offset();
            var x0 = off.left;
            var y0 = off.top;
            var x1 = off.left + el.width();
            var y1 = off.top + el.height();
            
            check_min({x0:x0,y0:y0,x1:x1,y1:y0,cmp:cmp,type:"top"});
            check_min({x0:x0,y0:y0,x1:x0,y1:y1,cmp:cmp,type:"left"});
            check_min({x0:x1,y0:y0,x1:x1,y1:y1,cmp:cmp,type:"right"});
            check_min({x0:x0,y0:y1,x1:x1,y1:y1,cmp:cmp,type:"bottom"});
        });
        
        $.each(list,function(){
            var cmp = this;
            if (this.inherited) return;
            if (this.area && this.children.length==0) {
                var el = this.area;
                var off = el.offset();
                if (!off) return;
                
                var w = el.outerWidth();
                var h = el.outerHeight();
                var x0 = off.left;
                var y0 = off.top;
                var x1 = off.left + w;
                var y1 = off.top + h;
                
                if (e.pageX > x0 && e.pageY > y0 && e.pageX < x1 && e.pageY < y1) {
                    var dist = w * h;
                    if (!min || min.type!="inside" || dist < min.dist) {
                        min = {type:"inside",cmp:cmp,dist:dist,x0:x0,y0:y0,x1:x1,y1:y1};
                    }
                }
            }
        });
        if (min.cmp==me.draggable) min = false;
        
        if (min) {
            if (!me.dropHandle) {
                me.dropHandle = $("<div>")
                    .addClass('drop-marker')
                    .appendTo(me.handleContainer);
            }
            me.dropHandle.stop().show().css({opacity:1,left:min.x0,top:min.y0,width:min.x1-min.x0,height:min.y1-min.y0});
            if (min.type!="inside")
                me.dropHandle.addClass("flat");
            else
                me.dropHandle.removeClass("flat");
                
            me.dropHandle.min = min;
        } else {
            if (me.dropHandle) {
                me.dropHandle.hide();
            }
        }
    },
    
    dropComponent: function (min,draggable) {
        var me = this;
        var cmp = min.cmp;
        if (draggable==cmp) return;
        
        var parent = cmp.parent, index;
        if (min.type=="inside") {
            parent = cmp;
        }
        if (min.type=="left" || min.type=="top") {
            index = {before:cmp};
        }
        if (min.type=="right") {
            index = {after:cmp};
        }
        if (min.type=="bottom") {
            index = {after:cmp};
            /*var i = parent.children.indexOf(cmp) + 1;
            for (;i<parent.children.length;i++) {
                var ch = parent.children[i];
                if (ch==draggable) continue;
                var el = ch.componentHandle;
                if (el.offset().top + el.height() > min.y0) break;
                index = {after:ch};
            }*/
        }
        if (draggable.create) {
            var cmp_new = new Component({type:draggable.type.id});
            cmp_new.load(parent,index);
            me.componentsHash[cmp_new.value.id] = cmp_new;
        } else {
            cmp_new = draggable;
            draggable.position(parent,index);
        }
        me.root.setHandleIndex();
        setTimeout(function(){
            me.reloadTea();
        },1)
        
        me.select(me.selected);
        return cmp_new;
    },    
    
    drop: function (e) {
        var me = this;
        me.dragging = false;
        e.preventDefault();

        if (!me.dropHandle || !me.dropHandle.min) return;
        
        var min = me.dropHandle.min;
        var draggable = me.draggable;
        
        if (draggable==min.cmp) return;
    
        var cmp_new = me.dropComponent(min,draggable);
        me.trigger("change");
        
        setTimeout(function(){
            
            var el = cmp_new.element;
            var off = el.offset();
            
            me.dropHandle
                .stop()
                .removeClass("flat")
                .css({opacity:1})
                .animate(
                    {
                        left:off.left,
                        top:off.top,
                        width:el.outerWidth(),
                        height:el.outerHeight(),
                    },
                    600
                )
                .animate(
                    { opacity: 0 },
                    1000,
                    function () {
                        me.dropHandle.hide();
                    }
                )
        },1);
    }
});