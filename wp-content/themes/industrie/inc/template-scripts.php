<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

function industrie_scripts() {
	//register styles
	wp_enqueue_style( 'boostrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'remixicon', get_template_directory_uri() .'/assets/fonts/remixicon.css');	
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() .'/assets/css/owl.carousel.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri() .'/assets/css/slick.css' );	
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/css/magnific-popup.css');	
	wp_enqueue_style( 'swiper-min', get_template_directory_uri() .'/assets/css/swiper.min.css');
	wp_enqueue_style( 'odometer-css', get_template_directory_uri() .'/assets/css/odometer.min.css');
	wp_enqueue_style( 'industrie-style-default', get_template_directory_uri() .'/assets/css/default.css' );
	wp_enqueue_style( 'industrie-style-rsanimations', get_template_directory_uri() .'/assets/css/rsanimations.css' );	
	wp_enqueue_style( 'industrie-style-responsive', get_template_directory_uri() .'/assets/css/responsive.css' );
	wp_enqueue_style( 'industrie-style', get_stylesheet_uri() );	
	
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '2.8.3', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.0.2', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.2.1', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.8.1', true );
	wp_enqueue_script('classie', get_template_directory_uri() . '/assets/js/classie.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array('jquery'), '8.1.4', true);
	wp_enqueue_script('chart-umd-min', get_template_directory_uri() . '/assets/js/chart.umd.min.js', array('jquery'), '8.1.4', true);
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '2.0.3', true );
	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array('jquery'), '2.0.5', true );
	wp_enqueue_script( 'lettering', get_template_directory_uri() . '/assets/js/jquery.lettering.js', array('jquery'), '2.0.3', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js', array('jquery', 'imagesloaded'), '3.0.4', true );		
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true );	
	wp_enqueue_script( 'odometer-js', get_template_directory_uri() . '/assets/js/odometer.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'appear-min', get_template_directory_uri() . '/assets/js/jquery.appear.min.js', array('jquery'), '1.0.0', true );
	
	if(!empty(get_theme_mod('gsap_animation_enable_disable'))){
		wp_enqueue_script( 'gsap', get_template_directory_uri() . '/assets/js/interactions/gsap.min.js', array('jquery'), '1.1.0', true );	
		wp_enqueue_script( 'splittext', get_template_directory_uri() . '/assets/js/interactions/rs-splitText.min.js', array('jquery'), '1.1.0', true );
		wp_enqueue_script( 'scroll-trigger', get_template_directory_uri() . '/assets/js/interactions/rs-scroll-trigger.min.js', array('jquery'), '1.1.0', true );
		wp_enqueue_script( 'gsap-int', get_template_directory_uri() . '/assets/js/interactions/rs-anim-int.js', array('jquery'), '1.1.0', true );	
	}
	if( is_404() ){
		wp_enqueue_script( 'industrie-404', get_template_directory_uri() . '/assets/js/404.js', array('jquery'), wp_get_theme()->get( 'Version' ), false );	
	}
	
	wp_enqueue_script('industrie-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get( 'Version' ), true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'industrie_scripts' );

add_action( 'wp_enqueue_scripts', 'industrie_rtl_scripts', 1500 );
if ( !function_exists( 'industrie_rtl_scripts' ) ) {
	function industrie_rtl_scripts() {	
		// RTL
		if ( is_rtl() ) {
			wp_enqueue_style( 'industrie-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), 1.0 );
		}		
		
	}
}


add_action( 'admin_enqueue_scripts', 'industrie_load_admin_styles' );
function industrie_load_admin_styles($screen) {
	wp_enqueue_style( 'industrie-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', true, '1.0.0' );
	wp_enqueue_script( 'industrie-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '20151215', true );
} 