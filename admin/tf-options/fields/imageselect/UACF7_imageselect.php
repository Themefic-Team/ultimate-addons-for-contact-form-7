<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'UACF7_imageselect' ) ) {
	class UACF7_imageselect extends UACF7_Fields {

		public function __construct( $field, $value = '', $settings_id = '', $parent_field = '', $section_key = '' ) {
			parent::__construct( $field, $value, $settings_id, $parent_field, $section_key  );
		}

		public function render() {
			if ( isset( $this->field['options'] ) ) {
				$inline = ( isset( $this->field['inline'] ) && $this->field['inline'] ) ? 'tf-inline' : '';
				echo '<ul class="tf-image-radio-group ' . esc_attr( $inline ) . '">';
				foreach ( $this->field['options'] as $key => $value ) {
					$checked = $key == $this->value ? ' checked' : '';
					$class = '';
					$disabled = '';
					$tf_pro = '';
					if(isset($value['is_pro']) && $value['is_pro'] == true) {
						$disabled = ' disabled';
						$class .= ' tf-field-disable tf-field-pro';
						$tf_pro = ' <div class="tf-csf-badge"><span class="tf-pro">Pro</span></div>';
					} 
                    ?>
                    <li>
                    <label class="tf-image-checkbox <?php echo esc_attr($class) ?>">
                    <?php echo '<input type="radio" id="' . esc_attr($this->field_name()) . '[' . esc_attr($key) . ']" '.esc_attr($disabled).' name="' . esc_attr($this->field_name()) . '" data-depend-id="' . esc_attr( $this->field['id'] ) . '' . esc_attr($this->parent_field) . '" value="' . esc_attr( $key ) . '" ' . esc_attr( $checked ) . ' '. wp_kses_post($this->field_attributes()) .'/>';
                    ?>
                        <img src="<?php echo esc_url($value['url']); ?>" alt="<?php echo esc_attr($value['title']); ?>">
						<span class="tf-image-title">
							<?php echo esc_html($value['title']); ?>
							<?php echo wp_kses_post($tf_pro); ?>
						</span>
                    </label>  
                    </li>

                <?php
				}
				echo '</ul>';
			}
		}
	}
}