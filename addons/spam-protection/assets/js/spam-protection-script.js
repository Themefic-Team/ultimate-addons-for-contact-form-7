;(function ($) {

    var forms = $('.wpcf7-form'); 
    forms.each(function(){
        var formId = $(this).find('input[name="_wpcf7"]').val();  
        var uacf7_spam_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation').val(); 

        
            
  }); 

});  