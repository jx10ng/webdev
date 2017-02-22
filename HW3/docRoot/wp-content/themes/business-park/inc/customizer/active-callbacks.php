<?php
/**
 * Business Park customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


if ( ! function_exists( 'business_park_is_slider_active' ) ) :
	/**
	 * Check if slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_slider_active( $control ) {
		if ( 'static-frontpage' == $control->manager->get_setting( 'business_park_theme_options[slider_enable]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_slider_page_content_active' ) ) :
	/**
	 * Check if slider content type page is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_slider_page_content_active( $control ) {
		if ( business_park_is_slider_active( $control ) && 'page' == $control->manager->get_setting( 'business_park_theme_options[slider_content_type]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_about_active' ) ) :
	/**
	 * Check if about is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_about_active( $control ) {
		if ( 'static-frontpage' == $control->manager->get_setting( 'business_park_theme_options[about_enable]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_about_page_content_active' ) ) :
	/**
	 * Check if about content type page is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_about_page_content_active( $control ) {
		if ( business_park_is_about_active( $control ) && 'page' == $control->manager->get_setting( 'business_park_theme_options[about_content_type]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_testimonial_active' ) ) :
	/**
	 * Check if testimonial is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_testimonial_active( $control ) {
		if ( 'static-frontpage' == $control->manager->get_setting( 'business_park_theme_options[testimonial_enable]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_testimonial_content_active' ) ) :
	/**
	 * Check if about content type page is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_testimonial_content_active( $control ) {
		if ( business_park_is_testimonial_active( $control ) && 'testimonial' == $control->manager->get_setting( 'business_park_theme_options[testimonial_content_type]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_portfolio_active' ) ) :
	/**
	 * Check if portfolio is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_portfolio_active( $control ) {
		if ( 'static-frontpage' == $control->manager->get_setting( 'business_park_theme_options[portfolio_enable]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_portfolio_content_active' ) ) :
	/**
	 * Check if about content type page is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_portfolio_category_active( $control ) {
		if ( business_park_is_portfolio_active( $control ) && 'portfolio-category' == $control->manager->get_setting( 'business_park_theme_options[portfolio_content_type]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_blog_section_active' ) ) :
	/**
	 * Check if blog is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_blog_section_active( $control ) {
		if ( 'static-frontpage' == $control->manager->get_setting( 'business_park_theme_options[blog_enable]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_contact_active' ) ) :
	/**
	 * Check if contact is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_contact_active( $control ) {
		if ( 'static-frontpage' == $control->manager->get_setting( 'business_park_theme_options[contact_enable]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'business_park_is_footer_logo_enable' ) ) :
	/**
	 * Check if footer logo is enable.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_footer_logo_enable( $control ) {
		return $control->manager->get_setting( 'business_park_theme_options[footer_logo_enable]' )->value();
	}
endif;


if ( ! function_exists( 'business_park_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'business_park_theme_options[enable_pagination]' )->value();
	}
endif;



if ( ! function_exists( 'business_park_is_service_active' ) ) :
	/**
	 * Check if service is active.
	 *
	 * @since Business Park 1.1.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_park_is_service_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'business_park_theme_options[service_enable]' )->value() )
			return true;

		return false;
	}
endif;
