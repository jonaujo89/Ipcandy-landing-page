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

		var datatimeString = $(this).attr('data-datetime');
		var dateTime = JSON.parse(datatimeString);
		var date_end;
		var now = new Date();
		var year = now.getFullYear();
		var month = now.getMonth() + 1;
		var dayOfWeek = now.getDay();
		var day = now.getDate();
		var tomorrow = now.getDate()+1;
		
		switch(dateTime.type) {
		  case 'datetime':
			date_end = new Date(dateTime.date+' '+dateTime.time);
			$(this).empty().county({
				endDateTime: date_end,
			});
			break;

		  case 'monthly':
			var dayPlus;
			var countMonth;
			dayPlus = dateTime.day - day;
				
			if(month == 2){ // если февраль то 29-30 не считать
				if (year % 4 === 0){ // если високосный год
					if(dateTime.day == 30 || dateTime.day == 31){	
						dayPlus = 29 - day;
					}
					countMonth = 29;
				} else {
					if(dateTime.day == 29 || dateTime.day == 30 || dateTime.day == 31){	
						dayPlus = 28 - day;
					}
					countMonth = 28;
				}	
			} else {
				if (month == 4 || month == 6 || month == 9 || month == 11) { // если в месяце 30 дней то 31 не считать
					if(dateTime.day == 31){	
						dayPlus = 30 - day;
					}
					countMonth = 30;					
				}else{
					countMonth = 31;
				}
			}
				
			if (dayPlus < 0 ) {
				dayPlus = countMonth + dayPlus;
			} else if(dayPlus == 0){
				var timeX = new Date(year+'/'+month+'/'+day+' '+dateTime.time);
				if (timeX < now){
					dayPlus = countMonth;
				}		
			}
				
			date_end = new Date(year+'/'+month+'/'+(day+dayPlus)+' '+dateTime.time);
            if(isNaN(date_end)) date_end = 0;
			$(this).empty().county({
				endDateTime: date_end,
			});
			break;
			
		  case 'weekly':			
			var dayPlus = dateTime.dayOfWeek - dayOfWeek;
			if(dayPlus == 0) {
				var timeX = new Date(year+'/'+month+'/'+day+' '+dateTime.time);
				if (timeX < now){
					dayPlus = 7;
				}				
			} else if(dayPlus < 0){
				dayPlus = 7 + dayPlus;
			}
			date_end = new Date(year+'/'+month+'/'+(day+dayPlus)+' '+dateTime.time);
			$(this).empty().county({
				endDateTime: date_end,
			});
			break;
			
          case 'daily':			
			date_end = new Date(year+'/'+month+'/'+day+' '+dateTime.time);
			if(date_end < now){
				date_end = new Date(year+'/'+month+'/'+tomorrow+' '+dateTime.time);
			}					
			$(this).empty().county({
				endDateTime: date_end,
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

$.fn.formValidateSubmit = function () {   
    var form = $(this);

    form.find(':input').on('focus', function(){        
        $(this).removeClass("error_input");
        $(this).next(".error").text("");
    });
    
    form.find('.form_field_checkbox_values').on('focus', function(){        
        $(this).removeClass("error_input");
        $(this).next(".error").text("");
    });
    
    form.each(function(){
        
        var input = form.find(':input');
        input.each(function(){            
            var required_input = $(this).prevAll(".field_title").find("i").text();//Обязательное поле или нет
            //var form_field = document.getElementsByClassName("form_field");
            //var required = $(this).closest(".field_title", form_field);
            //console.log(required_input);
            if(required_input == '*'){
                if (!$(this).val()){
                    $(this).addClass("error_input"); 
                    $(this).next(".error").text("Обязательное поле!");
                } else {
                    $(this).removeClass("error_input");
                    $(this).next(".error").text("");                    
                }
            }
        });
        
        var checkbox_group_all = form.find('.form_field_checkbox_values');
        checkbox_group_all.each(function(index_check_group, checkbox_group){
            var $checkbox_group = $(checkbox_group);
            var required_checkbox = $checkbox_group.prevAll(".field_title").find("i").text();//Обязательная группа checkbox или нет
            if(required_checkbox == '*'){
                var checkbox_checked = $checkbox_group.find(':checkbox').is(':checked');            
                if(checkbox_checked){
                    $(this).removeClass("error_input"); 
                    $(this).next(".error").text("");
                } else {
                    $(this).addClass("error_input"); 
                    $(this).next(".error").text("Обязательное поле!");
                }
            }
            
        });
        
        var radio_group_all = form.find('.form_field_radio_values');
        radio_group_all.each(function(index_radio_group, radio_group){
            var $radio_group = $(radio_group);
            var required_radio = $radio_group.prevAll(".field_title").find("i").text();//Обязательная группа checkbox или нет
            if(required_radio == '*'){
                var radio_checked = $radio_group.find(':radio').is(':checked');            
                if(radio_checked){
                    $(this).removeClass("error_input"); 
                    $(this).next(".error").text("");
                } else {
                    $(this).addClass("error_input"); 
                    $(this).next(".error").text("Обязательное поле!");
                }
            }
            
        });
        
        var select_group_all = form.find('.form_field_select_wrap');
        select_group_all.each(function(index_select_group, select_group){
            var required_select = $(select_group).prevAll(".field_title").find("i").text();//Обязательная группа checkbox или нет
            if(required_select == '*'){
                var selected = $(select_group).find('option').filter(':selected');  
                console.log();
                if(selected.val() != ""){
                    $(this).removeClass("error_input"); 
                    $(this).next(".error").text("");
                } else {
                    $(this).addClass("error_input"); 
                    $(this).next(".error").text("Обязательное поле!");
                }
            }
            
        });

        /*
        $.ajax({
            url: 'base_url+"/track/"+page_id',
            data: dataForm,
            success: function(){
                alert('Load was performed.');
            }
        });
        */

    });   
};

$.fn.textBlockHeight = function () {
    $(this).each(function(){
        
        var $this = $(this);
        var overlay = $this.find('.overlay');
        var paddingBottomPx = overlay.css("paddingBottom");
        var paddingBottom = parseInt(paddingBottomPx.slice(0,-2), 10);
        
		$this.hover(
            function(){
                overlay.height(overlay.find(".img_text").height() + overlay.height() + paddingBottom);
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
    
    $('form:visible .form_field_submit').on('click', function(event){        
        $('form:visible').formValidateSubmit();
        event.preventDefault();     
    });    
});
