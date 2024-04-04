
(function ($) {
    $(document).ready(function(){

    $('.wpcf7-form').each(function () {
        var form   = $(this);
        var formId = form.find('input[name="_wpcf7"]').val();

        $.ajax({
            url : uacf7_form_preview_obj.ajaxurl,
            type: 'POST',
            data: {
                action    : 'uacf7_form_preview_action',
                form_id   : formId,
                ajax_nonce: uacf7_form_preview_obj.nonce,
            },
            success: function(data) {
                var is_enabled      = data.is_enabled;
                var preview_heading = data.preview_heading;
                var default_heading = data.form_preview_default_heading;
                var preview_labels  = data.preview_labels;

                if (form.find('#uacf7-preview-btn').length > 0 && is_enabled === '1') {

                    $(form).find('#uacf7-preview-btn').on('click', function (e) {
                        e.preventDefault();
                       
                        var previewContent = '<div class="uacf7-form-preview-dialog"><table id="dialog-table">';
                        $(form).find('input, select, textarea').each(function(index, field) {
                            var fieldElement = $(this); 
                            var fieldName = fieldElement.attr('name'); 
                            var fieldValue = fieldElement.val(); 
                        
                            // Skip hidden fields, empty values, and fields with special class
                            if (fieldElement.attr('type') !== 'hidden' && fieldElement.attr('type') !== 'submit' && fieldValue !== '' && !fieldElement.hasClass('uacf7-product-quantity')) {
                                var label = '';
                                $.each(preview_labels, function(i, previewLabel) {
                                    if (previewLabel.field_name === fieldName) {
                                        label = previewLabel.field_label;
                                        return false;
                                    }
                                });
                        
                                var displayName = label || fieldName;
                        
                                // Check if the field is a file input
                                if (fieldElement.attr('type') === 'file') {
                    
                                var file = fieldElement[0].files[0]; 

                                if (file) {
                                    var reader = new FileReader(); 

                                    reader.onload = function(event) {

                                        var img = $('<img>', { src: event.target.result, alt: 'Preview Image', style: 'max-width: 100px; max-height: 100px;' });
                                        fieldValue = img.prop('outerHTML');
                                    };
                                    reader.readAsDataURL(file);
                                }

                                }
                                
                                previewContent += '<tr><td><strong>' + displayName + ':</strong></td><td>' + fieldValue + '</td></tr>';
                        
                            }
                        });
                        
                        previewContent += '</table></div>';

                        $(previewContent).dialog({
                            modal              : true,
                            title              : preview_heading || default_heading,
                            height             : 350,
                            minHeight          : 200,
                            minWidth           : 600,
                            resizable          : true,
                            closeOnEscape      : true,
                            closeOnOverlayClick: true,
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

            }
        });
        
    }); 
    
}); 

})(jQuery);

