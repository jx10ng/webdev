<?php
/**
 * Customizer Partial Functions
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


if ( ! function_exists( 'business_park_customize_partial_testimonial_title' ) ) :
	/**
	 * Render the testimonial title for the selective refresh partial.
	 *
	 * @since Business Park 1.0.0
	 *
	 * @return string
	 */
	function business_park_customize_partial_testimonial_title() {;
		$options = business_park_get_theme_options();
		return esc_html( $options['testimonial_title'] );
	}
endif;


if ( ! function_exists( 'business_park_customize_partial_portfolio_title' ) ) :
	/**
	 * Render the portfolio title for the selective refresh partial.
	 *
	 * @since Business Park 1.0.0
	 *
	 * @return string
	 */
	function business_park_customize_partial_portfolio_title() {;
		$options = business_park_get_theme_options();
		return esc_html( $options['portfolio_title'] );
	}
endif;


if ( ! function_exists( 'business_park_customize_partial_blog_title' ) ) :
	/**
	 * Render the blog title for the selective refresh partial.
	 *
	 * @since Business Park 1.0.0
	 *
	 * @return string
	 */
	function business_park_customize_partial_blog_title() {;
		$options = business_park_get_theme_options();
		return esc_html( $options['blog_title'] );
	}
endif;


if ( ! function_exists( 'business_park_customize_partial_contact_title' ) ) :
	/**
	 * Render the contact title for the selective refresh partial.
	 *
	 * @since Business Park 1.0.0
	 *
	 * @return string
	 */
	function business_park_customize_partial_contact_title() {;
		$options = business_park_get_theme_options();
		return $options['contact_section_title'];
	}
endif;


if ( ! function_exists( 'business_park_customize_partial_copyright_text' ) ) :
	/**
	 * Render the copyright text for the selective refresh partial.
	 *
	 * @since Business Park 1.0.0
	 *
	 * @return string
	 */
	function business_park_customize_partial_copyright_text() {
		$options = business_park_get_theme_options();
		return esc_html( $options['copyright_text'] );
	}
endif;

if ( ! function_exists( 'business_park_customize_partial_service_title' ) ) :
	/**
	 * Render the service title for the selective refresh partial.
	 *
	 * @since Business Park 1.1.0
	 *
	 * @return string
	 */
	function business_park_customize_partial_service_title() {;
		$options = business_park_get_theme_options();
		return $options['service_section_title'];
	}
endif;