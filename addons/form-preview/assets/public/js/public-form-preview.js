(function ($) {
  $(document).ready(function () {

      var forms = $('.wpcf7-form');

          forms.each(function(){

            var formId = $(this).find('input[name="_wpcf7"]').val();
            var close_button = $('.uacf7-form-'+formId).find('.close-button');
            var popup = $('.uacf7-form-'+formId).find('.popup');
            var container = $('.uacf7-form-'+formId).find('#uacf7_form_values_container');
            var container_with_child = $('.uacf7-form-'+formId);

        
            var name_array = [];
            var value_array = [];
   
            $('.uacf7-form-'+formId).find('#uacf7_form_preview_button').click(function (){

              var form_div = $('.uacf7-form-'+formId).find('input');
              
        
               form_div.each(function (){

                var input_name = this.name;
                var input_value = this.value;
                var selected_name;
                var selected_value;
                if(this.type !== 'submit' && this.type !== 'button'){

                  if (this.type === 'radio') {
                    for (let i = 0; i < input_name.length; i++) {
                    if(input_name[i].checked){
                      console.log(input_value[i])
                    }
                  }
                }
                    name_array.push(input_name);
                    value_array.push(input_value);
                }

                // if(this.type === 'radio'){
                  
                // }
          
              });


               popup.css('display', 'block');


                for (let i = 0; i < name_array.length; i++) {
                    const listItem = $("<p class='input_class'>").text(`${name_array[i]}: ${value_array[i]}`);
                    container.append(listItem);
                }

            });

        //Closing the popup
          close_button.click(function (){
            popup.css('display', 'none');

            container.find('p').text('');
            paragraphCount = 0;
           
            // setTimeout(() => {
            //   $('.uacf7-form-'+formId).find('#uacf7_form_preview_button').trigger('click');
            // }, 2000);
        
          });
      });
  });

})(jQuery);