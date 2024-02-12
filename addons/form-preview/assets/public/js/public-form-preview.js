;(function ($) {

        $('.wpcf7-form').each(function () {
        var form = $(this);
        var formId = form.find('input[name="_wpcf7"]').val();

        $(document).ready(function () {
            // var keep_for;
        
            // Receive Webmaster Given Time
            // $.ajax({
            //     url: uacf7_submit_later_obj.ajaxurl,
            //     type: 'POST',
            //     data: {
            //         action: 'uacf7_submit_later_action',
            //         form_id: formId,
            //         ajax_nonce: uacf7_submit_later_obj.nonce,
            //     },
            //     success: function(data) {
            //         keep_for = data.keep_for;
            //     }
            // });

            $(document).ready(function () {
                $('#preview-btn').click(function () {
                    var formData = {};
                    $('.wpcf7-form input, .wpcf7-form textarea, .wpcf7-form select').each(function () {
                        var fieldName = $(this).attr('name');
                        var fieldValue = $(this).val();
                        formData[fieldName] = fieldValue;
                    });
                    showPreviewPopup(formData);
                });
            });
            
            function showPreviewPopup(formData) {
                var previewHtml = '<div class="preview-popup">';
                for (var field in formData) {
                    if (formData.hasOwnProperty(field)) {
                        previewHtml += '<p><strong>' + field + ':</strong> ' + formData[field] + '</p>';
                    }
                }
                previewHtml += '</div>';
                
                $('.preview-popup').remove(); 
                $('body').append(previewHtml);
                $('.preview-popup').fadeIn();
            }
            
        
        });
        
        
    });

})(jQuery);