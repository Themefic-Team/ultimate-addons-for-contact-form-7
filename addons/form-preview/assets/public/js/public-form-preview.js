(function ($) {
  $(document).ready(function () {

      var forms = $('.wpcf7-form');

          forms.each(function(){

            var formId = $(this).find('input[name="_wpcf7"]').val();
            var close_button = $('.uacf7-form-'+formId).find('.close-button');
            var popup = $('.uacf7-form-'+formId).find('.popup');

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

                  console.log(value_array);

                  var requestData = {
                    action: 'uacf7_form_preview_action',
                    input_names: name_array,
                    input_values: value_array
                  }
                 
                  $.ajax({
                    type: 'POST',
                    url: uacf7_form_preview_object.ajax_url, 
                    nonce: uacf7_form_preview_object.nonce,
                    data: requestData,
                    success: function(res) {
                      console.log(res)
                    }
                  
                  });
        
                  
                }
          
              });

               popup.css('display', 'block');

            });

        
          close_button.click(function (){
            popup.css('display', 'none');
          });
      });
  });

})(jQuery);