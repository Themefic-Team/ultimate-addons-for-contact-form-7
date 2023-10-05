<?php

/** Prevent direct access */
if (!defined('ABSPATH')) {
    echo "You are not allowed to access directly";
    exit();
}

class UACF7_FORM_PREVIEW{
  public function __construct(){
    add_action('wp_enqueue_scripts', [$this, 'uacf7_form_preview_public_assets_loading']);
    add_action('admin_enqueue_scripts', [$this, 'uacf7_form_preview_admin_assets_loading']);

    add_action('admin_init', [$this, 'uacf7_form_preview_tag_generator']);
    add_action('wpcf7_init', [$this, 'uacf7_form_preview_add_shortcodes']);
  }


  /** Loading Assets */

  public function uacf7_form_preview_public_assets_loading(){
    wp_enqueue_script('form_preview_public_js', UACF7_URL . '/addons/form-preview/assets/public/js/public-submission-id.js', ['jquery'], 'WPCF7_VERSION', true);
    wp_enqueue_style('form_preview_public_css', UACF7_URL . '/addons/form-preview/assets/public/css/public-submission-id.css', [], 'UAFC7_VERSION', true, 'all');
  }

  public function uacf7_form_preview_admin_assets_loading(){
    wp_enqueue_script('form_preview_admin_js', UACF7_URL . '/addons/form-preview/assets/admin/js/admin-submission-id.js', ['jquery'], 'WPCF7_VERSION', true);
    wp_enqueue_style('form_preview_admin_css', UACF7_URL . '/addons/form-preview/assets/admin/css/admin-submission-id.css', [], 'UAFC7_VERSION', true, 'all');
  }

    /* Generate Tag - Form Preview */

  public function uacf7_form_preview_tag_generator(){
    if (!function_exists('wpcf7_add_tag_generator')) {
        return;
    }

    wpcf7_add_tag_generator('uacf7_form_preview',
        __('Form Preview', 'ultimate-addons-cf7'),
        'uacf7-tg-pane-form_preview',
        array($this, 'tg_pane_form_preview')
    );
  }

  public function tg_pane_form_preview(){

  }


}


new UACF7_FORM_PREVIEW();