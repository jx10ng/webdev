<?php
/**
 * About Customizer options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


// Add about enable section
$wp_customize->add_section( 'business_park_about_section', array(
	'title'             => __('About','business-park'),
	'description'       => __( 'About section options.', 'business-park' ),
	'panel'             => 'business_park_sections_panel'
) );

// Add about enable setting and control.
$wp_customize->add_setting( 'business_park_theme_options[about_enable]', array(
	'default'           => $options['about_enable'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[about_enable]', array(
	'label'             => __( 'Enable on', 'business-park' ),
	'section'           => 'business_park_about_section',
	'type'              => 'select',
	'choices'           => business_park_enable_options()
) );

// Add about content type setting and control.
$wp_customize->add_setting( 'business_park_theme_options[about_content_type]', array(
	'default'           => $options['about_content_type'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[about_content_type]', array(
	'label'           => __( 'Content Type', 'business-park' ),
	'section'         => 'business_park_about_section',
	'type'            => 'select',
	'active_callback' => 'business_park_is_about_active',
	'choices'         => array( 'page' => __( 'Page', 'business-park' ),
	)
) );

// Show page drop-down setting and control
$wp_customize->add_setting( 'business_park_theme_options[about_content_page]', array(
	'sanitize_callback' => 'business_park_sanitize_page'
) );

$wp_customize->add_control( 'business_park_theme_options[about_content_page]', array(
	'label'           => __( 'Page', 'business-park' ),
	'description'     => __( 'The recommended size for the featured image while using it for this section is 500px by 250px.', 'business-park' ),
	'section'         => 'business_park_about_section',
	'active_callback' => 'business_park_is_about_page_content_active',
	'type'            => 'dropdown-pages'
) );

