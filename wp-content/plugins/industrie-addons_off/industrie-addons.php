<?php
/**
 * Plugin Name: Industrie Addons
 * Description: <a href="http://rstheme.com/products/wordpress/plugins/elementor">Prelements Elementor Addon</a> is the most advanced frontend drag & drop page builder addon. Create high-end, pixel perfect websites at record speeds. Any theme, any page, any design.
 * Plugin URI:  https://rstheme.com/
 * Version:     1.0.9
 * Author:      rs-theme
 * Author URI:  https://rstheme.com/
 * Text Domain: rsaddon
 */

if (!defined('ABSPATH')) {
    exit;
}
define( 'RSADDON_FILE', __FILE__ );
define( 'RSADDON_DIR_PATH_PRO', plugin_dir_path( __FILE__ ) );
define( 'RSADDON_DIR_URL_PRO', plugin_dir_url( __FILE__ ) );
define( 'RSADDON_ASSETS_PRO', trailingslashit( RSADDON_DIR_URL_PRO . 'assets' ) );
define('RSELEMENT_VERSION','1.0.8');
define( 'RSADDON_PLUGIN_FILE', __FILE__ );
require RSADDON_DIR_PATH_PRO . 'base.php';
require RSADDON_DIR_PATH_PRO . 'post-type/post-type.php';
require RSADDON_DIR_PATH_PRO . 'inc/widgets/post_recent_widget.php';
require RSADDON_DIR_PATH_PRO . 'inc/widgets/social-icon.php';
require RSADDON_DIR_PATH_PRO . 'inc/widgets/rs_contact.php';
require RSADDON_DIR_PATH_PRO . 'inc/widgets/rs_cta.php';
require_once RSADDON_DIR_PATH_PRO .'/cmb2/init.php';
require_once RSADDON_DIR_PATH_PRO .'/cmb2/rs-functions.php';
add_image_size( 'rsaddon-team-round-style', 500, 500, true );

/**
 * Include files for plugin admin section
 */
require RSADDON_DIR_PATH_PRO . 'admin/admin-init.php';

// Allow additional font file types
if(!function_exists('allow_induste_custom_font_upload')){
    function allow_induste_custom_font_upload($mimes) {
    $mimes['woff'] = 'font/woff';
    $mimes['woff2'] = 'font/woff2';
    $mimes['ttf'] = 'font/ttf';
    $mimes['otf'] = 'font/otf';
    $mimes['eot'] = 'font/eot';
    return $mimes;
    }

    add_filter('upload_mimes', 'allow_induste_custom_font_upload');

}

if(!function_exists('induste_font__filetypes')){
    function induste_font__filetypes( $data, $file, $filename, $mimes, $real_mime ) {
        if ( ! empty( $data['ext'] ) && ! empty( $data['type'] ) ) {
            return $data;
        }
        $wp_file_type = wp_check_filetype( $filename, $mimes );
        if ( 'ttf' === $wp_file_type['ext'] ) {
            $data['ext'] = 'ttf';
            $data['type'] = 'font/ttf';
        }
        if ( 'otf' === $wp_file_type['ext'] ) {
            $data['ext'] = 'otf';
            $data['type'] = 'font/otf';
        }
        if ( 'woff' === $wp_file_type['ext'] ) {
            $data['ext'] = 'woff';
            $data['type'] = 'font/woff';
        }
        if ( 'woff2' === $wp_file_type['ext'] ) {
            $data['ext'] = 'woff2';
            $data['type'] = 'font/woff2';
        }
        if ( 'eot' === $wp_file_type['ext'] ) {
            $data['ext'] = 'eot';
            $data['type'] = 'font/eot';
        }
        return $data;
    }
    add_filter( 'wp_check_filetype_and_ext', 'induste_font__filetypes', 10, 5 );
}


