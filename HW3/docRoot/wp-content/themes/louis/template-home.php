<?php
/**
 * Template name: Homepage
 *
 * The main template file.
 *
 * @package Louis
 */

get_header();

get_template_part( 'inc/partials/content', 'home-hero' );
get_template_part( 'inc/partials/content', 'home-static' );

get_footer();