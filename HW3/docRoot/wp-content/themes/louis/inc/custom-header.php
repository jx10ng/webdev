<?php
/**
 * @package louis
 */

/**
 * Set up the WordPress core custom header feature.
 *
 */
function louis_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'louis_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '495762',
		'width'                  => 1900,
		'height'                 => 830,
		'default-image' => get_template_directory_uri() . '/images/header.jpg',
		'flex-height'            => true,
		'header-text' 			=> false,
	) ) );
}
add_action( 'after_setup_theme', 'louis_custom_header_setup' );