
(function($){

$(document).ready(function($){
	$(".TFText").focus(function() {
			$(this).parent().siblings('label').addClass('has-value');
	})
	.blur(function() {
		var text_val = $(this).val();
		if(text_val === "") {
			$(this).parent().siblings('label').removeClass('has-value');
		}
	});

	$('.TFDate, .wpcf7-select').parent().siblings('label').addClass('has-value');

});



})(jQuery);










