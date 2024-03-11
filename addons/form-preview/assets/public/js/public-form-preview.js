;(function ($) {  
    
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
                            var formData = $(this).closest('.wpcf7-form').serializeArray();
                            var previewContent = '<div class="uacf7-form-preview-dialog"><table id="dialog-table">';
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
                                title              : preview_heading ||default_heading,
                                height             : 350,
                                minHeight          : 200,
                                minWidth           : 300,
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

})(jQuery);


window.addEventListener('scroll', function() {

  
});
  