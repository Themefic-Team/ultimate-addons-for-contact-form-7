<?php
    if ( !defined( 'ABSPATH' ) ) {
        exit;
    }

    class UACF7_SPAM_PROTECTION{
       
        public function __construct(){

            add_action( 'wpcf7_init', [ $this, 'uacf7_spam_protection_add_shortcodes' ]);
            add_action( 'admin_init', [ $this, 'uacf7_spam_protection_tag_generator' ]);
            add_filter( 'uacf7_post_meta_options', [ $this, 'uacf7_post_meta_options_spam_protection'], 24, 2 ); 
            add_action( 'wp_enqueue_scripts', [$this, 'uacf7_spam_protection_scripts']);
            add_action('wp_ajax_uacf7_spam_action', [$this,'uacf7_spam_action_ajax_callback']);
            add_action('wp_ajax_nopriv_uacf7_spam_action', [$this,'uacf7_spam_action_ajax_callback']);
        }

        public function uacf7_spam_protection_scripts(){
            wp_enqueue_script('uacf7-spam-protection', UACF7_URL . '/addons/spam-protection/assets/js/spam-protection-script.js', ['jquery'], 'WPCF7_VERSION', true);
            wp_enqueue_script('uacf7-spam-protection-arithmetic', UACF7_URL . '/addons/spam-protection/assets/js/spam-protection-arithmetic.js', ['jquery'], 'WPCF7_VERSION', true);
            wp_enqueue_script('uacf7-spam-protection-image', UACF7_URL . '/addons/spam-protection/assets/js/spam-protection-image.js', ['jquery'], 'WPCF7_VERSION', true);
            wp_enqueue_style('uacf7-spam-protection-css', UACF7_URL . '/addons/spam-protection/assets/css/spam-protection-style.css', [], 'WPCF7_VERSION', 'all');
            wp_localize_script( 'uacf7-spam-protection', 'uacf7_spam_pro_obj', [
                'ajax_url'       => admin_url( 'admin-ajax.php' ),
                'nonce'          => wp_create_nonce('nonce_for_spam_protection'),
            ] );
        }



        public function uacf7_spam_action_ajax_callback(){
              
            $form_id                  = $_POST['form_id'];
            $data                     = uacf7_get_form_option($form_id, 'spam_protection');
            $uacf7_minimum_time_limit = $data['uacf7_minimum_time_limit'];
            $uacf7_word_filter        = $data['uacf7_word_filter'];
            $uacf7_ip_block           = $data['uacf7_ip_block'];
            $uacf7_country_block      = $data['uacf7_blocked_countries'];

            echo wp_send_json( [
                    'uacf7_minimum_time_limit' => $uacf7_minimum_time_limit,
                    'uacf7_word_filter'        => $uacf7_word_filter,
                    'uacf7_ip_block'           => $uacf7_ip_block,
                    'uacf7_country_block'      => $uacf7_country_block,
                ] );

        }

        public function uacf7_post_meta_options_spam_protection($value, $post_id){
            $spam_protection = apply_filters('uacf7_post_meta_options_spam_protection_pro', $data = array(
                'title'  => __( 'Spam Protection', 'ultimate-addons-cf7' ),
                'icon'   => 'fa-solid fa-spaghetti-monster-flying',
                'fields' => array(
                    'uacf7_spam_protection_heading' => array(
                        'id'        => 'uacf7_spam_protection_heading',
                        'type'      => 'heading',
                        'label'     => __( 'Spam Protection', 'ultimate-addons-cf7' ),
                        'sub_title' => __( 'This feature will help you to protect your form submission from Spam attack.' ),
                    ),
                    'uacf7_spam_protection_enable' => array(
                        'id'        => 'uacf7_spam_protection_enable',
                        'type'      => 'switch',
                        'label'     => __( ' Enable/Disable Spam Protection', 'ultimate-addons-cf7' ),
                        'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
                        'label_off' => __( 'No', 'ultimate-addons-cf7' ),
                        'default'   => false
                    ),
                    'uacf7_spam_protection_type' => array(
                        'id'        => 'uacf7_spam_protection_type',
                        'type'      => 'select',
                        'label'     => __( 'Protection Type', 'ultimate-addons-cf7' ),
                        'options'   => array(
                            'arithmathic_recognation' => 'Arithmathic Recognation',
                            'image_recognation'       => 'Image Recognation',
                        ),
                        'default' => 'arithmathic_recognation'
                    ),
                    'uacf7_minimum_time_limit'    => array(
                        'id'          => 'uacf7_minimum_time_limit',
                        'type'        => 'number',
                        'label'       => __( 'Each Submission Difference', 'ultimate-addons-cf7' ),
                        'subtitle'    => __( 'You can avoid some spamming bot by setting a time limit to prevent too much frequient submission. Put in seconds', 'ultimate-addons-cf7' ),
                        'placeholder' => __( 'Default: 0 seconds', 'ultimate-addons-cf7' ),
                    ),
                    'uacf7_word_filter' => array(
                        'id'          => 'uacf7_word_filter',
                        'type'        => 'textarea',
                        'label'       => __( 'Word Filter', 'ultimate-addons-cf7' ),
                        'subtitle'    => __( 'Enlist the words you want to avoid from Spammer, Separeate the words using a Comma', 'ultimate-addons-cf7' ),
                        'placeholder' => __( ', comma separate words', 'ultimate-addons-cf7' ),
                    ),
                    'uacf7_ip_block'    => array(
                        'id'          => 'uacf7_ip_block',
                        'type'        => 'textarea',
                        'label'       => __( 'IP Block', 'ultimate-addons-cf7' ),
                        'subtitle'    => __( 'Enlist the IP you want to Ban / Block, Separeate the IPs using a Comma', 'ultimate-addons-cf7' ),
                        'placeholder' => __( ', comma separate IPs', 'ultimate-addons-cf7' ),
                    ),
                    'uacf7_blocked_countries'    => array(
                        'id'          => 'uacf7_blocked_countries',
                        'type'        => 'textarea',
                        'label'       => __( 'Country Block', 'ultimate-addons-cf7' ),
                        'subtitle'    => __( 'Enlist the the Country or Countries that you want to Ban / Block. Separeate the Countries using a Comma', 'ultimate-addons-cf7' ),
                        'placeholder' => __( ', comma separate Countries', 'ultimate-addons-cf7' ),
                    ),
  
                )
                    
            ), $post_id);
        
            $value['spam_protection'] = $spam_protection; 
            return $value;
        }

        public function uacf7_spam_protection_tag_generator(){
            if (!function_exists('wpcf7_add_tag_generator')) {
                return;
            }
        
            wpcf7_add_tag_generator('uacf7_spam_protection',
                __('Spam Protection', 'ultimate-addons-cf7'),
                'uacf7-tg-pane-spam-protection',
                array($this, 'tg_pane_spam_protection')
            );
        }
        

        public static function tg_pane_spam_protection($contact_form, $args = ''){
            $args             = wp_parse_args($args, array());
            $uacf7_field_type = 'uacf7_spam_protection';
            ?>
        <div class="control-box">
        <fieldset>
                    <table class="form-table">
                    <tbody>
                            <div class="uacf7-doc-notice"> 
                                <?php echo sprintf( 
                                    __( 'Not sure how to set this? Check our step by step  %1s.', 'ultimate-addons-cf7' ),
                                    '<a href="https://themefic.com/docs/uacf7/free-addons/spam-protection/" target="_blank">documentation</a>'
                                ); ?> 
                            </div>
                            <tr>
                            <th scope="row"><?php _e( 'Field Type', 'ultimate-addons-cf7' );?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><?php _e( 'Field Type', 'ultimate-addons-cf7' );?></legend>
                                        <label><input type="checkbox" name="required" value="on"><?php _e( 'Required Field', 'ultimate-addons-cf7' );?></label>
                                    </fieldset>
                                </td>
                            </tr> 
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

        public function uacf7_spam_protection_add_shortcodes() {
            wpcf7_add_form_tag( array( 'uacf7_spam_protection', 'uacf7_spam_protection*' ),
                array( $this, 'uacf7_spam_protection_tag_handler_callback' ), array( 'name-attr' => true )
            );
        } 

        public function uacf7_spam_protection_tag_handler_callback($tag){

            if (empty($tag->name)) {
                return '';
            }
             
         /** Enable / Disable Spam Protection */
            $wpcf7  = WPCF7_ContactForm::get_current();
            $formid = $wpcf7->id();
        
            $uacf7_spam_protection = uacf7_get_form_option($formid, 'spam_protection');
        
            if($uacf7_spam_protection['uacf7_spam_protection_enable'] != '1'){
                return;
            }
        
            $validation_error = wpcf7_get_validation_error($tag->name);
        
            $class = wpcf7_form_controls_class($tag->type);
        
        
            if ($validation_error) {
                $class .= 'wpcf7-not-valid';
            }

            $atts = array();

          
            $ip = $_SERVER['REMOTE_ADDR'];
		    $addr = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

            $atts['iso2']              = isset($addr['countryCode']);
            $atts['class']             = $tag->get_class_option($class);
            $atts['class']             = 'uacf7_spam_protection';
            $atts['protection-method'] = $uacf7_spam_protection['uacf7_spam_protection_type'];
            $atts['id']                = $tag->get_id_option();


            $atts['tabindex']          = $tag->get_option('tabindex', 'signed_int', true);
        
            if ($tag->is_required()) {
                $atts['aria-required'] = 'true';
            }
        
            $atts['aria-invalid'] = $validation_error ? 'true' : 'false';
            $atts['name']         = $tag->name;
            $atts['user-ip']      = $_SERVER['REMOTE_ADDR'];
            $value                = $tag->values;
            $default_value        = $tag->get_default_option($value);
            $atts['value']        = $value;
            $atts['name']         = $tag->name;
            $atts                 = wpcf7_format_atts($atts);

         
            ob_start();
        
            ?> 
                <span  class="wpcf7-form-control-wrap <?php echo sanitize_html_class($tag->name); ?>" data-name="<?php echo sanitize_html_class($tag->name);  ?>" >
                    <div class="uacf7_spam_recognation" <?php echo ($atts);  ?>>
                        <?php if($uacf7_spam_protection['uacf7_spam_protection_type'] === 'arithmathic_recognation'){ ?>
                            <div id="arithmathic_recognation">
         
                                <div id="arithmetic_input_holder">
                                    <span id="frn">5</span>
                                    +
                                    <span id="srn">6</span>
                                    =
                                    <input type="number" min="0" id="rtn" placeholder="Enter CAPTCHA answer">
                                </div>
                                <div>
                                <button id="arithmathic_refresh">Refresh</button>
                                <button id="arithmathic_validate">Validate</button>
                                </div>
                                <div id="arithmathic_result"></div>
                            </div>

                        <?php }else if($uacf7_spam_protection['uacf7_spam_protection_type'] === 'image_recognation'){ ?>

                            <div id="image_recognation">
                                <div id="captcha_input_holder">
                                <div id="captcha" ></div>
                                <input type="text" id="userInput" placeholder="Enter CAPTCHA text">
                                </div>
                                <div>
                                <button id="refresh">Refresh</button>
                                <button id="validate">Validate</button>
                                </div>
                                <div id="result"></div>
                            </div> 

                        <?php }else{ ?>
                            <p>No Protection is applied</p>
                        <?php } ?>
                           
                   </div>
                </span>

            <?php 
        
            $spam_protection_buffer = ob_get_clean();

            return $spam_protection_buffer;
       
            // return apply_filters( 'uacf7_range_slider_style_pro_feature', $spam_protection_buffer, $tag); 
        
        }
    }

    new UACF7_SPAM_PROTECTION();