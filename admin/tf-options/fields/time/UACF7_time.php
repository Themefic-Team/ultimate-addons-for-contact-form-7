<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UACF7_time' ) ) {
	class UACF7_time extends UACF7_Fields {

		public function __construct( $field, $value = '', $settings_id = '', $parent_field = '', $section_key = '' ) {
			parent::__construct( $field, $value, $settings_id, $parent_field, $section_key  );
		}

		public function render() {

			$args = wp_parse_args( $this->field, array(
				'format' => 'h:i K',
				'placeholder' => esc_html__( 'Select Time', 'ultimate-addons-cf7' ),
			) );

			$format = ( ! empty( $args['format'] ) ) ? $args['format'] : 'Y-m-d';
			$placeholder  = ( ! empty( $args['placeholder'] ) ) ? $args['placeholder'] : esc_html__( 'Select Date', 'ultimate-addons-cf7' );
			?>
			<input type="text" name="<?php echo esc_attr( $this->field_name() ); ?>" placeholder="<?php echo esc_attr( $placeholder ) ?>" value="<?php echo esc_attr( $this->value ); ?>" class="flatpickr " data-format="<?php echo esc_attr( $format ); ?>" <?php echo $this->field_attributes() ?>/>
            <i class="fa-regular fa-clock"></i>
            <?php
		}


	}
}