<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business_Park
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_park_body_classes( $classes ) {
	$options = business_park_get_theme_options();
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$sidebar_position = business_park_layout();

	if ( is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	$classes[] = esc_attr( $options['site_layout'] );

	return $classes;
}
add_filter( 'body_class', 'business_park_body_classes' );