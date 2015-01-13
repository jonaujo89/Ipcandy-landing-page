$(function(){
    
    $('table#tblist_1').on('change','select', function(eventData){
        var $this = $(this);
        $.ajax({
            url: base_url + "track-update-status/" + $this.parent().siblings('td.id').text().trim(),
            type: "POST",
            dataType: "json",
            data:{
                value: $this.val()
            },
            success: function(data){
                if(data == 'update_status_ok'){
                    $this.addClass('update_status_ok');
                    setTimeout(function() { $this.removeAttr('class'); }, 700);                    
                }
            },
            error: function(){
                $this.addClass('update_status_error');
                //setTimeout(function() { $this.removeAttr('class'); }, 1000);                    
            },            
        });        
    }); 
    
    $('table#tblist_1').on('click','.page_title', function(event){
        event.preventDefault();
        var $this = $(this);
        console.log(base_url+'page-design/' + $this.siblings('td.id').text().trim());
        //location.href = base_url+'page-design/' + $this.siblings('td.id').text().trim();
    });
    
});