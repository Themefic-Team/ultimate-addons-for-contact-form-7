
(function($){

	var forms = $('.wpcf7-form');

  	forms.each(function(){

        var formId = $(this).find('input[name="_wpcf7"]').val();


			$(document).ready(function($){
			
				var uacf7SelectedElements             = $(`.uacf7-material-design .uacf7-form-${formId} .TFText, .TFEmail, .TFTel, .TFUrl, .TFnum, .TFDate, .TFFile `);
				var uacf7SelectedElementDateandSelect = $(`.uacf7-material-design .uacf7-form-${formId} .TFDate, .wpcf7-select, .TFFile`);


				/** For General Fields */
				$(uacf7SelectedElements).on('focus keydown keyup change input focusout', function() {
					$(this).parent().siblings('label').addClass('has-value');
				}).hover(function () {
					$(this).parent().siblings('label').addClass('has-value');
					$(this).addClass('hover');
				}).mouseleave(function () {
					var val = $(this).val();
					if (val.length !== 0) {
						$(this).parent().siblings('label').addClass('has-value');
					}
					$(this).removeClass('hover');
					if (!$(this).hasClass('TFDate') && !$(this).hasClass('TFFile') && val.length === 0 && $(this).is(':not(:focus)') ) {
						$(this).parent().siblings('label').removeClass('has-value');
					}
				}).keypress(function () {
					$(this).parent().siblings('label').addClass('has-value');
				}).on('input', function () {
					var val = $(this).val();
					if (val.trim() !== '') {
						$(this).parent().siblings('label').addClass('has-value');
					} else {
						$(this).parent().siblings('label').removeClass('has-value');
					}
				}).blur(function () {
					var text_val = $(this).val();
					if (text_val === "") {
						$(this).parent().siblings('label').removeClass('has-value');
					}
				});
				
			
				
				/** For Date and Select */
			
				$(uacf7SelectedElementDateandSelect).parent().siblings('label').addClass('has-value');
				// $(uacf7SelectedElementsNested).find('.TFDate').parent().siblings('label').addClass('has-value');
			



			
			});
			

  });
})(jQuery);










