;(function ($) {

        $('.wpcf7-form').each(function () {
        var form = $(this);
        var formId = form.find('input[name="_wpcf7"]').val();

        $(document).ready(function () {
            var keep_for;
        
            // Receive Webmaster Given Time
            $.ajax({
                url: uacf7_submit_later_obj.ajaxurl,
                type: 'POST',
                data: {
                    action: 'uacf7_submit_later_action',
                    form_id: formId,
                    ajax_nonce: uacf7_submit_later_obj.nonce,
                },
                success: function(data) {
                    keep_for = data.keep_for;
                }
            });
        
            // Saving Data to Submit Later
            var form = $('form.wpcf7-form');
            var formFields = form.find('input, textarea, select');
        
            function isExpired(timestamp) {
                return Date.now() > timestamp;
            }
        
            var savedFormData = localStorage.getItem('contactFormData');
            var savedExpiryTime = localStorage.getItem('contactFormDataExpiry');
        
            if (savedFormData && savedExpiryTime && !isExpired(parseInt(savedExpiryTime))) {
                savedFormData = JSON.parse(savedFormData);
                for (var field in savedFormData) {
                    if (savedFormData.hasOwnProperty(field)) {
                        var value = savedFormData[field];
                        var fieldElement = form.find('[name="' + field + '"]');
                        if (fieldElement.length > 0) {
                            if (fieldElement.is(':checkbox')) {
                                // Handle checkboxes
                                if (Array.isArray(value)) {
                                    value.forEach(function (val) {
                                        fieldElement.filter('[value="' + val + '"]').prop('checked', true);
                                    });
                                } else {
                                    fieldElement.prop('checked', true);
                                }
                            } else if (fieldElement.is(':radio')) {
                                // Handle radio buttons
                                fieldElement.filter('[value="' + value + '"]').prop('checked', true);
                            } else if (fieldElement.is('select')) {
                                // Handle select elements
                                fieldElement.val(value);
                            } else if (fieldElement.is(':file')) {
                                // Handle file inputs (can't store file data, so storing file name)
                                fieldElement.closest('.file-input-container').find('.file-name').text(value);
                            } else {
                                // Handle other input types
                                fieldElement.val(value);
                            }
                        }
                    }
                }

            } else {
                localStorage.removeItem('contactFormData');
                localStorage.removeItem('contactFormDataExpiry');
            }
        
            formFields.on('change', function () {
                var formData = {};
        
                formFields.each(function () {
                    var fieldName = $(this).attr('name');
                    if ($(this).is(':checkbox')) {
                        if (!formData[fieldName]) {
                            formData[fieldName] = [];
                        }
                        if ($(this).is(':checked')) {
                            formData[fieldName].push($(this).val());
                        }
                    } else if ($(this).is(':radio')) {
                        if ($(this).is(':checked')) {
                            formData[fieldName] = $(this).val();
                        }
                    } else if ($(this).is(':file')) {
                        // Handle file inputs (can't store file data, so storing file name)
                        formData[fieldName] = $(this).val().split('\\').pop(); 
                    } else {
                        formData[fieldName] = $(this).val();
                    }
                });
        
                localStorage.setItem('contactFormData', JSON.stringify(formData));
                localStorage.setItem('contactFormDataExpiry', (Date.now() + (keep_for * 60 * 60 * 1000)).toString());
            });
        
            form.on('submit', function () {
                localStorage.removeItem('contactFormData');
                localStorage.removeItem('contactFormDataExpiry');
            });
        });
        
        
    });

})(jQuery);