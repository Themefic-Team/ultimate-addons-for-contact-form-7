<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

/**
 * Field: text
 */
if ( ! class_exists( 'UACF7_gallery' ) ) {
	class UACF7_gallery extends UACF7_Fields {

		public function __construct( $field, $value = '', $settings_id = '', $parent_field = '', $section_key = '' ) {
			parent::__construct( $field, $value, $settings_id, $parent_field, $section_key  );
		}

		public function render() {
			$type = ( ! empty( $this->field['type'] ) ) ? $this->field['type'] : 'text';

			echo '<div class="tf-fieldset-gallery-preview ' . str_replace(array("[","]","-"),"_",esc_attr( $this->field_name() ) ) . '">';
			if ( !empty( $this->value ) ) {
				$tf_gallery_ids = explode( ',', $this->value );
				foreach ( $tf_gallery_ids as $key => $gallery_item_id ) {
					$image_url = wp_get_attachment_url( $gallery_item_id, 'full' );
					echo '<img src="' . $image_url . '" alt="">';
				}
			}
			echo '
			</div>
			<div class="tf-fieldset-gallery">
			<a href="#" tf-field-name="' . esc_attr( $this->field_name() ) . '" class="tf-gallery-upload button button-primary button-large">' . esc_html( "Add Gallery","ultimate-addons-cf7" ) . '</a>';
			if(!empty($this->value)){
				echo '<a href="#" tf-field-name="' . esc_attr( $this->field_name() ) . '" class="tf-gallery-edit button button-primary button-large ' . str_replace(array("[","]","-"),"_",esc_attr( $this->field_name() ) ) . '">' . esc_html( "Edit Gallery","ultimate-addons-cf7" ) . '</a><a href="#" tf-field-name="' . esc_attr( $this->field_name() ) . '" class="tf-gallery-remove button button-warning button-large ' . str_replace(array("[","]","-"),"_",esc_attr( $this->field_name() ) ) . '" style="display:inline-block">' . esc_html( "Clear","ultimate-addons-cf7" ) . '</a>';
			}else{
				echo '<a href="#" tf-field-name="' . esc_attr( $this->field_name() ) . '" class="tf-gallery-edit button button-primary button-large ' . str_replace(array("[","]","-"),"_",esc_attr( $this->field_name() ) ) . '" style="display:none">' . esc_html( "Edit Gallery","ultimate-addons-cf7" ) . '</a><a href="#" tf-field-name="' . esc_attr( $this->field_name() ) . '" class="tf-gallery-remove button button-warning button-large ' . str_replace(array("[","]","-"),"_",esc_attr( $this->field_name() ) ) . '" style="display:none">' . esc_html( "Clear","ultimate-addons-cf7" ) . '</a>';
			}
			echo '</div>
			<input type="hidden" name="' . esc_attr( $this->field_name() ) . '" id="' . esc_attr( $this->field_name() ) . '" value="' . $this->value . '"  />';
		}



	}
}