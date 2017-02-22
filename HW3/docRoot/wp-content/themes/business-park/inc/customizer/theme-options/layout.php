<?php
/**
* Layout options
*
* @package Theme Palace
* @subpackage Business_Park
* @since Business Park 1.0.0
*/

// Add copyright section
$wp_customize->add_section( 'business_park_layout', array(
	'title'               => __('Layout','business-park'),
	'description'         => __( 'Layout section options.', 'business-park' ),
	'panel'               => 'business_park_theme_options_panel'
) );

// Archive content type setting and control.
$wp_customize->add_setting( 'business_park_theme_options[archive_content_type]', array(
	'sanitize_callback'   => 'business_park_sanitize_select',
	'default'             => $options['archive_content_type']
) );

$wp_customize->add_control( 'business_park_theme_options[archive_content_type]', array(
	'label'               => __( 'Archive Content Type', 'business-park' ),
	'section'             => 'business_park_layout',
	'type'                => 'select',
	'choices'				 => business_park_archive_content(),
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'business_park_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'business_park_sanitize_select',
	'default'             => $options['sidebar_position']
) );

$wp_customize->add_control( 'business_park_theme_options[sidebar_position]', array(
	'label'               => __( 'Sidebar Position', 'business-park' ),
	'section'             => 'business_park_layout',
	'type'                => 'select',
	'choices'				 => business_park_sidebar_position(),
) );

// Site layout setting and control.
$wp_customize->add_setting( 'business_park_theme_options[site_layout]', array(
	'sanitize_callback'   => 'business_park_sanitize_select',
	'default'             => $options['site_layout']
) );

$wp_customize->add_control( 'business_park_theme_options[site_layout]', array(
	'label'               => __( 'Site Layout', 'business-park' ),
	'section'             => 'business_park_layout',
	'type'                => 'select',
	'choices'				 => business_park_site_layout(),
) );