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

            alert('hi')
        
        });
        
        
    });

})(jQuery);