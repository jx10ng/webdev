<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Business_Park
* @since Business Park 1.0.0
*/

// Add homepage ( static ) section
$wp_customize->add_section( 'business_park_static_frontpage', array(
	'title'               => __('Homepage ( Static )','business-park'),
	'description'         => __( 'Homepage ( Static ) section options.', 'business-park' ),
	'panel'               => 'business_park_theme_options_panel'
) );

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'business_park_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'business_park_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content']
) );

$wp_customize->add_control( 'business_park_theme_options[enable_frontpage_content]', array(
	'label'       => __( 'Enable Content', 'business-park' ),
	'description' => __( 'Check to enable content on static front page only.', 'business-park' ),
	'section'     => 'business_park_static_frontpage',
	'type'        => 'checkbox'
) );