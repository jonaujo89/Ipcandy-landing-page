alertify.genericDialog || alertify.dialog('genericDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
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
        }
    };
});

$.fn.lpCounty = function () {
	$(this).each(function(){	
		var get_date = JSON.parse($(this).attr('data-datetime'));
		var set_date;
		var current_date = new Date();
		var current_year = current_date.getFullYear();
		var curren_month = current_date.getMonth() + 1;
		var current_day_of_week = current_date.getDay();
		var current_day = current_date.getDate();
		var tomorrow = current_date.getDate()+1;
        var add_days;
		
		switch (get_date.type) {
            case 'datetime':
                set_date = new Date(get_date.date + ' ' + get_date.time);
                $(this).empty().county({
                    endDateTime: set_date,
                });
                break;

            case 'monthly':                
                var countDayOfMonth;
                add_days = get_date.day - day;

                    if (curren_month == 2) { // если февраль то 29-30 не считать
                        if (current_year % 4 === 0) { // если високосный год, то в феврале 29 дней
                            if (get_date.day == 30 || get_date.day == 31) {
                                add_days = 29 - day;
                            }
                            countDayOfMonth = 29;
                        } else {
                            if (get_date.day == 29 || get_date.day == 30 || get_date.day == 31) {
                                add_days = 28 - day;
                            }
                            countDayOfMonth = 28;
                        }
                    } else {
                        if (curren_month == 4 || curren_month == 6 || curren_month == 9 || curren_month == 11) { // если в месяце 30 дней то 31 не считать
                            if (get_date.day == 31) {
                                add_days = 30 - day;
                            }
                            countDayOfMonth = 30;
                        } else {
                            countDayOfMonth = 31;
                        }
                    }

                    if (add_days < 0) {
                        add_days = countDayOfMonth + add_days;
                    } else if (add_days == 0) {
                        var timeX = new Date(current_year + '/' + curren_month + '/' + current_day + ' ' + get_date.time);
                        if (timeX < now) {
                            add_days = countDayOfMonth;
                        }
                    } 
                
                    if(current_day > get_date.day){
                        if(get_date.day == 1){
                            current_day = 1;
                        } else {
                            current_day = get_date.day;
                        }
                        set_date = new Date(current_year + '/' + (curren_month+1) + '/' + current_day + ' ' + get_date.time);
                    } else {
                        set_date = new Date(current_year + '/' + curren_month + '/' + (current_day + add_days) + ' ' + get_date.time);
                    }

                    if (isNaN(set_date)) set_date = 0;
                    $(this).empty().county({
                        endDateTime: set_date,
                    });
                   
                break;

            case 'weekly':
                add_days = get_date.dayOfWeek - current_day_of_week;
                if (add_days == 0) {
                    var timeX = new Date(current_year + '/' + curren_month + '/' + current_day + ' ' + get_date.time);
                    if (timeX < now) {
                        add_days = 7;
                    }
                } else if (add_days < 0) {
                    add_days = 7 + add_days;
                }
                set_date = new Date(current_year + '/' + curren_month + '/' + (current_day + add_days) + ' ' + get_date.time);
                $(this).empty().county({
                    endDateTime: set_date,
                });
                break;

            case 'daily':
                set_date = new Date(current_year + '/' + curren_month + '/' + current_day + ' ' + get_date.time);
                if (set_date < current_date) {
                    set_date = new Date(current_year + '/' + curren_month + '/' + tomorrow + ' ' + get_date.time);
                }
                $(this).empty().county({
                    endDateTime: set_date,
                });
                break;
        }
	});
};

$.fn.lpFancybox = function () {
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

$.fn.lpFancyboxWhithoutTitle = function () {
	$(this).fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
	}); 
};

