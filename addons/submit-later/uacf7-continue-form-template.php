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

        <!-- Render the form -->
        <div class="uacf7-save-and-continue-temp-wrapper">
            <button class="ucaf7-submit-later-clear-data" data-unique-id='<?php echo esc_js($unique_id) ?>'> Clear Data </button>
        </div>

        <?php
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
        <?php
    } else {
        echo '<p>No saved form data found.</p>';
    }
} else {
    echo '<p>No unique ID provided.</p>';
}

// Include WordPress footer
get_footer();
?>
