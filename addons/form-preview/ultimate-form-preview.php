<?php

/** Prevent direct access */
    if (!defined('ABSPATH')) {
        echo "You are not allowed to access directly";
        exit();
    }
    class ULTIMATE_FORM_PREVIEW{

        public function __construct(){

            add_action('wp_enqueue_scripts', [$this, 'uacf7_form_preview_public_assets_loading']); 

            add_action('wp_ajax_uacf7_form_preview_action', [$this, 'uacf7_form_preview_ajax_cb']); 
            add_action('wp_ajax_nopriv_uacf7_form_preview_action', [$this, 'uacf7_form_preview_ajax_cb']); 

            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_form_preview'), 24, 2 ); 

            $file_path = plugin_dir_path(__FILE__) . 'inc/uacf7-form-preview.php';

            include_once($file_path);
        }

        public function uacf7_post_meta_options_form_preview($value, $post_id){
            $form_preview = apply_filters('uacf7_post_meta_options_form_preview_pro', $data = array(
                'title'  => __( 'Form Preview', 'ultimate-addons-cf7' ),
                'icon'   => 'fa-solid fa-magnifying-glass',
                'fields' => array(
                    'uacf7_form_preview_heading' => array(
                        'id'    => 'uacf7_form_preview_heading',
                        'type'  => 'heading', 
                        'label' => __( 'Form Preview', 'ultimate-addons-cf7' ),
                        'subtitle' => sprintf(
                            // translators: %1$s is replaced with a link to an example.
                            esc_html__( 'Allow you to preview the form before Submission. See Demo %1s.', 'ultimate-addons-cf7' ),
                             '<a href="https://cf7addons.com/preview/form-submit-later-and-continue/" target="_blank" rel="noopener">Example</a>'
                                      )
                          ),
                          array(
                            'id'      => 'submit-form-preview-docs',
                            'type'    => 'notice',
                            'style'   => 'success',
                            'content' => sprintf(
                                // translators: %1$s is replaced with a link to an example. 
                                esc_html__( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                                '<a href="https://themefic.com/docs/uacf7/free-addons/submit-form-later-and-continue/" target="_blank" rel="noopener">Submit Later</a>'
                            )
                          ),
         
                   'uacf7_form_preview_enable' => array(
                    'id'    => 'uacf7_form_preview_enable',
                    'type'               => 'switch',
                    'label'              => __( 'Enable Form Preview', 'ultimate-addons-cf7' ),
                    'default' => false
                    ),
                   'uacf7_form_preview_title' => array(
                    'id'    => 'uacf7_form_preview_title',
                    'type'               => 'text',
                    'label'              => __( 'Form Preview Title', 'ultimate-addons-cf7' ),
                    'placeholder'              => __( 'Form Preview', 'ultimate-addons-cf7' ),
                    'default' => 'Form Preview'
                    ),
         
                   'uacf7_form_preview_button_layout' => array(
                    'id'    => 'uacf7_form_preview_button_layout',
                    'type'               => 'heading',
                    'label'              => __( 'Preview Button Layout', 'ultimate-addons-cf7' ),
                    'subtitle'              => 'Copy the code and paste anywhere of Form. Please Note: The button ID  can not be changed. You can change the button text. ',
                    'description'     => __( '<button class="ucaf7-form-preview-layout">Copy Layout</button>', 'ultimate-addons-cf7' ),
                    'class' => 'uacf7-form-preview-layout'
                    ),
                    'uacf7_form_preview_label_placeholder' => array(
                        'id' => 'uacf7_form_preview_label_placeholder',
                        'type' => 'repeater',
                        'label' => 'Set Front End Label for Form Input Field',
                        'subtitle'     => __( 'It will help to show a beautiful preview of each field', 'ultimate-addons-cf7' ),
                        'class' => 'tf-field-class',
                        'fields' => array(
                            'field_name' => array(
                                'id' => 'field_name',
                                'type' => 'select',
                                'options'  => 'uacf7',
                                'query_args' => array(
                                    'post_id'      => $post_id,  
                                    'exclude'      => ['submit'], 
                                ), 
                            ),
                            'field_label' => array(
                                'id' => 'field_label',
                                'type' => 'text',
                                'label' => 'Prview Label',
                                'subtitle'     => __( 'This label will be show to Form Preview', 'ultimate-addons-cf7' ),

                            )
                         ),
                    )
                       
                ),   
        
            ), $post_id);
        
            $value['form_preview'] = $form_preview; 
            return $value;
        }
        

        public function uacf7_form_preview_ajax_cb(){
        
            if ( !wp_verify_nonce($_POST['ajax_nonce'], 'uacf7-form-preview-nonce')) {
                exit(esc_html__("Security error", 'ultimate-addons-cf7'));
            }
            
            $form_preview_default_heading = esc_html__('Form Preview', 'ultimate-addons-cf7');
            $form_id                      = isset($_POST['form_id']) ? $_POST['form_id'] : '';
            $form_preview                 = uacf7_get_form_option( $form_id, 'form_preview' );
            $is_enabled                   = isset($form_preview['uacf7_form_preview_enable']) ? $form_preview['uacf7_form_preview_enable'] : 0;
            $preview_heading              = isset($form_preview['uacf7_form_preview_title']) ? $form_preview['uacf7_form_preview_title'] : 0;
            $preview_labels               = isset($form_preview['uacf7_form_preview_label_placeholder']) ? $form_preview['uacf7_form_preview_label_placeholder'] : 0;
            
            if($is_enabled != true){
                return;
            }

            echo wp_send_json( [
                'is_enabled'                   => $is_enabled,
                'preview_labels'               => $preview_labels,
                'preview_heading'              => $preview_heading,
                'form_preview_default_heading' => $form_preview_default_heading
            ] );
        }

        public function uacf7_form_preview_public_assets_loading(){
           
                wp_enqueue_script('preview_form_jquery_ui_js', UACF7_URL . 'addons/form-preview/assets/public/js/jquery-ui.js', ['jquery'], 'UAFC7_VERSION', true);
                wp_enqueue_script('preview_form_public_js', UACF7_URL . 'addons/form-preview/assets/public/js/public-form-preview.js', ['jquery'], 'UAFC7_VERSION', true);
               
                wp_enqueue_style('form_preview_jquery_ui_css', UACF7_URL . 'addons/form-preview/assets/public/css/jquery-ui.css', [], 'UAFC7_VERSION', true, 'all');
                // wp_enqueue_style('form_preview_public_css', UACF7_URL . 'addons/form-preview/assets/public/css/public-form-preview.css', [], 'UAFC7_VERSION', true, 'all');
               
                wp_enqueue_style('jquery-ui-theme', 'https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');
                wp_localize_script( 'preview_form_public_js', 'uacf7_form_preview_obj', [
                    "ajaxurl" => admin_url( 'admin-ajax.php' ),
                    'nonce'   => wp_create_nonce( 'uacf7-form-preview-nonce' ),
                ] );
        }

       
    }

    new ULTIMATE_FORM_PREVIEW();