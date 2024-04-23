(function($) {

    // $(document).ready(function() {
    //     var uacf7_multistep_skin_wrapper_width = $('.tf-image-checkbox').width();
    //     alert(uacf7_multistep_skin_wrapper_width);
    // });
    
    function addLayer(parentLabel) {
        if (!parentLabel.find('.customize-layer').length) {

            var customizeLayer = $('<div class="customize-layer" style="margin-top: -120px; margin-left: 40%;"><button style="cursor:pointer;background:#382673;color:#ffffff;padding:5px;border-radius:3px;">Customize</button></div>');
            parentLabel.append(customizeLayer);

            customizeLayer.find('button').click(function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('label[for="uacf7_form_opt[progressbar_styling]"]').last().offset().top + $('label[for="uacf7_form_opt[progressbar_styling]"]').first().outerHeight() - $(window).height() + 500
                }, 1000);});
        }
    }

    $(document).ready(function() {
        $('.tf-image-radio-group input[type=radio]').each(function() {
            if ($(this).is(':checked')) {
                var parentLabel = $(this).parent();
                addLayer(parentLabel);
            }
        });

        $('.tf-image-radio-group input[type=radio]').change(function() {
            var parentLabel = $(this).parent();
            if ($(this).is(':checked')) {
                addLayer(parentLabel);
            }

            $('.tf-image-radio-group').find('.customize-layer').not($(this).parent().find('.customize-layer')).remove();
        });
    });

    })(jQuery);