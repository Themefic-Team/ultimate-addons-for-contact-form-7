<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UACF7_MULTISTEP {
    
    private $hidden_fields = array();
    
    /*
    * Construct function
    */
    public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_script' ) );
        add_action( 'admin_init', array( $this, 'tag_generator' ) );        
        add_action( 'wp_ajax_check_fields_validation', array( $this, 'check_fields_validation' ) );
        add_action( 'wp_ajax_nopriv_check_fields_validation', array( $this, 'check_fields_validation' ) );

        wpcf7_add_form_tag( 'uacf7_step_start', array( $this, 'step_start_tag_handler' ), true );
        wpcf7_add_form_tag( 'uacf7_step_end', array( $this, 'step_end_tag_handler' ), false );

        // wpcf7_add_form_tag( 'uacf7_multistep_progressbar', array( $this, 'uacf7_multistep_progressbar' ), true );  

        add_filter( 'wpcf7_contact_form_properties', array( $this, 'uacf7_properties' ), 10, 2 );
        add_filter( 'uacf7_post_meta_options', array( $this, 'uacf7_post_meta_options_multistep' ), 14, 2 );  
        add_filter( 'uacf7_post_meta_options_multistep_pro', array( $this, 'uacf7_post_meta_options_multistep_pro' ), 10, 2 );  
        add_filter( 'uacf7_multistep_steps_names', array( $this, 'uacf7_multistep_steps_names' ), 10, 2 );  
        add_filter( 'uacf7_multistep_step_title', array( $this, 'uacf7_multistep_step_title' ), 10, 2 );   
    }
    
    public function enqueue_script() {
        wp_enqueue_script( 'uacf7-multistep', UACF7_ADDONS . '/multistep/assets/js/multistep.js', array('jquery'), UACF7_VERSION, true );
        wp_enqueue_script( 'uacf7-progressbar', UACF7_ADDONS . '/multistep/assets/js/progressbar.js', array('jquery'), UACF7_VERSION, true );
        wp_enqueue_style( 'uacf7-multistep-style', UACF7_ADDONS . '/multistep/assets/css/multistep.css', array(), UACF7_VERSION);

        
        wp_localize_script('uacf7-multistep', 'uacf7_multistep_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'), 
        'nonce' => wp_create_nonce('uacf7-multistep') ));
    }

    // Steps Name: uacf7_multistep_steps_names
    function uacf7_multistep_steps_names($steps_name, $all_steps){
        $step_names = array();
        foreach ($all_steps as $step) { 
            $step_names[] = !empty($step->name) ? $step->name : '';
    
        }
         
        return $step_names;
    }
    // Steps Name: uacf7_multistep_steps_names
    function uacf7_multistep_step_title($step_titles, $all_steps){
        $step_titles = array();
        foreach ($all_steps as $step) { 
            $step_titles[] = (is_array($step->values) && !empty($step->values)) ? $step->values[0] : '';
    
        }
        return $step_titles;
    }


    public function uacf7_post_meta_options_multistep( $value, $post_id){

        $multistep = apply_filters('uacf7_post_meta_options_multistep_pro', $data = array(
			'title'  => __( 'Multi-step Form', 'ultimate-addons-cf7' ),
			'icon'   => 'fa-solid fa-stairs',
            'checked_field'   => 'uacf7_multistep_is_multistep',
			'fields' => array(
                'placeholder_heading' => array(
					'id'    => 'placeholder_heading',
					'type'  => 'heading', 
					'label' => __( 'Multi-step Form Settings', 'ultimate-addons-cf7' ),
					'subtitle' => sprintf(
                        // translators: %1$s is a placeholder for the link to the demo.
                        __( 'Create stunning multi-step forms with Contact Form 7. Ideal solution for long forms. See Demo %1$s.', 'ultimate-addons-cf7' ),
                        '<a href="https://cf7addons.com/preview/contact-form-7-multi-step-forms/" target="_blank">Example</a>'
                    )
                    
				),
                'multistep_form_docs' => array(
					'id'      => 'multistep_form_docs',
					'type'    => 'notice',
					'style'   => 'success',
                    'content' => sprintf( 
                        // translators: %1$s is a placeholder for the link to the free multi-step form documentation, and %2$s is a placeholder for the link to the pro multi-step form documentation.
                        __( 'Confused? Check our Documentation on %1$s and %2$s.', 'ultimate-addons-cf7' ),
                        '<a href="https://themefic.com/docs/uacf7/free-addons/contact-form-7-multi-step-forms/" target="_blank">Multi-step Form</a>',
                        '<a href="https://themefic.com/docs/uacf7/pro-addons/contact-form-7-multi-step-form-pro/" target="_blank">Multi-step Form (Pro)</a>'
                    )
                    
                    
				),
				'uacf7_multistep_is_multistep' => array(
					'id'        => 'uacf7_multistep_is_multistep',
					'type'      => 'switch',
					'label'     => __( ' Enable Multistep', 'ultimate-addons-cf7' ),
					'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
					'label_off' => __( 'No', 'ultimate-addons-cf7' ),
					'default'   => false,
                    'field_width' => 100,
                ),
                'uacf7_multistep_form_options_heading' => array(
                    'id'        => 'uacf7_multistep_form_options_heading',
                    'type'      => 'heading',
                    'label'     => __( 'Multistep Option ', 'ultimate-addons-cf7' ),
                ),
                'uacf7_enable_multistep_progressbar' => array(
					'id'        => 'uacf7_enable_multistep_progressbar',
					'type'      => 'switch',
					'label'     => __( ' Enable Progressbar ', 'ultimate-addons-cf7' ),
					'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
					'label_off' => __( 'No', 'ultimate-addons-cf7' ),
					'default'   => false,
                    'field_width' => 50,
				),
                'uacf7_enable_multistep_scroll' => array(
					'id'        => 'uacf7_enable_multistep_scroll',
					'type'      => 'switch',
					'label'     => __( 'Enable Form Auto Scrolling ', 'ultimate-addons-cf7' ),
					'description'     => __( 'Auto scroll to top after clicking the next button.', 'ultimate-addons-cf7' ),
					'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
					'label_off' => __( 'No', 'ultimate-addons-cf7' ),
					'default'   => false,
                    'is_pro' => true,
                    'field_width' => 50,
				),
                'uacf7_multistep_use_step_labels' => array(
                    'id'        => 'uacf7_multistep_use_step_labels',
                    'type'      => 'switch',
                    'label'     => __( 'Hide Progressbar Labels ', 'ultimate-addons-cf7' ),
                    'label_on'  => __( 'Yes', 'ultimate-addons-cf7' ),
                    'label_off' => __( 'No', 'ultimate-addons-cf7' ),
                    'default'   => false,
                    'field_width' => 50,
                ),
                'uacf7_progressbar_style' => array(
					'id'        => 'uacf7_progressbar_style',
                    'type'     => 'imageselect',
					'label'     => __( ' Progressbar Layout (Multistep Skins)', 'ultimate-addons-cf7' ),
					'description'     => __( 'See live demo examples here: <a href="URL_TO_LIVE_DEMO" target="_blank">Live demo</a>. Check our step by step <a href="URL_TO_DOCUMENTATION" target="_blank">documentation</a>.', 'ultimate-addons-cf7' ),
                    'multiple' 		=> true,
                    'inline'   		=> true,
                    'overlay'   	=> true,
                    'options' => array(
                        'default' 				=> array(
                            'title'			=> 'Default',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/default.png", 
                        ), 
                        'style-1' 				=> array(
                            'title'			=> 'Style 1',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-1.png", 
                        ), 
                        'style-2' 				=> array(
                            'title'			=> 'Style 2',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-2.png",
                            'is_pro' => true,    
                        ), 
                        'style-3' 				=> array(
                            'title'			=> 'Style 3',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-3.png",
                            'is_pro' => true,    
                        ), 
                        'style-4' 				=> array(
                            'title'			=> 'Style 4',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-4.png",
                            'is_pro' => true,    
                        ), 
                        'style-5' 				=> array(
                            'title'			=> 'Style 5',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-5.png",
                            'is_pro' => true,    
                        ), 
                        'style-6' 				=> array(
                            'title'			=> 'Style 6',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-6.png",
                            'is_pro' => true,    
                        ), 
                        'style-7' 				=> array(
                            'title'			=> 'Style 7',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-7.png",
                            'is_pro' => true,    
                        ),
                        'style-8' 				=> array(
                            'title'			=> 'Style 8',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-8.png",
                            'is_pro' => true,    
                        ),
                        'style-9' 				=> array(
                            'title'			=> 'Style 9',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-9.png",
                            'is_pro' => true,    
                        ),
                        'style-10' 				=> array(
                            'title'			=> 'Style 10',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-10.png",
                            'is_pro' => true,    
                        ),
                        'style-11' 				=> array(
                            'title'			=> 'Style 11',
                            'url' 			=> UACF7_ADDONS."/multistep/assets/img/skin-11.png",
                            'is_pro' => true,    
                        ),
                     ), 
                   
                    ),

                

                'progressbar_styling' => array(
                    'id'    => 'progressbar_styling',
                    'type'  => 'heading', 
                    'label' => __( 'Progressbar Styles', 'ultimate-addons-cf7' ),
                ),

                'uacf7_multistep_skin_11_margin_top' => array(
                    'id'       => 'uacf7_multistep_skin_11_margin_top',
                    'type'     => 'number',
                    'label'    => __( 'Margin Top (From Progressbar Lavel)', 'ultimate-addons-cf7' ),
                    'description' => __( ' E.g. 206 (Do not add px or em ). Use 1 to match the lavel', 'ultimate-addons-cf7' ),
                    'field_width' => 100,
                    'default' => 206,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '==', 'style-11' )
                    )
                
                ),

                'uacf7_multistep_progress_bg_color' => array(
                    'id'       => 'uacf7_multistep_progress_bg_color',
                    'type'     => 'color',
                    'label'    => __( 'Progressbar Background Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-3' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-4' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-5' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-8' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-9' ),
                    )
                
                ),
                'uacf7_multistep_circle_bg_color' => array(
                    'id'       => 'uacf7_multistep_circle_bg_color',
                    'type'     => 'color',
                    'label'    => __( 'Circle Background Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-5' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-8' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-10' ),
                    )
                
                ),

                'uacf7_multistep_circle_bg_active_color' => array(
                    'id'       => 'uacf7_multistep_circle_bg_active_color',
                    'type'     => 'color',
                    'label'    => __( 'Circle Background Active Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-3' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-4' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-5' )
                    )
                
                ),

                'uacf7_multistep_circle_bg_hover_color' => array(
                    'id'       => 'uacf7_multistep_circle_bg_hover_color',
                    'type'     => 'color',
                    'label'    => __( 'Circle Background Hover Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-2' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-3' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-4' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-5' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-6' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-8' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-9' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-10' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-11' ),
                    )
                
                ),

                'uacf7_multistep_circle_font_color' => array(
                    'id'       => 'uacf7_multistep_circle_font_color',
                    'type'     => 'color',
                    'label'    => __( 'Circle Font Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                
                ),

                'uacf7_multistep_circle_active_icon_color' => array(
                    'id'       => 'uacf7_multistep_circle_active_icon_color',
                    'type'     => 'color',
                    'label'    => __( 'Circle Active Icon Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-8' ),
                
                ),
                'uacf7_multistep_circle_icon_color_style_6' => array(
                    'id'       => 'uacf7_multistep_circle_icon_color_style_6',
                    'type'     => 'color',
                    'label'    => __( 'Circle Icon Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-6' ),
                
                ),
                'uacf7_multistep_circle_active_icon_color_style_6' => array(
                    'id'       => 'uacf7_multistep_circle_active_icon_color_style_6',
                    'type'     => 'color',
                    'label'    => __( 'Circle Active Icon Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-6' ),
                
                ),
             
                'uacf7_multistep_circle_icon_color_style_2' => array(
                    'id'       => 'uacf7_multistep_circle_icon_color_style_2',
                    'type'     => 'color',
                    'label'    => __( 'Circle Icon Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-2' ),
                
                ),
                'uacf7_multistep_circle_icon_color_style_4' => array(
                    'id'       => 'uacf7_multistep_circle_icon_color_style_4',
                    'type'     => 'color',
                    'label'    => __( 'Circle Icon Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-4' ),
                
                ),
                'uacf7_multistep_circle_icon_active_color_style_2' => array(
                    'id'       => 'uacf7_multistep_circle_icon_active_color_style_2',
                    'type'     => 'color',
                    'label'    => __( 'Circle Icon Active Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-2' ),
                
                ),


                'uacf7_multistep_circle_font_hover_color' => array(
                    'id'       => 'uacf7_multistep_circle_font_hover_color',
                    'type'     => 'color',
                    'label'    => __( 'Circle Font Hover Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-2' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-3' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-4' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-5' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-6' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-8' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-9' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-10' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-11' ),
                    )
                
                ),
                'uacf7_multistep_circle_active_font_color' => array(
                    'id'       => 'uacf7_multistep_circle_active_font_color',
                    'type'     => 'color',
                    'label'    => __( 'Circle Active Font Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-2' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-3' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-4' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-5' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-6' ),
                    )
                
                ),
                'uacf7_multistep_progress_line_color' => array(
                    'id'       => 'uacf7_multistep_progress_line_color',
                    'type'     => 'color',
                    'label'    => __( 'Progressbar Line Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-2' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-5' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-9' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-10' ),
                    ),
                
                ),
                'uacf7_multistep_progress_line_color_style_2' => array(
                    'id'       => 'uacf7_multistep_progress_line_color_style_2',
                    'type'     => 'color',
                    'label'    => __( 'Progressbar Line Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-2' ),
                
                ),
            
                'uacf7_multistep_progress_step_color_style_3' => array(
                    'id'       => 'uacf7_multistep_progress_step_color_style_3',
                    'type'     => 'color',
                    'label'    => __( 'Circle Step Color', 'ultimate-addons-cf7' ),
                    'multiple' => false,
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-3' ),
                
                ),

                'uacf7_multistep_circle_border_color' => array(
                    'id'        => 'uacf7_multistep_circle_border_color',
                    'type'      => 'color',
                    'label'     => __( ' Circle Border Color', 'ultimate-addons-cf7' ),   
                    'field_width' => 33,
                    'dependency'  => array(
                        array( 'uacf7_progressbar_style', '!=', 'style-2' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-3' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-4' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-6' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-8' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-10' ),
                        array( 'uacf7_progressbar_style', '!=', 'style-11' ),
                    )
                ),
            
                'uacf7_multistep_circle_border_color_when_filled' => array(
                    'id'          => 'uacf7_multistep_circle_border_color_when_filled',
                    'type'        => 'color',
                    'label'       => __( ' Circle Border Filled Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-9' ),
                ),
                'uacf7_multistep_circle_border_color_when_active' => array(
                    'id'          => 'uacf7_multistep_circle_border_color_when_active',
                    'type'        => 'color',
                    'label'       => __( ' Circle Border Active Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-9' ),
                ),
                'uacf7_multistep_progress_filled_line_color' => array(
                    'id'          => 'uacf7_multistep_progress_filled_line_color',
                    'type'        => 'color',
                    'label'       => __( ' Progressbar Filled Line Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-7' ),
                ),
                'uacf7_multistep_progress_filled_line_color' => array(
                    'id'          => 'uacf7_multistep_progress_filled_line_color',
                    'type'        => 'color',
                    'label'       => __( ' Progressbar Filled Line Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_circle_bg_filled_color' => array(
                    'id'          => 'uacf7_multistep_circle_bg_filled_color',
                    'type'        => 'color',
                    'label'       => __( ' Circle Filled Background Color', 'ultimate-addons-cf7' ),
                    'field_width' =>33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_step_bg_color' => array(
                    'id'          => 'uacf7_multistep_step_bg_color',
                    'type'        => 'color',
                    'label'       => __( ' Step Background Color', 'ultimate-addons-cf7' ),
                    'field_width' =>33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_circle_active_icon_color' => array(
                    'id'          => 'uacf7_multistep_circle_active_icon_color',
                    'type'        => 'color',
                    'label'       => __( ' Step Active Icon Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_circle_active_icon_bg_color_style_7' => array(
                    'id'          => 'uacf7_multistep_circle_active_icon_bg_color_style_7',
                    'type'        => 'color',
                    'label'       => __( ' Step Active Icon Background Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-7' ),
                ),
                'uacf7_multistep_circle_active_icon_color_style_7' => array(
                    'id'          => 'uacf7_multistep_circle_active_icon_color_style_7',
                    'type'        => 'color',
                    'label'       => __( ' Step Active Icon Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-7' ),
                ),
           
                'uacf7_multistep_circle_filled_icon_color' => array(
                    'id'          => 'uacf7_multistep_circle_filled_icon_color',
                    'type'        => 'color',
                    'label'       => __( ' Step Filled Icon Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_circle_filled_icon_color' => array(
                    'id'          => 'uacf7_multistep_circle_filled_icon_color',
                    'type'        => 'color',
                    'label'       => __( ' Step Filled Icon Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_step_title_color' => array(
                    'id'          => 'uacf7_multistep_step_title_color',
                    'type'        => 'color',
                    'label'       => __( ' Step Title Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_step_desc_color' => array(
                    'id'          => 'uacf7_multistep_step_desc_color',
                    'type'        => 'color',
                    'label'       => __( ' Step Description Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-11' ),
                ),
                'uacf7_multistep_filled_font_color' => array(
                    'id'          => 'uacf7_multistep_filled_font_color',
                    'type'        => 'color',
                    'label'       => __( ' Circle Filled Font Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-10' ),
                ),

                'uacf7_multistep_circel_font_color_when_filled' => array(
                    'id'          => 'uacf7_multistep_circel_font_color_when_filled',
                    'type'        => 'color',
                    'label'       => __( ' Circle Font/Icon Filled Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-8' ),
                ),
                'uacf7_multistep_circel_bg_color_when_filled_style_8' => array(
                    'id'          => 'uacf7_multistep_circel_bg_color_when_filled_style_8',
                    'type'        => 'color',
                    'label'       => __( ' Circle Background Filled Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-8' ),
                  
                ),
                'uacf7_multistep_circel_bg_color_when_filled_style_9' => array(
                    'id'          => 'uacf7_multistep_circel_bg_color_when_filled_style_9',
                    'type'        => 'color',
                    'label'       => __( ' Circle Background Filled Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-9' ),
                  
                ),
                'uacf7_multistep_circle_filled_font_color' => array(
                    'id'          => 'uacf7_multistep_circle_filled_font_color',
                    'type'        => 'color',
                    'label'       => __( ' Circle Font Filled Color', 'ultimate-addons-cf7' ),
                    'field_width' => 33,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-9' ),
                  
                ),

                'uacf7_progressbar_size_option' => array(
                    'id'      => 'uacf7_progressbar_size_option',
                    'type'    => 'heading',
                    'label'   => __( 'Progressbar Size Options', 'ultimate-addons-cf7' ),
                    'content' => __( ' E.g. 16 (Do not add px or em ).', 'ultimate-addons-cf7' ),
                ),

                'uacf7_multistep_step_height' => array(
                    'id'    => 'uacf7_multistep_step_height',
                    'type'  => 'select',
                    'label' => __( 'Progressbar Height', 'ultimate-addons-cf7' ),
                    'options' => array(
                        'default'      => 'Default',
                        'equal-height' => 'Equal height'
                    )
                ),

                'uacf7_multistep_circle_font_weight' => array(
                    'id'          => 'uacf7_multistep_circle_font_weight',
                    'type'        => 'number',
                    'label'       => __( 'Circle Font Weight', 'ultimate-addons-cf7' ),
                    'placeholder' => __( ' E.g. 600 (Do not add px or em ).', 'ultimate-addons-cf7' ),
                    'field_width' => 50,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-1' )
        
                ),

                'uacf7_multistep_circle_height' => array(
                    'id'          => 'uacf7_multistep_circle_height',
                    'type'        => 'number',
                    'label'       => __( ' Circle Height', 'ultimate-addons-cf7' ),
                    'placeholder' => __( 'height', 'ultimate-addons-cf7' ),
                    'field_width' => 50,
                    'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-1' ),
                ),
           
                'uacf7_multistep_circle_width' => array(
                    'id'        => 'uacf7_multistep_circle_width',
                    'type'      => 'number',
                    'label'     => __( ' Circle Width', 'ultimate-addons-cf7' ),   
                    'placeholder'     => __( 'width', 'ultimate-addons-cf7' ), 
                    'field_width' => 50,
                ),

                'uacf7_multistep_circle_border' => array(
                    'id'        => 'uacf7_multistep_circle_border',
                    'type'      => 'number',
                    'label'     => __( ' Circle Border', 'ultimate-addons-cf7' ),   
                    'placeholder'     => __( 'border', 'ultimate-addons-cf7' ), 
                    'field_width' => 50,
                ), 
                
                'uacf7_multistep_font_size' => array(
                    'id'        => 'uacf7_multistep_font_size',
                    'type'      => 'number',
                    'label'     => __( ' Circle Font Size', 'ultimate-addons-cf7' ),   
                    'placeholder'     => __( 'font size', 'ultimate-addons-cf7' ), 
                    'field_width' => 50,
                ),
                'uacf7_multistep_circle_border_radious' => array(
                    'id'        => 'uacf7_multistep_circle_border_radious',
                    'type'      => 'number',
                    'label'     => __( ' Circle Border Radious', 'ultimate-addons-cf7' ),   
                    'placeholder'     => __( 'border radious', 'ultimate-addons-cf7' ), 
                    'field_width' => 50,
                ),
                'uacf7_progressbar_button_style' => array(
                    'id' => 'uacf7_progressbar_button_style',
                    'type'  => 'heading',
                    'label'     => __( 'Button Style', 'ultimate-addons-cf7' ), 
                    'content' => __( ' E.g. 16 (Do not add px or em ).', 'ultimate-addons-cf7' ), 
                ),
                'uacf7_multistep_button_padding_tb' => array(
                    'id'        => 'uacf7_multistep_button_padding_tb',
                    'type'      => 'number',
                    'label'     => __( ' Padding ( Top - Bottom )', 'ultimate-addons-cf7' ),   
                    'placeholder'     => __( 'y axis padding', 'ultimate-addons-cf7' ), 
                    'field_width' => 50,
                ),
                'uacf7_multistep_button_padding_lr' => array(
                    'id'        => 'uacf7_multistep_button_padding_lr',
                    'type'      => 'number',
                    'label'     => __( ' Padding ( Left - Right )', 'ultimate-addons-cf7' ),   
                    'placeholder'     => __( 'x axis padding', 'ultimate-addons-cf7' ), 
                    'field_width' => 50,
                ), 
                'uacf7_multistep_next_prev_style' => array(
                    'id' => 'uacf7_multistep_next_prev_style',
                    'type'  => 'heading',
                    'label'     => __( 'Next and Previous button style', 'ultimate-addons-cf7' ),  
                ),
                'uacf7_multistep_next_prev_option' => array(
                    'id' => 'uacf7_multistep_next_prev_option',
                    'type' => 'color',
                    'label'     => __( 'Next and Previous Color Options', 'ultimate-addons-cf7' ),  
                    'class' => 'tf-field-class',
                    'multiple' => true,
                    'inline' => true,
                    'colors' => array(
                        'uacf7_multistep_button_bg' => ' Background Color', 
                        'uacf7_multistep_button_color' => ' Font Color', 
                        'uacf7_multistep_button_border_color' => ' Border Color', 
                        'uacf7_multistep_button_hover_bg' => 'Hover Background Color', 
                        'uacf7_multistep_button_hover_color' => 'Hover Font Color', 
                        'uacf7_multistep_button_border_hover_color' => 'Hover Border Color', 
                    ), 
                    'is_pro' => true,
                ),
                'uacf7_multistep_button_border_radius' => array(
                    'id'        => 'uacf7_multistep_button_border_radius',
                    'type'      => 'number',
                    'label'     => __( ' Border Radius', 'ultimate-addons-cf7' ),
                    'is_pro' => true,
                ),
            ),
                

		), $post_id);

        $value['multistep'] = $multistep; 
		return $value;
    }
    
    function step_start_tag_handler($tag){
        ob_start();
        $form_current = \WPCF7_ContactForm::get_current();
        $meta = uacf7_get_form_option( $form_current->id(), 'multistep' );
        $next_btn = isset($meta['next_btn_'.$tag->name]) ? $meta['next_btn_'.$tag->name] : esc_html__('Next', 'ultimate-addons-cf7');
        $prev_btn = isset($meta['prev_btn_'.$tag->name]) ? $meta['prev_btn_'.$tag->name] : esc_html__('Previous', 'ultimate-addons-cf7');

        ?>
        <div class="uacf7-step uacf7-step-<?php echo esc_attr($form_current->id()); ?> step-content" next-btn-text="<?php echo  esc_html( $next_btn ); ?>" prev-btn-text="<?php echo  esc_html( $prev_btn ); ?>">
        <?php
        return ob_get_clean();
    } 
    function step_end_tag_handler($tag){
        ob_start();  
        $form_current = \WPCF7_ContactForm::get_current();
        ?>
        <p>
            <button class="uacf7-prev" data-form-id="<?php echo esc_attr($form_current->id()); ?>" ><?php echo esc_html__('Previous', 'ultimate-addons-cf7'); ?></button>
            <button class="uacf7-next" data-form-id="<?php echo esc_attr($form_current->id()); ?>"><?php echo esc_html__('Next', 'ultimate-addons-cf7'); ?></button>
            <span class="wpcf7-spinner uacf7-ajax-loader"></span>
        </p>
        </div>
        <?php
        return ob_get_clean();
       
    } 
    function uacf7_multistep_progressbar($tag){
        ob_start();
		$form_current = \WPCF7_ContactForm::get_current();  
        $steps = $form_current->scan_form_tags( array('type'=>'uacf7_step_start') );
		$all_steps = apply_filters('uacf7_multistep_steps_title', array(), $steps);
        $meta = uacf7_get_form_option( $form_current->id(), 'multistep' );
        ?>
        <div class="uacf7-steps steps-form">
			<div class="steps-row setup-panel">
			<?php
				$step_id = 1;
				$step_count = 0;  
                $step_name = apply_filters('uacf7_multistep_steps_names', array(), $steps);
				$uacf7_multistep_use_step_labels = !empty($meta['uacf7_multistep_use_step_labels']) ? $meta['uacf7_multistep_use_step_labels'] : '';  
				foreach ($all_steps as $step) {
					$content = $step;
					?>
					<div class="steps-step"><a href="#step-<?php echo esc_attr($step_id); ?>" type="button" class="btn <?php if( $step_id == 1 ) { echo esc_attr('uacf7-btn-active'); }else{ echo esc_attr('uacf7-btn-default'); } ?> btn-circle"><?php 
					if(is_array($step_name)) {
						do_action( 'uacf7_progressbar_image', $step_name[$step_count], $form_current->id() );
						do_action( 'uacf7_progressbar_banner', $step_name[$step_count], $form_current->id() );
					}
					echo wp_kses( apply_filters( 'uacf7_api_based_country_filter', esc_attr($step_id), $uacf7_multistep_use_step_labels, $content ), uacf7_custom_wp_kses_allow_tags()); ?>?></a><p><?php if( $uacf7_multistep_use_step_labels != 'on' ) { echo esc_attr($content); } ?></p></div>
					<?php
					$step_id++;
					$step_count++;
				} 
				?>
			</div>
		</div>
        <?php
        return ob_get_clean();
    }

    /*
    * Generate tag
    */
    public function tag_generator() {
        if (! function_exists('wpcf7_add_tag_generator'))
            return;

        wpcf7_add_tag_generator('uacf7_step_start',
            __('Multistep Start', 'ultimate-addons-cf7'),
            'uacf7-tg-pane-step',
            array($this, 'tg_pane_step_start')
        );

        wpcf7_add_tag_generator('uacf7_step_end',
            __('Multistep end', 'ultimate-addons-cf7'),
            'wpcf7-tg-pane-step-end',
            array($this, 'tg_pane_step_end')
        );

    }
    static function tg_pane_step_start( $contact_form, $args = '' ) {
        $args = wp_parse_args( $args, array() );
        $uacf7_field_type = 'uacf7_step_start';
        ?>
        <div class="control-box">
            <fieldset>
                <legend><?php echo esc_html__( "Generate tag: Step", "ultimate-addons-cf7" ); ?></legend>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label><?php echo esc_html( __( 'Label', 'ultimate-addons-cf7' ) ); ?></label></th>
                            <td>
                               <input type="text" name="values" class="oneline" value="Step Label"> 
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label><?php echo esc_html( __( 'Name', 'ultimate-addons-cf7' ) ); ?></label></th>
                            <td>
                               <input type="text" name="name" class="tg-name oneline" id="tag-generator-panel-text-name"> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="uacf7-doc-notice uacf7-guide">
                <?php echo esc_html( __( 'You need to enable the form from the "UACF7 Multistep Form" tab. The tab also includes additional necessary settings. Make sure you set those, otherwise the form submission may not work correctly.', 'ultimate-addons-cf7' ) ); ?>
                  
                    
                </div>
                <div class="uacf7-doc-notice">
                <?php echo sprintf( 
                    // translators: %1$s is a placeholder for the link to the documentation.
                    esc_html__( 'Confused? Check our Documentation on %1s.', 'ultimate-addons-cf7' ),
                    '<a href="https://themefic.com/docs/uacf7/free-addons/contact-form-7-multi-step-forms/" target="_blank">Multi-step Form</a>'
                ); ?>

                </div>
            </fieldset>
        </div>

        <div class="insert-box">
            <input type="text" name="<?php echo esc_attr($uacf7_field_type); ?>" class="tag code" readonly="readonly" onfocus="this.select()" />
      
            <div class="submitbox">
                <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'ultimate-addons-cf7' ) ); ?>" />
            </div>
        </div>
        <?php
    }
    
    
    static function tg_pane_step_end( $contact_form, $args = '' ) {
        $args = wp_parse_args( $args, array() );
        $uacf7_field_type = 'uacf7_step_end';
        ?>
        <div class="control-box">
            <fieldset>
                <legend><?php echo esc_html__( "Multistep end", "ultimate-addons-cf7" ); ?></legend>
                <table class="form-table">
                    <tbody> 
                        <tr>
                            <th scope="row"><label><?php echo esc_html( __( 'Name', 'ultimate-addons-cf7' ) ); ?></label></th>
                            <td>
                               <input type="text" name="name" readonly="readonly" class="tg-name oneline" value="end"> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>

        <div class="insert-box">
            <input type="text" name="<?php echo esc_attr($uacf7_field_type); ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

            <div class="submitbox">
                <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'ultimate-addons-cf7' ) ); ?>" />
            </div>
        </div>
        <?php
    }
    
 
 
    
    public function uacf7_post_meta_options_multistep_pro($value, $post_id){  
        $fields = $value['fields'];
         
        if($post_id != 0){ 
            // Current Contact Form tags
            $form_current = WPCF7_ContactForm::get_instance($post_id);
                    
            $all_steps = $form_current->scan_form_tags( array('type'=>'uacf7_step_start') );
            $step_titles = array();

        
            foreach ($all_steps as $step) {
                $step_titles[] = (is_array($step->values) && !empty($step->values)) ? $step->values[0] : '';
            }
            if( !empty(array_filter($all_steps)) ){
                $step_count = 1;
                foreach( $all_steps as $step ) { 

                    $fields['uacf7_multistep_step_'.$step_count.''] = array(
                        'id'    => 'uacf7_multistep_step_'.$step_count.'',
                        'type'  => 'heading',
                        // translators: %d is a placeholder for the step count.
                        'label' => sprintf( __( 'Step %d', 'ultimate-addons-cf7' ), $step_count ), 
                        'is_pro' => true,
                    );

                    $fields['uacf7_progressbar_icon_free_'.$step->name.''] = array(
                        'id'        => 'uacf7_progressbar_icon_free_'.$step->name.'',
                        'type' => 'Icon',
                        'label'     => __( 'Set Icon for this step', 'ultimate-addons-cf7' ),  
                        'description'     => __( 'Only for Style 1 Progressbar', 'ultimate-addons-cf7' ),  
                        'class' => 'tf-field-class', 
                        'multiple' => false,
                        'inline' => true, 
                        'default' => 'fa fa-tree', 
                        'dependency' => array( 'uacf7_progressbar_style', '==', 'style-1'),
                     
                    );

                    $fields['uacf7_progressbar_icon_type'.$step->name.''] = array(
                        'id'        => 'uacf7_progressbar_icon_type'.$step->name.'',
                        'type'      => 'radio',
                        'label'     => __( 'Progressbar Icon Type', 'ultimate-addons-cf7' ),
                        'options' => array(
                            'image' => 'Image',
                            'icon' => 'Icon ',
                         ),
                         'default' => 'icon',
                         'inline' => true, 
                        'is_pro' => true, 
                        'dependency' => array( 
                            array( 'uacf7_progressbar_style', '!=', 'style-1' ),
                 
                        ),
                    );
                    
                    $fields['uacf7_progressbar_image_'.$step->name.''] = array(
                        'id'        => 'uacf7_progressbar_image_'.$step->name.'',
                        'type' => 'image',
                        'label'     => __( 'Add progressbar image for this step', 'ultimate-addons-cf7' ),  
                        'class' => 'tf-field-class', 
                        'multiple' => false,
                        'inline' => true, 
                        'is_pro' => true, 
                        'dependency' => array( 
                            array('uacf7_progressbar_icon_type'.$step->name.'', '==', 'image'),
                            array( 'uacf7_progressbar_style', '!=', 'style-1' ),
                        ),
                    );


                    $fields['uacf7_progressbar_banner_'.$step->name.''] = array(
                        'id'        => 'uacf7_progressbar_banner_'.$step->name.'',
                        'type' => 'image',
                        'label'     => __( 'Add progressbar Left Banner for this step', 'ultimate-addons-cf7' ),  
                        'class' => 'tf-field-class', 
                        'multiple' => false,
                        'inline' => true, 
                        'is_pro' => true, 
                        'dependency'  => array( 'uacf7_progressbar_style', '==', 'style-9' ),
                      
                    );
                    $fields['uacf7_progressbar_icon_'.$step->name.''] = array(
                        'id'        => 'uacf7_progressbar_icon_'.$step->name.'',
                        'type' => 'Icon',
                        'label'     => __( 'Add progressbar icon for this step', 'ultimate-addons-cf7' ),  
                        'class' => 'tf-field-class', 
                        'multiple' => false,
                        'inline' => true, 
                        'is_pro' => true, 
                        'default' => 'fa fa-check', 
                        'dependency' => array(
                            array( 'uacf7_progressbar_icon_type'.$step->name.'', '==', 'icon' ),
                            array( 'uacf7_progressbar_style', '!=', 'style-1' ),
                        ),
                    );
                   
                    if($step_count == 1){
                        $fields['next_btn_'.$step->name.''] = array(
                            'id'        => 'next_btn_'.$step->name.'',
                            'type'      => 'text',
                            'label'     => __( 'Change next button text for this Step', 'ultimate-addons-cf7' ),      
                            'field_width' => 50,
                            'is_pro' => true,
                        );
                    }else{
                        if( count($all_steps) == $step_count ) { 
                            $fields['prev_btn_'.$step->name.''] = array(
                                'id'        => 'prev_btn_'.$step->name.'',
                                'type'      => 'text',
                                'label'     => __( 'Change previous button text for this Step', 'ultimate-addons-cf7' ),      
                                'field_width' => 50,
                                'is_pro' => true,
                            );
                        }else{
                            $fields['next_btn_'.$step->name.''] = array(
                                'id'        => 'next_btn_'.$step->name.'',
                                'type'      => 'text',
                                'label'     => __( 'Change next button text for this Step', 'ultimate-addons-cf7' ),      
                                'field_width' => 50,
                                'is_pro' => true,
                            );
                            $fields['prev_btn_'.$step->name.''] = array(
                                'id'        => 'prev_btn_'.$step->name.'',
                                'type'      => 'text',
                                'label'     => __( 'Change previous button text for this Step', 'ultimate-addons-cf7' ),      
                                'field_width' => 50,
                                'is_pro' => true,
                            );
                        }
                    }
                    $fields['desc_title_'.$step->name.''] = array(
                        'id'        => 'desc_title_'.$step->name.'',
                        'type'      => 'text',
                        'label'     => __( 'Step title', 'ultimate-addons-cf7' ),
                        'placeholder'     => __( 'Step title', 'ultimate-addons-cf7' ), 
                        'is_pro' => true,
                        'field_width' => 50,
                        'default' => 'Step Title'
                    );
                    $fields['step_desc_'.$step->name.''] = array(
                        'id'        => 'step_desc_'.$step->name.'',
                        'type'      => 'textarea',
                        'label'     => __( 'Step Description', 'ultimate-addons-cf7' ),
                        'placeholder'     => __( 'Step Description', 'ultimate-addons-cf7' ), 
                        'is_pro' => true,
                        'default' => 'Step Description',
                        'dependency' => array( 
                            array( 'uacf7_progressbar_style', '!=', 'style-8' ),
                            array( 'uacf7_progressbar_style', '!=', 'style-9' ),
                            array( 'uacf7_progressbar_style', '!=', 'style-10' ),
                 
                        ),
                    );

                    $step_count++;
                }
            }
            // uacf7_print_r($all_steps);
            // wp_die();
        }
        // exit;
        $value['fields'] = $fields;
        return $value;
    }

 
    /*
    * Change form properties for multistep
    */
    public function uacf7_properties($properties, $cfform) {
        if (!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) { 
            $form = $properties['form'];
            $multistep_meta = uacf7_get_form_option( $cfform->id(), 'multistep' );
            
            $uacf7_multistep_is_multistep = isset($multistep_meta['uacf7_multistep_is_multistep']) ? $multistep_meta['uacf7_multistep_is_multistep'] : ''; 
            $uacf7_enable_multistep_progressbar =  isset($multistep_meta['uacf7_enable_multistep_progressbar']) ? $multistep_meta['uacf7_enable_multistep_progressbar'] : '';
           
            $all_steps = $cfform->scan_form_tags( array('type'=>'uacf7_step_start') );
         
            if( $uacf7_multistep_is_multistep == true ) {
			    ob_start();
                // Current Contact Form tags
                $uacf7_multistep_use_step_labels = !empty($multistep_meta['uacf7_multistep_use_step_labels']) ? $multistep_meta['uacf7_multistep_use_step_labels'] : ''; 
                $uacf7_multistep_button_padding_tb = $multistep_meta['uacf7_multistep_button_padding_tb']; 
                $uacf7_multistep_button_padding_lr = $multistep_meta['uacf7_multistep_button_padding_lr']; 
                if($uacf7_multistep_button_padding_tb !='' || $uacf7_multistep_button_padding_tb != 0){
                    $padding_top = 'padding-top:'.$uacf7_multistep_button_padding_tb.'px !important;'; 
                    $padding_bottom = 'padding-bottom:'.$uacf7_multistep_button_padding_tb.'px !important;'; 
                }else{
                    $padding_top = ''; 
                    $padding_bottom = '';
                }
                if($uacf7_multistep_button_padding_lr !='' || $uacf7_multistep_button_padding_lr != 0){ 
                    $padding_left = 'padding-left:'.$uacf7_multistep_button_padding_lr.'px !important;'; 
                    $padding_right = ' padding-right:'.$uacf7_multistep_button_padding_lr.'px !important;'; 
                }else{
                    $padding_left = ''; 
                    $padding_right = ''; 
                }
                $next_prev_style = '<style>.uacf7-prev, .uacf7-next, .wpcf7-submit{'.$padding_top.' '.$padding_bottom.' '.$padding_left.' '.$padding_right.'}  </style>';
                echo wp_kses($next_prev_style, uacf7_custom_wp_kses_allow_tags());


                if(!empty($all_steps)):
			?> 
                <div class="uacf7-steps steps-form" style="display:none">
                    <div class="steps-row setup-panel">
                        <?php
                            $step_id = 1;
                            $step_count = 0;
                    
                            $step_name = apply_filters('uacf7_multistep_steps_names', array(), $all_steps);
                            foreach ($all_steps as $step) {
                                $content = $step;
                                ?>
                                <div class="steps-step"><a title-id=".step-<?php echo esc_attr($step_id); ?>" data-form-id="<?php echo esc_attr($cfform->id()); ?>" href="#<?php echo esc_attr($cfform->id()); ?>step-<?php echo esc_attr($step_id); ?>" type="button"></a></div>
                                <?php
                                $step_id++;
                                $step_count++;
                            }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php 
            if( $uacf7_enable_multistep_progressbar == true ) {
                $uacf7_progressbar_style = $multistep_meta['uacf7_progressbar_style'];
                do_action( 'uacf7_multistep_before_form', $cfform->id() );
            ?>
            <?php         
                $uacf7_multistep_progress_bg_color        = isset($multistep_meta['uacf7_multistep_progress_bg_color']) && $multistep_meta['uacf7_multistep_progress_bg_color']               !== '' ? $multistep_meta['uacf7_multistep_progress_bg_color']: '#ffffff';
                $uacf7_multistep_circle_bg_color          = isset($multistep_meta['uacf7_multistep_circle_bg_color']) && $multistep_meta['uacf7_multistep_circle_bg_color']                   !== '' ? $multistep_meta['uacf7_multistep_circle_bg_color']: '#ffffff';
                $uacf7_multistep_circle_bg_active_color   = isset($multistep_meta['uacf7_multistep_circle_bg_active_color']) && $multistep_meta['uacf7_multistep_circle_bg_active_color']     !== '' ? $multistep_meta['uacf7_multistep_circle_bg_active_color']: '#EBF2FF';
                $uacf7_multistep_circle_bg_hover_color    = isset($multistep_meta['uacf7_multistep_circle_bg_hover_color']) && $multistep_meta['uacf7_multistep_circle_bg_hover_color']       !== '' ? $multistep_meta['uacf7_multistep_circle_bg_hover_color']: '#F8F9FB';
                $uacf7_multistep_circle_font_color        = isset($multistep_meta['uacf7_multistep_circle_font_color']) && $multistep_meta['uacf7_multistep_circle_font_color']               !== '' ? $multistep_meta['uacf7_multistep_circle_font_color']: '#8997A9';
                $uacf7_multistep_circle_font_hover_color  = isset($multistep_meta['uacf7_multistep_circle_font_hover_color']) && $multistep_meta['uacf7_multistep_circle_font_hover_color']   !== '' ? $multistep_meta['uacf7_multistep_circle_font_hover_color']: '#607085';
                $uacf7_multistep_circle_active_font_color = isset($multistep_meta['uacf7_multistep_circle_active_font_color']) && $multistep_meta['uacf7_multistep_circle_active_font_color'] !== '' ? $multistep_meta['uacf7_multistep_circle_active_font_color']: '#2979FF';
                $uacf7_multistep_progress_line_color      = isset($multistep_meta['uacf7_multistep_progress_line_color']) && $multistep_meta['uacf7_multistep_progress_line_color']           !== '' ? $multistep_meta['uacf7_multistep_progress_line_color']: '';
                $uacf7_multistep_circle_border_color      = isset($multistep_meta['uacf7_multistep_circle_border_color']) && $multistep_meta['uacf7_multistep_circle_border_color']           !== '' ? $multistep_meta['uacf7_multistep_circle_border_color']: '#2979FF';
                $uacf7_multistep_circle_border            = isset($multistep_meta['uacf7_multistep_circle_border']) && $multistep_meta['uacf7_multistep_circle_border']                       !== '' ? $multistep_meta['uacf7_multistep_circle_border']: '4';
                $uacf7_multistep_circle_height            = isset($multistep_meta['uacf7_multistep_circle_height']) && $multistep_meta['uacf7_multistep_circle_height']                       !== '' ? $multistep_meta['uacf7_multistep_circle_height']: '60';
                $uacf7_multistep_font_size                = isset($multistep_meta['uacf7_multistep_font_size']) && $multistep_meta['uacf7_multistep_font_size']                               !== '' ? $multistep_meta['uacf7_multistep_font_size']: '20';
                $uacf7_multistep_circle_font_weight       = isset($multistep_meta['uacf7_multistep_circle_font_weight']) && $multistep_meta['uacf7_multistep_circle_font_weight']             !== '' ? $multistep_meta['uacf7_multistep_circle_font_weight']: '600';
                
                $uacf7_multistep_button_bg            = isset($multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_bg']) && $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_bg']                     !== '' ? $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_bg']: '#2979FF';
                $uacf7_multistep_button_color         = isset($multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_color']) && $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_color']               !== '' ? $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_color']: '#ffffff';
                $uacf7_multistep_button_border_color  = isset($multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_border_color']) && $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_border_color'] !== '' ? $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_border_color']: '';
                $uacf7_multistep_button_hover_bg      = isset($multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_hover_bg']) && $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_hover_bg']         !== '' ? $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_hover_bg']: '#2264d1';
                $uacf7_multistep_button_hover_color   = isset($multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_hover_color']) && $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_hover_color']   !== '' ? $multistep_meta['uacf7_multistep_next_prev_option']['uacf7_multistep_button_hover_color']: '#ffffff';
                $uacf7_multistep_button_border_radius = isset($multistep_meta['uacf7_multistep_button_border_radius']) && $multistep_meta['uacf7_multistep_button_border_radius']                                                                       !== '' ? $multistep_meta['uacf7_multistep_button_border_radius']: '4';            
                
           $uacf7_multistep_progressbar_title_color = isset($multistep_meta['uacf7_multistep_progressbar_title_color']) ? $multistep_meta['uacf7_multistep_progressbar_title_color'] : '';
            if($uacf7_progressbar_style == 'default' && !empty($uacf7_multistep_progressbar_title_color))                                        : 
            ?>
            <style>
                .steps-form .steps-row .steps-step p {
                    color: <?php echo esc_attr($uacf7_multistep_progressbar_title_color); ?>;
                  
                }
                
                .uacf7-steps  .uacf7-next, .uacf7-steps .uacf7-next{
                    padding: <?php echo esc_attr($uacf7_multistep_button_padding_tb); ?> <?php echo esc_attr($uacf7_multistep_button_padding_lr); ?> ;
                } 
                
            </style>
            <?php endif; ?>


            <!-- Styling Style 1 -->

            <?php if($uacf7_progressbar_style === 'style-1'): ?>
            
            <style>
                .progressbar-style-1 .steps-row .steps-step .uacf7-btn-active {
                    color: <?php echo esc_attr($uacf7_multistep_circle_active_font_color); ?>!important;
                    background: <?php echo esc_attr($uacf7_multistep_circle_bg_active_color); ?>!important;
                    border-bottom: <?php echo esc_attr($uacf7_multistep_circle_border); ?>px solid <?php echo esc_attr($uacf7_multistep_circle_border_color); ?>!important;
                }

                .progressbar-style-1 .steps-row .steps-step .style-1-filled {
                    color: <?php echo esc_attr($uacf7_multistep_circle_active_font_color); ?>!important;
                    background: #F5F8FF!important;
                    border-bottom: <?php echo esc_attr($uacf7_multistep_circle_border); ?>px solid #C4DAFF!important;
                }
                
                .progressbar-style-1 .steps-row .steps-step .btn-circle{
                    color       : <?php echo esc_attr($uacf7_multistep_circle_font_color); ?>;
                    font-weight : <?php echo esc_attr($uacf7_multistep_circle_font_weight); ?>!important;
                    font-size   : <?php echo esc_attr($uacf7_multistep_font_size); ?>px!important;
                }

                .progressbar-style-1 .steps-row .steps-step .btn-circle:not(.uacf7-btn-active){
                    
                    background  : <?php echo esc_attr($uacf7_multistep_circle_bg_color); ?>;
                  }

                .progressbar-style-1 .steps-row .steps-step{
                    height     : <?php echo esc_attr($uacf7_multistep_circle_height); ?>px!important;
                }

                .progressbar-style-1 .steps-row .steps-step .uacf7-btn-default:hover:not(.uacf7-btn-active) {
                    color     : <?php echo esc_attr($uacf7_multistep_circle_font_hover_color); ?>!important;
                    background: <?php echo esc_attr($uacf7_multistep_circle_bg_hover_color); ?>!important;
                }
                
                .style-1 + .uacf7-multisetp-form button.uacf7-next,       .style-1 + .uacf7-multisetp-form button.uacf7-prev,      .style-1 + .uacf7-multisetp-form .wpcf7-submit {
        
                    background: <?php echo esc_attr($uacf7_multistep_button_bg); ?>; ;
                    padding: <?php echo esc_attr($uacf7_multistep_button_padding_tb); ?>px <?php echo esc_attr($uacf7_multistep_button_padding_lr); ?>px;
                    width: 123px;
                    height: 48px;
                    border-radius: <?php echo esc_attr($uacf7_multistep_button_border_radius); ?>px;
                    color: <?php echo esc_attr($uacf7_multistep_button_color); ?>;
                    border: 1px solid <?php echo esc_attr($uacf7_multistep_button_border_color); ?>;
                    display: flex-end;
                    cursor: pointer;
                }
                .style-1 + .uacf7-multisetp-form button.uacf7-next:hover,        .style-1 + .uacf7-multisetp-form button.uacf7-prev:hover, .wpcf7-submit:hover {
                    background: <?php echo esc_attr($uacf7_multistep_button_hover_bg); ?>;
                    color: <?php echo esc_attr($uacf7_multistep_button_hover_color); ?>;
                    border: 1px solid <?php echo esc_attr($uacf7_multistep_button_border_hover_color); ?>;
                }
        
            </style>
            <?php endif; ?>
                <?php if(!empty($all_steps)): ?>
                    <div class="<?php echo isset($uacf7_progressbar_style) ? wp_kses($uacf7_progressbar_style, uacf7_custom_wp_kses_allow_tags()) . " uacf7-common-pb" : "default-skin-style"; ?>">
                    <div class="uacf7-steps steps-form <?php if($uacf7_progressbar_style == 'style-1'){echo 'progressbar-style-1';} ?>">
                        <div class="steps-row setup-panel">
                        <?php
                            $step_id    = 1;
                            $step_count = 0;
                            $step_name  = apply_filters('uacf7_multistep_steps_names', '', $all_steps);
                            foreach ($all_steps as $step) {
                                // $content = $step->values[0];
                                $content = isset($step->values[0]) ? $step->values[0] : ''; ?>
                                <div class="steps-step">
                                    <a title-id=".step-<?php echo esc_attr($step_id); ?>" data-form-id="<?php echo esc_attr($cfform->id()); ?>"   href="#<?php echo esc_attr($cfform->id()); ?>step-<?php echo esc_attr($step_id); ?>" type="button" class="btn <?php if( $step_id == 1 ) { echo esc_attr('uacf7-btn-active'); }else{ echo esc_attr('uacf7-btn-default'); } ?> btn-circle"><?php 
                                        if(is_array($step_name)) {

                                            if($uacf7_progressbar_style == 'style-7'){
                                                echo '<div class="uacf7-ms-skin7-title-desc">';
                                                echo '<p>' . esc_html($content) . '</p>';
                                                if (isset($multistep_meta['desc_title_' . $step_name[$step_count]])) {
                                                    echo '<p>' . esc_html($multistep_meta['desc_title_' . $step_name[$step_count]]) . '</p>';
                                                }
                                                echo '</div>';
                                            }elseif ($uacf7_progressbar_style == 'style-11') {
                                                do_action( 'uacf7_progressbar_image', $step_name[$step_count], $cfform->id() );
                                                echo '<div class="uacf7-ms-skin11-title-desc">';
                                                if( isset($content)){
                                                    echo '<p>' . esc_html($content) . '</p>';
                                                }
                                                if (isset($multistep_meta['desc_title_' . $step_name[$step_count]])) {
                                                    echo '<p>' . esc_html($multistep_meta['desc_title_' . $step_name[$step_count]]) . '</p>';
                                                }
                                                echo '</div>';
                                            }elseif($uacf7_progressbar_style == 'style-8'){
                                                
                                                echo  '<div class="uacf7-ms-skin8-step-label-wrapper">'; ?>
                                                <div class="uacf7-ms-skin8-step-wrapper">
                                                <p class="uacf7-ms-skin8-current-step"></p><?php echo '<p class="uacf7-ms-skin8-total-step">'.$content.'</p>'; ?>
                                                </div>
                                                <?php if (isset($multistep_meta['desc_title_' . $step_name[$step_count]])) {
                                                    echo  '<div class="uacf7-ms-skin8-step-label">';
                                                    echo '<p>' . esc_html($multistep_meta['desc_title_' . $step_name[$step_count]]) . '</p>';
                                                    echo  '</div>';
                                                } 
                                                echo '</div>';
                                            
                                            }elseif($uacf7_progressbar_style == 'style-9'){ 

                                                do_action( 'uacf7_progressbar_image', $step_name[$step_count], $cfform->id() );

                                                echo '<div class="uacf7-ms-skin9-title-desc">';
                                                if (isset($multistep_meta['desc_title_' . $step_name[$step_count]]) && isset($content)) {
                                                    echo '<p>' . esc_html($multistep_meta['desc_title_' . $step_name[$step_count]]) . '</p>';
                                                    echo '<p>' . esc_html($content) . '</p>';
                                                }

                                                do_action( 'uacf7_progressbar_banner', $step_name[$step_count], $cfform->id() );
                                                echo '</div>';
                                            }elseif($uacf7_progressbar_style == 'style-10'){ 

                                                if (isset($multistep_meta['desc_title_' . $step_name[$step_count]])) {
                                                    echo '<p>' . esc_html($multistep_meta['desc_title_' . $step_name[$step_count]] ). '</p>';
                                                }
                                            
                                            }
                                        
                                            if($uacf7_progressbar_style != '' && $uacf7_progressbar_style != 'style-3' && $uacf7_progressbar_style != 'style-9' && $uacf7_progressbar_style != 'style-11'){ 

                                                do_action( 'uacf7_progressbar_image', $step_name[$step_count], $cfform->id() );
                                            }

                                        }
                                        if( $uacf7_progressbar_style == 'style-1'){
                                            if(isset($multistep_meta['uacf7_progressbar_icon_free_' . $step_name[$step_count]])){
                                                $icon_class = $multistep_meta['uacf7_progressbar_icon_free_' . $step_name[$step_count]];
                                                echo '<p><i class="' . esc_attr($icon_class) . '"></i></p>';
                                                
                                            }
                                                if( isset($content)){
                                                    echo '<p>' . esc_html($content) . '</p>';
                                                }

                                                if( $uacf7_progressbar_style != 'style-1' && $uacf7_progressbar_style != 'style-8' && $uacf7_progressbar_style != 'style-10'){

                                                    echo esc_attr($step_id);
                                                }
                                            
                                        }else {
                                            if( $uacf7_progressbar_style != 'style-2' &&  $uacf7_progressbar_style != 'style-4' && $uacf7_progressbar_style != 'style-6' && $uacf7_progressbar_style != 'style-7' && $uacf7_progressbar_style != 'style-8' && $uacf7_progressbar_style != 'style-9' && $uacf7_progressbar_style != 'style-10' && $uacf7_progressbar_style != 'style-11' ){
                                                echo esc_attr($step_id);
                                            }
                                        
                                        }
                                        
                                        ?>
                                    </a>
                                    <?php 

                                        if( $uacf7_multistep_use_step_labels != true && $uacf7_progressbar_style != ''  && $uacf7_progressbar_style != 'style-1' && $uacf7_progressbar_style != 'style-4' && $uacf7_progressbar_style != 'style-7' && $uacf7_progressbar_style != 'style-8' && $uacf7_progressbar_style != 'style-9' && $uacf7_progressbar_style != 'style-10' && $uacf7_progressbar_style != 'style-11' ) { 
                                            echo '<p>'.esc_html($content).'</p>'; 
                                        } 
                                    ?>
                                </div>
                                <?php
                                $step_id++;
                                $step_count++; 
                            }
                            ?>
                        </div>
                    </div>
                    </div>
                <?php endif; ?>
                <?php
			}
            
            $progressbar = ob_get_clean();
			ob_start();
			echo apply_filters( 'uacf7_progressbar_html', $progressbar, $form, $cfform->id(), $all_steps );
			ob_start();
			?>
			<div class="uacf7-multisetp-form">
				<?php echo $form; ?>
			</div>
			<?php
			$form_html = ob_get_clean();
			echo apply_filters( 'uacf7_form_html', $form_html );
			$multistep_form = ob_get_clean();
            $properties['form'] = $multistep_form;
            }else {
                $properties['form'] = $form;
            }
        }

        return $properties;
    }
    
    public function check_fields_validation() {
        if ( !wp_verify_nonce($_REQUEST['ajax_nonce'], 'uacf7-multistep')) {
            exit(esc_html__("Security error", 'ultimate-addons-cf7'));
        }

        $current_step_fields = explode(',', $_REQUEST['current_fields_to_check']);

        // Validation with Repeater 
        $validation_fields = explode(',', $_REQUEST['validation_fields']);  
        $tag_name = [];
        $tag_validation = [];
        $tag_type = []; 
        $file_error=[];
        $count = '1';
        for ($x = 0; $x < count($validation_fields); $x++) {
            $field = explode(':', $validation_fields[$x]); 
            $name = $field[1];
            $name_array =  explode("__",$field[1]); 
            $replace = '__'.$count.''; 
            $tag_name[] =  $name_array[0];
            $tag_validation[$field[0].$x] =  $name;
            $tag_type[]=$field[0];  
            $count++; 
        }  
        $form = wpcf7_contact_form( $_REQUEST['form_id'] );
        $all_form_tags = $form->scan_form_tags(); 
        $invalid_fields = false;
        require_once WPCF7_PLUGIN_DIR . '/includes/validation.php';
        $result = new \WPCF7_Validation();
        $tags = array_filter(
            $all_form_tags, function($v, $k) use ($tag_name) { 
                return in_array($v->name, $tag_name);
            }, ARRAY_FILTER_USE_BOTH
        ); 
        $form->validate_schema(
            array(
                'text'  => true,
                'file'  => false,
                'field' =>  $tag_name,
            ),
            $result
        );  
        foreach ( $tags as $tag ) {
            $type = $tag->type;
            if ( 'file' != $type && 'file*' != $type ) {
                $result = apply_filters("wpcf7_validate_{$type}", $result, $tag);
                
			}elseif( 'file*' === $type || 'file' === $type ){ 
			    $fdir = $_REQUEST[$tag->name];
				if ( $fdir ) {
					$_FILES[ $tag->name ] = array(
						'name' => wp_basename( $fdir ),
						'tmp_name' => $fdir,
					);
				}
			    $file = $_FILES[$tag->name];
			    //$file = $_REQUEST[$tag->name];
    			$args = array(
    				'tag' => $tag,
    				'name' => $tag->name,
    				'required' => $tag->is_required(),
    				'filetypes' => $tag->get_option( 'filetypes' ),
    				'limit' => $tag->get_limit_option(), 
    			);
                $args['schema'] = $form->get_schema();
    			$new_files = wpcf7_unship_uploaded_file( $file, $args ); 
                if ( is_wp_error( $new_files ) ) {
                    $result->invalidate( $tag, $new_files );
                }
			    $result = apply_filters("wpcf7_validate_{$type}", $result, $tag, array( 'uploaded_files' => $new_files, ) );
              
                if(isset($_REQUEST[$tag->name.'_size'])){
                    $file_size = $_REQUEST[$tag->name.'_size'];    
                    if ($file_size > $tag->get_limit_option()) { 
                        $file_error = array(
                            'into' => 'span.wpcf7-form-control-wrap[data-name = '.esc_attr($tag->name).']',
                            'message' => 'The uploaded file is too large.',
                            'idref' => null,
                        ); 
                    }
                }
                
                 
               
			}
            
        }
        // $result = apply_filters('wpcf7_validate', $result, $tags); 
        $is_valid = $result->is_valid();
        if (!$is_valid) {
            $invalid_fields = $this->prepare_invalid_form_fields($result, $tag_validation);
        } 
        if(!empty($file_error)) {
            $invalid_fields [] = $file_error;
        } 
        if(!empty($invalid_fields)){
            $is_valid = false;
        }
        echo(wp_json_encode( array(
                    'is_valid' => $is_valid,
                    'invalid_fields' => $invalid_fields,
                )
            )
        );
        wp_die();
    }
    
    private function prepare_invalid_form_fields ($result, $tag_validation){
        $invalid_fields = array();
     
        // Validation with Repeater 
        $count = 1;
        $invalid_data = [];
        foreach ((array)$result->get_invalid_fields() as $name => $field) { 
            $invalid_data[$name] = array(
                'name' => $name,
                'message' => $field['reason'],
                'idref' => $field['idref'],
            );      
        }
        foreach ($tag_validation as $key => $value){
            $name =  explode("__",$value); 
            $name = $name[0];  
            if(!empty($invalid_data[$name])){
                $field = $invalid_data[$name]; 
                $invalid_fields[] = array(
                    'into' => 'span.wpcf7-form-control-wrap[data-name = '.esc_attr($value).']',
                    'message' => $field['message'],
                    'idref' => $field['idref'],
                ); 
            } 
        } 
        return $invalid_fields;
    }
    
}
new UACF7_MULTISTEP();
