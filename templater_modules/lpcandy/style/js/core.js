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
    /*function doit() {
        $el.masonry({
            itemSelector: ".masonry .item_block",
            gutter: 10,
            singleMode: true,
            columnWidth: ".masonry .item_block"
        });
        $el.masonry('reloadItems');
        $el.masonry('layout'); 
    };*/
    $el.imagesLoaded( function() {
        console.log("ready");
        $el.masonry({
            itemSelector: ".masonry .item_block",
            gutter: 10,
            singleMode: true,
            columnWidth: ".masonry .item_block"
        });
    });
    /*
    $el.find("img").unbind("load").bind("load",doit);
    doit();
    */
};

$.fn.lpBxSlider = function () {
    var $this = $(this);
    $this.each(function(){
        var counter = $this.data('counter');
        if (counter == undefined) {            
            bx_slider = $this.bxSlider({
                controls: true,
                slideWidth: 367,
                minSlides: 3,
                maxSlides: 3,
                slideMargin: 10,
                slideSelector: 'div.item_block:visible',
            });
            var count_photo_init = $(".slider .item_block:visible").not(".bx-clone").size();
            console.log(count_photo_init);
            $this.data('counter', count_photo_init);        
        } else {  
            var count_photo_in_data_counter = $this.data('counter');
            var count_photo = $this.filter(".item_block:visible").not(".bx-clone").size();
            if(count_photo_in_data_counter != count_photo){
                bx_slider.reloadSlider(); 
                $this.data('counter', count_photo);
            }
        }
    });
};

$(function() { 
    $(".gallery_2 .item_list .item_block .item").hover(
        function() {
            $( this ).addClass('hover');
        },
        function() {
            $( this ).removeClass('hover');
        }        
    );
    $(".countdown").lpCounty();	
	$(".fancybox").lpFancybox();
	$(".fancybox_whithout_title").lpFancyboxWhithoutTitle();
	$(".masonry img").lpMasonry();
    $(".slider [data-name=items]").lpBxSlider();
    $(".map").mapYandex();
});
