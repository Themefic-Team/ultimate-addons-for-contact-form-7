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




      function uacf7_phone_number_fn(iso2) {
        $('.uacf7_phone_number input[type="tel"]').each(function() {
          var phoneTagName = $(this).attr('phone-tag-name');
          var telInput = $('#phone_' + phoneTagName);
      
          // Destroy the previous instance before reinitializing
          telInput.intlTelInput('destroy');
      
          telInput.intlTelInput({
            utilsScript: uacf7_localize_obj.plugin_dir_url + 'assets/js/utils.js',
            initialCountry: iso2 || 'us',

          });
      
          var validate = function(input) {
            if ($.trim(input.val())) {
              if (!input.intlTelInput("isValidNumber")) {
                $('#validation_message_' + phoneTagName).text(uacf7_localize_obj.phone_number_validation_message);
              } else {
                $('#validation_message_' + phoneTagName).text('');
              }
            }
          };
      
          // Trigger validation on blur
          telInput.on('blur', function() {
            validate(telInput);
          });
        });
      }
      
      
      // Call the function on document load
      $(document).ready(function() {
        uacf7_phone_number_fn();
      });
      
      // Attach the event listener for country field change
      var country_field_value = $('.uacf7-form-' + formId).find('#uacf7_country_select').find('select');

      country_field_value.on('change', function() {
        var iso2 = $(this).find('option:selected').attr('iso2');
        uacf7_phone_number_fn(iso2);
      });
      
});


})(jQuery);

