<?php
/*
Template Name: Continue Form Template
*/

// Include WordPress header
get_header();

// Get the unique ID from the URL
$unique_id = isset($_GET['uid']) ? sanitize_text_field($_GET['uid']) : '';

// Load the saved form data based on the unique ID from the database
if (!empty($unique_id)) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'uacf7_save_and_continue';
    $saved_data = $wpdb->get_row($wpdb->prepare("SELECT form_id, form_data FROM $table_name WHERE unique_id = %s", $unique_id), ARRAY_A);
    if ($saved_data) {
        $form_id = $saved_data['form_id'];
        $form_data = json_decode($saved_data['form_data'], true);
        $submit_later = uacf7_get_form_option( $form_id, 'submit_later' );

        // Generate the Contact Form 7 shortcode
        $shortcode = '[contact-form-7 id="' . $form_id . '" title="Contact Form" html_id="continue-form"]'; 
        ?>

        <!-- Confirm Popup Starts -->
        <div id="uacf7-save-continue-temp-popup" class="popup">
            <div class="popup-content">
                <p>Are you sure you want to delete this form data?</p>
                <button id="uacf7-save-continue-temp-popup-confirm">Yes</button>
                <button id="uacf7-save-continue-temp-popup-cancel">No</button>
            </div>
        </div>
        <div id="ucaf7-save-continue-temp-overlay"></div>
        <!-- Confirm Popup Ends-->

        <!-- Render the form -->
        <div class="uacf7-save-and-continue-temp-wrapper">
            <div class="ucaf7-save-and-continue-user-action">
                <h2 class="ucaf7-submit-later-clear-data-notice">Note: This link will expire after 30 days or You can delete by yourself</h2>
                <button class="ucaf7-submit-later-clear-data" data-unique-id='<?php echo esc_js($unique_id) ?>'><i class="fa-solid fa-trash"></i> Clear Data </button>
            </div>

            <?php
            echo '<div class="uacf7-save-and-continue-form-rerender"';
            echo do_shortcode($shortcode);

            // Add pre-filled values to form fields using JavaScript
            ?>
            <script>
                jQuery(document).ready(function($) {
                    var formData = <?php echo json_encode($form_data); ?>;
                    $.each(formData, function(key, value) {
                        var field = $('[name="' + key + '"]');
                        if (field.length) {
                            field.val(value);
                        }
                    });

                    
                });
            </script>
        </div>
        <?php
    } else { ?>
        <div class="uacf7-save-and-continue-deadlink">
            <h2>This link seems to be wrong, either the link is dead or there is no data found for this link !</h2>
        </div>
    <?php
        
    }
} else {
    ?>
    <div class="uacf7-save-and-continue-deadlink">
        <h2>This link seems to be wrong, either the link is dead or there is no data found for this link !</h2>
    </div>
<?php
}

// Include WordPress footer
get_footer();
?>
