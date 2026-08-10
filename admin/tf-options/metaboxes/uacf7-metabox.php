<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

/**
 * Get all the meals from glabal settings
 * @author AbuHena
 * @since 1.7.0
 */

if ( isset( $_GET['post'] ) && ! is_array( $_GET['post'] ) && $_GET['post'] != '-1' && isset( $_GET['page'] ) && $_GET['page'] == 'wpcf7' ) {
	$post_id = absint( wp_unslash( $_GET['post'] ) );
} else {
	$post_id = 0;
}
UACF7_Metabox::metabox( 'uacf7_form_opt', array(
	'title' => __( 'Addons for CF7 Options', 'ultimate-addons-for-contact-form-7' ),
	'post_type' => 'uacf7',

	'sections' => apply_filters( 'uacf7_post_meta_options', array(), $post_id ),

) );
