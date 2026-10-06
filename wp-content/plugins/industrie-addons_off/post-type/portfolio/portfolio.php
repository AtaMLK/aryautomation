<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @author RS Theme
 * @link http://www.rstheme.com
 */
?>
<?php
class Rsaddon_Elementor_pro_Portfolio{	

	public function __construct() {
		add_action( 'init', array( $this, 'rs_portfolio_register_post_type' ) );
		add_action( 'init', array( $this, 'tr_create_portfolio' ) );
		add_action( 'admin_menu', array( $this, 'rsaddon_portfolio_meta_box' ) );		
		add_action( 'save_post', array( $this, 'rsaddon_save_portfolios_meta' ) );
	}


	// Register Portfolio Post Type
	function rs_portfolio_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Portfolio', 'rsaddons'),
			'singular_name'      => esc_html__( 'Portfolio', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Portfolio', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Portfolio', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Portfolio', 'rsaddons'),
			'new_item'           => esc_html__( 'New Portfolio', 'rsaddons'),
			'all_items'          => esc_html__( 'All Portfolio', 'rsaddons'),
			'view_item'          => esc_html__( 'View Portfolio', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Portfolio', 'rsaddons'),
			'not_found'          => esc_html__( 'No Portfolio found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'rsaddons'),
			'menu_name'          => esc_html__( 'Portfolio', 'rsaddons'),
		);
		
		$industrie_portfolio_slug = !empty(get_theme_mod('industrie_portfolio_slug')) ? get_theme_mod('industrie_portfolio_slug') : 'portfolios' ;
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'rewrite' => 		 array('slug' => $industrie_portfolio_slug,'with_front' => false),
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail','editor', 'excerpt' ),	
		);
		register_post_type( 'portfolios', $args );
	}

	function tr_create_portfolio() {
		
		register_taxonomy(
			'portfolio-category',
			'portfolios',
			array(
				'label' => esc_html__( 'Portfolio Categories','rsaddons'),			
				'hierarchical' => true,
				'show_admin_column' => true,
			)
		);
	}

	//registering metabox

	function rsaddon_portfolio_meta_box() {
		add_meta_box(
			'testimonial_info_meta',
			esc_html__( 'Column Option', 'rsaddon' ),
			array( $this, 'rsaddon_portfolios_meta_callback' ),
			array( 'portfolios', 'advanced', 'high', 1 )
		);		
	}

	// testimonial info callback
	function rsaddon_portfolios_meta_callback( $portfolio_info ) {


		//wp_nonce_field( 'portfolio_metabox', 'portfolio_metabox_nonce' ); ?>

	    <div class="rs-admin-input">
	    <label for="portfolios"><?php esc_html_e( 'Select Column', 'cl-portfolios') ?></label>
        <?php 
	      	$column_cl = get_post_meta( $portfolio_info->ID, 'portfolios_column', true ); 
		  	if($column_cl !='' ){
			  	$column_style = $column_cl;
		  	}
		  	else{
			   $column_style = 'Select Column';
		  	}
	    ?>          
	    <select name="portfolios_column">
			<option selected="selected" value="">default</option>
			<option value="1"><?php echo esc_html__('1','rsaddon');?></option>
			<option value="2"><?php echo esc_html__('2','rsaddon');?></option>
			<option value="3"><?php echo esc_html__('3','rsaddon');?></option>
			<option value="4"><?php echo esc_html__('4','rsaddon');?></option>
			<option value="5"><?php echo esc_html__('5','rsaddon');?></option>
			<option value="6"><?php echo esc_html__('6','rsaddon');?></option>
			<option value="7"><?php echo esc_html__('7','rsaddon');?></option>
			<option value="8"><?php echo esc_html__('8','rsaddon');?></option>
	    </select>	       
	   </div>
	<?php }

	/*--------------------------------------------------------------
	 *			Save testimonial social meta
	*-------------------------------------------------------------*/
	function rsaddon_save_portfolios_meta( $post_id ) {
		

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( isset($_POST['post_type']) && 'portfolios' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

	  	if( isset( $_POST[ 'portfolios_column' ] ) ) {
	        update_post_meta( $post_id, 'portfolios_column', sanitize_text_field($_POST[ 'portfolios_column' ] ));
	    }
	}
	
}
new Rsaddon_Elementor_pro_Portfolio();