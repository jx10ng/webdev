<?php
/**
* Copyright options
*
* @package Theme Palace
* @subpackage Business_Park
* @since Business Park 1.0.0
*/

// Add copyright section
$wp_customize->add_section( 'business_park_footer', array(
	'title'               => __('Footer','business-park'),
	'description'         => __( 'Footer section options.', 'business-park' ),
	'panel'               => 'business_park_theme_options_panel'
) );

// Disable Footer Logo setting and control.
$wp_customize->add_setting( 'business_park_theme_options[footer_logo_enable]', array(
	'sanitize_callback'   => 'business_park_sanitize_checkbox',
	'default'             => $options['footer_logo_enable']
) );

$wp_customize->add_control( 'business_park_theme_options[footer_logo_enable]', array(
	'label'               => __( 'Check to enable footer logo', 'business-park' ),
	'section'             => 'business_park_footer',
	'type'                => 'checkbox'
) );

// Footer Logo setting and control.
$wp_customize->add_setting( 'business_park_theme_options[footer_logo]', array(
	'sanitize_callback'   => 'business_park_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'business_park_theme_options[footer_logo]', array(
	'label'               => __( 'Footer Logo', 'business-park' ),
	'description'         => __( 'The recommended size for the footer logo is 215px by 215px', 'business-park' ),
	'section'             => 'business_park_footer',
	'active_callback'     => 'business_park_is_footer_logo_enable'
) ) );

// Copyright text setting and control.
$wp_customize->add_setting( 'business_park_theme_options[copyright_text]', array(
	'sanitize_callback'   => 'wp_filter_nohtml_kses',
	'transport'           => 'postMessage',
	'default'             => $options['copyright_text']
) );

$wp_customize->add_control( 'business_park_theme_options[copyright_text]', array(
	'label'               => __( 'Copyright', 'business-park' ),
	'section'             => 'business_park_footer',
	'type'                => 'textarea',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_park_theme_options[copyright_text]', array(
		'selector'            => '#colophon .bottom-footer span.copyright',
		'render_callback'     => 'business_park_customize_partial_copyright_text',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}