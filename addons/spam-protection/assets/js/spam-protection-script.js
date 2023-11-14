(function($){

    var forms = $('.wpcf7-form'); 

    forms.each(function(){
        var formId                = $(this).find('input[name="_wpcf7"]').val();
        var uacf7_form            = $('.uacf7-form-'+formId);
        var uacf7_mail            = $(`.uacf7-form-${formId} input[type="email"]`);
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation');
        var form_submit_btn       = uacf7_spam_protection.closest(`.uacf7-form-${formId}`).find('.wpcf7-submit');
        var uacf7_message         = uacf7_spam_protection.closest(`.uacf7-form-${formId} input[type="textarea"]`).val();
        var user_ip               = $(uacf7_spam_protection).attr('user-ip');
        var user_country          = $(uacf7_spam_protection).attr('iso2');

        

       
        $(document).ready(function() {

            $.ajax({
                url : uacf7_spam_pro_obj.ajax_url,
                type: 'POST',
                data: {
                    action : 'uacf7_spam_action',
                    nonce  : uacf7_spam_pro_obj.nonce,
                    form_id: formId
                },
                success: function(res) {


                var uacf7_minimum_time_limit = (res.uacf7_minimum_time_limit && res.uacf7_minimum_time_limit.length > 0) ? res.uacf7_minimum_time_limit.split(',') : [];
                var user_inpput_time         = uacf7_minimum_time_limit * 1000;

                  
                    
                    //Time based submission Controls
               
                    var ipTimestamps = {};

                    $(form_submit_btn).on('click', function(event) {

                     
                        var formSubmitTime = new Date().getTime();
                        var lastSubmitTime = ipTimestamps[user_ip] || 0;
                        var timeTaken      = formSubmitTime - lastSubmitTime;

                        if (timeTaken < user_inpput_time) {
                            alert("Too fast submission not acceptable.");
                            event.preventDefault();
                            return false;
                        }

                        ipTimestamps[user_ip] = formSubmitTime;

                        return true;
                    });



          
                }
              });
    
        });



    });
})(jQuery);

