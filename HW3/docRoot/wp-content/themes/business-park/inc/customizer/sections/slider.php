<?php
/**
 * Slider Customizer options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


// Add slider enable section
$wp_customize->add_section( 'business_park_slider_section', array(
	'title'             => __('Slider','business-park'),
	'description'       => __( 'Slider section options.', 'business-park' ),
	'panel'             => 'business_park_sections_panel'
) );

// Add slider enable setting and control.
$wp_customize->add_setting( 'business_park_theme_options[slider_enable]', array(
	// 'transport'         => 'postMessage',
	'default'           => $options['slider_enable'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[slider_enable]', array(
	'label'             => __( 'Enable on', 'business-park' ),
	'section'           => 'business_park_slider_section',
	'type'              => 'select',
	'choices'           => business_park_enable_options()
) );

// Add slider effects setting and control.
$wp_customize->add_setting( 'business_park_theme_options[slider_content_effect]', array(
	'default'           => $options['slider_content_effect'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[slider_content_effect]', array(
	'label'           => __( 'Transition Effects', 'business-park' ),
	'section'         => 'business_park_slider_section',
	'type'            => 'select',
	'active_callback' => 'business_park_is_slider_active',
	'choices'         => business_park_slider_effect(),
) );

// Add enable slider captions setting and control.
$wp_customize->add_setting( 'business_park_theme_options[enable_slider_captions]', array(
	'default'           => $options['enable_slider_captions'],
	'sanitize_callback' => 'business_park_sanitize_checkbox'
) );

$wp_customize->add_control( 'business_park_theme_options[enable_slider_captions]', array(
	'label'           => __( 'Enable slider captions', 'business-park' ),
	'section'         => 'business_park_slider_section',
	'type'            => 'checkbox',
	'active_callback' => 'business_park_is_slider_active',
) );

// Add enable arrow controls setting and control.
$wp_customize->add_setting( 'business_park_theme_options[enable_arrow_controls]', array(
	'default'           => $options['enable_arrow_controls'],
	'sanitize_callback' => 'business_park_sanitize_checkbox'
) );

$wp_customize->add_control( 'business_park_theme_options[enable_arrow_controls]', array(
	'label'           => __( 'Enable arrow controls', 'business-park' ),
	'section'         => 'business_park_slider_section',
	'type'            => 'checkbox',
	'active_callback' => 'business_park_is_slider_active',
) );

// Add slider content type setting and control.
$wp_customize->add_setting( 'business_park_theme_options[slider_content_type]', array(
	'default'           => $options['slider_content_type'],
	'sanitize_callback' => 'business_park_sanitize_select'
) );

$wp_customize->add_control( 'business_park_theme_options[slider_content_type]', array(
	'label'           => __( 'Content Type', 'business-park' ),
	'section'         => 'business_park_slider_section',
	'type'            => 'select',
	'active_callback' => 'business_park_is_slider_active',
	'choices'         => array( 'page' => __( 'Page', 'business-park' ), )
) );

for ($i=1; $i <= 3; $i++) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'business_park_theme_options[slider_content_page_'.$i.']', array(
		'sanitize_callback' => 'business_park_sanitize_page'
	) );

	$wp_customize->add_control( 'business_park_theme_options[slider_content_page_'.$i.']', array(
		'label'           => sprintf( __( 'Page Slider #%s', 'business-park' ), $i ),
		'section'         => 'business_park_slider_section',
		'active_callback' => 'business_park_is_slider_page_content_active',
		'type'				=> 'dropdown-pages'
	) );

	// Slider page icons setting and control
	$wp_customize->add_setting( 'business_park_theme_options[slider_content_page_icon_'.$i.']', array(
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'business_park_theme_options[slider_content_page_icon_'.$i.']',
		array(
			'label'           => sprintf( __( 'Page Slider Icon #%s', 'business-park' ), $i ),
			'description'     => __( 'The recommended size for the icon is 120px by 70px.', 'business-park' ),
			'button_labels'   => array(
				'placeholder'     => __( 'No image selected', 'business-park' ),
				'select'          => __( 'Select Icon', 'business-park' ),
				'change'          => __( 'Change Icon', 'business-park' ),
				'frame_title'     => __( 'Select Icon', 'business-park' ),
				'frame_button'    => __( 'Choose Icon', 'business-park' ),
			),
			'section'         => 'business_park_slider_section',
			'active_callback' => 'business_park_is_slider_page_content_active',
	) ) );
}