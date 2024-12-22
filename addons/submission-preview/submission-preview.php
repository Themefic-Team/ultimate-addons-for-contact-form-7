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




