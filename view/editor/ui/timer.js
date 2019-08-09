lp.timer = lp.block.extendOptions({
    init: function () {
        var countdown = this.element.find(".countdown");
        var jq = Component.previewFrame.window.$;
        if (jq) {
            jq(countdown).lpCounty();      
        }
    },	
	change: function(){         
        var jq = Component.previewFrame.window.$;        
        this.variant.find(".title_2").toggleVis(this.value.show_title_2);
		
		if (this.value.variant == 1) { 
            this.variant.find(".timer_1").css({
                background: this.value.background_color || '',
            });
			this.variant.find(".timer_1 .countdown_wrap").css({
                color: this.value.countdown_color,
            });
        }
        if (this.value.variant == 2){
            if(this.value.show_title_2)
                this.variant.find(".title_2").prop("class", jq(".title_2").attr('class') + "timer_"+ this.value.title_2_and_countdown_color);
            this.variant.find(".countdown_wrap").prop("class","countdown_wrap col-8 after-2 before-2 timer_"+this.value.title_2_and_countdown_color);
        }
        if (this.value.variant == 2 || this.value.variant == 4) {
            if (this.value.background.color)
                this.variant.find(".timer").css({
                    background: this.value.background.color,
                });
            else
                this.variant.find(".timer").css({
                    background: "url("+base_url+"/"+this.value.background.url+")",
                });            
        }
		if (this.value.variant == 3) { 
            this.variant.find(".timer").css({
                background: this.value.background_color || '',
            });
			this.variant.find(".form_bottom").toggleVis(this.value.show_form_bottom_text);
        }
        if (this.value.variant == 4) { 
			this.variant.find(".form_bottom").toggleVis(this.value.show_form_bottom_text);
        }
       
    },
    configForm: {
        items: [   
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px", 
            },
			{ 
                name: "show_form_bottom_text", label: _t("Show text under the form"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px", 
                showWhen: { variant: [3,4] }
            },
            {   type: "label", value: _t("Countdown color:"), margin: "5px 0 0", showWhen: { variant: [1] } },
            { 
                type: lp.color,  name: "countdown_color", items: [{ value: "#E76953" },{ value: "#3F3F3F" }],
                showWhen: { variant: [1] }
            },
            {   type: "label", value: _t("Second title color:"), margin: "5px 0 0", showWhen: { variant: [2] } },
			{ 
                type: lp.color, name: "title_2_and_countdown_color", width: "auto", iconSize: 20, margin: "0 0 8px",
                items: [
                    { value: 'red', color: '#FF3E3E' },
                    { value: 'grey', color: '#C2C2C2' },
                    { value: 'green', color: '#74D336' },
                    { value: 'blue', color: '#12ABE7' },
                    { value: 'orange', color: '#FD6F00' },
                    { value: 'purple', color: '#C274FF' },
                    { value: 'rose', color: '#E05189' },
                    { value: 'yellow', color: '#FFC415' }
                ],
				showWhen: { variant: [2] }
            },
            {   type: "label", value: _t("Background:"), margin: "5px 0" },
            { 
                type: lp.blockColor,
                name: "background_color",  
                showWhen: { variant: [1,3] }
            },  
            { 
                name: "background", width: 'auto',
                type: lp.background, 
                showWhen: { variant: [2,4] }
            },
        ]
    }
});