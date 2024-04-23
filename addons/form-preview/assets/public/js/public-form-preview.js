(function ($) {
    $(document).ready(function () {

        const form_wrap = $('.wpcf7-form');
        form_wrap.each(function () {
            var form = $(this);
            var formId = form.find('input[name="_wpcf7"]').val();
            const previewButton = form.find('#uacf7-preview-btn');

            console.log(`inside ${formId}`);

            previewButton.on('click', function (e) {
                e.preventDefault();
                console.log(`after click ${formId}`);

                $.ajax({
                    url: uacf7_form_preview_obj.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'uacf7_form_preview_action',
                        form_id: formId,
                        ajax_nonce: uacf7_form_preview_obj.nonce,
                    },
                    success: function (data) {
                        var is_enabled = data.is_enabled;
                        var preview_heading = data.preview_heading;
                        var default_heading = data.form_preview_default_heading;
                        var preview_labels = data.preview_labels;

                        if (previewButton.length > 0 && is_enabled === '1') {
                            var previewContent = '<div class="uacf7-form-preview-dialog"><table id="dialog-table">';
                            $(form).find('input, select, textarea').each(function (index, field) {
                                var fieldElement = $(this);
                                var fieldName = fieldElement.attr('name');
                                var fieldValue = fieldElement.val();

                                // Skip hidden fields, empty values, and fields with special class
                                if (fieldElement.attr('type') !== 'hidden' && fieldElement.attr('type') !== 'submit' && fieldValue !== '' && !fieldElement.hasClass('uacf7-product-quantity')) {
                                    var label = '';
                                    $.each(preview_labels, function (i, previewLabel) {
                                        if (previewLabel.field_name === fieldName) {
                                            label = previewLabel.field_label;
                                            return false;
                                        }
                                    });

                                    var displayName = label || fieldName;

                                    // Check if the field is a file input
                                    if (fieldElement.attr('type') === 'file' && fieldElement.hasClass('img_id_special')) {
                                        previewContent += '<tr><td><strong>' + displayName + ':</strong></td><td>' + 'Signature Preview only to the Database' + '</td></tr>';
                                    } else if (fieldElement.attr('type') === 'file' && !fieldElement.hasClass('img_id_special')) {
                                        previewContent += '<tr><td><strong>' + displayName + ':</strong></td><td>' + 'There is no Preview of Uploaded Files' + '</td></tr>';
                                    } else {
                                        previewContent += '<tr><td><strong>' + displayName + ':</strong></td><td>' + fieldValue + '</td></tr>';
                                    }


                                }
                            });

                            previewContent += '</table></div>';

                            $(previewContent).dialog({
                                modal: true,
                                title: preview_heading || default_heading,
                                height: 350,
                                minHeight: 200,
                                minWidth: 600,
                                resizable: true,
                                closeOnEscape: true,
                                closeOnOverlayClick: true,
                                position: {
                                    my: "center",
                                    at: "center",
                                    of: window
                                },
                                create: function (event, ui) {
                                    $(event.target).parent().css('position', 'fixed');
                                },
                                drag: function (event, ui) {

                                    $(this).dialog('option', 'position', { my: 'center', at: 'center', of: window });
                                },
                                resize: function (event, ui) {

                                    $(this).dialog('option', 'position', { my: 'center', at: 'center', of: window });
                                },
                                width: function () {
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
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching form preview data:", error);
                    },
                });
            });
        });
    });

})(jQuery);

