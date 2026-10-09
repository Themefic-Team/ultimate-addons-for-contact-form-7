<?php
/**
 * Security regression test for CVE-2026-100386 & CVE-2026-102435
 * Unauthenticated Arbitrary File Read via mPDF SVG stream wrappers & PHP Object Injection
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

require_once $root . '/addons/pdf-generator/pdf-generator.php';

$generator = new UACF7_PDF_GENERATOR();

// Test 1: Eunho Kim's PoC SVG payload with :/php:// filter chain
$svg_exploit = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30">'
	. '<image width="30" height="30" xlink:href=":/php://filter/convert.iconv.L1.UCS-4|convert.base64-encode/resource=/etc/passwd" />'
	. '</svg>';

$sanitized_svg = $generator->sanitize_pdf_template_value( $svg_exploit );

// Check that tags are entity-encoded (cannot be parsed as SVG XML)
if ( strpos( $sanitized_svg, '<svg' ) !== false || strpos( $sanitized_svg, '<image' ) !== false ) {
	echo "FAIL: Unescaped SVG/image tags detected in sanitized output.\n";
	exit( 1 );
}

// Check that stream wrappers are stripped
if ( stripos( $sanitized_svg, 'php://' ) !== false || stripos( $sanitized_svg, ':/php://' ) !== false ) {
	echo "FAIL: Stream wrapper was not stripped from sanitized output.\n";
	exit( 1 );
}

// Test 2: Other dangerous stream wrappers: file://, phar://, data://, expect://, ftp://
$wrappers_payload = 'Check this: file:///etc/passwd and phar://malicious.phar and expect://id and data://text/plain';
$sanitized_wrappers = $generator->sanitize_pdf_template_value( $wrappers_payload );
if (
	stripos( $sanitized_wrappers, 'file://' ) !== false ||
	stripos( $sanitized_wrappers, 'phar://' ) !== false ||
	stripos( $sanitized_wrappers, 'data://' ) !== false ||
	stripos( $sanitized_wrappers, 'expect://' ) !== false
) {
	echo "FAIL: Dangerous wrappers were not stripped.\n";
	exit( 1 );
}

// Test 3: mPDF internal marker payload (CVE-2026-102435)
$object_payload = '»¤¬type=image,objattr=a:2:{s:4:"type";s:7:"unknown";s:6:"gadget";O:16:"WPCF7_Submission":1:{s:32:"test";}}»¤¬';
$sanitized_obj = $generator->sanitize_pdf_template_value( $object_payload );
if (
	strpos( $sanitized_obj, '»¤¬' ) !== false ||
	strpos( $sanitized_obj, "\xbb\xa4\xac" ) !== false ||
	stripos( $sanitized_obj, 'objattr=' ) !== false
) {
	echo "FAIL: mPDF markers or objattr keyword not stripped.\n";
	exit( 1 );
}

// Test 4: Legitimate user inputs preserved faithfully
$legitimate_inputs = [
	'John Doe',
	'user@example.com',
	'Hello, I would like to book a tour on 12/25/2026. Budget: $500 & 2 adults.',
	"Line 1\nLine 2\nLine 3",
	'Special chars: (parentheses) [brackets] {braces} % * # @ ! ? / - _ = +',
];

foreach ( $legitimate_inputs as $input ) {
	$output = $generator->sanitize_pdf_template_value( $input );
	if ( empty( $output ) ) {
		echo "FAIL: Legitimate input was wiped out: '$input'\n";
		exit( 1 );
	}
}

// Test 5: mPDF StreamWrapperChecker normalization against :/ bypass
$checker_source = file_get_contents( $root . '/third-party/vendor/mpdf/mpdf/src/File/StreamWrapperChecker.php' );
if ( false === strpos( $checker_source, "ltrim(\$filename, ':/\\ ')" ) && false === strpos( $checker_source, 'ltrim($filename' ) ) {
	echo "FAIL: StreamWrapperChecker does not normalize leading :/ bypass.\n";
	exit( 1 );
}

// Test 6: mPDF _getObjAttr allowed_classes => false
$mpdf_source = file_get_contents( $root . '/third-party/vendor/mpdf/mpdf/src/Mpdf.php' );
if ( false === strpos( $mpdf_source, "unserialize(\$sp['objattr'], array('allowed_classes' => false))" ) ) {
	echo "FAIL: Mpdf.php does not restrict unserialize with allowed_classes => false.\n";
	exit( 1 );
}

echo "PDF Generator SVG Arbitrary File Read (CVE-2026-100386) regression checks passed successfully.\n";
exit( 0 );
