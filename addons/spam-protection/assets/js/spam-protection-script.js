(function($){

    var forms = $('.wpcf7-form'); 
    forms.each(function(){
        var formId                = $(this).find('input[name="_wpcf7"]').val();
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation');

        var refreshButton = uacf7_spam_protection.find("#arithmathic_refresh");
        var validate   = uacf7_spam_protection.find("#arithmathic_validate");

        let predefined_flag = true;

    

        function uacf7_generate_ramdom_numbers(){
          var first_random_number   = Math.random() * 10;
          var second_random_number  = Math.random() * 10;
          uacf7_spam_protection.find('#arithmathic_recognation').find('#frn').text(Math.ceil(first_random_number));
          uacf7_spam_protection.find('#arithmathic_recognation').find('#srn').text(Math.ceil(second_random_number));
        }
        uacf7_generate_ramdom_numbers();
        
   


        function return_total_num (){
          var first_number      = uacf7_spam_protection.find('#arithmathic_recognation').find('#frn').text();
          var first_number_int  = parseInt(first_number);
          var second_number     = uacf7_spam_protection.find('#arithmathic_recognation').find('#srn').text();
          var second_number_int = parseInt(second_number);
          
          var total_number = first_number_int + second_number_int;

          return total_number;
        }

    

        function validateCaptcha() {
            const userInput = uacf7_spam_protection.find("#rtn").val();
            const resultDiv = uacf7_spam_protection.find("#arithmathic_result");
            
            if (userInput == return_total_num()) {

              resultDiv.text("CAPTCHA validated successfully!");
              setTimeout(() => {
                
                resultDiv.text("");
              }, 2000);
           
             
            } else {

              if(predefined_flag){

                resultDiv.text("CAPTCHA validation failed. Please try again.");
                setTimeout(() => {
                
                  resultDiv.text("");
                }, 2000);

                  $(`.uacf7-form-${formId} input[type="submit"]`).on('click ', function (e) {e.preventDefault()});


              }  
            }
          }

      
          refreshButton.click(function (e) {
              e.preventDefault();
              uacf7_spam_protection.find("#rtn").val('');
              uacf7_generate_ramdom_numbers();
              predefined_flag = !predefined_flag;
        
          });

      

          validate.click(function (e) {
              e.preventDefault();
              validateCaptcha();
          });

         
        
        
  }); 

})(jQuery);


