(function ($) {
    $(document).ready(function () {
        $('.wpcf7-form').each(function () {

        

            // Handling Email Popup

            $('#ucaf7-save-continue-email-overlay').on('click', function (){

                $(this).closest('.wpcf7-form-control-wrap').find('#uacf7-save-continue-email-popup').css('display', 'none');
                $(this).css('display', 'none');

            });


            //Saving Data into Database
            $('.uacf7-save-and-continue').on('click', function(e) {
                e.preventDefault();
                
                // Show uacf7-save-and-continue-loader
                $('#uacf7-save-and-continue-loader').css('display', 'block');
                $(this).closest('.wpcf7-form-control-wrap').find('#ucaf7-save-continue-email-overlay').css('display', 'block');

                // Popup Show
               setTimeout(() => {
                $(this).closest('.wpcf7-form-control-wrap').find('#uacf7-save-continue-email-popup').css('display', 'block');
               }, 5000);
                
                
                
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
                            var link = window.location.origin + '/uacf7-form-save-and-continue?uid=' + response.unique_id;
                            
                            $('#uacf7-save-continue-email-popup').find('#uacf7-sacf-url-input').val(link);
                            console.log(this);
                        } else {
                            alert('Failed to save form data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + xhr.responseText);
                    },
                    complete: function() {
                        // Hide uacf7-save-and-continue-loader after AJAX call completes
                        $('#uacf7-save-and-continue-loader').css('display', 'none');
                    }
                });
            });

            //Clearing specific Submission
            // $('.ucaf7-submit-later-clear-data').on('click', function(e) {

            //     var unique_id = $(this).data('unique-id');

            //     if (confirm('Are you sure you want to delete this form data?')) {
            //         $.ajax({
            //             url: uacf7_submit_later_obj.ajax_url,
            //             type: 'POST',
            //             dataType: 'json',
            //             data: {
            //                 action: 'uacf7_delete_form_data_action',
            //                 nonce: uacf7_submit_later_obj.nonce,
            //                 unique_id: unique_id
            //             },
            //             success: function(response) {

            //                 console.log(response);
            //                 if (response.success) {
            //                     alert('Form data deleted successfully.');
            //                     location.reload(); 
            //                 } else {
            //                     alert('Failed to delete form data.');
            //                 }
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error('Error: ' + xhr.responseText);
            //             }
            //         });
            //     }
               
            // }); 
            $('.ucaf7-submit-later-clear-data').on('click', function(e) {
                e.preventDefault(); // Prevent the default action of the button click
                
                var unique_id = $(this).data('unique-id');
                $('#ucaf7-save-continue-temp-overlay').css('display', 'block');
                
                // Show the custom confirmation popup
                $('#uacf7-save-continue-temp-popup').css('display', 'block');
                
                // Handle confirmation action when 'Yes' button is clicked
                $('#uacf7-save-continue-temp-popup-confirm').on('click', function() {
                    // Execute the delete action
                    deleteFormData(unique_id);
                    
                    // Hide the custom confirmation popup after the action
                    $('#uacf7-save-continue-temp-popup').css('display', 'none');
                    $('#ucaf7-save-continue-temp-overlay').css('display', 'none');
                });
                
                // Handle cancel action when 'No' button is clicked
                $('#uacf7-save-continue-temp-popup-cancel').on('click', function() {
                    // Hide the custom confirmation popup
                    $('#uacf7-save-continue-temp-popup').css('display', 'none');
                    $('#ucaf7-save-continue-temp-overlay').css('display', 'none');
                });
            });

            // On overly click the popup closing

            $('#ucaf7-save-continue-temp-overlay').on('click', function (){
                $('#uacf7-save-continue-temp-popup').css('display', 'none');
                $(this).css('display', 'none');
            });
            
            function deleteFormData(unique_id) {
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
            

            /** Popup */
            $(".ucaf7-submit-later-clear-data").click(function() {
                $("#myPopup").css("display", "block");
              });
            
              $("#confirmButton").click(function() {
                // Your confirmation action here
                $("#myPopup").css("display", "none");
              });
            
              $("#cancelButton").click(function() {
                $("#myPopup").css("display", "none");
              });
    
        });

            /**Send Mail */
            $('.uacf7-sacf-send-mail-button').click(function(e) {

                e.preventDefault();
                var link = $(this).closest('.uacf7-sacf-form-container').find('#uacf7-sacf-url-input').val();
                var email = $(this).closest('.uacf7-sacf-form-container').find('#uacf7-sacf-email-input').val();
                
                
                // AJAX call to send data to PHP script
                $.ajax({
                    url: uacf7_submit_later_obj.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'uacf7_send_email_action',
                        nonce: uacf7_submit_later_obj.nonce,
                        link: link,
                        email: email
                    },
                    success: function(response) {
                        
                        $('.uacf7-sacf-send-mail-message').text(response);

                     setTimeout(() => {
                        $('.uacf7-sacf-send-mail-message').text('');
                     }, 3000);
                     
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

    });
})(jQuery);



