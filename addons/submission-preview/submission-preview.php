<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
* Init form submission preview
*/
add_action( 'init', 'uacf7_form_submission_preview_init' );
function uacf7_form_submission_preview_init(){
    
    //Register text domain
    load_plugin_textdomain( 'ultimate-form-submission-preview', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
     
    // enqueue scripts
	add_action( 'wp_enqueue_scripts', 'uacf7_submission_preview_scripts' );

    add_filter( 'wpcf7_form_elements', 'add_preview_button_to_cf7_form' );
    
}

/*
* enqueue scripts
*/
function uacf7_submission_preview_scripts() {

    wp_enqueue_style( 'uacf7-form-submission-preview', plugin_dir_url( __FILE__ ) . 'assets/submission-preview.css' );
    wp_enqueue_script( 'uacf7-form-submission-preview', plugin_dir_url( __FILE__ ) . 'assets/submission-preview.js', array('jquery'), null, true );

    wp_localize_script( 'uacf7-form-submission-preview', 'submission_preview', [ 
        "ajaxurl" => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'uacf7-form-submission-preview-nonce' ),
    ] );
}

function add_preview_button_to_cf7_form( $form ) {

    $contact_form = WPCF7_ContactForm::get_current();

    $form_id = $contact_form->id(); 
    
    $uacf7_preview_settings = uacf7_get_form_option( $form_id, 'form_submission_preview' );
    
    $uacf7_preview_enable = isset( $uacf7_preview_settings['enable_form_submission_preview'] ) ? $uacf7_preview_settings['enable_form_submission_preview'] : '';

    if($uacf7_preview_enable){
        $form = preg_replace('/(<input[^>]+type="submit"[^>]+>)/', '$0 <button type="button" class="uacf7-preview-btn">Preview</button>', $form);
    }

    return $form;
} 

function uacf7_post_meta_options_form_submission_preview( $value, $post_id){

    $post_submission = apply_filters('uacf7_post_meta_options_form_submission_preview_pro', $data = array(
        'title'  => __( 'Form Submission Preview', 'ultimate-addons-cf7' ),
        'icon'   => 'fa-solid fa-magnifying-glass',
        'checked_field'   => 'enable_form_submission_preview',
        'fields' => array( 
            'uacf7_form_submission_preview_label' => array(
                'id'    => 'uacf7_form_submission_preview_label',
                'type'  => 'heading', 
                'label' => __( 'Form Submission Preview', 'ultimate-addons-cf7' ),
                'subtitle' => sprintf(
                    __( 'Check preview of form filled data before submit.  See Demo %1s.', 'ultimate-addons-cf7' ),
                     '<a href="https://cf7addons.com/preview/contact-form-7-to-post-type/" target="_blank" rel="noopener">Example</a>'
                              )
                  ),
            'uacf7_form_submission_preview_docs' => array(
                'id'      => 'form_submission_preview_docs',
                'type'    => 'notice',
                'style'   => 'success',
                'content' => sprintf( 
                    __( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                    '<a href="https://themefic.com/docs/uacf7/pro-addons/contact-form-7-to-post-type/" target="_blank" rel="noopener">Form Submission Preview</a>'
                )
            ),
            'enable_form_submission_preview' => array(
                'id'        => 'enable_form_submission_preview',
                'type'      => 'switch',
                'label'     => __( 'Enable Form Submission Preview', 'ultimate-addons-cf7' ),
                'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
                'label_off' => __( 'No', 'ultimate-addons-cf7' ),
                'default'   => false,
                'field_width' => 100,
            )
        ),
            

    ), $post_id);

    $value['form_submission_preview'] = $post_submission; 
    return $value;
}  
add_filter( 'uacf7_post_meta_options', 'uacf7_post_meta_options_form_submission_preview', 16, 2 );


// Action hook for the AJAX request
add_action('wp_ajax_cf7_form_preview', 'handle_cf7_form_preview');
add_action('wp_ajax_nopriv_cf7_form_preview', 'handle_cf7_form_preview');

function handle_cf7_form_preview() {

    // Validate nonce
    if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'uacf7-form-submission-preview-nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce'));
        return;
    }

    // Proceed with form processing if nonce is valid
    if (!isset($_POST) || empty($_POST)) {
        wp_send_json_error(array('message' => 'No data received'));
        return;
    }

    // Prepare output for displaying user input
    $output = '<h3>Form Data Preview:</h3>';
    $output .= '<table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">';
    $output .= '<thead><tr><th>Field Label</th><th>Value</th></tr></thead><tbody>';

    // Loop through POST data
    foreach ($_POST as $key => $value) {
        // Skip fields that are typically not visible (e.g., hidden fields, action, security, etc.)
        if (in_array($key, ['action', 'security']) || strpos($key, 'wpcf7') !== false || strpos($key, 'uacf7') !== false) {
            continue;
        }

        // Check if the field has a value (i.e., user filled it)
        if (!empty($value)) {
            // Try to get the label for the input field
            $label = get_field_label($key);

            // Handle multi-file inputs
            if (is_array($value)) {
                foreach ($value as $file) {
                    $output .= '<tr><td><strong>' . esc_html($label) . ':</strong></td><td>' . esc_html($file) . '</td></tr>';
                }
            } else {
                $output .= '<tr><td><strong>' . esc_html($label) . ':</strong></td><td>' . esc_html($value) . '</td></tr>';
            }
        }
    }

    $output .= '</tbody></table>';

    // Process file uploads if any
    if (!empty($_FILES)) {
        $output .= '<h3>File Previews:</h3>';
        foreach ($_FILES as $fileKey => $fileInfo) {
            $output .= '<p><strong>' . esc_html($fileKey) . ':</strong><br>';
            if (isset($fileInfo['tmp_name']) && file_exists($fileInfo['tmp_name'])) {
                $fileType = wp_check_filetype($fileInfo['name']);
                if (in_array($fileType['ext'], ['jpg', 'jpeg', 'png', 'gif'])) {
                    $imageUrl = wp_get_attachment_url(wp_upload_bits($fileInfo['name'], null, file_get_contents($fileInfo['tmp_name']))['file']);
                    $output .= '<img src="' . esc_url($imageUrl) . '" alt="' . esc_attr($fileInfo['name']) . '" style="max-width: 200px; margin-top: 10px;" data-info="'. json_encode($fileInfo) .'">';
                } else {
                    $output .= '<a href="' . esc_url(wp_get_attachment_url(wp_upload_bits($fileInfo['name'], null, file_get_contents($fileInfo['tmp_name']))['file'])) . '">' . esc_html($fileInfo['name']) . '</a>';
                }
            }
            $output .= '</p>';
        }
    }

    // Return the preview as HTML
    wp_send_json_success($output);
}

