<?php
/**
 * Business Park Theme Customizer
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';

// Load customizer theme pro link
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Business Park 1.0.0
 */
function business_park_get_theme_options() {
	$business_park_default_options = business_park_get_default_theme_options();

	return array_merge( $business_park_default_options , get_theme_mod( 'business_park_theme_options', $business_park_default_options ) ) ;
}
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_park_customize_register( $wp_customize ) {
	$options = business_park_get_theme_options();

	// Load customizer sanitization functions.
	require get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callbacks.php';

	// Load customize partial functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->get_control( 'custom_logo' )->description = __( 'The recommended size for the logo is 120px by 70px.', 'business-park' );

	/**
	* Theme Options for sections
	*/
	// Add panel for different sections
	$wp_customize->add_panel( 'business_park_sections_panel' , array(
	    'title'      => __('Sections','business-park'),
	    'description'=> __( 'Business Park available sections.', 'business-park' ),
	    'priority'   => 130,
	) );

	// Load slider options.
	require get_template_directory() . '/inc/customizer/sections/slider.php';

	// Load about us section options.
	require get_template_directory() . '/inc/customizer/sections/about.php';

	if ( business_park_is_jetpack_cpt_module_enable( 'jetpack_testimonial' ) ) {
		// Load testimonial section options.
		require get_template_directory() . '/inc/customizer/sections/testimonial.php';
	}

	if ( business_park_is_jetpack_cpt_module_enable( 'jetpack_portfolio' ) ) {
		// Load portfolio section options.
		require get_template_directory() . '/inc/customizer/sections/portfolio.php';
	}

	// Load blog section options.
	require get_template_directory() . '/inc/customizer/sections/blog.php';

	// Load contact options.
	require get_template_directory() . '/inc/customizer/sections/contact.php';

	// Load services options.
	require get_template_directory() . '/inc/customizer/sections/services.php';

	/**
	* Common Options
	*/
	// Add panel for common options
	$wp_customize->add_panel( 'business_park_theme_options_panel' , array(
	    'title'      => __('Theme Options','business-park'),
	    'description'=> __( 'Business Park Theme Options.', 'business-park' ),
	    'priority'   => 150,
	) );

	// Load excerpt options.
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// Load footer options.
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// Load pagination options.
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// Load layout options.
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// Load color options.
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	/**
	* Reset section
	*/
	// Add reset enable section
	$wp_customize->add_section( 'business_park_reset_section', array(
		'title'             => __('Reset all settings','business-park'),
		'description'       => __( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'business-park' ),
	) );

	// Add reset enable setting and control.
	$wp_customize->add_setting( 'business_park_theme_options[reset_options]', array(
		'default'           => $options['reset_options'],
		'sanitize_callback' => 'business_park_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'business_park_theme_options[reset_options]', array(
		'label'             => __( 'Check to reset all settings', 'business-park' ),
		'section'           => 'business_park_reset_section',
		'type'              => 'checkbox',
	) );
}
add_action( 'customize_register', 'business_park_customize_register' );


/**
 * Enqueue styles on customizer preview.
 */
function business_park_customizer_styles() {
	if ( is_customize_preview() ) {
	   // Add fontawesome
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css', '', '4.6.3' );

		// Add custom css for customizer
		wp_enqueue_style( 'business-park-customizer', get_template_directory_uri() . '/assets/css/customizer.min.css' );
	}
}
add_action( 'customize_controls_print_styles', 'business_park_customizer_styles' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_park_customize_preview_js() {
	wp_enqueue_script( 'business_park_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_park_customize_preview_js' );


function business_park_inline_css() {
	$options              = business_park_get_theme_options();

	$testimonial_bg_image = $options['testimonial_bg_image'];

	$css = '
		/* Testimonial background image */
		#client-carousel {
		    background: url("'.esc_url( $testimonial_bg_image ).'") no-repeat fixed;
		}
	';

	wp_add_inline_style( 'business-park-style', $css );
}
add_action( 'wp_enqueue_scripts', 'business_park_inline_css', 10 );
