<?php
/**
 * Widgets loader for Header Footer Elementor.
 */

namespace RSHFE\WidgetsManager;

use Elementor\Plugin;
use Elementor\Utils;

defined( 'ABSPATH' ) or exit;

/**
 * Set up Widgets Loader class
 */
class Widgets_Loader {

	/**
	 * Instance of Widgets_Loader.
	 *
	 * @since  1.2.0
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Get instance of Widgets_Loader
	 *
	 * @since  1.2.0
	 * @return Widgets_Loader
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Setup actions and filters.
	 *
	 * @since  1.2.0
	 */
	private function __construct() {
		// Register category.
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );

		// Register widgets.
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Add svg support.
		add_filter( 'upload_mimes', [ $this, 'hfe_svg_mime_types' ] );

		// Refresh the cart fragments.
		if ( class_exists( 'woocommerce' ) ) {

			add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'wc_refresh_mini_cart_count' ] );
		}
	}

	/**
	 * Returns Script array.
	 *
	 * @return array()
	 * @since 1.3.0
	 */
	public static function get_widget_script() {
		$js_files = [
			'hfe-frontend-js' => [
				'path'      => 'inc/js/frontend.js',
				'dep'       => [ 'jquery' ],
				'in_footer' => true,
			],
		];

		return $js_files;
	}

	/**
	 * Returns Script array.
	 *
	 * @return array()
	 * @since 1.3.0
	 */
	public static function get_widget_list() {
		$widget_list = [
			'copyright',
			'navigation-menu',
			'menu-walker',
			'site-title',
			'page-title',
			'site-logo',
			'search-button',
			'header-button',
			'meta',
			'cart',
		];

		return $widget_list;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function include_widgets_files() {
		$js_files    = $this->get_widget_script();
		$widget_list = $this->get_widget_list();

		if ( ! empty( $widget_list ) ) {
			foreach ( $widget_list as $handle => $data ) {
				require_once RSHFE_DIR . '/inc/widgets-manager/widgets/class-' . $data . '.php';
			}
		}

		if ( ! empty( $js_files ) ) {
			foreach ( $js_files as $handle => $data ) {
				wp_register_script( $handle, RSHFE_URL . $data['path'], $data['dep'], RSHFE_VER, $data['in_footer'] );
			}
		}

		$tag_validation = [ 'article', 'aside', 'div', 'footer', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'header', 'main', 'nav', 'p', 'section', 'span' ];

		wp_localize_script(
			'elementor-editor',
			'HfeWidgetsData',
			[
				'allowed_tags' => $tag_validation,
			]
		);

		// Emqueue the widgets style.
		wp_enqueue_style( 'hfe-widgets-style', RSHFE_URL . 'inc/widgets-css/frontend.css', [], RSHFE_VER );
	}

	/**
	 * Provide the SVG support for Retina Logo widget.
	 *
	 * @param array $mimes which return mime type.
	 *
	 * @since  1.2.0
	 * @return $mimes.
	 */
	public function hfe_svg_mime_types( $mimes ) {
		// New allowed mime types.
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Register Category
	 *
	 * @since 1.2.0
	 * @param object $this_cat class.
	 */
	public function register_widget_category( $this_cat ) {
		$category = __( 'RS Header & Footer', 'rs-header-footer-elementor' );

		$this_cat->add_category(
			'hfe-widgets',
			[
				'title' => $category,
				'icon'  => 'eicon-font',
			]
		);

		return $this_cat;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files.
		$this->include_widgets_files();
		// Register Widgets.
		$rshfe_addon_setting = get_option( 'rshfe_addon_option' );
		if( isset( $rshfe_addon_setting['rshfe_copyright'] ) == 'rshfe_copyright' ) {
			Plugin::instance()->widgets_manager->register( new Widgets\Copyright() );
		}
		// if( isset( $rshfe_addon_setting['rshfe_header_button'] ) == 'rshfe_header_button' ) {
		// 	Plugin::instance()->widgets_manager->register( new Widgets\Header_Button() );
		// }
		if( isset( $rshfe_addon_setting['rshfe_navigation_menu'] ) == 'rshfe_navigation_menu' ) {
			Plugin::instance()->widgets_manager->register( new Widgets\Navigation_Menu() );
		}
		if( isset( $rshfe_addon_setting['rshfe_site_logo'] ) == 'rshfe_site_logo' ) {
			Plugin::instance()->widgets_manager->register( new Widgets\Site_Logo() );
		}
		if( isset( $rshfe_addon_setting['rshfe_page_title'] ) == 'rshfe_page_title' ) {
			Plugin::instance()->widgets_manager->register( new Widgets\Page_Title() );
		}
		if( isset( $rshfe_addon_setting['rshfe_search'] ) == 'rshfe_search' ) {
			Plugin::instance()->widgets_manager->register( new Widgets\Search_Button() );
		}
		if( isset( $rshfe_addon_setting['rshfe_meta'] ) == 'rshfe_meta' ) {
			Plugin::instance()->widgets_manager->register( new Widgets\rs_meta() );
		}
		if( isset( $rshfe_addon_setting['rshfe_cart'] ) == 'rshfe_cart' ) {
			Plugin::instance()->widgets_manager->register( new Widgets\Cart() );
		}

	}

	/**
	 * Cart Fragments.
	 *
	 * Refresh the cart fragments.
	 *
	 * @since 1.5.0
	 * @param array $fragments Array of fragments.
	 * @access public
	 */
	public function wc_refresh_mini_cart_count( $fragments ) {

		$has_cart = is_a( WC()->cart, 'WC_Cart' );

		if ( ! $has_cart ) {
			return $fragments;
		}

		$cart_badge_count = ( null !== WC()->cart ) ? WC()->cart->get_cart_contents_count() : '';

		if ( null !== WC()->cart ) {

			$fragments['span.hfe-cart-count'] = '<span class="hfe-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';

			$fragments['span.elementor-button-text.hfe-subtotal'] = '<span class="elementor-button-text hfe-subtotal">' . WC()->cart->get_cart_subtotal() . '</span>';
		}

		$fragments['span.elementor-button-icon[data-counter]'] = '<span class="elementor-button-icon" data-counter="' . $cart_badge_count . '"><i class="eicon" aria-hidden="true"></i><span class="elementor-screen-only">' . __( 'Cart', 'rs-header-footer-elementor' ) . '</span></span>';

		return $fragments;
	}

	/**
	 * Validate an HTML tag against a safe allowed list.
	 *
	 * @since 1.5.8
	 * @param string $tag specifies the HTML Tag.
	 * @access public
	 */
	public static function validate_html_tag( $tag ) {

		// Check if Elementor method exists, else we will run custom validation code.
		if ( method_exists( 'Elementor\Utils', 'validate_html_tag' ) ) {
			return Utils::validate_html_tag( $tag );
		} else {
			$allowed_tags = [ 'article', 'aside', 'div', 'footer', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'header', 'main', 'nav', 'p', 'section', 'span' ];
			return in_array( strtolower( $tag ), $allowed_tags ) ? $tag : 'div';
		}
	}
}

/**
 * Initiate the class.
 */
Widgets_Loader::instance();
