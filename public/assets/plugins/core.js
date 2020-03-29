alertify.genericDialog || alertify.dialog('genericDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
            var wide = $(content).hasClass("wide");
            $(this.elements.dialog).toggleClass("wide",wide);
            
            // fix scrolling dialog overflowing text for android < 4
            var av = navigator.userAgent.match(/Android\s+([\d\.]+)/);
            if (av) {
                av = av[1];
                if (av < "4") {
                    var scrollStartPos = 0;
                    $(this.elements.modal)
                    .on("touchstart",function(event){
                        scrollStartPos=this.scrollTop+event.originalEvent.touches[0].pageY;
                        event.preventDefault();
                    })
                    .on("touchmove",function(event){
                        this.scrollTop=scrollStartPos-event.originalEvent.touches[0].pageY;
                        event.preventDefault();
                    })
                }
            }
        },
        setup:function(){
            return {
                options:{
                    basic:true,
                    maximizable:false,
                    resizable:false,
                    padding:false
                }
            };
        },
         hooks:{
            onshow: function(){
                this.bodyScroll = $("body")[0].scrollTop;
                $(".ajs-global-close").remove();
                if ($(this.elements.dialog).hasClass("wide")) {
                    $(this.elements.root).find(".ajs-close").hide();
                    $(this.elements.root).append(
                        $("<button class='ajs-global-close'></button>").click(function(){
                            $(this).parent().find(".ajs-close").click();
                        })
                    );
                } else {
                    $(this.elements.root).find(".ajs-close").show();
                }
            },
            onclose: function(){
                if (this.bodyScroll) $("body")[0].scrollTop = this.bodyScroll;
                $(".ajs-global-close").remove();
            }
         }        
    };
});

$.fn.lpStickyMenu = function() {
    $(this).each(function() {
        var me = $(this);
        var component = me.parents('[id^=id]');
        component.addClass('sticky_menu_component');
        
        component.on('click', '.items li a', function(e) {
            e.preventDefault();
            var targetOffsetTop = $(document).find($(this).data('id')).offset().top;
            $(document).find('html').animate({ scrollTop: targetOffsetTop }, 500);
            component.removeClass('active');
        });

        component.on('click', '.toggler', function(e) {
            e.preventDefault();
            component.toggleClass('active');
        });

        Stickyfill.add(component);
    });
};

function initOrderButton() {
    $(document).on("click", "a.btn_form", function(e){ 
        if(!$(this).is("[href]")){
            e.preventDefault();
            
            var form = $(this).data("form");
            if (!form) {
                form = $(this).parents('.btn_wrap').find('.form')[0];
                if (!form && $(this).parents(".item_data").length) {
                    var btn = $(this).parents('.item_block').find(".item_action").eq($(this).parents(".item_data").index()).find(".btn_form");
                    if (btn.length) {
                        form = btn.parents('.btn_wrap').find('.form')[0];
                        btn.data("form",form);
                    }
                }
                $(this).data("form",form);
            }
            alertify.genericDialog(form);
        }
    });
};

function initPolicyInfo() {
    $(document).on("click", "a.policy", function(e){ 
        e.preventDefault();
        var policy_info = $(this).data("policy_info");
        if (!policy_info) $(this).data("policy_info",policy_info = $(this).siblings(".policy_info").show()[0]);
        alertify.genericDialog(policy_info);
    });
};

function initForms() {
    
    $(document).on("click",".form_field_submit",function(e){
        e.preventDefault();
        $(this).parents("form").submit();
    });
    
    $(document).on('submit','form',function(event){ 
        
        event.preventDefault();     
    
        var data = {}; 
        var $form = $(this);
        var validated = true;
        
        $form.find(".error_input").removeClass("error_input");
        $form.find(".error").text("");

        // перебираем поля формы
        $form.find(".form_field").each(function(){
            var $field = $(this);
            var required = $field.find(".field_title i").length;
            // если поле обязательное и нет значения, то показать ошибку и валидация не прошла
            if (required) {
                if (!$field.find("input[type=text], input[type=file], textarea").val()) {
                    // показать ошибку
                    $field.find("input, textarea").addClass("error_input");
                    var error_text = window.locale_lang=="ru" ? "Обязательное поле" : "Required field";
                    $field.find(".error").text(error_text);
                    validated = false;
                }
            }
        });
        
        // проверяем общую валидацию 
        if (!validated) return false;
        
        var values = [];
        var data = new FormData();
        var file_counter = 0;
        
        // собираем данные
        $form.find(".form_field").each(function(){
            $field = $(this);
            var label = $field.find(".field_title").clone().children().remove().end().text().trim();
            
            if($field.find("input").is(":checkbox")){               
                values.push({
                    label: label,
                    value: $field.find("input:checkbox").is(":checked") ? true:false
                });
            } else if($field.find("input").is(":file")) {
                
                var files = $field.find("input")[0].files;
                var value = [];
                
                $.each(files, function(i, file) {
                    var name = 'file-'+file_counter++;
                    data.append(name, file);
                    value.push(name);
                });
                values.push({label:label,value:value});
            } else {
                values.push({
                    label: label,
                    value: $field.find("input[type=text], input[type=file], input[type=radio]:checked, textarea, select").val()
                });
            }
        });
        
        var form_done = $(this).data("form_done");
        if (!form_done) $(this).data("form_done",form_done = $form.find(".form_done")[0]);
        
        data.append('form',JSON.stringify(values));
        
        // отправляем данные
        $.ajax({
            url: base_url+"/track/"+page_id,
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                alertify.genericDialog(form_done);
                $form.find(':input').not("input:checkbox, input:radio").val("");
                $form.find('input:checkbox, input:radio').prop('checked', false);
                $form.find(".form_field_radio_value:first-child input").prop("checked",true);
                $form.find(".form_field_select option:first-child").prop("selected",true);                

                $(document).trigger("track_sent");
                
            }
        });
    });
};

function initFAQ() {
    $(document).on('click', '.faq-item',function(){
        $(this).toggleClass('active').find('.answer').slideToggle('fast');
    });
}

$.fn.textBlockHeight = function () {
    $(this).each(function(){
        
        var $this = $(this);
        var overlay = $this.find('.overlay');
        var inner = $this.find('.in');
		$this.hover(
            function(){ 
                overlay.height(inner.outerHeight());
            },
            function(){
                overlay.css("height","");
            }
        );
    });
};

$(function() {
    
    $(document).on("track_sent",function(){
        if(typeof extraHtmlSubmit == 'function'){
            extraHtmlSubmit();
        } else {
            if (window.parent && typeof parent.extraHtmlSubmit == 'function') window.parent.extraHtmlSubmit();
        }        
    });
    
    $(".gallery_2 .item_list .item_block .item").textBlockHeight();
    $(".countdown").lpCounty();	
	$(".fancybox:visible").lpFancybox();
    $(".masonry:visible").lpMasonry();
    $(".slider > div").lpBxSlider();
    $(".map").mapYandex(); 
    $(".sticky_menu").lpStickyMenu();  
    
    initForms();
    initOrderButton();  
    initPolicyInfo();
    initFAQ();
});
