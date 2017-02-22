<?php
/**
 * Business Park customizer default options
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


/**
 * Returns the default options for business-park.
 *
 * @since Business Park 1.0.0
 * @return array An array of default values
 */
function business_park_get_default_theme_options() {
	$business_park_default_options = array(
		/**
		* Section Options
		*/
		//Slider options
		'slider_enable'            => 'disabled',
		'slider_content_type'      => 'page',
		'slider_content_effect'    => 'fadeout',
		'enable_slider_captions'     => true,
		'enable_arrow_controls'      => true,
		
		//About options
		'about_enable'             => 'disabled',
		'about_content_type'       => 'page',

		//Testimonial ptions
		'testimonial_enable'       => 'disabled',
		'testimonial_content_type' => 'testimonial',
		'testimonial_title'        => __( 'What our clients are saying', 'business-park' ),
		'testimonial_bg_image'     => get_template_directory_uri() . '/assets/images/parallax_01.jpg',

		//Portfolio options
		'portfolio_title'          => __( 'Our Work', 'business-park' ),
		'portfolio_enable'         => 'disabled',
		'portfolio_content_type'   => 'portfolio-category',

		//Blog options
		'blog_enable'              => 'disabled',
		'blog_title'               => __( 'Blog Posts', 'business-park' ),

		//Contact options
		'contact_enable'           => 'disabled',
		'contact_section_title'    => __( 'Get in touch <span class="color-green">with us</span>', 'business-park' ),

		//Logo slider options
		'service_enable'       		=> 'disabled',
		'service_section_title'		=> __( 'our services', 'business-park' ),
		'service_content_type'		=> 'post',

		/**
		* Theme Options
		*/
		//Theme options
		'excerpt_length'           => 15,
		'footer_logo_enable'       => true,
		'copyright_text'           => sprintf( __( 'Copyright &copy; %1s. All Rights Reserved.', 'business-park' ),  date_i18n( date( 'Y' ) ) ),
		'enable_pagination'        => true,
		'pagination_type'          => 'numeric',
		'archive_content_type'     => 'excerpt',
		'social_menu_bg_color'     => '#BFBFBF',
		'sidebar_position'         => 'right-sidebar',
		'site_layout'         		=> 'wide',
		'enable_arrow_controls'    => true,
		'reset_options'      		=> false,
		'enable_frontpage_content' => true,
	);

	$output = apply_filters( 'business_park_default_theme_options', $business_park_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}