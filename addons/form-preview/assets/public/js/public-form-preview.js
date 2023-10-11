(function ($) {
  $(document).ready(function () {

      var forms = $('.wpcf7-form');

          forms.each(function(){

            var formId = $(this).find('input[name="_wpcf7"]').val();
            var close_button = $('.uacf7-form-'+formId).find('.close-button');
            var popup = $('.uacf7-form-'+formId).find('.popup');
            var container = $('.uacf7-form-'+formId).find('#uacf7_form_values_container');

            
            
            
            
            function creating_element_for_preview(){
              
              var uacf7_form_data = $('.uacf7-form-'+formId).closest('.wpcf7-form').serialize();

              const keyValuePairs = uacf7_form_data.split('&');

              var file_name = $('.uacf7-form-'+formId).find('input');

              var file_obj = {};

              file_name.each(function(){

                if(this.type === 'file'){
                  var value = this.value;
                  var name = this.name;
                  file_obj[name] = value;
                }
              });






              const dataObject = {};

              $.each(keyValuePairs, function(index, pair) {
                const [key, value] = pair.split('=');
                
                const decodedValue = decodeURIComponent(value);
                
                if (dataObject[key]) {
                  if (Array.isArray(dataObject[key])) {
                    dataObject[key].push(decodedValue);
                  } else {
                    dataObject[key] = [dataObject[key], decodedValue];
                  }
                } else {
                  dataObject[key] = decodedValue;
                }
              });


              var keysToRemove = [
                "_wpcf7",
                "_wpcf7_version",
                "_wpcf7_locale",
                "_wpcf7_unit_tag",
                "_wpcf7_container_post",
                "_wpcf7_posted_data_hash",
                "_uacf7_hidden_conditional_fields"
              ];

              $.each(dataObject, function(key, value) {
                if (keysToRemove.indexOf(key) !== -1) {
                  // Use the delete operator to remove the key-value pair
                  delete dataObject[key];
                }

                if (value === undefined || value === '') {
                  delete dataObject[key];
                }
              });



              
              var others_field_obj = {
                ...file_obj,
                ...dataObject
              };

              console.log(others_field_obj)

              $.each(others_field_obj, function(key, value) {
                var paragraph = $('<p></p>');
                paragraph.text(key + ': ' + value);
                container.append(paragraph);
          
              });




              popup.css('display', 'block');




            }


            // Show Preview

            $('.uacf7-form-'+formId).find('#uacf7_form_preview_button').click(function (){
              creating_element_for_preview();
            });


            //Closing Preview

              close_button.click(function (e){
                e.preventDefault();
                popup.css('display', 'none');

                container.html('');
                listItem = [];
          
              });


              //Processing Image for Popup Preview

        
        
        
        
        
        
          });
  });

})(jQuery);