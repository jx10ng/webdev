<?php
/**
 * Portfolio Customizer options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */

// Add portfolio enable section
$wp_customize->add_section( 'business_park_portfolio_section', array(
	'title'             => __('Portfolio','business-park'),
	'description'       => __( 'Portfolio options', 'business-park' ),
	'panel'             => 'business_park_sections_panel'
) );

// Add portfolio enable setting and control.
$wp_customize->add_setting( 'business_park_theme_options[portfolio_enable]', array(
	'default'           => $options['portfolio_enable'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[portfolio_enable]', array(
	'label'             => __( 'Enable on', 'business-park' ),
	'section'           => 'business_park_portfolio_section',
	'type'              => 'select',
	'choices'           => business_park_enable_options()
) );

// Add portfolio title setting and control.
$wp_customize->add_setting( 'business_park_theme_options[portfolio_title]', array(
	'default'           => $options['portfolio_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'business_park_theme_options[portfolio_title]', array(
	'label'           => __( 'Title', 'business-park' ),
	'section'         => 'business_park_portfolio_section',
	'type'            => 'text',
	'active_callback' => 'business_park_is_portfolio_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_park_theme_options[portfolio_title]', array(
		'selector'            => '#portfolio-gallery h2.entry-title',
		'render_callback'     => 'business_park_customize_partial_portfolio_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add portfolio content type setting and control.
$wp_customize->add_setting( 'business_park_theme_options[portfolio_content_type]', array(
	'default'           => $options['portfolio_content_type'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[portfolio_content_type]', array(
	'label'           => __( 'Content Type', 'business-park' ),
	'section'         => 'business_park_portfolio_section',
	'type'            => 'select',
	'active_callback' => 'business_park_is_portfolio_active',
	'choices'         => array(
		'portfolio-category' => __( 'Portfolio Category', 'business-park' ),
	)
) );

// Show taxonomy drop-down setting and control
$wp_customize->add_setting( 'business_park_theme_options[portfolio_category]', array(
	'sanitize_callback' => 'business_park_sanitize_category_list'
) );

$wp_customize->add_control( new Business_Park_Dropdown_Multiple_Taxonomies_Control( $wp_customize, 'business_park_theme_options[portfolio_category]', array(
	'label'           => __( 'Select Category', 'business-park' ),
	'section'         => 'business_park_portfolio_section',
	'active_callback' => 'business_park_is_portfolio_active',
	'type'				=> 'dropdown-taxonomies',
	'taxonomy'       	=> 'category'
) ) );
