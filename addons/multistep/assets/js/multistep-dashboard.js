// (function($) {
//     function addLayer(parentLabel) {
//         parentLabel.find('.tooltiptext').css('visibility', 'visible').css('opacity', '1');
//         if (!parentLabel.find('.customize-layer').length) {
//             var customizeLayer = $('<div class="customize-layer"><button>Customize</button></div>');
//             parentLabel.append(customizeLayer);
//         }
//     }


//     $(document).ready(function() {
//         $('input[type=radio]').change(function() {
//             var parentLabel = $(this).parent();
//             if ($(this).is(':checked')) {
//                 addLayer(parentLabel);
//             }
            
//             if($(this).not(':checked')){
//                 // $(this).remove();
//             }
//         });
//     });
// })(jQuery);
