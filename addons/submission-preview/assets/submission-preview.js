jQuery(document).ready(function($) {
    $(document).on('click', '.uacf7-preview-btn', function(e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var formData = '';

        // Create a table to display the form data
        formData += '<table border="1" style="width: 100%; margin-top: 10px;">';
        formData += '<thead><tr><th>Label</th><th>Value</th></tr></thead><tbody>';

        // Iterate over all input fields (including text, email, radio buttons, checkboxes, textareas, select, etc.)
        form.find('input:not([type="hidden"]), textarea, select').each(function() {
            var field = $(this);
            var fieldId = field.attr('id');

            if($(this).parent().hasClass('quicktags-toolbar')){
                console.log($($this));
            }

            // Check for a label associated with the field
            var label = '';
            if (fieldId) {
                label = $('label[for="' + fieldId + '"]').text();
            }

            // If there's no label found via the 'for' attribute, try to get the label text from the parent or closest label
            if (!label && field.attr('type') !== 'submit') {
                if(field.is(':checkbox') || field.is(':radio')){
                    label = $(this).parent('label').parent('label').clone().children().remove().end().text().trim() || field.attr('name') || field.attr('id');
                }else{
                    label = $(this).closest('label').clone().children().remove().end().text().trim() || field.attr('name') || field.attr('id');
                }
            }

            fieldValue = field.val();

            // Skip fields that have a parent with the "quicktags-toolbar" class
            if (field.closest('.quicktags-toolbar').length > 0) {
                return true;
            }

            // If the field is a signature canvas, capture the canvas data
            if (field.closest('label').find('canvas').length) {
                var canvas = field.closest('label').find('canvas')[0];
                if (canvas && canvas.toDataURL) {
                    var canvasData = canvas.toDataURL();
                    fieldValue = '<img src="' + canvasData + '" alt="Signature" style="max-width: 300px; max-height: 100px;">'; 
                }
            }

            // Handle checkboxes
            if (field.is(':checkbox')) {
                var selectedValues = [];
                $(this).closest('label').find(':checkbox:checked').each(function() {
                    selectedValues.push($(this).closest('label').clone().children().remove().end().text().trim());
                });
                fieldValue = selectedValues.join(', ');  // Join the selected values
            }

            // Handle radio buttons
            if (field.is(':radio') && field.prop('checked')) {
                fieldValue = $(this).closest('label').clone().children().remove().end().text().trim();
            }

            // Only add fields that have a value, and exclude submit buttons
            if (fieldValue !== undefined && fieldValue !== "" && field.attr('type') !== 'submit') {
                formData += '<tr><td>' + label + '</td><td>' + fieldValue + '</td></tr>';
            }
        });

        formData += '</tbody></table>';

        // Create the modal HTML
        var modalHTML = '<div class="uacf7-preview-modal">' +
                            '<div class="uacf7-preview-modal-content">' +
                                '<span class="uacf7-close-btn">&times;</span>' +
                                '<h2>Form Preview</h2>' +
                                formData +
                                '<div class="uacf7-modal-buttons">' +
                                    '<button class="uacf7-back-btn"><i class="fas fa-undo"></i> Back</button>' +
                                    '<button class="uacf7-submit-btn">Submit <i class="far fa-paper-plane"></i></button>' +
                                '</div>' +
                            '</div>' +
                         '</div>';

        // Append the modal to the body
        $('body').append(modalHTML);

        // Show the modal
        $('.uacf7-preview-modal').fadeIn();

        // Close modal when clicking the close button
        $('.uacf7-close-btn, .uacf7-back-btn').on('click', function() {
            $('.uacf7-preview-modal').fadeOut(function() {
                $(this).remove();
            });
        });

        // "Submit" button functionality - submit the form
        $('.uacf7-submit-btn').on('click', function() {
            form.find('.wpuacf7-submit').click();
            $('.uacf7-preview-modal').fadeOut(function() {
                $(this).remove();
            });
        });

        // Close modal if user clicks outside the modal content
        $(window).on('click', function(event) {
            if ($(event.target).hasClass('uacf7-preview-modal')) {
                $('.uacf7-preview-modal').fadeOut(function() {
                    $(this).remove();
                });
            }
        });
    });
});
