<?php
/**
 * Security regression checks: File upload MIME sniffing and extension preservation in UACF7 Database addon.
 *
 * Run from the plugin root:
 * php tests/security/file-upload-stored-xss-security.php
 */

$root = dirname( __DIR__, 2 );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', $root . '/' );
}
if ( ! defined( 'UACF7_PATH' ) ) {
	define( 'UACF7_PATH', $root . '/' );
}

function uacf7_security_assert( $condition, $message ) {
	if ( ! $condition ) {
		echo "FAIL: {$message}\n";
		exit( 1 );
	}
}

// 1. Static code assertions on addons/database/database.php
$database_file   = $root . '/addons/database/database.php';
$database_source = file_get_contents( $database_file );

uacf7_security_assert(
	false !== strpos( $database_source, 'uacf7_protect_uploads_directory' ),
	'database.php must invoke uacf7_protect_uploads_directory to harden the uploads folder.'
);

uacf7_security_assert(
	false !== strpos( $database_source, '$ext_part = ! empty( $ext ) ? \'.\' . sanitize_key( $ext ) : \'\';' )
	|| false !== strpos( $database_source, '$dir_link = \'/uacf7-uploads/\' . $time_now . \'-\' . $file_key . $ext_part;' ),
	'database.php must preserve validated file extensions on stored uploads.'
);

uacf7_security_assert(
	false === strpos( $database_source, '$dir_link = \'/uacf7-uploads/\' . $time_now . \'-\' . $file_key;' . "\n\n\t\t\t\t\tif ( in_array( \$file_key, \$uacf7_signature_tag ) )" ),
	'database.php must not strip extensions from standard uploads.'
);

// 2. Static code assertions on inc/functions.php
$functions_file   = $root . '/inc/functions.php';
$functions_source = file_get_contents( $functions_file );

uacf7_security_assert(
	false !== strpos( $functions_source, 'function uacf7_protect_uploads_directory(' ),
	'functions.php must define uacf7_protect_uploads_directory.'
);

uacf7_security_assert(
	false !== strpos( $functions_source, 'X-Content-Type-Options' )
	&& false !== strpos( $functions_source, 'nosniff' ),
	'functions.php must configure X-Content-Type-Options: nosniff for upload directory.'
);

uacf7_security_assert(
	false !== strpos( $functions_source, 'Content-Disposition' )
	&& false !== strpos( $functions_source, 'attachment' ),
	'functions.php must configure Content-Disposition: attachment for text uploads.'
);

// 3. Functional tests for uacf7_is_safe_uploaded_file byte inspection
if ( ! function_exists( 'add_action' ) ) {
	function add_action() {}
}
if ( ! function_exists( 'add_filter' ) ) {
	function add_filter() {}
}
if ( ! function_exists( 'is_admin' ) ) {
	function is_admin() { return true; }
}
if ( ! function_exists( 'plugin_dir_url' ) ) {
	function plugin_dir_url() { return 'http://example.com/'; }
}
if ( ! function_exists( 'esc_html__' ) ) {
	function esc_html__( $t ) { return $t; }
}
if ( ! function_exists( 'esc_attr__' ) ) {
	function esc_attr__( $t ) { return $t; }
}
if ( ! function_exists( 'is_plugin_active' ) ) {
	function is_plugin_active() { return false; }
}
if ( ! function_exists( 'get_option' ) ) {
	function get_option() { return array(); }
}
if ( ! function_exists( 'update_option' ) ) {
	function update_option() { return true; }
}
if ( ! function_exists( 'wp_unslash' ) ) {
	function wp_unslash( $v ) { return $v; }
}
if ( ! function_exists( 'sanitize_text_field' ) ) {
	function sanitize_text_field( $v ) { return $v; }
}
if ( ! function_exists( 'sanitize_key' ) ) {
	function sanitize_key( $v ) { return preg_replace( '/[^a-z0-9_\-]/', '', strtolower( $v ) ); }
}

require_once $functions_file;

// Mock WordPress helper functions if not loaded in CLI
if ( ! function_exists( 'wp_basename' ) ) {
	function wp_basename( $path ) {
		return basename( $path );
	}
}

