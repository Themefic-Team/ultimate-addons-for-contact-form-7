(function($){

        var forms = $('.wpcf7-form'); 
        forms.each(function(){
        var   formId       = $(this).find('input[name="_wpcf7"]').val();


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

            document.getElementById("captcha").innerText = captcha;
        }

        function validateCaptcha() {
            const userInput = document.getElementById("userInput").value;
            const captcha   = document.getElementById("captcha").innerText;

            const resultDiv = document.getElementById("result");

            if (userInput === captcha) {
                resultDiv.innerText = "CAPTCHA validated successfully!";
            } else {
                resultDiv.innerText = "CAPTCHA validation failed. Please try again.";
            }
        }

        generateCaptcha();

    }); 

})(jQuery);

