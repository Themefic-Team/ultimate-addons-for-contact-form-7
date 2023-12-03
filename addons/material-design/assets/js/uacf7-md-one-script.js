jQuery(document).ready(function($){
	$(".TFText, .TFDate").focus(function() {
			$(this).parent().siblings('label').addClass('has-value');
	})
	.blur(function() {
		var text_val = $(this).val();
		if(text_val === "") {
			$(this).parent().siblings('label').removeClass('has-value');
		}
	});



});











