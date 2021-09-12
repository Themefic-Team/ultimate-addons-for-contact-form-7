; (function ($) {
    jQuery(document).ready(function ($) {
        $('.uacf7-color-picker').wpColorPicker({
            change: function(event,ui){
                var bgcolor = ui.color.toString();
                $(this).val(bgcolor);
                $(this).val(bgcolor);
            }
        });
    });
})(jQuery);