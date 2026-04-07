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
        wp_add_dashboard_widget( 'uacf7_widget', __( 'Ultra Addons for Contact Form 7', 'ultimate-addons-cf7' ), array( $this, 'uacf7_display_dashboard_widget' ) , null, null, 'normal', 'high' );
    }

    public function uacf7_widget_enqueue_assets( $screen ) {

        /**
		 * Admin Dashboard CSS
		 */
		if ( $screen == 'index.php' ) {
			wp_enqueue_style( 'uacf7-admin-dashboard', UACF7_URL . 'assets/css/uacf7-admin-dashboard.css', '', UACF7_VERSION );
		}

    }

    public function uacf7_display_dashboard_widget() {
        $enableDatabase = uacf7_settings('uacf7_enable_database_field');
        ?>
        <div class="uacf7-widget">

            <!-- Stats Row -->
            <div class="uacf7-stats">

                <?php if ( $enableDatabase ) { ?>
                    <div class="uacf7-stat">
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
                    <div class="uacf7-stat">
                        <strong>
                            <?php 
                            $count = wp_count_posts( 'wpcf7_contact_form' );
                            echo isset( $count->publish ) ? (int) $count->publish : 0;
                            ?>
                        </strong>
                        <span><?php esc_html_e( 'Total Active Forms', 'ultimate-addons-cf7' ); ?></span>
                    </div>
                <?php }else{ ?>
                    <div class="uacf7-stat">
                        <strong>
                            <?php 
                            $count = wp_count_posts( 'wpcf7_contact_form' );
                            echo isset( $count->publish ) ? (int) $count->publish : 0;
                            ?>
                        </strong>
                        <span><?php esc_html_e( 'Total Active Forms', 'ultimate-addons-cf7' ); ?></span>
                        </br></br>
                        <div class="uacf7-actions">
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=uacf7_addons' ) ); ?>" class="button">
                                <?php esc_html_e( 'Enable Database Addon To Save Entries', 'ultimate-addons-cf7' ); ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Quick Actions -->
            <div class="uacf7-actions">
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
            <div class="uacf7-section uacf7-integrations">
                <h4><?php esc_html_e( 'Popular Integrations', 'ultimate-addons-cf7' ); ?></h4>

                <div class="uacf7-integration-grid">

                    <div class="uacf7-integration-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M0 448c0 35.3 28.7 64 64 64l149.5 0c17 0 33.3-6.7 45.3-18.7L365.3 386.7c12-12 18.7-28.3 18.7-45.3L384 64c0-35.3-28.7-64-64-64L64 0C28.7 0 0 28.7 0 64L0 448zm208 5.5l0-93.5c0-13.3 10.7-24 24-24l93.5 0-117.5 117.5zM153 105l-48 48c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l48-48c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zm96 32L137 249c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9L215 103c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                        <span><?php esc_html_e( 'Google Sheets', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                    <div class="uacf7-integration-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M331 243.5c3.1-.4 6.2-.4 9.3 0 1.7-3.8 2-10.4 .5-17.6-2.2-10.7-5.3-17.1-11.5-16.1s-6.5 8.7-4.2 19.4c1.3 6 3.5 11.1 6 14.3l0 0zM277.4 252c4.5 2 7.2 3.3 8.3 2.1 1.9-1.9-3.5-9.4-12.1-13.1-5-2.1-10.4-2.8-15.8-2.2s-10.5 2.7-14.8 5.8c-3 2.2-5.8 5.2-5.4 7.1 .9 3.7 10-2.7 22.6-3.5 7-.4 12.8 1.8 17.3 3.7l0 0zm-9 5.1c-9.1 1.4-15 6.5-13.5 10.1 .9 .3 1.2 .8 5.2-.8 6-2.3 12.4-2.9 18.7-1.9 2.9 .3 4.3 .5 4.9-.5 1.5-2.2-5.7-8-15.4-6.9l0 0zm54.2 17.1c3.4-6.9-10.9-13.9-14.3-7s10.9 13.9 14.3 7l0 0zm15.7-20.5c-7.7-.1-8 15.8-.3 15.9s8-15.8 .3-16l0 0zM119.5 332.7c-1.3 .3-6 1.5-8.5-2.3-5.2-8 11.1-20.4 3-35.8-9.1-17.5-27.8-13.5-35-5.5-8.7 9.6-8.7 23.5-5 24.1 4.3 .6 4.1-6.5 7.4-11.6 .9-1.4 2.1-2.6 3.5-3.6s3-1.6 4.6-2 3.4-.4 5 0 3.3 1 4.7 1.9c11.6 7.6 1.4 17.8 2.3 28.6 1.4 16.7 18.4 16.4 21.6 9 .2-.4 .3-.8 .3-1.2s-.2-.8-.5-1.1c0 .9 .7-1.3-3.4-.4l0 0zm299.7-17.1c-3.3-11.7-2.6-9.2-6.8-20.5 2.4-3.7 15.3-24-3.1-43.3-10.4-10.9-33.9-16.5-41.1-18.5-1.5-11.4 4.6-58.7-21.5-83 20.8-21.6 33.8-45.3 33.7-65.7-.1-39.2-48.2-51-107.4-26.5l-12.5 5.3c-.1 0-22.7-22.3-23.1-22.6-67.5-58.9-278.8 175.9-211.3 232.9l14.8 12.5c-4 10.7-5.4 22.2-4.1 33.5 3.4 33.4 36 60.4 67.5 60.4 57.7 133.1 267.9 133.3 322.3 3 1.7-4.5 9.1-24.6 9.1-42.4s-10.1-25.3-16.5-25.3l0 0zm-316 48.2c-22.8-.6-47.5-21.1-49.9-45.5-6.2-61.3 74.3-75.3 84-12.3 4.5 29.6-4.7 58.5-34.1 57.8l0 0zM84.7 249.6c-15.2 3-28.5 11.5-36.7 23.5-4.9-4.1-14-12-15.6-15-13-24.8 14.2-73 33.3-100.2 47.1-67.2 120.9-118.1 155-108.9 5.5 1.6 23.9 22.9 23.9 22.9s-34.1 18.9-65.8 45.3C136.2 150 104 197.7 84.7 249.6zM323.6 350.7s-35.7 5.3-69.5-7.1c6.2-20.2 27 6.1 96.4-13.8 15.3-4.4 35.4-13 51-25.4 3.4 7.8 5.8 15.9 7.1 24.3 3.7-.7 14.2-.5 11.4 18.1-3.3 19.9-11.7 36-25.9 50.8-8.9 9.6-19.4 17.5-31.2 23.3-6.5 3.4-13.3 6.3-20.3 8.6-53.5 17.5-108.3-1.7-126-43-1.4-3.1-2.6-6.4-3.6-9.7-7.5-27.2-1.1-59.8 18.8-80.4 1.2-1.3 2.5-2.9 2.5-4.8-.2-1.7-.8-3.3-1.9-4.5-7-10.1-31.2-27.4-26.3-60.8 3.5-24 24.5-40.9 44.1-39.9l5 .3c8.5 .5 15.9 1.6 22.9 1.9 11.7 .5 22.2-1.2 34.6-11.6 4.2-3.5 7.6-6.5 13.3-7.5 2.3-.6 4.7-.7 7-.3s4.6 1.2 6.6 2.5c10 6.6 11.4 22.7 11.9 34.5 .3 6.7 1.1 23 1.4 27.6 .6 10.7 3.4 12.2 9.1 14 3.2 1 6.2 1.8 10.5 3.1 13.2 3.7 21 7.5 26 12.3 2.5 2.5 4.2 5.8 4.7 9.3 1.6 11.4-8.8 25.4-36.3 38.2-46.7 21.7-93.7 14.4-100.5 13.7-20.2-2.7-31.6 23.3-19.5 41.1 22.6 33.4 122.4 20 151.4-21.4 .7-1 .1-1.6-.7-1-41.8 28.6-97.1 38.2-128.5 26-4.8-1.8-14.7-6.4-15.9-16.7 43.6 13.5 71 .7 71 .7s2-2.8-.6-2.5zM171.7 157.5c16.7-19.4 37.4-36.2 55.8-45.6 .1-.1 .3-.1 .5-.1s.3 .1 .4 .2 .2 .3 .2 .4 0 .3-.1 .5c-1.5 2.7-4.3 8.3-5.2 12.7 0 .1 0 .3 0 .4s.2 .3 .3 .4 .3 .1 .4 .1 .3 0 .4-.1c11.5-7.8 31.5-16.2 49-17.3 .2 0 .3 0 .5 .1s.2 .2 .3 .4 .1 .3 0 .5-.1 .3-.3 .4c-2.9 2.2-5.5 4.8-7.7 7.7-.1 .1-.1 .2-.1 .4s0 .3 .1 .4 .2 .2 .3 .3 .2 .1 .4 .1c12.3 .1 29.7 4.4 41 10.7 .8 .4 .2 1.9-.6 1.7-69.5-15.9-123.1 18.5-134.5 26.8-.2 .1-.3 .1-.5 .1s-.3-.1-.5-.2-.2-.3-.2-.5 .1-.4 .2-.5l-.1 0z"/></svg>
                        <span><?php esc_html_e( 'Mailchimp', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                    <div class="uacf7-integration-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M249.4 245.6l-26.4 0c.7-5.2 3.3-14.1 13.6-14.1 6.8 0 12 3.8 12.7 14.1zM386 231.8c-.5 0-14.1-1.8-14.1 20s13.6 20 14.1 20c13 0 14.1-13.5 14.1-20 0-21.8-13.7-20-14.1-20zM142.8 255.5c-1.1 .9-2 2-2.5 3.2s-.8 2.7-.7 4c0 4.8 2.1 6.1 3.3 7 4.7 3.7 15.1 2.1 20.9 1l0-16.9c-5.3-1.1-16.7-2-20.9 1.6zM640.5 232c0 87.6-80 154.4-165.4 136.4-18.4 33-70.7 70.8-132.2 41.6-41.2 96-177.9 92.2-213.8-5.2-119.7 23.9-178.8-138.4-75.3-199.3-34.8-79.4 22.6-173.6 114.3-173.6 19.1 0 37.9 4.4 55 12.9s32 20.7 43.6 35.8c20.7-21.4 49.4-34.8 81.1-34.8 42.3 0 79 23.5 98.8 58.6 92.8-40.7 193.8 28.2 193.8 127.5zM120.9 263.8c0-11.8-11.7-15.2-17.9-17.2-5.3-2.1-13.4-3.5-13.4-8.9 0-9.5 17-6.7 25.2-2.1 0 0 1.2 .7 1.6-.5 .2-.7 2.4-6.6 2.6-7.3 .1-.3 .1-.6-.1-.8s-.4-.5-.6-.6c-12.3-7.6-40.7-8.5-40.7 12.7 0 12.5 11.5 15.4 17.9 17.2 4.7 1.6 13.2 3 13.2 8.7 0 4-3.5 7.1-9.2 7.1-6.9 0-13.5-2.2-19-6.3-.5-.2-1.4-.7-1.6 .7l-2.4 7.5c-.5 .9 .2 1.2 .2 1.4 1.8 1.4 10.3 6.6 22.8 6.6 13.2 0 21.4-7.1 21.4-18.1l0 0zm32-42.6c-10.1 0-18.7 3.2-21.4 5.2-.1 .1-.2 .2-.3 .3s-.1 .2-.1 .4 0 .3 0 .4 .1 .3 .2 .4l2.6 7.1c.1 .2 .2 .5 .5 .6s.5 .2 .7 .1c.6 0 6.8-4 16.9-4 4 0 7.1 .7 9.2 2.4 3.6 2.8 3.1 8.3 3.1 10.6-4.8-.3-19.1-3.4-29.4 3.8-2.3 1.6-4.3 3.8-5.5 6.3s-1.9 5.4-1.8 8.2c0 5.9 1.5 10.4 6.6 14.4 12.2 8.2 36.3 2 38.1 1.4 1.6-.3 3.5-.7 3.5-1.9l0-33.9c0-4.6 .3-21.6-22.8-21.6l0 .1zm46.6-21c0-.2 0-.3-.1-.5s-.1-.3-.3-.4-.2-.2-.4-.3-.3-.1-.5-.1l-9.8 0c-.2 0-.3 0-.5 .1s-.3 .1-.4 .3-.2 .2-.3 .4-.1 .3-.1 .5l0 79c0 .2 0 .3 .1 .5s.1 .3 .3 .4 .2 .2 .4 .3 .3 .1 .5 .1l9.9 0c.2 0 .3 0 .5-.1s.3-.1 .4-.3 .2-.2 .3-.4 .1-.3 .1-.5l-.1-79zm55.7 28.9c-2.1-2.3-6.8-7.5-17.6-7.5-3.5 0-14.2 .2-20.7 8.9-6.4 7.6-6.6 18.1-6.6 21.4 0 3.1 .2 14.3 7.1 21.2 2.6 2.9 9.1 8.2 22.8 8.2 10.8 0 16.5-2.3 18.6-3.8 .5-.2 .7-.7 .2-1.9l-2.3-6.8c-.1-.3-.3-.5-.6-.6s-.5-.2-.8-.1c-2.6 .9-6.3 2.8-15.3 2.8-17.4 0-16.8-14.7-16.9-16.7l37.2 0c.3 0 .5-.1 .7-.3s.4-.4 .4-.7c-.3 0 2.1-14.7-6.1-24.2l0 0zm36.7 52.7c13.2 0 21.4-7.1 21.4-18.1 0-11.8-11.7-15.2-17.9-17.2-4.1-1.7-13.4-3.4-13.4-8.9 0-3.8 3.3-6.4 8.5-6.4 5.8 .1 11.5 1.6 16.7 4.2 0 0 1.2 .7 1.6-.5 .2-.7 2.4-6.6 2.6-7.3 .1-.3 .1-.6-.1-.8s-.4-.5-.6-.6c-7.9-4.9-16.7-4.9-20.2-4.9-12 0-20.5 7.3-20.5 17.6 0 12.5 11.5 15.4 17.9 17.2 6.1 2 13.2 3.3 13.2 8.7 0 4-3.5 7.1-9.2 7.1-6.9 0-13.5-2.2-19-6.4-.1-.1-.3-.2-.5-.2s-.4 0-.5 .1-.3 .2-.4 .3-.2 .3-.2 .5l-2.3 7.5c-.5 .9 .2 1.2 .2 1.4 1.7 1.4 10.3 6.6 22.8 6.6l0 0zM357.6 224c0-.7-.2-1.2-1.2-1.2l-11.8 0c0-.1 .9-8.9 4.5-12.5 4.2-4.2 11.8-1.6 12-1.6 1.2 .5 1.4 0 1.6-.5l2.8-7.8c.7-.9 0-1.2-.2-1.4-5.1-2-17.4-2.9-24.5 4.2-5.5 5.5-7 13.9-8 19.5l-8.5 0c-.3 0-.6 .2-.8 .4s-.3 .5-.4 .8l-1.4 7.8c0 .7 .2 1.2 1.2 1.2l8.2 0c-8.5 47.9-8.7 50.2-10.3 55.5-1.1 3.6-3.3 6.9-5.9 7.8-.1 0-3.9 1.7-9.6-.2 0 0-.9-.5-1.4 .7-.2 .7-2.6 6.8-2.8 7.5s0 1.4 .5 1.4c5.1 2 13 1.8 17.9 0 6.3-2.3 9.7-7.9 11.5-12.9 2.8-7.7 2.8-9.8 11.8-59.7l12.2 0c.3 0 .6-.2 .8-.4s.3-.5 .4-.8l1.4-7.8zM411 240c-.6-1.7-5.1-18.1-25.2-18.1-15.2 0-23 10-25.2 18.1-1 3-3.2 14 0 23.5 .1 .3 4.4 18.1 25.2 18.1 15 0 22.9-9.6 25.2-18.1 3.2-9.6 1-20.5 0-23.5zm45.4-16.7c-5-1.7-16.6-1.9-22.1 5.4l0-4.5c0-.2 0-.3-.1-.5s-.1-.3-.3-.4-.2-.2-.4-.3-.3-.1-.5-.1l-9.4 0c-.2 0-.3 0-.5 .1s-.3 .1-.4 .3-.2 .2-.3 .4-.1 .3-.1 .5l0 55.3c0 .2 0 .3 .1 .5s.1 .3 .3 .4 .2 .2 .4 .3 .3 .1 .5 .1l9.6 0c.2 0 .3 0 .5-.1s.3-.1 .4-.3 .2-.2 .3-.4 .1-.3 .1-.5l0-27.8c0-2.9 .1-11.4 4.5-15.1 4.9-4.9 12-3.4 13.4-3.1 .3 0 .6-.1 .8-.3s.4-.4 .6-.7c1.2-2.6 2.2-5.3 3.1-8 .1-.3 .1-.5 0-.8s-.3-.5-.5-.6l0 0zm46.8 54.1l-2.1-7.3c-.5-1.2-1.4-.7-1.4-.7-4.2 1.8-10.1 1.9-11.3 1.9-4.6 0-17.2-1.1-17.2-19.8 0-6.2 1.8-19.8 16.5-19.8 3.9-.1 7.8 .5 11.5 1.6 0 0 .9 .5 1.2-.7 .9-2.6 1.6-4.5 2.6-7.5 .2-.9-.5-1.2-.7-1.2-11.6-3.9-22.3-2.5-27.8 0-1.6 .7-16.2 6.5-16.2 27.5 0 2.9-.6 30.1 28.9 30.1 5.3 0 10.6-1 15.5-2.8 .2-.2 .4-.4 .5-.6s.1-.5 0-.8l0 0zm53.9-39.5c-.8-3-5.4-16.2-22.3-16.2-16 0-23.5 10.1-25.6 18.6-1.2 3.8-1.7 7.8-1.7 11.8 0 25.9 18.8 29.4 29.9 29.4 10.8 0 16.5-2.3 18.6-3.8 .5-.2 .7-.7 .2-1.9l-2.4-6.8c-.1-.3-.3-.5-.6-.6s-.6-.2-.8-.1c-2.6 .9-6.3 2.8-15.3 2.8-17.4 0-16.9-14.7-16.9-16.7l37.2 0c.3 0 .5-.1 .7-.3s.4-.4 .4-.7c-.2 0 .9-7.1-1.4-15.5l0 0zm-23.3-6.4c-10.3 0-13 9-13.6 14.1l26.4 0c-.9-11.9-7.6-14.1-12.7-14.1l0 0z"/></svg>
                        <span><?php esc_html_e( 'Salesforce Integration', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                    <div class="uacf7-integration-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M94.1 315.1c0 25.9-21.2 47.1-47.1 47.1S0 341 0 315.1 21.2 268 47.1 268l47.1 0 0 47.1zm23.7 0c0-25.9 21.2-47.1 47.1-47.1S212 289.2 212 315.1l0 117.8c0 25.9-21.2 47.1-47.1 47.1s-47.1-21.2-47.1-47.1l0-117.8zm47.1-189c-25.9 0-47.1-21.2-47.1-47.1S139 32 164.9 32 212 53.2 212 79.1l0 47.1-47.1 0zm0 23.7c25.9 0 47.1 21.2 47.1 47.1S190.8 244 164.9 244L47.1 244C21.2 244 0 222.8 0 196.9s21.2-47.1 47.1-47.1l117.8 0zm189 47.1c0-25.9 21.2-47.1 47.1-47.1S448 171 448 196.9 426.8 244 400.9 244l-47.1 0 0-47.1zm-23.7 0c0 25.9-21.2 47.1-47.1 47.1S236 222.8 236 196.9l0-117.8C236 53.2 257.2 32 283.1 32s47.1 21.2 47.1 47.1l0 117.8zm-47.1 189c25.9 0 47.1 21.2 47.1 47.1S309 480 283.1 480 236 458.8 236 432.9l0-47.1 47.1 0zm0-23.7c-25.9 0-47.1-21.2-47.1-47.1S257.2 268 283.1 268l117.8 0c25.9 0 47.1 21.2 47.1 47.1s-21.2 47.1-47.1 47.1l-117.8 0z"/></svg>
                        <span><?php esc_html_e( 'Slack Integration', 'ultimate-addons-cf7' ); ?></span>
                    </div>

                </div>
            </div>

            <!-- Button for more integrations -->
            <div class="uacf7-actions">
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=uacf7_addons' ) ); ?>" class="button">
                    <?php esc_html_e( 'Check More Integrations', 'ultimate-addons-cf7' ); ?>
                </a>
            </div>
            
            <?php if(!class_exists('Ultimate_Addons_CF7_PRO')){  ?>
            <!-- Upsell -->
            <div class="uacf7-upsell">
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
			<div class="uacf7-section-title"><?php esc_html_e( 'Latest posts from Ultra Addons for Contact Form 7', 'ultimate-addons-cf7' ); ?></div>
			<ul class="uacf7-blog-list">
				<li>
					<span class="uacf7-badge"><?php esc_html_e( 'NEW', 'ultimate-addons-cf7' ); ?></span>
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
            <div class="uacf7-footer">
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