<?php
/**
 * Template part for displaying singl posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Park
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="archive-post-wrap os-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.3s" data-os-animation-duration="2s">

		<header class="entry-header">
			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

			if ( 'post' === get_post_type() ) : ?>
			<?php get_template_part( 'components/post/content', 'meta' ); ?>
			<?php
			endif; ?>
			<div class="clear"></div>
		</header>
		<?php business_park_post_thumbnail();?>
		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'business-park' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-park' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	</div>
</article><!-- #post-## -->