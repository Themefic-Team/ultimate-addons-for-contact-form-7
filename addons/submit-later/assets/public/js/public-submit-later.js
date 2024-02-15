(function ($) {
    $(document).ready(function () {
        $('.wpcf7-form').each(function () {
            var form = $(this);
            var formId = form.find('input[name="_wpcf7"]').val();

            $.ajax({
                url: uacf7_submit_later_obj.ajaxurl,
                type: 'POST',
                data: {
                    action: 'uacf7_submit_later_action',
                    form_id: formId,
                    ajax_nonce: uacf7_submit_later_obj.nonce,
                },
                success: function(data) {
                    var formId = data.form_id;
                    var is_enabled = data.is_enabled;
                    var keep_for = data.keep_for;
                   
                    function isExpired(timestamp) {
                        return Date.now() > timestamp;
                    }

                    function loadFormData() {
                        var savedFormData = localStorage.getItem('contactFormData_' + formId);
                        var savedExpiryTime = localStorage.getItem('contactFormDataExpiry_' + formId);

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
                                            // Handle file inputs 
                                            fieldElement.closest('.file-input-container').find('.file-name').text(value);
                                        } else {
                                            // Handle other input types
                                            fieldElement.val(value);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // Save form data to localStorage
                    function saveFormData() {
                        var formData = {};
                        form.find('input, textarea, select').each(function () {
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
                        localStorage.setItem('contactFormData_' + formId, JSON.stringify(formData));
                        localStorage.setItem('contactFormDataExpiry_' + formId, (Date.now() + (keep_for * 60 * 60 * 1000)).toString());
                    }

                    // Load form data on document ready
                    if(is_enabled === '1'){
                        loadFormData();
                    }

                    // Save form data on change event
                    form.find('input, textarea, select, radio').on('change', function () {
                        saveFormData();
                    });

                    // Remove form data on form submission
                    form.on('submit', function () {
                        localStorage.removeItem('contactFormData_' + formId);
                        localStorage.removeItem('contactFormDataExpiry_' + formId);
                    });
                }
            });
        });
    });
})(jQuery);
