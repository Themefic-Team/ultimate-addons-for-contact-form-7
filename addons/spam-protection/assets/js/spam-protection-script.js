(function($){

    var forms = $('.wpcf7-form'); 
    forms.each(function(){
        var formId                = $(this).find('input[name="_wpcf7"]').val();
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation');
        var first_random_number   = Math.random() * 10;
        var second_random_number  = Math.random() * 10;


        function uacf7_generate_ramdom_numbers(){
          uacf7_spam_protection.find('#arithmathic_recognation').find('#frn').text(Math.ceil(first_random_number));
          uacf7_spam_protection.find('#arithmathic_recognation').find('#srn').text(Math.ceil(second_random_number));
        }
        uacf7_generate_ramdom_numbers();
        
        var first_number      = uacf7_spam_protection.find('#arithmathic_recognation').find('#frn').text();
        var first_number_int  = parseInt(first_number);
        var second_number     = uacf7_spam_protection.find('#arithmathic_recognation').find('#srn').text();
        var second_number_int = parseInt(second_number);
        
        var total_number = first_number_int + second_number_int;
        
        // $(this).on( 'wpcf7submit', function( event ) {
        //   // var total_number_usergiven = uacf7_spam_protection.find('#arithmathic_recognation').find('#rtn').val();
        //   // if(total_number_usergiven == total_number){
        //   //   uacf7_generate_ramdom_numbers(); 
        //   // }
        //   // Set wpcf7submit to false to prevent the form submission
        //   event.preventDefault();
        // }, false);  
            

        $(this).on('wpcf7mailsent', '.wpcf7-form', function(event) {
          // Disable the submit button
          event.preventDefault();
      }, false);
  }); 

})(jQuery);


