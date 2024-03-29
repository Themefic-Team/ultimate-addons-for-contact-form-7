<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UACF7_number' ) ) {
	class UACF7_number extends UACF7_Fields {

		public function __construct( $field, $value = '', $settings_id = '', $parent_field = '', $section_key = '' ) {
			parent::__construct( $field, $value, $settings_id, $parent_field, $section_key  );
		}

		public function render() {
			$type = ( ! empty( $this->field['type'] ) ) ? $this->field['type'] : 'number';
			$placeholder = ( ! empty( $this->field['placeholder'] ) ) ? 'placeholder="' . $this->field['placeholder'] . '"' : '';
			echo '<input type="' . esc_attr( $type ) . '" name="' . esc_attr( $this->field_name() ) . '" id="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr($this->value) . '" ' . $placeholder . ' '. $this->field_attributes() .'/>';
		}

	}
}