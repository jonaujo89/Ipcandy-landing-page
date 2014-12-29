(function(a) {
    if (typeof($document) === "undefined") {
        $document = a(document)
    }
    a.fn.spacedClickOut = function(d, c) {
        var b = ".spacedClickOut_" + Math.floor(Math.random() * (9999 - 1000 + 1) + 1000);
        setTimeout(a.proxy(function() {
            $document.on("click" + b, a.proxy(function(e) {
                if (!a(e.target).is(this) && this.has(e.target).length === 0) {
                    $document.off("click" + b);
                    e.delegateTarget = this.get();
                    if (c === undefined) {
                        d.call(this, e)
                    } else {
                        c.call(this, e)
                    }
                }
            }, this))
        }, this), 50);
        return "click" + b
    }
}(jQuery));
(function(b) {
    if (typeof($document) === "undefined") {
        $document = b(document)
    }
    var a = function(c, d) {
        this.$item = b(c);
        this.is_inner = (typeof(d.append_to) !== "undefined");
        this.opts = b.extend({
            value: "#FFFFFF",
            gradient_value: false,
            type: "fill",
            show: false,
            append_to: false,
            change: function() {},
            on_done: function() {},
            on_cancel: function() {}
        }, d);
        this.data = {};
        this.event_scope = ".spacedColors_" + Math.floor(Math.random() * (9999 - 1000 + 1) + 1000);
        this.init();
        return this
    };
    a.prototype = {
        is_inner: false,
        gradient_scale: 1.75,
        colorname_table: {
            black: "#000000",
            gray: "#808080",
            grey: "#808080",
            silver: "#C0C0C0",
            lightgray: "#D3D3D3",
            white: "#FFFFFF",
            red: "#FF0000",
            pink: "#FFC0CB",
            orange: "#FFA500",
            yellow: "#FFFF00",
            violet: "#EE82EE",
            purple: "#800080",
            magenta: "#FF00FF",
            brown: "#A52A2A",
            maroon: "#800000",
            olive: "#808000",
            lime: "#00FF00",
            green: "#008000",
            aqua: "#00FFFF",
            blue: "#0000FF",
            navy: "#000080"
        },
        init: function() {
            if (typeof(this.opts.value) === "object") {
                this.data.value = this.opts.value.value
            } else {
                if (this.opts.value) {
                    this.data.value = this.opts.value
                } else {
                    this.data.value = "#FFFFFF"
                }
            }
            if (this.data.value == "transparent") {
                this.data.value = "#FFFFFF"
            }
            if (this.is_hex(this.data.value)) {
                this.data.hex = this.expandHex(this.data.value)
            } else {
                this.data.hex = this.color2hex(this.data.value)
            }
            this.data.hsb = this.hex2hsb(this.data.hex);
            this.data.opacity = this.color2opacity(this.data.value);
            if (this.data.opacity > 1) {
                this.data.opacity = 1
            } else {
                if (this.data.opacity < 0) {
                    this.data.opacity = 0
                }
            }
            if (this.is_inner || this.opts.show) {
                this.show()
            }
        },
        destroy: function() {
            if (this.$selector) {
                this.$selector.remove()
            }
            b(document).off(this.event_scope)
        },
        show: function() {
            this.$selector = b('<div class="spacedColors spacedColors-selector"></div>');
            this.$selector.append('<div class="spacedColors-hues"><div class="spacedColors-huePicker"></div></div>').append('<div class="spacedColors-colors" style="background-color: #FFF;"><div class="spacedColors-colorPicker"><div class="spacedColors-colorPicker-inner"></div></div>').hide();
            if (this.is_inner) {
                this.$selector.addClass("is_inner")
            } else {
                var e = b('<div class="spacedColors-buttons"><a class="spacedColors-buttons_done" data-value="done"><span>Готово</span></a><a class="spacedColors-buttons_cancel" data-value="cancel"><span>Отмена</span></a></div>');
                this.$selector.append(e);
                e.on("click", "a", b.proxy(function(l) {
                    var k = b(l.currentTarget).attr("data-value");
                    if (k == "done" && typeof this.opts.on_done === "function") {
                        this.opts.on_done(this.data)
                    } else {
                        if (k == "cancel" && typeof this.opts.on_cancel === "function") {
                            this.opts.on_cancel(this.data)
                        }
                    }
                    this.destroy()
                }, this));
                this.$selector.spacedClickOut(b.proxy(function() {
                    this.opts.on_done(this.data);
                    this.destroy()
                }, this))
            }
            this.$color_picker = this.$selector.find(".spacedColors-colorPicker");
            this.$hue_picker = this.$selector.find(".spacedColors-huePicker");
            this.show_opacity();
            this.show_input();
            this.show_gradient();
            var d = this.data.hsb;
            this.$selector.find(".spacedColors-colors").css("backgroundColor", "#" + this.hsb2hex({
                h: d.h,
                s: 100,
                b: 100
            })).end().find(".spacedColors-opacity").css("backgroundColor", "#" + this.hsb2hex({
                h: d.h,
                s: d.s,
                b: d.b
            })).end();
            this.colorPosition = this.getColorPositionFromHSB(this.data.hsb);
            this.huePosition = this.getHuePositionFromHSB(this.data.hsb);
            this.opacityPosition = this.getOpacityPositionFromAlpha(this.data.opacity);
            this.$color_picker.css("top", this.colorPosition.y + "px").css("left", this.colorPosition.x + "px");
            this.$hue_picker.css("top", this.huePosition + "px");
            if (this.$opacity_picker) {
                this.$opacity_picker.css("left", this.opacityPosition + "px")
            }
            this.mousebutton = 0;
            var j = (this.is_inner) ? this.opts.append_to : "body";
            b(j).append(this.$selector);
            if (!this.is_inner) {
                var i = 300;
                var g = 600;
                if (this.opts.element) {
                    var f = b(this.opts.element).offset();
                    var c = b(this.opts.element).closest("body").scrollTop();
                    i = f.top - c;
                    g = f.left;
                    if (this.opts.element_offset) {
                        i += this.opts.element_offset.top || 0;
                        g += this.opts.element_offset.left || 0
                    }
                    i = i - this.$selector.height() + 8;
                    if (i < 50) {
                        i = 50
                    }
                }
                this.$selector.css({
                    top: i,
                    left: g
                })
            }
            this.$selector.fadeIn(100);
            this.$selector.on("selectstart", function() {
                return false
            });
            this.$selector.on("mousedown" + this.event_scope + " touchstart" + this.event_scope, b.proxy(function(m) {
                if (b(m.target).is('input[type="text"]')) {
                    return true
                }
                this.mousebutton = 1;
                var l = b(m.target).parents().andSelf();
                if (l.hasClass("spacedColors-colors")) {
                    m.preventDefault();
                    this.moving = "colors";
                    this.move_color(m)
                }
                if (l.hasClass("spacedColors-hues")) {
                    m.preventDefault();
                    this.moving = "hues";
                    this.move_hue(m)
                }
                if (l.hasClass("spacedColors-opacity")) {
                    m.preventDefault();
                    this.moving = "opacity";
                    this.move_opacity(m)
                }
                if (l.hasClass("color_gradient_pick_line") && this.opts.type == "gradient") {
                    var k = b(m.target);
                    if (k.is(".color_gradient_pick_line")) {
                        m.preventDefault();
                        this.addGadientPointEvent(m)
                    } else {
                        if (k.is(".color_gradient_pick_value")) {
                            k = b(m.target).parent()
                        }
                        if (k.is(".color_gradient_pick")) {
                            m.preventDefault();
                            this.$moving_gradient_pick = k;
                            this.moving = "gradient";
                            this.setGradientPointActive(k);
                            this.move_gradient(m)
                        }
                    }
                }
                if (l.hasClass("spacedColors-selector")) {
                    m.preventDefault();
                    return
                }
                if (l.hasClass("spacedColors")) {
                    return
                }
                if (!this.is_inner) {
                    this.hide()
                }
            }, this));
            b(document).on("mouseup" + this.event_scope + " touchend" + this.event_scope, b.proxy(function(k) {
                this.mousebutton = 0;
                this.moving = undefined
            }, this));
            b(document).on("mousemove" + this.event_scope + " touchmove" + this.event_scope, b.proxy(function(k) {
                if (b(k.target).is('input[type="text"]')) {
                    return true
                }
                if (this.mousebutton === 1) {
                    k.preventDefault();
                    if (this.moving === "colors") {
                        this.move_color(k)
                    }
                    if (this.moving === "hues") {
                        this.move_hue(k)
                    }
                    if (this.moving === "opacity") {
                        this.move_opacity(k)
                    }
                    if (this.moving === "gradient") {
                        this.move_gradient(k)
                    }
                }
            }, this))
        },
        show_input: function() {
            this.$input_text = b('<input type="text">').val(this.data.value);
            this.$selector.append(this.$input_text);
            this.$selector.addClass("is_show_input");
            this.$input_text.on("keyup", b.proxy(function(i) {
                var f = b(i.currentTarget).val();
                var g = this.color2hex(f);
                var c = this.color2opacity(f);
                if (g === false) {
                    this.$input_text.addClass("is_invalid");
                    return true
                } else {
                    if (this.$input_text.is(".is_invalid")) {
                        this.$input_text.removeClass("is_invalid")
                    }
                }
                this.data.value = f;
                this.data.opacity = c;
                if (this.opts.opacity) {
                    this.opacityPosition = this.getOpacityPositionFromAlpha(this.data.opacity);
                    this.$opacity_picker.css("left", this.opacityPosition + "px")
                }
                this.inputTextlock = true;
                var d = this.hex2hsb(g);
                this.set_color(d)
            }, this));
            this.$input_text.wrap('<div class="spacedColors-input"></div>')
        },
        show_opacity: function() {
            if (!this.opts.opacity) {
                return false
            }
            this.$selector.addClass("is_show_opacity");
            this.$selector.prepend('<div class="spacedColors-opacity"><div class="spacedColors-opacityPicker"></div></div><div class="spacedColors-opacityText">Прозрачность</div>');
            this.$opacity_picker = this.$selector.find(".spacedColors-opacityPicker");
            return true
        },
        show_gradient: function() {
            if (this.opts.type != "gradient") {
                return false
            }
            this.$selector.addClass("is_show_gradient");
            var d = b('<div class="spacedColors-gradient"></div>');
            this.$gradient_line = b('<div class="color_gradient_line"></div>');
            this.$gradient_pick_list = b('<div class="color_gradient_pick_line"></div>');
            this.$gradient_btn = b('<div class="color_gradient_btn"></div>');
            var e = b('<a class="color_gradient_pick_remove" title="Удалить активную точку градиента"></a>');
            d.append('<div class="spacedColors-gradientText">Направление градиента</div>');
            this.$gradient_btn.append('<a class="edit_btn" data-value="top" title="Вниз"></a>');
            this.$gradient_btn.append('<a class="edit_btn" data-value="top_left" title="В правый нижний угол"></a>');
            this.$gradient_btn.append('<a class="edit_btn" data-value="top_right" title="В правый верхний угол"></a>');
            this.$gradient_btn.append('<a class="edit_btn" data-value="left" title="Вправо"></a>');
            this.$gradient_btn.append('<a class="edit_btn" data-value="radial" title="Радиальный"></a>');
            this.gradient_type = this.opts.gradient_value.type;
            this.gradient_values = this.opts.gradient_value.values;
            if (typeof(this.gradient_values) !== "object") {
                this.gradient_values = {
                    "0": this.data.value,
                    "100": this.data.value
                }
            }
            b.each(this.gradient_values, b.proxy(function(g, f) {
                this.addGadientPoint(g, f)
            }, this));
            e.on("click touchstart", b.proxy(function(f) {
                f.preventDefault();
                if (this.$gradient_current_point.siblings().length < 2) {
                    alert("Нельзя удалить основные точки");
                    return
                }
                this.removeGadientPoint(this.$gradient_current_point)
            }, this));
            this.$gradient_btn.on("click touchstart", "a.edit_btn", b.proxy(function(f) {
                f.preventDefault();
                this.setGradientType(b(f.target).attr("data-value"))
            }, this));
            var c = this.$gradient_pick_list.find("div.color_gradient_pick:eq(0)");
            this.setGradientPointActive(c);
            this.$gradient_btn.append(e);
            if (typeof(this.gradient_type) !== "string") {
                this.gradient_type = "top"
            }
            this.setGradientType(this.gradient_type);
            d.append(this.$gradient_btn).append(this.$gradient_line).append(this.$gradient_pick_list);
            this.$selector.append(d);
            this.updateGradient();
            return true
        },
        hide: function() {
            this.$selector.fadeOut(100, b.proxy(function() {
                this.$selector.remove()
            }, this));
            b(document).off(this.event_scope)
        },
        move_color: function(g) {
            this.$color_picker.hide();
            var d = {
                x: g.pageX,
                y: g.pageY
            };
            if (g.originalEvent.changedTouches) {
                d.x = g.originalEvent.changedTouches[0].pageX;
                d.y = g.originalEvent.changedTouches[0].pageY
            }
            d.x = d.x - this.$selector.find(".spacedColors-colors").offset().left - 6;
            d.y = d.y - this.$selector.find(".spacedColors-colors").offset().top - 6;
            if (d.x <= -5) {
                d.x = -5
            }
            if (d.x >= 144) {
                d.x = 144
            }
            if (d.y <= -5) {
                d.y = -5
            }
            if (d.y >= 144) {
                d.y = 144
            }
            this.colorPosition = d;
            this.$color_picker.css("left", d.x).css("top", d.y).show();
            var f = Math.round((d.x + 5) * 0.67);
            if (f < 0) {
                f = 0
            }
            if (f > 100) {
                f = 100
            }
            var c = 100 - Math.round((d.y + 5) * 0.67);
            if (c < 0) {
                c = 0
            }
            if (c > 100) {
                c = 100
            }
            var e = this.data.hsb;
            e.s = f;
            e.b = c;
            this.set_color(e)
        },
        move_hue: function(f) {
            this.$hue_picker.hide();
            var c = f.pageY;
            if (f.originalEvent.changedTouches) {
                c = f.originalEvent.changedTouches[0].pageY
            }
            c = c - this.$selector.find(".spacedColors-colors").offset().top - 1;
            if (c <= -1) {
                c = -1
            }
            if (c >= 149) {
                c = 149
            }
            this.huePosition = c;
            this.$hue_picker.css("top", c).show();
            var e = Math.round((150 - c - 1) * 2.4);
            if (e < 0) {
                e = 0
            }
            if (e > 360) {
                e = 360
            }
            var d = this.data.hsb;
            d.h = e;
            this.set_color(d)
        },
        move_opacity: function(e) {
            this.$opacity_picker.hide();
            var c = e.pageX;
            if (e.originalEvent.changedTouches) {
                c = e.originalEvent.changedTouches[0].pageX
            }
            c = c - this.$selector.find(".spacedColors-colors").offset().left - 1;
            var d = 175;
            if (c <= -1) {
                c = -1
            }
            if (c >= d - 1) {
                c = d - 1
            }
            this.opacityPosition = c;
            this.$opacity_picker.css("left", c).show();
            this.data.opacity = parseFloat((d - c - 1) / d).toFixed(2);
            if (this.data.opacity < 0) {
                this.data.opacity = 0
            }
            if (this.data.opacity > 1) {
                this.data.opacity = 1
            }
            this.set_color(this.data.hsb)
        },
        move_gradient: function(d) {
            if (!this.$moving_gradient_pick || !this.$moving_gradient_pick.is(".color_gradient_pick")) {
                return
            }
            if (d.offsetY > 70 && this.$moving_gradient_pick.parent().children().length > 2) {
                this.removeGadientPoint(this.$moving_gradient_pick);
                return
            }
            var c = d.pageX;
            if (d.originalEvent.changedTouches) {
                c = d.originalEvent.changedTouches[0].pageX
            }
            c = c - this.$selector.find(".spacedColors-colors").offset().left - 1;
            var e = 175;
            if (c <= -1) {
                c = -1
            }
            if (c >= e - 1) {
                c = e - 1
            }
            this.$moving_gradient_pick.css("left", c);
            this.last_change = Math.random();
            this.change()
        },
        addGadientPointEvent: function(f) {
            var c = f.pageX;
            if (f.originalEvent.changedTouches) {
                c = f.originalEvent.changedTouches[0].pageX
            }
            c = c - this.$selector.find(".spacedColors-colors").offset().left - 1;
            var i = 175;
            if (c <= -1) {
                c = -1
            }
            if (c >= i - 1) {
                c = i - 1
            }
            var e = parseInt(c / this.gradient_scale);
            var d = "#FFFFFF";
            var g = this.addGadientPoint(e, d);
            this.setGradientPointActive(g)
        },
        addGadientPoint: function(d, c) {
            var f = parseInt(d * this.gradient_scale);
            var e = b('<div class="color_gradient_pick" style="left:' + f + 'px"><div class="color_gradient_pick_value" style="background-color: ' + c + ';"></div></div>');
            this.$gradient_pick_list.append(e);
            e.data("value", c);
            return e
        },
        setGradientPointActive: function(d) {
            d.siblings().removeClass("is_active");
            d.addClass("is_active");
            this.$gradient_current_point = d;
            this.last_change = Math.random();
            var c = this.hex2hsb(this.$gradient_current_point.data("value"));
            this.set_color(c);
            this.colorPosition = this.getColorPositionFromHSB(this.data.hsb);
            this.huePosition = this.getHuePositionFromHSB(this.data.hsb);
            this.opacityPosition = this.getOpacityPositionFromAlpha(this.data.opacity);
            this.$color_picker.css("top", this.colorPosition.y + "px").css("left", this.colorPosition.x + "px");
            this.$hue_picker.css("top", this.huePosition + "px");
            if (this.$opacity_picker) {
                this.$opacity_picker.css("left", this.opacityPosition + "px")
            }
        },
        setGradientType: function(c) {
            this.gradient_type = c;
            this.$gradient_btn.find(".edit_btn").removeClass("is_active");
            this.$gradient_btn.find('.edit_btn[data-value="' + c + '"]').addClass("is_active");
            this.last_change = Math.random();
            this.change()
        },
        removeGadientPoint: function(d) {
            d.remove();
            var c = this.$gradient_pick_list.find("div.color_gradient_pick").eq(0);
            this.setGradientPointActive(c)
        },
        set_color: function(c) {
            this.data.hsb = c;
            var d = this.hsb2rgb(c);
            var e = this.hsb2hex(c);
            if (this.opts.opacity && this.data.opacity != 1) {
                this.data.value = "rgba(" + d.r + "," + d.g + "," + d.b + "," + parseFloat(this.data.opacity) + ")"
            } else {
                this.data.value = "#" + e
            }
            if (this.$selector) {
                this.$selector.find(".spacedColors-colors").css("backgroundColor", "#" + this.hsb2hex({
                    h: c.h,
                    s: 100,
                    b: 100
                })).end().find(".spacedColors-opacity").css("backgroundColor", "#" + e).end()
            }
            this.change()
        },
        change: function() {
            if (this.opts.type == "gradient" && typeof(this.$gradient_current_point) !== "undefined") {
                this.$gradient_current_point.find("div").css("background-color", this.data.value);
                this.$gradient_current_point.data("value", this.data.value);
                this.updateGradient()
            }
            if (this.inputTextlock) {
                this.inputTextlock = false
            } else {
                if (this.$input_text) {
                    this.$input_text.val(this.data.value)
                }
            }
            this.last_change = this.data.value;
            if (this.$item) {
                this.$item.val(this.data.value)
            }
            if (typeof(this.opts.change) === "function") {
                this.opts.change(this.data, this.data.gradient_code)
            }
        },
        updateGradient: function() {
            var e = {};
            b.each(this.$gradient_pick_list.find("div.color_gradient_pick"), b.proxy(function(j, g) {
                var f = b(g);
                var i = parseInt(parseInt(f.css("left")) / this.gradient_scale);
                e[i] = f.data("value")
            }, this));
            this.gradient_data = e;
            this.data.gradient_code = this.getGradientCode();
            var d = this.getGradientCode(true);
            var c = "";
            b.each(d.preview, function(g, f) {
                c += "background: " + f + "; "
            });
            this.$gradient_line.attr("style", c)
        },
        getGradient: function() {
            return this.gradient_data
        },
        getGradientCode: function(k) {
            if (typeof(k) === "undefined") {
                k = false
            }
            var l = this.gradient_type;
            if (k) {
                l = "left"
            }
            var j = (l == "radial") ? "radial" : "linear";
            var m = "";
            var f = "";
            b.each(this.getGradient(), b.proxy(function(p, o) {
                if (l == "top") {
                    p = (p * 10) + "px"
                } else {
                    p = p + "%"
                }
                m = o;
                var q = "," + o + " " + p;
                f += q
            }, this));
            var e = "-webkit-" + j + "-gradient(" + this.getGradientCodeType("webkit", l) + f + ") no-repeat";
            var g = "-moz-" + j + "-gradient(" + this.getGradientCodeType("moz", l) + f + ") no-repeat";
            var i = "-o-" + j + "-gradient(" + this.getGradientCodeType("o", l) + f + ") no-repeat";
            var d = "-ms-" + j + "-gradient(" + this.getGradientCodeType("ms", l) + f + ") no-repeat";
            var n = j + "-gradient(" + this.getGradientCodeType("main", l) + f + ") no-repeat";
            var c = [m, e, g, i, d, n];
            if (k) {
                return {
                    type: l,
                    value: m,
                    values: f,
                    preview: c
                }
            } else {
                return {
                    type: l,
                    value: m,
                    values: f
                }
            }
        },
        getGradientCodeType: function(c, d) {
            if (c == "webkit_old") {
                switch (d) {
                    case "left":
                        return "linear, left top, right top";
                    case "top":
                        return "linear, left top, left bottom";
                    case "top_left":
                        return "linear, left top, right bottom";
                    case "top_right":
                        return "linear, left bottom, right top";
                    case "radial":
                        return "radial, center center, 0px, center center, 100%"
                }
            } else {
                if (c == "main") {
                    switch (d) {
                        case "left":
                            return "to right";
                        case "top":
                            return "to bottom";
                        case "top_left":
                            return "135deg";
                        case "top_right":
                            return "225deg";
                        case "radial":
                            return "circle at top"
                    }
                } else {
                    switch (d) {
                        case "left":
                            return "left";
                        case "top":
                            return "top";
                        case "top_left":
                            return "-45deg";
                        case "top_right":
                            return "225deg";
                        case "radial":
                            return "center top, circle cover"
                    }
                }
            }
        },
        getColorPositionFromHSB: function(d) {
            var c = Math.ceil(d.s / 0.67);
            if (c < 0) {
                c = 0
            }
            if (c > 150) {
                c = 150
            }
            var e = 150 - Math.ceil(d.b / 0.67);
            if (e < 0) {
                e = 0
            }
            if (e > 150) {
                e = 150
            }
            return {
                x: c - 5,
                y: e - 5
            }
        },
        getHuePositionFromHSB: function(c) {
            var d = 150 - (c.h / 2.4);
            if (d < 0) {
                h = 0
            }
            if (d > 150) {
                h = 150
            }
            return d
        },
        getOpacityPositionFromAlpha: function(c) {
            var d = 175 * c;
            if (d < 0) {
                d = 0
            }
            if (d > 175) {
                d = 175
            }
            return 175 - d
        },
        cleanHex: function(c) {
            if (typeof(c) !== "string") {
                return false
            }
            return c.replace(/[^A-F0-9]/ig, "")
        },
        expandHex: function(c) {
            c = this.cleanHex(c);
            if (!c) {
                return null
            }
            if (c.length === 3) {
                c = c[0] + c[0] + c[1] + c[1] + c[2] + c[2]
            }
            return c.length === 6 ? c : null
        },
        hsb2rgb: function(c) {
            var e = {};
            var j = Math.round(c.h);
            var i = Math.round(c.s * 255 / 100);
            var d = Math.round(c.b * 255 / 100);
            if (i === 0) {
                e.r = e.g = e.b = d
            } else {
                var k = d;
                var g = (255 - i) * d / 255;
                var f = (k - g) * (j % 60) / 60;
                if (j === 360) {
                    j = 0
                }
                if (j < 60) {
                    e.r = k;
                    e.b = g;
                    e.g = g + f
                } else {
                    if (j < 120) {
                        e.g = k;
                        e.b = g;
                        e.r = k - f
                    } else {
                        if (j < 180) {
                            e.g = k;
                            e.r = g;
                            e.b = g + f
                        } else {
                            if (j < 240) {
                                e.b = k;
                                e.r = g;
                                e.g = k - f
                            } else {
                                if (j < 300) {
                                    e.b = k;
                                    e.g = g;
                                    e.r = g + f
                                } else {
                                    if (j < 360) {
                                        e.r = k;
                                        e.g = g;
                                        e.b = k - f
                                    } else {
                                        e.r = 0;
                                        e.g = 0;
                                        e.b = 0
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return {
                r: Math.round(e.r),
                g: Math.round(e.g),
                b: Math.round(e.b)
            }
        },
        rgb2hex: function(c) {
            var d = [c.r.toString(16), c.g.toString(16), c.b.toString(16)];
            b.each(d, function(e, f) {
                if (f.length === 1) {
                    d[e] = "0" + f
                }
            });
            return d.join("")
        },
        hex2rgb: function(c) {
            c = parseInt(((c.indexOf("#") > -1) ? c.substring(1) : c), 16);
            return {
                r: c >> 16,
                g: (c & 65280) >> 8,
                b: (c & 255)
            }
        },
        rgb2hsb: function(e) {
            var d = {
                h: 0,
                s: 0,
                b: 0
            };
            var f = Math.min(e.r, e.g, e.b);
            var c = Math.max(e.r, e.g, e.b);
            var g = c - f;
            d.b = c;
            d.s = c !== 0 ? 255 * g / c : 0;
            if (d.s !== 0) {
                if (e.r === c) {
                    d.h = (e.g - e.b) / g
                } else {
                    if (e.g === c) {
                        d.h = 2 + (e.b - e.r) / g
                    } else {
                        d.h = 4 + (e.r - e.g) / g
                    }
                }
            } else {
                d.h = -1
            }
            d.h *= 60;
            if (d.h < 0) {
                d.h += 360
            }
            d.s *= 100 / 255;
            d.b *= 100 / 255;
            return d
        },
        hex2hsb: function(d) {
            var c = this.rgb2hsb(this.hex2rgb(d));
            if (c.s === 0) {
                c.h = 360
            }
            return c
        },
        hsb2hex: function(c) {
            return this.rgb2hex(this.hsb2rgb(c))
        },
        is_hex: function(c) {
            if (typeof(c) === "undefined") {
                return false
            }
            c = b.trim(c);
            c = c.toLowerCase();
            if (c.length < 3 || c.length > 7) {
                return false
            }
            if (c.indexOf("#") > -1) {
                c = c.substring(c.indexOf("#") + 1)
            }
            return (/^([0-9a-f]{1,2}){3}$/i.test(c))
        },
        is_rgb: function(c) {
            if (typeof(c) === "undefined") {
                return false
            }
            c = b.trim(c);
            c = c.toLowerCase();
            return (/\(([0-9]*)\,\s{0,1}([0-9]*)\,\s{0,1}([0-9]*)\,{0,1}\s{0,1}(.*){0,1}\)$/.test(c))
        },
        color2hex: function(d) {
            d = d.toLowerCase();
            d = b.trim(d);
            if (d.indexOf("#") > -1) {
                if (d.length > 7) {
                    return false
                }
                return d.substring(d.indexOf("#") + 1)
            } else {
                if (d.indexOf("rgb") > -1) {
                    var f = /\(([0-9]*)\,\s{0,1}([0-9]*)\,\s{0,1}([0-9]*)\,{0,1}\s{0,1}(.*){0,1}\)$/;
                    var e = f.exec(d);
                    if (e !== null && e.hasOwnProperty("1") && e.hasOwnProperty("2") && e.hasOwnProperty("3")) {
                        var c = {};
                        c.r = parseInt(e[1]);
                        c.g = parseInt(e[2]);
                        c.b = parseInt(e[3]);
                        if (c.r > 255) {
                            c.r = 255
                        }
                        if (c.g > 255) {
                            c.g = 255
                        }
                        if (c.b > 255) {
                            c.b = 255
                        }
                        if (c.r < 0) {
                            c.r = 0
                        }
                        if (c.g < 0) {
                            c.g = 0
                        }
                        if (c.b < 0) {
                            c.b = 0
                        }
                        return this.rgb2hex(c)
                    } else {
                        return false
                    }
                } else {
                    if (this.colorname_table.hasOwnProperty(d)) {
                        return this.color2hex(this.colorname_table[d])
                    } else {
                        if (d.length == 3 || d.length == 6) {
                            return d
                        } else {
                            return false
                        }
                    }
                }
            }
        },
        color2opacity: function(c) {
            c = c.toLowerCase();
            c = b.trim(c);
            if (c.indexOf("#") > -1) {
                return 1
            }
            if (c.indexOf("rgb") > -1) {
                var e = /\(([0-9]*)\,\s{0,1}([0-9]*)\,\s{0,1}([0-9]*)\,{0,1}\s{0,1}(.*){0,1}\)$/;
                var d = e.exec(c);
                if (d !== null && d.hasOwnProperty("4") && !isNaN(d[4])) {
                    var f = parseFloat(d[4]);
                    if (f > 1) {
                        f = 1
                    } else {
                        if (f < 0) {
                            f = 0
                        }
                    }
                    return f
                } else {
                    return 1
                }
            }
            return 1
        }
    };
    b.fn.spacedColors = function(d) {
        if (this.length < 1) {
            var c = b("<div></div>");
            var e = c.data("spacedColors");
            if (!e) {
                e = new a(c, d);
                c.data("spacedColors", e)
            }
        } else {
            return this.each(function() {
                var f = b(this);
                var g = f.data("spacedColors");
                if (!g) {
                    g = new a(f, d);
                    f.data("spacedColors", g)
                }
            })
        }
    };
    b.fn.spacedColorsDestroy = function() {
        if (this.data("spacedColors")) {
            this.data("spacedColors").destroy();
            this.removeData("spacedColors")
        }
    };
    b.fn.spacedColorsSetColor = function(e) {
        if (this.data("spacedColors")) {
            var d = this.data("spacedColors");
            var c = d.hex2hsb(e);
            d.set_color(c)
        }
    };
    b.fn.spacedColorsGetColor = function(c) {
        if (this.data("spacedColors")) {
            return this.data("spacedColors").data
        }
    }
})(jQuery);
(function(a) {
    if (typeof($document) === "undefined") {
        $document = a(document)
    }
    var b = function(d, c) {
        this.$editor = a(d);
        this.opts = a.extend({
            callback: false,
            on_change: function() {},
            focus: true,
            hotkeys: true,
            convertLinks: true,
            convertDivs: false,
            toolbarExternal: false,
            oneline: false,
            htmlExternal: false,
            allowedTags: ["code", "span", "div", "a", "br", "p", "b", "i", "del", "strike", "u", "img", "blockquote", "mark", "cite", "small", "ul", "ol", "li", "hr", "dl", "dt", "dd", "sup", "sub", "big", "code", "figure", "figcaption", "strong", "em", "table", "tr", "td", "th", "tbody", "thead", "tfoot", "h1", "h2", "h3", "h4", "h5", "h6"],
            allowedTagsPaste: ["img", "span", "div", "label", "a", "br", "p", "b", "i", "del", "strike", "u", "small", "ul", "ol", "li", "hr", "sup", "sub", "big", "code", "strong", "em", "h1", "h2", "h3", "h4", "h5", "h6"],
            buttons: ["bold", "italic", "underline", "deleted", "size", "fontcolor", "link", "removeformat"],
            buttons_extra: ["backcolor", "alignleft", "aligncenter", "alignright", "alignall", "unorderedlist", "orderedlist", "outdent", "indent", "html"],
            activeButtons: ["deleted", "italic", "bold", "underline", "unorderedlist", "orderedlist", "alignleft", "aligncenter", "alignright", "alignall"],
            activeButtonsStates: {
                b: "bold",
                strong: "bold",
                i: "italic",
                em: "italic",
                del: "deleted",
                strike: "deleted",
                ul: "unorderedlist",
                ol: "orderedlist",
                u: "underline"
            },
            emptyHtml: "<p><br></p>",
            buffer: false,
            visual: true,
            toolbar: {
                html: {
                    title: "Редактор HTML",
                    func: "toggle"
                },
                bold: {
                    title: "Жирный",
                    exec: "bold"
                },
                italic: {
                    title: "Курсив",
                    exec: "italic"
                },
                deleted: {
                    title: "Зачеркнутый",
                    exec: "strikethrough"
                },
                underline: {
                    title: "Подчеркнутый",
                    exec: "underline"
                },
                size: {
                    title: "Размер",
                    func: "show_size"
                },
                link: {
                    title: "Вставить ссылку",
                    func: "show_link"
                },
                fontcolor: {
                    title: "Цвет текста",
                    func: "show_color_font"
                },
                backcolor: {
                    title: "Цвет фона",
                    func: "show_color_back"
                },
                removeformat: {
                    title: "Очистить форматирование",
                    exec: "removeFormat"
                },
                unorderedlist: {
                    title: "&bull; Ненумерованный список",
                    exec: "insertunorderedlist"
                },
                orderedlist: {
                    title: "1. Нумерованный список",
                    exec: "insertorderedlist"
                },
                outdent: {
                    title: "&lt; Сдвиг влево",
                    exec: "outdent"
                },
                indent: {
                    title: "&gt; Сдвиг вправо",
                    exec: "indent"
                },
                alignleft: {
                    title: "Выравнивание по левому краю",
                    exec: "JustifyLeft"
                },
                aligncenter: {
                    title: "Выравнивание по центру",
                    exec: "JustifyCenter"
                },
                alignright: {
                    title: "Выравнивание по правому краю",
                    exec: "JustifyRight"
                },
                alignall: {
                    title: "Выравнивание по ширине",
                    exec: "JustifyFull"
                }
            }
        }, c, this.$editor.data());
        this.init()
    };
    b.prototype = {
        init: function() {
            this.document = (this.opts.document) ? this.opts.document : document;
            this.window = (this.opts.window) ? this.opts.window : window;
            this.$html = a('<textarea class="spacedText_html" name="' + this.$editor.attr("id") + '"></textarea>');
            this.$html.addClass("spacedText_html").hide();
            a(this.opts.htmlExternal).html(this.$html);
            this.$editor.addClass("spacedText").attr("contenteditable", true);
            var c = this.$editor.html();
            c = this.to_p(c);
            this.$editor.html(c);
            this.update(true);
            this.build_toolbar();
            if (this.opts.activeButtons !== false && this.opts.toolbar !== false) {
                var f = a.proxy(function() {
                    this.watch()
                }, this);
                this.$editor.click(f).keyup(f)
            }
            if (this.is_mobile() === false && this.is_old_safari() === false) {
                this.$editor.bind("paste", a.proxy(function(g) {
                    this.pasteRunning = true;
                    this.set_buff();
                    this.saveScroll = this.document.body.scrollTop;
                    var i = this.extract_content();
                    setTimeout(a.proxy(function() {
                        var e = this.extract_content();
                        this.$editor.append(i);
                        this.restore_selection();
                        var j = this.get_html_fragment(e);
                        this.paste_clean_up(j);
                        this.pasteRunning = false
                    }, this), 1)
                }, this))
            }
            this.bind_keyup();
            this.bind_keydown();
            if (this.browser("mozilla")) {
                this.$editor.click(a.proxy(function() {
                    this.save_selection()
                }, this));
                try {
                    this.document.execCommand("enableObjectResizing", false, false);
                    this.document.execCommand("enableInlineTableEditing", false, false)
                } catch (d) {}
            }
            if (this.opts.focus) {
                setTimeout(a.proxy(function() {
                    this.$editor.focus()
                }, this), 1)
            }
            if (typeof this.opts.callback === "function") {
                this.opts.callback(this)
            }
            this.$toolbar.find("a").attr("tabindex", "-1");
            this.$editor.on("click", "a", a.proxy(function(g) {
                this.show_link_menu(g)
            }, this))
        },
        bind_keydown: function() {
            this.$editor.keydown(a.proxy(function(f) {
                var c = f.keyCode || f.which;
                var d = f.ctrlKey || f.metaKey;
                if (this.opts.oneline && c === 13) {
                    f.preventDefault();
                    return false
                }
                if (d && this.opts.hotkeys) {
                    if (c === 90) {
                        if (this.opts.buffer !== false) {
                            f.preventDefault();
                            this.get_buff()
                        } else {
                            if (f.shiftKey) {
                                this.hotkey(f, "redo")
                            } else {
                                this.hotkey(f, "undo")
                            }
                        }
                    } else {
                        if (c === 77) {
                            this.hotkey(f, "removeFormat")
                        } else {
                            if (c === 66) {
                                this.hotkey(f, "bold")
                            } else {
                                if (c === 73) {
                                    this.hotkey(f, "italic")
                                }
                            }
                        }
                    }
                }
                if (!d && c !== 90) {
                    this.opts.buffer = false
                }
                if (this.opts.hotkeys && !f.shiftKey && c === 9) {
                    this.hotkey(f, "indent")
                } else {
                    if (this.opts.hotkeys && f.shiftKey && c === 9) {
                        this.hotkey(f, "outdent")
                    }
                }
                if (this.browser("webkit") && navigator.userAgent.indexOf("Chrome") === -1) {
                    if (f.shiftKey && c === 13) {
                        f.preventDefault();
                        this.insert_node_at_caret(a("<span><br /></span>").get(0));
                        this.update();
                        return false
                    } else {
                        return true
                    }
                }
            }, this))
        },
        bind_keyup: function() {
            this.$editor.keyup(a.proxy(function(d) {
                var c = d.keyCode || d.which;
                if (this.browser("mozilla") && !this.pasteRunning) {
                    this.save_selection()
                }
                if (c === 8 || c === 46) {
                    return this.format_empty(d)
                }
                if (c === 13 && !d.shiftKey && !d.ctrlKey && !d.metaKey) {
                    if (this.browser("webkit")) {
                        this.format_new_line(d)
                    }
                    if (this.opts.convertLinks) {
                        this.$editor.linkfinder()
                    }
                }
                this.update()
            }, this))
        },
        build_toolbar: function() {
            if (this.opts.toolbar === false) {
                return false
            }
            this.$toolbar = a("<ul>").addClass("spacedText_toolbar");
            a(this.opts.toolbarExternal).html(this.$toolbar);
            a.each(this.opts.buttons, a.proxy(function(e, d) {
                if (typeof this.opts.toolbar[d] !== "undefined") {
                    var f = this.opts.toolbar[d];
                    this.$toolbar.append(a("<li>").append(this.build_btn(d, f)));
                    if (d == "size") {
                        var g = a('<ul class="size"><li><a href="javascript:void(0);" data-size="-3"></a></li><li><a href="javascript:void(0);" data-size="-2"></a></li><li><a href="javascript:void(0);" data-size="-1"></a></li><li><a href="javascript:void(0);" data-size="0"></a></li><li><a href="javascript:void(0);" data-size="+1"></a></li><li><a href="javascript:void(0);" data-size="+2"></a></li><li><a href="javascript:void(0);" data-size="+3"></a></li></ul>');
                        g.on("mousedown", "a", a.proxy(function(i) {
                            this.show_size_value(i)
                        }, this));
                        this.$toolbar.find(".spacedText_btn_size").parent().addClass("size").append(g)
                    }
                }
            }, this));
            if (this.opts.buttons_extra.length > 0) {
                a.each(this.opts.buttons_extra, a.proxy(function(e, d) {
                    if (typeof this.opts.toolbar[d] !== "undefined") {
                        var f = this.opts.toolbar[d];
                        this.$toolbar.append(a('<li class="spacedText_extra_only">').append(this.build_btn(d, f)))
                    }
                }, this));
                var c = a('<li><a class="spacedText_extra_btn"></a></li>');
                this.$toolbar.append(c);
                c.find("a").on("mousedown", a.proxy(function(d) {
                    this.$toolbar.toggleClass("is_extra");
                    d.preventDefault();
                    return false
                }, this))
            }
        },
        build_btn: function(d, e) {
            var c = a('<a href="javascript:void(0);" title="' + e.title + '" class="spacedText_btn_' + d + '"></a>');
            if (typeof e.func === "undefined") {
                c.mousedown(a.proxy(function() {
                    if (!this.opts.visual) {
                        alertify.log("Функция недоступна в режиме HTML");
                        return
                    }
                    if (a.inArray(d, this.opts.activeButtons) != -1) {
                        this.all_btn_inactive();
                        this.set_btn_active(d)
                    }
                    if (this.browser("mozilla")) {
                        this.$editor.focus()
                    }
                    this.execCommand(e.exec, d)
                }, this))
            } else {
                if (e.func !== "show") {
                    c.mousedown(a.proxy(function(f) {
                        if (!this.opts.visual && e.func !== "toggle") {
                            alertify.log("Функция недоступна в режиме HTML");
                            return
                        }
                        this[e.func](f)
                    }, this))
                }
            }
            if (typeof e.callback !== "undefined" && e.callback !== false) {
                c.mousedown(a.proxy(function(f) {
                    if (!this.opts.visual) {
                        alertify.log("Функция недоступна в режиме HTML");
                        return
                    }
                    e.callback(this, f, d)
                }, this))
            }
            return c
        },
        get_btn: function(c) {
            if (this.opts.toolbar === false) {
                return false
            }
            return a(this.$toolbar.find("a.spacedText_btn_" + c))
        },
        set_btn_active: function(c) {
            this.get_btn(c).parent().addClass("spacedText_act")
        },
        set_btn_inactive: function(c) {
            this.get_btn(c).parent().removeClass("spacedText_act")
        },
        all_btn_inactive: function() {
            a.each(this.opts.activeButtons, a.proxy(function(c, d) {
                this.set_btn_inactive(d)
            }, this))
        },
        hotkey: function(d, c) {
            d.preventDefault();
            this.execCommand(c, false)
        },
        change: function() {
            var c = this.get_code();
            if (typeof(this.opts.on_change) === "function") {
                this.opts.on_change(c, this.$editor)
            }
        },
        update: function(c) {
            this.$html.val(this.$editor.html());
            if (!c) {
                this.change()
            }
        },
        set_code: function(c) {
            c = this.strip_tags(c);
            this.$editor.html(c).focus();
            this.update()
        },
        get_code: function() {
            var c = "";
            if (this.opts.visual) {
                c = this.$editor.html()
            } else {
                c = this.$html.val()
            }
            return this.strip_tags(c)
        },
        paste_html_at_caret: function(d) {
            var i, c;
            if (this.document.getSelection) {
                i = this.window.getSelection();
                if (i.getRangeAt && i.rangeCount) {
                    c = i.getRangeAt(0);
                    c.deleteContents();
                    var e = this.document.createElement("div");
                    e.innerHTML = d;
                    var j = this.document.createDocumentFragment(),
                        g, f;
                    while (g = e.firstChild) {
                        f = j.appendChild(g)
                    }
                    c.insertNode(j);
                    if (f) {
                        c = c.cloneRange();
                        c.setStartAfter(f);
                        c.collapse(true);
                        i.removeAllRanges();
                        i.addRange(c)
                    }
                }
            } else {
                if (this.document.selection && this.document.selection.type != "Control") {
                    this.document.selection.createRange().pasteHTML(d)
                }
            }
        },
        destroy: function() {
            var c = this.get_code();
            this.$editor.removeClass("spacedText").removeAttr("contenteditable").html(c).show();
            a(this.opts.toolbarExternal).empty();
            if (this.modal_link) {
                this.modal_link.close()
            }
            if (this.modal_link_edit) {
                this.modal_link_edit.close()
            }
        },
        watch: function() {
            var d = this.get_current_node();
            if (this.wait_size_change) {
                this.show_size_value()
            }
            this.all_btn_inactive();
            a.each(this.opts.activeButtonsStates, a.proxy(function(f, g) {
                if (a(d).closest(f, this.$editor.get()[0]).length != 0) {
                    this.set_btn_active(g)
                }
            }, this));
            var c = a(d).closest(["p", "div", "h1", "h2", "h3", "h4", "h5", "h6", "blockquote", "td"]);
            if (typeof c[0] !== "undefined" && typeof c[0].elem !== "undefined" && a(c[0].elem).size() != 0) {
                var e = a(c[0].elem).css("text-align");
                switch (e) {
                    case "right":
                        this.set_btn_active("alignright");
                        break;
                    case "center":
                        this.set_btn_active("aligncenter");
                        break;
                    case "justify":
                        this.set_btn_active("alignall");
                        break;
                    default:
                        this.set_btn_active("alignleft");
                        break
                }
            }
        },
        set_buff: function() {
            this.save_selection();
            this.opts.buffer = this.$editor.html()
        },
        get_buff: function() {
            if (this.opts.buffer === false) {
                return false
            }
            this.$editor.html(this.opts.buffer);
            if (!this.browser("msie")) {
                this.restore_selection()
            }
            this.opts.buffer = false
        },
        execCommand: function(i, g) {
            if (this.opts.visual == false) {
                this.$html.focus();
                return false
            }
            try {
                var p;
                if (i === "inserthtml") {
                    if (this.browser("msie")) {
                        this.$editor.focus();
                        this.document.selection.createRange().pasteHTML(g)
                    } else {
                        this.paste_html_at_caret(g)
                    }
                } else {
                    if (i === "unlink") {
                        p = this.get_parent_node();
                        if (a(p).get(0).tagName === "A") {
                            a(p).replaceWith(a(p).text())
                        } else {
                            this.exec(i, g)
                        }
                    } else {
                        if (i === "JustifyLeft" || i === "JustifyCenter" || i === "JustifyRight" || i === "JustifyFull") {
                            p = this.get_current_node();
                            var u = this.get_selection();
                            var n = [];
                            if (a(p).parents(".spacedText").size() == 0) {
                                var c = a(u.anchorNode);
                                var m = a(u.focusNode);
                                if (c.get(0).tagName != "P") {
                                    c = c.closest("p")
                                }
                                if (m.get(0).tagName != "P") {
                                    m = m.closest("p")
                                } else {
                                    m = m.prev()
                                }
                                if (c.length < 1 && m.length < 1) {
                                    var j = a(u.anchorNode).parent();
                                    if (j.is(".spacedText") && j.find("p").length < 1) {
                                        var t = a("<p></p>").html(j.html());
                                        j.html(t);
                                        c = m = t
                                    }
                                }
                                var d = c.parent();
                                if (c.length == 1 && m.length == 1 && d.is(".spacedText")) {
                                    if (c.get(0).offsetTop > m.get(0).offsetTop) {
                                        var q = c;
                                        c = m;
                                        m = q
                                    }
                                    if (c.get(0) == m.get(0)) {
                                        n.push(c)
                                    } else {
                                        var o = false;
                                        d.children("p").each(function(s, v) {
                                            var e = a(v);
                                            if (v == c.get(0)) {
                                                o = true;
                                                n.push(e)
                                            } else {
                                                if (v == m.get(0)) {
                                                    o = false;
                                                    n.push(e)
                                                } else {
                                                    if (o) {
                                                        n.push(e)
                                                    }
                                                }
                                            }
                                        });
                                        if (n.length < 1) {
                                            log("ERR: не смогли определить нужные элементы P для выравнивания");
                                            return false
                                        }
                                    }
                                } else {
                                    return false
                                }
                            } else {
                                if (a.inArray(a(p).get(0).tagName, ["P", "DIV", "H1", "H2", "H3", "H4", "H5", "H6", "BLOCKQUOTE", "TD"]) != -1) {
                                    this.exec(i, g);
                                    this.update();
                                    return
                                } else {
                                    n.push(a(p))
                                }
                            }
                            a.each(n, a.proxy(function(s, e) {
                                var v = "left";
                                if (i === "JustifyCenter") {
                                    v = "center"
                                } else {
                                    if (i === "JustifyRight") {
                                        v = "right"
                                    } else {
                                        if (i === "JustifyFull") {
                                            v = "justify"
                                        }
                                    }
                                }
                                if (v === false) {
                                    e.attr("align", "")
                                } else {
                                    e.attr("align", v)
                                }
                            }, this))
                        } else {
                            if (i === "formatblock" && g === "blockquote") {
                                p = this.get_current_node();
                                if (a(p).get(0).tagName === "BLOCKQUOTE") {
                                    if (this.browser("msie")) {
                                        var f = a("<p>" + a(p).html() + "</p>");
                                        a(p).replaceWith(f)
                                    } else {
                                        this.exec(i, "p")
                                    }
                                } else {
                                    if (a(p).get(0).tagName === "P") {
                                        var l = a(p).parent();
                                        if (a(l).get(0).tagName === "BLOCKQUOTE") {
                                            var f = a("<p>" + a(p).html() + "</p>");
                                            a(l).replaceWith(f);
                                            this.set_selection(f[0], 0, f[0], 0)
                                        } else {
                                            if (this.browser("msie")) {
                                                var f = a("<blockquote>" + a(p).html() + "</blockquote>");
                                                a(p).replaceWith(f)
                                            } else {
                                                this.exec(i, g)
                                            }
                                        }
                                    } else {
                                        this.exec(i, g)
                                    }
                                }
                            } else {
                                if (i === "formatblock" && (g === "pre" || g === "p")) {
                                    this.exec(i, g)
                                } else {
                                    if (i === "formatblock" && this.browser("mozilla")) {
                                        this.$editor.focus()
                                    }
                                    this.exec(i, g)
                                }
                            }
                        }
                    }
                }
                this.update();
                if (this.old_ie()) {
                    this.$editor.focus()
                }
            } catch (k) {}
        },
        exec: function(c, d) {
            if (c === "formatblock" && this.browser("msie")) {
                d = "<" + d + ">"
            }
            this.document.execCommand(c, false, d)
        },
        format_new_line: function(f) {
            var d = this.get_parent_node();
            if (d.nodeName === "DIV" && d.className === "spacedText") {
                var c = a(this.get_current_node());
                if (c.get(0).tagName === "DIV" && (c.html() === "" || c.html() === "<br>")) {
                    var g = a("<p>").append(c.clone().get(0).childNodes);
                    c.replaceWith(g);
                    g.html("<br>");
                    this.set_selection(g[0], 0, g[0], 0)
                }
            }
        },
        format_empty: function(g) {
            var c = a.trim(this.$editor.html());
            c = c.replace(/<br\s?\/?>/i, "");
            var f = c.replace(/<p>\s?<\/p>/gi, "");
            if (c === "" || f === "") {
                g.preventDefault();
                var d = a(this.opts.emptyHtml).get(0);
                this.$editor.html(d);
                this.set_selection(d, 0, d, 0);
                this.update();
                return false
            } else {
                this.update()
            }
        },
        to_p: function(e) {
            e = a.trim(e);
            if (e === "" || e === "<p></p>") {
                return this.opts.emptyHtml
            }
            if (this.opts.convertDivs) {
                e = e.replace(/<div(.*?)>([\w\W]*?)<\/div>/gi, "<p>$2</p>")
            }
            var f = function(i, j, g) {
                return i.replace(new RegExp(j, "g"), g)
            };
            var c = function(i, g) {
                return f(e, i, g)
            };
            var d = "(table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|address|math|style|script|object|input|param|p|h[1-6])";
            e += "\n";
            c("<br />\\s*<br />", "\n\n");
            c("(<" + d + "[^>]*>)", "\n$1");
            c("(</" + d + ">)", "$1\n\n");
            c("\r\n|\r", "\n");
            c("\n\n+", "\n\n");
            c("\n?((.|\n)+?)$", "<p>$1</p>\n");
            c("<p>\\s*?</p>", "");
            c("<p>(<div[^>]*>\\s*)", "$1<p>");
            c("<p>([^<]+)\\s*?(</(div|address|form)[^>]*>)", "<p>$1</p>$2");
            c("<p>\\s*(</?" + d + "[^>]*>)\\s*</p>", "$1");
            c("<p>(<li.+?)</p>", "$1");
            c("<p>\\s*(</?" + d + "[^>]*>)", "$1");
            c("(</?" + d + "[^>]*>)\\s*</p>", "$1");
            c("(</?" + d + "[^>]*>)\\s*<br />", "$1");
            c("<br />(\\s*</?(p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)", "$1");
            if (e.indexOf("<pre") != -1) {
                c("(<pre(.|\n)*?>)((.|\n)*?)</pre>", function(k, j, i, g) {
                    return f(j, "\\\\(['\"\\\\])", "$1") + f(f(f(g, "<p>", "\n"), "</p>|<br />", ""), "\\\\(['\"\\\\])", "$1") + "</pre>"
                })
            }
            return c("\n</p>$", "</p>")
        },
        strip_tags: function(d) {
            var e = this.opts.allowedTags;
            var c = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
            return d.replace(c, function(g, f) {
                return a.inArray(f.toLowerCase(), e) > "-1" ? g : ""
            })
        },
        paste_strip_tags: function(d) {
            var e = this.opts.allowedTagsPaste;
            var c = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
            return d.replace(c, function(g, f) {
                return a.inArray(f.toLowerCase(), e) > "-1" ? g : ""
            })
        },
        paste_clean_up: function(c) {
            c = c.replace(/<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi, "");
            c = c.replace(/(&nbsp;){2,}/gi, "&nbsp;");
            c = c.replace(/<b\sid="internal-source-marker(.*?)">([\w\W]*?)<\/b>/gi, "$2");
            c = this.paste_strip_tags(c);
            c = c.replace(/<td><\/td>/gi, "[td]");
            c = c.replace(/<td>&nbsp;<\/td>/gi, "[td]");
            c = c.replace(/<td><br><\/td>/gi, "[td]");
            c = c.replace(/<a(.*?)href="(.*?)"(.*?)>([\w\W]*?)<\/a>/gi, '[a href="$2"]$4[/a]');
            c = c.replace(/<img(.*?) src="(.*?)"(.*?)>/gi, '[img src="$2"]');
            c = c.replace(/<(\w+)([\w\W]*?)>/gi, "<$1>");
            c = c.replace(/<[^\/>][^>]*>(\s*|\t*|\n*|&nbsp;|<br>)<\/[^>]+>/gi, "");
            c = c.replace(/<[^\/>][^>]*>(\s*|\t*|\n*|&nbsp;|<br>)<\/[^>]+>/gi, "");
            c = c.replace(/\[td\]/gi, "<td>&nbsp;</td>");
            c = c.replace(/\[a href="(.*?)"\]([\w\W]*?)\[\/a\]/gi, '<a href="$1">$2</a>');
            c = c.replace(/\[img(.*?)\]/gi, "<img$1>");
            if (this.opts.convertDivs) {
                c = c.replace(/<div(.*?)>([\w\W]*?)<\/div>/gi, "<p>$2</p>")
            }
            c = c.replace(/<span>([\w\W]*?)<\/span>/gi, "$1");
            c = c.replace(/\n{3,}/gi, "\n");
            c = c.replace(/<p><p>/gi, "<p>");
            c = c.replace(/<\/p><\/p>/gi, "</p>");
            if (this.browser("mozilla")) {
                c = c.replace(/<br>$/gi, "")
            }
            this.execCommand("inserthtml", c);
            a(this.document.body).scrollTop(this.saveScroll)
        },
        format_remove: function(d) {
            var c = [];
            var e = d.match(/<pre(.*?)>([\w\W]*?)<\/pre>/gi);
            if (e !== null) {
                a.each(e, function(f, g) {
                    d = d.replace(g, "prebuffer_" + f);
                    c.push(g)
                })
            }
            d = d.replace(/\s{2,}/g, " ");
            d = d.replace(/\n/g, " ");
            d = d.replace(/[\t]*/g, "");
            d = d.replace(/\n\s*\n/g, "\n");
            d = d.replace(/^[\s\n]*/g, "");
            d = d.replace(/[\s\n]*$/g, "");
            d = d.replace(/>\s+</g, "><");
            if (c) {
                a.each(c, function(f, g) {
                    d = d.replace("prebuffer_" + f, g)
                });
                c = []
            }
            return d
        },
        toggle: function() {
            var d;
            if (this.opts.visual) {
                var c = this.$editor.innerHeight();
                this.$editor.hide();
                d = this.$editor.html();
                this.$html.height(c).val(d).show().focus();
                this.set_btn_active("html");
                this.opts.visual = false
            } else {
                this.$html.hide();
                d = this.$html.val();
                this.$editor.html(d).show();
                if (this.$editor.html() === "") {
                    this.set_code(this.opts.emptyHtml)
                }
                this.$editor.focus();
                this.set_btn_inactive("html");
                this.opts.visual = true;
                this.update()
            }
        },
        get_html_fragment: function(d) {
            var c = d.cloneNode(true);
            var e = this.document.createElement("div");
            e.appendChild(c);
            return e.innerHTML
        },
        extract_content: function() {
            var c = this.$editor.get(0);
            var e = this.document.createDocumentFragment(),
                d;
            while ((d = c.firstChild)) {
                e.appendChild(d)
            }
            return e
        },
        save_selection: function() {
            this.$editor.focus();
            this.savedSel = this.get_origin();
            this.savedSelObj = this.get_focus()
        },
        restore_selection: function() {
            if (typeof this.savedSel !== "undefined" && this.savedSel !== null && this.savedSelObj !== null && this.savedSel[0].tagName !== "BODY") {
                if (a(this.savedSel[0]).closest(".spacedText").size() == 0) {
                    this.$editor.focus()
                } else {
                    if (this.browser("opera")) {
                        this.$editor.focus()
                    }
                    this.set_selection(this.savedSel[0], this.savedSel[1], this.savedSelObj[0], this.savedSelObj[1]);
                    if (this.browser("mozilla")) {
                        this.$editor.focus()
                    }
                }
            } else {
                this.$editor.focus()
            }
        },
        get_selection: function() {
            var c = this.document;
            if (this.window.getSelection) {
                return this.window.getSelection()
            } else {
                if (c.getSelection) {
                    return c.getSelection()
                } else {
                    return c.selection.createRange()
                }
            }
            return false
        },
        has_selection: function() {
            if (!this.old_ie()) {
                var e;
                return (e = this.get_selection()) && (e.focusNode != null) && (e.anchorNode != null)
            } else {
                var d = this.$editor.get(0);
                var c;
                d.focus();
                if (!d.document.selection) {
                    return false
                }
                c = d.document.selection.createRange();
                return c && c.parentElement().document === d.document
            }
        },
        get_origin: function() {
            if (!this.old_ie()) {
                var e;
                if (!((e = this.get_selection()) && (e.anchorNode != null))) {
                    return null
                }
                return [e.anchorNode, e.anchorOffset]
            } else {
                var d = this.$editor.get(0);
                var c;
                d.focus();
                if (!this.has_selection()) {
                    return null
                }
                c = d.document.selection.createRange();
                return this._get_boundary(d.document, c, true)
            }
        },
        get_focus: function() {
            if (!this.old_ie()) {
                var e;
                if (!((e = this.get_selection()) && (e.focusNode != null))) {
                    return null
                }
                return [e.focusNode, e.focusOffset]
            } else {
                var d = this.$editor.get(0);
                var c;
                d.focus();
                if (!this.has_selection()) {
                    return null
                }
                c = d.document.selection.createRange();
                return this._get_boundary(d.document, c, false)
            }
        },
        set_selection: function(l, k, j, g) {
            if (j == null) {
                j = l
            }
            if (g == null) {
                g = k
            }
            if (!this.old_ie()) {
                var f = this.get_selection();
                if (!f) {
                    return
                }
                if (f.collapse && f.extend) {
                    f.collapse(l, k);
                    f.extend(j, g)
                } else {
                    r = this.document.createRange();
                    r.setStart(l, k);
                    r.setEnd(j, g);
                    try {
                        f.removeAllRanges()
                    } catch (i) {}
                    f.addRange(r)
                }
            } else {
                var d = this.$editor.get(0);
                var c = d.document.body.createTextRange();
                this._move_boundary(d.document, c, false, j, g);
                this._move_boundary(d.document, c, true, l, k);
                return c.select()
            }
        },
        get_current_node: function() {
            if (typeof this.window.getSelection !== "undefined") {
                return this.get_selected_node().parentNode
            } else {
                if (typeof this.document.selection !== "undefined") {
                    return this.get_selection().parentElement()
                }
            }
        },
        get_parent_node: function() {
            return a(this.get_current_node()).parent()[0]
        },
        get_selected_node: function() {
            if (this.old_ie()) {
                return this.get_selection().parentElement()
            } else {
                if (typeof this.window.getSelection !== "undefined") {
                    var c = this.window.getSelection();
                    if (c.rangeCount > 0) {
                        return this.get_selection().getRangeAt(0).commonAncestorContainer
                    } else {
                        return false
                    }
                } else {
                    if (typeof this.document.selection !== "undefined") {
                        return this.get_selection()
                    }
                }
            }
        },
        _get_boundary: function(i, f, g) {
            var k, c, e, j, d;
            c = i.createElement("a");
            k = f.duplicate();
            k.collapse(g);
            d = k.parentElement();
            while (true) {
                d.insertBefore(c, c.previousSibling);
                k.moveToElementText(c);
                if (!(k.compareEndPoints((g ? "StartToStart" : "StartToEnd"), f) > 0 && (c.previousSibling != null))) {
                    break
                }
            }
            if (k.compareEndPoints((g ? "StartToStart" : "StartToEnd"), f) === -1 && c.nextSibling) {
                k.setEndPoint((g ? "EndToStart" : "EndToEnd"), f);
                e = c.nextSibling;
                j = k.text.length
            } else {
                e = c.parentNode;
                j = this._get_child_index(c)
            }
            c.parentNode.removeChild(c);
            return [e, j]
        },
        _move_boundary: function(i, m, l, e, f) {
            var j, g, k, c, d;
            d = 0;
            j = this._is_text(e) ? e : e.childNodes[f];
            g = this._is_text(e) ? e.parentNode : e;
            if (this._is_text(e)) {
                d = f
            }
            c = i.createElement("a");
            g.insertBefore(c, j || null);
            k = i.body.createTextRange();
            k.moveToElementText(c);
            c.parentNode.removeChild(c);
            m.setEndPoint((l ? "StartToStart" : "EndToEnd"), k);
            return m[l ? "moveStart" : "moveEnd"]("character", d)
        },
        _is_text: function(c) {
            return (c != null ? c.nodeType == 3 : false)
        },
        _get_child_index: function(d) {
            var c = 0;
            while (d = d.previousSibling) {
                c++
            }
            return c
        },
        insert_node_at_caret: function(g) {
            if (this.window.getSelection) {
                var i = this.get_selection();
                if (i.rangeCount) {
                    var d = i.getRangeAt(0);
                    d.collapse(false);
                    d.insertNode(g);
                    d = d.cloneRange();
                    d.selectNodeContents(g);
                    d.collapse(false);
                    i.removeAllRanges();
                    i.addRange(d)
                }
            } else {
                if (this.document.selection) {
                    var e = (g.nodeType === 1) ? g.outerHTML : g.data;
                    var j = "marker_" + ("" + Math.random()).slice(2);
                    e += '<span id="' + j + '"></span>';
                    var f = this.get_selection();
                    f.collapse(false);
                    f.pasteHTML(e);
                    var c = this.document.getElementById(j);
                    f.moveToElementText(c);
                    f.select();
                    c.parentNode.removeChild(c)
                }
            }
        },
        show_size: function(c) {
            return false
        },
        show_size_value: function(d) {
            this.execCommand("FontSize", 2);
            if (this.$editor.find('font[size="2"]').length > 0) {
                if (this.wait_size_change) {
                    var c = this.wait_size_change_btn;
                    this.wait_size_change = false
                } else {
                    var c = a(d.currentTarget)
                }
                var f = parseInt(c.attr("data-size")) + parseInt(this.$editor.css("font-size")) + "px";
                this.$editor.find('font[size="2"]').replaceWith(function() {
                    var e = a(this);
                    e.find('[style*="font-size"]').each(function(k, l) {
                        var j = a(this);
                        var g = j.attr("style");
                        g = g.replace(/font-size:\s{0,3}([0-9]*){1,3}(px|pt|%|em);{0,1}/gi, "");
                        j.attr("style", g)
                    });
                    return a('<span style="font-size: ' + f + ';">' + e.html() + "</span>")
                });
                this.update()
            } else {
                this.wait_size_change = true;
                this.wait_size_change_btn = a(d.currentTarget)
            }
        },
        show_color_font: function(f) {
            var d = a(f.currentTarget);
            var c;
            var g = a(this.get_current_node()).eq(0).css("color");
            a.fn.spacedColors({
                value: g,
                element: d,
                element_offset: {
                    top: 50,
                    left: 230 + 27
                },
                opacity: false,
                show: true,
                change: a.proxy(function(e) {
                    if (c) {
                        c.css("color", e.value);
                        this.update()
                    } else {
                        c = this.set_color("font", e.value)
                    }
                }, this),
                on_done: a.proxy(function() {}, this),
                on_cancel: a.proxy(function() {
                    if (c) {
                        c.css("color", g);
                        this.update()
                    } else {
                        c = this.set_color("font", g)
                    }
                }, this)
            })
        },
        show_color_back: function(f) {
            var d = a(f.currentTarget);
            var c;
            var g = a(this.get_current_node()).eq(0).css("background-color");
            a.fn.spacedColors({
                value: g,
                element: d,
                element_offset: {
                    top: 50,
                    left: 230 + 27
                },
                opacity: false,
                show: true,
                change: a.proxy(function(e) {
                    if (c) {
                        c.css("background-color", e.value);
                        this.update()
                    } else {
                        c = this.set_color("back", e.value)
                    }
                }, this),
                on_done: a.proxy(function() {}, this),
                on_cancel: a.proxy(function() {
                    if (c) {
                        c.css("background-color", g);
                        this.update()
                    } else {
                        c = this.set_color("back", g)
                    }
                }, this)
            })
        },
        set_color: function(e, c) {
            var f;
            if (e === "back") {
                if (this.browser("msie")) {
                    f = "BackColor"
                } else {
                    f = "hilitecolor"
                }
            } else {
                f = "forecolor"
            }
            this.execCommand(f, c);
            var d = false;
            if (f === "forecolor") {
                this.$editor.find("font").replaceWith(function() {
                    var g = a('<span style="color: ' + a(this).attr("color") + ';">' + a(this).html() + "</span>");
                    d = (!d) ? g : d.add(g);
                    return g
                });
                this.update();
                return d
            } else {
                if (this.browser("msie") && f === "BackColor") {
                    this.$editor.find("font").replaceWith(function() {
                        var g = a('<span style="color: ' + a(this).attr("style") + ';">' + a(this).html() + "</span>");
                        d = (!d) ? g : d.add(g);
                        return g
                    });
                    this.update();
                    return d
                }
            }
        },
        show_link_menu: function(j) {
            var d = a(j.currentTarget);
            var c = (d.attr("target") == "blank") ? 'target="_blank"' : "";
            var f = a("<div></div>");
            var k = a('<a style="margin-left: 15px">Редактировать</a>');
            var i = a("<a>удалить</a>");
            f.append('<a href="' + d.attr("href") + '" ' + c + ' title="Перейти по ссылке" class="is_link">' + d.attr("href") + "</a>").append(k).append("&nbsp;или&nbsp;").append(i);
            var g = spaced.modal.create({
                name: "spacedText_link",
                light: true,
                width: "auto",
                data: f
            });
            this.modal_link = g;
            k.on("click", a.proxy(function() {
                g.close();
                this.show_link(undefined, true)
            }, this));
            i.on("click", a.proxy(function() {
                var e = this.get_selection();
                if (e.anchorNode && a(e.anchorNode.parentNode).get(0).tagName === "A") {
                    a(e.anchorNode.parentNode).replaceWith(a(e.anchorNode.parentNode).text())
                } else {
                    this.exec("unlink", false)
                }
                g.close();
                this.change()
            }, this));
            j.stopImmediatePropagation()
        },
        show_link: function(g, c) {
            this.save_selection();
            this.insert_link_node = false;
            var i = this.get_selection();
            var d = "",
                k = "",
                j = "";
            if (this.browser("msie")) {
                var e = this.get_parent_node();
                if (e.nodeName === "A") {
                    this.insert_link_node = a(e);
                    k = this.insert_link_node.text();
                    d = this.insert_link_node.attr("href");
                    j = this.insert_link_node.attr("target")
                } else {
                    if (this.old_ie()) {
                        k = i.text
                    } else {
                        k = i.toString()
                    }
                }
            } else {
                if (i && i.anchorNode && i.anchorNode.parentNode.tagName === "A") {
                    d = i.anchorNode.parentNode.href;
                    k = i.anchorNode.parentNode.text;
                    j = i.anchorNode.parentNode.target;
                    if (i.toString() === "") {
                        this.insert_link_node = i.anchorNode.parentNode
                    }
                } else {
                    k = i.toString()
                }
            }
            if (c) {
                d = spaced.regex.link.get_link(d)
            }
            var f = spaced.modal.create({
                name: "spacedText_link_edit",
                light: true,
                width: 270,
                options: {
                    url: {
                        type: "text",
                        title: "URL",
                        focus: true,
                        value: d,
                        autocomplete: {
                            source: "/admin/edit/link_search",
                            minLength: 1
                        }
                    },
                    text: {
                        type: "text",
                        title: "Текст",
                        value: k
                    },
                    is_blank: {
                        type: "checkbox",
                        title: "Открывать в новой вкладке",
                        value: (j == "_blank")
                    }
                },
                buttons: {
                    create: {
                        title: (c) ? "Изменить" : "Создать",
                        style: "light",
                        click: a.proxy(function(l) {
                            if (l.url && l.url.length) {
                                var m = spaced.regex.link.get_link(l.url);
                                if (l.text.length < 1) {
                                    l.text = m
                                }
                                this.insert_link({
                                    url: m,
                                    is_blank: (l.is_blank),
                                    text: l.text
                                });
                                f.close()
                            }
                        }, this)
                    },
                    cancel: {
                        title: "Отмена",
                        style: "cancel",
                        width: 104,
                        align: "right",
                        click: a.proxy(function() {}, this)
                    }
                },
                cancel: a.proxy(function() {}, this)
            });
            this.modal_link_edit = f
        },
        insert_link: function(f) {
            var d = "",
                e = "";
            if (f.is_blank) {
                d = ' target="_blank"';
                e = "_blank"
            }
            var c = '<a href="' + f.url + '"' + d + ">" + f.text + "</a>";
            this.$editor.focus();
            this.restore_selection();
            if (f.text !== "") {
                if (this.insert_link_node) {
                    a(this.insert_link_node).text(f.text);
                    a(this.insert_link_node).attr("href", f.url);
                    if (e !== "") {
                        a(this.insert_link_node).attr("target", e)
                    } else {
                        a(this.insert_link_node).removeAttr("target")
                    }
                    this.update()
                } else {
                    this.execCommand("inserthtml", c)
                }
            }
        },
        browser: function(d) {
            var e = navigator.userAgent.toLowerCase();
            var c = /(chrome)[ \/]([\w.]+)/.exec(e) || /(webkit)[ \/]([\w.]+)/.exec(e) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e) || /(msie) ([\w.]+)/.exec(e) || /(trident) ([\w.]+)/.exec(e) || e.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e) || [];
            if (d == "version") {
                return c[2]
            }
            if (d == "webkit") {
                return (c[1] == "chrome" || c[1] == "webkit")
            }
            return c[1] == d
        },
        old_ie: function() {
            if (this.browser("msie") && parseInt(this.browser("version"), 10) < 9) {
                return true
            }
            return false
        },
        is_mobile: function() {
            if (/(iPhone|iPod|iPad|BlackBerry|Android)/.test(navigator.userAgent)) {
                return true
            } else {
                if (/(iPhone|iPod|BlackBerry|Android)/.test(navigator.userAgent)) {
                    return true
                } else {
                    return false
                }
            }
        },
        is_old_safari: function() {
            var d = false;
            if (this.browser("webkit") && navigator.userAgent.indexOf("Chrome") === -1) {
                var c = this.browser("version").split(".");
                if (c[0] < 536) {
                    d = true
                }
            }
            return d
        }
    };
    a.fn.spacedText = function(c) {
        return this.each(function() {
            var e = a(this);
            var d = e.data("spacedText");
            if (!d) {
                e.data("spacedText", (d = new b(this, c)))
            }
        })
    };
    a.fn.spacedTextDestroy = function() {
        this.each(function() {
            if (typeof a(this).data("spacedText") != "undefined") {
                a(this).data("spacedText").destroy();
                a(this).removeData("spacedText")
            }
        })
    };
    a.fn.spacedTextGetCode = function() {
        return a.trim(this.data("spacedText").get_code())
    };
    a.fn.spacedTextSetCode = function(c) {
        this.data("spacedText").set_code(c)
    };
    a.fn.spacedTextSetFocus = function() {
        this.data("spacedText").$editor.focus()
    }
})(jQuery);
(function(c) {
    var e = "http://";
    var d = /(^|&lt;|\s)(www\..+?\..+?)(\s|&gt;|$)/g,
        b = /(^|&lt;|\s)(((https?|ftp):\/\/|mailto:).+?)(\s|&gt;|$)/g,
        a = function() {
            var j = this.childNodes,
                g = j.length;
            while (g--) {
                var k = j[g];
                if (k.nodeType === 3) {
                    var f = k.nodeValue;
                    if (f) {
                        f = f.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(d, '$1<a href="' + e + '$2">$2</a>$3').replace(b, '$1<a href="$2">$2</a>$5');
                        c(k).after(f).remove()
                    }
                } else {
                    if (k.nodeType === 1 && !/^(a|button|textarea)$/i.test(k.tagName)) {
                        a.call(k)
                    }
                }
            }
        };
    c.fn.linkfinder = function() {
        this.each(a)
    }
})(jQuery);