$.fn.lpMasonry = function () {    
    var $el = $(this);
    function doit() {
        $el.masonry({
            itemSelector: ".masonry .item_block",
            gutter: 10,
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
		var bx_wrapper = $this.find("div.item_block.bx-clone").size();
        if ($this.find(".item_block:visible").not(".bx-clone").size() == 0) return;        
        if (bx_wrapper == 0) {  
            var bxSlider = $this.bxSlider({
                controls: true,
                slideWidth: 367,
                minSlides: 3,
                maxSlides: 3,
                slideMargin: 10,
                slideSelector: 'div.item_block:visible',
            });
            var count_photo_init = $this.find(".item_block:visible").not(".bx-clone").size();
            $this.data('counter', count_photo_init); 
            $this.data('slider', bxSlider);
        } else {  
            var count_photo_in_data_counter = $this.data('counter');
            var bxSlider = $this.data('slider');
            var count_photo = $this.find(".item_block:visible").not(".bx-clone").size();
            if(count_photo_in_data_counter != count_photo){
                bxSlider.reloadSlider(); 
                $this.data('counter', count_photo);
            }
        }
    });
};

function initOrderButton() {
    $(document).on("click", "a.btn_form", function(e){ 
        if($(this).attr("href").length == 0){
            e.preventDefault();
            
            var form = $(this).data("form");
            if (!form) $(this).data("form",form = $(this).parents('.btn_wrap').find('.form')[0]);
            alertify.genericDialog(form);
        }
    });
};

function initPolicyInfo() {
    $(document).on("click", "a.policy", function(e){ 
        e.preventDefault();
        var policy_info = $(this).data("policy_info");
        if (!policy_info) $(this).data("policy_info",policy_info = $(this).siblings(".policy_info").html());
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
                    $field.find(".error").text("Обязательное поле");
                    validated = false;
                }
            }
        });
        
        // проверяем общую валидацию 
        if (!validated) return false;
        
        var values = [];
        
        // собираем данные
        $form.find(".form_field").each(function(){
            $field = $(this);
            
            if($field.find("input").is(":checkbox")){               
                values.push({
                    label: $field.find("input:checkbox").val(),
                    value: $field.find("input:checkbox").is(":checked") ? "<span style='font-size: 150%;'>&#x2611</span> (да)" : "<span style='font-size: 150%;'>&#x2610</span> (нет)"
                });
                return;
            }

            values.push({
                label: $field.find(".field_title").clone().children().remove().end().text(),
                value: $field.find("input[type=text], input[type=file], input[type=radio]:checked, textarea, select").val()
            });

        });
        
        // отправляем данные
        $.ajax({
            url: base_url + "/track/" + page_id,
            type: "POST",
            data: {form:JSON.stringify(values)},
            success: function(data) {
                alertify.genericDialog($form.find(".form_done")[0]);
                $form.find(':input').not("input:checkbox, input:radio").val("");
                $form.find('input:checkbox, input:radio').prop('checked', false);
                $form.find(".form_field_radio_value:first-child input").prop("checked",true);
                $form.find(".form_field_select option:first-child").prop("selected",true);
            }
        });
        
        return false;
    });
};

$.fn.textBlockHeight = function () {
    $(this).each(function(){
        
        var $this = $(this);
        var overlay = $this.find('.overlay');
        
		$this.hover(
            function(){                
                overlay.innerHeight(overlay.find(".img_text").height() + overlay.innerHeight() + (overlay.outerHeight() - overlay.height() - (overlay.outerHeight() - overlay.innerHeight()))/2);
            },
            function(){
                overlay.css("height","");
            }
        );
    });
};


$(function() {    
    $(".gallery_2 .item_list .item_block .item").textBlockHeight();
    $(".countdown").lpCounty();	
	$(".fancybox").lpFancybox();
	$(".fancybox_whithout_title").lpFancyboxWhithoutTitle();
    $(".masonry:visible").lpMasonry();
    $(".slider [data-name=items]").lpBxSlider();
    $(".map").mapYandex();    
    initForms();
    initOrderButton();  
    initPolicyInfo();
});
