(function ($) {
    $(document).ready(function () {
        
        $('.wpcf7-form').each(function () {

            //Showing Expiry Dates in Front End
            var popup_expiry = $(this).find('#uacf7-save-and-continue-loader').closest('.wpcf7-form-control-wrap').data('after');
            $('body').find('.uacf7-save-continue-temp-expiry').text(popup_expiry);
            $(this).find('.uacf7-save-continue-email-popup-expiry').text(popup_expiry);

            // Handling Email Popup
            $('#ucaf7-save-continue-email-overlay').on('click', function (){

                $(this).closest('.wpcf7-form-control-wrap').find('#uacf7-save-continue-email-popup').css('display', 'none');
                $(this).closest('.wpcf7-form-control-wrap').find('#uacf7-save-and-continue-loader').css('display', 'none');
                $(this).css('display', 'none');

            });
            $('.uacf7-sacf-email-popup-close-button').on('click', function (e){
                e.preventDefault();
                $(this).closest('#uacf7-save-continue-email-popup').css('display', 'none');
                $(this).closest('.wpcf7-form-control-wrap').find('#ucaf7-save-continue-email-overlay').css('display', 'none');
                $(this).closest('.wpcf7-form-control-wrap').find('#uacf7-save-and-continue-loader').css('display', 'none');   

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
               }, 3000);

               // Selector for showing ajax success message.
               var uacf7_sacf_url = $(this).closest('.wpcf7-form-control-wrap').find('#uacf7-save-continue-email-popup').find('#uacf7-sacf-url-input');
                
                var $form = $(this).closest('.wpcf7-form');
                var formId = $form.find('input[name="_wpcf7"]').val();
                // var formData = $form.serialize();
                var formData = $form.find(':input').not(':file').serialize();

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
                            var link = uacf7_submit_later_obj.site_url + '/uacf7-form-save-and-continue?uacf7-token=' + response.unique_id;
                            uacf7_sacf_url.val(link);
                        } else {
                            alert('Failed to save form data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + xhr.responseText);
                    },
                   
                });
            });

            //Clearing specific Submission
    
            $('.ucaf7-submit-later-clear-data').on('click', function(e) {
                e.preventDefault();
                
                var unique_id = $(this).data('unique-id');

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


          // Clear Database after specific Time
          function uacf7_save_and_continute_overdated_data(){

            var days_after = $(this).find('#uacf7-save-and-continue-loader').closest('.wpcf7-form-control-wrap').data('after');

            $.ajax({
                  url: uacf7_submit_later_obj.ajax_url,
                  type: 'POST',
                  dataType: 'json',
                  data: {
                      action: 'uacf7_delete_form_data_after_specific_date_action',
                      nonce: uacf7_submit_later_obj.nonce,
                      days_after: days_after,
                  },
                  success: function(response) {
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

         // Run the function every day at 12:00am
            setInterval(uacf7_save_and_continute_overdated_data, 24 * 60 * 60 * 1000);
    
        });


        /**Send Mail */
        $('.uacf7-sacf-send-mail-button').click(function(e) {

            e.preventDefault();

            // Showing Loader
            $('.uacf7-save-and-continue-mail-sending-loader').css('display', 'block');

            var link = $(this).closest('.uacf7-sacf-form-container').find('#uacf7-sacf-url-input').val();
            var email = $(this).closest('.uacf7-sacf-form-container').find('#uacf7-sacf-email-input').val();

            var success_message_area = $(this).closest('.uacf7-sacf-form-container').find('.uacf7-sacf-send-mail-message-success');
            var failed_message_area = $(this).closest('.uacf7-sacf-form-container').find('.uacf7-sacf-send-mail-message-failed');

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

                    $('.uacf7-save-and-continue-mail-sending-loader').css('display', 'none');

                    if(response.status === 'success'){
                        success_message_area.text(response.message);
                    }else{
                        failed_message_area.text(response.message);
                    }
        
                    setTimeout(() => {
                    success_message_area.text('');
                    failed_message_area.text('');
                    }, 3000);         
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });  

    });

})(jQuery);



