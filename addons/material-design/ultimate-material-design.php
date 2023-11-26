<?php

/** Prevent direct access */
if (!defined('ABSPATH')) {
    echo "You are not allowed to access directly";
    exit();
}


class ULTIMATE_MATERIAL_DESIGN {
    public function __construct(){
        add_filter( 'uacf7_post_meta_options', [ $this, 'uacf7_post_meta_options_material_design'], 26, 2 ); 
    }

    public function uacf7_post_meta_options_material_design($value, $post_id){
        $material_design = apply_filters('uacf7_post_meta_options_spam_protection_pro', $data = array(
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
              

            )
                
        ), $post_id);
    
        $value['material_design'] = $material_design; 
        return $value;
    }
}


new ULTIMATE_MATERIAL_DESIGN();