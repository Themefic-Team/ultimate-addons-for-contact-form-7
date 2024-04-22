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
                    var link_to_submit_later = data.link_to_submit_later;
                   
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

                            


                    // Add "Save and Continue Later" button functionality
                    $('#uacf7SaveAndContinue').on('click', function() {
                        saveFormData();
                        var savedId = 'contactFormData_' + formId;
                        var url = window.location.origin + window.location.pathname + '?savedId=' + savedId;
                        

                        //Dialog Markup
                        var email_dialog = '<div id="emailDialog" title="Email Link">';
                        email_dialog += '<label for="uacf7_sl_temp_link">Submit Later Link</label>';
                        email_dialog += `<input type="url" disabled id="uacf7_sl_temp_link" value=${url}>`;
                        email_dialog += '<label for="uacf7submitLaterEmailAddress">Enter your email address:</label>';
                        email_dialog += '<input type="email" id="uacf7submitLaterEmailAddress"><br>';

                        $(email_dialog).dialog({
                            modal              : true,
                            title              : link_to_submit_later,
                            height             : 350,
                            minHeight          : 200,
                            minWidth           : 600,
                            resizable          : true,
                            closeOnEscape      : true,
                            closeOnOverlayClick: true,
                            buttons: {
                                "Send Email": function() {
                                    var emailAddress = $('#uacf7submitLaterEmailAddress').val();
                                    var emailSubject = 'Save and Continue Later Link';
                                    var emailBody = 'Here is the link to continue filling out the form:\n' + $('#uacf7_sl_temp_link').val();
                                   
                                    window.location.href = 'mailto:' + emailAddress + '?subject=' + encodeURIComponent(emailSubject) + '&body=' + encodeURIComponent(emailBody);
                                    $(this).dialog('close');
                                },
                                "Cancel": function() {
                                    $(this).dialog('close');
                                }
                            },
                            position           : {
                                my: "center",
                                at: "center",
                                of: window
                            },
                            create: function(event, ui) {
                                $(event.target).parent().css('position', 'fixed');
                            },
                            drag: function(event, ui) {
                        
                                $(this).dialog('option', 'position', { my: 'center', at: 'center', of: window });
                            },
                            resize: function(event, ui) {
                      
                                $(this).dialog('option', 'position', { my: 'center', at: 'center', of: window });
                            },
                            width: function() {
                                if ($(window).width() <= 767) {
                                    return $(window).width();
                                } else {
                                    return 600;
                                }
                            }
                            
                        });

                        $('.ui-widget-overlay').on('click', function () {
                            $(".ui-dialog-content").dialog("close");
                        });

                    });

                   
                }
            });
        });
    });
})(jQuery);
