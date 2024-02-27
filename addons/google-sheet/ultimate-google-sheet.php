<?php
    /** Prevent direct access */
    if (!defined('ABSPATH')) {
        echo "You are not allowed to access directly";
        exit();
    }

    class ULTIMATE_GOOGLE_SHEET{
        public function __construct(){
            add_action('wp_enqueue_scripts', [$this, 'uacf7_google_sheet_public_assets_loading']);
            
            add_filter( 'uacf7_post_meta_options', [$this, 'uacf7_post_meta_options_google_sheet'], 21, 2 ); 
            add_action( 'wpcf7_mail_sent',  [$this,'uacf7_google_sheets_send_submission'], 10, 1 );
            add_filter( 'wpcf7_load_js', '__return_false' );

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
                             '<a href="https://cf7addons.com/preview/form-google-sheet/" target="_blank" rel="noopener">Example</a>'
                                      )
                          ),
                          array(
                            'id'      => 'google-sheet-docs',
                            'type'    => 'notice',
                            'style'   => 'success',
                            'content' => sprintf( 
                                __( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                                '<a href="https://themefic.com/docs/uacf7/free-addons/google-sheet/" target="_blank" rel="noopener">Submit Later</a>'
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

        public function uacf7_google_sheets_send_submission($contact_form){

            $submission = WPCF7_Submission::get_instance();
            $formid = $contact_form->id();

            if ( ! $submission ) {
                return;
            }
      
            $google_sheet              = uacf7_get_form_option($formid, 'google_sheet');
            $uacf7_enable_google_sheet = $google_sheet['uacf7_form_google_sheet_enable'];

            if($uacf7_enable_google_sheet != '1'){
                return;
            }

            $posted_data = $submission->get_posted_data();

            $client_id = '722191084144-fpds0ou31v91ui13et8pekf5dnlges2e.apps.googleusercontent.com';
            $client_secret = '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';
            $spreadsheet_id = '14_8nzBtlZYsa2g8awrDU8V7lhmIIIQ5iRM_Rdktb5aU';
        
            // Create an instance of the Google Sheets Connector
            $google_sheets_connector = new CF7_Google_Sheets_Connector( $client_id, $client_secret );
        
            // Connect to Google Sheets
            $google_sheets_connector->connect();
        
            // Check if connected successfully
            if ( $google_sheets_connector->is_connected() ) {
                // Map form fields to Google Sheets columns
                $mapped_data = array(
                    'Column1' => $posted_data['your-name'],
                    'Column2' => $posted_data['your-email'],
                    'Column3' => $posted_data['your-subject'],
                    'Column4' => $posted_data['your-message'],
                );
        
                // Insert data into Google Sheets
                $google_sheets_connector->insert_row( $spreadsheet_id, $mapped_data );
            }
        }
        
    }
    
    new ULTIMATE_GOOGLE_SHEET();

  