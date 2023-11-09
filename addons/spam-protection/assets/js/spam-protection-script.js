(function($){

    var forms = $('.wpcf7-form'); 

    forms.each(function(){
        var formId     = $(this).find('input[name="_wpcf7"]').val();
        var uacf7_form = $('.uacf7-form-'+formId);
        var uacf7_mail = $(`.uacf7-form-${formId} input[type="email"]`);
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation');
        var user_ip = $(uacf7_spam_protection).attr('user-ip');

   

       
        $(document).ready(function() {

            //Time based submission Controls
            $(uacf7_form).submit(function(event) {
     
                var formSubmitTime = new Date().getTime();
                var timeTaken = formSubmitTime - window.performance.timing.navigationStart;
                if (timeTaken < 5000) { 
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
    
        });


    });
})(jQuery);