if ( ! function_exists( 'get_allowed_mime_types' ) ) {
	function get_allowed_mime_types() {
		return array(
			'txt|asc|c|cc|h|srt' => 'text/plain',
			'csv'                => 'text/csv',
			'pdf'                => 'application/pdf',
			'jpg|jpeg|jpe'       => 'image/jpeg',
			'png'                => 'image/png',
		);
	}
}

if ( ! function_exists( 'wp_check_filetype_and_ext' ) ) {
	function wp_check_filetype_and_ext( $file, $filename, $mimes ) {
		$ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
		if ( 'txt' === $ext ) {
			return array( 'ext' => 'txt', 'type' => 'text/plain' );
		}
		if ( 'csv' === $ext ) {
			return array( 'ext' => 'csv', 'type' => 'text/csv' );
		}
		if ( 'pdf' === $ext ) {
			return array( 'ext' => 'pdf', 'type' => 'application/pdf' );
		}
		return array( 'ext' => false, 'type' => false );
	}
}

// Test A: Malicious text file starting with <BODY onload=...
$tmp_xss = tempnam( sys_get_temp_dir(), 'uacf7_xss_' ) . '.txt';
file_put_contents( $tmp_xss, '<BODY onload="alert(document.domain)">POC-MARKER</BODY>' );

$is_safe_xss = uacf7_is_safe_uploaded_file( $tmp_xss );
@unlink( $tmp_xss );

uacf7_security_assert(
	false === $is_safe_xss,
	'uacf7_is_safe_uploaded_file must reject text files containing <BODY onload=... HTML payloads.'
);

// Test B: Malicious text file containing <script>
$tmp_script = tempnam( sys_get_temp_dir(), 'uacf7_script_' ) . '.txt';
file_put_contents( $tmp_script, 'Hello world <script>alert(1)</script>' );

$is_safe_script = uacf7_is_safe_uploaded_file( $tmp_script );
@unlink( $tmp_script );

uacf7_security_assert(
	false === $is_safe_script,
	'uacf7_is_safe_uploaded_file must reject text files containing <script> tags.'
);

// Test C: Legitimate plain text notes
$tmp_clean = tempnam( sys_get_temp_dir(), 'uacf7_clean_' ) . '.txt';
file_put_contents( $tmp_clean, "Meeting notes:\n1. Discuss quarterly results\n2. Prepare budget" );

$is_safe_clean = uacf7_is_safe_uploaded_file( $tmp_clean );
@unlink( $tmp_clean );

uacf7_security_assert(
	true === $is_safe_clean,
	'uacf7_is_safe_uploaded_file must allow legitimate plain text files.'
);

// Test D: Legitimate CSV file
$tmp_csv = tempnam( sys_get_temp_dir(), 'uacf7_csv_' ) . '.csv';
file_put_contents( $tmp_csv, "Name,Email,Department\nJohn Doe,john@example.com,Engineering\nJane Smith,jane@example.com,Marketing" );

$is_safe_csv = uacf7_is_safe_uploaded_file( $tmp_csv );
@unlink( $tmp_csv );

uacf7_security_assert(
	true === $is_safe_csv,
	'uacf7_is_safe_uploaded_file must allow legitimate CSV files.'
);

// 4. Test directory protection function
$tmp_dir = sys_get_temp_dir() . '/uacf7_test_dir_' . uniqid();
mkdir( $tmp_dir );
uacf7_protect_uploads_directory( $tmp_dir );

uacf7_security_assert(
	file_exists( $tmp_dir . '/index.php' ),
	'uacf7_protect_uploads_directory must generate index.php.'
);
uacf7_security_assert(
	file_exists( $tmp_dir . '/.htaccess' ),
	'uacf7_protect_uploads_directory must generate .htaccess.'
);
$htaccess_content = file_get_contents( $tmp_dir . '/.htaccess' );
uacf7_security_assert(
	false !== strpos( $htaccess_content, 'nosniff' ) && false !== strpos( $htaccess_content, 'attachment' ),
	'.htaccess must enforce nosniff and attachment headers.'
);

@unlink( $tmp_dir . '/index.php' );
@unlink( $tmp_dir . '/.htaccess' );
@rmdir( $tmp_dir );

echo "UACF7 file upload Stored XSS regression checks passed successfully.\n";
