<?php
    /** Prevent direct access */
    if (!defined('ABSPATH')) {
        echo "You are not allowed to access directly";
        exit();
    }

    class ULTIMATE_GOOGLE_SHEET{
        public function __construct(){
            add_action('wp_enqueue_scripts', [$this, 'uacf7_google_sheet_public_assets_loading']);
            
            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_google_sheet'), 21, 2 ); 
        }

        public function uacf7_google_sheet_public_assets_loading(){
            wp_enqueue_script('google_sheet_public_js', UACF7_URL . 'addons/google-sheet/assets/public/js/public-google-sheet.js', ['jquery'], 'UAFC7_VERSION', true);
            wp_localize_script( 'google_sheet_public_js', 'uacf7_google_sheet_obj', [
                "ajaxurl" => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'uacf7-google-sheet-nonce' ),
            ] );
        }

        public function uacf7_post_meta_options_google_sheet($value, $post_id){
            $google_sheet = apply_filters('uacf7_post_meta_options_google_sheet_pro', $data = array(
                'title'  => __( 'Google Sheet', 'ultimate-addons-cf7' ),
                'icon'   => 'fa-solid fa-sheet-plastic',
                'fields' => array(
                    'uacf7_form_google_sheet_heading' => array(
                        'id'    => 'uacf7_form_google_sheet_heading',
                        'type'  => 'heading', 
                        'label' => __( 'Google Sheet Connector', 'ultimate-addons-cf7' ),
                        'subtitle' => sprintf(
                            __( 'You can store your form submission data to Google Sheet. See Demo %1s.', 'ultimate-addons-cf7' ),
                             '<a href="https://cf7addons.com/preview/form-google-sheet-and-continue/" target="_blank" rel="noopener">Example</a>'
                                      )
                          ),
                          array(
                            'id'      => 'google-sheet-docs',
                            'type'    => 'notice',
                            'style'   => 'success',
                            'content' => sprintf( 
                                __( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                                '<a href="https://themefic.com/docs/uacf7/free-addons/submit-form-later-and-continue/" target="_blank" rel="noopener">Submit Later</a>'
                            )
                          ),
                 
                    'uacf7_form_google_sheet_enable' => array(
                        'id'        => 'uacf7_form_google_sheet_enable',
                        'type'      => 'switch',
                        'label'     => __( ' Enable Google Sheet', 'ultimate-addons-cf7' ),
                        'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
                        'label_off' => __( 'No', 'ultimate-addons-cf7' ),
                        'default'   => false,
                    ),
                       
                    // 'uacf7_form_google_sheet_keep_active_for' => array(
                    //     'id'        => 'uacf7_form_google_sheet_keep_active_for',
                    //     'type'      => 'number',
                    //     'label'     => __( ' Keep For (hours)', 'ultimate-addons-cf7' ),
                    //     'placeholder'     => __( ' 168 ', 'ultimate-addons-cf7' ),
                    //     'description'     => __( 'Enter how many hours you want, The default, 168 hours / 7 Days.', 'ultimate-addons-cf7' ),
                    //     'default'   => 168,
                    // ),
               
                ),
                
        
            ), $post_id);
        
            $value['google_sheet'] = $google_sheet; 
            return $value;
        }
    }

    new ULTIMATE_GOOGLE_SHEET();