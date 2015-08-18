lp.projects = lp.block.extendOptions({
    change: function(){
        this.variant.find(".cases").css({
            background: this.value.background_color || '',
        }); 
        this.variant.find(".title").toggleVis(this.value.show_title);
        this.variant.find(".title_2").toggleVis(this.value.show_title_2);
        this.variant.find(".btn_form").text(this.value.button_text);
        this.variant.find(".btn_form").attr("class","btn_form " + this.value.button_color);
    },
    configForm: {
        items: [   
            { 
                name: "show_title", label: _t("Show first title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
            { 
                name: "show_title_2", label: _t("Show second title"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
            { type: "label", value: _t("Background color:"), margin: "5px 0"},
            { 
                type: lp.blockColor, name: "background_color",  
            },
            { type: "label", value: _t("Projects IDs:"), margin: "5px 0"},
            {
                name: 'ids', type: ui.text.extend({
                    init: function (o) {
                        this._super(o);
                        this.input.unbind("keyup");
                        this.bind("change",function(){
                            var block = lp.projects.current;
                            setTimeout(function(){
                                block.reloadHtml();
                           },1);
                        });
                    }
                })
            },
            { type: "label", value: _t("Button text:"), margin: "5px 0"},
            { name: 'button_text', type: 'text' },
            { type: lp.color, name: "button_color", width: "47%", iconSize: 15,
                items: [
                    { value: 'blue', color: '#0187BC' },
                    { value: 'green', color: '#3E9802' },
                    { value: 'orange', color: '#FD6F00' },
                    { value: 'purple', color: '#8C33D2' },
                    { value: 'purple_light', color: '#9581BF' },
                    { value: 'rose', color: '#F372A4' },
                    { value: 'red', color: '#CE0707' },
                    { value: 'yellow', color: '#FFC415' }
                ]
            }
        ]
    }
});