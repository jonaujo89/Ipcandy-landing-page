window.$ = window.$ || (teacss||{}).jQuery;
$(function(){
    
    $('td.status select').change(function(){
        var $this = $(this);
        $.ajax({
            url: base_url + "track-update-status/" +  $this.attr("data-id"),
            type: "POST",
            data:{ 
                status: $this.val(),
                id: $this.attr("data-id")
            },
            success: function(data){
                if(data != 'ok') alert(data);
            }
        });        
    });  
    
    $(document).on("login",function(e,user){
        $("#logged_info").removeClass("no-user").addClass("user");
        $(".username").text(user.name);
        $("#login_overlay").click();
    });
    
    $(".login").click(function(e){
        e.preventDefault();
        $("body").append(
            $("<div id='login_overlay'>").click(function(){
                $("#login_overlay").remove();
                $("#login_popup").remove();
            }),
            $("<div id='login_popup'>").append(
                $("<iframe>",{
                    src: "http://loginza.ru/api/widget?overlay=loginza&ajax=true&lang=ru&token_url="+encodeURIComponent(this.href),
                    scrolling: 'no',
                    frameborder: 'no'
                })
            )
        );
    });
});