lp.timer = lp.block.extendOptions({
    init: function () {
		var countdown = this.element.find(".countdown");
    },	
	change: function(){         
        this.variant.find(".title_2").toggle(this.value.show_title_2);
		
		if (this.value.variant == 1) { 
            this.cmp.element.find(".timer_1").css({
                background: this.value.background_color || '',
            });
			this.cmp.element.find(".timer_1 .countdown_wrap").css({
                color: this.value.countdown_color,
            });
        }        
        if (this.value.variant == 2) { 
            var pattern_background = /#\w{3,6}/;
            if (pattern_background.test(this.value.background)) {
                this.variant.find(".timer_2").css({
                    background: this.value.background,
                });
            } else {
                this.variant.find(".timer_2").css({
                    background: "url("+base_url+(this.value.background)+")",
                });
            }
            
            this.variant.find(".timer_2 .title_2").prop("class","title_2 "+this.value.title_2_color);
            this.variant.find(".timer_2 .countdown_wrap").prop("class","countdown_wrap "+this.value.title_2_color);
        }
		if (this.value.variant == 3) { 
            this.cmp.element.find(".timer_3").css({
                background: this.value.background_color || '',
            });
			this.variant.find(".form_bottom").toggle(this.value.show_form_bottom_text);
        }
		if (this.value.variant == 4) { 
            var pattern_background = /#\w{3,6}/;
            if (pattern_background.test(this.value.background)) {
                this.variant.find(".timer_4").css({
                    background: this.value.background,
                });
            } else {
                this.variant.find(".timer_4").css({
                    background: "url("+base_url+(this.value.background)+")",
                });
            }
			this.variant.find(".form_bottom").toggle(this.value.show_form_bottom_text);
        }
       
    },
    configForm: {
        items: [   
            { 
                name: "show_title_2", 
                label: "Show second title", 
                type: "check", 
                width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", 
            },
			{ 
                name: "show_form_bottom_text", label: "Show text under the form", type: "check", width: "auto", height: 27, 
                margin: "5px 49% 5px 0px", showWhen: { variant: [4] }
            },
            {   type: "label", value: "Countdown color:", margin: "5px 0 0", showWhen: { variant: [1] } },
            { 
                type: lp.color, 
                name: "countdown_color",  
                items: [{ value: "#E76953" },{ value: "#3F3F3F" }],
                showWhen: { variant: [1] }
            },
            {   type: "label", value: "Second title color:", margin: "5px 0 0", showWhen: { variant: [2] } },
			{ 
                type: lp.color, name: "title_2_color", width: "auto", iconSize: 20, margin: "0 0 8px",
                items: [
                    { value: 'timer_red', color: '#FF3E3E' },
                    { value: 'timer_grey', color: '#C2C2C2' },
                    { value: 'timer_green', color: '#74D336' },
                    { value: 'timer_blue', color: '#12ABE7' },
                    { value: 'timer_orange', color: '#FD6F00' },
                    { value: 'timer_purple', color: '#C274FF' },
                    { value: 'timer_rose', color: '#E05189' },
                    { value: 'timer_yellow', color: '#FFC415' }
                ],
				showWhen: { variant: [2] }
            },
            {   type: "label", value: "Background:", margin: "5px 0" },
            { 
                type: lp.color, 
                name: "background_color",  
                items: [{ value: "#FFFFFF" },{ value: "#F7F7F7" }],
                showWhen: { variant: [1,3] }
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
                showWhen: { variant: [2,4] }
            },
        ]
    }
});