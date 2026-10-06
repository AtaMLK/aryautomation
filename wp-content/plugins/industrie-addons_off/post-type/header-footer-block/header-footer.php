<?php
class Rsaddon_Header_Footer_Pro_Post_Type{
	public function __construct() {
		add_action( 'init', array( $this, 'rsaddon_header_footer_register_post_type' ) );	
	}

	function rsaddon_header_footer_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'RS Header', 'rsaddon'),
			'singular_name'      => esc_html__( 'Header ', 'rsaddon'),
			'add_new'            => esc_html__( 'Add New Header', 'rsaddon'),
			'add_new_item'       => esc_html__( 'Add New Header', 'rsaddon'),
			'edit_item'          => esc_html__( 'Edit Header', 'rsaddon'),
			'new_item'           => esc_html__( 'New Header', 'rsaddon'),
			'all_items'          => esc_html__( 'All Headers', 'rsaddon'),
			'view_item'          => esc_html__( 'View Header', 'rsaddon'),
			'search_items'       => esc_html__( 'Search Headers', 'rsaddon'),
			'not_found'          => esc_html__( 'No Headers found', 'rsaddon'),
			'not_found_in_trash' => esc_html__( 'No Headers found in Trash', 'rsaddon'),
			'parent_item_colon'  => esc_html__( 'Parent Header:', 'rsaddon'),
			'featured_image'     => esc_html__('Author Image'),
			'set_featured_image' => esc_html__('Upload Author Image'),
			'menu_name'          => esc_html__( 'Header Footer Block', 'rsaddon'),
		);	
		
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail', 'editor' )
		);
		register_post_type( 'rs-headers', $args );
	}	

}
new Rsaddon_Header_Footer_Pro_Post_Type();


//create custom post type for shortcode
function footer_blocks_post_type() {

	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'RS Footer', 'Post Type General Name', 'rsaddon' ),
			'singular_name'       => _x( 'Footer Blocks', 'Post Type Singular Name', 'rsaddon' ),
			'menu_name'           => __( 'Footers', 'rsaddon' ),	
			'add_new'             => __( 'Add New Footer', 'rsaddon' ),		
			
			'add_new_item'        => __( 'Create New Footers', 'rsaddon' ),
			'all_items'           => __( 'All Footers', 'rsaddon' ),
			'view_item'           => __( 'View Footer', 'rs-team-settingse' ),
			
			'edit_item'           => __( 'Edit Footer', 'rsaddon' ),
			'update_item'         => __( 'Update Footer', 'rsaddon' ),
			'search_items'        => __( 'Search Footer', 'rsaddon' ),
			'not_found'           => __( 'Not Found', 'rsaddon' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'rsaddon' ),
		);

	// Set other options for Custom Post Type
		$args = array(
			'label'               => __( 'Foorers', 'rsaddon' ),
			'description'         => __( 'Footers', 'rsaddon' ),
			'labels'              => $labels,
			'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu' 		  => 'edit.php?post_type=rs-headers',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		// Registering your Custom Post Type
		register_post_type( 'rs-footers', $args );

	}

	add_action( 'init', 'footer_blocks_post_type');	