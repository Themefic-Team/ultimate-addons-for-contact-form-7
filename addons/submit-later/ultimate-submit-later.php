<?php

/** Prevent direct access */
    if (!defined('ABSPATH')) {
        echo "You are not allowed to access directly";
        exit();
    }

    class ULTIMATE_SUBMIT_LATER{

        public function __construct(){
            add_action('wp_enqueue_scripts', [$this, 'uacf7_form_submit_later_public_assets_loading']);

            add_action( 'wp_ajax_uacf7_submit_later_action', [$this, 'uacf7_submit_later_ajax_cb'] );
            add_action( 'wp_ajax_nopriv_uacf7_submit_later_action', [$this, 'uacf7_submit_later_ajax_cb'] );  

            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_submit_later'), 21, 2 ); 
        }

        public function uacf7_form_submit_later_public_assets_loading(){

            wp_enqueue_script('submit_later_public_js', UACF7_URL . 'addons/submit-later/assets/public/js/public-submit-later.js', ['jquery'], 'UAFC7_VERSION', true);
            wp_localize_script( 'submit_later_public_js', 'uacf7_submit_later_obj', [
                "ajaxurl" => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'uacf7-submit-later-nonce' ),
            ] );
        }

        public function uacf7_submit_later_ajax_cb(){
            if ( !wp_verify_nonce($_POST['ajax_nonce'], 'uacf7-submit-later-nonce')) {
                exit(esc_html__("Security error", 'ultimate-addons-cf7'));
            } 

            $form_id      = isset($_POST['form_id']) ? $_POST['form_id'] : '';
            $submit_later = uacf7_get_form_option( $form_id, 'submit_later' );
            $is_enabled   = isset($submit_later['uacf7_form_submit_later_enable']) ? $submit_later['uacf7_form_submit_later_enable'] : 0;
            $keep_for     = isset($submit_later['uacf7_form_submit_later_keep_active_for']) ? $submit_later['uacf7_form_submit_later_keep_active_for'] : 0;
            
            if($is_enabled != true){
                return;
            }

            echo wp_send_json( [
                'form_id'    => $form_id,
                'keep_for'   => $keep_for
            ] );
        }

        public function uacf7_post_meta_options_submit_later($value, $post_id){
            $submit_later = apply_filters('uacf7_post_meta_options_submit_later_pro', $data = array(
                'title'  => __( 'Submit Form Later', 'ultimate-addons-cf7' ),
                'icon'   => 'fa-solid fa-clock',
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
        
            $value['submit_later'] = $submit_later; 
            return $value;
        }

    }

    new ULTIMATE_SUBMIT_LATER();