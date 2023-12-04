
(function($){

$(document).ready(function($){
	/** For General Fields */
	$(".TFText, .TFEmail, .TFTel").on('focus input', function() {
			$(this).parent().siblings('label').addClass('has-value');
	})
	.blur(function() {
		var text_val = $(this).val();
		if(text_val === "") {
			$(this).parent().siblings('label').removeClass('has-value');
		}
	});



	/*For Two Column*/

	$('.TF_Field_Wrap').find("input").on('focus input', function() {
		$(this).parent().siblings('label').addClass('has-value');
	})
	.blur(function() {
		var text_val = $(this).val();
		if(text_val === "") {
			$(this).parent().siblings('label').removeClass('has-value');
		}
	});

	/** For Date and Select */

	$('.TFDate, .wpcf7-select').parent().siblings('label').addClass('has-value');

});



})(jQuery);










