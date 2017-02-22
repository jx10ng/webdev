<?php
/**
 * Blog Customizer options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


// Add blog enable section
$wp_customize->add_section( 'business_park_blog_section', array(
	'title'             => __('Blog','business-park'),
	'description'       => __( 'Blog section options.', 'business-park' ),
	'panel'             => 'business_park_sections_panel'
) );

// Add blog enable setting and control.
$wp_customize->add_setting( 'business_park_theme_options[blog_enable]', array(
	'default'           => $options['blog_enable'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[blog_enable]', array(
	'label'             => __( 'Enable on', 'business-park' ),
	'section'           => 'business_park_blog_section',
	'type'              => 'select',
	'choices'           => business_park_enable_options()
) );

// Add blog title setting and control.
$wp_customize->add_setting( 'business_park_theme_options[blog_title]', array(
	'default'           => $options['blog_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'business_park_theme_options[blog_title]', array(
	'label'           => __( 'Title', 'business-park' ),
	'section'         => 'business_park_blog_section',
	'type'            => 'text',
	'active_callback' => 'business_park_is_blog_section_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_park_theme_options[blog_title]', array(
		'selector'            => '#blog-section h2.entry-title',
		'render_callback'     => 'business_park_customize_partial_blog_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}