
(function($){

	var forms = $('.wpcf7-form');

  	forms.each(function(){

        var formId = $(this).find('input[name="_wpcf7"]').val();


			$(document).ready(function($){
			
				var uacf7SelectedElements             = $(`.uacf7-material-design .uacf7-form-${formId} .TFText, .TFEmail, .TFTel, .TFUrl, .TFnum, .TFDate, .TFFile `);
				var uacf7SelectedElementDateandSelect = $(`.uacf7-material-design .uacf7-form-${formId} .TFDate, .wpcf7-select, .TFFile`);


				/** For General Fields */
				$(uacf7SelectedElements).on('focus', function() {
						$(this).parent().siblings('label').addClass('has-value');
					
				}).hover( function () {
					$(this).parent().siblings('label').addClass('has-value');
					$(this).addClass('hover');
				}).mouseleave (function (){
					var text_val = $(this).val();
					if(text_val !== "") {
						$(this).parent().siblings('label').addClass('has-value');
					}
					$(this).removeClass('hover');
					if(!$(this).hasClass('TFDate') && !$(this).hasClass('TFFile')){
						$(this).parent().siblings('label').removeClass('has-value');
					}
					
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
					// $(uacf7SelectedElementsNested).find('input:not([type="date"]').on('focus', function() {
					// 	// $(this).parent().siblings('label').addClass('has-value');
					// 	$(this).closest('.wpcf7-form-control-wrap').siblings('label').addClass('has-value');

					// 	alert('focused')
					// 	$(this).css({
					// 		outline: 'none',
					// 		border: '2px solid #6747c1'
					// 	});
					// }).hover( function () {
					// 	$(this).parent().siblings('label').addClass('has-value');
					// 	$(this).css({
					// 		outline: 'none',
					// 		border: '2px solid #6747c1'
		
					// 	});
					// }).mouseleave (function (){
					// 	$(this).parent().siblings('label').removeClass('has-value');
					// 	$(this).css({
					// 		border: ''
					// 	});
					// })
					// .blur(function() {
					// 		var text_val = $(this).val();
					
					// 		if(text_val === "") {
					// 			$(this).parent().siblings('label').removeClass('has-value');
					// 		}
			
					// });
			
				
				/** For Date and Select */
			
				$(uacf7SelectedElementDateandSelect).parent().siblings('label').addClass('has-value');
				// $(uacf7SelectedElementsNested).find('.TFDate').parent().siblings('label').addClass('has-value');
			



			
			});
			

  });
})(jQuery);










