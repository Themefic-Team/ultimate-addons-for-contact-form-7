(function($){

    var forms = $('.wpcf7-form'); 

    forms.each(function(){
        var formId                = $(this).find('input[name="_wpcf7"]').val();
        var uacf7_form            = $('.uacf7-form-'+formId);
        var uacf7_mail            = $(`.uacf7-form-${formId} input[type="email"]`);
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation');
        var form_submit_btn       = uacf7_spam_protection.closest(`.uacf7-form-${formId}`).find('.wpcf7-submit');
        var uacf7_message         = uacf7_spam_protection.closest(`.uacf7-form-${formId}`).find('.wpcf7-textarea').val();
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
                var uacf7_word_filter        = (res.uacf7_word_filter && res.uacf7_word_filter.length > 0) ? res.uacf7_word_filter.split(',') : [];
                var uacf7_ip_block           = (res.uacf7_ip_block && res.uacf7_ip_block.length > 0) ? res.uacf7_ip_block.split(',') : [];
                var uacf7_country_block      = (res.uacf7_country_block && res.uacf7_country_block.length > 0) ? res.uacf7_country_block.split(',') : [];

                    
                var user_inpput_time = uacf7_minimum_time_limit * 1000;

                  
                    
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


                     //IP Ban

                     form_submit_btn.on('click', function (e) {
                        if ($.inArray(user_ip, uacf7_ip_block) !== -1) {

                            alert('Your IP is Banned from submitting this Form');
                            e.preventDefault(); 
                          
                         } 
                     });



                       //Country Ban

                    form_submit_btn.on('click', function (e) {
                        if ($.inArray(user_country, uacf7_country_block) !== -1) {
                            alert('Your country is Banned from submitting this Form');
                            e.preventDefault(); 
                        } 
                    });
                  

                  


                    
                    // Word Filter


                   
               

                    // });

          
                }
              });
    
        });


        // $(document).ready(function () {

        //     $(`.uacf7-form-${formId} input[type="submit"]`).on('click ', function (e) {e.preventDefault()});
        // });




    });
})(jQuery);

