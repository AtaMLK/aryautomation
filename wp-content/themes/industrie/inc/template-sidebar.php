<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

function industrie_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'industrie' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'This is sidebar area for blog post and single post.', 'industrie' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Offcanvas Sidebar', 'industrie' ),
		'id'            => 'rs-offcanvas-sidebar',
		'description'   => esc_html__( 'This is sidebar area for offcanvas.', 'industrie' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Services Sidebar', 'industrie' ),
		'id'            => 'rs-services-sidebar',
		'description'   => esc_html__( 'This is sidebar area for services.', 'industrie' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Projects Sidebar', 'industrie' ),
		'id'            => 'rs-projects-sidebars',
		'description'   => esc_html__( 'This is sidebar area for projects.', 'industrie' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Shop', 'industrie' ),
			'id'            => 'sidebar_shop',
			'description'   => esc_html__( 'Sidebar Shop', 'industrie' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}		
}
add_action( 'widgets_init', 'industrie_widgets_init' );