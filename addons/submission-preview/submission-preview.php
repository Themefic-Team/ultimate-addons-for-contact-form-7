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
    
    $uacf7_preview_enable = isset( $uacf7_preview_settings['uacf7_enable_form_submission_preview'] ) ? $uacf7_preview_settings['uacf7_enable_form_submission_preview'] : '';

    if($uacf7_preview_enable){
        $form = preg_replace('/(<input[^>]+type="submit"[^>]+>)/', '$0 <button type="button" class="uacf7-preview-btn">Preview</button>', $form);
    }

    return $form;
} 

function uacf7_post_meta_options_form_submission_preview( $value, $post_id){

    $post_submission = apply_filters('uacf7_post_meta_options_form_submission_preview_pro', $data = array(
        'title'         => __( 'Form Submission Preview', 'ultimate-addons-cf7' ),
        'icon'          => 'fa-solid fa-magnifying-glass',
        'checked_field' => 'enable_form_submission_preview',
        'fields'        => array( 
            'uacf7_form_submission_preview_label' => array(
                'id'       => 'uacf7_form_submission_preview_label',
                'type'     => 'heading',
                'label'    => __( 'Form Submission Preview', 'ultimate-addons-cf7' ),
                'subtitle' => sprintf(
                    __( 'Check preview of form filled data before submit.  See Demo %1s.', 'ultimate-addons-cf7' ),
                     '<a href="https://cf7addons.com/preview/contact-form-7-to-post-type/" target="_blank" rel="noopener">Example</a>'
                              )
                  ),
            'uacf7_form_submission_preview_docs' => array(
                'id'      => 'uacf7_form_submission_preview_docs',
                'type'    => 'notice',
                'style'   => 'success',
                'content' => sprintf( 
                    __( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                    '<a href="https://themefic.com/docs/uacf7/pro-addons/contact-form-7-to-post-type/" target="_blank" rel="noopener">Form Submission Preview</a>'
                )
            ),
            'uacf7_enable_form_submission_preview' => array(
                'id'          => 'uacf7_enable_form_submission_preview',
                'type'        => 'switch',
                'label'       => __( 'Enable Form Submission Preview', 'ultimate-addons-cf7' ),
                'label_on'    => __( 'Yes', 'ultimate-addons-cf7' ),
                'label_off'   => __( 'No', 'ultimate-addons-cf7' ),
                'default'     => false,
                'field_width' => 100,
            ),
            'uacf7_form_submission_preview_style_heading' => array(
                'id'       => 'uacf7_form_submission_preview_style_heading',
                'type'     => 'heading',
                'label'    => __( 'Preview Button Styler', 'ultimate-addons-cf7' ),
                'subtitle' => __(' All modifications in this section are applicable to the "Preview Button" of the form. ', 'ultimate-addons-cf7'),
            ),
            'uacf7_form_submission_preview_button_font_size' => array(
                'id'          => 'uacf7_form_submission_preview_button_font_size',
                'type'        => 'number',
                'label'       => __( 'Font Size', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_button_padding_tb' => array(
                'id'          => 'uacf7_form_submission_preview_button_padding_tb',
                'type'        => 'number',
                'label'       => __( ' Padding ( Top - Bottom )', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_button_padding_lr' => array(
                'id'          => 'uacf7_form_submission_preview_button_padding_lr',
                'type'        => 'number',
                'label'       => __( ' Padding ( Left - Right )', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_button_border_radius' => array(
                'id'          => 'uacf7_form_submission_preview_button_border_radius',
                'type'        => 'number',
                'label'       => __( ' Border Radius', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 50 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'is_pro'      => true,
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_button_color_options' => array(
                'id'       => 'uacf7_form_submission_preview_button_color_options',
                'type'     => 'color',
                'label'    => __( 'Color Options', 'ultimate-addons-cf7' ),
                'class'    => 'tf-field-class',
                'multiple' => true,
                'inline'   => true,
                'colors'   => array(
                    'uacf7_form_submission_preview_button_bg' => ' Background Color',
                    'uacf7_form_submission_preview_button_color' => ' Font Color',
                    'uacf7_form_submission_preview_button_border_color' => ' Border Color',
                    'uacf7_form_submission_preview_button_hover_bg' => 'Hover Background Color',
                    'uacf7_form_submission_preview_button_hover_color' => 'Hover Font Color',
                    'uacf7_form_submission_preview_button_border_hover_color' => 'Hover Border Color',
                ),
                'is_pro' => true,
            ),

            'uacf7_form_submission_preview_modal_heading' => array(
                'id'       => 'uacf7_form_submission_preview_modal_heading',
                'type'     => 'heading',
                'label'    => __( 'Preview Modal Heading Styler', 'ultimate-addons-cf7' ),
                'subtitle' => __(' All modifications in this section are applicable to the "Preview modal heading" of the form. ', 'ultimate-addons-cf7'),
            ),
            'uacf7_form_submission_preview_modal_heading_font_size' => array(
                'id'          => 'uacf7_form_submission_preview_modal_heading_font_size',
                'type'        => 'number',
                'label'       => __( 'Heading Font Size', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 50,
            ),
            'uacf7_form_submisssion_preview_modal_heading_alignment' => array(
                'id'          => 'uacf7_form_submisssion_preview_modal_heading_alignment',
                'type'        => 'select',
                'label'       => __( 'Heading Alignment', 'ultimate-addons-cf7' ),
                'field_width' => 50,
                'is_pro'      => true,
                'options'     => array(
                    'default' => 'Default',
                    'left'    => 'Left',
                    'right'   => 'Right',
                    'center'  => 'Center'
                ),
            ),
            'uacf7_submisssion_preview_modal_heading_color_option' => array(
                'id'       => 'uacf7_submisssion_preview_modal_heading_color_option',
                'type'     => 'color',
                'label'    => __( 'Color Options', 'ultimate-addons-cf7' ),
                'class'    => 'tf-field-class',
                'multiple' => true,
                'inline'   => true,
                'colors'   => array(
                    'uacf7_preview_modal_color' => ' Font Color',
                ),
                'is_pro' => true,
            ),

            'uacf7_form_submission_preview_style_modal_heading' => array(
                'id'       => 'uacf7_form_submission_preview_style_modal_heading',
                'type'     => 'heading',
                'label'    => __( 'Preview Modal Styler', 'ultimate-addons-cf7' ),
                'subtitle' => __(' All modifications in this section are applicable to the "Preview Modal" of the form. ', 'ultimate-addons-cf7'),
            ),
            'uacf7_form_submission_preview_table_font_size' => array(
                'id'          => 'uacf7_form_submission_preview_table_font_size',
                'type'        => 'number',
                'label'       => __( 'Font Size', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_modal_padding_tb' => array(
                'id'          => 'uacf7_form_submission_preview_modal_padding_tb',
                'type'        => 'number',
                'label'       => __( ' Padding ( Top - Bottom )', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_modal_padding_lr' => array(
                'id'          => 'uacf7_form_submission_preview_modal_padding_lr',
                'type'        => 'number',
                'label'       => __( ' Padding ( Left - Right )', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_modal_border_radius' => array(
                'id'          => 'uacf7_form_submission_preview_modal_border_radius',
                'type'        => 'number',
                'label'       => __( ' Border Radius', 'ultimate-addons-cf7' ),
                'is_pro'      => true,
                'field_width' => 25,
            ),
            'uacf7_form_submission_preview_modal_color_option' => array(
                'id'       => 'uacf7_form_submission_preview_modal_color_option',
                'type'     => 'color',
                'label'    => __( 'Color Options', 'ultimate-addons-cf7' ),
                'class'    => 'tf-field-class',
                'multiple' => true,
                'inline'   => true,
                'colors'   => array(
                    'uacf7_submission_preview_modal_bg' => ' Background Color',
                    'uacf7_submission_preview_modal_color' => ' Font Color',
                    'uacf7_submission_preview_modal_border_color' => ' Border Color',
                    'uacf7_submission_preview_modal_hover_bg' => 'Hover Background Color',
                    'uacf7_submission_preview_modal_hover_color' => 'Hover Font Color',
                    'uacf7_submission_preview_modal_border_hover_color' => 'Hover Border Color',
                ),
                'is_pro' => true,
            ),

            'uacf7_submission_preview_modal_submit_button_heading' => array(
                'id'       => 'uacf7_submission_preview_modal_submit_button_heading',
                'type'     => 'heading',
                'label'    => __( 'Preview Modal Submit Button Styler', 'ultimate-addons-cf7' ),
                'subtitle' => __(' All modifications in this section are applicable to the "Preview modal Submit Button" of the form. ', 'ultimate-addons-cf7'),
            ),
            'uacf7_submission_preview_modal_submit_button_font_size' => array(
                'id'          => 'uacf7_submission_preview_modal_submit_button_font_size',
                'type'        => 'number',
                'label'       => __( 'Button Font Size', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_submission_preview_modal_submit_button_padding_tb' => array(
                'id'          => 'uacf7_submission_preview_modal_submit_button_padding_tb',
                'type'        => 'number',
                'label'       => __( ' Padding ( Top - Bottom )', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_submission_preview_modal_submit_button_padding_lr' => array(
                'id'          => 'uacf7_submission_preview_modal_submit_button_padding_lr',
                'type'        => 'number',
                'label'       => __( ' Padding ( Left - Right )', 'ultimate-addons-cf7' ),
                'placeholder' => __( 'E.g. 16 (Do not add px or em)', 'ultimate-addons-cf7' ),
                'field_width' => 25,
            ),
            'uacf7_submission_preview_modal_submit_button_border_radius' => array(
                'id'          => 'uacf7_submission_preview_modal_submit_button_border_radius',
                'type'        => 'number',
                'label'       => __( ' Border Radius', 'ultimate-addons-cf7' ),
                'is_pro'      => true,
                'field_width' => 25,
            ),
            'uacf7_submisssion_preview_modal_submit_button_color_option' => array(
                'id'       => 'uacf7_submisssion_preview_modal_submit_button_color_option',
                'type'     => 'color',
                'label'    => __( 'Color Options', 'ultimate-addons-cf7' ),
                'class'    => 'tf-field-class',
                'multiple' => true,
                'inline'   => true,
                'colors'   => array(
                    'uacf7_submisssion_preview_modal_bg'                 => ' Background Color',
                    'uacf7_submisssion_preview_modal_color'              => ' Font Color',
                    'uacf7_submisssion_preview_modal_border_color'       => ' Border Color',
                    'uacf7_submisssion_preview_modal_hover_bg'           => 'Hover Background Color',
                    'uacf7_submisssion_preview_modal_hover_color'        => 'Hover Font Color',
                    'uacf7_submisssion_preview_modal_border_hover_color' => 'Hover Border Color',
                ),
                'is_pro' => true,
            ),

        ),
            

    ), $post_id);

    $value['form_submission_preview'] = $post_submission; 
    return $value;
}  
add_filter( 'uacf7_post_meta_options', 'uacf7_post_meta_options_form_submission_preview', 16, 2 );




