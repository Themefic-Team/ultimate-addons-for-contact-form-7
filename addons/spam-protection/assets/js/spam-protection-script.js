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

                    var uacf7_minimum_time_limit = res.uacf7_minimum_time_limit;
                    var uacf7_word_filter        = res.uacf7_word_filter;
                    var uacf7_ip_block           = res.uacf7_ip_block;
                    var uacf7_country_block      = res.uacf7_country_block;

                    console.log(uacf7_word_filter)
             
          
                    
                    var user_inpput_time = res.uacf7_minimum_time_limit * 1000;

                    var country = res.uacf7_ip_block
                        country.split(',');
                    
                      //Time based submission Controls
                    $(uacf7_form).submit(function(event) {
            
                        var formSubmitTime = new Date().getTime();
                        var timeTaken      = formSubmitTime - window.performance.timing.navigationStart;
                        if (timeTaken < user_inpput_time) { 
                            alert("Possible bot detected! Submission rejected.");
                            event.preventDefault(); 
                            return false;
                        }
                
                        return true;

                    });

                     //IP Ban
                    const bannedIPs = ['127.0.0.1', '10.0.0.2', '127.0.0.1'];
                
                    $(uacf7_form).on('click', function(event) {


                        if ($.inArray(user_ip, bannedIPs) !== -1) {
                            alert('Your IP address is banned from submitting this form.');
                            // event.preventDefault(); 
                        }         
                        
                    });

                    //Country Ban
                    const bannedCountries = ['bd', 'pk', 'af'];
                    if ($.inArray(user_country, bannedCountries) !== -1) {
                        alert('Your Country is banned from submitting this form.');
                        // event.preventDefault(); 
                    } 
          
                }
              });

          
    

           
    
        });


    });
})(jQuery);

