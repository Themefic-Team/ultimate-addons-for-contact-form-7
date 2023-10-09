(function ($) {
  $(document).ready(function () {

      var forms = $('.wpcf7-form');

          forms.each(function(){

            var formId = $(this).find('input[name="_wpcf7"]').val();
            var close_button = $('.uacf7-form-'+formId).find('.close-button');
            var popup = $('.uacf7-form-'+formId).find('.popup');
            var container = $('.uacf7-form-'+formId).find('#uacf7_form_values_container');
            var container_with_child = $('.uacf7-form-'+formId).find('#uacf7_form_values_container').find('p');

            
            
            
            
            function creating_element_for_preview(){
              
              var uacf7_form_data = $('.uacf7-form-'+formId).closest('.wpcf7-form').serialize();

              var parsedData = {};
              $.each(uacf7_form_data.split('&'), function(index, item) {
                  var keyValue = item.split('=');
                  var key = decodeURIComponent(keyValue[0]);
                  var value = decodeURIComponent(keyValue[1]);
                  parsedData[key] = value;
              });

              var keysToRemove = [
                "_wpcf7",
                "_wpcf7_version",
                "_wpcf7_locale",
                "_wpcf7_unit_tag",
                "_wpcf7_container_post",
                "_wpcf7_posted_data_hash"
              ];

              $.each(parsedData, function(key, value) {
                if (keysToRemove.indexOf(key) !== -1) {
                  // Use the delete operator to remove the key-value pair
                  delete parsedData[key];
                }
              });


              $.each(parsedData, function(key, value) {
                var paragraph = $('<p></p>');
                paragraph.text(key + ': ' + value);
                container.append(paragraph);
          
              });

             
              
              console.log(parsedData);





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