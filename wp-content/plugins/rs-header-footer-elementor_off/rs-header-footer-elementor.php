<?php
/**
 * Plugin Name: RS Elementor Header & Footer Builder
 * Plugin URI:  https://rstheme.com
 * Description: RS header footer builder
 * Author:      RS Theme
 * Author URI:  https://www.rstheme.com/
 * Text Domain: rs-header-footer-elementor
 * Domain Path: /languages
 * Version: 1.0.4
 */

define( 'RSHFE_VER', '1.0.4' );
define( 'RSHFE_FILE', __FILE__ );
define( 'RSHFE_DIR', plugin_dir_path( __FILE__ ) );
define( 'RSHFE_URL', plugins_url( '/', __FILE__ ) );
define( 'RSHFE_PATH', plugin_basename( __FILE__ ) );
define( 'RSHFE_DOMAIN', trailingslashit( 'https://rstheme.com' ) );
define( 'RSHFE_DIR_URL_ADMIN', plugin_dir_url( __FILE__ ) );
define( 'RSHFE_ASSETS_ADMIN', trailingslashit( RSHFE_DIR_URL_ADMIN ) );

/**
 * Load the class loader.
 */
require_once RSHFE_DIR . '/inc/class-header-footer-elementor.php';


add_action( 'init', 'rshfe_load_textdomain' );
  
/**
 * Load plugin textdomain.
 */
function rshfe_load_textdomain() {
  load_plugin_textdomain( 'rsaddon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

/**
 * Load the Plugin Class.
 */
function rshfe_plugin_activation() {

	$footer_widget = hfe_footer_widget_func();
	update_option( 'hfe_plugin_is_activated', 'yes' );
	update_option( 'rshfe_addon_option', $footer_widget );
}
register_activation_hook( RSHFE_FILE, 'rshfe_plugin_activation' );

/**
 * Load the Plugin Class.
 */
function rshfe_init() {
	RSHeader_Footer_Elementor::instance();
}
add_action( 'plugins_loaded', 'rshfe_init' );

function hfe_footer_widget_func() {
	$array = [
		'rshfe_copyright' => 'rshfe_copyright',
		'rshfe_header_button' => 'rshfe_header_button',
		'rshfe_navigation_menu' => 'rshfe_navigation_menu' ,
		'rshfe_site_logo' => 'rshfe_site_logo',
		'rshfe_page_title' => 'rshfe_page_title',
		'rshfe_search' => 'rshfe_search',
		'rshfe_meta' => 'rshfe_meta'
	];

	return $array;
}
