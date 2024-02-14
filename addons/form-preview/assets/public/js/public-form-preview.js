;(function ($) {

        $('.wpcf7-form').each(function () {
            var form = $(this);
            var formId = form.find('input[name="_wpcf7"]').val();

            $(document).ready(function () {
                var preview_heading = window.uacf7_preview_form_obj.preview_heading;
            
                $('#uacf7-preview-btn').click(function (e) {
                    e.preventDefault();
                    var formData = $('.wpcf7-form').serializeArray();
                    var previewContent = '<div><table>';
            
                    $.each(formData, function(index, field) {
                        var fieldElement = $('[name="' + field.name + '"]');
                        if (fieldElement.attr('type') !== 'hidden' && field.value !== '') {
                            previewContent += '<tr><td><strong>' + field.name + ':</strong></td><td>' + field.value + '</td></tr>';
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