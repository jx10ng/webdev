<?php
/**
 * Service Customizer options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.1.0
 */


// Add service enable section
$wp_customize->add_section( 'business_park_service_section', array(
	'title'             => __('Service','business-park'),
	'description'       => __( 'Service section options.', 'business-park' ),
	'panel'             => 'business_park_sections_panel'
) );

// Add service enable setting and control.
$wp_customize->add_setting( 'business_park_theme_options[service_enable]', array(
	'default'           => $options['service_enable'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[service_enable]', array(
	'label'             => __( 'Enable on', 'business-park' ),
	'section'           => 'business_park_service_section',
	'type'              => 'select',
	'choices'           => business_park_enable_options()
) );

// Show service section title setting and control
$wp_customize->add_setting( 'business_park_theme_options[service_section_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			  => $options['service_section_title'],
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'business_park_theme_options[service_section_title]', array(
	'label'           => __( 'Section Title', 'business-park' ),
	'section'         => 'business_park_service_section',
	'active_callback' => 'business_park_is_service_active',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_park_theme_options[service_section_title]', array(
		'selector'            => '#services h2.entry-title',
		'render_callback'     => 'business_park_customize_partial_service_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add service content type setting and control.
$wp_customize->add_setting( 'business_park_theme_options[service_content_type]', array(
	'default'           => $options['service_content_type'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[service_content_type]', array(
	'label'           => __( 'Content Type', 'business-park' ),
	'section'         => 'business_park_service_section',
	'type'            => 'select',
	'active_callback' => 'business_park_is_service_active',
	'choices'         => array( 'post' => __( 'Post', 'business-park' ) )
) );

/*
* Post Content Type
 */
for ($i=1; $i <= 3; $i++) {
	// Show service icon setting and control
	$wp_customize->add_setting( 'business_park_theme_options[service_icon_'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'business_park_theme_options[service_icon_'.$i.']', array(
		'label'           => sprintf( __( 'Icon #%s', 'business-park' ), $i ),
		'section'         => 'business_park_service_section',
		'active_callback' => 'business_park_is_service_active',
		'type'				=> 'text',
		'input_attrs'		=> array( 'placeholder'		=> 'fa-archive' )
	) );

	// Show post type setting and control
	$wp_customize->add_setting( 'business_park_theme_options[service_content_post_'.$i.']', array(
		'sanitize_callback' => 'business_park_sanitize_number_range'
	) );

	$wp_customize->add_control( 'business_park_theme_options[service_content_post_'.$i.']', array(
		'label'           => sprintf( __( 'Post Service #%s', 'business-park' ), $i ),
		'description'           => __( 'Enter the Post ID here.', 'business-park' ),
		'section'         => 'business_park_service_section',
		'active_callback' => 'business_park_is_service_active',
		'type'				=> 'number',
		'input_attrs'     => array(
			'min'	=> 0
			)
	) );

	// Service custom hr setting and control
	$wp_customize->add_setting( 'business_park_theme_options[service_content_custom_hr'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Business_Park_Customize_Horizontal_Line( $wp_customize, 'business_park_theme_options[service_content_custom_hr'.$i.']',
		array(
			'section'         => 'business_park_service_section',
			'active_callback' => 'business_park_is_service_active',
			'type'				=> 'hr'
	) ) );
}