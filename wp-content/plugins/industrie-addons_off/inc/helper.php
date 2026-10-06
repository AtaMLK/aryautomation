<?php
function rselemetns_woocommerce_product_categories(){
    $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
        return $options;
    }
}

/**
 * 
 */
if ( ! function_exists( 'redox_page_breadcrumb_meta' ) ) {
    function redox_page_breadcrumb_meta() {
        add_meta_box( 'additional-page-metabox-options', esc_html__( 'Page Breadcrumb', 'redox' ), 'redox_page_breadcrumb_field', 'page', 'normal', 'low' );
    }
}
add_action( 'add_meta_boxes', 'redox_page_breadcrumb_meta' );

if ( ! function_exists( 'redox_page_breadcrumb_field' ) ) {
    function redox_page_breadcrumb_field( $post ) {
        $meta_id = get_post_meta( $post->ID );
        $redox_page_breadcrumb_val = ( isset( $meta_id['redox_page_breadcrumb_val'][0] ) &&  '1' === $meta_id['redox_page_breadcrumb_val'][0] ) ? 1 : 0;
        wp_nonce_field( 'redox_control_meta_box', 'redox_control_meta_box_nonce' );
        ?>
            <p>
                <label>
          <?php esc_attr_e( 'Hide Breadcrumb', 'redox' ); ?>
          <input type="checkbox" name="redox_page_breadcrumb_val" value="1" <?php checked( $redox_page_breadcrumb_val, 1 ); ?> />
        </label>
            </p>
        <?php
    }
}

if ( ! function_exists( 'redox_save_breadcrumb_meta' ) ) {
    function redox_save_breadcrumb_meta( $post_id ) {
        if ( ! isset( $_POST['redox_control_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['redox_control_meta_box_nonce'] ), 'redox_control_meta_box' ) ) { // Input var okay.
            return $post_id;
        }
        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
    //Save the data
        $redox_page_breadcrumb_val = ( isset( $_POST['redox_page_breadcrumb_val'] ) && '1' === $_POST['redox_page_breadcrumb_val'] ) ? 1 : 0;
        update_post_meta( $post_id, 'redox_page_breadcrumb_val', esc_attr( $redox_page_breadcrumb_val ) );
    }
}
add_action( 'save_post', 'redox_save_breadcrumb_meta' );


// Add the meta box to the page editor screen
function add_page_color_metabox__rs() {
    add_meta_box(
        'page_color_metabox',
        'Page Color',
        'render_page_color_metabox__rs',
        'page',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'add_page_color_metabox__rs');

// Render the content of the meta box
function render_page_color_metabox__rs($post) {
    // Retrieve the current page color value
    $page_color = get_post_meta($post->ID, '_page_color', true);

    // Output the HTML for the meta box
    ?>
    <label for="page_color">Select Page Color:</label>
    <input type="text" id="page_color" name="page_color" class="color-field" value="<?php echo esc_attr($page_color); ?>">
    <script>
        // Initialize the color picker
        jQuery(document).ready(function($) {
            $('.color-field').wpColorPicker();
        });
    </script>
    <?php
}

// Save the page color value when the page is updated
function save_page_color_metabox__rs($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    if (isset($_POST['page_color'])) {
        update_post_meta($post_id, '_page_color', sanitize_hex_color($_POST['page_color']));
    }
}

add_action('save_post', 'save_page_color_metabox__rs');


if ( ! function_exists( 'rs_get_cf7_forms' ) ) {
    /**
     * Get a list of all CF7 forms
     *
     * @return array
     */
    function rs_get_cf7_forms() {
        $forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( ! empty( $forms ) ) {
            return wp_list_pluck( $forms, 'post_title', 'ID' );
        }
        return [];
    }
}