<?php
/**
 * Contact Customizer options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


// Add about enable section
$wp_customize->add_section( 'business_park_contact_section', array(
	'title'             => __('Contact','business-park'),
	'description'       => __( 'Contact section options.', 'business-park' ),
	'panel'             => 'business_park_sections_panel'
) );

// Add about enable setting and control.
$wp_customize->add_setting( 'business_park_theme_options[contact_enable]', array(
	'default'           => $options['contact_enable'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[contact_enable]', array(
	'label'             => __( 'Enable on', 'business-park' ),
	'section'           => 'business_park_contact_section',
	'type'              => 'select',
	'choices'           => business_park_enable_options()
) );

// Show contact section title setting and control
$wp_customize->add_setting( 'business_park_theme_options[contact_section_title]', array(
	'sanitize_callback' => 'business_park_santize_allow_tag',
	'default'			  => $options['contact_section_title'],
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'business_park_theme_options[contact_section_title]', array(
	'label'           => __( 'Section Title', 'business-park' ),
	'description'           => __( 'Only the HTML tag: span is allowed in this text field.', 'business-park' ),
	'section'         => 'business_park_contact_section',
	'active_callback' => 'business_park_is_contact_active',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_park_theme_options[contact_section_title]', array(
		'selector'            => '#contact-section h2.entry-title',
		'render_callback'     => 'business_park_customize_partial_contact_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Show contact section title setting and control
$wp_customize->add_setting( 'business_park_theme_options[contact_form_shortcode]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'business_park_theme_options[contact_form_shortcode]', array(
	'label'           => __( 'Contact Form Shortcode', 'business-park' ),
	'description'           => __( 'Input the shortcode generated by your contact form here.', 'business-park' ),
	'section'         => 'business_park_contact_section',
	'active_callback' => 'business_park_is_contact_active',
	'type'				=> 'text',
	'input_attrs'		=> array(
		'placeholder' => '[contact-form-7 id="277" title="Contact form 1"]'
		)
) );