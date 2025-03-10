(function ($) {
    $(document).ready(function () {
        // Listen for clicks on the button that opens the dialog
        $(document).on('click', '[data-taggen="open-dialog"]', function () {
            var targetDialogId = $(this).data('target'); // Get the target dialog ID
            var $dialog = $('#' + targetDialogId); // Find the dialog element
            // Check if the dialog is for the "conditional" tag
            if ($dialog.find('form[data-id="conditional"]').length > 0) {
                var $tagInput = $dialog.find('input[data-tag-part="tag"]');
                // If the tag doesn't already end with "[/conditional]", append it
                if ($tagInput.val() && !$tagInput.val().endsWith("[/conditional]")) {
                    $tagInput.val($tagInput.val() + "[/conditional]");
                }
            }
        });
    });
})(jQuery);