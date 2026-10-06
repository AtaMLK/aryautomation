<?php
/**
 * Header Footer Elementor Function
 */

/**
 * Checks if Header is enabled from HFE.
 *
 * @since  1.0.0
 * @return bool True if header is enabled. False if header is not enabled
 */
function rs_hfe_header_enabled() {
	$header_id = RSHeader_Footer_Elementor::get_settings( 'type_header', '' );
	$status    = false;

	if ( '' !== $header_id ) {
		$status = true;
	}

	return apply_filters( 'rs_hfe_header_enabled', $status );
}

/**
 * Checks if Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if header is enabled. False if header is not enabled.
 */
function rs_hfe_footer_enabled() {
	$footer_id = RSHeader_Footer_Elementor::get_settings( 'type_footer', '' );
	$status    = false;

	if ( '' !== $footer_id ) {
		$status = true;
	}

	return apply_filters( 'rs_hfe_footer_enabled', $status );
}

/**
 * Get HFE Header ID
 *
 * @since  1.0.2
 * @return (String|boolean) header id if it is set else returns false.
 */
function get_rshfe_header_id() {
	$header_id = RSHeader_Footer_Elementor::get_settings( 'type_header', '' );

	if ( '' === $header_id ) {
		$header_id = false;
	}

	return apply_filters( 'get_rshfe_header_id', $header_id );
}

/**
 * Get HFE Footer ID
 *
 * @since  1.0.2
 * @return (String|boolean) header id if it is set else returns false.
 */
function get_rshfe_footer_id() {
	$footer_id = RSHeader_Footer_Elementor::get_settings( 'type_footer', '' );

	if ( '' === $footer_id ) {
		$footer_id = false;
	}

	return apply_filters( 'get_rshfe_footer_id', $footer_id );
}

/**
 * Display header markup.
 *
 * @since  1.0.2
 */
function rshfe_render_header() {

	if ( false == apply_filters( 'enable_hfe_render_header', true ) ) {
		return;
	}

	RSHeader_Footer_Elementor::get_header_content();
}

/**
 * Display footer markup.
 *
 * @since  1.0.2
 */
function rshfe_render_footer() {

	if ( false == apply_filters( 'enable_hfe_render_footer', true ) ) {
		return;
	}

	?>
		<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
			<?php RSHeader_Footer_Elementor::get_footer_content(); ?>
		</footer>
	<?php

}


/**
 * Get HFE Before Footer ID
 *
 * @since  1.0.2
 * @return String|boolean before footer id if it is set else returns false.
 */
function rshfe_get_before_footer_id() {

	$before_footer_id = RSHeader_Footer_Elementor::get_settings( 'type_before_footer', '' );

	if ( '' === $before_footer_id ) {
		$before_footer_id = false;
	}

	return apply_filters( 'get_hfe_before_footer_id', $before_footer_id );
}

/**
 * Checks if Before Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if before footer is enabled. False if before footer is not enabled.
 */
function rshfe_is_before_footer_enabled() {

	$before_footer_id = RSHeader_Footer_Elementor::get_settings( 'type_before_footer', '' );
	$status           = false;

	if ( '' !== $before_footer_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_before_footer_enabled', $status );
}

function rshfe_get_after_header_id() {

	$after_header_id = RSHeader_Footer_Elementor::get_settings( 'type_after_header', '' );

	if ( '' === $after_header_id ) {
		$after_header_id = false;
	}

	return apply_filters( 'get_hfe_after_header_id', $after_header_id );
}

function rshfe_get_topbar_id() {

	$after_topbar_id = RSHeader_Footer_Elementor::get_settings( 'type_topbar', '' );

	if ( '' === $after_topbar_id ) {
		$after_topbar_id = false;
	}

	return apply_filters( 'get_hfe_topbar_id', $after_topbar_id );
}

/**
 * Display before footer markup.
 *
 * @since  1.0.2
 */
function rshfe_render_before_footer() {

	if ( false == apply_filters( 'enable_hfe_render_before_footer', true ) ) {
		return;
	}

	?>
		<div class="hfe-before-footer-wrap">
			<?php RSHeader_Footer_Elementor::get_before_footer_content(); ?>
		</div>
	<?php

}


function rshfe_is_after_header_enabled() {

	$after_header_id = RSHeader_Footer_Elementor::get_settings( 'type_after_header', '' );
	$status           = false;

	if ( '' !== $after_header_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_after_header_enabled', $status );
}

function rshfe_is_topbar_enabled() {

	$after_topbar_id = RSHeader_Footer_Elementor::get_settings( 'type_topbar', '' );
	$status           = false;

	if ( '' !== $after_topbar_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_topbar_enabled', $status );
}


/**
 * Display before footer markup.
 *
 * @since  1.0.2
 */
function rshfe_render_after_header() {

	if ( false == apply_filters( 'enable_hfe_render_after_header', true ) ) {
		return;
	}

	?>
		<div class="hfe-before-footer-wrap">
			<?php RSHeader_Footer_Elementor::get_after_header_content(); ?>
		</div>
	<?php

}

/**
 * Display before footer markup.
 *
 * @since  1.0.2
 */
function rshfe_render_topbar() {

	if ( false == apply_filters( 'enable_hfe_render_topbar', true ) ) {
		return;
	}

	?>
		<div class="hfe-before-footer-wrap">
			<?php RSHeader_Footer_Elementor::get_topbar_content(); ?>
		</div>
	<?php

}
