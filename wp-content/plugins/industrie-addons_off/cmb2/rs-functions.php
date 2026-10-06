<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rs_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php') ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function rs_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}



/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function rs_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rs_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rs_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function rs_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}


add_action( 'cmb2_admin_init', 'rs_register_testi_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rs_register_testi_metabox() {
	$prefix = 'rs_'; 
	$cmb_event = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-testi_information',
		'title'         => esc_html__( 'Country Information', 'bootcamp' ),
		'object_types'  => array( 'testimonials' ), // Post type
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Country, State Name', 'cmb2' ),
		'desc' => esc_html__( 'Write country, state name', 'cmb2' ),
		'id'   => 'country_name',
		'type' => 'text_medium'		
	) );
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Country Flag', 'cmb2' ),
		'id'   => 'country_flag',
		'type' => 'file',
	));
}

add_action( 'cmb2_admin_init', 'rs_register_event_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rs_register_event_metabox() {
	$prefix = 'rs_'; 
	$cmb_event = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-event',
		'title'         => esc_html__( 'Event Information', 'bootcamp' ),
		'object_types'  => array( 'events' ), // Post type
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event Price', 'cmb2' ),
		'desc' => esc_html__( 'add event price', 'cmb2' ),
		'id'   => 'ev_price',
		'type' => 'text_medium'		
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event Start Date', 'cmb2' ),
		'desc' => esc_html__( 'add event start date', 'cmb2' ),
		'id'   => 'ev_start_date',
		'type' => 'text_date',	
	) );
	
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event Start Time', 'cmb2' ),
		'desc' => esc_html__( 'Add event start time', 'cmb2' ),
		'id'   => 'ev_start_time',
		'type' => 'text_time',
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event End Date', 'cmb2' ),
		'desc' => esc_html__( 'add event end date', 'cmb2' ),
		'id'   => 'ev_end_date',
		'type' => 'text_date'		
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event End Time', 'cmb2' ),
		'desc' => esc_html__( 'Add event end time', 'cmb2' ),
		'id'   => 'ev_end_time',
		'type' => 'text_time',
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event Location', 'cmb2' ),
		'desc' => esc_html__( 'Add your event location', 'cmb2' ),
		'id'   => 'ev_location',
		'type' => 'text_medium',
		// 'time_format' => 'H:i', // Set to 24hr format
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Book Now Link', 'cmb2' ),
		'desc' => esc_html__( 'Enter Button Link', 'cmb2' ),
		'id'   => 'ev_book_btn',
		'type' => 'text_medium',
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Speaker Name', 'cmb2' ),
		'desc' => esc_html__( 'Enter Speaker Name', 'cmb2' ),
		'id'   => 'ev_speaker_name',
		'type' => 'text_medium',
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Speaker Image', 'cmb2' ),
		'id'   => 'speaker_img',
		'type' => 'file',
	));
}
 
// Onepage Page Check Start
function rs_onepage_post_check_meta_box() {
    $prefix = 'rs_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . 'onepage_post_check_meta_box',
        'title'         => __( 'This Page Is Onepage?', 'rs-header-footer-elementor' ),
        'object_types'  => array( 'page' ),
        'context'       => 'side',
        'priority'      => 'default',
    ));
    $cmb->add_field( array(
        'name'    => __( 'Yes', 'rs-header-footer-elementor' ),
        'id'      => $prefix . 'onepage_post_check',
        'type'    => 'checkbox',
    ));
}
add_action( 'cmb2_admin_init', 'rs_onepage_post_check_meta_box' );

function save_rs_onepage_post_check_meta_box( $post_id ) {
    $cmb_prefix = 'rs_';
    $value = isset( $_POST[$cmb_prefix . 'onepage_post_check'] ) ? 'on' : '';
    if ( ! empty( $value ) ) {
        update_post_meta( $post_id, $cmb_prefix . 'onepage_post_check', $value );
    } else {
        delete_post_meta( $post_id, $cmb_prefix . 'onepage_post_check' );
    }
}
add_action( 'save_post', 'save_rs_onepage_post_check_meta_box' );
// Onepage Page Check End



/**
 * Callback to define the optionss-saved message.
 *
 * @param CMB2  $cmb The CMB2 object.
 * @param array $args {
 *     An array of message arguments
 *
 *     @type bool   $is_options_page Whether current page is this options page.
 *     @type bool   $should_notify   Whether options were saved and we should be notified.
 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
 *                                   this error applies.
 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
 *                                   Used as part of 'id' attribute in HTML output.
 *     @type string $message         For add_settings_error(), The formatted message text to display
 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
 * }
 */
function rs_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'rs-framework' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function rs_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}