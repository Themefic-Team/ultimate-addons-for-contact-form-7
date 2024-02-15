;(function ($) {  
    
    $(document).ready(function () {

        $('.wpcf7-form').each(function () {
            var form   = $(this);
            var formId = form.find('input[name="_wpcf7"]').val();

            if (form.find('#uacf7-preview-btn').length > 0) {
         
                var is_enabled;
                var preview_heading;
                var preview_labels;

                $.ajax({
                    url : uacf7_form_preview_obj.ajaxurl,
                    type: 'POST',
                    data: {
                        action    : 'uacf7_form_preview_action',
                        form_id   : formId,
                        ajax_nonce: uacf7_form_preview_obj.nonce,
                    },
                    success: function(data) {
                        is_enabled      = data.is_enabled;
                        preview_heading = data.preview_heading;
                        preview_labels  = data.preview_labels;
                    }
                });
            
                
                $(form).find('#uacf7-preview-btn').click(function (e) {
                    e.preventDefault();
                    var formData = $(this).closest('.wpcf7-form').serializeArray();
                    var previewContent = '<div><table>';
            
                    $.each(formData, function(index, field) {
                        var fieldElement = $('[name="' + field.name + '"]');
                        if (fieldElement.attr('type') !== 'hidden' && field.value !== '') {
                            var label = '';
                            $.each(preview_labels, function(i, previewLabel) {
                                if (previewLabel.field_name === field.name) {
                                    label = previewLabel.field_label;
                                    return false; 
                                }
                            });
                    
                            var displayName = label || field.name;
                            previewContent += '<tr><td><strong>' + displayName + ':</strong></td><td>' + field.value + '</td></tr>';
                        }
                    });
            
                    previewContent += '</table></div>';
            
                    $(previewContent).dialog({
                        modal              : true,
                        title              : preview_heading ||'Form Preview',
                        width              : 'auto',
                        height             : 'auto',
                        minHeight          : 200,
                        resizable          : true,
                        closeOnEscape      : true,
                        closeOnOverlayClick: true
                    });
            
                });
            }
            
            });            
        
        });


})(jQuery);