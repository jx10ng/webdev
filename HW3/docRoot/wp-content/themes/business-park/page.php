<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Park
 */

get_header();
	if ( true === apply_filters( 'business_park_filter_frontpage_content_enable', true ) ) : ?>
		<div class="container blog-contents">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'components/page/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</main>
			</div>
			<?php
				if ( business_park_is_sidebar_enable() ) {
					get_sidebar();
				}
			?>
		</div>
		<?php
	endif;
get_footer();