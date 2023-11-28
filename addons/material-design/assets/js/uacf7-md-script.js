$(document).ready(function() {


    // on focus
	$(".wpcf7-form .inputText").focus(function() {
    $(this).parent().siblings('label').addClass('has-value');
  })
  // blur input fields on unfocus + if has no value
  .blur(function() {
    var text_val = $(this).val();
    if(text_val === "") {
      $(this).parent().siblings('label').removeClass('has-value');
    }
  });
  });






