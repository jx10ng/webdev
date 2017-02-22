<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business_Park
 */

get_header(); ?>
	<div class="container blog-contents">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'components/post/content', 'single' );

				business_park_single_post_navigation();

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
get_footer();
