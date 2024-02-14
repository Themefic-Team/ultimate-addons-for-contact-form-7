<?php

/** Prevent direct access */
    if (!defined('ABSPATH')) {
        echo "You are not allowed to access directly";
        exit();
    }


    class ULTIMATE_FORM_PREVIEW{

        public function __construct(){

            add_action('wp_enqueue_scripts', [$this, 'uacf7_form_preview_public_assets_loading']); 

            add_filter( 'uacf7_post_meta_options', array($this, 'uacf7_post_meta_options_form_preview'), 24, 2 ); 

            $file_path = plugin_dir_path(__FILE__) . 'inc/uacf7-form-preview.php';

            include_once($file_path);
        }

        public function uacf7_post_meta_options_form_preview($value, $post_id){
            $form_preview = apply_filters('uacf7_post_meta_options_form_preview_pro', $data = array(
                'title'  => __( 'Form Preview', 'ultimate-addons-cf7' ),
                'icon'   => 'fa-solid fa-magnifying-glass',
                'fields' => array(
                    'uacf7_form_preview_heading' => array(
                        'id'    => 'uacf7_form_preview_heading',
                        'type'  => 'heading', 
                        'label' => __( 'Form Preview', 'ultimate-addons-cf7' ),
                        'subtitle' => sprintf(
                            __( 'Allow you to preview the form before Submission. See Demo %1s.', 'ultimate-addons-cf7' ),
                             '<a href="https://cf7addons.com/preview/form-submit-later-and-continue/" target="_blank" rel="noopener">Example</a>'
                                      )
                          ),
                          array(
                            'id'      => 'submit-form-preview-docs',
                            'type'    => 'notice',
                            'style'   => 'success',
                            'content' => sprintf( 
                                __( 'Confused? Check our Documentation on  %1s.', 'ultimate-addons-cf7' ),
                                '<a href="https://themefic.com/docs/uacf7/free-addons/submit-form-later-and-continue/" target="_blank" rel="noopener">Submit Later</a>'
                            )
                          ),
         
                   'uacf7_form_preview_enable' => array(
                    'id'    => 'uacf7_form_preview_enable',
                    'type'               => 'switch',
                    'label'              => __( 'Enable Form Preview', 'ultimate-addons-cf7' ),
                    'default' => false
                    ),
                   'uacf7_form_preview_title' => array(
                    'id'    => 'uacf7_form_preview_title',
                    'type'               => 'text',
                    'label'              => __( 'Form Preview Title', 'ultimate-addons-cf7' ),
                    'placeholder'              => __( 'Form Preview', 'ultimate-addons-cf7' ),
                    'default' => 'Form Preview'
                    ),
         
                   'uacf7_form_preview_button_layout' => array(
                    'id'    => 'uacf7_form_preview_button_layout',
                    'type'               => 'heading',
                    'label'              => __( 'Preview Button Layout', 'ultimate-addons-cf7' ),
                    'description'     => __( 'Copy the code and paste anywhere of Form. Please Note: The button ID can not be changed. You can change the button text. <button class="ucaf7-form-preview-layout">Copy Layout</button>', 'ultimate-addons-cf7' ),
                    'class' => 'uacf7-form-preview-layout'
                    ),
                       
                ),   
        
            ), $post_id);
        
            $value['form_preview'] = $form_preview; 
            return $value;
        }

        public function uacf7_form_preview_public_assets_loading(){

                /** Enable / Disable Form Preview*/
                $wpcf7                     = WPCF7_ContactForm::get_current();
                $formid                    = $wpcf7->id();
                $form_preview              = uacf7_get_form_option( $formid, 'form_preview' );
                $uacf7_form_preview_title = isset($form_preview['uacf7_form_preview_title']) ? $form_preview['uacf7_form_preview_title'] : 'Form Preview';
                $uacf7_form_preview_enable = isset($form_preview['uacf7_form_preview_enable']) ? $form_preview['uacf7_form_preview_enable'] : false;
                
                if($uacf7_form_preview_enable != true){ ?>
                <style>
                    #uacf7-preview-btn{display: none}
                </style>
                <?php  return;
                }

                wp_enqueue_script('preview_form_public_js', UACF7_URL . 'addons/form-preview/assets/public/js/public-form-preview.js', ['jquery'], 'UAFC7_VERSION', true);
               
                wp_enqueue_style('form_preview_public_css', UACF7_URL . 'addons/form-preview/assets/public/css/public-form-preview.css', [], 'UAFC7_VERSION', true, 'all');
               
                wp_localize_script( 'preview_form_public_js', 'uacf7_preview_form_obj', [
                    'preview_heading'   => __(  $uacf7_form_preview_title, 'ultimate-addons-cf7')
                ] );
        }

       
    }

    new ULTIMATE_FORM_PREVIEW();