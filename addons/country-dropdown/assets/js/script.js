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

    function uacf7_phone_number_fn(iso2) {
      form.find('.uacf7_phone_number input[type="tel"]').each(function () {
        var phoneTagName = $(this).attr('phone-tag-name');
        var telInput = $('#phone_' + phoneTagName);

        telInput.intlTelInput('destroy');

        telInput.intlTelInput({
          utilsScript: uacf7_localize_obj.plugin_dir_url + 'assets/js/utils.js',
          initialCountry: iso2 || 'us',
        });

        var validate = function (input) {
          if ($.trim(input.val())) {
            if (!input.intlTelInput("isValidNumber")) {
              $('#validation_message_' + phoneTagName).text(uacf7_localize_obj.phone_number_validation_message);
            } else {
              $('#validation_message_' + phoneTagName).text('');
            }
          }
        };

        telInput.on('blur', function () {
          validate(telInput);
        });
      });
    }

    $(document).ready(function () {
      uacf7_phone_number_fn();
    });

    // Free Verison iso2 getting
    form.on('click', '#uacf7_country_select .country-list li', function () {
      var iso2 = $(this).attr('data-country-code');
      uacf7_phone_number_fn(iso2);
    });

    // Pro Verison iso2 getting
    var countryField = form.find('#uacf7_country_select').find('select');
    countryField.on('change', function () {
      var iso2 = $(this).find('option:selected').attr('iso2');
      uacf7_phone_number_fn(iso2);
    });
  });
})(jQuery);
