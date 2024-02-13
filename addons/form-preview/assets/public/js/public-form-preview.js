;(function ($) {

        $('.wpcf7-form').each(function () {
            var form = $(this);
            var formId = form.find('input[name="_wpcf7"]').val();
            // closest('div').find('label')

            $(document).ready(function () {

                $('#preview-btn').click(function (e) {
                    e.preventDefault();
                    var formData = $('.wpcf7-form').serializeArray();
                    var previewContent = '<div><ul>';
            
                    $.each(formData, function(index, field) {
                        var fieldElement = $('[name="' + field.name + '"]');
                        if (fieldElement.attr('type') !== 'hidden' && field.value !== '') {
                            previewContent += '<li><strong>' + field.name + ':</strong> ' + field.value + '</li>';
                        }
                    });
            
                    previewContent += '</ul></div>';
            
                    $(previewContent).dialog({
                        modal: true,
                        title: 'Form Preview',
                        width: 400,
                        height: 'auto',
                        resizable: false,
                        closeOnEscape: true, 
                        closeOnOverlayClick: true
                    });
                    $(dialog.parent()).on('click', function(event) {
                        if ($(event.target).hasClass('ui-widget-overlay')) {
                            dialog.dialog('close');
                        }
                    });

                });
        
                });
        
        });


})(jQuery);