
(function($){

	var forms = $('.wpcf7-form');

  	forms.each(function(){

        var formId = $(this).find('input[name="_wpcf7"]').val();


			$(document).ready(function($){
			
				var uacf7SelectedElements             = $(`.uacf7-material-design-dark .uacf7-form-${formId} .TFText, .TFEmail, .TFTel, .TFUrl, .TFnum `);
				var uacf7SelectedElementDateandSelect = $(`.uacf7-material-design-dark .uacf7-form-${formId} .wpcf7-date, .wpcf7-select, .wpcf7-file, .wpcf7-textarea`);
				var uacf7SelectedRequired             = $(`.uacf7-material-design-dark .uacf7-form-${formId}`).attr('aria-required');

				/** For General Fields */
				$(uacf7SelectedElements).on('focus', function() {
					
					$(this).parent().siblings('label').addClass('has-value');
					$(this).parent().siblings('label').removeClass('hover-label');
					$(this).addClass('input-focus');
				}).hover(function () {

					if($(this).is(':not(:focus)') && $(this).val().trim() === ''){
						$(this).parent().siblings('label').addClass('hover-label');
						$(this).addClass('hover');
					}

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

					$(this).removeClass('input-focus');
				});
				
			
			

				// if(uacf7SelectedRequired){
				// 	$(uacf7SelectedRequired).on('change', function() {
				// 		$(uacf7SelectedRequired).parent().siblings('label').addClass('required-tip');
				// 	});
				// }


				/** For Date, File, Textarea and Select */
	
				$(uacf7SelectedElementDateandSelect).parent().siblings('label').addClass('dfst');

				$(uacf7SelectedElementDateandSelect).on('mouseenter', function () {
	
					$(this).parent().siblings('label').addClass('hover-dfst-label');
					$(this).addClass('hover-dfst');
					
				}).on('mouseleave', function () {
	
					$(this).parent().siblings('label').removeClass('hover-dfst-label');
					$(this).removeClass('hover-dfst');
					
				}).on('focus', function () {

					$(this).parent().siblings('label').addClass('focus-dfst-label');
					$(this).addClass('focus-dfst');

				}).on('blur', function (){
					
					$(this).parent().siblings('label').removeClass('focus-dfst-label');
					$(this).removeClass('focus-dfst');
				});


				


			
			});
			

  });
})(jQuery);










