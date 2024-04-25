(function ($) {
    $(document).ready(function () {
        $('.wpcf7-form').each(function () {

            //Saving Data into Database
            $('.uacf7-save-and-continue').on('click', function(e) {
                e.preventDefault();
                var $form = $(this).closest('.wpcf7-form');
                var formId = $form.find('input[name="_wpcf7"]').val();
                var formData = $form.serialize();
                $.ajax({
                    url: uacf7_submit_later_obj.ajax_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'uacf7_submit_later_action',
                        nonce: uacf7_submit_later_obj.nonce,
                        form_id: formId,
                        form_data: formData
                    },
                    success: function(response) {
                        if (response.success) {
                            var link = window.location.origin + '/uacf7-form?uid=' + response.unique_id;
                            
                            console.log(link);
                        } else {
                            alert('Failed to save form data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + xhr.responseText);
                    }
                });
            });

            //Clearing specific Submission
            $('.ucaf7-submit-later-clear-data').on('click', function(e) {

                var unique_id = $(this).data('unique-id');

                if (confirm('Are you sure you want to delete this form data?')) {
                    $.ajax({
                        url: uacf7_submit_later_obj.ajax_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'uacf7_delete_form_data_action',
                            nonce: uacf7_submit_later_obj.nonce,
                            unique_id: unique_id
                        },
                        success: function(response) {

                            console.log(response);
                            if (response.success) {
                                alert('Form data deleted successfully.');
                                location.reload(); 
                            } else {
                                alert('Failed to delete form data.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error: ' + xhr.responseText);
                        }
                    });
                }
               
            }); 
    
        });
    });
})(jQuery);



