<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Uacf7DashboardWidget {

    private static $instance = null;

    public function __construct() {
        add_action( 'wp_dashboard_setup', array( $this, 'uacf7_register_dashboard_widget' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'uacf7_widget_enqueue_assets' ) );
    }

    public static function instance() {
        if ( ! self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function uacf7_register_dashboard_widget() {
        wp_add_dashboard_widget( 'uawpf_widget', __( 'Ultra Addons for Contact Form 7', 'ultimate-addons-cf7' ), array( $this, 'uacf7_display_dashboard_widget' ) , null, null, 'normal', 'high' );
    }

    public function uacf7_widget_enqueue_assets( $screen ) {

        /**
		 * Admin Dashboard CSS
		 */
		if ( $screen == 'index.php' ) {
			wp_enqueue_style( 'uacf7-admin-dashboard', ULTRAWPF_URL . 'assets/admin/css/uacf7-admin-dashboard.css', '', ULTRAWPF_VERSION );
		}

    }

    public function uacf7_display_dashboard_widget() {
        $enableDatabase = uacf7_settings('uacf7_enable_database_field');
        ?>
        <div class="uawpf-widget">

            <!-- Stats Row -->
            <div class="uawpf-stats">

                <?php if ( $enableDatabase ) { ?>
                    <div class="uawpf-stat">
                        <?php
                            global $wpdb;

                            // Get last 30 days date
                            $date_30_days_ago = date( 'Y-m-d H:i:s', strtotime( '-30 days' ) );

                            // Get all active WPForms
                            $forms = get_posts( [
                                'post_type'      => 'wpcf7_contact_form',
                                'post_status'    => 'publish',
                                'posts_per_page' => -1,
                                'fields'         => 'ids',
                            ] );
                            
                            $total_submissions = 0;

                            if ( ! empty( $forms ) ) {
                                foreach ( $forms as $form_id ) {

                                    $count = (int) $wpdb->get_var(
                                        $wpdb->prepare(
                                            "SELECT COUNT(*) 
                                            FROM {$wpdb->prefix}uacf7_form 
                                            WHERE form_id = %d",
                                            $form_id
                                        )
                                    );

                                    $total_submissions += $count;
                                }
                            }

                        ?>
                        <strong><?php echo esc_html( $total_submissions ); ?></strong>
                        <span><?php esc_html_e( 'Total Submissions', 'ultimate-addons-cf7' ); ?></span>
                    </div>
                    <div class="uawpf-stat">
                        <strong>
                            <?php 
                            $count = wp_count_posts( 'wpcf7_contact_form' );
                            echo isset( $count->publish ) ? (int) $count->publish : 0;
                            ?>
                        </strong>
                        <span><?php esc_html_e( 'Total Active Forms', 'ultimate-addons-cf7' ); ?></span>
                    </div>
                <?php }else{ ?>
                    <div class="uawpf-stat">
                        <strong>
                            <?php 
                            $count = wp_count_posts( 'wpcf7_contact_form' );
                            echo isset( $count->publish ) ? (int) $count->publish : 0;
                            ?>
                        </strong>
                        <span><?php esc_html_e( 'Total Active Forms', 'ultimate-addons-cf7' ); ?></span>
                        </br></br>
                        <div class="uawpf-actions">
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=ultrawpf_addons' ) ); ?>" class="button">
                                <?php esc_html_e( 'Enable Database Addon To Save Entries', 'ultimate-addons-cf7' ); ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Quick Actions -->
            <div class="uawpf-actions">
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wpcf7-new' ) ); ?>" class="button button-primary">
                    <?php esc_html_e( 'Create Form', 'ultimate-addons-cf7' ); ?>
                </a>
                <?php if($enableDatabase):?>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=ultimate-addons-db' ) ); ?>" class="button">
                    <?php esc_html_e( 'View Entries', 'ultimate-addons-cf7' ); ?>
                </a>
                <?php endif;?>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=uacf7_settings#tab=mailchimp' ) ); ?>" class="button">
                    <?php esc_html_e( 'Settings', 'ultimate-addons-cf7' ); ?>
                </a>
            </div>

            <!-- Popular Integrations -->
            <div class="uawpf-section uawpf-integrations">
                <h4><?php esc_html_e( 'Popular Integrations', 'ultimate-addons-cf7' ); ?></h4>

                <div class="uawpf-integration-grid">

                    <div class="uawpf-integration-item">
                        <span class="dashicons dashicons-media-spreadsheet"></span>
                        <span><?php esc_html_e( 'Google Sheets', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                    <div class="uawpf-integration-item">
                        <span class="dashicons dashicons-admin-generic"></span>
                        <span><?php esc_html_e( 'Mailchimp', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                    <div class="uawpf-integration-item">
                        <span class="dashicons dashicons-rest-api"></span>
                        <span><?php esc_html_e( 'Salesforce Integration', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                    <div class="uawpf-integration-item">
                        <span class="dashicons dashicons-admin-site-alt"></span>
                        <span><?php esc_html_e( 'Slack Integration', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                </div>
            </div>

            <!-- Button for more integrations -->
            <div class="uawpf-actions">
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=uacf7_addons' ) ); ?>" class="button">
                    <?php esc_html_e( 'Check More Integrations', 'ultimate-addons-cf7' ); ?>
                </a>
            </div>
            
            <?php if(!class_exists('Ultimate_Addons_CF7_PRO')){  ?>
            <!-- Upsell -->
            <div class="uawpf-upsell">
                <h4><?php esc_html_e( 'Unlock Pro Features', 'ultimate-addons-cf7' ); ?></h4>
                <ul>
                    <li><?php esc_html_e( '✔ Conditional Logic', 'ultimate-addons-cf7' ); ?></li>
                    <li><?php esc_html_e( '✔ Custom Column Width', 'ultimate-addons-cf7' ); ?></li>
                    <li><?php esc_html_e( '✔ Frontend Post Submission', 'ultimate-addons-cf7' ); ?></li>
                    <li><?php esc_html_e( '✔ Drag & Drop File Upload & Signature', 'ultimate-addons-cf7' ); ?></li>
                </ul>
                <a href="<?php echo esc_url( 'https://cf7addons.com/pricing' ); ?>" target="_blank" class="button button-primary go-pro">
                    <?php esc_html_e( 'Upgrade Now', 'ultimate-addons-cf7' ); ?>
                </a>
            </div>
            <?php } ?>
            <!-- Blog Section -->
			<div class="uawpf-section-title"><?php esc_html_e( 'Latest posts from Ultra Addons for Contact Form 7', 'ultimate-addons-cf7' ); ?></div>
			<ul class="uawpf-blog-list">
				<li>
					<span class="uawpf-badge"><?php esc_html_e( 'NEW', 'ultimate-addons-cf7' ); ?></span>
					<a href="<?php echo esc_url( 'https://cf7addons.com/how-to-install-plugins-in-wordpress-website/' ); ?>" target="_blank"><?php esc_html_e( 'How to install plugins on your WordPress website How to Install Plugins in WordPress: A Complete Beginner’s Guide', 'ultimate-addons-cf7' ); ?></a>
				</li>
				<li>
					<a href="<?php echo esc_url( 'https://cf7addons.com/twilio-slack-integration-prevent-duplicate-entries-and-google-recaptcha-v3/' ); ?>" target="_blank"><?php esc_html_e( 'Contact form 7 Integration with twilio slack prevent duplicate submission | Ultra Addons for Contact Form 7 Ultra Addons for Contact Form 7 v3.5.25: Twilio, Slack Integration, Prevent Duplicate Entries, and Google reCAPTCHA v3', 'ultimate-addons-cf7' ); ?></a>
				</li>
				<li>
					<a href="<?php echo esc_url( 'https://cf7addons.com/twilio-integration-with-contact-form-7-instant-sms-and-whatsapp-notifications/' ); ?>" target="_blank"><?php esc_html_e( 'Twilio Integration with Contact Form 7: Instant SMS and WhatsApp Notifications', 'ultimate-addons-cf7' ); ?></a>
				</li>
			</ul>

            <!-- Footer -->
            <div class="uawpf-footer">
                <a href="<?php echo esc_url( 'https://cf7addons.com/docs/' ); ?>" target="_blank">
                    <?php esc_html_e( 'Docs', 'ultimate-addons-cf7' ); ?>
                    <span aria-hidden="true" class="dashicons dashicons-external"></span>
                </a>
                <a href="<?php echo esc_url( 'https://portal.themefic.com/support/' ); ?>" target="_blank">
                    <?php esc_html_e( 'Support', 'ultimate-addons-cf7' ); ?>
                    <span aria-hidden="true" class="dashicons dashicons-external"></span>
                </a>
                <a href="<?php echo esc_url( 'https://cf7addons.com/blog/' ); ?>" target="_blank">
                    <?php esc_html_e( 'Blog', 'ultimate-addons-cf7' ); ?>
                    <span aria-hidden="true" class="dashicons dashicons-external"></span>
                </a>
                <a href="<?php echo esc_url( 'https://cf7addons.com/pricing' ); ?>" target="_blank" class="go-pro">
                    <?php esc_html_e( 'Buy Now', 'ultimate-addons-cf7' ); ?>
                    <span aria-hidden="true" class="dashicons dashicons-external"></span>
                </a>
            </div>

        </div>
        <?php
    }



}

Uacf7DashboardWidget::instance();