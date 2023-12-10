
(function($){

	var forms = $('.wpcf7-form');

  	forms.each(function(){

        var formId = $(this).find('input[name="_wpcf7"]').val();

		console.log('outlined form' + formId)


			$(document).ready(function($){
			
				var uacf7SelectedElements             = $(`.uacf7-material-design-outlined .uacf7-form-${formId} .TFText, .TFEmail, .TFTel, .TFUrl, .TFnum, .TFDate, .TFFile `);
				var uacf7SelectedElementDateandSelect = $(`.uacf7-material-design-outlined .uacf7-form-${formId} .wpcf7-date, .wpcf7-select, .wpcf7-file`);
				var uacf7SelectedRequired             = $(`.uacf7-material-design-outlined .uacf7-form-${formId}`).find('.wpcf7-validates-as-required');


				/** For General Fields */
				$(uacf7SelectedElements).on('focus', function() {
					$(this).parent().siblings('label').addClass('has-value');
				}).hover(function () {
					$(this).parent().siblings('label').addClass('has-value');
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
			
					if (text_val === "" || text_val.length < 0) {
				
						$(this).parent().siblings('label').removeClass('has-value');
					}
					

					if($(this).hasClass('wpcf7-date') || $(this).hasClass('wpcf7-file')){
						$(this).parent().siblings('label').addClass('has-value');
					}	
				});


		
				
				/** For Date and Select */
			
				$(uacf7SelectedElementDateandSelect).parent().siblings('label').addClass('has-value');

			
				
				// if(uacf7SelectedRequired){
				// 	$(uacf7SelectedRequired).on('blur', function() {

				// 		$(this).prevAll().parent().siblings('label').addClass('required-tip');
				// 		$(this).addClass('input-tip');
		
				// 	});
				// }

	
			
			});
			

  });
})(jQuery);










