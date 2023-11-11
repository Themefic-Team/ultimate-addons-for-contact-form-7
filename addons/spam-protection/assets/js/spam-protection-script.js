(function($){

    var forms = $('.wpcf7-form'); 

    forms.each(function(){
        var formId                = $(this).find('input[name="_wpcf7"]').val();
        var uacf7_form            = $('.uacf7-form-'+formId);
        var uacf7_mail            = $(`.uacf7-form-${formId} input[type="email"]`);
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation');
        var user_ip               = $(uacf7_spam_protection).attr('user-ip');


        const api_url = uacf7_spam_pro_obj.plugin_dir_url+"assets/data.json";

        console.log(api_url)
       
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

                    var uacf7_minimum_time_limit = res.uacf7_minimum_time_limit.split(',');
                    var uacf7_word_filter        = res.uacf7_word_filter.split(',').map(str => str.trim());
                    var uacf7_ip_block           = res.uacf7_ip_block.split(',');
                    var uacf7_country_block      = res.uacf7_country_block.split(',');

                    console.log(uacf7_word_filter)
             
          
                    
                    var user_inpput_time = res.uacf7_minimum_time_limit * 1000;

                  
                    
                      //Time based submission Controls
               

                    var ipTimestamps = {};

                    $(uacf7_form).submit(function(event) {

                        var formSubmitTime = new Date().getTime();
                        var lastSubmitTime = ipTimestamps[user_ip] || 0;
                        var timeTaken      = formSubmitTime - lastSubmitTime;

                        if (timeTaken < user_inpput_time) {
                            alert("Possible bot detected! Submission rejected.");
                            event.preventDefault();
                            return false;
                        }

                        ipTimestamps[user_ip] = formSubmitTime;

                        return true;
                    });

                     //IP Ban

                
                    $(uacf7_form).on('click', function(event) {

                        if ($.inArray(user_ip, uacf7_ip_block) !== -1) {
                            alert('Your IP address is banned from submitting this form.');
                            // event.preventDefault(); 
                        }         
                        
                    });

                    //Country Ban
                    if ($.inArray(user_country, uacf7_country_block) !== -1) {
                        alert('Your Country is banned from submitting this form.');
                        // event.preventDefault(); 
                    } 
          
                }
              });

          
    

           
    
        });


    });
})(jQuery);

