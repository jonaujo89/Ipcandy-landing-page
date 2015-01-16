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

    $(document).on("click","a[href$='login']",function(e){ 
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: base_url + "login",
            type: "POST",
            success: function(content){
                //alertify.genericDialog(content);
                
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
                alertify.genericDialog (content);
                //console.log(data);
            }
        });        
    });
    
});