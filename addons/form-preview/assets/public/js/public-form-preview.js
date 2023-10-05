(function ($) {
  $(document).ready(function () {

      var forms = $('.wpcf7-form');

          forms.each(function(){

            var formId = $(this).find('input[name="_wpcf7"]').val();
            var close_button = $('.uacf7-form-'+formId).find('.close-button');
            var popup = $('.uacf7-form-'+formId).find('.popup');

            var hiid = $('.uacf7-form-'+formId).find('#hiid');
            var itemname = $('.uacf7-form-'+formId).find('#itemname');
            var itemvalue = $('.uacf7-form-'+formId).find('#itemvalue');
   
            $('.uacf7-form-'+formId).find('#uacf7_form_preview_button').click(function (){

              var form_div = $('.uacf7-form-'+formId).find('input');
              
        
               form_div.each(function (){

                var input_name = this.name;
                var input_value = this.value;
                if(this.type !== 'submit' && this.type !== 'button'){
                  var name_array = [];
                  var value_array = [];
                  name_array.push(input_name);
                  value_array.push(input_value);

                  console.log(name_array)
                  
                }
          
              });

               popup.css('display', 'block');

            });

        
          close_button.click(function (){
            // popup.addClass('hideClass');
            popup.css('display', 'none');
          });
      });
  });

})(jQuery);