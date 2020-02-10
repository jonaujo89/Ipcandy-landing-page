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

$.fn.lpCounty = function (datetime) {
	$(this).each(function(){	
		var get_date = datetime || JSON.parse($(this).attr('data-datetime'));
		var set_date;
		var current_date = new Date();
		var current_year = current_date.getFullYear();
		var current_month = current_date.getMonth();
		var current_day_of_week = current_date.getDay();
		var current_day = current_date.getDate();
		var tomorrow = current_date.getDate()+1;
        var add_days;
        
        var time = get_date.time.split(':');
        var hours = time[0];
        var minutes = time[1];
		
		switch (get_date.type) {
            case 'datetime':
                set_date = new Date(get_date.date + ' ' + get_date.time);
                if (isNaN(set_date)) set_date = 0;
                
                break;

            case 'monthly':                
                var lengthMonth;
                var real_current_month = current_month+1;
                add_days = get_date.day - current_day;
                    
                if (real_current_month == 2) { // если февраль то 29-30 не считать
                    if (current_year % 4 === 0) { // если високосный год, то в феврале 29 дней
                        if (get_date.day == 30 || get_date.day == 31) {
                            add_days = 29 - current_day;
                        }
                        lengthMonth = 29;
                    } else {
                        if (get_date.day == 29 || get_date.day == 30 || get_date.day == 31) {
                            add_days = 28 - current_day;
                        }
                        lengthMonth = 28;
                    }
                } else {
                    if (real_current_month == 4 || real_current_month == 6 || real_current_month == 9 || real_current_month == 11) { // если в месяце 30 дней то 31 не считать
                        if (get_date.day == 31) {
                            add_days = 30 - current_day;
                        }
                        lengthMonth = 30;
                    } else {
                        lengthMonth = 31;
                    }
                }

                if (add_days < 0) {
                    add_days = lengthMonth + add_days;
                } else if (add_days == 0) {
                    var timeX = new Date(current_year, current_month, current_day, hours, minutes);
                    if (timeX < current_date) {
                        add_days = lengthMonth;
                    }
                } 

                if(current_day > get_date.day){
                    if(get_date.day == 1){
                        current_day = 1;
                    } else {
                        current_day = get_date.day;
                    }
                    set_date = new Date(current_year, current_month+1, current_day, hours, minutes);
                } else {
                    set_date = new Date(current_year, current_month, current_day + add_days, hours, minutes);
                }

                if (isNaN(set_date)) set_date = 0;                    
                   
                break;

            case 'weekly':
                add_days = get_date.dayOfWeek - current_day_of_week;                
                if (add_days == 0) {
                    var timeX = new Date(current_year, current_month, current_day, hours, minutes);
                    if (timeX < current_date) {
                        add_days = 7;
                    }
                } 
                if (add_days < 0) {
                    add_days = 7 + add_days;
                }
                
                set_date = new Date(current_year, current_month, current_day + add_days, hours, minutes); 
                if (isNaN(set_date)) set_date = 0;

                break;

            case 'daily':
                set_date = new Date(current_year, current_month, current_day, hours, minutes);                
                if (set_date < current_date) {
                    set_date = new Date(current_year, current_month, tomorrow, hours, minutes); 
                }
                if (isNaN(set_date)) set_date = 0;

                break;
        }
        
        $(this).empty().county({
            endDateTime: set_date,
            labels: (window.locale_lang=="ru") ? { d: "дни", h: "часы", m: "минуты", s: "секунды" } : undefined
        });
	});
};

$.fn.lpFancybox = function () {
    $(this).each(function(){
        var $gallery = $(this).parents(".gallery").eq(0);
        var rel = $gallery.attr("rel");        
        if (!rel) {
            var block_id = $(this).parents("body > *").eq(0).attr("id");
            var gallery_id = $gallery.attr("class").match(/gallery_(\d+)/)[1];
            rel = 'rel_'+gallery_id+'_'+block_id;
            $gallery.attr("rel",rel);
        }
        $(this).attr("rel",rel);
    });
    
	$(this).fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic',

		helpers : {
			title : {
				type : 'inside'
			}
		}
	}); 
};

$.fn.lpMasonry = function () {
    var $el = $(this);
    function doit() {
        const gutter = $el.data('masonry-gutter');
        $el.masonry({
            itemSelector: ".masonry .item_block",
            gutter: gutter || 10,
            singleMode: true,
            columnWidth: ".masonry .item_block"
        });        
        $el.masonry('reloadItems');
    }
    $el.find("img").unbind("load").bind("load", doit);
    doit();
};

$.fn.lpBxSlider = function () {
    $(this).each(function(){
        var $this = $(this);
        var options = {
            controls: true,
            slideMargin: 10,
            slideSelector: 'div.item_block:visible',
            slideWidth: 367
        };

        var breakWidth = 1200;

        function widthChanged(reload) {
            var prevMinSlides = $this.data('minSlides');
            var width = $(window).width();

            if (width < breakWidth) {
                options.minSlides = 1;
                options.maxSlides = 1;
                options.adaptiveHeight = true;
            } else {
                options.minSlides = 3;
                options.maxSlides = 3;
                options.adaptiveHeight = false;
            }

            if (prevMinSlides!=options.minSlides) {
                $this.data('minSlides',options.minSlides);
                if (reload) {
                    $this.data('slider').reloadSlider(options);
                }
            }
        }
        widthChanged();
        
		var bx_wrapper = $this.find("div.item_block.bx-clone").size();
        if ($this.find(".item_block:visible").not(".bx-clone").size() == 0) return;
        if (bx_wrapper == 0) {  
            var bxSlider = $this.bxSlider(options);
            var count_photo_init = $this.find(".item_block:visible").not(".bx-clone").size();
            $this.data('counter', count_photo_init); 
            $this.data('slider', bxSlider);

            $(window).resize(function(){ widthChanged(true); });
        } else {  
            var count_photo_in_data_counter = $this.data('counter');
            var bxSlider = $this.data('slider');
            var count_photo = $this.find(".item_block:visible").not(".bx-clone").size();
            if(count_photo_in_data_counter != count_photo || true){
                bxSlider.reloadSlider(options); 
                $this.data('counter', count_photo);
            }
        }
    });
};

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