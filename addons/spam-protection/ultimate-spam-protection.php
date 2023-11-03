<?php
    if ( !defined( 'ABSPATH' ) ) {
        exit;
    }

    class UACF7_SPAM_PROTECTION{
       
        public function __construct(){

            add_action( 'wpcf7_init', [ $this, 'uacf7_spam_protection_add_shortcodes' ]);
            add_action( 'admin_init', [ $this, 'uacf7_spam_protection_tag_generator' ]);
            add_filter( 'uacf7_post_meta_options', [ $this, 'uacf7_post_meta_options_spam_protection'], 24, 2 ); 
            add_action('wp_enqueue_scripts', [$this, 'uacf7_spam_protection_scripts']);
        }

        public function uacf7_spam_protection_scripts(){
            wp_enqueue_script('uacf7-spam-protection', UACF7_URL . '/addons/spam-protection/assets/js/spam-protection-script.js', ['jquery'], 'WPCF7_VERSION', true);
            // wp_enqueue_style('submission_id_public_css', UACF7_URL . '/addons/submission-id/assets/public/css/public-submission-id.css', [], 'UAFC7_VERSION', true, 'all');
 
          
        }

        public function uacf7_post_meta_options_spam_protection($value, $post_id){
            $spam_protection = apply_filters('uacf7_post_meta_options_spam_protection_pro', $data = array(
                'title'  => __( 'Spam Protection', 'ultimate-addons-cf7' ),
                'icon'   => 'fa-solid fa-spaghetti-monster-flying',
                'fields' => array(
                    'uacf7_spam_protection_heading' => array(
                        'id'    => 'uacf7_spam_protection_heading',
                        'type'  => 'heading',
                        'label' => __( 'Spam Protection', 'ultimate-addons-cf7' ),
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
                            'image_recognation' => 'Image Recognation',
                        ),
                        'default'   => false
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
            $args = wp_parse_args($args, array());
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
            $wpcf7 = WPCF7_ContactForm::get_current(); 
            $formid = $wpcf7->id();
        
            $uacf7_spam_protection = uacf7_get_form_option($formid, 'spam_protection');
            $uacf7_spam_protection_enable = $uacf7_spam_protection['uacf7_spam_protection_enable']; 
            $uacf7_spam_protection_type = $uacf7_spam_protection['uacf7_spam_protection_type']; 
        
            if($uacf7_spam_protection_enable != '1'){
                return;
            }
        
            $validation_error = wpcf7_get_validation_error($tag->name);
        
            $class = wpcf7_form_controls_class($tag->type);
        
        
            if ($validation_error) {
                $class .= 'wpcf7-not-valid';
            }
        
            $atts = array();
        
            $atts['class'] = $tag->get_class_option($class);
            $atts['class'] = 'uacf7_spam_recognation';
            $atts['id'] = $tag->get_id_option();
            $atts['data-recognation-type'] = $uacf7_spam_protection_type;
            $atts['tabindex'] = $tag->get_option('tabindex', 'signed_int', true);
        
            if ($tag->is_required()) {
                $atts['aria-required'] = 'true';
            }
        
            $atts['aria-invalid'] = $validation_error ? 'true' : 'false';
        
            $atts['name'] = $tag->name;
        
           
            $value = $tag->values;
            $default_value = $tag->get_default_option($value);
        
        
        
            $atts['value'] = $value;
        
            $atts['name'] = $tag->name;
        
            $atts = wpcf7_format_atts($atts);
            
            ob_start();
        
            ?> 
                <span  class="wpcf7-form-control-wrap <?php echo sanitize_html_class($tag->name); ?>" data-name="<?php echo sanitize_html_class($tag->name); ?>">

                    <input id="uacf7_<?php echo esc_attr($tag->name); ?>" <?php echo $atts;?> >
                    <span><?php echo $validation_error; ?></span>

                </span>

            <?php 
        
            $spam_protection_buffer = ob_get_clean();

            return $spam_protection_buffer;
       
            // return apply_filters( 'uacf7_range_slider_style_pro_feature', $spam_protection_buffer, $tag); 
        
        }
    }

    new UACF7_SPAM_PROTECTION();