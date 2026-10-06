<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package rs
 * @author RS Theme
 * @link http://www.rstheme.com
 */
// Register Team Post Type
function rs_team_pro_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Teams', 'rsaddon'),
		'singular_name'      => esc_html__( 'Team', 'rsaddon'),
		'add_new'            => esc_html_x( 'Add New Team', 'rsaddon'),
		'add_new_item'       => esc_html__( 'Add New Team', 'rsaddon'),
		'edit_item'          => esc_html__( 'Edit Team', 'rsaddon'),
		'new_item'           => esc_html__( 'New Team', 'rsaddon'),
		'all_items'          => esc_html__( 'All Team', 'rsaddon'),
		'view_item'          => esc_html__( 'View Team', 'rsaddon'),
		'search_items'       => esc_html__( 'Search Teams', 'rsaddon'),
		'not_found'          => esc_html__( 'No Teams found', 'rsaddon'),
		'not_found_in_trash' => esc_html__( 'No Teams found in Trash', 'rsaddon'),
		'parent_item_colon'  => esc_html__( 'Parent Team:', 'rsaddon'),
		'menu_name'          => esc_html__( 'Teams', 'rsaddon'),
	);	
	
	$industrie_team_slug = !empty(get_theme_mod('industrie_team_slug')) ? get_theme_mod('industrie_team_slug') : 'teams' ;
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'rewrite' => 		 array('slug' => $industrie_team_slug,'with_front' => false),	
		'menu_position'      => 20,		
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	);
	register_post_type( 'teams', $args );
}
add_action( 'init', 'rs_team_pro_register_post_type' );

function rsaddon_pro_tr_create_team() {
	
	register_taxonomy(
		'team-category',
		'teams',
		array(
			'label' => esc_html__( 'Team Categories','rsaddon'),			
			'hierarchical' => true,
			'show_admin_column' => true,		
		)
	);
}
add_action( 'init', 'rsaddon_pro_tr_create_team' );

function rsaddon_pro_team_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('team-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'attorneys' ){
 			foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);

			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);		
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug.'>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'rsaddon_pro_team_add_taxonomy_filters' );



// Meta Box
/*--------------------------------------------------------------
*			Member info
*-------------------------------------------------------------*/
function rsaddon_pro_team_member_info_meta_box() {
	add_meta_box( 'member_info_meta', esc_html__( 'Member General Info', 'rsaddon'), 'rsaddon_pro_team_member_info_meta_callback', 'teams', 'advanced', 'high', 1 );
}
add_action( 'add_meta_boxes', 'rsaddon_pro_team_member_info_meta_box');
// member info callback
function rsaddon_pro_team_member_info_meta_callback( $member_info ) {
	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>
		
	<div class="rs-admin-input"><label for="designation"><?php esc_html_e( 'Designation', 'rsaddon') ?></label>
	<?php $designation = get_post_meta( $member_info->ID, 'designation', true ); ?>
		<input type="text" name="designation" id="designation" class="designation" value="<?php echo esc_html($designation); ?>"/>
	</div> 


<?php }
/*--------------------------------------------------------------
* Member social links
*-------------------------------------------------------------*/
function rsaddon_pro_team_member_social_link_meta_box() {
	add_meta_box( 'member_social_link_meta', esc_html__( 'Social Links', 'rsaddon'), 'rsaddon_pro_team_social_meta_link_callback', 'teams', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rsaddon_pro_team_member_social_link_meta_box' );
// Social Meta Callback
function rsaddon_pro_team_social_meta_link_callback( $social_meta ) {
	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>
	<!-- member social -->
	<div class="wrap-meta-group">
		<div class="rs-admin-input"><label for="facebook"><?php esc_html_e( 'Facebook', 'rsaddon') ?></label>
			<?php $facebook = get_post_meta( $social_meta->ID, 'facebook', true ); ?>
			<input type="text" name="facebook" id="facebook" class="facebook" value="<?php echo esc_html($facebook); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="twitter"><?php esc_html_e(
					'Twitter', 'rsaddon') ?></label>
			<?php $twitter = get_post_meta( $social_meta->ID, 'twitter', true ); ?>
			<input type="text" name="twitter" id="twitter" class="twitter" value="<?php echo esc_html($twitter); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="instagram"><?php esc_html_e( 'Instagram', 'rsaddon') ?></label>
			<?php $instagram= get_post_meta( $social_meta->ID, 'instagram', true ); ?>
			<input type="text" name="instagram" id="instagram" class="instagram" value="<?php echo esc_html($instagram); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="linkedin"><?php esc_html_e( 'Linkedin', 'rsaddon') ?></label>
			<?php $linkedin= get_post_meta( $social_meta->ID, 'linkedin', true ); ?>
			<input type="text" name="linkedin" id="linkedin" class="linkedin" value="<?php echo esc_html($linkedin); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="google_plus"><?php esc_html_e( 'Google+', 'rsaddon') ?></label>
			<?php $google_plus = get_post_meta( $social_meta->ID, 'google_plus', true ); ?>
			<input type="text" name="google_plus" id="google_plus" class="google_plus" value="<?php echo esc_html($google_plus); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="phone_number"><?php esc_html_e( 'Phone Number', 'rsaddon') ?></label>
			<?php $phone_number = get_post_meta( $social_meta->ID, 'phone_number', true ); ?>
			<input type="text" name="phone_number" id="phone_number" class="phone_number" value="<?php echo esc_html($phone_number); ?>"/>
		</div>
	</div>
<?php }
/*--------------------------------------------------------------
 *			Save member social meta
*-------------------------------------------------------------*/
function save_rs_pro_team_member_social_meta( $post_id ) {
	if ( ! isset( $_POST['member_social_metabox_nonce'] ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	if ( 'teams' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}
	$mymeta = array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'instagram', 'designation','phone_number' );
	foreach ( $mymeta as $keys ) {
		if ( is_array( sanitize_text_field ($_POST[ $keys ]) ) ) {
			$data = array();
			foreach ( sanitize_text_field($_POST[ $keys ]) as $key => $value ) {
				$data[] = $value;
			}
		} else {
			$data = sanitize_text_field( $_POST[ $keys ] );
		}
		update_post_meta( $post_id, $keys, $data );
	}
}
add_action( 'save_post', 'save_rs_pro_team_member_social_meta' );