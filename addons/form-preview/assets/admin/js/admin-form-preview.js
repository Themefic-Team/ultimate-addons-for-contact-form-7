;(function ($) {

        $(document).ready(function () {
        
            $('.ucaf7-form-preview-layout').each( function () {
         
                $(this).on('click', function (e) {
                    e.preventDefault();
                    var customText = '<button id="uacf7-preview-btn"> Preview </button>';
                    copyToClipboard(customText);
                });
                
                function copyToClipboard(text) {
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(text).select();
                    document.execCommand("copy");
                    $temp.remove();
                }
                
                
            });  
        });            

})(jQuery);