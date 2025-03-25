<?php

if ( ! function_exists( 'uacf7dp_column_default_fields' ) ) {
	function uacf7dp_column_default_fields( $item, $column_name ) {
		$newArray = array();

		foreach ( $item as $key => $innerArray ) {
			// Create an associative array with 'fields_name' as keys and 'value' as values
			$associativeArray = array_column( $innerArray, 'value', 'fields_name' );

			$resultArray = array_merge( $associativeArray, array( 'id' => $innerArray[0]['data_id'], 'cf7_form_id' => $innerArray[0]['cf7_form_id'] ) );

			// Match the keys from $array2 and assign the corresponding values
			$resultArray = array_intersect_key( $resultArray, $column_name );

			// Add the result to the new array
			$newArray[ $key ] = $resultArray;
		}

		return $newArray;
	}
	add_filter( 'uacf7dp_column_default_fields', 'uacf7dp_column_default_fields', 10, 2 );
}

if ( ! function_exists( 'uacf7dp_checkNonce' ) ) {
	function uacf7dp_checkNonce() {
		$nonce = sanitize_text_field( $_POST['nonce'] );
		if ( ! wp_verify_nonce( $nonce, 'uacf7dp-nonce' ) ) {
			wp_send_json_error( array( 'mess' => 'Nonce is invalid' ) );
		}
	}
}