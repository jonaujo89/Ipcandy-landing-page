lp.numbers = lp.block.extendOptions({
    change: function(){  
		
        this.variant.find(".title").toggleVis(this.value.show_title);
		this.variant.find(".title_2").toggleVis(this.value.show_title_2);
        
        if (this.value.variant == 1 || this.value.variant == 2 || this.value.variant == 4 || this.value.variant == 8) { 
            this.variant.find(".numbers").css({
                background: this.value.background_color || '',
            });
        }
        if (this.value.variant == 3 || this.value.variant == 5 || this.value.variant == 6 || this.value.variant == 7) {             
            if (this.value.background.color)
                this.variant.find(".numbers").css({
                    background: this.value.background.color,
                });
            else
                this.variant.find(".numbers").css({                    
                    background: "url("+base_url+"/"+this.value.background.url+")",
                });
        }
        if (this.value.variant == 4 || this.value.variant == 7) { 
            this.variant.find(".item_list").prop("class","item_list icon_"+this.value.icon_color);
        }
        if (this.value.variant == 8) {
            this.variant.find(".value").css({color: this.value.numbers_color});
        }
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px" 
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto", margin: "5px 49% 0px 0px"
            },
            {   type: "label", value: _t("Icons color:"), margin: "5px 0 0", showWhen: { variant: [4,7] } },
            { 
                name: "icon_color",
                items: [{ label: _t("black"), value:"black"},{ label: _t("grey"), value:"grey"}],
                type: "radio", width: "auto", 
                margin: "0px 49% 5px 0px", showWhen: { variant: [4] }
            },
            { 
                name: "icon_color",
                items: [{ label: _t("white"), value:"white"},{ label: _t("grey"), value:"grey"}],
                type: "radio", width: "auto",
                margin: "0px 49% 5px 0px", showWhen: { variant: [7] }
            },
            {   type: "label", value: _t("numbers color:"), margin: "5px 0 0", showWhen: { variant: [8] } },
            { 
                type: lp.color, 
                name: "numbers_color",  
                items: [
                    { value: "#000" },
                    { value: "#979797" },
                    { value: "#E6332A" },
                    { value: "#FF3E3E" },
                    { value: "#78CA43" },
                    { value: "#12ABE7" },
                    { value: "#FD6F00" },
                    { value: "#A659E2" },
                    { value: "#E05189" }
                ],
                showWhen: { variant: [8] }
            },
            {   type: "label", value: _t("Background:"), margin: "5px 0" },
            { 
                type: lp.blockColor,
                name: "background_color",  
                showWhen: { variant: [1,2,4,8] }
            },
            { 
                name: "background", width: 'auto',
                type: lp.background, 
                showWhen: { variant: [3,5,6,7] }
            },
        ]
    }
});