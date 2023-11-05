(function($){

        var forms = $('.wpcf7-form'); 
        forms.each(function(){
        var formId   = $(this).find('input[name="_wpcf7"]').val();
        var form_div = $(this).find('.uacf7-form-'+formId);

        console.log(form_div)


        const captchaCodes = [];

        function generateRandomString(length) {
            const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%&'()*+,-./:;< = >?@[\]^_`{|}~'";
            let   result     = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }
        
        for (let i = 0; i < 50; i++) {
            const code = generateRandomString(6);
            captchaCodes.push(code);
        }

        function generateCaptcha() {
            const randomIndex = Math.floor(Math.random() * captchaCodes.length);
            const captcha     = captchaCodes[randomIndex];

            // document.getElementById("captcha").innerText = captcha;
            form_div.find("#captcha").text(captcha);
        }

        function validateCaptcha() {
            const userInput = form_div.find("#userInput").val();
            const captcha   = form_div.find("#captcha").text();
            const resultDiv = form_div.find("#result");
            
            if (userInput === captcha) {
                resultDiv.text("CAPTCHA validated successfully!");
            } else {
                resultDiv.text("CAPTCHA validation failed. Please try again.");
            }
        }
        
        const refreshButton = form_div.find("#refresh");
        refreshButton.click(function () {
            generateCaptcha();
        });
        generateCaptcha();

    }); 

})(jQuery);

