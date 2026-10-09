<?php
/**
 * Security regression checks: PHP Object Injection prevention in PDF Generator.
 *
 * Run from the plugin root:
 * php tests/security/pdf-generator-object-injection-security.php
 */

$root = dirname( __DIR__, 2 );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', $root . '/' );
}
if ( ! defined( 'UACF7_PATH' ) ) {
	define( 'UACF7_PATH', $root . '/' );
}

if ( ! function_exists( 'add_action' ) ) {
	function add_action() {}
}
if ( ! function_exists( 'add_filter' ) ) {
	function add_filter() {}
}
if ( ! function_exists( 'is_plugin_active' ) ) {
	function is_plugin_active() {
		return false;
	}
}
if ( ! function_exists( 'get_option' ) ) {
	function get_option( $opt = '', $default = false ) {
		return $default;
	}
}
if ( ! function_exists( 'esc_html' ) ) {
	function esc_html( $text ) {
		return htmlspecialchars( (string) $text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8' );
	}
}

function uacf7_pdf_security_assert( $condition, $message ) {
	if ( ! $condition ) {
		echo "FAIL: {$message}\n";
		exit( 1 );
	}
}

// 1. Static code assertion on addons/pdf-generator/pdf-generator.php
$pdf_file   = $root . '/addons/pdf-generator/pdf-generator.php';
$pdf_source = file_get_contents( $pdf_file );

uacf7_pdf_security_assert(
	false !== strpos( $pdf_source, '»¤¬' ),
	'pdf-generator.php must strip mPDF OBJECT_IDENTIFIER bytes and UTF-8 markers from user values.'
);

uacf7_pdf_security_assert(
	false !== strpos( $pdf_source, 'objattr' ),
	'pdf-generator.php must strip objattr assignments from user values.'
);

uacf7_pdf_security_assert(
	false !== strpos( $pdf_source, 'esc_html( $clean_val )' ),
	'pdf-generator.php must entity-encode user input with esc_html.'
);

uacf7_pdf_security_assert(
	false !== strpos( $pdf_source, 'sanitize_pdf_template_value' ),
	'pdf-generator.php must define sanitize_pdf_template_value helper.'
);

// 1b. Static code assertion on third-party/vendor/mpdf/mpdf/src/Mpdf.php
$mpdf_file   = $root . '/third-party/vendor/mpdf/mpdf/src/Mpdf.php';
$mpdf_source = file_get_contents( $mpdf_file );

uacf7_pdf_security_assert(
	false !== strpos( $mpdf_source, "unserialize(\$sp['objattr'], array('allowed_classes' => false))" ),
	'Mpdf.php _getObjAttr must enforce allowed_classes => false on unserialize.'
);

// 2. Functional sanitization testing
require_once $pdf_file;
$generator = new UACF7_PDF_GENERATOR();

// 2a. Researcher PoC payload
$poc_payload = '<span style="font-family:chelvetica">»¤¬type=image,objattr=a:2:{s:4:"type";s:7:"unknown";s:6:"gadget";O:16:"WPCF7_Submission":1:{s:32:"&#0;WPCF7_Submission&#0;uploaded_files";a:1:{i:0;s:71:"/var/www/html/wp-config.php";}}}»¤¬</span>';
$sanitized   = $generator->sanitize_pdf_template_value( $poc_payload );

uacf7_pdf_security_assert(
	false === strpos( $sanitized, '»¤¬' ) && false === strpos( $sanitized, "\xbb\xa4\xac" ),
	'Sanitizer must remove all mPDF OBJECT_IDENTIFIER sequences.'
);
uacf7_pdf_security_assert(
	false === strpos( $sanitized, 'objattr=' ),
	'Sanitizer must strip objattr= parameter.'
);
uacf7_pdf_security_assert(
	false === strpos( $sanitized, '<span' ) && false !== strpos( $sanitized, '&lt;span' ),
	'Sanitizer must encode HTML tags so mPDF cannot execute font switching.'
);

// 2b. Legitimate user input preservation
$clean_name = 'John Doe';
uacf7_pdf_security_assert(
	'John Doe' === $generator->sanitize_pdf_template_value( $clean_name ),
	'Legitimate names must remain unchanged.'
);

$clean_text = 'Hello, this is a sample note with numbers 123 & symbols.';
uacf7_pdf_security_assert(
	'Hello, this is a sample note with numbers 123 &amp; symbols.' === $generator->sanitize_pdf_template_value( $clean_text ),
	'Legitimate text must be safely entity-encoded.'
);

echo "PDF Generator PHP Object Injection (CVE-2026-102435) regression checks passed successfully.\n";
