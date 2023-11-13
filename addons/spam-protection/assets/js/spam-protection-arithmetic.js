(function($){



    var forms = $('.wpcf7-form'); 
    forms.each(function(){
        var formId                = $(this).find('input[name="_wpcf7"]').val();
        var form_div              = $(this).find('.uacf7-form-'+formId);
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation');
    
        var refreshButton         = uacf7_spam_protection.find("#arithmathic_refresh");
        var validate              = uacf7_spam_protection.find("#arithmathic_validate");
    
        var protection_method     = $(uacf7_spam_protection).attr('protection-method');



        // Generating Random Numbers
        function uacf7_generate_ramdom_numbers(){
          var first_random_number   = Math.random() * 10;
          var second_random_number  = Math.random() * 10;
          uacf7_spam_protection.find('#arithmathic_recognation').find('#frn').text(Math.ceil(first_random_number));
          uacf7_spam_protection.find('#arithmathic_recognation').find('#srn').text(Math.ceil(second_random_number));
        }
        uacf7_generate_ramdom_numbers();
        
   

        //Returning Total Sum of Numbers
        function return_total_num (){
          var first_number      = uacf7_spam_protection.find('#arithmathic_recognation').find('#frn').text();
          var first_number_int  = parseInt(first_number);
          var second_number     = uacf7_spam_protection.find('#arithmathic_recognation').find('#srn').text();
          var second_number_int = parseInt(second_number);
          
          var total_number = first_number_int + second_number_int;

          return total_number;
        }


      
          //Refresh button action
          refreshButton.click(function (e) {
              e.preventDefault();
              uacf7_spam_protection.find("#rtn").val('');
              uacf7_generate_ramdom_numbers();

              console.log('validate')
        
          });

      
        

          //Conditionally make submission event false
         
            $(window).on('load', function() {
   
                var form_submit = uacf7_spam_protection.closest(`.uacf7-form-${formId}`).find('.wpcf7-submit');

                form_submit.on('click', function (e) {


                  var userInput = uacf7_spam_protection.find("#rtn").val();
                  var resultDiv = uacf7_spam_protection.find("#arithmathic_result");
          
                  if (userInput == return_total_num()) {
                    resultDiv.text("CAPTCHA validated successfully!");

                    refreshButton.trigger('click');

                
                  } else {

                      resultDiv.text("CAPTCHA validation failed. Please try again.");

                      e.preventDefault();
                      refreshButton.trigger('click');
                  }

                });
       
               
            });


  });

})(jQuery);




