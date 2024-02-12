<?php

/** Prevent direct access */
    if (!defined('ABSPATH')) {
        echo "You are not allowed to access directly";
        exit();
    }

    class ULTIMATE_SUBMIT_LATER{

        public function __construct(){
            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_submit_later'), 24, 2 ); 
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
                        'label'     => __( ' Enable Submit Form Later', 'ultimate-addons-cf7' ),
                        'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
                        'label_off' => __( 'No', 'ultimate-addons-cf7' ),
                        'default'   => false,
                    ),
               
                ),
                
        
            ), $post_id);
        
            $value['submit_later'] = $submit_later; 
            return $value;
        }

    }

    new ULTIMATE_SUBMIT_LATER();