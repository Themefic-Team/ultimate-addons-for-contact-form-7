<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'TF_text' ) ) {
	class TF_text extends UACF7_Fields {

		public function __construct( $field, $value = '', $settings_id = '', $parent_field = '', $section_key = '' ) {
			parent::__construct( $field, $value, $settings_id, $parent_field, $section_key  );
		}

		public function render() {
			$type        = ( ! empty( $this->field['type'] ) ) ? $this->field['type'] : 'text';
			$placeholder = ( ! empty( $this->field['placeholder'] ) ) ? 'placeholder="' . $this->field['placeholder'] . '"' : '';
			if(isset($this->field['validate']) && $this->field['validate'] == 'no_space_no_special') {
				//remove special characters, replace space with underscore and convert to lowercase
				$this->value = sanitize_title(str_replace(' ', '_', strtolower($this->value)));
			}
			echo '<input type="' . esc_attr( $type ) . '" name="' . esc_attr( $this->field_name() ) . '" id="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '" ' . $placeholder . ' ' . $this->field_attributes() . '/>';
		}

		public function sanitize() {
			if(isset($this->field['validate']) && $this->field['validate'] == 'no_space_no_special') {
				//remove special characters, replace space with underscore and convert to lowercase
				return sanitize_title(str_replace(' ', '_', strtolower($this->value)));
			} else {
				return sanitize_text_field( $this->value );
			}
		}
	}
}