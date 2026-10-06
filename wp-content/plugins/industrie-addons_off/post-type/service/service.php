<?php
/**
 * Service custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package rs
 * @author RS Theme
 * @link http://www.rstheme.com
 */
// Register Service Post Type
function rs_service_pro_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Services', 'rsaddon'),
		'singular_name'      => esc_html__( 'Service', 'rsaddon'),
		'add_new'            => esc_html_x( 'Add New Service', 'rsaddon'),
		'add_new_item'       => esc_html__( 'Add New Service', 'rsaddon'),
		'edit_item'          => esc_html__( 'Edit Service', 'rsaddon'),
		'new_item'           => esc_html__( 'New Service', 'rsaddon'),
		'all_items'          => esc_html__( 'All Service', 'rsaddon'),
		'view_item'          => esc_html__( 'View Service', 'rsaddon'),
		'search_items'       => esc_html__( 'Search Services', 'rsaddon'),
		'not_found'          => esc_html__( 'No Services found', 'rsaddon'),
		'not_found_in_trash' => esc_html__( 'No Services found in Trash', 'rsaddon'),
		'parent_item_colon'  => esc_html__( 'Parent Service:', 'rsaddon'),
		'menu_name'          => esc_html__( 'Services', 'rsaddon'),
	);	
	
	$industrie_service_slug = !empty(get_theme_mod('industrie_service_slug')) ? get_theme_mod('industrie_service_slug') : 'Services' ;
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'rewrite' => 		 array('slug' => $industrie_service_slug,'with_front' => false),	
		'menu_position'      => 20,		
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	);
	register_post_type( 'services', $args );
}
add_action( 'init', 'rs_service_pro_register_post_type' );

function rsaddon_pro_tr_create_service() {
	
	register_taxonomy(
		'service-category',
		'services',
		array(
			'label' => esc_html__( 'Service Categories','rsaddon'),			
			'hierarchical' => true,
			'show_admin_column' => true,		
		)
	);
}

add_action( 'init', 'rsaddon_pro_tr_create_service' );