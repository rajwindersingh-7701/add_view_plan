(function ($) {
    "use strict";

    
    /*----------------------------
        landing countdown active
    ------------------------------ */
    /* ---  set landing countdown --- */
    var target_date = new Date("Aug 15, 2018").getTime();
    var days_l, hours_l, minutes_l, seconds_l;
    var countdown = document.getElementById("landing_countdown");
    setInterval(function () {
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;
        days_l = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;
        hours_l = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;
        minutes_l = parseInt(seconds_left / 60);
        seconds_l = parseInt(seconds_left % 60);
        document.getElementById('days_l').innerText = days_l;
        document.getElementById('hours_l').innerText = hours_l;
        document.getElementById('minutes_l').innerText = minutes_l;
        document.getElementById('seconds_l').innerText = seconds_l;
    }, 1000);
	
})(jQuery);