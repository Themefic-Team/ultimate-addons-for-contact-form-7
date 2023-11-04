(function($){

    var forms = $('.wpcf7-form'); 
    forms.each(function(){
        var formId = $(this).find('input[name="_wpcf7"]').val();  
        var code;

        var uacf7_image_protection = $('.uacf7-form-'+formId).find('.uacf7_spam_recognation').find('#image_recognation'); 
        function createCaptcha() {
        uacf7_image_protection.find('#captcha').empty();
        var charsArray = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
        var lengthOtp = 6;
        var captcha = [];

        for (var i = 0; i < lengthOtp; i++) {
            var index = Math.floor(Math.random() * charsArray.length);
            if (captcha.indexOf(charsArray[index]) === -1) {
            captcha.push(charsArray[index]);
            } else {
            i--;
            }
        }

        var canv = $('<canvas>', { id: 'captcha', width: 100, height: 50 });
        var ctx = canv[0].getContext('2d');
        // Fill and stroke styles
        ctx.fillStyle = "#FF0000"; // Red fill color
        ctx.strokeStyle = "#00FF00"; // Green stroke color
        ctx.lineWidth = 2; // Stroke width

        // Line styles
        ctx.lineCap = "round";
        ctx.lineJoin = "bevel";
        ctx.miterLimit = 5;

        // Transparency
        ctx.globalAlpha = 0.8;

        // Font style
        ctx.font = "italic bold 100px Arial";

        // Text alignment and baseline
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";

        // Shadow style
        ctx.shadowColor = "rgba(0, 0, 0, 0.5)";
        ctx.shadowBlur = 5;
        ctx.shadowOffsetX = 2;
        ctx.shadowOffsetY = 2;




        ctx.strokeText(captcha.join(''), 0, 30);
        code = captcha.join('');
        $('#captcha').append(canv);
        }

        $(document).ready(function () {
        createCaptcha();

        uacf7_image_protection.find('#validateButton').on('click', function (event) {
            event.preventDefault();
            if ($('#captchaTextBox').val() === code) {
            alert('Valid Captcha');
            } else {
            alert('Invalid Captcha. Try Again');
            createCaptcha();
            }
        });
        });

}); 

})(jQuery);

