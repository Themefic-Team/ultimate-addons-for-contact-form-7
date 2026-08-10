<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Star Review Metabox regiter
 * @author M Hemel Hasan
 */
if ( isset( $_GET['post'] ) && ! is_array( $_GET['post'] ) && $_GET['post'] != '-1' ) {
	$post_id = absint( wp_unslash( $_GET['post'] ) );
} else {
	$post_id = 0;
}

UACF7_Metabox::metabox( 'uacf7_review_opt', array(
	'title' => __( 'Addons for CF7 Options', 'ultimate-addons-for-contact-form-7' ),
	'post_type' => 'uacf7_review',
	'sections' => apply_filters( 'uacf7_post_meta_review_opt', $uacf7_review_sections = array(), $post_id ),

) );

?>