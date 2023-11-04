(function($){

    var forms = $('.wpcf7-form'); 
    forms.each(function(){
        var formId = $(this).find('input[name="_wpcf7"]').val();  
var code;

function createCaptcha() {
  $('#captcha').empty();
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
  ctx.font = '25px Georgia';
  ctx.strokeText(captcha.join(''), 0, 30);
  code = captcha.join('');
  $('#captcha').append(canv);
}

$(document).ready(function () {
  createCaptcha();

  $('#validateButton').on('click', function (event) {
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
