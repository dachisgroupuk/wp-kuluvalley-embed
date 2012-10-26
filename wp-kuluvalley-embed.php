<?php
/**
 * Plugin Name: WP Kulu Valley Embed
 * Description: This allows for the embedding of Kulu Valley videos from their URLs
 * Version: 1.0
 * Author: Dachis Group
 * Author URI: http://dachisgroup.com
 *
 */
 if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) || !function_exists( 'add_action' ) ) {
	if ( !function_exists( 'add_action' ) ) {
		$exit_msg = 'I\'m just a plugin, please don\'t call me directly';
	} else {
		// Subscribe2 needs WordPress 3.1 or above, exit if not on a compatible version
		$exit_msg = sprintf( __( 'This version of WP Kulu Valley Embed required WordPress 3.1 or greater.' ) );
	}
	exit( $exit_msg );
}

// our version number. Don't touch this or any line below
// unless you know exactly what you are doing
define( 'WPKVEPATH', trailingslashit( dirname( __FILE__ ) ) );
define( 'WPKVEDIR', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );
define( 'WPKVEURL', plugin_dir_url( dirname( __FILE__ ) ) . WPKVEDIR );


// Set maximum execution time to 5 minutes - won't affect safe mode
$safe_mode = array( 'On', 'ON', 'on', 1 );
if ( !in_array( ini_get( 'safe_mode' ), $safe_mode ) && ini_get( 'max_execution_time' ) < 300 ) {
	@ini_set( 'max_execution_time', 300 );
}

global $wpKuluValleyEmbed;

require_once( WPKVEPATH . 'classes/wpkve-core.php' );
require_once( WPKVEPATH . 'classes/wpkve-frontend.php' );
require_once( WPKVEPATH . 'classes/wpkve-admin.php' );

if ( is_admin() ){
    $wpKuluValleyEmbed = new WpKuluValleyEmbedAdmin();
} else {
    $wpKuluValleyEmbed = new WpKuluValleyEmbedFrontend();
}

$wpKuluValleyEmbed->init();
