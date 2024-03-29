<?php
/**
 * Plugin Name: Cypress Creative Standards
 * Plugin URI: https://cypr.es
 * Description: WordPress Website standard settings for Cypress Creative customers
 * Version: 1.1
 * Text Domain: cc-standards
 * Author: Cypress Creative
 * Author URI: https://cypr.es
 */

require_once('inc/updater.php');

/**
 * Auto-Update Settings
 */

// Disable auto-update email notifications for plugins.
add_filter( 'auto_plugin_update_send_email', '__return_false' );

// Disable auto-update email notifications for themes.
add_filter('auto_theme_update_send_email', '__return_false');

// Disable auto core update notifications
add_filter( 'auto_core_update_send_email', 'cypr_stop_auto_update_emails', 10, 4 );
  
function cypr_stop_auto_update_emails( $send, $type, $core_update, $result ) {
	if ( ! empty( $type ) && $type == 'success' ) {
		return false;
	}
	return true;
}

// Set time for Automatic Updates
$current_time = current_datetime()->format( 'Hi' );
$time_range = ( $current_time > 2200 || $current_time < 0600 );
define( 'AUTOMATIC_UPDATER_DISABLED', $time_range );

// Core Updates
add_filter( 'allow_dev_auto_core_updates', '__return_false' ); // disables nightly builds
add_filter( 'allow_minor_auto_core_updates', '__return_true' );
add_filter( 'allow_major_auto_core_updates', '__return_true' );

/**
 * Remove Dashboard Notifications
 */

// disable periodic admin email verification prompt
add_filter( 'admin_email_check_interval', '__return_false' );
