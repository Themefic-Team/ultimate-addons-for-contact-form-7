
(function($){

	var forms = $('.wpcf7-form');

  	forms.each(function(){

        var formId = $(this).find('input[name="_wpcf7"]').val();


			$(document).ready(function($){
			
				var Uacf7selectedElements = $(`.uacf7-material-design .uacf7-form-${formId} .TFText, .TFEmail, .TFTel, .TFUrl, .TFnum`);
				var Uacf7selectedElementDateandSelect = $(`.uacf7-material-design .uacf7-form-${formId} .TFDate, .wpcf7-select, .TFFile`);
				var Uacf7selectedElementsNested = $(`.uacf7-material-design .uacf7-form-${formId} .TF_Field_Wrap`);
				/** For General Fields */
				$(Uacf7selectedElements).on('focus', function() {
						$(this).parent().siblings('label').addClass('has-value');
						$(this).css({
							outline: 'none',
							border: '2px solid #6747c1'
						});
				}).hover( function () {
					$(this).parent().siblings('label').addClass('has-value');
					$(this).css({
						outline: 'none',
	
					});
				}).mouseleave (function (){
					$(this).parent().siblings('label').removeClass('has-value');
					$(this).css({

					});
				})
				.blur(function() {
					var text_val = $(this).val();
					if(text_val === "") {
						$(this).parent().siblings('label').removeClass('has-value');
					}

					$(this).css({
						border: ''
					});
				});
			
			
				/*For Two Column*/
					$(Uacf7selectedElementsNested).find('input:not([type="date"]').on('focus', function() {
						$(this).parent().siblings('label').addClass('has-value');
						$(this).css({
							outline: 'none',
							border: '2px solid #6747c1'
						});
					}).hover( function () {
						$(this).parent().siblings('label').addClass('has-value');
						$(this).css({
							outline: 'none',
		
						});
					}).mouseleave (function (){
						$(this).parent().siblings('label').removeClass('has-value');
						$(this).css({
							border: ''
						});
					})
					.blur(function() {
							var text_val = $(this).val();
					
							if(text_val === "") {
								$(this).parent().siblings('label').removeClass('has-value');
							}
			
					});
			
				
				/** For Date and Select */
			
				$(Uacf7selectedElementDateandSelect).parent().siblings('label').addClass('has-value');
				$(Uacf7selectedElementsNested).find('.TFDate').parent().siblings('label').addClass('has-value');
			
			});
			

  });
})(jQuery);










