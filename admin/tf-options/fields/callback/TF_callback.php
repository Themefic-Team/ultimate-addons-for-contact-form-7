<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TF_callback' ) ) {
	class TF_callback extends TF_Fields {

		public function __construct( $field, $value = '', $settings_id = '', $parent_field = '') {
			parent::__construct( $field, $value, $settings_id, $parent_field );
		}

		public function render() {
			if ( isset( $this->field['function'] ) ) {
				if(isset($this->field['argument'])){
					call_user_func( $this->field['function'], $this->field['argument'] );
				}else{
					call_user_func( $this->field['function'] );
				} 
            }
		}

	}
}