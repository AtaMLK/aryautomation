<?php
if( !function_exists( 'industrie_customizer_register' ) ){
	function industrie_customizer_register( $industrie_customizer ){
	/*-----------------------------
	Theme Options
	-----------------------------*/
	$industrie_customizer->add_panel( 
		'industrie_options_panel',
		array(
			'title'      => esc_html__( 'Industrie Options', 'industrie' ),
			'description'=> esc_html__( 'General options of industrie', 'industrie'),
			'priority'=> 20,
		)
	);

	/**
	 * General setting panel
	 * 
	 * @since 1.0.0
	 */
	
	industrie_general_panel( $industrie_customizer, 0 );
	//End General Setting


	 /**
	 * Start Mobile Menu Logo Style setting
	 * @since 1.0.0
	 */
	industrie_mobile_sidebar_panel( $industrie_customizer, 81 );
	//End Mobile Menu Logo Style setting

	 /**
	 * Start Preloader Style setting
	 * @since 1.0.0
	 */
	industrie_preloader_panel( $industrie_customizer, 82 );
	//End Preloader Style setting

	/**
	 * Start GSAP Animation setting
	 * @since 1.0.0
	 */
	industrie_gsap_animation_panel( $industrie_customizer, 83 );
	//End GSAP Animation setting

	 /**
	 * Start Style setting
	 * @since 1.0.0
	 */
	industrie_style_panel( $industrie_customizer, 61 );
	

	/**
	 * Start Typography setting
	 * @since 1.0.0
	 */
	industrie_typography_panel( $industrie_customizer, 81 );
	//End Typography setting

	 /**
	 * Start Blog setting
	 * @since 1.0.0
	 */

	$industrie_blog_panel = new PE_WP_Customize_Panel( $industrie_customizer, 'industrie_blog_setting', array(
		'title' => esc_html__( 'Blog Settings', 'industrie' ),
		'panel' => 'industrie_options_panel',
		'priority' => 100,
		)
	);
	$industrie_customizer->add_panel( $industrie_blog_panel );

	industrie_blog_page_style_panel( $industrie_customizer, 101 );
	industrie_blog_single_style_panel( $industrie_customizer, 102 );
	
	//End Blog setting
	 
	/**
	 * Start Team setting
	 * @since 1.0.0
	 */
	industrie_team_panel( $industrie_customizer, 121 );
	//End Team setting
 
	/**
	 * Start woocommerce settings
	 * @since 1.0.0
	 */
	industrie_woocommerce_panel( $industrie_customizer, 210 );
	//End woocommerce settings

	industrie_custom_fonts_panel( $industrie_customizer, 200 );
	

	/**
	 * Start 404 Page Setting
	 * @since 1.0.0
	 */
	industrie_404_panel( $industrie_customizer, 241 );
	//End 404 Page Setting
		
 	}
}
add_action( 'customize_register', 'industrie_customizer_register' );