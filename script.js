 $(document).ready(function(){
   $( '.notif' ).hide();
	jQuery.fn.extend({
    setError: function (text) {
		$(".notif.error").slideDown(500);
        $(".notif.error").children(".notifText").html(text);
	}
    });
	jQuery.fn.extend({
		setSuccess: function (text) {
		$(".notif.success").slideDown(500);
        $(".notif.success").children(".notifText").html(text);
		}
    });
	
	$(".notif").click(function(){
		$(".notif").slideUp(500);
	});
	
	

 });
