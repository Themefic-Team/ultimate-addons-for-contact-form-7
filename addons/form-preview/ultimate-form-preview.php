<?php

/** Prevent direct access */
    if (!defined('ABSPATH')) {
        echo "You are not allowed to access directly";
        exit();
    }


    class ULTIMATE_FORM_PREVIEW{

        public function __construct(){
            add_action('wp_enqueue_scripts', [$this, 'uacf7_form_preview_public_assets_loading']);

            // add_action( 'wp_ajax_uacf7_submit_later_action', [$this, 'uacf7_submit_later_ajax_cb'] );
            // add_action( 'wp_ajax_nopriv_uacf7_submit_later_action', [$this, 'uacf7_submit_later_ajax_cb'] );  

            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_form_preview'), 24, 2 ); 
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
                            __( 'Allow you to preview the form before Submission. See Demo %1s.', 'ultimate-addons-cf7' ),
                             '<a href="https://cf7addons.com/preview/form-submit-later-and-continue/" target="_blank" rel="noopener">Example</a>'
                                      )
                          ),
                          array(
                            'id'      => 'submit-form-preview-docs',
                            'type'    => 'notice',
                            'style'   => 'success',
                            'content' => sprintf( 
                                __( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                                '<a href="https://themefic.com/docs/uacf7/free-addons/submit-form-later-and-continue/" target="_blank" rel="noopener">Submit Later</a>'
                            )
                          ),
         
                   'uacf7_form_preview_enable' => array(
                    'id'    => 'uacf7_form_preview_enable',
                    'type'               => 'switch',
                    'label'              => __( 'Enable Form Preview', 'ultimate-addons-cf7' ),
                    'default' => false
                    ),
                       
                ),   
        
            ), $post_id);
        
            $value['form_preview'] = $form_preview; 
            return $value;
        }

        public function uacf7_form_preview_public_assets_loading(){

                /** Enable / Disable Form Preview*/
            
                // $wpcf7                      = WPCF7_ContactForm::get_current();
                // $formid                     = $wpcf7->id();
                // $form_preview                 = uacf7_get_form_option( $formid, 'form_preview' );
                // $uacf7_form_preview_enable = isset($form_preview['uacf7_form_preview_enable']) ? $form_preview['uacf7_form_preview_enable'] : false;
                
                // if($uacf7_form_preview_enable != true){
                //     return;
                // }

                wp_enqueue_script('preview_form_public_js', UACF7_URL . 'addons/form-preview/assets/public/js/public-form-preview.js', ['jquery'], 'UAFC7_VERSION', true);
                wp_enqueue_script('preview_form_app_js', UACF7_URL . 'addons/form-preview/assets/public/js/app.js', [], 'UAFC7_VERSION', true);
               
                wp_enqueue_style('form_preview_public_css', UACF7_URL . 'addons/form-preview/assets/public/css/public-form-preview.css', [], 'UAFC7_VERSION', true, 'all');
                // wp_localize_script( 'submit_later_public_js', 'uacf7_submit_later_obj', [
                //     "ajaxurl" => admin_url( 'admin-ajax.php' ),
                //     'nonce'   => wp_create_nonce( 'uacf7-submit-later-nonce' ),
                // ] );
        }

       
    }

    new ULTIMATE_FORM_PREVIEW();