// ;(function ($) {

//     $(document).ready(function () {
    
//         $('.ucaf7-save-and-continue-layout-wrapper').each( function () {
     
//             $('.ucaf7-save-and-continue-layout').on('click', function (e) {
//                 e.preventDefault();
//                 var customText = '<input type="submit" class="uacf7-save-and-continue" value="Save and Continue" />';
//                 copyToClipboard(customText);

//                 $(this).text('Copied to Clipboard !');
//                 setTimeout(() => {
//                     $(this).text('Copy Layout');
//                 }, 3000);
//             });
            
//             function copyToClipboard(text) {
//                 var $temp = $("<input>");
//                 $("body").append($temp);
//                 $temp.val(text).select();
//                 document.execCommand("copy");
//                 $temp.remove();
//             }   
            
//         });  
//     });            

// })(jQuery);