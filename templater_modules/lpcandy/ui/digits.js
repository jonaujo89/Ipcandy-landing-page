lp.digits = lp.block.extendOptions({
    change: function(){  
        this.variant.find(".title").toggle(this.value.show_title);
            this.variant.find(".title_2").toggle(this.value.show_title_2);
        
        if (this.value.variant == 1) { 
            this.cmp.element.find(".digits").css({
                background: this.value.background_color || '',
            });             
        }
        if (this.value.variant == 2) { 
            this.cmp.element.find(".digits").css({
                background: this.value.background_color || '',
            });
        }
        if (this.value.variant == 3 || this.value.variant == 5 || this.value.variant == 6 || this.value.variant == 7) {             
            var pattern_background = /#\w{3,6}/;
            if (pattern_background.test(this.value.background)) { //проверка это цвет
                this.variant.find(".digits").css({
                    background: this.value.background,
                });
            } else { //если нет, то всталяем картинку
                this.variant.find(".digits").css({
                    background: "url("+base_url+(this.value.background)+")",
                });
            }
        }
        if (this.value.variant == 4) { 
            this.cmp.element.find(".digits").css({
                background: this.value.background_color || '',
            });
            this.variant.find(".item_list").prop("class","item_list "+this.value.icon_color);
        }
        if (this.value.variant == 7) {
            this.variant.find(".item_list").prop("class","item_list "+this.value.icon_color);
        }
        if (this.value.variant == 8) {
            this.cmp.element.find(".digits").css({
                background: this.value.background_color || '',
            });
            this.variant.find(".value").css({color: this.value.digits_color});
        }
    },
    configForm: {
        items: [   
            { 
                name: "show_title", 
                label: "Show first title", 
                type: "check", 
                width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", 
            },
            { 
                name: "show_title_2", 
                label: "Show second title", 
                type: "check", 
                width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", 
            },
            {   type: "label", value: "Icon color:", margin: "5px 0 0", showWhen: { variant: [4,7] } },
            { 
                name: "icon_color",
                items: [{ label: "black<br>", value:"icon_black"},{ label: "grey<br>", value:"icon_grey"}],
                type: "radio", width: "auto", height: 50, 
                margin: "0px 49% 5px 0px", showWhen: { variant: [4] }
            },
            { 
                name: "icon_color",
                items: [{ label: "white<br>", value:"icon_white"},{ label: "grey<br>", value:"icon_grey"}],
                type: "radio", width: "auto", height: 50, 
                margin: "0px 49% 5px 0px", showWhen: { variant: [7] }
            },
            {   type: "label", value: "Digits color:", margin: "5px 0 0", showWhen: { variant: [8] } },
            { 
                type: lp.color, 
                name: "digits_color",  
                items: [{ value: "#000" },{ value: "#979797" },{ value: "#E6332A" },{ value: "#FF3E3E" },{ value: "#78CA43" },{ value: "#12ABE7" },{ value: "#FD6F00" },{ value: "#A659E2" },{ value: "#E05189" }],
                showWhen: { variant: [8] }
            },
            {   type: "label", value: "Background:", margin: "5px 0" },
            { 
                type: lp.color, 
                name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }],
                showWhen: { variant: [1,2,4,8] }
            },
            { 
                name: "background", width: 'auto',
                type: teacss.ui.select.extendOptions({
                    inline: true,
                    panelClass: 'only-icons',
                    items: function () {
                        var items = [];
                        items.push({ value: "#313138" },{ value: "#24242A" });
                        for (var i=1;i<=3;i++) {
                            items.push({
                                value:"/templater_modules/lpcandy/assets/texture_black/"+i+".jpg",
                            });
                        }                        
                        return items;
                    },
                    itemTpl: function (item) {
                        return $("<div class='combo-item'>").append(
                            $("<div>").css({
                                width: 50,
                                height: 50,
                                backgroundSize: "cover",
                                backgroundPosition: "auto 100%",
                                backgroundImage:"url("+base_url+item.value+")",
                                background: item.value
                            })
                        );
                    }
                }), 
                showWhen: { variant: [3,5,6,7] }
            },
        ]
    }
});