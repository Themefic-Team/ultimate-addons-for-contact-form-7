(function($){

    var forms = $('.wpcf7-form'); 

    forms.each(function(){
        var formId     = $(this).find('input[name="_wpcf7"]').val();
        var uacf7_form = $('.uacf7-form-'+formId);
        var uacf7_mail = $(`.uacf7-form-${formId} input[type="email"]`);

       
        $(document).ready(function() {
            $(uacf7_form).submit(function(event) {
     
                var formSubmitTime = new Date().getTime();
                var timeTaken = formSubmitTime - window.performance.timing.navigationStart;
                if (timeTaken < 5000) { 
                    alert("Possible bot detected! Submission rejected.");
                    event.preventDefault(); 
                    return false;
                }
        
        
                // If no issues found, allow form submission
                return true;
            });
        });


        // Detect Wrong Mail Address

        // $(uacf7_mail).on('change', function (){

            $(document).ready(function() {
                var current_mail = $(this).val();
                function isValidEmail(email) {
                    return validator.isEmail(email);
                }

                const email = "test@exampl755e.com";
                if (isValidEmail(email)) {
                    console.log("Email is valid");
                } else {
                    console.log("Email is invalid");
                }

            
            // });

            });


            // Ban Enlisted IPs

            $(document).ready(function() {

                const bannedIPs = ['203.76.223.137', '10.0.0.2', '127.0.0.1'];
            
                $(uacf7_form).on('click', function(event) {

                    fetch('https://ipinfo.io/json')
                        .then(response => response.json())
                        .then(data => {
                            const userIPAddress = data.ip; 
                            console.log(userIPAddress)

                            if ($.inArray(userIPAddress, bannedIPs) !== -1) {
                                alert('Your IP address is banned from submitting this form.');
                                // event.preventDefault(); 
                            }
        
                        });              
                    
                    });
            
           
               

         


            
                


             

    
         

            });


    });
})(jQuery);

