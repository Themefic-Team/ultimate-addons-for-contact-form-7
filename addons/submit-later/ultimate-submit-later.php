<?php
/** Prevent direct access */
if (!defined('ABSPATH')) {
    echo "You are not allowed to access directly";
    exit();
}

class ULTIMATE_SUBMIT_LATER{

    public function __construct(){

        add_action('admin_init', array($this, 'uacf7_submit_later_tag_generator'));
        add_action('wpcf7_init', array($this, 'uacf7_submit_later_add_shortcode'));

        add_action('init', array( $this, 'uacf7_create_save_and_continue_table'));
        add_action('init', array( $this, 'uacf7_register_custom_endpoint'));
        add_filter('query_vars', array( $this,'uacf7_submit_later_add_query_vars'));
        add_action('template_redirect', array( $this, 'uacf7_load_continue_form_template'));
        add_action('wp_enqueue_scripts', array( $this, 'uacf7_form_submit_later_public_assets_loading'));
        add_action('admin_enqueue_scripts', array( $this, 'uacf7_form_submit_later_admin_assets_loading'));
        //Data Save
        add_action( 'wp_ajax_uacf7_submit_later_action', array( $this, 'uacf7_submit_later_ajax_cb') );
        add_action( 'wp_ajax_nopriv_uacf7_submit_later_action', array( $this, 'uacf7_submit_later_ajax_cb')); 

        //Data Delete
        add_action('wp_ajax_uacf7_delete_form_data_action', array($this, 'uacf7_delete_form_data_ajax_cb'));
        add_action('wp_ajax_nopriv_uacf7_delete_form_data_action', array($this, 'uacf7_delete_form_data_ajax_cb'));

        //Send Mail
        add_action('wp_ajax_uacf7_send_email_action', array($this,'uacf7_send_email_cb'));
        add_action('wp_ajax_nopriv_uacf7_send_email_action', array($this, 'uacf7_send_email_cb'));

 

        add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_submit_later'), 31, 2); 
    }

