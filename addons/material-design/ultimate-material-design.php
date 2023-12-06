<?php

/** Prevent direct access */
if (!defined('ABSPATH')) {
    echo "You are not allowed to access directly";
    exit();
}


class ULTIMATE_MATERIAL_DESIGN {
    public function __construct(){
        add_action( 'wpcf7_init', [ $this, 'uacf7_material_design_add_shortcodes' ]);
        add_action( 'admin_init', [ $this, 'uacf7_material_design_tag_generator' ]);
        add_filter( 'uacf7_post_meta_options', [ $this, 'uacf7_post_meta_options_material_design'], 26, 2 ); 
        add_action( 'wp_enqueue_scripts', [$this, 'uacf7_material_design_scripts']);
        add_filter( 'wpcf7_contact_form_properties', array( $this, 'uacf7_material_design_form_properties' ), 10, 2 );

        // add_filter( 'wpcf7_load_js', '__return_false' ); 
    }

    public function uacf7_material_design_scripts(){

        wp_register_script('uacf7-md-one-script', UACF7_URL . 'addons/material-design/assets/js/uacf7-md-one-script.js', ['jquery'], 'WPCF7_VERSION', true);
        wp_register_script('uacf7-md-two-script', UACF7_URL . 'addons/material-design/assets/js/uacf7-md-two-script.js', ['jquery'], 'WPCF7_VERSION', true);


        wp_register_style( 'md-option-one', UACF7_URL . 'addons/material-design/assets/css/uacf7-md-option-one.css', [], time(), 'all' );
        wp_register_style( 'md-option-two', UACF7_URL . 'addons/material-design/assets/css/uacf7-md-option-two.css', [], time(), 'all' );
    }


    public function uacf7_material_design_form_properties($properties, $cfform){
        if (!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) { 

            $form = $properties['form'];

            ob_start();

            echo '<div class="uacf7-material-design">'.$form.'</div>';

            $properties['form'] = ob_get_clean();
        }

        return $properties;
    }



    public function uacf7_material_design_tag_generator(){
        if (!function_exists('wpcf7_add_tag_generator')) {
            return;
        }
    
        wpcf7_add_tag_generator('uacf7_material_design',
            __('Material Design', 'ultimate-addons-cf7'),
            'uacf7-tg-pane--material-design',
            array($this, 'tg_pane_material_design')
        );
    }

    public function tg_pane_material_design($contact_form, $args = ''){
        $args             = wp_parse_args($args, array());
        $uacf7_field_type = 'uacf7_material_design';
        ?>
        <div class="control-box">
        <fieldset>
                    <table class="form-table">
                    <tbody>
                            <div class="uacf7-doc-notice"> 
                                <?php echo sprintf( 
                                    __( 'Not sure how to set this? Check our step by step  %1s.', 'ultimate-addons-cf7' ),
                                    '<a href="https://themefic.com/docs/uacf7/free-addons/material-design/" target="_blank">documentation</a>'
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

    public function uacf7_material_design_add_shortcodes(){
        wpcf7_add_form_tag( array( 'uacf7_material_design', 'uacf7_material_design*' ),
        array( $this, 'uacf7_material_design_tag_handler_callback' ), array( 'name-attr' => true )
        );
    }

    public function uacf7_material_design_tag_handler_callback($tag){
        
        if (empty($tag->name)) {
            return '';
        }
         
     /** Enable / Disable Material Design */
        $wpcf7  = WPCF7_ContactForm::get_current();
        $formid = $wpcf7->id();
    
        $uacf7_material_design = uacf7_get_form_option($formid, 'material_design');

        $uacf7_material_design_type = isset($uacf7_material_design['uacf7_material_design_type']) ? $uacf7_material_design['uacf7_material_design_type'] : '';

        // var_dump($uacf7_material_design_type);

        // die();

    
        if(isset($uacf7_material_design['uacf7_material_design_enable']) && $uacf7_material_design['uacf7_material_design_enable'] != '1'){
            return;
        }
    
        $validation_error = wpcf7_get_validation_error($tag->name);
    
        $class = wpcf7_form_controls_class($tag->type);
    
    
        if ($validation_error) {
            $class .= 'wpcf7-not-valid';
        }

        $atts = array();

        $atts['class']             = $tag->get_class_option($class);
        $atts['class']             = 'uacf7_material_design';
        $atts['id']                = $tag->get_id_option();


        $atts['tabindex']          = $tag->get_option('tabindex', 'signed_int', true);
    
        if ($tag->is_required()) {
            $atts['aria-required'] = 'true';
        }
    
        $atts['aria-invalid'] = $validation_error ? 'true' : 'false';
        $atts['name']         = $tag->name;
        $value                = $tag->values;
        $default_value        = $tag->get_default_option($value);
        $atts['value']        = $value;
        $atts['name']         = $tag->name;
        $atts                 = wpcf7_format_atts($atts);


        ob_start();

        if($uacf7_material_design_type === 'option_one'){ 
          
            wp_enqueue_style( 'md-option-one' );
            wp_enqueue_script( 'uacf7-md-one-script' ); 
            
        ?> 

            <div class="uacf7_material_design_type_one" <?php echo ($atts);  ?>></div>

        <?php }elseif($uacf7_material_design_type === 'option_two'){
            wp_enqueue_style( 'md-option-two'); 
            wp_enqueue_script( 'uacf7-md-two-script' ); 
       
        ?> 
            <div class="uacf7_material_design_type_two" <?php echo ($atts);  ?>>
        
        </div>
        <?php }else{ ?>
               <div <?php echo ($atts);  ?>></div>
        <?php }

        $material_design_buffer = ob_get_clean();

        return $material_design_buffer;
   

    }

    public function uacf7_post_meta_options_material_design($value, $post_id){
        $material_design = apply_filters('uacf7_post_meta_options_material_design_pro', $data = array(
            'title'  => __( 'Material Design', 'ultimate-addons-cf7' ),
            'icon'   => 'fa-solid fa-swatchbook',
            'fields' => array(
                'uacf7_material_design_heading' => array(
                    'id'      => 'uacf7_material_design_heading',
                    'type'    => 'notice',
                    'notice'  => 'info',
                    'label'   => __( 'Material Design Settings', 'ultimate-addons-cf7' ),
                    'title'   => __( 'This feature will help you to design your form Beautifully', 'ultimate-addons-cf7' ),
                    'content' => sprintf( 
                        __( 'Not sure how to set this? Check our step by step documentation on  %s .', 'ultimate-addons-cf7' ),
                        '<a href="https://themefic.com/docs/uacf7/free-addons/material-design-for-contact-form-7/" target="_blank">Material Design for Contact Form 7</a>',
                       
                    ),
                ),
                'uacf7_material_design_enable' => array(
                    'id'        => 'uacf7_material_design_enable',
                    'type'      => 'switch',
                    'label'     => __( ' Enable/Disable Material Design', 'ultimate-addons-cf7' ),
                    'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
                    'label_off' => __( 'No', 'ultimate-addons-cf7' ),
                    'default'   => false
                ),
              
                'uacf7_material_design_type' => array(
                    'id'        => 'uacf7_material_design_type',
                    'type'      => 'select',
                    'label'     => __( 'Material Type', 'ultimate-addons-cf7' ),
                    'options'   => array(
                        'option_one' => 'Outlined',
                        'option_two' => 'Filled'
                    )
                ),

            )
                
        ), $post_id);
    
        $value['material_design'] = $material_design; 
        return $value;
    }
}


new ULTIMATE_MATERIAL_DESIGN();