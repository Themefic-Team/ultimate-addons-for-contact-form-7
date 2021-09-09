; (function ($) {
  'use strict';
  $(document).ready(function () {

    var handle = $(".uacf7-slider-handle").data("handle");
    var min = $(".uacf7-slider-handle").data("min");
    var max = $(".uacf7-slider-handle").data("max");
    var def = $(".uacf7-slider-handle").data("default");

    if (handle == 1) {

      var slider = document.getElementById("range");
      var output = document.getElementById("value");
      output.innerHTML = slider.value; // Display the default slider value

      // Update the current slider value (each time you drag the slider handle)
      slider.oninput = function () {
        output.innerHTML = this.value;
      }

    } else if (handle == 2) {
      $("#slider-range").slider({
        range: true,
        min: min,
        max: max,
        values: [min, def],
        slide: function (event, ui) {
          $("#amount").val(ui.values[0] + " - " + ui.values[1]);
          $(".amount").html(ui.values[0] + " - " + ui.values[1]);
        }
      });
      $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
      $(".amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));

    }
  })
})(jQuery);