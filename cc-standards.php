<?php
/**
 * Plugin Name: Cypress Creative Standards
 * Plugin URI: https://cypr.es
 * Description: WordPress Website standard settings for Cypress Creative customers
 * Version: 1.004
 * Text Domain: cc-standards
 * Author: Cypress Creative
 * Author URI: https://cypr.es
 */

/**
*Plugin update settings
**/
if( ! class_exists( 'cc_standards_Updater' ) ){
	include_once(  'updater.php' );
}

$updater = new cc_standards_Updater( __FILE__ );
$updater->set_username( 'chrisku');
$updater->set_repository( 'cc-standards' );
$updater->authorize( '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' ); // Your auth code goes here for private repos

$updater->initialize();

/**
 * Auto-Update Settings
 */

// Enable/Disable the following as needed 
// add_filter( 'auto_update_theme', '__return_true' );
// add_filter( 'auto_update_plugin', '__return_true' );
// add_filter( 'auto_update_translation', '__return_true' );

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

// WP Core - make sure to add this to wp-config.php 
// define( 'WP_AUTO_UPDATE_CORE', true );
// use this to only allow minor updates define( 'WP_AUTO_UPDATE_CORE', 'minor' );

add_filter( 'allow_dev_auto_core_updates', '__return_false' ); // disables nightly builds
add_filter( 'allow_minor_auto_core_updates', '__return_true' );
add_filter( 'allow_major_auto_core_updates', '__return_true' );

/**
 * Remove Dashboard Notifications
 */
 
// remove plugin notifications for non admins
 
// disable periodic admin email verification prompt
add_filter( 'admin_email_check_interval', '__return_false' );
