<?php
/**
 * Business Park options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


/**
 * Enable options of the defined section
 * @return array Enable options
 */
function business_park_enable_options() {
	$business_park_enable_options = array(
		'static-frontpage' => __( 'Static Frontpage', 'business-park' ),
		'disabled'         => __( 'Disabled', 'business-park' ),
	);

	$output = apply_filters( 'business_park_enable_options', $business_park_enable_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}


/**
 * Slider effects
 * @return array Slider effects
 */
function business_park_slider_effect() {
	$business_park_slider_effect = array(
		'scrollHorz' => __( 'Scroll Horizontal', 'business-park' ),
		'fadeout'    => __( 'Fade Out', 'business-park' ),
	);

	$output =  apply_filters( 'business_park_slider_effect', $business_park_slider_effect );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}


/**
 * List of Font Awesome icons
 * @return array Font Awesome icons
 */
function business_park_fa_icons() {
	$business_park_fa_icons = array(
		'fa-adjust'      => 'f042',
		'fa-university'  => 'f19c',
		'fa-download '   => 'f019',
		'fa-tachometer ' => 'f0e4',
		'fa-refresh '    => 'f021',
		'fa-life-ring'   => 'f1cd',
		'fa-rss'         => 'f09e',
		'fa-signal'      => 'f012',
		'fa-archive '    => 'f187',
		'fa-bookmark'    => 'f02e',
	);

	$output = apply_filters( 'business_park_fa_icons', $business_park_fa_icons );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}

/**
 * Returns an array of FA icons
 *
 * @since  0.1
 * @access public
 * @return array An array of font awesome icons
 */
function business_park_fa_icons_choices() {

	$icons = array();
	$fa_icons_choices = business_park_fa_icons();
	foreach ( $fa_icons_choices as $class => $code )
		$icons[ $class ] = "&#x{$code};";

	return $icons;
}


/**
 * List of Font Awesome contact related icons
 * @return array Font Awesome icons
 */
function business_park_contact_info_icons() {
	$business_park_contact_info_icons = array(
		'fa-facebook'        => 'f09a',
		'fa-twitter'         => 'f099',
		'fa-google-plus '    => 'f0d5',
		'fa-location-arrow ' => 'f124',
		'fa-instagram '      => 'f16d',
		'fa-phone '          => 'f095',
		'fa-phone-square '   => 'f098',
		'fa-envelope '       => 'f0e0',
	);

	$output = apply_filters( 'business_park_contact_info_icons', $business_park_contact_info_icons );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}


/**
 * Returns an array of FA contact related icons
 *
 * @since  0.1
 * @access public
 * @return array An array of font awesome icons
 */
function business_park_contact_info_icons_choices() {

	$icons = array();
	$contact_icons = business_park_contact_info_icons();
	foreach ( $contact_icons as $class => $code )
		$icons[ $class ] = "&#x{$code};";

	return $icons;
}


/**
 * List of pagination types
 * @return array Pagination types
 */
function business_park_pagination_type() {
	$business_park_pagination_type = array(
		'numeric'     => __( 'Numeric', 'business-park' ),
		'older-newer' => __( 'Older/Newer', 'business-park' ),
	);

	$output = apply_filters( 'business_park_pagination_type', $business_park_pagination_type );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}


/**
 * Archive Content types
 * @return array Pagination types
 */
function business_park_archive_content() {
	$business_park_archive_content = array(
		'excerpt'      => __( 'Excerpt', 'business-park' ),
		'full-content' => __( 'Full content', 'business-park' ),
	);

	$output = apply_filters( 'business_park_archive_content', $business_park_archive_content );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}


/**
 * Sidebar position
 * @return array Sidbar positions
 */
function business_park_sidebar_position() {
	$business_park_sidebar_position = array(
		'right-sidebar' => __( 'Right', 'business-park' ),
		'left-sidebar'  => __( 'Left', 'business-park' ),
		'no-sidebar'    => __( 'No Sidebar', 'business-park' ),
	);

	$output = apply_filters( 'business_park_sidebar_position', $business_park_sidebar_position );

	return $output;
}


/**
 * Site Layout
 * @return array Sidbar positions
 */
function business_park_site_layout() {
	$business_park_site_layout = array(
		'wide'  => __( 'Wide', 'business-park' ),
		'boxed' => __( 'Boxed', 'business-park' ),
	);

	$output = apply_filters( 'business_park_site_layout', $business_park_site_layout );

	return $output;
}
