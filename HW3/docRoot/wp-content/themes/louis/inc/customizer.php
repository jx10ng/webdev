<?php
/**
 * louis Theme Customizer
 *
 * @package louis
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function louis_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}

add_action( 'customize_register', 'louis_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function louis_customize_preview_js()
{
	wp_enqueue_script( 'louis_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130515', true );
}

add_action( 'customize_preview_init', 'louis_customize_preview_js' );

function louis_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function louis_sanitize_int( $value )
{
	return absint( $value );
}

function louis_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'louis_homepage', array(
		'title'    => esc_html__( 'Homepage Setup', 'louis' ),
		'priority' => 10,
	) );

	
	// hero banner
	$wp_customize->add_section( 'louis_hero', array(
		'title'       => esc_html__( 'Hero Banner', 'louis' ),
		'priority'    => 50,
		'description' => esc_html__( 'Homepage Hero Header Area', 'louis' ),
		'panel'       => 'louis_homepage',
	) );
	
	
	$wp_customize->add_setting( 'louis_display_hero_banner', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'louis_display_hero_banner', array(
		'label'    => __( 'Show Hero Header Section', 'louis' ),
		'settings' => 'louis_display_hero_banner',
		'type'     => 'select',
		'section'        => 'louis_hero',
		'choices'  => array( 'yes' => __( 'Yes', 'louis' ), 'no' => __( 'No', 'louis' ) ),
	) );


	$wp_customize->add_setting( 'louis_hero_title', array(
		'default'           => esc_html__( 'LOUIS WORDPRESS THEME', 'louis' ),
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'louis_hero_title', array(
		'label'   => esc_html__( 'Title', 'louis' ),
		'section' => 'louis_hero',
	) );

	$wp_customize->add_setting( 'louis_hero_text', array(
		'default'           => 'Enter your text here which will show up on the homepage in the Hero Banner section.',
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_text', array(
		'label'    => esc_html__( 'Main text', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_text',
	) );

	$wp_customize->add_setting( 'louis_hero_button1_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_hero_button1_show', array(
		'label'    => esc_html__( 'Show button 1', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button1_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'louis' ), 'no' => esc_html__( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_hero_button1_text', array(
		'default'           => esc_html__( 'About us', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button1_text', array(
		'label'    => esc_html__( 'Button 1 text', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button1_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_button1_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button1_link', array(
		'label'    => esc_html__( 'Button 1 link', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button1_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_button2_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'louis_hero_button2_show', array(
		'label'    => esc_html__( 'Show button 2', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button2_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'louis' ), 'no' => esc_html__( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_hero_button2_text', array(
		'default'           => esc_html__( 'Contact', 'louis' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button2_text', array(
		'label'    => esc_html__( 'Button 2 text', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button2_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_button2_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_button2_link', array(
		'label'    => esc_html__( 'Button 2 link', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_button2_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_blur_enabled', array(
		'default'           => 0,
		'sanitize_callback' => 'louis_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_blur_enabled', array(
		'label'    => esc_html__( 'Blur amount (pixels)', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_blur_enabled',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'louis_hero_overlay_enabled', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'louis_hero_overlay_enabled', array(
		'label'    => esc_html__( 'Overlay the image with color', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_overlay_enabled',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'louis' ), 'no' => esc_html__( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_hero_overlay_color', array(
		'default'           => '#1f242d',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'louis_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_overlay', array(
		'label'    => esc_html__( 'Hero image overlay color', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_overlay_color',
	) ) );


	$wp_customize->add_setting( 'louis_hero_overlay_opacity', array(
		'default'           => '90',
		'sanitize_callback' => 'louis_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'louis_hero_overlay_opacity', array(
		'label'    => esc_html__( 'Overlay opacity (between 0 and 100)', 'louis' ),
		'section'  => 'louis_hero',
		'settings' => 'louis_hero_overlay_opacity',
		'type'     => 'text',
	) );

	// end hero banner

	// social
	$wp_customize->add_section( 'louis_header_social', array(
		'title'    => esc_html__( 'Social', 'louis' ),
		'priority' => 50,
		'panel'    => 'louis_homepage',
	) );
	$wp_customize->add_setting( 'louis_header_social_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'louis_header_social_show', array(
		'label'    => esc_html__( 'Show social icons below the hero banner text', 'louis' ),
		'section'  => 'louis_header_social',
		'settings' => 'louis_header_social_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'louis' ), 'no' => esc_html__( 'No', 'louis' ) ),
	) );

	$wp_customize->add_setting( 'louis_header_social_twitter', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_twitter', array(
		'label'   => esc_html__( 'Twitter URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_facebook', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_facebook', array(
		'label'   => esc_html__( 'Facebook URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_pinterest', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_pinterest', array(
		'label'   => esc_html__( 'Pinterest URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_linkedin', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_linkedin', array(
		'label'   => esc_html__( 'LinkedIn URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_gplus', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_gplus', array(
		'label'   => esc_html__( 'Google+ URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_behance', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_behance', array(
		'label'   => esc_html__( 'Behance URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_dribbble', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_dribbble', array(
		'label'   => esc_html__( 'Dribbble URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_dribbble', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_dribbble', array(
		'label'   => esc_html__( 'Dribbble URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_flickr', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_flickr', array(
		'label'   => esc_html__( 'Flickr URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_500px', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_500px', array(
		'label'   => esc_html__( '500px URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_reddit', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_reddit', array(
		'label'   => esc_html__( 'Reddit URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_wordpress', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_wordpress', array(
		'label'   => esc_html__( 'Wordpress URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_youtube', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_youtube', array(
		'label'   => esc_html__( 'Youtube URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_soundcloud', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_soundcloud', array(
		'label'   => esc_html__( 'Soundcloud URL', 'louis' ),
		'section' => 'louis_header_social',
	) );

	$wp_customize->add_setting( 'louis_header_social_medium', array(
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'louis_header_social_medium', array(
		'label'   => esc_html__( 'Medium URL', 'louis' ),
		'section' => 'louis_header_social',
	) );
	// end social

	// colors

	$wp_customize->add_setting( 'louis_accent_color', array(
		'default'           => '#0ea6f2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'louis_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => esc_html__( 'Accent color', 'louis' ),
		'section'  => 'colors',
		'settings' => 'louis_accent_color',
	) ) );

	// end colors

}

add_action( 'customize_register', 'louis_customizer', 11 );