// Helper function to get the field label
function get_field_label($field_name) {
    // Get the CF7 form by its ID or title
    $form_id = '';
    $form = WPCF7_ContactForm::get_instance($form_id);

    // If form exists
    if ($form) {
        // Retrieve form fields from form HTML
        $form_html = $form->get_form();

        // Skip hidden fields by using a regular expression to check if 'type="hidden"' is not present
        if (strpos($form_html, 'type="hidden"') === false) {

            // Use regex to find the label corresponding to the field name
            preg_match('/<label[^>]*for=["\']' . preg_quote($field_name, '/') . '["\'][^>]*>(.*?)<\/label>/', $form_html, $matches);
            
            // If label found, return it, otherwise, use a fallback
            if (isset($matches[1]) && !empty($matches[1])) {
                return $matches[1];
            } else {
                // Attempt to use the placeholder or name attribute as the fallback
                $label = get_field_placeholder($form_html, $field_name);
                return $label ? $label : ucfirst(str_replace('_', ' ', $field_name));
            }
        }
    }

    // If form doesn't exist or label is not found, return a formatted version of the field name
    return ucfirst(str_replace('_', ' ', $field_name));
}

// Helper function to get the field's placeholder (or fallback to name)
function get_field_placeholder($form_html, $field_name) {
    preg_match('/<input[^>]*name=["\']' . preg_quote($field_name, '/') . '["\'][^>]*placeholder=["\'](.*?)["\']/i', $form_html, $matches);
    if (!empty($matches[1])) {
        return $matches[1];
    }

    // Fallback: use name attribute
    preg_match('/<input[^>]*name=["\']' . preg_quote($field_name, '/') . '["\'][^>]*>/i', $form_html, $matches);
    if (!empty($matches[0])) {
        return ucfirst(str_replace('_', ' ', $field_name));
    }

    return '';  // Return empty if nothing found
}



