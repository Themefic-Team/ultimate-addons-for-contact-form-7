
(function($){

	var forms = $('.wpcf7-form');

  forms.each(function(){

        var formId = $(this).find('input[name="_wpcf7"]').val();

		$(document).ready(function($){
			$(`.uacf7-form-${formId}`).find(".TFText, .TFEmail, .TFTel, .TFFirst_Name, .TFLast_Name").on('focus input', function() {
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


  });
})(jQuery);










