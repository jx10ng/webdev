<?php
/**
 * @package louis
 */
?>

<div class="row">
		<div class="col-2-3"><div class="wrap-col test postcontent">
        
    <?php the_post_thumbnail( 'louis-full' ); ?>
        <div id="content">


<h1 class="postcontenttitle"><?php the_title() ?></h1>
<div class="authormeta"><?php esc_html_e( 'By:', 'louis' ); ?>  <?php the_author_posts_link(); ?> </div>
<?php
		the_content();
		wp_link_pages();
		
		edit_post_link( esc_html__( 'Edit', 'louis' ), '<span class="edit-link">', '</span>' );
		?>
        <br>
</div>
<?php comments_template(); ?>
</div>

</div>