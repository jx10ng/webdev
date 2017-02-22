<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Park
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="archive-post-wrap os-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<?php get_template_part( 'components/post/content', 'meta' ); ?>
			<?php endif; ?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<?php get_template_part( 'components/post/content', 'footer' ); ?>
	</div>
</article>
