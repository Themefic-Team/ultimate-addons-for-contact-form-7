(function ($) {
  var forms = $('.wpcf7-form');

  forms.each(function () {
    var form = $(this);
    var formId = form.find('input[name="_wpcf7"]').val();

    form.find('.uacf7_country_dropdown_with_flag').each(function () {
      var field = $(this);
      var fieldId = field.attr('id');
      var defaultCountry = field.attr('country-code');
      var onlyCountries = field.attr('only-countries');

      if (typeof onlyCountries !== 'undefined' && onlyCountries != '') {
        onlyCountries = JSON.parse(onlyCountries);
      } else {
        onlyCountries = '';
      }

      $("#" + fieldId).countrySelect({
        defaultCountry: defaultCountry,
        onlyCountries: onlyCountries,
        responsiveDropdown: true,
        preferredCountries: []
      });
    });


    //Phone Number Tag

    function initializePhoneNumberField(input, iso2) {
      var phone_tag_name_attr = input.attr('name');
      var phoneTagName = input.attr('phone-tag-name');

      var telInput = $('input[name^="'+phone_tag_name_attr+'"]');
      
      telInput.intlTelInput('destroy');
    
      telInput.intlTelInput({
        utilsScript: uacf7_localize_obj.plugin_dir_url + 'assets/js/utils.js',
        initialCountry: iso2 || 'us',
      });
    
      var validate = function (input) {
        if ($.trim(input.val())) {
          if (!input.intlTelInput("isValidNumber")) {
            // alert(uacf7_localize_obj.phone_number_validation_message);
          } 
        }
      };
    
      telInput.on('blur', function () {
        validate(telInput);
      });
    }
    
    function applyIntlTelInput(selector, iso2) {
      $(selector).each(function () {
        initializePhoneNumberField($(this), iso2);
      });
    }

    window.applyIntlTelInput = applyIntlTelInput;
  
    
    $(document).ready(function () {
      var tel_input = form.find('.uacf7_phone_number').find('input[type="tel"]:not(.wpcf7-tel)');
      applyIntlTelInput(tel_input); 
      
    });
    
    // Free Version iso2 getting
    form.on('click', '#uacf7_country_select .country-list li', function () {
      var iso2 = $(this).attr('data-country-code');
      input = form.find('.uacf7_phone_number').find('input[type="tel"]:not(.wpcf7-tel)');
      applyIntlTelInput(input, iso2);
    });
    
    // Pro Version iso2 getting
    var countryField = form.find('#uacf7_country_select').find('select');
    countryField.on('change', function () {
      var iso2 = $(this).find('option:selected').attr('iso2');
      input = form.find('.uacf7_phone_number').find('input[type="tel"]:not(.wpcf7-tel)');
      applyIntlTelInput(input, iso2);
    });


    
  });
})(jQuery);
