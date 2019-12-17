lp.faqRepeater = lp.repeater.extendOptions({
    inline: true,
});

lp.faq = lp.block.extendOptions({
    init: function() {
        this.element.find('.faq-items').on('click', '[data-editor="lp.text"]', function(e){
            e.stopPropagation();
        });
    },
    change: function() {
        this.variant.find(".title").toggleVis(this.value.show_title);
        this.variant.find(".title_2").toggleVis(this.value.show_title_2); 
        this.variant.find(".icon").toggleVis(this.value.show_icon);
        this.variant.find(".faq-items").toggleClass("two-column-layout",this.value.two_column_layout);

        if (this.value.background_color){
            this.variant.find(".faq").css({
                background: this.value.background_color || '',
            });
        }            
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
            { 
                name: "show_icon", label: _t("Show icon"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
            { 
                name: "two_column_layout", label: _t("Two column layout"), type: "checkbox", width: "auto",  
                margin: "5px 49% 0px 0px"
            },
            { 
                type: lp.blockColor, name: "background_color", margin: "10px 0 0 0"
            }
        ]
    }
});