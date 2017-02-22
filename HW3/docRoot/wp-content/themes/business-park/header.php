<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Park
 */

/**
* business_park_doctype hook
*
* @hooked business_park_doctype -  10
*
*/
do_action( 'business_park_doctype' );?>

<head>
<?php
	/**
	 * business_park_before_wp_head hook
	 *
	 * @hooked business_park_head -  10
	 *
	 */
	do_action( 'business_park_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
/**
 * business_park_page_start hook
 *
 * @hooked business_park_page_start -  10
 *
 */
do_action( 'business_park_page_start' );

/**
 * business_park_before_header hook
 *
 * @hooked business_park_social_bar -  20
 * @hooked business_park_slider_section -  30
 *
 */
do_action( 'business_park_before_header' );


/**
* business_park_header hook
*
* @hooked business_park_header_start -  10
* @hooked business_park_site_branding -  20
* @hooked business_park_site_nav -  30
* @hooked business_park_header_end -  100
*
*/
do_action( 'business_park_header' );


/**
* business_park_content_start hook
*
* @hooked business_park_content_start -  10
*
*/
do_action( 'business_park_content_start' );


/**
* business_park_primary_content hook
*
* @hooked business_park_about_section -  10
* @hooked business_park_testimonial_section -  20
* @hooked business_park_portfolio_section -  30
* @hooked business_park_services_section -  50
* @hooked business_park_contact_section -  90
*
*/
do_action( 'business_park_primary_content' );