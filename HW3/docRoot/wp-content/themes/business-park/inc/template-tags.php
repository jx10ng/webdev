<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business_Park
 */

if ( ! function_exists( 'business_park_excerpt_length' ) ) :

/**
 * Implement excerpt length
 *
 * @since 1.0
 *
 * @param int $length The number of words.
 * @return int Excerpt length.
 */
function business_park_excerpt_length( $length ) {
   $options = business_park_get_theme_options();

	$excerpt_length = $options['excerpt_length'];
	if ( empty( $excerpt_length ) ) {
		$excerpt_length = $length;
	}
	return apply_filters( 'business_park_filter_excerpt_length', esc_attr( $excerpt_length ) );
}
endif;
add_filter( 'excerpt_length', 'business_park_excerpt_length', 999 );


if ( ! function_exists( 'business_park_trim_content' ) ) :
/**
 * Trim content to word $length specified
 *
 * @param  integer $length            number of words
 *
 * @param  string  $content content to be trimmed
 *
 * @return string                     trimmed content
 *
 * @since 1.0.0
 */
function business_park_trim_content( $post_obj = null, $length = 40 ) {
	global $post;
	if ( is_null( $post_obj ) ) {
		$post_obj = $post;
	}

	$length = absint( $length );
	if ( $length < 1 ) {
		$length = 40;
	}

	$source_content = $post_obj->post_content;
	if ( ! empty( $post_obj->post_excerpt ) ) {
		$source_content = $post_obj->post_excerpt;
	}

	$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
	$trimmed_content = wp_trim_words( $source_content, $length, '...' );

   return apply_filters( 'business_park_trim_content', $trimmed_content );
}
endif;


if ( ! function_exists( 'business_park_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * Create your own business_park_excerpt_more() function to override in a child theme.
 *
 * @since Business Park 1.0.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function business_park_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( ' <i class="fa fa-long-arrow-right"></i><span class="screen-reader-text"> "%s"</span>', 'business-park' ), get_the_title( get_the_ID() ) )
	);
	return $link;
}
add_filter( 'excerpt_more', 'business_park_excerpt_more' );
endif;


if ( ! function_exists( 'business_park_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own business_park_post_thumbnail() function to override in a child theme.
 *
 * @since Business Park 1.0.0
 */
function business_park_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	?>
	<figure class="featured-image">
			<?php
			if ( is_singular() ) {
				the_post_thumbnail( 'full' );
			} else { ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ), 'class' => 'img-responsive' ) ); ?>
			</a>
			<?php } ?>
	</figure>
	<?php
}
endif;


if ( ! function_exists( 'business_park_single_post_navigation' ) ) :
/**
 * Displays an optional single post navigation
 *
 *
 * Create your own business_park_post_navigation() function to override in a child theme.
 *
 * @since Business Park 1.0.0
 */
function business_park_single_post_navigation() {
	$options = business_park_get_theme_options();

	if ( ! $options['enable_pagination'] )
		return;

	the_post_navigation( array(
		'prev_text' => '<i class="fa fa-angle-double-left"></i> %title',
		'next_text' => '%title <i class="fa fa-angle-double-right"></i>'
	) );
}
endif;


if ( ! function_exists( 'business_park_archive_post_navigation' ) ) :
/**
 * Displays an optional archive navigation
 *
 *
 * Create your own business_park_archive_post_navigation() function to override in a child theme.
 *
 * @since Business Park 1.0.0
 */
function business_park_archive_post_navigation() {
	$options = business_park_get_theme_options();

	if ( ! $options['enable_pagination'] )
		return;
	?>
	<div class='blog-pagination'>
		<?php
		if ( 'numeric' == $options['pagination_type'] ) {
			the_posts_pagination( array(
				    'mid_size' => 4,
				    'prev_text' => __( 'Previous Posts', 'business-park' ),
				    'next_text' => __( 'Next Posts', 'business-park' ),
				) );
		} else {
			the_posts_navigation( array(
				'prev_text' => '<i class="fa fa-angle-double-left"></i>'.__( 'Older Posts', 'business-park' ),
				'next_text' => __( 'Newer Posts', 'business-park' ) . '<i class="fa fa-angle-double-right"></i>'
			) );
		}
		?>
	</div>
<?php
}
endif;


if ( ! function_exists( 'business_park_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Business Park 1.0.0
 */
function business_park_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


if ( ! function_exists( 'business_park_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function business_park_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><span class="screen-reader-text">'.__( 'Posted By', 'business-park' ).'</span><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'business_park_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function business_park_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'business-park' ) );
		if ( $categories_list && business_park_categorized_blog() ) {
			echo  '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'business-park' ) );
		if ( $tags_list ) {
			echo '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( get_comments_number(), esc_html__( 'One', 'business-park' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'business-park' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function business_park_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'business_park_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'business_park_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so business_park_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so business_park_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in business_park_categorized_blog.
 */
function business_park_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'business_park_categories' );
}
add_action( 'edit_category', 'business_park_category_transient_flusher' );
add_action( 'save_post',     'business_park_category_transient_flusher' );