    // Create table into Database.
    public function uacf7_create_save_and_continue_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'uacf7_save_and_continue';
    
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            form_id mediumint(9) NOT NULL,
            form_data text NOT NULL,
            unique_id varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
    
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    // Enqueue Admin Assets.
    public function uacf7_form_submit_later_admin_assets_loading(){
        wp_enqueue_script('submit_later_admin_js', UACF7_URL . 'addons/submit-later/assets/admin/js/admin-submit-later.js', ['jquery'], 'UAFC7_VERSION', true);
    }
    // Enqueue Public Assets.
    public function uacf7_form_submit_later_public_assets_loading(){

        wp_enqueue_style( 'submit_later_public_styles', UACF7_URL.'addons/submit-later/assets/public/css/public-submit-later.css', array(), 'UAFC7_VERSION', 'all' );

        wp_enqueue_script('submit_later_public_js', UACF7_URL . 'addons/submit-later/assets/public/js/public-submit-later.js', ['jquery'], 'UAFC7_VERSION', true);
        wp_enqueue_script('submit_later_jquery_ui_js', UACF7_URL . 'addons/submit-later/assets/public/js/jquery-ui.js', ['jquery'], 'UAFC7_VERSION', true);
        wp_localize_script( 'submit_later_public_js', 'uacf7_submit_later_obj', [
            "ajax_url" => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'uacf7-submit-later-nonce' ),
        ] );
    }


    //Save and Continue Tag Generation
    public function uacf7_submit_later_tag_generator(){
        if (!function_exists('wpcf7_add_tag_generator')) {
            return;
        }
    
        wpcf7_add_tag_generator('uacf7_submit_later',
            __('Save and Continue', 'ultimate-addons-cf7'),
            'uacf7-tg-pane-save-and-continue',
            array($this, 'tg_pane_submit_later')
        );
    }

    public static function tg_pane_submit_later($contact_form, $args = ''){
        $args = wp_parse_args($args, array());
        $uacf7_field_type = 'uacf7_submit_later';
        ?>
      <div class="control-box">
      <fieldset>
                <table class="form-table">
                   <tbody>
                        <div class="uacf7-doc-notice"> 
                            <?php printf( 
                                // Translators: %1$s: Documentation URL
                                esc_html__( 'Confused? Check our Documentation on  %1$s.', 'ultimate-addons-cf7' ),
                                '<a href="'.esc_url('https://themefic.com/docs/uacf7/free-addons/save-and-continue-for-contact-form-7/').'" target="_blank">Save and Continue</a>'
                            ); ?> 
                        </div>
                        <tr>
                            <th scope="row"><label for="<?php echo esc_attr($args['content'] . '-name'); ?>"><?php echo esc_html(__('Name', 'ultimate-addons-cf7')); ?></label></th>
                            <td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr($args['content'] . '-name'); ?>" /></td>
                        </tr> 
                        <tr>
                            <th scope="row"><label for="tag-generator-panel-text-class"><?php echo esc_html__('Class attribute', 'ultimate-addons-cf7'); ?></label></th>
                            <td><input type="text" name="class" class="classvalue oneline option" id="tag-generator-panel-text-class"></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
      </div>
    
      <div class="insert-box">
          <input type="text" name="<?php echo esc_attr($uacf7_field_type); ?>" class="tag code" readonly="readonly" onfocus="this.select()" />
    
          <div class="submitbox">
              <input type="button" class="button button-primary insert-tag" id="prevent_multiple" value="<?php echo esc_attr(__('Insert Tag', 'ultimate-addons-cf7')); ?>" />
          </div>
      </div>
      <?php
    }

    // Generate Shortcode

    public function uacf7_submit_later_add_shortcode(){
        wpcf7_add_form_tag(array('uacf7_submit_later', 'uacf7_submit_later*'),
        array($this, 'uacf7_submit_later_tag_handler_callback'), array('name-attr' => true));
    }
    
    public function uacf7_submit_later_tag_handler_callback($tag){
        if (empty($tag->name)) {
            return '';
        }

         /** Enable / Disable Submission ID */
        // $wpcf7                      = WPCF7_ContactForm::get_current();
        // $formid                     = $wpcf7->id();
        // $submission                 = uacf7_get_form_option( $formid, 'submission_id' );
        // $uacf7_submission_id_enable = isset($submission['uacf7_submission_id_enable']) ? $submission['uacf7_submission_id_enable'] : false;
        
        // if($uacf7_submission_id_enable != true){
        //     return;
        // }

        $validation_error = wpcf7_get_validation_error($tag->name);

        $class = wpcf7_form_controls_class($tag->type);
    
    
        if ($validation_error) {
            $class .= 'wpcf7-not-valid';
        }
    
        $atts = array();
    
        $atts['class']    = $tag->get_class_option($class);
        $atts['id']       = $tag->get_id_option();
        $atts['tabindex'] = $tag->get_option('tabindex', 'signed_int', true);
    
        if ($tag->is_required()) {
            $atts['aria-required'] = 'true';
        }
    
        $atts['aria-invalid'] = $validation_error ? 'true' : 'false';
    
        $atts['name'] = $tag->name;

        // input size
        $size = $tag->get_option('size', 'int', true);
        if ($size) {
            $atts['size'] = $size;
        } else {
            $atts['size'] = 40;
        } 
        $value = $tag->values;
        $default_value = $tag->get_default_option($value);


        $value = isset($submission['uacf7_submission_id']) ? $submission['uacf7_submission_id'] : '';

        $atts['value'] = $value;

        $atts['name'] = $tag->name;

        // Escape all attributes.
        $allowed_attributes = array(); 
        foreach ($atts as $key => $value) {
            $allowed_attributes[$key] = true;
        }  

        $atts = wpcf7_format_atts($atts);

        ob_start();

        ?> 
        <span  class="wpcf7-form-control-wrap <?php echo sanitize_html_class($tag->name); ?>" data-name="<?php echo sanitize_html_class($tag->name); ?>">
            <div id="uacf7-save-and-continue-loader"></div>
            <input type="submit" class="uacf7-save-and-continue" value="Save and Continue" />
              <!-- Email Popup Starts -->
            <div id="uacf7-save-continue-email-popup" class="popup">
            <div class="uacf7-sacf-form-container">
                <h2 class="uacf7-sacf-heading">Send URL via Email</h2>
                <form id="uacf7-sacf-emailForm">
                    <div class="uacf7-sacf-form-group">
                        <label for="uacf7-sacf-url-input">URL:</label>
                        <input disabled type="text" id="uacf7-sacf-url-input" name="uacf7-sacf-url-input">
                    </div>
                    <div class="uacf7-sacf-form-group">
                        <label for="uacf7-sacf-email-input">Email:</label>
                        <input type="email" id="uacf7-sacf-email-input" name="uacf7-sacf-email-input" required>
                    </div>
                    <button class="uacf7-sacf-send-mail-button">Send Email</button>
                    <span class="uacf7-sacf-send-mail-message-success"></span>
                    <span class="uacf7-sacf-send-mail-message-failed"></span>
                    <div class="uacf7-save-and-continue-mail-sending-loader"></div>


                </form>
                </div>
            </div>
             <!-- Email Popup Ends-->
            <div id="ucaf7-save-continue-email-overlay"></div>
            </span>

    <?php 

        $submit_later_buffer = ob_get_clean();

        return $submit_later_buffer;
    
    }

    //Save Form Data
    public function uacf7_submit_later_ajax_cb(){
        check_ajax_referer('uacf7-submit-later-nonce', 'nonce');
        global $wpdb;
        $form_id = intval($_POST['form_id']);

        // Enable Submit Later functinality to Front End.
        $submit_later = uacf7_get_form_option( $form_id, 'submit_later' );
        $enable_submit_later = isset($submit_later['uacf7_form_submit_later_enable']) ? $submit_later['uacf7_form_submit_later_enable'] : 0;

        if( $enable_submit_later != true){ die; }

        $form_data = isset($_POST['form_data']) ? $_POST['form_data'] : '';
        // Convert serialized form data to array
        $form_fields = array();
        parse_str($form_data, $form_fields);
        // Convert field values array to JSON for storage
        $form_fields_json = json_encode($form_fields);
        $unique_id = md5(uniqid());
        $table_name = $wpdb->prefix . 'uacf7_save_and_continue';
        $wpdb->insert(
            $table_name,
            array(
                'form_id'   => $form_id,
                'form_data' => $form_fields_json,
                'unique_id' => $unique_id
            )
        );
        echo json_encode(array('success' => true, 'unique_id' => $unique_id));
        wp_die();
    }

    //Delete Form Data.

    public function uacf7_delete_form_data_ajax_cb(){
        check_ajax_referer('uacf7-submit-later-nonce', 'nonce');
        if (!current_user_can('delete_posts')) {
            wp_send_json_error('Unauthorized');
        }
    
        if (!isset($_POST['unique_id'])) {
            wp_send_json_error('Unique ID not provided');
        }
    
        $unique_id = sanitize_text_field($_POST['unique_id']);
    
        global $wpdb;
        $table_name = $wpdb->prefix . 'uacf7_save_and_continue';
        $result = $wpdb->delete($table_name, array('unique_id' => $unique_id));
    
        if ($result === false) {
            wp_send_json_error('Failed to delete form data');
        }
    
        wp_send_json_success('Form data deleted successfully');
        wp_die();
    }

    // Send Mail

    public function uacf7_send_email_cb() {
        $link     = isset($_POST['link']) ? $_POST['link'] : '';    
        $to_email = isset($_POST['email']) ? $_POST['email'] : ''; 

        
        // Send email using wp_mail()
        $subject = 'New Email from ' . $link;
        $message = 'Name: ' . $link . "\r\n" . 'Email: ' . $to_email;
        
        $sent = wp_mail($to_email, $subject, $message);
        
        if ($sent) {

            wp_send_json( [
                'status' => 'success',
                'message'=> 'Email sent successfully !'
            ] );
        } else {
            wp_send_json( [
                'status' => 'failed',
                'message'=> 'Email not sent !'
            ] );
        }
        
        wp_die();
    }
    
    

    public function uacf7_register_custom_endpoint(){
        add_rewrite_rule('^uacf7-form-save-and-continue/?', 'index.php?uacf7_continue_form=true', 'top');
    }
    

    public function uacf7_submit_later_add_query_vars($vars){
        $vars[] = 'uacf7_continue_form';
        return $vars;
    }

    public function uacf7_load_continue_form_template(){

        $current_url = $_SERVER['REQUEST_URI'];

        if (strpos($current_url, 'uacf7-form') !== false) {
            // Redirect to a new URL
            include plugin_dir_path(__FILE__) . 'uacf7-continue-form-template.php';
            exit(); 
        }
    }

    public function uacf7_post_meta_options_submit_later($value, $post_id){
        $submit_later = apply_filters('uacf7_post_meta_options_submit_later_pro', $data = array(
            'title'  => __( 'Submit Form Later', 'ultimate-addons-cf7' ),
            'icon'   => 'fa-solid fa-clock',
            'checked_field'   => 'uacf7_form_submit_later_enable',
            'fields' => array(
                'uacf7_form_submit_later_heading' => array(
                    'id'    => 'uacf7_form_submit_later_heading',
                    'type'  => 'heading', 
                    'label' => __( 'Form Submit Later', 'ultimate-addons-cf7' ),
                    'subtitle' => sprintf(
                        // Translators: %1$s is replaced with the link to documentation.
                        esc_html__( 'Allow your visitor to submit form later, If want to postpone the submission for the time being. It will keep save the filled data to the form. See Demo %1s.', 'ultimate-addons-cf7' ),
                         '<a href="https://cf7addons.com/preview/form-submit-later-and-continue/" target="_blank" rel="noopener">Example</a>'
                                  )
                      ),
                      array(
                        'id'      => 'submit-form-later-docs',
                        'type'    => 'notice',
                        'style'   => 'success',
                        'content' => sprintf(
                            // Translators: %1$s is replaced with the link to documentation. 
                            esc_html__( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
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
                'uacf7_save_and_continue_button_layout' => array(
                    'id'    => 'uacf7_save_and_continue_button_layout',
                    'type'               => 'heading',
                    'label'              => __( 'Save and Continue Button Layout', 'ultimate-addons-cf7' ),
                    'subtitle'              => 'Copy the code and paste anywhere of Form. Please Note: The button CLASS can not be changed. You can change the button text. ',
                    'description'     => __( '<button class="ucaf7-save-and-continue-layout">Copy Layout</button>', 'ultimate-addons-cf7' ),
                    'class' => 'ucaf7-save-and-continue-layout-wrapper'
                    ),
            ),    

        ), $post_id);
    
        $value['submit_later'] = $submit_later; 
        return $value;
    }

}

new ULTIMATE_SUBMIT_LATER();
