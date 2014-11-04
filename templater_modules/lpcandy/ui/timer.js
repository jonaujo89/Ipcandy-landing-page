$(document).ready(function(){ 
    
    WebFontConfig = {
        google: { families: [ 'Tulpen+One::latin' ] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();  
    
    // update the tag with id "countdown" every 1 second
    setInterval(function () { 
        // set the date we're counting down to
        var target_date = new Date('12/01/2014').getTime();

        // variables for time units
        var days, hours, minutes, seconds;
        // get tag element
        var countDays = document.getElementById('countDay');
        var countHours = document.getElementById('countHour');
        var countMinutes = document.getElementById('countMinute');
        var countSeconds = document.getElementById('countSecond');
        // find the amount of "seconds" between now and target
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;

        // do some time calculations
        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;

        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);

        // format countdown string + set tag value
        countDays.innerHTML = days;
        countHours.innerHTML = hours;
        countMinutes.innerHTML = minutes;
        countSeconds.innerHTML = seconds;

    }, 1000);
  
});




