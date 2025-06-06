<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UACF7_tab' ) ) {
	class UACF7_tab extends UACF7_Fields {

		public function __construct( $field, $value = '', $settings_id = '', $parent_field = '', $section_key = '' ) {
			parent::__construct( $field, $value, $settings_id, $parent_field, $section_key  );
		}

		public function render() {
			?>
            <div id="<?php echo isset( $this->field['id'] ) ? esc_attr( $this->field['id'] ) : '' ?>" class="tf-tablist">
				<?php $parent_id = !empty( $this->field['id'] ) ? $this->field['id'] : ''; ?>

				<?php if ( count( $this->field['tabs'] ) > 1 ): ?>
                    <ul class="tf-nav-tabs">
						<?php if ( isset( $this->field['tabs'] ) && is_array( $this->field['tabs'] ) ): ?>
							<?php foreach ( $this->field['tabs'] as $key => $value ): ?>
                                <li class="tf-tab-item <?php if ( $key == 0 ) {
									echo "show";
								} ?>" data-tab-id="<?php if ( isset( $value['id'] ) ) {
									echo esc_attr( $value['id'] );
								} ?>"><?php echo $value['title'] ?></li>
							<?php endforeach; ?>
						<?php endif; ?>
                    </ul>
				<?php endif; ?>
                <div class="tf-tab-field-content">
					<?php if ( isset( $this->field['tabs'] ) && is_array( $this->field['tabs'] ) ): ?>
						<?php foreach ( $this->field['tabs'] as $key => $value ): ?>
                            <div class="tf-tab-item-content <?php echo $key == 0 ? "show" : '' ?>" data-tab-id="<?php echo isset( $value['id'] ) ? esc_attr( $value['id'] ) : '' ?>">
								<?php
								
								foreach ( $value['fields'] as $key => $field ) {
									
									$parent  = '[' . $this->field['id'] . ']';
									$default = isset( $field['default'] ) ? $field['default'] : '';
									$value   = $default;

									if ( ! empty( $this->value ) ) {
										
										$data = ( ! is_array( $this->value ) ) ? unserialize( $this->value ) : $this->value;
										if ( is_array( $data ) ) {
											if ( isset( $data[ $field['id'] ] ) ) {

												$value = ( isset( $field['id'] ) ) ? $data[ $field['id'] ] : '';
											} else {
												$value = '';
											}
										}
									}
									
									// sanitize Wp Editor Field
									$value = ( $field['type'] == 'editor' ) ? wp_kses_post($value) : $value;

									$tf_option = new UACF7_Options();
									$tf_option->field( $field, $value, $this->settings_id, $parent );
								}
								?>
								
                            </div>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php do_action( $parent_id . '_after_tab_content' );
					 // do_action('uacf7dp_email_piping_tap_after_tab_content') ?>
                </div>
            </div>
			<?php
		}
		public function sanitize() {
			return $this->value;
		}
	}		

}