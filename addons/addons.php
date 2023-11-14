<?php

if( !function_exists( 'uacf7_addons_included' ) ) {

    function uacf7_addons_included(){
        $option = uacf7_settings();
        // uacf7_print_r($option);
    
        //Addon - Ultimate redirect
        if( isset($option['uacf7_enable_redirection']) && $option['uacf7_enable_redirection'] == true ){
            require_once( 'redirection/redirect.php' );
        }

        //Addon - Ultimate conditional field
        if( isset($option['uacf7_enable_conditional_field']) && $option['uacf7_enable_conditional_field'] == true ){
            require_once( 'conditional-field/conditional-fields.php' );
        }

        //Addon - Ultimate field Column
        if( isset($option['uacf7_enable_field_column']) && $option['uacf7_enable_field_column'] == true ){ 
            require_once( 'column/column.php' );
        }

        //Addon - Ultimate Placeholder
        if( isset($option['uacf7_enable_placeholder']) && $option['uacf7_enable_placeholder'] == true ){  
            require_once( 'placeholder/placeholder.php' );
        }

        //Addon - Ultimate Mutlistep
        if( isset($option['uacf7_enable_multistep']) && $option['uacf7_enable_multistep'] == true ){   
            require_once( 'multistep/multistep.php' );
        }

        //Addon - Ultimate Style
        if( isset($option['uacf7_enable_uacf7style']) && $option['uacf7_enable_uacf7style'] == true ){    
            require_once( 'styler/uacf7style.php' );
        }

        //Addon - Ultimate Product Dropdown
        if( isset($option['uacf7_enable_product_dropdown']) && $option['uacf7_enable_product_dropdown'] == true ){     
            require_once( 'product-dropdown/product-dropdown.php' );
        }

        //Addon - Ultimate Star Rating
        if( isset($option['uacf7_enable_star_rating']) && $option['uacf7_enable_star_rating'] == true ){      
            require_once( 'star-rating/star-rating.php' );
        }

        //Addon - Ultimate Price Slider
        if( isset($option['uacf7_enable_range_slider']) && $option['uacf7_enable_range_slider'] == true ){       
            require_once( 'range-slider/range-slider.php');
        }
		
        //Addon - Country Dropdown
        if( isset($option['uacf7_enable_country_dropdown_field']) && $option['uacf7_enable_country_dropdown_field'] == true ){     
            require_once( 'country-dropdown/country-dropdown.php');
        }

        //Addon - Mailchimp
        if( isset($option['uacf7_enable_mailchimp']) && $option['uacf7_enable_mailchimp'] == true ){    
            require_once( 'mailchimp/mailchimp.php');
        }
		
        //Addon - Dynamic Text
        if( isset($option['uacf7_enable_dynamic_text']) && $option['uacf7_enable_dynamic_text'] == true ){     
            require_once( 'dynamic-text/dynamic-text.php');
        } 

        //Addon - Pre Populate 
        if( isset($option['uacf7_enable_pre_populate_field']) && $option['uacf7_enable_pre_populate_field'] == true ){      
            require_once( 'pre-populate-field/pre-populate-field.php');
        }

        //Addon - Database 
        if( isset($option['uacf7_enable_database_field']) && $option['uacf7_enable_database_field'] == true ){       
            require_once( 'database/database.php');
        }

        //Addon - PDF Generator 
        if( isset($option['uacf7_enable_pdf_generator_field']) && $option['uacf7_enable_pdf_generator_field'] == true ){       
            require_once( 'pdf-generator/pdf-generator.php');
        }

        //Addon - Submission ID
        if( isset($option['uacf7_enable_submission_id_field']) && $option['uacf7_enable_submission_id_field'] == true ){ 
            require_once( 'submission-id/ultimate-submission-id.php');
        }

        //Addon - Telegram
        if( isset($option['uacf7_enable_telegram_field']) && $option['uacf7_enable_telegram_field'] == true ){  
            require_once( 'telegram/ultimate-telegram.php');
        }

        //Addon - Spam Protection
        // if( uacf7_checked( 'uacf7_enable_spam_protection_field') != ''){
        //     require_once( 'spam-protection/ultimate-spam-protection.php');
        // }

        require_once( 'spam-protection/ultimate-spam-protection.php');
		
    }
}

uacf7_addons_included();