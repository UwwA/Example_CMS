 $(document).ready(function(){
   $( '.notif' ).hide();
	jQuery.fn.extend({
    setError: function (text) {
		$(".notif").slideDown(500);
        $(".notifText").html(text);
		return console.log("Changed to " + text);
			}
    });

	$(".notif").click(function(){
		$(".notif").slideUp(500);
	});
	
	
	  $('.validateForm').validate({ // initialize the plugin
		rules: {
            field1: {
                required: true,
                email: true
            },
         
        }
    });
 });
