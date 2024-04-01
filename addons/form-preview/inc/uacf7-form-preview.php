<?php
/** Prevent direct access */
if (!defined('ABSPATH')) {
    echo "You are not allowed to access directly";
    exit();
}

class UACF7_FORM_PREVIEW{
    public function __construct(){
        add_action('admin_enqueue_scripts', [$this, 'uacf7_form_preview_public_assets_loading']); 
    }

    public function uacf7_form_preview_public_assets_loading(){
        wp_enqueue_script('preview_form_admin_js', UACF7_URL . 'addons/form-preview/assets/admin/js/admin-form-preview.js', ['jquery'], 'UAFC7_VERSION', true);
    }

    
}

new UACF7_FORM_PREVIEW();