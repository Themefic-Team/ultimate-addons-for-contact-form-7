<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Uacf7_Dashboard_Promo_Notice {

	const NOTICE_KEY = 'uacf7_pro_promo';

	public function __construct() {

		add_action(
			'wp_ajax_uacf7_dismiss_promo_notice',
			array( $this, 'dismiss_notice' )
		);

		/**
		 * Custom hook.
		 *
		 * Usage:
		 * do_action( 'uacf7_dashboard_promo_notice' );
		 */
		add_action(
			'uacf7_dashboard_promo_notice',
			array( $this, 'render' )
		);
	}

    // instance method to make it singleton class
    public static function instance() {
        static $instance = null;

        if ( is_null( $instance ) ) {
            $instance = new self();
        }

        return $instance;
    }

	/**
	 * Check if Pro plugin active.
	 */
	private function is_pro_active() {

        if ( defined( 'UACF7_PRO_VERSION' ) || class_exists( 'Ultimate_Addons_CF7_PRO' ) ) {
            return true;
        }
		
        return false;
	}

	/**
	 * Should display notice?
	 */
	public function should_display() {
		
		if ( $this->is_pro_active() ) {
			return false;
		}
		
		$user_id = get_current_user_id();

		$data = get_user_meta(
			$user_id,
			self::NOTICE_KEY,
			true
		);

		if ( empty( $data ) ) {
			return true;
		}

		if ( ! empty( $data['forever'] ) ) {
			return false;
		}

		if (
			! empty( $data['hide_until'] ) &&
			time() < absint( $data['hide_until'] )
		) {
			return false;
		}

		return true;
	}

	/**
	 * Render banner.
	 */
	public function render() {

		if ( ! $this->should_display() ) {
			return;
		}

		?>

		<div class="uacf7-promo-banner">

			<button
				type="button"
				class="uacf7-promo-close"
				aria-label="<?php esc_attr_e( 'Dismiss', 'ultimate-addons-cf7' ); ?>"
			>
				<svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 0.5L0.5 8M0.5 0.5L8 8" stroke="#626A6A" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
			</button>

			<div class="uacf7-promo-icon">

				<img style="height:72px; width:60px;" src="<?php echo UACF7_URL; ?>assets/admin/images/icons/shield-icon.gif" alt="shield logo">

			</div>

			<div class="uacf7-promo-content">

				<h3>
					<?php esc_html_e(
						'Lifetime License only for $49',
						'ultimate-addons-cf7'
					); ?>
				</h3>

				<p>
					<?php esc_html_e(
						'All PRO features included.',
						'ultimate-addons-cf7'
					); ?>
				</p>

			</div>

			<div class="uacf7-promo-action">
				<a
					href="<?php echo esc_url( uacf7_utm_generator( 'https://cf7addons.com/pricing', array( 'utm_medium' => 'dashboard_promo_notice', 'utm_source' => 'uacf7_in_plugin_addons_button', 'utm_campaign' => 'uacf7_plugin_free' ) ) ); ?>"
					target="_blank"
					class="button button-primary"
				>
					<?php esc_html_e(
						'Buy Now',
						'ultimate-addons-cf7'
					); ?>
				</a>

			</div>

		</div>

		<?php
	}

	/**
	 * Dismiss notice.
	 */
	public function dismiss_notice() {

		check_ajax_referer(
			'uacf7_notice_nonce',
			'nonce'
		);

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( 'Unauthorized' );
        }

		$user_id = get_current_user_id();

		$data = get_user_meta(
			$user_id,
			self::NOTICE_KEY,
			true
		);

		if ( empty( $data ) ) {
			$data = array(
				'dismiss_count' => 1,
				'hide_until'    => strtotime( '+7 days' ),
			);
		} else {

			$count = isset( $data['dismiss_count'] )
				? absint( $data['dismiss_count'] )
				: 0;

			$count++;

			if ( $count >= 2 ) {

				$data = array(
					'dismiss_count' => $count,
					'forever'       => true,
				);

			} else {

				$data = array(
					'dismiss_count' => $count,
					'hide_until'    => strtotime( '+7 days' ),
				);
			}
		}

		update_user_meta(
			$user_id,
			self::NOTICE_KEY,
			$data
		);

		wp_send_json_success();
	}

}

Uacf7_Dashboard_Promo_Notice::instance();