;(function ($) {


  var forms = $('.wpcf7-form'); 
  forms.each(function(){
      var formId = $(this).find('input[name="_wpcf7"]').val();   
      $('.uacf7-form-'+formId).find('input.uacf7_country_dropdown_with_flag').each(function(){
        
        var fieldId = jQuery(this).attr('id');
        var defaultCountry = jQuery(this).attr('country-code');
        var onlyCountries = jQuery(this).attr('only-countries');  
        if(typeof onlyCountries !== "undefined" && onlyCountries != ''){
          onlyCountries = JSON.parse(onlyCountries);
        }else{
          onlyCountries = '';
        } 
        
        $("#"+fieldId).countrySelect({ 
          defaultCountry: defaultCountry,
          onlyCountries: onlyCountries,
          responsiveDropdown: true,
          preferredCountries: []
        });  
      });      
}); 



	/**Phone Number Tag Start */

  $(document).ready(function () {

   
    function uacf7_phone_number_fn(iso2){
      $('.uacf7_phone_number input[type="tel"]').each(function() {

      
        var phoneTagName = $(this).attr('phone-tag-name');

        var telInput = $('#phone_' + phoneTagName);
        
        telInput.intlTelInput('destroy');

        telInput.intlTelInput({
          utilsScript: uacf7_localize_obj.plugin_dir_url+'assets/js/utils.js',
          initialCountry: iso2 ?? 'us',
        });
      
    
        var validate = function(input) {
          if ($.trim(input.val())) {
            if (!input.intlTelInput("isValidNumber")) {
              $('#vallidation_message_' + phoneTagName).text(uacf7_localize_obj.phone_number_validation_message);
            } else {
              $('#vallidation_message_' + phoneTagName).text('');
            }
          }
        };
      
        telInput.on('blur', function() {
          validate(telInput);
        });
      });
    }


    uacf7_phone_number_fn();


    // var country_field_value   = $('.uacf7-form-'+formId).find('#uacf7_country_select').find('select');
  
    // country_field_value.on('change', function () {
    //   var iso2 = $(this).find('option:selected').attr('iso2');
    //    uacf7_phone_number_fn(iso2);
    //    var country_code = $(document).find('.country-list').find('li');


    //   country_code.each(function () {
    //     if($(this).data('country-code') == iso2){

       
    //     }
    
    //   });

    // });

    // Phone Number
  
    // $('.uacf7_phone_number input[type="tel"]').each(function() {
    // 	var phoneTagName = $(this).attr('phone-tag-name');

    // 	var telInput = $('#phone_' + phoneTagName);
    
    // 	telInput.intlTelInput({
    // 		utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.8/js/utils.js',
    // 		initialCountry: iso2,
    // 	});
    
    // 	var validate = function(input) {
    // 		if ($.trim(input.val())) {
    // 			if (!input.intlTelInput("isValidNumber")) {
    // 				$('#vallidation_message_' + phoneTagName).text(all_country_script.phone_number_validation_message);
    // 			} else {
    // 				$('#vallidation_message_' + phoneTagName).text('');
    // 			}
    // 		}
    // 	};
    
    // 	telInput.on('blur', function() {
    // 		validate(telInput);
    // 	});
    // });
    
  /**Phone Number Tag End */

});


})(jQuery);

