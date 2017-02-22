<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'business_park_excerpt_section', array(
	'title'             => __('Excerpt','business-park'),
	'description'       => __( 'Excerpt section options.', 'business-park' ),
	'panel'             => 'business_park_theme_options_panel'
) );

// Excerpt length setting and control.
$wp_customize->add_setting( 'business_park_theme_options[excerpt_length]', array(
	'sanitize_callback' => 'business_park_sanitize_number_range',
	'default'			  => $options['excerpt_length']
) );

$wp_customize->add_control( 'business_park_theme_options[excerpt_length]', array(
	'label'       => __( 'Length', 'business-park' ),
	'description' => __( 'Total words to be displayed.', 'business-park' ),
	'section'     => 'business_park_excerpt_section',
	'type'        => 'number',
	'input_attrs' => array(
		'style'       => 'width: 80px;',
		'max'         => 150,
		'min'         => 5,
	),
) );