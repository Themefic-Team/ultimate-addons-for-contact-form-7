;(function ($) {

        $('.wpcf7-form').each(function () {
            var form = $(this);
            var formId = form.find('input[name="_wpcf7"]').val();

            $(document).ready(function () {
                var preview_heading = window.uacf7_preview_form_obj.preview_heading;
                var preview_labels = window.uacf7_preview_form_obj.preview_labels;
            
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
                        modal: true,
                        title: preview_heading,
                        width: 'auto',
                        height: 'auto',
                        minHeight: 200,
                        resizable: true,
                        closeOnEscape: true, 
                        closeOnOverlayClick: true
                    });
            
                });
            
            });            
        
        });


})(jQuery);