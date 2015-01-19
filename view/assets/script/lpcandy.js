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
  
});