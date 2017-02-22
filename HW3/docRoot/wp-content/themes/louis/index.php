<?php
/**
 * Template name: Homepage
 *
 * The main template file.
 *
 * @package Louis
 */

get_header();
		if ( have_posts() ) :
				get_template_part( 'inc/partials/content', 'header-blog' );
				get_template_part( 'inc/partials/content', 'home-posts' );
		else :
			get_template_part( 'inc/partials/content', 'none' );
		endif;
get_footer();