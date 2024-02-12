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

            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_form_preview'), 21, 2 ); 
        }

        public function uacf7_form_preview_public_assets_loading(){

                /** Enable / Disable Form Preview*/
            
                $wpcf7                      = WPCF7_ContactForm::get_current();
                $formid                     = $wpcf7->id();
                $submission                 = uacf7_get_form_option( $formid, 'submit_later' );
                $uacf7_form_submit_later_enable = isset($submission['uacf7_form_submit_later_enable']) ? $submission['uacf7_form_submit_later_enable'] : false;
                
                if($uacf7_form_submit_later_enable != true){
                    return;
                }
                wp_enqueue_script('submit_later_public_js', UACF7_URL . '/addons/submit-later/assets/public/js/public-form-preview.js', ['jquery'], 'WPCF7_VERSION', true);
                // wp_enqueue_style('submit_later_public_css', UACF7_URL . '/addons/submit-later/assets/public/css/public-submit-later.css', [], 'UAFC7_VERSION', true, 'all');
                // wp_localize_script( 'submit_later_public_js', 'uacf7_submit_later_obj', [
                //     "ajaxurl" => admin_url( 'admin-ajax.php' ),
                //     'nonce'   => wp_create_nonce( 'uacf7-submit-later-nonce' ),
                // ] );
        }

        public function uacf7_post_meta_options_form_preview($value, $post_id){
            $form_preview = apply_filters('uacf7_post_meta_options_form_preview_pro', $data = array(
                'title'  => __( 'Submit Form Later', 'ultimate-addons-cf7' ),
                'icon'   => 'fa-solid fa-magnifying-glass',
                'fields' => array(
                    'uacf7_form_submit_later_heading' => array(
                        'id'    => 'uacf7_form_submit_later_heading',
                        'type'  => 'heading', 
                        'label' => __( 'Form Submit Later', 'ultimate-addons-cf7' ),
                        'subtitle' => sprintf(
                            __( 'Allow your visitor to submit form later, If want to postpone the submission for the time being. It will keep save the filled data to the form. See Demo %1s.', 'ultimate-addons-cf7' ),
                             '<a href="https://cf7addons.com/preview/form-submit-later-and-continue/" target="_blank" rel="noopener">Example</a>'
                                      )
                          ),
                          array(
                            'id'      => 'submit-form-later-docs',
                            'type'    => 'notice',
                            'style'   => 'success',
                            'content' => sprintf( 
                                __( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                                '<a href="https://themefic.com/docs/uacf7/free-addons/submit-form-later-and-continue/" target="_blank" rel="noopener">Submit Later</a>'
                            )
                          ),
                 
                    'uacf7_form_submit_later_enable' => array(
                        'id'        => 'uacf7_form_submit_later_enable',
                        'type'      => 'switch',
                        'label'     => __( ' Enable Form Submit Later', 'ultimate-addons-cf7' ),
                        'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
                        'label_off' => __( 'No', 'ultimate-addons-cf7' ),
                        'default'   => false,
                    ),
                       
                    'uacf7_form_submit_later_keep_active_for' => array(
                        'id'        => 'uacf7_form_submit_later_keep_active_for',
                        'type'      => 'number',
                        'label'     => __( ' Keep For (hours)', 'ultimate-addons-cf7' ),
                        'placeholder'     => __( ' 168 ', 'ultimate-addons-cf7' ),
                        'description'     => __( 'Enter how many hours you want, The default, 168 hours / 7 Days.', 'ultimate-addons-cf7' ),
                        'default'   => 168,
                    ),
               
                ),
                
        
            ), $post_id);
        
            $value['form_preview'] = $form_preview; 
            return $value;
        }
    }

    new ULTIMATE_FORM_PREVIEW();