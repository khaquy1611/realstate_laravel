(function($) {
	"use strict";
	var HT = {}; 
    var _token = $('meta[name="csrf-token"]').attr('content');

   HT.refreshCaptcha = () => {
        $('.refresh-captcha').click(function(e) {
            $.ajax({
                type: 'GET',
                url: 'refreshCaptcha',
                success: function(data) {
                   $('#captcha-img').html(data.captcha);
                }
            })
        })
   }
   
	$(document).ready(function(){
        HT.refreshCaptcha();
	});

    

})(jQuery);
