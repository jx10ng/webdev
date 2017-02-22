<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() ) {
		return;
	}

	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<div class="comments-list os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
		  	<h4>
		  	<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One %2$s', '%1$s comments on %2$s', get_comments_number(), 'comments title', 'business-park' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
			</h4>
			<?php
				wp_list_comments( array(
					'style'      => 'div',
					'short_ping' => true,
					'max_depth'	 => 3
				) );
			?>

			<?php the_comments_navigation(); ?>


		</div><!--end comment-list-->
	<?php endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'business-park' ); ?></p>
	<?php endif;?>
	
	<div class="comment-form os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
	<?php
	$comments_args = array(
			'title_reply' => __( 'YOUR COMMENT', 'business-park' ),
			'comment_field' => '<textarea id="comments" class="form-control" placeholder="'.__( 'YOUR COMMENT', 'business-park' ).'" rows="6" name="comment"></textarea><div class="contact-icon message-icon bg-light-grey"><i class="fa fa-quote-left"></i></div>',
			'comment_notes_before' => '',
			'submit_button' => '<input type="submit" class="form-control" value="' . __( 'POST COMMENT', 'business-park' ) . '"><i class="fa fa-long-arrow-right"></i>'
			);
	comment_form( $comments_args );?>
	</div>