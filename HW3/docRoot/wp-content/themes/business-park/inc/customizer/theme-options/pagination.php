<?php
/**
* Pagination options
*
* @package Theme Palace
* @subpackage Business_Park
* @since Business Park 1.0.0
*/

// Add copyright section
$wp_customize->add_section( 'business_park_pagination', array(
	'title'       => __('Pagination','business-park'),
	'description' => __( 'Pagination section options.', 'business-park' ),
	'panel'       => 'business_park_theme_options_panel'
) );

// Disable Pagination setting and control.
$wp_customize->add_setting( 'business_park_theme_options[enable_pagination]', array(
	'sanitize_callback' => 'business_park_sanitize_checkbox',
	'default'           => $options['enable_pagination']
) );

$wp_customize->add_control( 'business_park_theme_options[enable_pagination]', array(
	'label'   => __( 'Check to enable pagination', 'business-park' ),
	'section' => 'business_park_pagination',
	'type'    => 'checkbox'
) );

// Disable Pagination type setting and control.
$wp_customize->add_setting( 'business_park_theme_options[pagination_type]', array(
	'sanitize_callback' => 'business_park_sanitize_select',
	'default'           => $options['pagination_type']
) );

$wp_customize->add_control( 'business_park_theme_options[pagination_type]', array(
	'label'           => __( 'Pagination type', 'business-park' ),
	'description'     => __( 'Only on archive pages', 'business-park' ),
	'section'         => 'business_park_pagination',
	'type'            => 'select',
	'choices'         => business_park_pagination_type(),
	'active_callback' => 'business_park_is_pagination_enable'
) );