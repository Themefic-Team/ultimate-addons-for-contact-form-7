<?php

/** Prevent direct access */
if (!defined('ABSPATH')) {
    echo "You are not allowed to access directly";
    exit();
}


class ULTIMATE_MATERIAL_DESIGN {
    public function __construct(){
        add_filter( 'uacf7_post_meta_options', [ $this, 'uacf7_post_meta_options_material_design'], 26, 2 ); 
        add_action( 'wp_enqueue_scripts', [$this, 'uacf7_material_design_scripts']);
        add_filter( 'wpcf7_contact_form_properties', array( $this, 'uacf7_material_design_form_properties' ), 10, 2 );
    }

    public function uacf7_material_design_scripts(){

        wp_register_script('uacf7-md-outlined-script', UACF7_URL . 'addons/material-design/assets/js/uacf7-md-outlined-script.js', ['jquery'], 'WPCF7_VERSION', true);
        wp_register_script('uacf7-md-filled-script', UACF7_URL . 'addons/material-design/assets/js/uacf7-md-filled-script.js', ['jquery'], 'WPCF7_VERSION', true);
        wp_register_script('uacf7-md-dark-script', UACF7_URL . 'addons/material-design/assets/js/uacf7-md-dark-script.js', ['jquery'], 'WPCF7_VERSION', true);


        wp_register_style( 'md-option-outlined', UACF7_URL . 'addons/material-design/assets/css/uacf7-md-outlined.css', [], time(), 'all' );
        wp_register_style( 'md-option-filled', UACF7_URL . 'addons/material-design/assets/css/uacf7-md-filled.css', [], time(), 'all' );
        wp_register_style( 'md-option-dark', UACF7_URL . 'addons/material-design/assets/css/uacf7-md-dark.css', [], time(), 'all' );
    }


    public function uacf7_material_design_form_properties($properties, $cfform){
        if (!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) { 

            $form                       = $properties['form'];
            $form_id                    = $cfform->id();
            $uacf7_material_design      = uacf7_get_form_option($form_id, 'material_design');
            $uacf7_material_design_type = isset($uacf7_material_design['uacf7_material_design_type']) ? $uacf7_material_design['uacf7_material_design_type'] : '';
            $class  =  !empty($uacf7_material_design_type) ? ' uacf7-material-design-'. $uacf7_material_design_type : ''; 


            if ($uacf7_material_design_type === 'filled') {

                wp_enqueue_style('md-option-filled');
                wp_enqueue_script('uacf7-md-filled-script');
          
            } elseif ($uacf7_material_design_type === 'dark') {

                wp_enqueue_style('md-option-dark');
                wp_enqueue_script('uacf7-md-dark-script');
          
             
            } else{
                wp_enqueue_style('md-option-outlined');
                wp_enqueue_script('uacf7-md-outlined-script');
            }
           
            ob_start();
            
            echo '<div class="'.esc_attr(  $class ).'">'.$form.'</div>';

            $properties['form'] = ob_get_clean();

        }

        return $properties;
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
                        'outlined' => 'Outlined',
                        'filled'   => 'Filled',
                        'dark'     => 'Dark',
                    )
                ),

            )
                
        ), $post_id);
    
        $value['material_design'] = $material_design; 
        return $value;
    }
}


new ULTIMATE_MATERIAL_DESIGN();