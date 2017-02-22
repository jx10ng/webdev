<?php
/**
 * Testimonial Customizer options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */

// Add testimonial enable section
$wp_customize->add_section( 'business_park_testimonial_section', array(
	'title'             => __('Testimonial','business-park'),
	'description'       => sprintf( __( 'Testimonial Content Type Option requires <a target="_blank" href="%s">JetPack</a> Plugin with Custom Content Types module Enabled and checked at <a target="_blank" href="%s">Settings ->Writing</a>.', 'business-park' ), esc_url( 'https://wordpress.org/plugins/jetpack/' ), esc_url( admin_url('options-writing.php') ) ),
	'panel'             => 'business_park_sections_panel'
) );

// Add testimonial enable setting and control.
$wp_customize->add_setting( 'business_park_theme_options[testimonial_enable]', array(
	// 'transport'         => 'postMessage',
	'default'           => $options['testimonial_enable'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[testimonial_enable]', array(
	'label'             => __( 'Enable on', 'business-park' ),
	'section'           => 'business_park_testimonial_section',
	'type'              => 'select',
	'choices'           => business_park_enable_options()
) );

// Add testimonial title setting and control.
$wp_customize->add_setting( 'business_park_theme_options[testimonial_title]', array(
	'default'           => $options['testimonial_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'business_park_theme_options[testimonial_title]', array(
	'label'           => __( 'Title', 'business-park' ),
	'section'         => 'business_park_testimonial_section',
	'type'            => 'text',
	'active_callback' => 'business_park_is_testimonial_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_park_theme_options[testimonial_title]', array(
		'selector'            => '#client-carousel h2.entry-title',
		'render_callback'     => 'business_park_customize_partial_testimonial_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add testimonial bg-image setting and control.
$wp_customize->add_setting( 'business_park_theme_options[testimonial_bg_image]', array(
	'default'           => $options['testimonial_bg_image'],
	'sanitize_callback' => 'business_park_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'business_park_theme_options[testimonial_bg_image]', array(
	'label'           => __( 'Background Image', 'business-park' ),
	'description'     => __( 'Note: When the image is removed, the default image will be used.', 'business-park' ),
	'section'         => 'business_park_testimonial_section',
	'active_callback' => 'business_park_is_testimonial_active',
) ) );

// Add testimonial content type setting and control.
$wp_customize->add_setting( 'business_park_theme_options[testimonial_content_type]', array(
	'default'           => $options['testimonial_content_type'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[testimonial_content_type]', array(
	'label'           => __( 'Content Type', 'business-park' ),
	'section'         => 'business_park_testimonial_section',
	'type'            => 'select',
	'active_callback' => 'business_park_is_testimonial_active',
	'choices'         => array(
		'testimonial' => __( 'Testimonial', 'business-park' ),
	)
) );

for ( $i=1; $i <= 3; $i++ ) {
	// Show social icons setting and control
	$wp_customize->add_setting( 'business_park_theme_options[testimonial_content_'.$i.']', array(
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Business_Park_Dropdown_Post_Type_Post_Control( $wp_customize, 'business_park_theme_options[testimonial_content_'.$i.']', array(
		'label'           => sprintf( __( 'Testimonial #%s', 'business-park' ), $i ),
		'section'         => 'business_park_testimonial_section',
		'active_callback' => 'business_park_is_testimonial_content_active',
		'type'				=> 'dropdown-post-type-posts',
		'post_type'       => 'jetpack-testimonial'
	) ) );

	// Show social icons setting and control
	$wp_customize->add_setting( 'business_park_theme_options[testimonial_facebook_'.$i.']', array(
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control( 'business_park_theme_options[testimonial_facebook_'.$i.']', array(
		'label'           => sprintf( __( 'Facebook #%s', 'business-park' ), $i ),
		'section'         => 'business_park_testimonial_section',
		'active_callback' => 'business_park_is_testimonial_content_active',
		'type'       		=> 'url'
	) );

	// Show social icons setting and control
	$wp_customize->add_setting( 'business_park_theme_options[testimonial_twitter_'.$i.']', array(
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control( 'business_park_theme_options[testimonial_twitter_'.$i.']', array(
		'label'           => sprintf( __( 'Twitter #%s', 'business-park' ), $i ),
		'section'         => 'business_park_testimonial_section',
		'active_callback' => 'business_park_is_testimonial_content_active',
		'type'       		=> 'url'
	) );

	// Show social icons setting and control
	$wp_customize->add_setting( 'business_park_theme_options[testimonial_pinterest_'.$i.']', array(
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control( 'business_park_theme_options[testimonial_pinterest_'.$i.']', array(
		'label'           => sprintf( __( 'Pinterest #%s', 'business-park' ), $i ),
		'section'         => 'business_park_testimonial_section',
		'active_callback' => 'business_park_is_testimonial_content_active',
		'type'       		=> 'url'
	) );
}