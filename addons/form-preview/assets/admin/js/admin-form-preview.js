;(function ($) {

        $(document).ready(function () {
        
            $('.ucaf7-form-preview-layout').each( function () {
                $(this).css('marginTop', '10px');
                $(this).hover(function () {
                    $(this).css('cursor', 'pointer');
                });
         
                $(this).on('click', function (e) {
                    e.preventDefault();
                    var customText = '<button id="uacf7-preview-btn"> Preview </button>';
                    copyToClipboard(customText);

                    $(this).text('Copied to Clipboard !');
                    setTimeout(() => {
                        $(this).text('Copy Layout');
                    }, 3000);
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