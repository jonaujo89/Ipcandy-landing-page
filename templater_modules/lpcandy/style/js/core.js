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

$(function() {
    var datatime = $('.countdown').attr('data-time');
    $('.countdown').countdown(datatime).on('update.countdown', function(event) {
        var $this = $(this).html(event.strftime(''
        + '<div class="d"><div>%-D</div><span>дней</span></div>'
        + '<div class="h"><div>%H</div><span>часов</span></div> '
        + '<div class="m"><div>%M</div><span>минут</span></div>'
        + '<div class="s"><div>%S</div><span>секунд</span></div>'));
    });
});