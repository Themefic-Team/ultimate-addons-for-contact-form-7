<?php
    if ( !defined( 'ABSPATH' ) ) {
        exit;
    }



    class SPAM_PROTECTION{

        public function __construct(){
            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_spam_protection'), 24, 2 ); 
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
        
                 
                   
                )
                    
        
            ), $post_id);
        
            $value['spam_protection'] = $spam_protection; 
            return $value;
        }
    }

    new SPAM_PROTECTION();
